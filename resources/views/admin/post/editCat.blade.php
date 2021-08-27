 {{-- modal edit --}}
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form id="form-edit" action="{{ route('catPost.update', '*') }}">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Chỉnh sửa danh mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">       
        {{ Form::bsText('Tên danh mục', 'name') }}

        <div class="form-group">
          <label for="">Trạng thái</label>          
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status_edit" id="show-edit" value="show">
            <label class="form-check-label" for="show-edit">
              Hiển thị
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status_edit" id="hide-edit" value="hide">
            <label class="form-check-label" for="hide-edit">
              Vô hiệu
            </label>
          </div>
        </div>      
      </div>

      <div class="modal-footer">
        <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
        <button type="submit" class="btn btn-primary">Lưu lại</button>
      </div>
    </form>

  </div>{{-- end modal content --}}
</div>
</div>