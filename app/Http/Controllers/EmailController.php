<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Models\PreLaunchEmail;
use App\Jobs\SendVerificationEmailToUser;
use Carbon\Carbon;
use Str;

class EmailController extends Controller
{
    /**
     * Function that stores the email to the database and trigger verify email job
     */
    public function storeEmail(EmailRequest $request)
    {
        $validateEmail = $request->validated();
        $newUser = PreLaunchEmail::create([
            'name'  => $request->name,
            'email' => $request->email,
            'is_verified' => false,
            'token' => Str::random(210)
        ]);
        SendVerificationEmailToUser::dispatch($newUser->id);
        return redirect()->back()->with(['success' => 'Email successsfully registered. Please verify it.']);
    }

    /**
     * Function verify the pre launch emails
     */
    public function verifyPrelaunchEmail($token)
    {
        $getUserData = PreLaunchEmail::where('token', $token)
                        ->first();

        if (!$getUserData) {
            return redirect()->to('/')->with('error', 'Invalid User');
        }

        if ($getUserData->is_verified) {
            return redirect()->to('/')->with('success', 'User has been already registered to the waitlist');
        }

        $getUserData->is_verified = 1;
        $getUserData->email_verified_at = Carbon::now();
        $getUserData->update();
        return redirect()->to('/')->with('success', 'User successfully registered to waitlist');
    }
}
