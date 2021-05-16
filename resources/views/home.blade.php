@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your music lists :)
                    <a href="/lists/create"class="float-right">create a new list!</a>
                </div>
                   @if(count($lists) > 0) 
                       @foreach($lists as $list)
                       <div class="card-body">
                       <h3>{{ $list->title}}</h3>
                         <img src="/storage/album-covers/{{ $list->cover_image}}" width="250px">
                       <p> {{ $list->description}}</p> 
                       <div class="btn-group">
                          <a type="button" class="btn btn-info btn-outline-secondary" href="/lists/{{$list->id}}">View</a>
                           <form action="/lists/{{$list->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="button" class="btn btn-outline-secondary btn-danger" style=" border-top-left-radius: 0; border-bottom-left-radius: 0;">DELETE</button>
                          </form>  
                    　　</div> 
                     <hr>
                     </div>
                       @endforeach
                   @else
                        <p>No list yet!</p>
                   @endif         
                  
            </div>
        </div>
    </div>
</div>
@endsection

