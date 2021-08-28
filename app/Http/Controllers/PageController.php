<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Page;
use App\User;
class PageController extends Controller
{	
	function __construct() {
		$this->middleware(function($request, $next){
			session(['module_active' => 'page']);
			return $next($request);
		});		
	}

	function list() {
		//Lấy all các trang
		$pages = Page::get();
		


		return view('admin.page.listPage', compact('pages'));
	}

	function add() {
		return view('admin.page.addPage');
	}

	function store(Request $request) {
		if($request->input('btn_add')){
			$request->validate([
				'title' => ['required', 'string', 'max:255']
			],
			[
				'required' => ':attribute không được để trống',
				'max' => ':attribute không được quá :max từ'
			],
			[
				'title' => 'Tiêu đề trang'
			]);

			$data = array(
				'title' => $request->input('title'),
				'content' => $request->input('content'),
				'user_id' => Auth::id(),
				'status' => $request->input('status')
			);
			Page::create($data);
			return redirect('admin/page/list')->with('status', 'Thêm trang thành công');
		}

	}

	function edit($id){
		$page = Page::find($id);
		return view('admin.page.editPage', compact('page'));
	}

	function update(Request $request, $id) {
		if($request->input('btn_update')){
			$request->validate([
				'title' => ['required', 'string', 'max:255']
			],
			[
				'required' => ':attribute không được để trống',
				'max' => ':attribute không được quá :max từ'
			],
			[
				'title' => 'Tiêu đề trang'
			]);
			
			$data = array(
				'title' => $request->input('title'),
				'content' => $request->input('content'),
				'user_id' => Auth::id(),
				'status' => $request->input('status')
			);
			Page::where('id', $id) -> update($data);
			return redirect('admin/page/list')->with('status', 'Cập nhật thành công');
		}
	}

	function delete($id) {	
		$page = Page::find($id);
		$page->delete();
		return redirect('admin/page/list')->with('status', 'Xóa thành công');
	}
}
