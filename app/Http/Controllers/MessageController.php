<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; // Make sure this is included
use App\Mail\MessageNotification; 
use Illuminate\Support\Facades\Log;
use App\Models\Shop;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);
    
        try {
            // Create the message
            $message = Message::create([
                'sender_id' => auth()->id(),
                'recipient_id' => $request->recipient_id,
                'message' => $request->message,
            ]);

            $user = Auth::user();
            $recipient = User::find($request->recipient_id);

            $lastMessage = Message::where(function ($query) use ($user, $recipient) {
                $query->where('sender_id', $user->id)
                      ->where('recipient_id', $recipient->id);
            })->orWhere(function ($query) use ($user, $recipient) {
                $query->where('sender_id', $recipient->id)
                      ->where('recipient_id', $user->id);
            })->orderBy('created_at', 'desc')->first();

            // Broadcast the message event
            broadcast(new MessageSent($user, $message))->toOthers();
            if ($lastMessage && $lastMessage->created_at->diffInMinutes(now()) > 30) {
                Mail::to($recipient->email)->send(new MessageNotification($message->message, $user->first_name . ' ' . $user->last_name));
            }
            // Fetch the updated contact list
            $contacts = DB::table('messages as m')
                ->selectRaw('CASE WHEN m.sender_id = ? THEN m.recipient_id ELSE m.sender_id END as contact_id', [auth()->id()])
                ->addSelect(DB::raw("CONCAT(u.first_name, ' ', u.last_name) as name"))
                ->addSelect(DB::raw('MAX(m.created_at) as last_message_time'))
                ->addSelect(DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(m.message ORDER BY m.created_at DESC), ",", 1) as last_message')) // Get the last message content
                ->join('users as u', function($join) {
                    $join->on('u.id', '=', DB::raw('CASE WHEN m.sender_id = '.auth()->id().' THEN m.recipient_id ELSE m.sender_id END'));
                })
                ->where(function($query) {
                    $query->where('m.sender_id', auth()->id())
                        ->orWhere('m.recipient_id', auth()->id());
                })
                ->groupBy('contact_id', 'name')
                ->orderBy('last_message_time', 'desc')
                ->get();
    
            // Send the updated contacts back to the sender
            return response()->json(['success' => true, 'message' => $message, 'contacts' => $contacts]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    
    // get chat messages
    public function fetchMessages(Request $request, $recipientId)
    {
        $userId = Auth::id();
    
        try {
            // Mark messages as read when fetching them
            Message::where('sender_id', $recipientId)
                ->where('recipient_id', $userId)
                ->update(['is_read' => true]);
    
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
            ->addSelect(DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(m.message ORDER BY m.created_at DESC), ",", 1) as last_message')) //last message
            ->addSelect(DB::raw('SUM(CASE WHEN m.is_read = 0 AND m.recipient_id = '.$userId.' THEN 1 ELSE 0 END) as unread_count')) //unread
            ->addSelect('u.profile_picture') 
            ->join('users as u', function($join) use ($userId) {
                $join->on('u.id', '=', DB::raw('CASE WHEN m.sender_id = '.$userId.' THEN m.recipient_id ELSE m.sender_id END'));
            })
            ->where(function($query) use ($userId) {
                $query->where('m.sender_id', $userId)
                    ->orWhere('m.recipient_id', $userId);
            })
            ->groupBy('contact_id', 'name', 'u.profile_picture')
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

    //search user
    public function searchUsers(Request $request)
    {
        $query = $request->get('query');
        $userId = auth()->id();
        $roleId = auth()->user()->role_id; 
    
        $nameParts = explode(' ', $query);
        $firstName = isset($nameParts[0]) ? $nameParts[0] : null;
        $lastName = isset($nameParts[1]) ? $nameParts[1] : null;
    
        $users = User::query();
    
        if ($roleId == 1) {
            $contactedUserIds = DB::table('messages')
                ->where('sender_id', $userId)
                ->orWhere('recipient_id', $userId)
                ->pluck('recipient_id')
                ->merge(
                    DB::table('messages')
                        ->where('sender_id', $userId)
                        ->orWhere('recipient_id', $userId)
                        ->pluck('sender_id')
                )->unique();
    
            $users->whereIn('id', $contactedUserIds);
        }
    
        if ($firstName) {
            $users->where('first_name', 'LIKE', "%{$firstName}%");
        }
    
        if ($lastName) {
            $users->where('last_name', 'LIKE', "%{$lastName}%");
        }
    
        // Include the profile_picture in the response
        return response()->json($users->get(['id', 'first_name', 'last_name', 'profile_picture']));
    }


    public function email()
    {
        return view('components.emailers.message_notification');
    }

    public function getShopUserId(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'message' => 'required|string|max:1000',
        ]);
    
        $shop = Shop::find($request->shop_id);
    
        if ($shop) {
            $senderId = $shop->user_id;
            $recipientId = auth()->id();
    
            // Check if the user is logged in
            if (auth()->check()) {
                // Create the message
                $message = Message::create([
                    'sender_id' => $senderId, 
                    'recipient_id' => $recipientId, 
                    'message' => $request->message,
                ]);
    
                // Broadcast the message
                broadcast(new MessageSent(auth()->user(), $message))->toOthers();
    
                return response()->json([
                    'success' => true,
                    'sender_id' => $senderId, 
                    'message' => $message,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to receive a message.',
                ], 403);
            }
        }
    
        return response()->json(['success' => false, 'message' => 'Shop not found.']);
    }
    
}