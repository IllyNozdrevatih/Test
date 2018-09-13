@extends('layouts.app')

@section('content')
    <table class="table">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>email</td>
            <td>territory</td>
        </tr>
        @foreach( $users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->area }} , {{ $user->city }} ,{{ $user->region }}</td>
            </tr>
        @endforeach
    </table>
@endsection