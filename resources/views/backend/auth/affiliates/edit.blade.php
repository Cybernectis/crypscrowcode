@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.affiliates.management') . ' | ' . __('labels.backend.access.affiliates.edit'))

@section('content')
{{ html()->modelForm($affiliate, 'PATCH', route('admin.auth.affiliates.update', $affiliate->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.affiliates.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.affiliates.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.affiliates.affiliate_percentage'))
                            ->class('col-md-2 form-control-label')
                            ->for('affiliate_percentage') }}

                        <div class="col-md-10">
                            {{ html()->text('affiliate_percentage')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.affiliates.affiliate_percentage'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                     <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.affiliates.amount_symbol'))
                            ->class('col-md-2 form-control-label')
                            ->for('amount_symbol') }}

                        <div class="col-md-10">
                            {{ html()->text('amount_symbol')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.affiliates.amount_symbol'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                     <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.affiliates.minimum_amount'))
                            ->class('col-md-2 form-control-label')
                            ->for('minimum_amount') }}

                        <div class="col-md-10">
                            {{ html()->text('minimum_amount')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.affiliates.minimum_amount'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.affiliates.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
