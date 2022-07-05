@extends('layouts.app')
@section('content')
	<h2>Create new list</h2>
	<form method="post" action="/lists" enctype="multipart/form-data">
		@csrf
	   <input type="hidden" name="user-id" >	
	  <div class="form-group">
	    <label for="title">Title</label>
	    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
	  </div>
	  <div class="form-group">
	    <label for="description">Description</label>
	    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
	  </div>
	  <div class="form-group">
	    <label for="cover-image">Cover image</label>
	    <input type="file" class="form-control" id="cover-image" name="cover-image">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection
