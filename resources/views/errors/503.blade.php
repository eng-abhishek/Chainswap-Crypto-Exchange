@extends('frontend.layouts.app')
@section('title', 'Service Unavailable - '.config('app.name'))
@section('content')
<main>
	<section class="py-5 text-center text-white">
		<div class="container">
			<div class="row justify-content-center align-items-center error-page">
				<div class="col-lg-12">
					<h1>503</h1>
					<h2>Service Unavailable</h2>
					<p>The server cannot handle your request right now.<br/>Please Try Again later!</p>
					<a href="{{route('home')}}" class="btn btn-custom px-5 rounded-pill">Go Back</a>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection