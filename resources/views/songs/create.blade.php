@extends('layouts.app')
@section('content')
	<h2>Add a new song :)</h2>
	<form method="post" action="/songs" enctype="multipart/form-data">
		@csrf
	   <input type="hidden" name="list-id" value="{{ $listId }}">
	  <div class="form-group">
	    <label for="title">Title</label>
	    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
	  </div>
	  <div class="form-group">
	    <label for="artis">Artist</label>
	    <input type="text" class="form-control" id="artist" name="artist" placeholder="Enter artist name">
	  </div>
	  <div class="form-group">
	    <label for="name">Album name</label>
	    <input type="text" class="form-control" id="name" name="name" placeholder="Enter album name">
	  </div>
	  <div class="form-group">
	    <label for="year">Year</label>
	    <input type="number" class="form-control" id="year" name="year" placeholder="Enter year">
	  </div>
	  <div class="form-group">
	    <label for="cover-image">Cover image</label>
	    <input type="file" class="form-control" id="cover-image" name="cover-image">
	  </div>
	  <div class="form-group">
	    <label for="link">Spotify link</label>
	    <input type="text" class="form-control" id="link" name="link" placeholder="Enter link">
	  </div>
	 
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection
