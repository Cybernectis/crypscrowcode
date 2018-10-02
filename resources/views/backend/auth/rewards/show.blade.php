@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.rewards.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.rewards.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allRewards->userRewards as $list)

                        <tr>                            
                            <td>{{ Helper::getUsername($list->from_user_id)}}</td>
                            <td>{{$list->amount}}</td>
                            <td>{{($list->paid_status ==0) ? "Not Paid Yet" : "Paid"}}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="text-center">No Records Yet</td>
                        </tr>

                    @endforelse
                    <tr>
                        <td colspan="3">
                           
                        </td>
                    </tr>
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
