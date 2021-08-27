@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
	<div class="card">
		<div class="card-header font-weight-bold">
			Thêm người dùng
		</div>
		<div class="card-body">
			{!! Form::open(['url' => 'admin/user/store', 'method' => 'POST']) !!}

			{{ Form::bsText('Họ và tên', 'name', 'Nhập vào họ tên') }}
			{{ Form::bsText('Email', 'email', 'Nhập vào địa chỉ email', 'email') }}
			{{ Form::bsText('Mật khẩu', 'password', 'Nhập vào mật khẩu', 'password') }}
			{{ Form::bsText('Nhập lại mật khẩu', 'confirm', 'Nhập lại mật khẩu', 'password') }}
			{{ Form::bsSelect('Chọn quyền','role','1','a') }}
			{{ Form::bsSubmit('Thêm mới', 'btn_add') }}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
