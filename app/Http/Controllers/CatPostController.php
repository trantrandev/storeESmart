<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\CatPost;
use App\Post;
class CatPostController extends Controller
{
	function __construct() {
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
	}
	// END __CONSTRUCT


	function list() {
		$cats = CatPost::all();
		$list_cat = CatPost::all();
		return view('admin.post.catPost', compact('cats', 'list_cat'));
	}

	function add(Request $request) {		
		$validator = check_validation_cat($request);

		if($validator->passes()) {			
			$data = [
				'name' => $request->name,
				'parent_id' => $request->cat_parent,
				'status' => $request->status,
				'user_id' => Auth::id()
			];			 			 

			//THÊM
			$query = CatPost::create($data);
			if($query) {
				$status = load_status('Thêm mới thành công');

			//load lại danh mục
				$cats = data_tree(CatPost::all());  
				$html_option_cat = load_data_option($cats);
			//load lai bang table								
				$html_table_cat = load_data_table($cats);

				return response()->json([
					'status' => $status,
					'html_option_cat' => $html_option_cat,
					'html_table_cat' => $html_table_cat,					 
				]);	
			}
		}else{
			$message = $validator->errors()->all();
			$status = '<div id="status" class="alert alert-danger">'.$message[0].'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			return response()->json([
				'message'  => $status,
			]);
		}
	}


	function edit(Request $request, $id){					

		$cat = CatPost::find($id);
		return response()->json([
			'name' => $cat->name,
			'status' => $cat->status,
			'id' => $id,
			'level' => $request->level
		]);
	}

	function update(Request $request, $id) {
		$validator =  check_validation_cat($request);

		if($validator->passes()) { 						 
			$data_cat_id = CatPost::find($id);
			// dd($data_cat_id)			
			$cat = CatPost::where('id', $id)->update($request->all());
			return response()->json(['cat' => $request->all(),'id' => $id,'status'=>'Cập nhật danh mục thành công'], 200);
		}else {
			$message = $validator->errors()->all();
			$status = '<div id="error-name" class="text-danger">'.$message[0].'</div>';
			return response()->json([
				'message'  => $status,
			]);
		}
	}

	function delete($id) {		
		//check nếu danh mục này chứa bài viết con thì ko cho xóa		 
		$post = CatPost::find($id)->posts->where('cat_id', '=', $id);
		$cat_parent = CatPost::where('parent_id','=',$id)->get();

		//Nếu có bài viết bên trong danh mục
		if(count($post) > 0){			
			$status = load_status("Danh mục này còn bài viết bên trong! Hãy xóa bài viết trước !", 'danger'); 
			return response()->json(['message' => $status]);

		}else if(count($cat_parent)>0){ 			
			//Không được xóa danh mục cha nếu có danh mục con
			$status = load_status("Bạn cần phải xóa danh mục con nó trước khi thực hiện thao tác này!", 'danger');;			
			return response()->json(['message' => $status]);

		}else{
			//Thực hiện xóa
			CatPost::find($id)->delete();

			//load lại option danh mục
			$cats = data_tree(CatPost::all());	
			$html_option_cat = load_data_option($cats);
			
			//show status
			$status = load_status("Xóa danh mục thành công");			
			return response()->json([
				'status' => $status,
				'html_option_cat' => $html_option_cat,				 
			]);
		}
	}
}
