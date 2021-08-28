$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//ADD CATPOST
	$(document).on('submit', '#form-cat', function(e) {
		//Không cho submit form qua controller
		e.preventDefault();
		var form = this;
		var name_cat = $('input#name-cat').val();
		var cat_parent = $('select#select-cat').val();
		var status = $('input[name=status]:checked').val();
		// var _token=$("input[name=_token]").val();				
		
		//tong ket
		var data = {
			name: name_cat,
			cat_parent:cat_parent,
			status:status,		 
 			// _token:_token
 		};

 		$.ajax({
 			url:$(form).attr('action'), // Trang xử lý, mặc định trang hiện tại
			method: $(form).attr('method'), // Phương thức  truyền cuẩ form
			data: data, // Dữ liệu truyền lên Server
			dataType: 'json', // html, text, json
			success: function (data) {		
				//Them thanh cong			
				if($.isEmptyObject(data.message)) { 
					$('input#name-cat').val('');
					$('#show-status').html(data.status);
					$('#select-cat').html(data.html_option_cat);

					$('table tbody').html(data.html_table_cat);

				}else{
					$('#show-status').html(data.message);					
				}
 			} // end susccess
 		}); 	
 	});

	// EDIT CATPOST
	$(document).on("click", 'a#btn-edit', function() {		
 		//lấy url
 		var url = $(this).attr('href'); 
		//hiển thị modal
		$('#editModal').on('show.bs.modal');		
		$('#error-name').remove();		

		//đống này để truyền level (/--) qua bảng sau khi update
 		// GET ID
 		var id = $(this).data('id');
 		// GET FULL NAME CAT LEVEL
 		var string_cat_level = $('#'+id).children('td[data-target=name]').text();

 		//GET LEVEL
 		var level = 0;
 		var arr_cat_level = string_cat_level.split("/-- ");
 		
 		$.each(arr_cat_level, function (index, value) {			
 			if(value == "") {
 				level++;
 			}
 		});
 		
 		var data = {level:level};
 		$.ajax({
 			url:url, // Trang xử lý, mặc định trang hiện tại
			method: 'GET', // Phương thức  truyền cuẩ form 	
			data:data,		 
			success: function (data) { 
 				//đưa dữ liệu controller gửi về điền vào input trong form edit
 				$('#name').val(data.name);  
 				if(data.status == 'show'){
 					$('#show-edit').prop('checked', true); 					 	 					
 				}else{
 					$('#hide-edit').prop('checked', true); 					
 				}

 				//Truyền id qua cho form edit
 				//bỏ đường dẫn id vào cho form-edit
 				var str_route = $('#form-edit').attr('action');  					 				
				//cắt chuỗi route để bỏ id vào 				
				str_route = str_route.split("/");
 				// lấy value cuối cùng trong mảng
 				pop_id = str_route.pop();
 				//Nối id lại 
 				str_route = str_route.concat(data.id);
 				//chuyển mảng thành chuỗi và thêm dấu / vào thành đường dẫn
 				str_route = str_route.join('/'); 	
 				//Bỏ vào form-edit			
 				$('#form-edit').attr('action', str_route);

 				//TRUYỀN LEVEL CHO TABLE
 				if(data.level != 0){
 					$('#'+data.id).children('td[data-target=name]').attr('data-level', data.level); 
 				}
 			} // end susccess
 		});
 	});

	// UPDATE CATPOST
	$(document).on("submit", '#form-edit', function(e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var method = $(this).attr('method');
		//get data form
		var name = $('input#name').val();		
		var status = $('input[name=status_edit]:checked').val();		
		var data = {
			name: name,			
			status:status, 		
		};

		//hiển thị modal		
		$.ajax({
 			url: url, // Trang xử lý, mặc định trang hiện tại
			method: 'PUT', // Phương thức  truyền cuẩ form	
			data:data,	 			
			success: function (response) {					
				if($.isEmptyObject(response.message)) {									
					$("#editModal").modal('hide');					
					
					//RETURN DATA INTO TABLE
					var level = $('#'+response.id).children('td').data('level');
					
					var str_level = "";
					if(typeof level != "undefined") {
						for (var i = level - 1; i >= 0; i--) {
							str_level = str_level+"/-- ";
						}								
					} 
					
					$('#'+response.id).children('td[data-target=name]').text(str_level+response.cat.name);
					if(response.cat.status == "show") {
						$('#'+response.id).children('td[data-target=status]').html('<span class="badge badge-success">Hiển thị</span>');	
					}else {
						$('#'+response.id).children('td[data-target=status]').html('<span class="badge badge-secondary">Vô hiệu</span>');
					}

					//cập nhật select option
					$('#select-cat').children('option[value='+response.id+']').text(str_level+response.cat.name);
					//show status thanh cong ra
					console.log(response.status);
					$('#show-status').html(response.status);
				}else{
					$('#error-name').remove();
					$(response.message).insertAfter('#name');
				}
 			} // end susccess
 		});
	});

	// DELETE CATPOST
	$(document).on("click", 'a#btn-delete', function(e){
		e.preventDefault();
		//lấy url
		var url = $(this).attr('href');
		var _this = $(this);
		if(confirm('Bạn có chắc muốn xóa bản ghi này?')) {
			$.ajax({
				url:url,
				method: 'DELETE',
				success: function (response) {
					if($.isEmptyObject(response.message)) {
						$('input#name-cat').val('');
						$('#show-status').html(response.status);
						$('#select-cat').html(response.html_option_cat);
						_this.closest("tr").remove();						 
					}else{
						$('#show-status').html(response.message);						
					}
 				} // end susccess
 			});
		}
	});
});