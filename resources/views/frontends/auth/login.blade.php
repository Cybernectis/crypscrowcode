@extends('frontends.layouts.master')

@section('content')
 <!--container-->
    <div class="container mt-7 mb-7 login " id="cryp_resize">
        
        <!--login-->
        <div class="row mb-3">
            <div class="col-md-6 mb-3 col-md-offset-3">
                <h2 class=" mt-10 mb-3">Log in</h2>
                <div class="row">
                    <br>
                    @include('includes.partials.messages')   
                </div>
                <!--login form-->
                {{ html()->form('POST', route('frontend.auth.login.post'))->attribute('autocomplete', 'off')->open() }}
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.username'))->for('username') }}
                        {{ html()->text('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.username'))
                                        ->attribute('maxlength', 191)
                                        ->required() }} 
                    </div>
                    <input type="hidden" name="flag" value="1">
                    <div class="form-group mb-5">
                        {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                        {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                    </div>
                    
					 <div class="row">
						<div class="col col-md-6 col-xs-12">
							<button class="btn subscribe" type="submit" name="button">
								{{ __('labels.frontend.auth.login_button') }}
							</button>
						</div>
						<div class="col col-md-6 col-xs-12">
							<div class="form-group text-right">
								<a href="{{ route('frontend.auth.password.reset') }}"><b>{{ __('labels.frontend.passwords.forgot_password') }}</b></a>
							</div><!--form-group-->
						</div><!--col-->
					</div>
                    <br/>
					<p>Don't have an account yet? </p>
                    <a href="{{url('register')}}"><b>Create a new account.</b></a>
                {{ html()->form()->close() }}
                <!--login form-->
            </div>
        </div>
        <!--login-->
    </div>
    <!--container-->
  
@endsection