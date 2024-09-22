@extends('frontend.layouts.app')
@section('title', 'Page Expired - '.config('app.name'))
@section('content')
  <main>
        <section class="py-5 text-center text-white">
            <div class="container">
                <div class="row justify-content-center align-items-center error-page">
                    <div class="col-lg-12">
                        <h1>419</h1>
                        <h2>Page Expired</h2>
                        <p>Your request has been expired. <br>Click "Go Back" to access the Home page.</p>
                        <a href="{{route('home')}}" class="btn btn-custom px-5 rounded-pill">Go Back</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection