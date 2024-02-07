<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets=Ticket::all();
         return view('ticket.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities=Priority::all();
        $labels=Label::all();
        $categories=Category::all();
        return view('ticket.create',compact('priorities','labels','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        // dd($request->all());
        // $image=$request->images;
        // $newName="gallery_".uniqid().".".$image->extension();
        // $image->storeAs("public/gallery",$newName);
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $newName="gallery_".uniqid().".".$file->extension();
                $imagePaths[]=$file->storeAs("public/gallery",$newName);
            }
        }
        $imagePathsString = implode(',', $imagePaths);
        // Store image paths as comma-separated string
        $ticket=new Ticket();
        $ticket->image=$imagePathsString;
        $ticket->title=$request->title;
        $ticket->description=$request->description;
        $ticket->priority_id=$request->priority_id;
        // $ticket->label_id=$request->label_id;
        // $ticket->category_id=$request->category_id;
        $ticket->labels()->attach($request['label_id']);
        $ticket->categories()->attach($request['category_id']);
        $ticket->save();
        return redirect()->route('ticket.create')->with('success','ticket is Saving Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.detail',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $priorities=Priority::all();
        $labels=Label::all();
        $categories=Category::all();
        return view('ticket.edit',compact('categories','priorities','labels','ticket'))->with('edit','Ticket is Editing Successful');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        if($request->image)
        {
            $image=$request->image;

            $newName="gallery_".uniqid().".".$image->extension();
            $image->storeAs("public/gallery",$newName);
           
            $ticket->title=$request->title;
            $ticket->description=$request->description;
            $ticket->priority_id=$request->priority_id;
            $ticket->label_id=$request->label_id;
            $ticket->category_id=$request->category_id;
            $ticket->image=$newName;
            $ticket->update();
            return redirect()->route('ticket.index')->with('update','Ticket is Updating Successful');
        }
            $ticket->title=$request->title;
            $ticket->description=$request->description;
            $ticket->priority_id=$request->priority_id;
            $ticket->label_id=$request->label_id;
            $ticket->category_id=$request->category_id;
            $ticket->update();
            return redirect()->route('ticket.index')->with('update','Ticket is Updating Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if($ticket)
        $ticket->delete();
    return redirect()->route('ticket.index')->with('delete','Ticket is Deleting Successful');
    }
}
