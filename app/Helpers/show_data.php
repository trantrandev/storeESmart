<?php 
function show_status_bg($status) {
	$list_session = array(
		'status_isvalid' => 'alert-danger',
		'status' => 'alert-success'
	);
	if(array_key_exists($status, $list_session)){
		return $list_session[$status];
	}
}

function show_array($array) {
	if(is_array($array)) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}else{
		echo "Không phải 1 mảng nên không thể show_array";
	}
}

function show_status($status) {
	$array_data = array(
		'show' => '<span class="badge badge-success">Hiển thị</span>',
		'hide' => '<span class="badge badge-secondary">Vô hiệu</span>'
	);
	if(array_key_exists($status, $array_data)){
		return $array_data[$status];
	}
}


function data_tree($data, $parent_id = 0, $level = 0) {
	$result = [];
	foreach ($data as $item) {
		//Nếu parent_id của databse == parent_id = 0 => gốc
		if($item->parent_id == $parent_id) {
			$item->level = $level;
			$result[] = $item;
			//khi them vao roi, thi o lan lap tiep theo se bo qua no
			// unset($data[$item['id']]);
			//nap con vao của $item ở trên vào
			$child = data_tree($data, $item->id, $level + 1);

			// gộp result lai
			$result = array_merge($result, $child);
		}
	}
	return $result;
}

function show_categories($categories, $parent_id = 0, $char = '') {
	foreach ($categories as $key => $item) {
		if($item->parent_id == $parent_id) {
			echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
			unset($categories[$key]);

			show_categories($categories, $item->id, $char.'/-- ');
		}
	}
}



// function test(){
	// <select name="parent_id">
	// @foreach($cats as $cat)
		// <?php 
			// $selected = $cat->id == $model->parent_id ? 'selected' : '';

// 		<!-- <option value="{{$cat->id}}" $selected>{{$cat->name}}</option> -->
// 	<!-- @endforeach -->
// <!-- </select> -->
// }