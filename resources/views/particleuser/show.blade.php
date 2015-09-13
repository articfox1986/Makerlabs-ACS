<!-- app/views/particletoken/show.blade.php -->
 @extends('app')

 @section('content')
<div class="container">

@include('particleuser.nav')

<h1>Showing {{ $user->username }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $user->username }}</h2>
        <p>
            <strong>Password:</strong> {{ $user->password }}<br>
        </p>
    </div>

</div>
@endsection