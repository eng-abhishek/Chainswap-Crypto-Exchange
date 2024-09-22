@extends('frontend.layouts.app')
@section('title', 'Too Many Requests - '.config('app.name'))
@section('content')
  <main>
        <section class="py-5 text-center text-white">
            <div class="container">
                <div class="row justify-content-center align-items-center error-page">
                    <div class="col-lg-12">
                        <h1>429</h1>
                        <h2>Too Many Requests</h2>
                        <p>The Server has received too many requests to handle.<br/>Please Try Again!</p>
                        <a href="{{route('home')}}" class="btn btn-custom px-5 rounded-pill">Go Back</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


