@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <section id="show-status">
    </section>
    <div class="row">
        <div class="col-4">            
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action = "{{ route('catPost.add') }}" method="POST" id="form-cat">
                        @csrf
                        {{ Form::bsText('Tên danh mục', 'name_cat') }}
                        <div class="form-group">
                         <label for="">Danh mục cha</label>
                         <select class="form-control" id="select-cat">
                            <option value="0">Chọn danh mục (Mặc định gốc)</option>
                            @php
                            show_categories($cats);
                            @endphp
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="show" value="show" checked>
                            <label class="form-check-label" for="show">
                                Hiển thị
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="hide" value="hide">
                            <label class="form-check-label" for="hide">
                                Vô hiệu
                            </label>
                        </div>
                    </div>


                    <button type="submit" id="btn-add" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header font-weight-bold">
                Danh mục
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $t = 0;
                        $list_cat = data_tree($list_cat);
                        @endphp
                        @foreach ($list_cat as $cat)
                        @php
                        $t++;
                        @endphp
                        <tr id="{{ $cat->id }}">
                            <th data-target="num_record" scope="row">{{ $t }}</th>
                            <td data-target="name"><?php echo str_repeat('/-- ', $cat->level).$cat['name'] ?></td>
                            <td data-target="status">{!! show_status($cat->status) !!}</td>
                            <td data-target="created_at">{{ $cat->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('catPost.edit', $cat->id) }}" data-id="{{ $cat->id }}" class="btn btn-success btn-sm rounded-0 text-white" id="btn-edit" type="button" data-toggle="modal" data-target="#editModal"  data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                                <a href="{{ route('catPost.delete', $cat->id) }}" id="btn-delete" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> 
                            </td>
                        </tr>    
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
@include('admin.post.editCat')
@endsection
