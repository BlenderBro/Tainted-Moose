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
                <div class="panel-heading">Adauga..</div>

                <div class="panel-body">
                    <form class="" action="{{ action('PortfolioController@store') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-inline">
						    <label style="margin-right:1em;" for="exampleInputEmail1">Titlu</label>
						    <input style="min-width:18em;" type="text" class="form-control" name="title" id="title" placeholder="Titlul lucrarii">
							<label style="margin-right:1em;margin-left:1em;" for="exampleInputEmail1">Client</label>
						    <input style="min-width:18em;" type="text" class="form-control" name="client" id="client" placeholder="Cine e clientul">
							<label style="margin-right:1em;margin-left:1em;" for="exampleInputEmail1">Service</label>
						    <input style="min-width:18em;" type="text" class="form-control" name="services" id="services" placeholder="Serviciile prestate">
						</div>

						<div class="form-group">
						    <textarea type="text" class="form-control" name="body" id="body" placeholder="Daca paste, clear format ;)"></textarea>
						</div>
						<div class="form-group">
						    <label for="exampleInputFile">Featured Image/logo (maybe?)</label>
						    <input type="file" class="form-control-file" name="featuredimg" id="featuredimg" aria-describedby="fileHelp">
						    <small id="fileHelp" class="form-text text-muted">Asta e imaginea care apare in capul "articolului". Restul imaginilor le poti urca cu insert image din editor.</small>
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
