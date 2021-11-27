<?php

namespace App\Http\Traits;

use \App\User;
use \App\Models\BusinessCase;
use \App\Models\Dialog;

trait BusinessCaseTrait
{
    public static function getAllGuestsCount($businessCase)
    {
        $guests = $businessCase->guests()->get();
        $guestIDs = array();
        foreach ($guests as $guest) {
            $guestIDs[$guest->id] = 0;
        }
        $dialogs = $businessCase->dialogs()->where('isArchived', '=', '0')->get();
        foreach ($dialogs as $dialog) {
            if ($dialog->tetatet == '1') {
                foreach ($dialog->users as $user) {
                    if (array_key_exists($user->id, $guestIDs)) {
                        $guestIDs[$user->id]++;
                    }
                }
            }
        }
        return $guestIDs;
    }

    public static function countDialogGuests($businessCase) {
        $bcUsersList = $businessCase->users()->get();
        $bcUsers = array();
        foreach ($bcUsersList as $user) {
            $bcUsers[] = $user->id;
        }
        $dialogs = $businessCase->dialogs()->where('isArchived', '0')->get();
        $guestIDs = array();
        foreach ($dialogs as $dialog) {
            if ($dialog->tetatet == '1') {
                $dialogUsers = $dialog->users()->get();
                foreach ($dialogUsers as $dialogUser) {
                    if (!in_array($dialogUser->id, $bcUsers)) {
                        $guestIDs[] = $dialogUser->id;
                    }
                }
            }
        }
        return $guestIDs;
    }
}
