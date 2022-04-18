<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UsersController extends Controller
{
    public function index()
    {
        // Manegement
//        $otherUsers = User::orderByDesc(
//            Message::select('id')
//                ->whereColumn('user_id', 'users.id')
//                ->orderByDesc('created_at')
//                ->limit(1)
//        )->whereType('user')->get();

//        $filteredUsers = User::orderByDesc(
//            Message::select('id')
//                ->whereColumn('user_id', 'users.id')
//                ->orderByDesc('created_at')
//                ->limit(1)
//        )->whereType('user')->where('id', '!=', $this->receiver_id)->where('id', '!=', $this->receiver_id)->Where('name', 'like', '%' . $this->q . '%')->pluck('id')->toArray();


        // nabil
//        $conversations = Conversation::where('sender_id', auth()->id)->orWhere('receiver_id', auth()->id)->orderBy('updated_at', 'desc')->paginate(10);
//        $data = new conversationCollection($conversations);

        // Mahmoud
        $query = User::orderBy(Message::select('created_at')
            ->whereColumn('messages.sender_id', 'users.id')
            ->latest()
            ->take(1)
            ,'ASC')
            ->where('id', '!=', auth()->id())
        ->paginate(20);

        return UserResource::collection($query);


    }
}
