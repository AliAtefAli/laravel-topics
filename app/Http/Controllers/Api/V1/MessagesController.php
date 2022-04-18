<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        // dd(Conversation::where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id())->first());
        return auth()
            ->user()
            ->messages()
            ->where(function ($query) {
                $query->bySender(request()->input('sender_id'))
                    ->byReceiver(auth()->id());
            })
            ->orWhere(function ($query) {
                $query->bySender(auth()->id())
                    ->byReceiver(request()->input('sender_id'));
            })
            ->get();
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id' => $request->input('sender_id'),
            'receiver_id' => $request->input('receiver_id'),
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($message));

        return $message->fresh();
    }

}
