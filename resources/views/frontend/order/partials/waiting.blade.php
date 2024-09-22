<div class="row justify-content-center text-center mt-3">
    <div class="col-lg-12">
        <h4 class="fs-5">{{$status}} for you to send {{$order_details->from_amount}} {{$order_details->from_currency}} <span class="waiting"></span></h4>
        <h5 class="small">You will get {{$order_details->to_amount}} {{$order_details->to_currency}}</h5>
        <p class="small">Make payment to the address below.</p>
    </div>
    <div class="col-lg-12">
        <div class="exchange-wrap bg-theme d-inline-block mb-3">
            <div class="img-fluid payment-qr">
                {!! QrCode::size(200)->generate($order_details->from_address) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="exchange-wrap bg-theme d-inline-block mb-3">
            <div class="d-flex align-items-center justify-content-center">
                <h3 class="text-break fs-5 text-center mb-0"><span class="copy-text">{{$order_details->from_address}}</span></h3>
                <a href="javascript:void(0)" class="copy-to-clipboard custom-link-light ms-3 fs-5" data-bs-toggle="tooltip" data-bs-original-title="Copy"><i class="fa-regular fa-copy"></i></a>
            </div>
        </div>
    </div>
</div>
@if(!empty($order_details->deposit_extra_id))
<div class="row mt-3">
    <div class="col-md-12">
        <h3 id="destination-hd">Destination Tag</h3>
        <input type="text" readonly=""  id="destination-textbox" value="{{$order_details->deposit_extra_id ?? ''}}">
        <p id="destination-pera">To not use your funds please enter the destination tag while sending your deposit
        </p>
    </div>
</div>
@endif