@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  <h3>{{ $list->title}}</h3>  <a href="/home" class="btn btn-sm btn-info float-right">Go back</a>
                     <p> {{ $list->description}}</p> 
                    <a href="/songs/create/{{$list->id}}"class="btn btn-sm btn-primary float-right">Add songs to the list!</a>
                </div>

                
                   @if(count($list->song) > 0) 
                       @foreach($list->song as $song)
                       <div class="card-body">
                       <h2>Title: {{ $song->title}}</h2>
                      <img src="/storage/albums/{{ $song->lists_id}}/{{$song->photo}}" width="250px">
                       <p> Album: {{ $song->album_name }}</p> 
                       <p> Artist: {{ $song->artist }}</p> 
                       <p> Year: {{ $song->year }}</p>
                       <a href="{{ $song->link }}" target="_blank">Listen on Spotify</a>
                       <div class="btn-group float-right">
                          <!-- <a type="button" class="btn btn-info btn-outline-secondary" href="/lists">View</a> -->
                          <form action="{{ route('song-destroy', $song->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="button" class="btn btn-sm btn-danger">DELETE</button>
                          </form>  
                    　　</div> 
                     <hr>
                     </div>
                       @endforeach
                   @else
                        <p>No list yet!</p>
                   @endif         
                   <!--  {{ __('You are logged in!') }} -->
                
            </div>
        </div>
    </div>
</div>
@endsection