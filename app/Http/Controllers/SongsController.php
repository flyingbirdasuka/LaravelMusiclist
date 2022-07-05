<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Storage; 

class SongsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $listId)
    {
        return view('songs.create')->with('listId',$listId);
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
            'artist' => 'required',
            'name' => 'required',
            'year' => 'required',
            'cover-image' => 'required|image',
            'link' => 'required',
        ]);
        $filenameWithExtension = $request->file('cover-image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('cover-image')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $request->file('cover-image')->storeAs('public/albums/' . $request->input('list-id'), $filenameToStore);

        $song = new Song();
        $song->title = $request->input('title');
        $song->artist = $request->input('artist');
        $song->album_name = $request->input('name');
        $song->year = $request->input('year');
        $song->link = $request->input('link');
        $song->photo = $filenameToStore;
        $song->lists_id = $request->input('list-id');
        $song->save();
        return redirect('/lists/'. $request->input('list-id'))->with('status', 'A new song uploaded succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = Song::find($id);
        if($song){
            Storage::delete('/public/albums/' . $song->lists_id . '/' . $song->photo);
            $song->delete();
            return redirect('/')->with('status', 'Song deleted succesfully!');
        }
    }
}
