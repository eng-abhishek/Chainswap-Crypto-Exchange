@extends('frontend.layouts.app')
@section('styles')
<style type="text/css">
    .error-help-block{
        color:#e66f6f;
    }
    .invalid-feedback{
        display: block;
    }
</style>
@endsection
@section('content')
<main>
    <section class="breadcrumb-section py-3 text-white text-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <h1 class="fs-2">Affiliate Program</h1>
                    <nav class="breadcrumb-nav">
                        <ol class="breadcrumb mb-0 justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Affiliate Program</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-10 col-lg-10 py-3">
                    <div class="exchange-wrap bg-theme py-5 px-5">
                        <div class="affiliate-form-container">
                         <div class="affiliate-form-wrapper justify-content-center">

                          @include('frontend.layouts.partials.alert-messages')

                          <form class="py-2" action="{{route('create_affiliate_user')}}" method="post" id="affiliate-form">
                            @csrf()
                            <div class="row g-3 align-items-center">
                                <div class="col-lg-4">
                                    <label for="to1" class="form-label">Create new partner ID to start earning:</label>
                                </div>
                                <div class="col-lg-5">
                                   <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                   @error('email')
                                   <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-affiliate btn-block">Send Email</button>
                                </div>
                            </div>
                        </form>

                        <div class="text-center my-3">
                            <span>OR</span>
                        </div>

                        <form action="{{route('check_affiliate_user')}}" method="post" id="check-affiliate-form" class="py-2">
                            @csrf()
                            <div class="row g-3 align-items-center">
                                <div class="col-lg-4">
                                    <label for="to2" class="form-label">Create new partner ID:</label>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" id="partner_id" name="partner_id" placeholder="Your Partner Id">
                                    @error('partner_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-affiliate btn-block">Send Email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-10 col-lg-10 py-3">
                <div class="exchange-wrap bg-theme py-5 px-5 ">

                    <div class="affiliate-information text-center">
                        <h3 class="affiliate-information-heading">Earn<span class="px-2"><img src="{{asset('assets/frontend/images/affiliate/money-bag.png')}}" height="50" class="px-1"> 30% </span>from each complete exchange operation you refer.</h1>
                            <ul>
                                <li>We share 30% of our profit with you</li>
                                <li>Automatic withdrawals</li>
                                <li>Data updated instantly</li>
                                <li>Min. withdrawal 0.001 BTC (or equivalent to 0.001 BTC in other currencies)</li>
                            </ul>
                            <h3 class="affiliate-information-heading"><img src="{{asset('assets/frontend/images/affiliate/terms-and-conditions.png')}}" height="50" class="px-2">Conditions:</h3>
                            <h6>We only allow public affiliation.</h6>
                            <p>In order to have withdrawals enabled, we will request to provide description of your project or social activity. Exceptions are wallets or services that intend to resell our service via API privately.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Frontend\AffiliateRequest', '#affiliate-form'); !!}

{!! JsValidator::formRequest('App\Http\Requests\Frontend\CheckAffiliateUserRequest', '#check-affiliate-form'); !!}
@endsection
