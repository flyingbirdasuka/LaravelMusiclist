<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lists;
use App\Models\User;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class ListsController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth',['except'=>'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Lists::get();

        return view('lists.index')->with('lists',$lists);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('lists.create');
    }
        
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'cover-image' => 'image',
        ]);
        $filenameWithExtension = $request->file('cover-image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('cover-image')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $request->file('cover-image')->storeAs('public/album-covers', $filenameToStore);

        $list = new Lists();
        $list->title = $request->input('title');
        $list->description = $request->input('description');
        $list->cover_image = $filenameToStore;
        $list->user_id = Auth::id();
        $list->save();
        return redirect('/home')->with('status', 'Created succesfully!');
    }
  


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = Lists::with('song')->find($id);
        return view('lists.show')->with('list', $list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = Lists::find($id);
        if($list){
            Storage::delete('/public/album-covers' . $list->cover_image);
            $list->delete();
            return redirect('/home')->with('status', 'List deleted succesfully!');
        }
    }
}
