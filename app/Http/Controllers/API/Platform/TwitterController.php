<?php

namespace App\Http\Controllers\API\Platform;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TwitterApiService;
use App\Models\UserSettings;
use App\Models\Platform;
use Carbon\Carbon;

class TwitterController extends Controller
{
    protected $twitterApiService;
    protected $platformId;
    protected $platform = 'twitter';
    protected $userPlatformData = null;
    private $userId;

    public function __construct(
        // TwitterApiService $twitterApiService
    ) {
        $this->twitterApiService = new TwitterApiService();
        $this->platformId = Platform::where('platform_name', $this->platform)->first()->id;
        $this->userPlatformData = UserSettings::where('user_id', 1)
                                        ->where('platform_id', $this->platformId)
                                        ->where('status', 1)
                                        ->first();
        $this->userId = json_decode($this->userPlatformData->platform_user_details, true)['id'];

        if (!$this->userPlatformData) {
            throw new \Exception('User settings for ' . $this->platform . ' not found');
        }
    }

    public function getMyProfile()
    {
        \Log::info('Inside ' . __METHOD__);
        $getMyProfileData = $this->twitterApiService->callApiService($this->userPlatformData, 'users/me', 'GET');
        if ($getMyProfileData['statusCode'] === 200) {
            $this->userPlatformData->update([
                'platform_user_details' => json_encode($getMyProfileData['response']->data),
                'updated_at'    => Carbon::now()
            ]);
            $response = [
                'success' => true,
                'data' =>$getMyProfileData['response']->data
            ];
        } else {
            $response = [
                'success' => false,
                'data' => 'Error fetching user details from twitter'
            ];
        }
        return $response;
    }

    public function getBookmarks()
    {
        \Log::info('Inside ' . __METHOD__);
        $bookmarksData = $this->twitterApiService->callApiService($this->userPlatformData, 'users/' . $this->userId . '/bookmarks', 'GET');
        return response()->json([
            'success' => true,
            'data' =>$bookmarksData['response']->data
        ]);
    }

    public function getTweets()
    {
        \Log::info('Inside ' . __METHOD__);
        $tweetsData = $this->twitterApiService->callApiService($this->userPlatformData, 'tweets', 'GET');
        dd($tweetsData);
    }
}
