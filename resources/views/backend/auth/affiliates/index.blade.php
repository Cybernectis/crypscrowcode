
@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.affiliates.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.affiliates.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
               
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.affiliates.table.affiliate_percentage') }}</th>
                            <th>{{ __('labels.backend.access.affiliates.table.amount_symbol') }}</th>
                            <th>{{ __('labels.backend.access.affiliates.table.minimum_amount') }}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($affiliates as $affiliate)
                                <tr>
                                    <td>{{ $affiliate->affiliate_percentage }}</td>
                                    <td>{{ $affiliate->amount_symbol  }}</td>
                                    <td>{{ $affiliate->minimum_amount }}</td>
                                    <td>
                                        <a href="{{route('admin.auth.affiliates.edit', $affiliate->id)}}" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                   
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
