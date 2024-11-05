<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);
    
        try {
            $message = Message::create([
                'sender_id' => auth()->id(),
                'recipient_id' => $request->recipient_id,
                'message' => $request->message,
            ]);

            $user = Auth::user();
    
            broadcast(new MessageSent($user, $message))->toOthers();
    
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    // get chat messages
    public function fetchMessages(Request $request, $recipientId)
    {
        $userId = Auth::id();
    
        try {
            $messages = Message::where(function ($query) use ($userId, $recipientId) {
                $query->where('sender_id', $userId)->where('recipient_id', $recipientId);
            })->orWhere(function ($query) use ($userId, $recipientId) {
                $query->where('sender_id', $recipientId)->where('recipient_id', $userId);
            })->orderBy('created_at', 'asc')->get();
    
            return response()->json($messages);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    //contact list 
    public function getChatContacts(Request $request)
    {
        $userId = auth()->id();

        $contacts = DB::table('messages as m')
            ->selectRaw('CASE WHEN m.sender_id = ? THEN m.recipient_id ELSE m.sender_id END as contact_id', [$userId])
            ->addSelect(DB::raw("CONCAT(u.first_name, ' ', u.last_name) as name"))
            ->addSelect(DB::raw('MAX(m.created_at) as last_message_time'))
            ->addSelect(DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(m.message ORDER BY m.created_at DESC), ",", 1) as last_message')) // Get the last message content
            ->join('users as u', function($join) use ($userId) {
                $join->on('u.id', '=', DB::raw('CASE WHEN m.sender_id = '.$userId.' THEN m.recipient_id ELSE m.sender_id END'));
            })
            ->where(function($query) use ($userId) {
                $query->where('m.sender_id', $userId)
                    ->orWhere('m.recipient_id', $userId);
            })
            ->groupBy('contact_id', 'name')
            ->orderBy('last_message_time', 'desc')
            ->get();

        $messages = Message::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();


        
            switch (auth()->user()->role_id) {
                case 3:
                    return view('livewire.admin.admin-chat', compact('contacts', 'messages'));
                case 2:
                    return view('livewire.shop.shop-chat', compact('contacts', 'messages'));
                case 1:
                default: 
                    return view('livewire.user-chat', compact('contacts', 'messages'));
            }        
        
    }

    //faqs button to chat admin 
    public function startChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'is_admin' => 'required|boolean', 
        ]);

        $admin = User::where('role_id', 3)->first();

        if (!$admin) {
            return response()->json(['success' => false, 'message' => 'Admin not found.']);
        }

        $senderId = $request->is_admin ? $admin->id : auth()->id();
        $recipientId = $request->is_admin ? auth()->id() : $admin->id; 

        Message::create([
            'sender_id' => $senderId,
            'recipient_id' => $recipientId,
            'message' => $request->message,
        ]);

        return response()->json(['success' => true]);
    }
    
}
