@extends('frontend.layouts.app')
@section('meta_refresh')
<meta http-equiv="refresh" content="10 url = https://chainswap.io/"/>
@endsection
@section('title', 'Internal Server Error - '.config('app.name'))
@section('content')
<main>
	<section class="py-5 text-center text-white">
		<div class="container">
			<div class="row justify-content-center align-items-center error-page">
				<div class="col-lg-12">
					<h1>500</h1>
					<h2>Coins server under maintenance</h2>
					<p>Please check back after 2 minutes!</p>
					<a href="{{route('home')}}" class="btn btn-custom px-5 rounded-pill">Go Back</a>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection