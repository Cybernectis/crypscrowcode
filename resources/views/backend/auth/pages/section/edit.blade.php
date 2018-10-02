@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@push("after-styles")
<link rel="stylesheet" type="text/css" href="{{asset('css/edit.css')}}">
@endpush
@section('content')
{{ html()->modelForm($section, 'PATCH', route('admin.auth.section.update', $section->id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ $section->name }}
                        <small class="text-muted">Edit</small> 
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr /> 

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.pages.name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.pages.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.pages.meta_value'))
                            ->class('col-md-2 form-control-label')
                            ->for('meta_value') }}

                        <div class="col-md-10" id="menu_description_id">
                            @if($section->type=='textarea')
                               <!--  <textarea  class="form-control" name="section[{{$section->meta_key}}]"  rows="10" required> {{$section->meta_value}}</textarea> -->

                                <textarea id="txtEditor1" name="txtEditor1">{{$section->meta_value}}</textarea>
                                <textarea id="txtEditorContent1" name="section[{{$section->meta_key}}]" hidden="">{{$section->meta_value}}</textarea>
                            @else
                              <input type="{{$section->type}}" class="form-control" name="section[{{$section->meta_key}}]" value="{{$section->meta_value}}" required>
                            @endif
                            
                        </div><!--col-->

                         @if($section->type=='file')
                          <div class="img col-md-12">
                            <img src='{{asset("uploads/pages/$section->meta_value")}}' class="img-fluid">
                          </div>
                          <div class="clear-fix">
                        @endif
                    </div><!--form-group-->
                   
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row"> 
                <div class="col">
                    {{ form_cancel(route('admin.auth.pages.index'), __('buttons.general.cancel')) }}
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

$("#txtEditor1").Editor();           
$('#txtEditor1').text($('#txtEditorContent1').val());     
$('#menu_description_id').find('.Editor-editor').html($('#txtEditorContent1').val());
});
$(".btn-success").click(function(){ 
    // e.preventDefault();
$('#txtEditorContent').text($('#txtEditor').Editor("getText"));
$('#txtEditorContent1').text($('#txtEditor1').Editor("getText"));
console.log($('#txtEditor').Editor("getText"));
console.log($('#txtEditorContent').text());

});


</script>
@endpush
