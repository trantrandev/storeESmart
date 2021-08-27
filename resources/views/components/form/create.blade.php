  {{-- form starts --}}
  {!! Form::open(['action' => 'ListingController@store', 'method' => 'POST']) !!}
  {{ Form::bsText('name', '', ['placeholder' => 'Company Name']) }}
  {{ Form::bsText('website', '', ['placeholder' => 'Company Website']) }}
  {{ Form::bsText('email', '', ['placeholder' => 'Contact Email']) }}
  {{ Form::bsText('phone', '', ['placeholder' => 'Contact Phone']) }}
  {{ Form::bsText('address', '', ['placeholder' => 'Business Address']) }}
  {{ Form::bsTextArea('bio', '', ['placeholder' => 'About This Business' ]) }}
  {{ Form::bsSubmit('submit', ['class' => 'btn btn-primary']) }}
  {!! Form::close() !!}
{{-- form ends --}}