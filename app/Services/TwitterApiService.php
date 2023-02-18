<?php

namespace App\Services;

class TwitterApiService
{

    private $platform = 'twitter';
    private $platformUrl = 'https://twitter.com'; 

    // private $redirectUrl = route('redirect.url', ['platform' => $platform]);
    private $redirectUrl = 'callback/twitter';
    

    public function getLoginUrl()
    {
        \Log::info('Inside ' . __METHOD__);
        $url = $this->platformUrl . '/i/oauth2/authorize?response_type=code&client_id=' . config('twitter.client_id') . '&redirect_uri=' . config('app.url') . $this->redirectUrl . '&scope=tweet.read%20users.read%20offline.access&state=state&code_challenge=challenge&code_challenge_method=plain';
        return $url;
    }
}

