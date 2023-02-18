<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Platforms;
use App\Services\TwitterApiService;

class PlatformController extends Controller
{
    public function getLoginUrl($platform)
    {
        \Log::info('Inside ' . __METHOD__);
        $url = null;
        $response = [
            'success' => false,
            'url'     => $url
        ];

        if (!in_array(strtoupper($platform), Platforms::AVL_PLATFORMS)){
            \Log::infio('Platform not found');
            throw new \Exception("Invalid request.", 500);
        }
        switch ($platform) {
            case 'twitter':
                $twitterServiceInstance = new TwitterApiService();
                $url = $twitterServiceInstance->getLoginUrl();
                if(!$url) {
                    \Log::info('Twitter login url not generated for user');
                    throw new \Exception("Error Generating url", 500);  
                    
                }

                $response = [
                    'success' => true,
                    'url'     => $url
                ];
                break;

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
}
