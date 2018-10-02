@extends('frontends.layouts.master')

@section('title', app_name() . ' | '.__('labels.frontend.auth.register_box_title'))

@section('content')
<!--container-->
    <div class="container mt-7 mb-7 Registeration">
        <!--registration-->
        
        <div class="row mb-3">
            <!--registration form-->
            
		 	{{ html()->form('POST', route('frontend.auth.register.post'))->attribute('autocomplete', 'off')->open() }}
                <div class="col-md-4  mt-9 mb-3 ">
                    <h3 class=" mb-3">Create an account</h3>
                    <div class="row">
                        <br>
                        @include('includes.partials.messages')   
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="refer_by" value="{{ app('request')->input('refer_by') }}">
                        {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}*

                        {{ html()->text('first_name')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.first_name'))
                            ->attribute('maxlength', 191)->attribute('minlength', 2)->attribute('required', 'required') }}
                        
                    </div>
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.username'))->for('username') }}*

                        {{ html()->text('username')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.username'))
                            ->attribute('maxlength', 191)->attribute('minlength', 5)->attribute('required', 'required') }}
                        <span style="font-size: 12px">Your username is what other traders will know you by, so try to pick something memorable.</span>
                    </div>
                    <div class="form-group mb-5">
                        {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
						{{ html()->password('password')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.password'))
                            ->required()->attribute('minlength', 5)->attribute('pattern','(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}')->attribute('title','Password must contain at least 5 characters, including UPPER/lowercase and numbers') }}
                    </div>
                    <p class="mb-3">Your web browser is going to generate a private key offline, and then encrypt it using AES256-CBC to a PBKDF2-stretched version of your password.</p>
                    <p>This means that our staff cannot access your wallet or read your messages.</p>
                </div>
                <div class="col-md-4 mt-17 mb-3 mt-3 col-md-offset-2 ">
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}*

                        {{ html()->text('last_name')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.last_name'))
                         ->attribute('maxlength', 191)->attribute('minlength', 2)->attribute('required', 'required') }} 
                    </div>
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
						{{ html()->email('email')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.email'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                        <span style="font-size: 12px">Your e-mail address will be used for two-factor authentication.</span>
                    </div>
                    <div class="form-group mb-5">
                        {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
						{{ html()->password('password_confirmation')
	                            ->class('form-control')
	                            ->placeholder(__('validation.attributes.frontend.password_confirmation'))
	                            ->required() }}
                        <span style="font-size: 12px">Remember, there is absolutely no way for crypsrow staff to recover a lost password due to the nature of client-side encryption.</span>
                    </div>
                    <div class="form-group mb-5">
                        
                        <label for="gender">Gender</label>
                        
                        <input type="radio" name="gender" value="male" required>Male
                        <input type="radio" name="gender" value="female" required>Female
                    </div>
                    @if (config('access.captcha.registration'))
					<div>
						<h5>Please enter the CAPTCHA.</h5>
						{!! Captcha::display() !!}
                        {{ html()->hidden('captcha_status', 'true') }}
						
					</div><br/>
					@endif
                </div>
                <div class="col-md-12 text-center">
                    <button class="btn subscribe" type="submit" name="button">
                        {{__('labels.frontend.auth.register_button')}}
                    </button>
                </div>
                <div class="col-md-12 text-center">                   
                </br><p>Clicking on above button Generate Keys & Sign UP, you confirm to agree to our Terms and Conditions & Privacy Policy.</p>
                </div>
            </form>
            <!--registration form-->
        </div>
        <!--registration-->
    </div>
    <!--container-->



@endsection

@push('after-scripts')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endpush