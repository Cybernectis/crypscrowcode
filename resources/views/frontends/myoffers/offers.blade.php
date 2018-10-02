@extends('frontends.layouts.master')

@section('content')
	@push("after-styles")
		<style type="text/css">
			.ajax-loading{
			  	text-align: center;
			}
		</style>
	@endpush
	<!--container-->
    <div class="container mt-12  mb-5 view" >
    	<div class="col-md-12 table-responsive pd-0" style="height: 450px">
            <table class="table" style="font-size: 14px">
            	<tbody id="results">
            		
            	</tbody>
            </table>
            <div class="ajax-loading">
            	<img src="{{ asset('images/loading.gif') }}" />
            	<!-- <button class="btn btn-default">View More Records</button> -->
            </div>
        </div>
	</div>

	@push("after-scripts")
		<script>
		var page = 1; //track user scroll as page number, right now page number is 1
		load_more(page); //initial content load
		$(window).scroll(function() { //detect page scroll
		    if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
		        page++; //page number increment
		        load_more(page); //load content   
		    }
		});     
		function load_more(page){
		  $.ajax(
		        {
		            url: '?page=' + page,
		            type: "get",
		            datatype: "html",
		            beforeSend: function()
		            {
		                $('.ajax-loading').show();
		            }
		        })
		        .done(function(data)
		        {
		            if(data.length == 0){
		            console.log(data.length);
		               
		                //notify user if nothing to load
		                $('.ajax-loading').html("No more records!");
		                return;
		            }
		            $('.ajax-loading').hide(); //hide loading animation once data is received
		            $("#results").append(data); //append data into #results element          
		        })
		        .fail(function(jqXHR, ajaxOptions, thrownError)
		        {
		              alert('No response from server');
		        });
		 }
		</script>
	@endpush
@endsection