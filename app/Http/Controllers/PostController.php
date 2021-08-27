<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
	function __construct() {
		$this->middleware(function(Request $request, $next){
			session(['module_active' => 'post']);
			return $next($request);
		});
	}

	function list() {
		return view('admin.post.listPost');
	}
}
