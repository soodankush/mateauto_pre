<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Models\PreLaunchEmail;
use App\Jobs\SendVerificationEmailToUser;

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
            'token' => md5(rand())
        ]);
        SendVerificationEmailToUser::dispatch($newUser->id);
        return redirect()->back()->with(['status' => 'Email registered. Please verify it.']);
    }
}
