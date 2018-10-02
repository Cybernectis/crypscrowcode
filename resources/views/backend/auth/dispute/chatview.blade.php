@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.dispute.management'))

@section('content')
<style type="text/css">
    .container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
}

/* Darker chat container */
.darker {
    border-color: #ccc;
    background-color: #ddd;
}

/* Clear floats */
.container::after {
    content: "";
    clear: both;
    display: table;
}

/* Style images */
.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

/* Style the right image */
.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

/* Style time text */
.time-right {
    float: right;
    color: #aaa;
}

/* Style time text */
.time-left {
    float: left;
    color: #999;
}
</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.dispute.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.dispute.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col" id="chatview">
               <!--  <div class="container">
                  <img src="/w3images/bandmember.jpg" alt="Avatar">
                  <p>Hello. How are you today?</p>
                  <span class="time-right">11:00</span>
                </div>

                <div class="container darker">
                  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                  <p>Hey! I'm fine. Thanks for asking!</p>
                  <span class="time-left">11:01</span>
                </div>

                <div class="container">
                  <img src="/w3images/bandmember.jpg" alt="Avatar">
                  <p>Sweet! So, what do you wanna do today?</p>
                  <span class="time-right">11:02</span>
                </div>

                <div class="container darker">
                  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                  <span class="time-left">11:05</span>
                </div> -->
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
@push('after-scripts')
    <script type="text/javascript">
        $(document).ready( function(){
            var html = '';
            var userId = "{{$group->tradeData->user_id}}";
            var secerat = "{{$group->uuid}}";
            var message = "";
            var url = host+'/message/'+"{{$group->id}}";
                axios.get(url).then(response => {
                     var conversations = response.data;
                     for (var i = 0; i <= conversations.length - 1; i++) {
                        
                        var isHTML = RegExp.prototype.test.bind(/(<([^>]+)>)/i);
                        if(isHTML(conversations[i].message))
                        {
                            
                        }else{
                            message =  CryptoJS.AES.decrypt(conversations[i].message.toString(), secerat).toString(CryptoJS.enc.Utf8);
                        }
                        if (userId == conversations[i].user_id) {
                            html += '<div class="container">\
                                      <img src="'+conversations[i].user.picture+'" alt="Avatar">\
                                      <p>'+message+'</p>\
                                      <span class="time-right">'+conversations[i].time+'</span>\
                                    </div>';
                        }else{
                           html += '<div class="container darker">\
                                      <img src="'+conversations[i].user.picture+'" alt="Avatar" class="right">\
                                      <p>'+message+'</p>\
                                      <span class="time-left">'+conversations[i].time+'</span>\
                                    </div>'; 
                        }
                        
                        
                    }
                    $('#chatview').append(html);
                });
        });
    </script>
@endpush
@endsection
