@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            @can('is-admin')
                                <th scope="col">Mail</th>
                                <th scope="col">Rôle</th>
                            @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                @can('is-admin')
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('users.update', $user) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                            <select name="role" id="role">
                                                <option value="{{ $user->role }}">{{ $user->role }}</option>
                                                @foreach($collection as $role)
                                                    @if( $role != $user->role ) {
                                                        <option value="{{ $role }}">{{ $role }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <button class="btn red" type="submit">Changer le rôle</button>
                                        </form>
                                    </td>
                                @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
