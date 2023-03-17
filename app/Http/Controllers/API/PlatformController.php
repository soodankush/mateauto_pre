<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TwitterApiService;
use App\Services\GumroadApiService;
use App\Models\UserSettings;
use App\Models\Platform;

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
        try {
            $user = auth()->user();
            $platformData = Platform::where('platform_name', strtolower($platform))->first();
            if (!$platformData) {
                \Log::info('Platform not found');
                throw new \Exception("Invalid request.", 500);
            }
            $userSettingsData = UserSettings::where('user_id', $user->id)
                                                ->where('platform_id', $platformData->id)
                                                ->first();
            if (isset($userSettingsData->status) && $userSettingsData->status === 1) {
                \Log::info('User with id: ' . $user->email . ' is already connected to platform ' . $platform);
                throw new \Exception('User is already connected to platform ' . $platform);
            }
            switch (strtolower($platform)) {
                case 'twitter':
                    $url = $this->twitterApiService->getLoginUrl($userSettingsData);
                    if (!$url) {
                        \Log::error('Twitter login url not generated for user: ' . $user->email);
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
        } catch(\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }

    /**
     * Callback Url to get the params for the users.
     */
    public function getPlatformCallback(Request $request, $platform)
    {
        try {
            switch (strtolower($platform)) {
                case 'twitter':
                    if ($request->has('error')) {
                        \Log::error('Error: ' . $request->error . ' for state: ' . $request?->state);
                        throw new \Exception('User unauthorized the onboarding. Please try again');
                    }
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
        } catch(\Exception $e) {
            return redirect()->route('user.login')->withError(['message' => $e->getMessage()]);
        }
    }
}
