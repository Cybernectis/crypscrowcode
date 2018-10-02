@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.blogs.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.blogs.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.blogs.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.blogs.table.blog_heading') }}</th>
                            <th>{{ __('labels.backend.access.blogs.table.blog_sub_heading') }}</th>
                            <th>{{ __('labels.backend.access.blogs.table.blog_text') }}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                           @forelse($blogs as $blog)
                           <tr>
                               <td>
                                   {{$blog->blog_heading}}
                               </td>
                               <td>
                                   {{!empty($blog->blog_sub_heading) ? $blog->blog_sub_heading : ""}}
                               </td>
                               <td>
                                   {{ str_limit($blog->blog_text, 55) }}
                               </td>
                               <td>
                                   <a href='{{url("admin/auth/blogs/$blog->blog_slug")}}' class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Blog">
                                       <i class="fa fa-eye"></i> 
                                   </a>
                                   <a href="{{route('admin.auth.blogs.edit', $blog->id)}}" class="btn btn-primary">
                                    <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                                   </a>
                                   <a href="{{route('admin.auth.blogs.destroy', $blog->id)}}"
                                         data-method="delete"
                                         data-trans-button-cancel="{{__('buttons.general.cancel')}}"
                                         data-trans-button-confirm="{{__('buttons.general.crud.delete')}}"
                                         data-trans-title="{{__('strings.backend.general.are_you_sure')}}"
                                         class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                 </a>
                               </td>
                           </tr>
                           @empty

                           @endforelse
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
