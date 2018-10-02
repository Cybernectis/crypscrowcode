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
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Amount Requested</th>
                           
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allUsers as $reward)
                                <tr>
                                    <td>{{ $reward->username}}</td>
                                    <td>
                                        {{ Helper::getUserRewardsAmount($reward->id) }}
                                    </td>
                                    
                                    <td>
                                        <a href='{{url("admin/auth/rewards/$reward->id")}}'> View All</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="saveUserId('{{$reward->id}}')">Paid</a>
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
                    {!!$allUsers->links()!!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
    <input type="hidden" name="user_id" id="user_id">
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Confirm payment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    
                    
                    <div class="form-group">
                        <label for="reciever_address">Enter Transaction Hash:</label>
                        <input class="form-control" type="text"  name="t_hash" id="t_hash" placeholder="Enter Transaction Hash" required>
                    </div>
                   
                      
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn create-btn" id="update_status">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div><!--card-->

@push("after-scripts")
<script type="text/javascript">
    function saveUserId(id)
    {
        $("#user_id").val(id);
    }
    $(document).on("click", "#update_status", function(){
        var t_hash = $("#t_hash").val();
        var id = $("#user_id").val();
        if(t_hash != "")
        {
            console.log(t_hash);
            var url = host + "/admin/auth/rewards/"+id;
            axios.post(url, {'_method':"PUT", "t_hash":t_hash}).then(function(response){
                swal("Success!!", "Done", "success");
            });
        }
    });
</script>
@endpush
@endsection
