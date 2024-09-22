@if(count($networks_send) > 1)
<div class="row pt-2">
	<p>{{__('WHAT TYPE OF NETWORK DO YOU WANT TO SEND from_coin TO?',['from_coin'=>$from_coin])}}</p>
	@foreach($networks_send as $key => $value)
    @if($value->is_active == 1)
    <div class="col-lg-4 col-md-4 col-sm-12">
		<div class="form-check">
			<input class="form-check-input" type="radio" value="{{$value->network}}" name="send_network" id="send_network{{$key}}">
			<label class="form-check-label" for="send_network{{$key}}">
				{{$value->network}}
			</label>
		</div>
	</div>
	@endif
	@endforeach
</div>
@error('send_network')
<span class="small invalid-feedback d-block">{{ $message }}</span>
@enderror
@endif