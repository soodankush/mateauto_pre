<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\UserSettings;
use App\Models\Platform;
use Carbon\Carbon;

class TwitterApiService
{
    private $platform = 'twitter';
    private $platformUrl = 'https://twitter.com';
    private $baseApiUrl = 'https://api.twitter.com';
    private $apiVersion = 2;
    private $refreshAndAccessTokenGenerationUrl = 'https://api.twitter.com/2/oauth2/token';
    private $redirectUrl = 'callback/twitter';
    private $accessToken = null;
    private $headers = null;
    private $platformId = 1;
    private $scope = [
        'tweet.read',
        'users.read',
        'offline.access',
        'tweet.write',
        'follows.read',
        'follows.write',
        'like.read',
        'like.write',
        'bookmark.read',
        'bookmark.write'
    ];
    public function __construct()
    {
        // $this->headers = [ 'Authorization' => 'Bearer ' . $this->accessToken];
    }

    private function _setHeaders(UserSettings $userSettings)
    {
        $credentails = json_decode($userSettings->credentials, true);
        $this->accessToken = $credentails['access_token'];
        $this->headers = [ 'Authorization' => 'Bearer ' . $this->accessToken];
    }

    private function _getPayloadData(UserSettings $userSettings = null)
    {
        if (isset($userSettings->payload)) {
            $payload = json_decode($userSettings->payload, true);
        } else {
            $permittedCharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $payload['state'] = substr(str_shuffle($permittedCharacters), 0, 16);
            $payload['code_challenge'] = substr(str_shuffle($permittedCharacters), 0, 20);
            $payload['code_challenge_method'] = 'plain';
            UserSettings::updateOrInsert([
                'user_id'   => auth()->user()->id,
                'platform_id'=> $this->platformId,
                'status'   => 0,
            ], [
                'payload' => json_encode($payload),
                'created_at'=> Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return $payload;
    }

    public function getLoginUrl($userSettingsData)
    {
        \Log::info('Inside ' . __METHOD__);
        try {
            $payloadData = $this->_getPayloadData($userSettingsData);
            $url = $this->platformUrl . '/i/oauth2/authorize?response_type=code&client_id=' . config('twitter.client_id') . '&redirect_uri=' . config('app.url') . $this->redirectUrl . '&scope=' . urlencode(implode(" ", $this->scope)) . '&state=' . $payloadData['state'] . '&code_challenge=' . $payloadData['code_challenge']. '&code_challenge_method=' . $payloadData['code_challenge_method'];
            return $url;
        } catch(\Exception $e) {
            \Log::error($e);
            return null;
        }
    }

    public function getRefreshAndAccessTokenUsingCode($userData)
    {
        \Log::info('Inside ' . __METHOD__);
        $currentUserSettingsData = UserSettings::where('payload->state', $userData['state'])->first();

        if (!$currentUserSettingsData) {
            \Log::error('User settings detail for the ' . $userData['state'] . ' not found.');
            throw new \Exception('User settings details not found.');
        }

        $payloadData = $this->_getPayloadData($currentUserSettingsData);
        $client = new Client();
        $formData = [
            'code' => $userData['code'],
            'grant_type' => 'authorization_code',
            'client_id' => config('twitter.client_id'),
            'redirect_uri' => url('/callback/twitter'),
            'code_verifier'     => $payloadData['code_challenge']
        ];
        $tokenResponse = $client->post($this->refreshAndAccessTokenGenerationUrl, [
            'form_params' => $formData
        ]);

        if ($tokenResponse->getStatusCode() === 200) {
            $bodyContent = $tokenResponse->getBody()->getContents();

            $currentUserSettingsData->update([
                'credentials'   => $bodyContent,
                'status'        => true,
                'updated_at'    => Carbon::now()
            ]);

            return true;
        } else {
            \Log::error('Token response code ' . $tokenResponse->getStatusCode());
            \Log::error('Token response body ' . $tokenResponse->getBody()->getContents());
            return null;
        }
    }

    private function _generateNewAccessToken(UserSettings $settingsData)
    {
        \Log::info('Inside ' . __METHOD__);
        try {
            $credentials = json_decode($settingsData->credentials, true);
            $client = new Client();
            $formData = [
                'refresh_token' => $credentials['refresh_token'],
                'grant_type' =>'refresh_token',
                'client_id' => config('twitter.client_id'),
            ];
            // dd($formData);
            $newAccessTokenResponse = $client->post($this->refreshAndAccessTokenGenerationUrl, [
                'form_params' => $formData
            ]);
            if ($newAccessTokenResponse->getStatusCode() === 200) {
                $settingsData->update([
                    'credentials' => $newAccessTokenResponse->getBody()->getContents(),
                    'updated_at'    => Carbon::now()
                ]);
            }
            return true;
        } catch(\Exception $e) {
            \Log::error($e);
            return false;
        }
    }

    private function _apiRequest($endpoint, $requestType = 'GET', $requestBody = null, $params = [])
    {
        \Log::info('Inside ' . __METHOD__);
        $responseData = null;
        $url = $this->baseApiUrl . '/';
        if ($this->apiVersion) {
            $url .= $this->apiVersion . '/';
        }
        $url .= $endpoint;
        if (count($params) > 0) {
            $url .= '?' . $params;
        }
        try {
            $client = new Client();
            switch ($requestType) {
                case 'GET':
                    $responseData = $client->get($url, [
                        'headers' => $this->headers,
                    ]);
                    break;

                case 'POST':
                    $responseData = $client->post($url, [
                        'headers' => $this->headers,
                        'body'=>$requestBody
                    ]);
                    break;

                case 'PUT':
                    $responseData = $client->put($url, [
                        'headers' => $this->headers,
                        'body'=>$requestBody
                    ]);
                    break;

                case 'DELETE':
                    $responseData = $client->delete($url, [
                        'headers' => $this->headers,
                        'body'=>$requestBody
                    ]);
                    break;

                default:
                    # code...
                    break;
            }
            return [
                'response' => json_decode($responseData->getBody()->getContents()),
                'statusCode' => $responseData->getStatusCode()
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return [
                'response' => json_decode($e->getResponse()->getBody()->getContents(), true),
                'statusCode' => $e->getResponse()->getStatusCode()
            ];
            return $e->getResponse();
        }
    }

    public function callApiService(UserSettings $platformUserSettings, $endpoint, $requestType, $body = null, $urlParams = [])
    {
        \Log::info('Inside ' . __METHOD__);
        $this->_setHeaders($platformUserSettings);
        if (!isset($this->accessToken) || ($this->accessToken === null)) {
            \Log::error('Unable to fetch access token for user id: ' . $platformUserSettings->user_id);
        }
        $apiResponse = $this->_apiRequest($endpoint, $requestType, $body, $urlParams);

        if ($apiResponse['statusCode'] === 401) {
            $isNewTokenGenerated = $this->_generateNewAccessToken($platformUserSettings);
            if($isNewTokenGenerated) {
                $this->callApiService($platformUserSettings, $endpoint, $requestType, $body, $urlParams);
            } else {
                \Log::error(' Some issue with the token generattion');
                //call the getRefreshAndAccessTokenUsingCode again to get new tokens
                throw new \Exception('Could not generate a new access token');
            }
        }
        return $apiResponse;
    }
}
