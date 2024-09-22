@extends('frontend.layouts.app')
@section('title', 'Forbidden - '.config('app.name'))
@section('content')
    <main>
        <section class="py-5 text-center text-white">
            <div class="container">
                <div class="row justify-content-center align-items-center error-page">
                    <div class="col-lg-12">
                        <h1>403</h1>
                        <h2>Page Not Found</h2>
                        <p>The page you were trying to reach couldn't be found on this server. <br> Click "Go Back" to access the Home page.</p>
                        <a href="{{route('home')}}" class="btn btn-custom px-5 rounded-pill">Go Back</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection