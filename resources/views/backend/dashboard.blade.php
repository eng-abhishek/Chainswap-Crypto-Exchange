@extends('backend.layouts.app')

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Dashboard</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">

<div class="m-portlet ">
	<div class="m-portlet__body  m-portlet__body--no-padding">
		<div class="row m-row--no-padding m-row--col-separator-xl">
			<div class="col-md-12 col-lg-6 col-xl-3">
				<!--begin::Total Profit-->
				<div class="m-widget24">					 
				    <div class="m-widget24__item">
				        <h4 class="m-widget24__title">
				           Order
				        </h4><br>
				        <span class="m-widget24__desc">
				           Total orders
				        </span>
				        <span class="m-widget24__stats m--font-brand">
				          {{$total_order}}
				        </span>		
				        <div class="m--space-10"></div>
						<div class="progress m-progress--sm">
							<div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$total_order}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
						</div>
						<span class="m-widget24__change">
							Change
						</span>
						<span class="m-widget24__number">
							{{$total_order}}%
					    </span>
				    </div>				      
				</div>
				<!--end::Total Profit-->
			</div>
			<div class="col-md-12 col-lg-6 col-xl-3">
				<!--begin::New Feedbacks-->
				<div class="m-widget24">
					 <div class="m-widget24__item">
				        <h4 class="m-widget24__title">
				           Finished
				        </h4><br>
				        <span class="m-widget24__desc">
				           Total finished order
				        </span>
				        <span class="m-widget24__stats m--font-success">
				         {{$completed}}
				        </span>		
				        <div class="m--space-10"></div>
						<div class="progress m-progress--sm">
							<div class="progress-bar m--bg-success" role="progressbar" style="width: {{$completed}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="20"></div>
						</div>
						<span class="m-widget24__change">
							Change
						</span>
						<span class="m-widget24__number">
							{{$completed}}%
					    </span>
				    </div>		
				</div>
				<!--end::New Feedbacks--> 
			</div>
			<div class="col-md-12 col-lg-6 col-xl-3">
				<!--begin::New Orders-->
				<div class="m-widget24">
					<div class="m-widget24__item">
				        <h4 class="m-widget24__title">
				           Pending
				        </h4><br>
				        <span class="m-widget24__desc">
				           Total pending order
				        </span>
				        <span class="m-widget24__stats m--font-warning">
				           {{$waiting}}
				        </span>		
				        <div class="m--space-10"></div>
						<div class="progress m-progress--sm">
							<div class="progress-bar m--bg-warning" role="progressbar" style="width: {{$waiting}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
						</div>
						<span class="m-widget24__change">
							Change
						</span>
						<span class="m-widget24__number">
							{{$waiting}}%
			            </span>
				    </div>		
				</div>
				<!--end::New Orders--> 
			</div>
			<div class="col-md-12 col-lg-6 col-xl-3">
				<!--begin::New Users-->
				<div class="m-widget24">
					 <div class="m-widget24__item">
				        <h4 class="m-widget24__title">
				           Failed
				        </h4><br>
				        <span class="m-widget24__desc">
				           Total failed order
				        </span>
				        <span class="m-widget24__stats m--font-danger">
				           {{$cancelled}}
				        </span>		
				        <div class="m--space-10"></div>
				        <div class="progress m-progress--sm">
							<div class="progress-bar m--bg-danger" role="progressbar" style="width:{{$cancelled}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
						</div>
						<span class="m-widget24__change">
							Change
						</span>
						<span class="m-widget24__number">
							{{$cancelled}}%
						</span>
				    </div>		
				</div>
				<!--end::New Users--> 
			</div>
		</div>
	</div>
</div>

</div>
@endsection
@section('scripts')