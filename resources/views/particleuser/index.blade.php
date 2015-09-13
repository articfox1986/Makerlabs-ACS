<!-- app/views/particleuser/index.blade.php -->
 @extends('app')

 @section('content')
<div class="container">

@include('particleuser.nav')

<h1>All the Accounts</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->username }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the token (uses the destroy method DESTROY /tokens/{id} -->
                {!! Form::open(array('url' => 'accounts/' . $value->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete this Account', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}
                <!-- show the token (uses the show method found at GET /tokens/{id} -->
                <a class="btn btn-small btn-success" href="{{ url('accounts/' . $value->id) }}">Show this Account</a>

                <!-- edit this token (uses the edit method found at GET /tokens/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ url('accounts/' . $value->id . '/edit') }}">Edit this Account</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection