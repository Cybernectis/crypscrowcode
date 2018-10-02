<div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
	 @if ($logged_in_user->isAdmin())
    <a href="{{ route('admin.auth.user.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New"><i class="fa fa-plus-circle"></i></a>
    @endif
</div><!--btn-toolbar-->