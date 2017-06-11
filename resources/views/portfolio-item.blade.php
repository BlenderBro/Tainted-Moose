@include('partials.head')


		<div class="container" style="padding-top:6em">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="modal-body">
						<h2 style="text-align:center">{{ $item->client }}</h2>
						<hr class="star-primary">
						<img style="width:70%;" src="/uploads/{{ $item->featured_image }}" class="img-responsive img-centered" alt="">

						<p>{!! $item->body !!}</p>

						<ul class="list-inline item-details">
							<li>Client:
								<strong><a href="#">{{ $item->client }}</a>
								</strong>
							</li>
							<li>Service:
								<strong><a href="#">{{ $item->services }}</a>
								</strong>
							</li>
						</ul>
						{{-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('partials.footer')
