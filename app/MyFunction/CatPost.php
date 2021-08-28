<?php 
//load data html
	function load_data_table($cats){
		//Load lại bảng danh mục			
		$html_table_cat = '';
		$t = 0;
		foreach ($cats as $cat) {
			$t++;
			$html_table_cat.= '<tr id="'.$cat->id.'">';
			$html_table_cat.='<th data-target="num_record" scope="row">'.$t.'</th>';
			$html_table_cat.='<td data-target="name">'.str_repeat('/-- ', $cat->level).$cat['name'].'</td>';
			$html_table_cat.='<td data-target="status">'.show_status($cat->status).'</td>';
			$html_table_cat.='<td data-target="created_at">'.$cat->created_at->format('d-m-Y').'</td>'; 
			$html_table_cat.='<td>
			<a href="'.route('catPost.edit', $cat->id).'" data-id="'.$cat->id.'" id="btn-edit" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="modal" data-target="#editModal" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
			<a href="'.route('catPost.delete', $cat->id).'"  id="btn-delete" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></td>';										
			$html_table_cat.='</tr>';
		}
		return $html_table_cat;
	}		 

		//load option data
	function load_data_option($cats) {			
		$html_option_cat = '';
		$html_option_cat.='<option value="0">Chọn danh mục (Mặc định gốc)</option>';						
		foreach ($cats as $cat) {
			$level_cat = str_repeat('/-- ', $cat['level']).$cat['name'];
			$html_option_cat .= '<option value="'.$cat['id'].'">'.$level_cat.'</option>';				
		}
		return $html_option_cat;
	}

		//load status
	function load_status($message, $alert = 'success') {			
		$status = '<div id="status" class="alert alert-'.$alert.'">'.$message.'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
		return $status;
	}

	function check_validation_cat($request) {
		return Validator::make($request->all(), [
			'name' => ['required', 'string', 'max:255'],				
		],
		[
			'required' => ':attribute không được để trống',
			'max' => ':attribute nhiều nhất chỉ :max ký tự'
		],
		[
			'name' => 'Tên danh mục'
		]
	);
	}