@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
  <div class="card">
    {{-- Thông báo thêm thành công hay thất bại --}}
    @if (session('status') || session('status_isvalid'))
    @php
    $name_session = session('status')?'status':'status_isvalid' ;
    $value_session = session('status')?session('status'):session('status_isvalid') ;
    @endphp
    <div class="alert @php echo show_status_bg($name_session)  @endphp">{{ $value_session }}</div>

    @endif
    
    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
      <h5 class="m-0 ">Danh sách trang</h5>
    </div>
    <div class="card-body">
     <table class="table table-striped table-checkall">
      <thead>
        <tr>
         <th scope="col">#</th>
         <th scope="col">Tiêu đề</th>
         <th scope="col">Trạng thái</th>
         <th scope="col">Ngày tạo</th>
         <th scrop="col">Người tạo</th>
         <th scope="col">Tác vụ</th>
       </tr>
     </thead>
     <tbody>
      @if ($pages->count() > 0)
      @php
      $t = 0;
      @endphp
      @foreach ($pages as $page)
      <tr>
        @php
        $t++;
        @endphp
        <td scope="row">{{ $t }}</td>
        <td><a href="{{ route('page.edit', $page->id) }}">{{ $page->title }}</a></td>
        <td>{!! show_status($page->status) !!}</td>
        <td>{{ $page->updated_at }}</td>
        <td><a href="{{ route('user.edit' , $page->user->id) }}">{{ $page->user->name }}</a></td>
        <td><a href="{{ route('page.edit', $page->id) }}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
          <a href="{{ route('page.delete', $page->id) }}" onclick="return confirm('Bạn có thực sự muốn xóa?')" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="8" class="">
          <p class="bg-info text-white p-2 mb-0">Dữ liệu trống</p>
        </td>
      </tr>
      @endif
    </tbody>
  </table>
</div>
</div>
</div>
@endsection