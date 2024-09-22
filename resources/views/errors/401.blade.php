@extends('frontend.layouts.app')
@section('title', 'Unauthorized - '.config('app.name'))
@section('content')
    <main>
        <section class="py-5 text-center text-white">
            <div class="container">
                <div class="row justify-content-center align-items-center error-page">
                    <div class="col-lg-12">
                        <h1>401</h1>
                        <h2>Page Not Found</h2>
                        <p>The page you requested to access is Unauthorized.</p>
                        <a href="{{route('home')}}" class="btn btn-custom px-5 rounded-pill">Go Back</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection