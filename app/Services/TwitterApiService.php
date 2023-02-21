<?php

namespace App\Services;

use GuzzleHttp\Client;

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
    public function __construct()
    {
        $this->headers = [ 'Authorization' => 'Bearer ' . $this->accessToken];
    }

    public function getLoginUrl()
    {
        \Log::info('Inside ' . __METHOD__);
        $url = $this->platformUrl . '/i/oauth2/authorize?response_type=code&client_id=' . config('twitter.client_id') . '&redirect_uri=' . config('app.url') . $this->redirectUrl . '&scope=tweet.read%20users.read%20offline.access&state=state&code_challenge=challenge&code_challenge_method=plain';
        return $url;
    }

    public function getRefreshAndAccessTokenUsingCode($userData)
    {
        \Log::info('Inside ' . __METHOD__);
        $client = new Client();
        $formData = [
            'code' => $userData['code'],
            'grant_type' => 'authorization_code',
            'client_id' => config('twitter.client_id'),
            'redirect_uri' => url('/callback/twitter'),
            'code_verifier' => 'challenge'
        ];
        $tokenResponse = $client->post($this->refreshAndAccessTokenGenerationUrl, [
            'form_params' => $formData
        ]);

        if ($tokenResponse->getStatusCode() === 200) {
            $bodyContent = $tokenResponse->getBody()->getContents();
            $tokenData = json_decode($bodyContent, true);
            \Log::info($tokenData);
            //save the token data
            return $tokenData;
        } else {
            \Log::error('Token response code ' . $tokenResponse->getStatusCode());
            \Log::error('Token response body ' . $tokenResponse->getBody()->getContents());
            return null;
        }
    }

    public function generateNewAccessToken()
    {
        \Log::info('Inside ' . __METHOD__);
    }

    public function apiRequest($endpoint, $requestType = 'GET', $requestBody = null, $params = [])
    {
        $responseData = null;
        $url = $this->baseApiUrl . '/';
        if ($apiVersion) {
            $url .= $this->apiVersion . '/';
        }
        $url .= $endpoint;
        if (count($params) > 0) {
            $url .= '?' . $params;
        }
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
        dd($responseData->getBody()->getContents());
    }
}
