<?php

namespace App\Http\Controllers;

use \App\Models\Message;
use Illuminate\Http\Request;
use \App\User;
use \App\Models\BusinessCase;
use \App\Models\Dialog;
use \App\Http\Traits\DialogAccessTrait;

class MessageController extends Controller
{
    use DialogAccessTrait;
    public function message($businessCaseSlug, $dialogID, Request $request) {
        if (!$this->check($businessCaseSlug, $dialogID)) {
            $response['status'] = '403';
            return json_encode($response);
        }

        //  Create message
        $messageBody = strip_tags($request->body, '<p><strong><em><span><blockquote><a>');
        $messageBody = str_replace('<p></p>','', $messageBody);
        $messageBody = str_replace('<p>&nbsp;</p>', '', $messageBody);
        if ($messageBody == '') {
            $response['status'] = 'empty-message';
            return json_encode($response);
        }

        if ($request->editMessage == '')
            $message = Message::create([
                'body' => $messageBody,
                'edited' => '0',
                'user_id' => \Auth::user()->id,
                'dialog_id' => $dialogID,
                'isArchived' => '0'
            ]);
        else {
            $message = Message::find($request->editMessage);
            if ($message == null) {
                $response['status'] = '404';
                return json_encode($response);
            }
            if ($message->user_id != \Auth::user()->id) {
                $response['status'] = '403';
                return json_encode($response);
            }
            $message->body = $messageBody;
            $message->edited = '1';
            $message->save();
        }

        $response['status'] = '200';

        return json_encode($response);
    }
    public function deleteAndRestore($businessCaseSlug, $dialogID, Request $request) {
        if (!$this->check($businessCaseSlug, $dialogID)) {
            $response['status'] = '403';
            return json_encode($response);
        }

        if ($request->has('id') && $request->has('dr')) {
            $message = Message::find($request->id);
            if ($message != null) {
                if ($request->dr == 1)
                    $message->isArchived = '0';
                elseif ($request->dr == 0)
                    $message->isArchived = '1';
                $message->save();
                $response['status'] = '200';
                return json_encode($response);
            }

            $response['status'] = '404';
            return json_encode($response);
        }

        $response['status'] = '404';
        return json_encode($response);
    }
}
