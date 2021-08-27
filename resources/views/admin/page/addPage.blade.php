@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
	<div class="card">
		<div class="card-header font-weight-bold">
			Thêm trang
		</div>
		<div class="card-body">
			{!! Form::open(['url' =>'admin/page/store', 'method' => 'POST']) !!}

			{{ Form::bsText('Tiêu đề trang', 'title', 'Nhập vào tiêu đề trang', null) }}
			{{ Form::bsTextArea('Nội dung trang', 'content') }}
			<div class="form-group">
				{!! Form::label('status', 'Trạng thái: ', []) !!}
				<div class="form-check ml-2">
					<input type="radio" checked="" class="form-check-input" id="show" value="show" name="status">
					<label for="show" class="form-check-label">Hiển thị</label>
				</div>
				<div class="form-check ml-2">
					<input type="radio" class="form-check-input" id="hide" value="hide" name="status">
					<label for="hide" class="form-check-label">Ẩn đi</label>
				</div>
			</div>
			{{ Form::bsSubmit('Thêm mới', 'btn_add') }}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection()