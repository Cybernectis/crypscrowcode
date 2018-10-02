@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.localcoins.management') . ' | ' . __('labels.backend.access.localcoins.edit'))

@section('content')
{{ html()->modelForm($localcoins, 'PATCH', route('admin.auth.localcoins.update', $localcoins->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.localcoins.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.localcoins.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.localcoins.name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.localcoins.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.localcoins.short_name'))
                            ->class('col-md-2 form-control-label')
                            ->for('short_name') }}

                        <div class="col-md-10">
                            {{ html()->text('short_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.localcoins.short_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.localcoins.creator_percentage'))
                            ->class('col-md-2 form-control-label')
                            ->for('creator_percentage') }}

                        <div class="col-md-10">
                            {{ html()->text('creator_percentage')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.localcoins.creator_percentage'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                     <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.localcoins.taker_percentage'))
                            ->class('col-md-2 form-control-label')
                            ->for('taker_percentage') }}

                        <div class="col-md-10">
                            {{ html()->text('taker_percentage')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.localcoins.taker_percentage'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                     <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.localcoins.unit_name'))
                            ->class('col-md-2 form-control-label')
                            ->for('unit_name') }}

                        <div class="col-md-10">
                            {{ html()->text('unit_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.localcoins.unit_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                     <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.localcoins.unit_value'))
                            ->class('col-md-2 form-control-label')
                            ->for('unit_value') }}

                        <div class="col-md-10">
                            {{ html()->text('unit_value')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.localcoins.unit_value'))
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
                    {{ form_cancel(route('admin.auth.localcoins.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
