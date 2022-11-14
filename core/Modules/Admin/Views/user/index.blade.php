@extends('Admin::layouts.main')
@section('title', 'Quản lý người dùng')
@section('content')
<div class="card">
	<div class="card-header">
		
	</div>
	<div class="card-body">
		<table id="userTable">
			<thead>
				<tr>
					<th>id</th>
					<th>Tên</th>
					<th>Email</th>
					<th>Vị trí</th>
					<th>Hoạt động</th>
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
	$('#userTable').DataTable({
	    ajax: '{{route('admin.user.index')}}',
	    
	} );
</script>
@endpush