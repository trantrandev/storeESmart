{!! Form::open(['action' => ['ListingController@destroy', $listing->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Are You Sure?")']) !!}
{{ Form::hidden('_method', 'DELETE')}}
{{ Form::bsSubmit('Delete', ['class' => 'btn btn-danger']) }}
{!! Form::close() !!}