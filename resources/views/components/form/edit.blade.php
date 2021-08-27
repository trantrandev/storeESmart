 {{-- form starts --}}
    {!! Form::open(['action' => ['ListingController@update', $listing->id], 'method' => 'POST']) !!}
    {{ Form::bsText('name', $listing->name , ['placeholder' => 'Company Name']) }}
    {{ Form::bsText('website', $listing->website, ['placeholder' => 'Company Website']) }}
    {{ Form::bsText('email', $listing->email, ['placeholder' => 'Contact Email']) }}
    {{ Form::bsText('phone', $listing->phone, ['placeholder' => 'Contact Phone']) }}
    {{ Form::bsText('address', $listing->address, ['placeholder' => 'Business Address']) }}
    {{ Form::bsTextArea('bio', $listing->bio, ['placeholder' => 'About This Business' ]) }}
    {{ Form::bsSubmit('submit', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('_method', 'PUT') }}
    {!! Form::close() !!}
  {{-- form ends --}}