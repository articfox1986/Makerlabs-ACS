<!-- app/views/accounts/edit.blade.php -->
 @extends('app')

 @section('content')
<div class="container">

@include('particleuser.nav')

<h1>Edit {{ $user->username }}</h1>

<!-- if there are creation errors, they will show here -->
@foreach($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach

{!! Form::model($user, array('route' => array('accounts.update', $user->id), 'method' => 'PUT')) !!}

    <div class="form-group">
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username', null, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::text('password', null, array('class' => 'form-control')) !!}
    </div>

    {!! Form::submit('Edit the Account!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

</div>
@endsection