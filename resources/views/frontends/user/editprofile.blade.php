@extends('frontends.layouts.master')

@section('content')
<!--container-->
    <div class="container  mb-6 edit-profile ">
        <div class="row">
            @include('includes.partials.messages')   
        </div>
        <div class="row mb-3">
            <!--edit profile form-->
            {{ html()->modelForm($logged_in_user, 'PATCH', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                <div class="col-md-12">
                    <h3 class=" mb-3 mt-9 ">Edit account</h3></div>
                <div class="col-md-4  mb-3 "> 
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}
                        {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.first_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
                        {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        <span style="font-size: 12px">Your email address is never shown to anyone. To change it, we'll send you a confirmation link.</span>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                        {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}
                    </div>
                        <div class="col-xs-3">
                             {{ html()->text('country_code')
                            ->class('form-control ')
                            ->placeholder(__('validation.attributes.frontend.country_code'))->attribute('maxlength', 2)->required() }}
                        </div>
                       <div class="col-xs-6">
                        {{ html()->text('phone')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.phone'))
                            ->attribute('maxlength', 191)
							->required() }}
							<input name="hdn_mobile" value="{{$logged_in_user->phone}}" type="hidden" />
							
                        </div>
						<div class="col-xs-3">
                        <button class="btn btn-xs" onclick="update_mobile_no()" type="button" name="button">Update</button>
                        </div>
                        <div class="col-xs-12">
                            <span style="font-size: 12px">Your phone number will never be shown to anyone. To change it, we'll send you a confirmation code.</span>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4 mb-3 col-md-offset-2">
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}
                        {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.blurb'))->for('blurb') }}
                        {{ html()->text('blurb')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.blurb'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        <span style="font-size: 12px">Introduce yourself. This will be displayed on your public profile.</span>
                    </div>
                    <div class="form-group">
                       <h5>{{ html()->label(__('validation.attributes.frontend.username'))->for('username') }}</h5>
                        <input class="form-control" type="text" name="username" value="{{Auth::user()->username}}" disabled="">
                    </div>
                    <!-- <div class="form-group">
                       <h5>2fa</h5>
                        <input type="radio" type="text" name="2fa" value="0">
                        off<input type="radio" type="text" name="2fa" value="1">on
                                            </div> -->
                    <input type="hidden" type="text" name="google2fa_secret">

                </div>
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        <label for="gender">Gender</label>
                        
                        <input type="radio" name="gender" value="male" required {{ $logged_in_user->gender == 'male' ? 'checked' : '' }}>Male
                        <input type="radio" name="gender" value="female" required {{ $logged_in_user->gender == 'female' ? 'checked' : '' }}>Female

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>Enable Two Factor Authentication</label>
                        <!-- <input  type="checkbox" name="google2fa_flag" {{ $logged_in_user->google2fa_flag ? 'checked' : '' }} value="{{ $logged_in_user->google2fa_flag ? '2' : 1 }}"> -->

                        <select name="authentication_type" class="form-control">
                            <option {{ $logged_in_user->authentication_type == '' ? 'selected' : 'magiclink' }} value="magiclink">Email Magic Link</option>
                            <option value="otp" {{ $logged_in_user->authentication_type == 'otp' ? 'selected' : '' }}>OTP(eg.Google Authenticator)</option>
                        </select>
                    </div>
                </div>
               
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h5>{{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}
                    </h5>
                    <div>
                        <label>  <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> Gravatar</label>
                        <label>   <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> Upload</label>

                        @foreach ($logged_in_user->providers as $provider)
                            @if (strlen($provider->avatar))
                                <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                            @endif
                        @endforeach
                    </div>
                    <div class="form-group hidden" id="avatar_location">
                        {{ html()->file('avatar_location')->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-12 ">
                    <button class="btn subscribe" type="submit" name="button">
                        UPDATE ACCOUNT
                    </button>
                </div>
             
            {{ html()->closeModelForm() }}
            <!--edit profile form-->
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Set Your Phone Number</h4>
                    </div>
                    <div class="modal-body">
                       <p> Your One Time Password has been sent to <span id="enteredPhone"></span>. </b> Please enter OTP below to verify your number. Update set your mobile number button Submit and also have resend OTP button and then close button.</p>
                        <p><input class="form-control" type="text"  name="otpnumber" ></p>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn fund-escrow" id="saveOtp">Set your phone number</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="qrmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Set up Google Authenticator</h4>
                    </div>
                    <div class="modal-body" >
                        <div id="qrbody"></div>

                    </div>
                    <div class="modal-footer">
                      
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> -->
	 <!-- Modal -->
      <div class="modal fade" id="g2fa-modal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Set up Google Authenticator</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                

                <div class="panel-body" style="text-align: center;">
                    <p>Set up you 2FA by scanning the barcode below.</p>
                    <div>
                        <img src="" class="imageqr">
                    </div>
                   
                </div>
            </div>
              <!-- <p>Some text in the modal.</p>

              <div>
                  <img src="" class="imageqr img-responsive">
              </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
    </div>
    <!--container-->
    </div>

@push('after-scripts')
    <script>
    	$(document).ready(function(){
    		var avatar_location = $("#avatar_location");
            if ($('input[name=avatar_type]:checked').val() == 'storage') {
                avatar_location.show();
                avatar_location.removeClass("hidden");
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() == 'storage') {
                    avatar_location.show();
                    avatar_location.removeClass("hidden");
                } else {
                    avatar_location.hide();
                }
            });
    	});
        // $(document).on("change", "input[name=google2fa_flag]", function(){

        //         var url = host+"/generateqr";
                

        //             axios.post(url) 
        //         .then(function(response) {
        //            if(response.data != "already")
        //            {
        //                 console.log(response.data);
        //                 $("#qrmodal").modal();
        //                 $("#qrmodal").removeClass("fade");
        //                 $("#qrbody").html(response.data);
        //            }
                    

        //         })   
        //         .catch(function(error){
        //             console.log(error.data);
                    
        //         });
        // });
        $(document).on('change','select[name="authentication_type"]',function(){
            // e.preventDefault();
            console.log($(this).val());
            if($(this).val() == "otp")
            {
                axios.get(host+'/register2fa').then(response => {
                    
                    $('input[name="google2fa_secret"]').val(response.data.google2fa);
                    $('.imageqr').prop('src',response.data.image_url);
                    $('#g2fa-modal').removeClass('fade');
                    $('#g2fa-modal').modal('show');
                });
                
            }
        });
        $(document).on("click", "#saveOtp", function(){
   
             var url = host+"/verifyotp";
                var data = {id:"{{$logged_in_user->id}}",otp: $("input[name=otpnumber]").val(),phone: $("input[name=phone]").val(),country_code: $("input[name=country_code]").val()};

                    axios.post(url,data) 
                .then(function(response) {
                    if(response.data == 0)
                    {
                        swal({
                          title: "Error!",
                          text: "Your entered OTP is not correct please enter correct otp",
                          icon: "error",
                        });
                        $("input[name=otpnumber]").val("");
                        // $("#myModal").modal("hide");
                    }else{
                        swal({
                          title: "Success!",
                          text: "Your phone is now verified",
                          icon: "success",
                        });
                        $("input[name=otpnumber]").val("");
                        $("#myModal").modal("hide");
                    }
                    
                })   
                .catch(function(error){
                    console.log(error.data);
                    
                });
        });

       function update_mobile_no() {
           if($("input[name=phone]").val() != '' && $("input[name=phone]").val() != $("input[name=hdn_mobile]").val())
           {
            
                if(($("input[name=country_code]").val() == null) || ($("input[name=country_code]").val() == 0 )|| ($("input[name=country_code]").val() == ''))
                {
                    swal({
                          title: "Oops please enter Country Code!",
                          text: "Enter valid country code",
                          icon: "warning",
                        });
                    $("input[name=phone]").val(" ");
                }
                else{
                    var url = host+"/sendotp";
                    var data = {id:"{{$logged_in_user->id}}", phone: $("input[name=phone]").val(),country_code: $("input[name=country_code]").val()};

                        axios.post(url,data) 
                    .then(function(response) {
                        // $("#myModal").modal("show");

                        $("#myModal").modal();
                        $("#enteredPhone").text($("input[name=phone]").val());
                        $("#myModal").removeClass("fade");
                        // $("#myModal").modal("hide");
                    })   
                    .catch(function(error){
                        console.log(error.data);
                        
                    });
                }
           }
		   else
		   {
			   swal({
                          title: "Oops!",
                          text: "Please enter valid mobile number.",
                          icon: "warning",
                        });
		   }
            
            // var settings = {
            //       "async": true,
            //       "crossDomain": true,
            //       "url": "http://control.msg91.com/api/sendotp.php?authkey=209861Ac4nsRCcCa5ad0ae2a&message=check your otp&sender=otpsma&mobile=8839381014",
            //       "method": "POST",
            //       "headers": {}
            //     }

            //     $.ajax(settings).done(function (response) {
            //       console.log(response);
            //     }); 
            

        //                  .header("Access-Control-Allow-Origin", "*")
        // .header("Access-Control-Allow-Methods",
        //     "GET, POST, PUT, DELETE, OPTIONS, HEAD")
         }
       
        
    </script>
@endpush
@endsection

