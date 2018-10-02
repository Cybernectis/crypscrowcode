@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.exchange.management') . ' | ' . __('labels.backend.access.exchange.create'))

@section('content')
{{ html()->form('POST', route('admin.auth.exchangerate.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.exchange.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.exchange.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.exchange.api_name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('api_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.exchange.api_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.exchange.token_code'))
                            ->class('col-md-2 form-control-label')
                            ->for('token_code') }}

                        <div class="col-md-10">
                            {{ html()->text('token_code')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.exchange.token_code'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.exchange.currency'))
                            ->class('col-md-2 form-control-label')
                            ->for('currency') }}

                        <div class="col-md-10">
                            {{ html()->text('currency')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.exchange.currency'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->
                   
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.exchangerate.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
