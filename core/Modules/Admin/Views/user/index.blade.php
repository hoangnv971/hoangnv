@extends('Admin::layouts.main')
@section('title', 'Quản lý người dùng')
@section('content')
<div class="card">
	<div class="card-header">
		
	</div>
	<div class="card-body">
		<table id="userTable" class="table table-bordered table-striped dataTable dtr-inline table-hover">
			<thead>
				<tr>
					<th>id</th>
					<th>Tên</th>
					<th>Email</th>
					<th>Vị trí</th>
					{{-- <th>Hoạt động</th> --}}
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
	        { data: 'name' },
	    ]
	} );
</script>
@endpush