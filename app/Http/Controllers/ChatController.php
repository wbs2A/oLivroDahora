<?php

namespace App\Http\Controllers;

use App\Model\Chat;
use App\Model\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friend = Auth::user()->friends()->get();
        return view('friend.index')->with(array('Friends'=>$friend));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $friend = User::find($id);
        return view('friend.chat')->withFriend($friend);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function getChat($id){
        $chats = Chat::where(function($query) use ($id){
            $query->where('user_id', '=', Auth::user()->iduser)->where('friend_id','=',$id);
        })->orWhere(function ($query) use ($id){
            $query->where('user_id','=',$id)->where('friend_id','=',Auth::user()->iduser);
        })->get();
        return $chats;
    }

    public function sendChat(Request $request){
        $chat = new Chat;
        $chat->user_id   =  $request->user_id;
        $chat->friend_id = $request->friend_id;
        $chat->chat      = $request->chat;
        $chat->save();
        return [];
    }
}
