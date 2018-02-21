<?php

namespace App\Http\Controllers;

use App\AuthUser;
use App\Notifications\MailNotification;
use Illuminate\Http\Request;

class SendNotificationsController extends Controller
{
    public function send(Request $request){

        $user = new AuthUser();
        $user->notify(new MailNotification(
            $request->input('header'),
            $request->input('top'),
            $request->input('bottom'),
            $request->input('button'),
            $request->input('button_link'),
            $request->file('attach')
        ));

    }
}
