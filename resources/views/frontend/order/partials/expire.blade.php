<div class="row justify-content-center text-center mt-3">
	<div class="col-lg-12">
		<div class="message-image mb-3">
			<img src="{{asset('assets/frontend/images/icons/expired-clock.png')}}" alt="">
			<img src="{{asset('assets/frontend/images/icons/expired-clock-exclamation.png')}}" alt="" class="exclamation">
		</div>
		<p>We could not detect a deposit and the locked in exchange rate has expired.</p>                                    
		<a href="{{route('home')}}" class="btn btn-custom btn-lg rounded-pill">Exchange Again!</a>
	</div>
</div>