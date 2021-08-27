 {{-- Trường bắt buộc nhập vào dữ liệu--}}
 {{-- $name, $text_label --}}

 {{-- Trường mặc định sẽ tự động điền dl khi rỗng --}}
 {{-- type: text --}}

 {{-- Trường sẽ rỗng khi không điền dl --}}
 {{-- placeholder, value, attributes --}}

 <div class="form-group {{ $errors->has($name)? 'has-error':'' }}">
 	<label for="{{ $name }}">{{ $text_label }}</label>
 	<input id="{{ str_replace('_','-',$name) }}" type="{{ isset($type)? $type: 'text'}}" class="form-control" name="{{ $name }}" {{ isset($disabled)?$disabled:'' }} placeholder="{{ isset($placeholder) ? $placeholder: '' }}" value="{{old($name) ?: (isset($object) ? $object : '') }}"
 	{{ isset($attributes)? $attributes: '' }}
 	>
 	@if ($errors->has($name))
 	<div class="mt-2 alert alert-danger btn btn-sm form-control text-left m-0 d-flex align-items-center">{{ $errors->first($name) }}</div>
 	@endif
 </div>

