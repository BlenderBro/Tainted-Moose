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
	</style>
<div class="container">
    <div class="row">
        <div class="col-md-11 col-centered">
            <div class="panel panel-default">
                <div class="panel-heading">Editeaza @if(!old('title')){{$item->title}}@endif{{ old('title') }}<p><a style="float:right;font-weight:700;" href="{{ URL('/all-items')}}">ALL ITEMS</a></p></div>

                <div class="panel-body">
                    <form class="" action="{{ action('PortfolioController@update') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="item_id" value="{{ $item->id }}{{ old('item_id') }}">
						<div style="margin-bottom: 3em;margin-top: 2em;" class="form-inline">
						    <label style="margin-right:1em;" for="exampleInputEmail1">Titlu</label>
						    <input style="min-width:18em;" type="text" class="form-control" name="title" id="title" value="@if(!old('title')){{$item->title}}@endif{{ old('title') }}">
							<label style="margin-right:1em;margin-left:1em;" for="exampleInputEmail1">Client</label>
						    <input style="min-width:18em;" type="text" class="form-control" name="client" id="client" value="@if(!old('client')){{$item->client}}@endif{{ old('client') }}">
							<label style="margin-right:1em;margin-left:1em;" for="exampleInputEmail1">Service</label>
						    <input style="min-width:18em;" type="text" class="form-control" name="services" id="services" value="@if(!old('services')){{$item->services}}@endif{{ old('services') }}">
						</div>

						<div class="form-group">
						    <textarea type="text" class="form-control" name="body" id="body">
								@if(!old('body'))
                                    {!! $item->body !!}
                              	@endif
                      			{!! old('body') !!}
						    </textarea>
						</div>
						<div class="form-group">
						    <label for="exampleInputFile">Logo ONLY! (for naw..)</label>
						    <input type="file" class="form-control-file" name="featuredimg" id="featuredimg" aria-describedby="fileHelp">
						    <small id="fileHelp" class="form-text text-muted">Asta e imaginea care apare in capul "articolului" si in thumbnail-uri pe prima pagina. Restul imaginilor le poti urca cu insert image din editor.</small>
						</div>
						<div class="pull-right">
					 		<input type="submit" name="save" class="btn btn-success" value="Posteaza">
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
