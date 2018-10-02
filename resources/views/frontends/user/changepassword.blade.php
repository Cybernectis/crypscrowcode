@extends('frontends.layouts.master')

@section('content')
<div class="container  mb-2 Registeration">
        <div class="row">
            @include('includes.partials.messages')   
        </div>
        <div class="row mb-3">
            {{ html()->form('PATCH', route('frontend.auth.password.update'))->class('form-horizontal')->open() }}
                <div class="col-md-4  mt-9 mb-3 ">
                    <h3 class=" mb-3">Change password</h3>
                    <p class="mt-3 mb-3">
                        Changing your CrypScrow password involves your web browser re-encrypting your private key using <b>AES256-CBC </b> to a <b>PBKDF2-stretched </b> version of your new password. (the AES….. to a PBKD….. replace with our encryption method)

                        
                    </p>
                    <button class="btn subscribe" type="submit" name="button">
                        CHANGE PASSWORD
                    </button>
                </div>
                <div class="col-md-5 mt-11 mb-3 mt-3 ">
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}
                        {{ html()->password('old_password')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.old_password'))
                                ->autofocus()
                                ->required() }}
                        <span style="font-size: 12px">Enter the password you are currently using to log in.</span>
                    </div>
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                        {{ html()->password('password')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.password'))
                                ->required() }}
                        <span style="font-size: 12px">This password encrypts your account's private key. It's extremely important to write it down somewhere safe, as it can cannot be recovered if you can't remember it.</span>
                    </div>
                    <div class="form-group mb-5">
                        {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
                            {{ html()->password('password_confirmation')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                    ->required() }}
                        <span style="font-size: 12px">Remember, there is absolutely no way for cyrpsrow staff to recover a lost password due to the nature of client-side encryption.</span>
                    </div>
                </div>
                <!-- <div class="col-md-12 text-center">
                          
                       </div>  -->
            {{ html()->form()->close() }}
        </div>
    </div>


@endsection