@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
	<div class="card">
		<div class="card-header font-weight-bold">
			Chỉnh sửa thông tin người dùng
		</div>
		<div class="card-body">
			{!! Form::open([ 'route' => array('user.update', $user->id), 'method' => 'POST']) !!}
			
			{{ Form::bsText('Họ và tên', 'name', 'Nhập vào họ tên',null, $user->name) }}
			{{ Form::bsText('Email', 'email', 'Nhập vào địa chỉ email', 'email', $user->email,'disabled') }}
			{{ Form::bsText('Mật khẩu', 'password', 'Nhập vào mật khẩu', 'password') }}
			{{ Form::bsText('Nhập lại mật khẩu', 'confirm', 'Nhập lại mật khẩu', 'password') }}
			{{ Form::bsSelect('Chọn quyền','role','1','a') }}
			{{ Form::bsSubmit('Cập nhật', 'btn_update') }}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
