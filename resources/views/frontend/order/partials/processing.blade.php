<div class="row justify-content-center text-center mt-3">
    <div class="col-lg-12">
        <h4 class="fs-5">{{$status}} {{$order_details->from_amount}} {{$order_details->from_currency}}<span class="waiting"></span></h4>
    </div>
    <div class="col-lg-12 py-3">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/frontend//images/coins')}}/{{strtolower($order_details->from_currency)}}.png" alt="" class="exchange-coin-lg">
            <div class="arrow mx-3">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <img src="{{asset('assets/frontend//images/coins')}}/{{strtolower($order_details->to_currency)}}.png" alt="" class="exchange-coin-lg">
        </div>
    </div>
    <div class="col-lg-12">
        <h4 class="fs-5">You will get {{$order_details->to_amount}} {{$order_details->to_currency}}</h4>
    </div>
</div>