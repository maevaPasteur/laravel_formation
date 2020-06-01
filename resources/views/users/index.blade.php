@inject('UserController', 'App\Http\Controllers\UserController')
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
                                <th scope="col">En attente</th>
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
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        @if($user->verified === 0)
                                        <form action="{{ route('users.update', $session) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn green">Valider</button>
                                        </form>
                                        {{-- <form action="{{ route('users.destroy', $user) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn red">Refuser</button>
                                        </form> --}}
                                        @endif
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
