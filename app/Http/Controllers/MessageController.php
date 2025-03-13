<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewMessageEvent;


class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'mechanic_id' => 'required|exists:mechanics,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'customer_id' => auth()->id(),
            'mechanic_id' => $request->mechanic_id,
            'message' => $request->message,
        ]);

        broadcast(new \App\Events\NewMessageEvent($message))->toOthers();

        return response()->json(['message' => 'Message sent!', 'data' => $message], 201);
    }

    public function getMessages($mechanicId)
    {
        $messages = Message::where('customer_id', auth()->id())
            ->where('mechanic_id', $mechanicId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
}

