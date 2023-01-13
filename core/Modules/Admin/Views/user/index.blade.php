@extends('Admin::layouts.main')
@section('title', 'Quản lý người dùng')
@section('content')
<div class="card">
	<div class="card-header text-right">
		<button type="button" class="btn btn-success" id="create-user">Thêm</button>
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

$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('@csrf').val()
		}
	});
	let table = $('#userTable').DataTable({
	    ajax: '{{route('admin.users.index')}}',
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
	});
	const formHtml = `<form action="" method="post">
			<div class="form-group">
				<label for="name">Tên:</label>
				<input name="name" id="name" type="text" placeholder="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input name="email" id="email" type="email" placeholder="Email" class="form-control">
			</div>
			<div class="form-group">
				<label for="role">Quyền:</label>
				<select name="role" id="role" type="role" class="form-control select2-ajax" data-url="{{route('admin.role.list')}}">
				</select>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input name="password" id="password" type="password" class="form-control">
			</div>
			<div class="form-group">
				<label for="repassword">Repassword</label>
				<input id="repassword" type="password" class="form-control">
			</div>
		</form>`;
	$('#create-user').on('click', () => {
		let form = CURD.createForm(formHtml, "{{ route('admin.users.store') }}");
		custom.select2Ajax();
		CURD.submitForm();
	});
	$('#modal-xl').on('hidden.bs.modal', () =>{
		table.ajax.reload();
		$(this).find('.modal-body').html('');
	});

	$('#userTable').on('click', '.edit-user', (e) => {
		e.preventDefault();
		let _this = $(e.currentTarget);
		console.log(_this.attr('href'))
	});
	
	$('#userTable').on('click', '.remove-user', (e) => {
		e.preventDefault();
		let _this = $(e.currentTarget);
		console.log(_this.attr('href'))
	});
});

</script>
@endpush