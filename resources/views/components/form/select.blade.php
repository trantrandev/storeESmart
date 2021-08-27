<div class="form-group">
	<label for="{{ $name }}">{{ $text_label }}</label>
	<select name="{{ $name }}" id="{{ $name }}" class="form-control">
		<option value="">{{ isset($text_name_option)?$text_name_option:$text_label }}</option>
		<option value="{{ $value }}">{{ $text_option }}</option>
	</select>
</div>