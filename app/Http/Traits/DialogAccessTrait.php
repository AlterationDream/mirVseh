<?php

namespace App\Http\Traits;

use \App\User;
use \App\Models\BusinessCase;
use \App\Models\Dialog;

trait DialogAccessTrait
{
    public static function check($businessCaseSlug, $dialogID) {
        $businessCase = BusinessCase::with('users')->with('guests')->where('slug', '=', $businessCaseSlug)->first();
        $dialog = Dialog::with('users')->with('messages')->where('id', '=', $dialogID)->first();

        // Check if user is allowed in the dialog
        $userID = \Auth::user()->id;
        $userAllowedInBusinessCase = false;
        $userAllowedInDialog = false;
        $businessCaseUsers = $businessCase->users()->get();
        $businessCaseGuests = $businessCase->guests()->get();
        $isParticipant = false;
        $isGuest = false;

        foreach ($businessCaseUsers as $user) {
            if ($user->id == $userID) { 
                $userAllowedInBusinessCase = true;
                $isParticipant = true;
            }
        }
        foreach ($businessCaseGuests as $guest) {
            if ($guest->id == $userID) {
                $userAllowedInBusinessCase = true;
                $isGuest = true;
            }
        }
        
        if ($dialog->tetatet == '0' && $isParticipant) {
            $userAllowedInDialog = true;
        } elseif ($dialog->tetatet == '1' && ($isGuest || $isParticipant)) {
            $dialogUsers = $dialog->users()->get();
            foreach ($dialogUsers as $user) {
                if ($user->id == $userID) {
                    $userAllowedInDialog = true;
                }
            }
        }
        
        if (\Gate::check('Операции-с-делами')) {
            $userAllowedInBusinessCase = true;
        }
        if (\Gate::check('Операции-с-диалогами')) {
            $userAllowedInDialog = true;
        }

        if (!$userAllowedInBusinessCase | !$userAllowedInDialog) {
            return false;
        }

        return true;
    }
}
