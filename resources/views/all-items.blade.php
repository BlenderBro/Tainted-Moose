@extends('layouts.app')

@section('content')

<style media="screen">
.col-centered{
	float: none;
	margin: 0 auto;
	}
	.container{
	margin-top:20px;
	}
	.image-preview-input {
	position: relative;
	overflow: hidden;
	margin: 0px;
	color: #333;
	background-color: #fff;
	border-color: #ccc;
	}
	.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
	}
	.image-preview-input-title {
	margin-left:2px;
	}
	table tr td:last-child {
    white-space: nowrap;
    width: 1px;
}
</style>
<div class="container">
	<h1>All Items</h1>
<div class="row">
	<div class="col-md-11 col-centered">
		<div class="panel panel-default">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Client</th>
	  <th>Actions</th>
    </tr>
  </thead>
  <tbody>
	@foreach ($items as $item)

    <tr>
      <th scope="row">1</th>
      <td>{{$item->title}}</td>
      <td>{{$item->client}}</td>
	  <td>
		  	<div>
				<a href="{{ url('edit-item/'.$item->slug)}}" type="button" class="btn btn-success">Edit</a>
				<a href="{{ url('delete/'.$item->id.'?_token='.csrf_token())}}" type="button" class="btn btn-danger">Delete</a>
			</div>
	  </td>
    </tr>

		@endforeach

  </tbody>
</table>
</div>
</div>
</div>
</div>
@endsection
