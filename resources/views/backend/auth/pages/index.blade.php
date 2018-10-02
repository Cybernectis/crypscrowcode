@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.pages.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.pages.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.pages.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.pages.table.name') }}</th>
                            
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($page->section as $page)
                                <tr>
                                    <td>{{ $page->name}}</td>
                                   
                                    
                                     <td>
                                        <a href='{{url("admin/auth/pages/section/$page->id/edit")}}' class='btn btn-info'><i class='fa fa-pencil'></i></a>
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
