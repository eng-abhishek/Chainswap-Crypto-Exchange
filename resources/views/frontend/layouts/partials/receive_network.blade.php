@if(count($networks_receive) > 1)
<div class="row pt-2">
	<p>{{__('WHAT TYPE OF NETWORK DO YOU WANT TO RECIEVE to_coin FROM?',['to_coin'=>$to_coin])}}</p>
	@foreach($networks_receive as $key => $value)
	@if($value->is_active == 1)
    <div class="col-lg-4 col-md-4 col-sm-12">
		<div class="form-check">
			<input class="form-check-input" type="radio" value="{{$value->network}}" name="receive_network" id="receive_network{{$key}}">
			<label class="form-check-label" for="receive_network{{$key}}">
				{{$value->network}}
			</label>
		</div>
	</div>
	@endif
	@endforeach
</div>
@error('receive_network')
<span class="small invalid-feedback d-block">{{ $message }}</span>
@enderror
@endif