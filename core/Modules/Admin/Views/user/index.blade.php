@extends('Admin::layouts.main')
@section('title', 'Quản lý người dùng')
@section('content')
<div class="card">
	<div class="card-header text-right">
		<div class="btn btn-success">Thêm</div>
	</div>
	<div class="card-body">
		<table id="userTable" class="table table-bordered table-striped dataTable dtr-inline table-hover text-center">
			<thead>
				<tr>
					<th>id</th>
					<th>Tên</th>
					<th>Email</th>
					<th>Vị trí</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('@csrf').val()
		    }
		});
	$('#userTable').DataTable({
	    ajax:{
	    	url: '{{route('admin.user.index')}}',
	    	method: 'post'
	    },
	    columns: [
	        { data: 'id' },
	        { data: 'name' },
	        { data: 'email' },
	        { data: 'roles' },
	        { data: 'action'}
	    ],
	    columnDefs: [{
	    	targets: 4,
	    	className: 'project-actions'
	    }],
	    processing: true,
        serverSide: true,
	} );
	const create = new CURD([
							{
								tag : "input",
								attr: {
									class:"hello"
								}
							}
							]
		);
</script>
@endpush