@inject('UserController', 'App\Http\Controllers\UserController')
@extends('layouts.app')

@section('content')
<section class="wrapper section-users">
    <h1>Liste des utilisateurs</h1>
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
                            <form action="{{ route('users.validateUser', $user) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn green">Valider</button>
                            </form>
                    {{-- <form action="{{ route('users.destroy', $user) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn red">Refuser</button>
                    </form> --}}
                @endif
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
</section>
@endsection
