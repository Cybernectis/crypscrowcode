@extends('frontends.layouts.master')

@section('content')
 <!--container-->
<div class="container mb-5 profile" id="cryp_resize">
    <div class="row">
        @include('includes.partials.messages')   
    </div>

    <div class="row">
    	<div class="col-md-12 col-lg-12 col-xs-12">
    		<h5 class="text-center">You are able to recieve amount when you have <strong>{{ Helper::getAdminAffiliatesRate()->minimum_amount }} {{ Helper::getAdminAffiliatesRate()->amount_symbol }}</strong> rewards points</h5>
    	</div>
    	<div class="col-md-12 col-lg-12 col-xs-12 table-responsive">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Username</th>
	    				<th>Amount</th>
	    				<th>Status</th>
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($userRewardsList as $list)

	    				<tr>	    					
	    					<td>{{ Helper::getUsername($list->from_user_id)}}</td>
	    					<td>{{$list->amount}}</td>
	    					<td>{{($list->paid_status ==0) ? "Not Paid Yet" : "Paid"}}</td>
	    				</tr>

    				@empty

	    				<tr>
	    					<td colspan="3" class="text-center">No Records Yet</td>
	    				</tr>

    				@endforelse
    				<tr>
    					<td colspan="3">
    						{!!$userRewardsList->links()!!}
    					</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>

    	@if(Helper::getUserRewardsAmount($logged_in_user->id) >= Helper::getAdminAffiliatesRate()->minimum_amount)
	    	<div class="col-md-12 col-lg-12 col-xs-12">
	    		<div class="text-center">
	    			<a href="javascript:void(0)" onclick="getPaidNow()">
	    				<button class="btn create-btn"  >Get Paid Now</button>
	    			</a>	
	    		</div>
	    	</div>
    	@endif
    </div>
</div>

@push("after-scripts")
	<script type="text/javascript">
		function getPaidNow()
		{

			var url = host + "/rewards";
            axios.post(url).then(function(response){
           		swal("Success!!", "Request is submitted to admin will contact you soon", "success");
            });
		}
	</script>
@endpush
@endsection