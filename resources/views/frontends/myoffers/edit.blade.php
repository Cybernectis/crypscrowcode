@extends('frontends.layouts.master')

@section('content')

<!--container-->
    <div class="container  mb-5 new-offer">
    	<div class="row">
            @include('includes.partials.messages')   
        </div>
        <!--trems-->
        <div class="row mb-3">
            <div class="col-md-10 col-md-offset-1">
                <h3>Edit offer</h3>
                 {{ html()->form('PATCH', url('offer-update'))->class('form-horizontal')->open() }}
                    <input type="hidden" name="id" value="{{$trades->id}}">
                    
                    <div class="form-group col-md-12">
                        <div class="col-md-3">
                            <label>Type</label>
                        </div>
                        <div class="col-md-6">
                            @foreach ($offertype as $key => $value)
                            <div class="col-md-6">
                                <input type="radio" name="offer_type" onchange="updateDescription('#typeSpan', this.getAttribute('udata'))" udata="{{$value->description}}" value="{{$value->id}}" @if($trades->offer_type_id == $value->id) checked @endif>
                                <label class="text-capitalize">{{$value->type_name}}</label>
                                
                            </div>
                            @endforeach 
                            
                            <p id="typeSpan"></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-3">
                            <label>Select Coin</label>
                        </div>
                        <div class="col-md-6">
                            <select name="local_coins" id="local_coins" class="form-control" onchange="updateDescription('#typeSpan', this.options[this.selectedIndex].getAttribute('udata'));getSelectBoxExchangeRate(this.options[this.selectedIndex].value, 'edit')" required >
                                <option>Select</option>
                                @foreach ($localCoin as $key => $value)
                                    <option value="{{$value->id}}" creator_percentage="{{$value->creator_percentage}}" taker_percentage="{{$value->taker_percentage}}" @if($value->id == $trades->local_coins_id) selected @endif>{{$value->short_name}}</option>
                                @endforeach 
                            </select>
                            <p id="typeSpan"></p>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Payment method</label>
                        </div>
                        <div class="col-md-6">
                            <select name="payment_method" id="payment_method" class="form-control" onchange="updateDescription('#paymentspan', this.options[this.selectedIndex].getAttribute('udata'))">
                                <option>Select</option>
                                @foreach ($paymentMethods as $key => $value)
                            		<option value="{{$value->id}}" udata="{{$value->description}}" @if($value->id == $trades->payment_method_id) selected @endif>{{$value->name}}</option>
                            	@endforeach 
                            </select>
                            <p id="paymentspan"></p>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Local currency</label>
                        </div>
                        <div class="col-md-6">
                            <select name="local_currency" id="local_currency" class="form-control">
                                <option>Select...</option>
                                @foreach ($localCurrency as $key => $value)
                            		<option value="{{$value->id}}" short_name="{{$value->short_name}}" @if($value->id == $trades->local_currency_id) selected @endif >{{$value->short_name." (".$value->full_name. ")"}}</option>
                            	@endforeach 
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Exchange rate</label>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-4 pd-0">
                                <input type="text" name="rate_percentage" class="form-control" placeholder="0" value="{{$trades->rate_percentage}}">%
                            </div>
                            <div class="col-md-4 pd-0">
                                <select name="rate_above_below" class="form-control">
                                    <option>Select...</option>
                                    <option value="Above" @if($trades->rate_above_below == "above") selected @endif>Above</option>
                                    <option value="Below" @if($trades->id == "below") selected @endif>Below</option>
                                </select>
                            </div>
                            <div class="col-md-4 pd-0">
                                <select name="exchange_rate_id" id="exchange_rate_id"  class="form-control" required onchange="getSelectedUserCurrencyRate()">
                                
                                </select>
                            </div>
                            <input type="hidden" name="compare_coins_id" value="{{$trades->compare_coins_id}}" >
                            <input type="hidden" name="exchange_rate" value="{{$trades->exchange_rate_id}}" >
                            <input type="hidden" name="price" value="0">
                            <div class="row" id="show_exchange_rate">
                            </div>
                            <!-- <p>Mention your custom payment method in the offer headline.</p> -->
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Location</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="city" class="form-control" placeholder="City" value="{{$trades->city}}" required id="autocomplete" onFocus="geolocate()">
                            <p>This is public. It's recommended to choose your closest major city.</p>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Limits</label>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-5 pd-0">
                                <label>Minimum (in TOP)</label>
                                <input type="text" name="minimum_limit" class="form-control" placeholder="0" value="{{$trades->minimum_limit}}">
                            </div>
                            <div class="col-md-5 col-md-offset-2 pd-0">
                                <label>Maximum (in TOP)</label>
                                <input type="text" name="maximum_limit" class="form-control" placeholder="No Limit" value="{{$trades->maximum_limit}}">
                            </div>
                            <p>Optional: This will prevent people from opening trades with volume that you can't or would prefer not to handle.</p>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Headline</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="headline" class="form-control" placeholder="24 hour delivery"  value="{{$trades->headline}}">
                            <p>Optional: The headline field will appear alongside your listing.</p>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Terms of trade</label>
                        </div>
                        <div class="col-md-6">
                            <textarea name="terms_of_trades" class="form-control" placeholder="Meet up at any local cafe between 9 AM - 5 PM." >{{$trades->terms_of_trades}}</textarea>
                            <p>Optional: Use the terms of trade field to outline trade terms (e.g. meeting places, time restrictions and payment windows). Don't include any personal details here.</p>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-3">
                            <label>Standard hours</label>
                        </div>
                        <div class="col-md-6">
                            <select name="standards_hours" class="form-control" onchange="checkDivVisiblity(this.options[this.selectedIndex].getAttribute('value'))">
                                <option value="allhours" @if($value->standards_hours == "allhours") selected @endif>All hours (if you respond slowly, you may be penalized)</option>
                                <option value="usestandardhours" @if($value->standards_hours == "usestandardhours") selected @endif>Use standard hours</option>
                            </select>
                            <div class="col-sm-12 form-group " id="standardhour">
                            	<div class="col-xs-4">
                            		<strong>From:</strong>
                            		<br>
                            		<select name="from_hours" class="form-control">
		                             {{ Helper::get_times()}}
        								
		                            </select>
                            	</div>
                            	<div class="col-xs-4">
                            		<strong>To:</strong>
                            		<br>
                            		<select name="to_hours" class="form-control">
		                                {{ Helper::get_times()}}
		                            </select>
                            	</div>
                            	<div class="col-xs-4">
                            		<strong>Timezone:</strong>
                            		<br>
                            		<select name="timezone" class="form-control">
                            			
                            			{{ Helper::get_time_zone()}}
		                               
		                            </select>
                            	</div>
                            </div>
                            <p>
                                Optional: The hours that you are normally available for contact. Your offer will be shown to more users if you respond to messages quickly, however you won't be penalized for any delays outside of your standard hours.
                            <p>
                        </div>
                    </div>
                    <div class="text-center">
                    	<button class="btn create-btn mt-3 mb-3" type="submit" name="button">Update My Offer</button>
                        <button class="btn btn-danger" type="button" id="deleteOffer" onclick='removeTrade("{{$trades->id}}")'>Delete</button>
                    </div>
                    
                {{ html()->form()->close() }}
            </div>
        </div>
        <!--trems-->
    </div>
    <!--container-->
   
    @push("after-scripts")
     	<script type="text/javascript">
     		$(document).ready(function(){
     			$("#standardhour").hide();
                // $('input[name=offer_type]:checked').val();
               var option = $('input[name=offer_type]:checked').attr('udata');
               $("#typeSpan").text(option);
               // $('input[name=offer_type]:checked').
                option = $('#payment_method option:selected', this).attr('udata');
               $("#paymentspan").text(option);
               // getSelectBoxExchangeRate($('#local_coins option:selected').val());
               getSelectBoxExchangeRate($('#local_coins option:selected').val(), 'edit');
               // $('input[name=compare_coins_id]').val($('#local_currency option:selected').attr('short_name')) 

               
                    // $("select#exchange_rate_id option").each(function() {
                    //     console.log(this); 
                    //     // this.selected = (this.text == myVal); 
                    // });
 		});
     		
    		function updateDescription(spanId, text){
    			$(spanId).text(text);
    		}

    		function checkDivVisiblity(value){
    			if(value == "usestandardhours"){
    				$("#standardhour").show();
    			}else{
    				$("#standardhour").hide();
    			}
    		}
            function removeTrade(id) {
                
                    swal({
                  title: "Are you sure you want to delete this offer?",
                  text: "Offers can not be restored and will have to be created from scratch again.",
                  icon: "warning",
                  buttons: {
                    cancel: "No, don't delete",
                      confirm: {
                        text: "Yes, delete my offer",
                        closeModal: true
                      }
                  },
                  dangerMode: true,
                  
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                                async: false,
                                type: "DELETE",
                                data: { "_token": token },
                                dataType: "json", // or html if you want...
                                url: host + "/delete-offer/" + id, // you need change it.
                                success: function(result) {
                                    location.href = host+"/my-offers";
                                    
                                        swal("Poof! Your trade has been deleted!", {
                                          icon: "success",
                                        });
                                      
                                },
                                timeout: 10000
                            });
                        } 
                    else 
                    {
                        location.href = host+"/my-offers";

                    }
                  
                });
            }
    	</script>
         <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        // street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        // postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7eUVnYCjnobYNjTI8ubYNBHMvoPhAgMw&libraries=places&callback=initAutocomplete"
        async defer>
    </script>
    <script type="text/javascript" src="{{asset('frontends/js/exchange-rate.js')}}"></script>
    @endpush
@endsection