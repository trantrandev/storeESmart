@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
	<div class="card">
		<div class="card-header font-weight-bold">
			Cập nhật trang
		</div>
		<div class="card-body">
			{!! Form::open(['route' => array('page.update', $page->id), 'mothod' => 'POST']) !!}
			{{ Form::bsText('Tiêu đề trang', 'title', 'Nhập vào tiêu đề trang', null, $page->title) }}
			{{ Form::bsTextArea('Nội dung trang', 'content', $page->content) }}
			<div class="form-group">
				{!! Form::label('status', 'Trạng thái: ', []) !!}
				<div class="form-check ml-2">
					<input type="radio" {{ $page->status == "show"?"checked":'' }} class="form-check-input" id="show" value="show" name="status">
					<label for="show" class="form-check-label">Hiển thị</label>
				</div>
				<div class="form-check ml-2">
					<input type="radio" {{ $page->status == "hide"?"checked":'' }} class="form-check-input" id="hide" value="hide" name="status">
					<label for="hide" class="form-check-label">Ẩn đi</label>
				</div>
			</div>
			{{ Form::bsSubmit('Cập nhật', 'btn_update') }}
			{!! Form::close() !!}

		</div>
	</div>
</div>
@endsection()