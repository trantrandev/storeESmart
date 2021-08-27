  {{-- {{ Form::submit($value, $attributes) }} --}}

  <input class="btn {{ isset($bg_btn)?$bg_btn:'btn-primary' }}" type="submit" name="{{ $name }}" value="{{ $value }}">
