<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;

use App\Events\RegisterdUserEvent;
class VerifyEmailController extends Controller
{

    public function verifyEmail($id,$hash)
    {
        $user = User::find((int)$id);

        
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified()){
            event(new Verified($user));
            $info = [
                    'email'=> $user['email'],
                    'name' => $user['fname'].' '.$user['lname'],
                    'user' => $user['role'],
                ];
            event(new RegisterdUserEvent($info));
        }

        return response()->json(['status' => 200, 'message' => "Verified successfully"], 200);
    }
}