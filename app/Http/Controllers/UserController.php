<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUser()
    {
        $users = User::where('id' ,'!=', auth()->id())->get();
        return response()->json($users);
        // $senderId = auth()->id();
        // DB::statement("SET SESSION sql_mode=''");
        // $recentMessages = Chat::where(function($query) use($senderId) {
        //     $query->where('sender_id', $senderId)
        //         ->orWhere('receiver_id', $senderId)
        //         ->latest()->first();
        // })
        // ->groupBy('sender_id', 'receiver_id')
        // ->select('sender_id', 'receiver_id', 'message')
        // ->limit(30)
        // ->get();

        // $recentUsersMessage = [];
        // $usedUserIds = [];
        // foreach ($recentMessages as $message) {
        //     $userId = $message->sender_id == $senderId ? $message->receiver_id : $message->sender_id;
        //     if(!in_array($userId, $usedUserIds)){
        //         $recentUsersMessage[] = [
        //             'id' => $userId,
        //             'message' => $message->message,
        //         ];
        //         $usedUserIds[] = $userId;
        //     }
        // }

        // foreach($recentUsersMessage as $key => $userMessage){
        //     $recentUsersMessage[$key]['user'] = User::where('id', $userMessage['id'])->get()->all()[0];
        // }
        // return response()->json($recentUsersMessage);
    }

    public function getAuthUser() 
    {
        return auth()->user();

    }
}
