<!-- app/views/particleuser/create.blade.php -->
 @extends('app')

 @section('content')
<div class="container">

@include('particleuser.nav')

<h1>Create a Particle Accounts</h1>

<!-- if there are creation errors, they will show here -->
@foreach($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach

{!! Form::open(array('url' => 'accounts')) !!}

    <div class="form-group">
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username', Input::old('username'), array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::text('password', Input::old('password'), array('class' => 'form-control')) !!}
    </div>

    {!! Form::submit('Create the particle user!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

</div>
@endsection