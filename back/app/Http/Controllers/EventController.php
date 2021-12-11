<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEvent()
    {
        return Event::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'country' => 'required',
            'city' => 'required',
            'description' => 'required',
            'dateStart' => 'required|before:dateEnd',
            'dateEnd' => 'required|after:dateStart',
            'category_id'=>'required',
            'picture' =>'image|mimes:jpg,png,jpeg,gif|max:19999',
        ]);
        $request->file('picture')->store('public/pictures');

        $event = new Event();
        $event->title = $request->title;
        $event->dateStart = $request->dateStart;
        $event->dateEnd = $request->dateEnd;
        $event->country = $request->country;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->picture = $request->file('picture')->hashName();

        $event->save();
        return response()->json(['message'=> 'Event Created', 'data'=> $event], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOneEvent($id)
    {
        return Event::findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEvent(Request $request, $id)
    {   
        $request->validate([
            'title' => 'required',
            'country' => 'required',
            'city' => 'required',
            'description' => 'required',
            'dateStart' => 'required|before:dateEnd',
            'dateEnd' => 'required|after:dateStart',
            'category_id'=>'required',
            // 'picture' =>'image|mimes:jpg,png,jpeg,gif|max:19999',
            'picture' => 'nullable'
        ]);
        
        // $request->file('picture')->store('public/pictures');
        // $name = $request->file('image')->getClientOriginalName();

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->dateStart = $request->dateStart;
        $event->dateEnd = $request->dateEnd;
        $event->country = $request->country;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->picture = $request->picture;
        // $event->picture = $request->file('picture')->hashName();

        $event->save();
        return response()->json(['message'=> 'Event Updated',"data"=>$request->picture], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent($id)
    {
        return Event::destroy($id);
    }
    
    /**
     * search the specified Event from database.
     *
     * @param  int  $categoryname
     * @return \Illuminate\Http\Response
     */
    public function searchEvent($title)
    {
        return Event::where('title','like','%'.$title.'%')->get();
    }

}
