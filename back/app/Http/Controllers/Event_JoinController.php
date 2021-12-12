<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_Join;

class Event_JoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event_Join::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event_join = new Event_Join();
        $event_join->user_id = $request->user_id;
        $event_join->event_id = $request->event_id;
        $event_join->role = $request->role;
        $event_join->save();
        return response()->json(["message"=>"created"],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMemberJoinEvent($eventId)
    {
        // When you provide Id of the event you will get all member user that join event
        $event_join_members = Event_Join::join('users', 'users.id', '=', 'event__joins.user_id')
              ->join('events', 'events.id', '=', 'event__joins.event_id')
              ->where([['event__joins.event_id','=',$eventId],['event__joins.role','=','member']])
              ->get(['users.*','event__joins.role']);
        return $event_join_members;
    }

    // When you provide Id of the user you will get all event of that user has joined
    public function getEventOfUserHasJoin($userId){
        $event_user_joined = Event_Join::join('users', 'users.id', '=', 'event__joins.user_id')
              ->join('events', 'events.id', '=', 'event__joins.event_id')
              ->where([['event__joins.user_id','=',$userId],['event__joins.role','=','member']])
              ->get(['events.id']);
        return $event_user_joined;
    }

    // When you provide Id of the user you will get all event of that user has created
    public function getEventOfUser($userId){
        $event_user = Event_Join::join('users', 'users.id', '=', 'event__joins.user_id')
              ->join('events', 'events.id', '=', 'event__joins.event_id')
              ->where([['event__joins.user_id','=',$userId],['event__joins.role','=','creator']])
              ->orderBy('event__joins.event_id', 'DESC')
              ->get(['events.*','event__joins.role', 'users.*']);
        return $event_user;
    }

    // When you provide Id of the user you will get all event of that user has created
    public function getEvent($userId){
        $event_user = Event_Join::join('users', 'users.id', '=', 'event__joins.user_id')
              ->join('events', 'events.id', '=', 'event__joins.event_id')
              ->where([['event__joins.user_id','!=',$userId],['event__joins.role','=','creator']])
              ->orderBy('event__joins.event_id', 'DESC')
              ->get(['events.*','users.name', 'event__joins.role']);
        return $event_user;
    }

    // Get Id To quit from event
    public function getEvent_Join_Id($eventId,$userId){
        $event_join_id = Event_Join::join('users', 'users.id', '=', 'event__joins.user_id')
              ->join('events', 'events.id', '=', 'event__joins.event_id')
              ->where([['event__joins.event_id','=',$eventId],['event__joins.user_id','=',$userId],['event__joins.role','=','member']])
              ->get(['event__joins.id']);
        return $event_join_id;
    }
    /**
     * 
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
    public function quitEvent($id)
    {
        $isDelete = Event_Join::destroy($id);
        if($isDelete){
            return response()->json(["message"=>"quited"],201);
        }
        return response()->json(["message"=>"quit_error"],404);
    }
}
