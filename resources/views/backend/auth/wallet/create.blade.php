@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.wallet.management') . ' | ' . __('labels.backend.access.wallet.create'))

@section('content')
{{ html()->form('POST', route('admin.auth.wallet.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.wallet.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.wallet.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.wallet.coin'))
                            ->class('col-md-2 form-control-label')
                            ->for('coin') }}

                        <div class="col-md-10">
                             <select name="local_coins" class="form-control" onchange="" required>
                                <option value="">Select</option>
                                @foreach ($localCoin as $key => $value)
                                    @if(!in_array($value->id, $allCoinIds))
                                    <option value="{{$value->id}}" >{{$value->short_name}}</option>
                                    @endif
                                @endforeach 
                            </select>
                            
                        </div><!--col-->
                    </div><!--form-group-->
                   
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.wallet.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}


@endsection
