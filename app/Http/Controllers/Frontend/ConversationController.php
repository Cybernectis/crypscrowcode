<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
use App\Events\NewMessage;
class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conversation = new Conversation;
        $conversation->message = $request->message;
        $conversation->group_id = $request->group_id;
        $conversation->user_id = auth()->user()->id;
        $conversation->save();

        broadcast(new NewMessage($conversation))->toOthers();
        $conversations = $conversation->load('user');
        $conversations->user['picture'] = $conversation->user->picture;
        $conversations->time = \Carbon\Carbon::createFromTimeStamp(strtotime($conversations->created_at))->diffForHumans();
        return $conversations;
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($id)
    {
        $conversations = Conversation::where("group_id", $id)->with('user')->get();
       
        $conversations->map(function ($item) {
            $item['user']['picture'] = $item['user']->picture;
            $item['time'] = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();
            return $item;
          });
       
      return $conversations;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
