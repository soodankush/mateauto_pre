<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Platforms;
use App\Services\TwitterApiService;
use App\Services\GumroadApiService;

class PlatformController extends Controller
{
    protected $twitterApiService;
    protected $gumroadApiService;

    public function __construct(
        TwitterApiService $twitterApiService,
        GumroadApiService $gumroadApiService,
    ) {
        $this->twitterApiService = $twitterApiService;
        $this->gumroadApiService = $gumroadApiService;
    }
    public function getLoginUrl($platform)
    {
        \Log::info('Inside ' . __METHOD__);
        $url = null;
        $response = [
            'success' => false,
            'url'     => $url
        ];

        if (!in_array(strtoupper($platform), Platforms::AVL_PLATFORMS)) {
            \Log::info('Platform not found');
            throw new \Exception("Invalid request.", 500);
        }
        switch (strtolower($platform)) {
            case 'twitter':
                $url = $this->twitterApiService->getLoginUrl();
                if (!$url) {
                    \Log::error('Twitter login url not generated for user');
                    throw new \Exception("Error Generating url", 500);
                }

                $response = [
                    'success' => true,
                    'url'     => $url
                ];
                break;

            case 'gumroad':

                $url = $this->gumroadApiService->getLoginUrl();

                if (!$url) {
                    \Log::error('Gumroad login url not generated for user');
                    throw new \Exception("Error generating URL", 500);
                }

                $response = [
                    'success' => true,
                    'url'     => $url
                ];

                // no break
            case 'instagram':
                #code
                break;
            default:

                \Log::error('Platform ' . $platform . ' not found');
                throw new Exception("Platform not found.", 500);

                break;
        }

        return response()->json($response, 200);
    }

    /**
     * Callback Url to get the params for the users.
     */
    public function getPlatformCallback(Request $request, $platform)
    {
        switch (strtolower($platform)) {
            case 'twitter':
                if (!$request->has('code') || !$request->has('state')) {
                    throw new \Exception('Invalid callback request');
                }
                $accessTokenData = $this->twitterApiService->getRefreshAndAccessTokenUsingCode($request->all());
                break;

            case 'gumroad':
                if ($request->has('code')) {
                    $accessTokenData = $this->gumroadApiService->getAccessTokenUsingCode($request->all());
                } else {
                    \Log::error($request->all());
                    throw new \Exception($request->error_description);
                }
                break;

            default:
                # code...
                break;
        }
        return redirect()->route('user.login');
    }
}
