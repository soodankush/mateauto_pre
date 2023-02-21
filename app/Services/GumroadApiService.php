<?php

namespace App\Services;

use GuzzleHttp\Client;

class GumroadApiService
{
    private $platform = 'gumroad';
    private $platformUrl = 'https://gumroad.com';
    private $baseApiUrl = 'https://api.gumroad.com';
    private $accessTokenUrl = 'https://api.gumroad.com/oauth/token';
    private $apiVersion = 'v2';
    private $redirectUrl = 'callback/gumroad';
    private $headers = null;

    public function __construct()
    {
    }

    public function getLoginUrl()
    {
        \Log::info('Inside ' . __METHOD__);
        $url = $this->platformUrl . '/oauth/authorize?client_id=' . config('gumroad.client_id') . '&redirect_uri=' . config('app.url').  $this->redirectUrl . '&scope=edit_products';
        return $url;
    }

    public function getAccessTokenUsingCode($userData)
    {
        \Log::info('Inside ' . __METHOD__);
        $gumroadClient = new Client();
        $formData = [
            'code' => $userData['code'],
            'client_id' => config('gumroad.client_id'),
            'client_secret' => config('gumroad.client_secret'),
            'redirect_uri' => url('/callback/gumroad'),
        ];

        $tokenResponse = $gumroadClient->post($this->accessTokenUrl, [
            'form_params' => $formData
        ]);

        if ($tokenResponse->getStatusCode() === 200) {
            $bodyContent = $tokenResponse->getBody()->getContents();
            $tokenData = json_decode($bodyContent, true);
            \Log::info('Gumroad Access Data');
            \Log::info($tokenData);
            //save the token data
            return $tokenData;
        } else {
            \Log::error('Token response code ' . $tokenResponse->getStatusCode());
            \Log::error('Token response body ' . $tokenResponse->getBody()->getContents());
            return null;
        }
    }
}
