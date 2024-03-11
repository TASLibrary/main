<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Message extends Controller
{
    /**
     * Reads a given Message
     * @param \App\Models\Message $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function read(\App\Models\Message $message)
    {
        return view('tas/message/read', ['message' => $message]);
    }

    /**
     * Lists Messages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $messages = \App\Models\Message::paginate(10);
        return view('tas/message/list', ['messages' => $messages]);
    }

    /**
     * Resolves a given Message
     * @param \App\Models\Message $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resolve(\App\Models\Message $message)
    {
        $message->resolve()->save();
        return redirect(route('message.list'))->with('status', 'Message is marked as resolved.');
    }
}
