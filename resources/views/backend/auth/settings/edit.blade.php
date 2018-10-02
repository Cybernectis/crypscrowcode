@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.settings.management') . ' | ' . __('labels.backend.access.settings.edit'))

@section('content')
{{ html()->modelForm($setting, 'PATCH', route('admin.auth.settings.update', $setting))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.settings.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.settings.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.settings.name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.settings.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.settings.meta_key'))
                            ->class('col-md-2 form-control-label')
                            ->for('meta_key') }}

                        <div class="col-md-10">
                            {{ html()->text('meta_key')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.settings.meta_key'))
                                ->attribute('maxlength', 191)
                                ->attribute('disabled', 'disabled')
                                ->required() }}
                                <input type="hidden" name="meta_key" value="{{$setting->meta_key}}">
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.settings.meta_value'))
                            ->class('col-md-2 form-control-label')
                            ->for('meta_value') }}

                        <div class="col-md-10">
                            {{ html()->text('meta_value')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.settings.meta_value'))
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
                    {{ form_cancel(route('admin.auth.settings.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
