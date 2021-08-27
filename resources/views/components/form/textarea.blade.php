<div class="form-group">
	<label for="{{ $name }}">{{ $text_label }}</label>
	<textarea class="form-control" id="{{ $name }}" name="{{ $name }}"  rows=13>{{ isset($text_content)?$text_content:'' }}</textarea>	 
</div>