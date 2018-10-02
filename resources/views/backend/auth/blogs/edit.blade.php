@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.blogs.management') . ' | ' . __('labels.backend.access.blogs.edit'))
@push("after-styles")
<link rel="stylesheet" type="text/css" href="{{asset('css/edit.css')}}">
@endpush
@section('content')
{{ html()->modelForm($blog, 'PATCH', route('admin.auth.blogs.update', $blog->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.blogs.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.blogs.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row"> 
                        {{ html()->label(__('validation.attributes.backend.access.blogs.blog_heading'))
                            ->class('col-md-2 form-control-label')
                            ->for('blog_heading') }}

                        <div class="col-md-10">
                            {{ html()->text('blog_heading')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.blogs.blog_heading'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.blogs.blog_sub_heading'))
                            ->class('col-md-2 form-control-label')
                            ->for('blog_sub_heading') }}

                        <div class="col-md-10">
                            {{ html()->text('blog_sub_heading')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.blogs.blog_sub_heading'))
                                ->attribute('maxlength', 191)
                                }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.blogs.blog_text'))
                            ->class('col-md-2 form-control-label')
                            ->for('blog_text') }}

                        <div class="col-md-10" id="menu_description_id">
                            
                            <textarea id="txtEditor1" name="txtEditor1" rows="3">{{$blog->blog_text}}
                            </textarea>
                            <textarea id="txtEditorContent1" name="blog_text" hidden="" rows="3">{{$blog->blog_text}}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->
                    <!--  <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.blogs.blog_image'))
                            ->class('col-md-2 form-control-label')
                            ->for('blog_image') }}

                        <div class="col-md-10">
                            <input type="file" class="form-control" name="blog_image" >
                        </div>
                    </div> -->
                     
                     
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.blogs.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}

@endsection
@push('after-scripts')
<script type="text/javascript" src="{{asset('js/editor.js')}}"></script>
<script type="text/javascript">
$(document).ready( function() {
$("#txtEditor").Editor();           
$('#txtEditor').text($('#txtEditorContent').val());       
$('#contentarea').html($('#txtEditorContent1').val());      


$("#txtEditor1").Editor();           
$('#txtEditor1').text($('#txtEditorContent1').val());     
console.log($('#txtEditor').Editor("getText"));
$('#menu_description_id').find('.Editor-editor').html($('#txtEditorContent1').val());
});
$(".btn-success").click(function(){ 
    // e.preventDefault();
$('#txtEditorContent').text($('#txtEditor').Editor("getText"));
$('#txtEditorContent1').text($('#txtEditor1').Editor("getText"));

console.log($('#txtEditorContent').text());

});


</script>
@endpush