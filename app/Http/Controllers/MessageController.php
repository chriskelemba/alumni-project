<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MessageReceived;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $senderIds = Message::where('receiver_id', $user->id)
                            ->pluck('sender_id')
                            ->unique();

        $senders = User::whereIn('id', $senderIds)->get();

        return view('messages.index', [
            'senders' => $senders,
        ]);
    }

    public function send($userId)
    {
        $user = User::findOrFail($userId);

        return view('messages.create', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $validated['receiver_id'];
        $message->message = $validated['message'];
        $message->save();

        $receiver = User::find($request->receiver_id);
        $receiver->notify(new MessageReceived($message));

        return redirect()->route('messages.show', ['user' => $validated['receiver_id']])->with('success', 'Message sent successfully!');
    }

    public function showMessages(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return view('messages.view', [
            'user' => $user,
            'messages' => $messages
        ]);
    }
}
