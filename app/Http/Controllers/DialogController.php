<?php

namespace App\Http\Controllers;

use App\Http\Traits\DialogAccessTrait as DialogAccess;
use \App\Http\Traits\BusinessCaseTrait;
use \App\Models\Dialog;
use Illuminate\Http\Request;
use \App\User;
use \App\Models\BusinessCase;
use \App\Models\Message;

class DialogController extends Controller
{
    public function create($businessCaseSlug) {
        $businessCase = BusinessCase::where('slug', '=', $businessCaseSlug)->first();
        if (!$businessCase) abort(404);
        $users = User::all();
        return view('dialog.create', ['businessCase' => $businessCase, 'users' => $users]);
    }
    public function edit($businessCaseSlug, $dialogID) {
        $users = User::all();
        $businessCase = BusinessCase::with('users')->where('slug', '=', $businessCaseSlug)->first();
        if (!$businessCase) abort(404);
        $dialog = Dialog::with('users')->where('id', '=', $dialogID)->first();
        if (!$dialog) abort(404);
        $userIDs = Array();
        foreach ($dialog->users as $user) array_push($userIDs, $user->id);
        $userIDs =  implode(', ', $userIDs);
        return view('dialog.edit', ['dialog' => $dialog, 'businessCase' => $businessCase, 'users' => $users, 'userIDs' => $userIDs]);
    }
    public function store($businessCaseSlug, Request $request)
    {
        $businessCase = BusinessCase::where('slug', '=', $businessCaseSlug)->first();
        if (!$businessCase) abort(404);

        if (\Gate::check('Операции-с-делами')) {
            $this->validate($request, [
                'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— !@#$%^&*]+$/u',
                'users' => ['nullable', 'regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/'],
                'pinned' => 'regex:/^1$/',
                'tetatet' => 'regex:/^1$/'
            ], [
                'title.required' => 'Название диалога - необходимое поле.',
                'title.regex' => 'Название диалога может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " — ! @ # $ % ^ & *).',
                'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
                'pinned.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
                'tetatet.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.'
            ]);
            $pinned = ( isset($request->pinned) ) ? '1' : '0';
            $tetatet = ( isset($request->tetatet) ) ? '1' : '0';
        }
        else {
            $this->validate($request, [
                'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— !@#$%^&*]+$/u',
                'users' => ['nullable', 'regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/'],
                'tetatet' => 'regex:/^1$/'
            ], [
                'title.required' => 'Название диалога - необходимое поле.',
                'title.regex' => 'Название диалога может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " — ! @ # $ % ^ & *).',
                'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
                'tetatet.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.'
            ]);
            $pinned = '0';
            $tetatet = ( isset($request->tetatet) ) ? '1' : '0';
        }

        //  Create DB entry
        $dialog = Dialog::create([
            'title' => $request->title,
            'pinned' => $pinned,
            'tetatet' => $tetatet,
            'isArchived' => '0'
        ]);

        // Link a dialog
        $dialog->business_case()->associate($businessCase->id);
        if ($tetatet == '1') {
            $users = explode(',', $request->users);
            $dialog->users()->sync($users);
            $BCusers = $businessCase->users()->get();
            $BCUsersList = array();
            foreach ($BCusers as $user) {
                $BCUsersList[] = $user->id;
            }
            $guestUsers = array_diff($users, $BCUsersList);
            if (count($guestUsers) > 0) {
                foreach ($guestUsers as $user) {
                    $businessCase->guests()->syncWithoutDetaching([$user => ['is_guest' => 1]]);
                }
            }
        }

        $dialog->save();
        return redirect()->to('/cases/'.$businessCase->slug)->with('success', 'Диалог успешно создан!');
    }
    public function update($businessCaseSlug, $dialogID, Request $request) {
        $businessCase = BusinessCase::with('users')->where('slug', '=', $businessCaseSlug)->first();
        if (!$businessCase) abort(404);
        $dialog = Dialog::with('users')->where('id', '=', $dialogID)->first();
        if (!$dialog) abort(404);

        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— ]+$/u',
            'users' => 'regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/',
            'pinned' => 'regex:/^1$/',
            'tetatet' => 'regex:/^1$/'
        ],[
            'title.required' => 'Название диалога - необходимое поле.',
            'title.regex' => 'Название диалога может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " —).',
            'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
            'pinned.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
            'tetatet.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.'
        ]);
        $pinned = ( isset($request->pinned) ) ? '1' : '0';
        $tetatet = ( isset($request->tetatet) ) ? '1' : '0';

        $dialog->title = $request->title;
        $dialog->pinned = ($request->pinned) ? 1 : 0;
        $dialog->tetatet = ($request->tetatet) ? 1 : 0;
        $users = explode(',', $request->users);
        $dialog->users()->sync($users);

        if ($tetatet == '1') {
            $BCusers = $businessCase->users()->get();
            $BCUsersList = array();
            foreach ($BCusers as $user) {
                $BCUsersList[] = $user->id;
            }
            $guestUsers = array_diff($users, $BCUsersList);
            if (count($guestUsers) > 0) {
                foreach ($guestUsers as $user) {
                    $businessCase->guests()->syncWithoutDetaching([$user => ['is_guest' => 1]]);
                }
            }
        }

        $guestUsers = BusinessCaseTrait::getAllGuestsCount($businessCase);
        foreach ($guestUsers as $id => $guest) {
            if ($guest == 0) $businessCase->guests()->detach($id);
        }

        $dialog->save();

        return redirect()->to('/cases/'.$businessCase->slug)->with('success', 'Диалог успешно изменён!');
    }
    public function show($businessCaseSlug, $dialogID) {
        $businessCase = BusinessCase::where('slug', '=', $businessCaseSlug)->first();
        if (!$businessCase) abort(404);
        $dialog = Dialog::with('users')->with('messages')->where('id', '=', $dialogID)->first();
        if (!$dialog) abort(404);

        $refresh_time = date_format(now(),"Y-m-d H:i:s");
        $messages = $dialog->messages()->orderBy('created_at', 'desc')->take(10)->get();
        $messages = $messages->reverse();
        $users = $dialog->users()->get();

        if ($dialog->isArchived == '1' && !\Gate::check('Операции-с-архивом')) {
            return redirect()->to('/cases/'.$businessCaseSlug)->with('errors', 'Диалог удален!');
        }

        $access = false;
        if ($dialog->tetatet == '1') {
            if (\Gate::check('Операции-с-диалогами'))
                $access = true;
            else {
                foreach ($users as $user) {
                    if ($user->id == \Auth::user()->id) $access = true;
                }
            }
        } else $access = true;

        if (!$access) return redirect()->back()->with('errors', 'У Вас нет доступа к этому диалогу!');

        return view('dialog.show', [
            'businessCase' => $businessCase,
            'dialog' => $dialog,
            'messages' => $messages,
            'users' => $users,
            'refresh_time' => $refresh_time
        ]);
    }
    public function archive($businessCaseSlug, $dialogID) {
        $businessCase = BusinessCase::with('users')
            ->with('guests')
            ->where('slug', $businessCaseSlug)
            ->first();
        if (!$businessCase) abort(404);
        $dialog = Dialog::where([['id', '=', $dialogID], ['isArchived', '0']])->first();
        if (!$dialog) abort(404);

        $dialog->isArchived = '1';
        $dialog->save();
        $guestUsers = BusinessCaseTrait::getAllGuestsCount($businessCase);
        foreach ($guestUsers as $id => $guest) {
            if ($guest == 0) $businessCase->guests()->detach($id);
        }
        return redirect()->to('/cases/'.$businessCaseSlug)->with('success', 'Диалог успешно архивирован');
    }
    public function archiveList($businessCaseSlug) {
        $this->middleware(['auth','permission:Операции-с-архивом']);
        $businessCase = BusinessCase::with('users')
            ->where('slug', $businessCaseSlug)
            ->first();
        if (!$businessCase) abort(404);
        $piblicDialogs = Dialog::with('users')->where([
            ['business_case_id', '=', $businessCase->id],
            ['tetatet', '=', '0'],
            ['isArchived', '1']
        ])->orderBy('pinned', 'DESC')
            ->orderBy('title', 'ASC')
            ->get();
        $tetatetDialogs = Dialog::with('users')->where([
            ['business_case_id', '=', $businessCase->id],
            ['tetatet', '=', '1'],
            ['isArchived', '1']
        ])->orderBy('pinned', 'DESC')
            ->orderBy('title', 'ASC')
            ->get();
        $businessCaseUsers = $businessCase->users()->get();

        return view('dialog.archive', [
            'businessCase' => $businessCase,
            'publicDialogs' => $piblicDialogs,
            'tetatetDialogs' => $tetatetDialogs,
            'businessCaseUsers' => $businessCaseUsers
        ]);
    }
    public function restore($businessCaseSlug, $dialogId) {
        $businessCase = BusinessCase::with('users')
            ->with('guests')
            ->where('slug', $businessCaseSlug)
            ->first();
        if (!$businessCase) abort(404);
        $dialog = Dialog::with('users')
            ->where('id', $dialogId)
            ->first();
        if (!$dialog) abort(404);

        $dialog->isArchived = '0';
        $dialog->save();

        $dialogUsers = $dialog->users()->get();
        $users = array();
        foreach ($dialogUsers as $dialogUser) {
            $users[] = $dialogUser->id;
        }
        if ($dialog->tetatet == '1') {
            $BCusers = $businessCase->users()->get();
            $BCUsersList = array();
            foreach ($BCusers as $user) {
                $BCUsersList[] = $user->id;
            }
            $guestUsers = array_diff($users, $BCUsersList);
            if (count($guestUsers) > 0) {
                foreach ($guestUsers as $user) {
                    $businessCase->guests()->syncWithoutDetaching([$user => ['is_guest' => 1]]);
                }
            }
        }

        return redirect()->back()->with('success', 'Диалог успешно восстановлен!');
    }
    public function refresh($businessCaseSlug, $dialogID, Request $request) {
        if (!DialogAccess::check($businessCaseSlug, $dialogID)) {
            $response['status'] = '403';
            return json_encode($response);
        }

        // Check for new messages
        $scanFrom = $request->last_updated;
        $newMessages = Message::where([['dialog_id', $dialogID], ['updated_at', '>', $scanFrom]])->orderBy('created_at', 'ASC')->get();
        $response['last_updated'] = date_format(now(),"Y-m-d H:i:s");
        foreach ($newMessages as $message) {
            $messageArray = [
                'id' => $message->id,
                'body' => $message->body,
                'pushMessage' => ($message->created_at->format('Y-m-d H:i:s') > $scanFrom),
                'updateMessage' => ($message->updated_at->format('Y-m-d H:i:s') != $message->created_at->format('Y-m-d H:i:s') && $message->updated_at->format('Y-m-d H:i:s') > $scanFrom),
                'deleteMessage' => ($message->isArchived && $message->updated_at > $scanFrom),
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $message->updated_at->format('Y-m-d H:i:s'),
                'time_precise' => date_format($message->created_at,"d.m.Y H:i:s"),
                'time_locale' => \Jenssegers\Date\Date::parse($message->created_at)->format('j F Y в H:i'),
                'user_id' => $message->user_id,
                'author' => User::find($message->user_id)->fullname,
                'isArchived' => $message->isArchived,
                'isOwner' => (\Auth::user()->id == $message->user_id)
            ];

            $response['messages'][] = $messageArray;
        }

        if (array_key_exists('messages', $response) && count($response['messages']) > 0) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'no-new';
        }

        return json_encode($response);
    }
    public function loadup($businessCaseSlug, $dialogID, Request $request) {
        if (!DialogAccess::check($businessCaseSlug, $dialogID)) {
            $response['status'] = '403';
            return json_encode($response);
        }

        $topMessageID = $request->id;
        $messages = Message::where('dialog_id', $dialogID)->orderBy('created_at', 'DESC')->get();

        //  Get 10 messages after certain id.
        $count = 0;
        $unset = true;
        $newMessages = [];
        foreach ($messages as $key => $message) {
            if ($unset)
                unset($messages[$key]);
            else {
                if ($count < 10) {
                    $newMessages[] = $message;
                    $count++;
                }
                else
                    break;
            }

            if ($message->id == $topMessageID)
                $unset = false;
        }

        if (count($newMessages) == 0) {
            $response['status'] = 'no-new';
            return json_encode($response);
        }

        //  Form message HTML.
        $response = [];
        foreach ($newMessages as $message) {
            $messageHTML = '<div class="message';

            // Push message to right side
            if (\Auth::user()->id == $message->user_id) $messageHTML .= ' owner';

            // Message info
            $messageHTML .= '" id="chat-message-' . $message->id . '">' .
                '<div class="message-info">' .
                '<div class="sender">' .
                User::find($message->user_id)->fullname . '</div>' .
                '<label title="' .
                date_format($message->created_at,"d.m.Y H:i:s") .
                '" class="date">' .
                \Jenssegers\Date\Date::parse($message->created_at)->format('j F Y в H:i') .
                '<span class="edit-mark" ';

            //  Edit mark display
            if (!$message->edited)
                $messageHTML .= 'style="display:none"';

            $messageHTML .= '>&nbsp;(ред.)</span></label></div><div class="messageBody">';

            // Message content
            if ($message->isArchived)
                $messageHTML .= '<p>[Сообщение удалено]</p>';
            else
                $messageHTML .= $message->body;

            $messageHTML .= '</div>';

            // Reply button
            $messageHTML .= '<div class="reply" onclick="reply(this)"';
            if ($message->isArchived) $messageHTML .= ' style="display:none"';
            $messageHTML .= '>Ответить</div>';

            if (\Auth::user()->id == $message->user_id) {
                // Tooltip text
                $messageHTML .= '<div class="message-tooltip">…<span class="message-tooltip-text">';

                // Tooltip content
                $messageHTML .= '<span onclick="editMessage(' . $message->id . ')"';
                if ($message->isArchived) $messageHTML .= ' style="display: none"';
                $messageHTML .= '>Редакитровать</span><span onclick="deleteAndRestoreMessage(' . $message->id . ', 0)"';
                if ($message->isArchived) $messageHTML .= ' style="display: none"';
                $messageHTML .= '>Удалить</span><span onclick="deleteAndRestoreMessage(' . $message->id . ', 1)"';
                if (!$message->isArchived) $messageHTML .= ' style="display: none"';
                $messageHTML .= '>Восстановить</span></span></div></div>';
            }

            $response['messages'][] = $messageHTML;
        }

        $response['status'] = 'success';

        return json_encode($response);
    }
}
