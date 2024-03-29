@extends('dashboard.master')
@section('title', 'Users')

@section('content')

    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Users </h3>
        <a href="{{ route('users.create') }}" class="btn btn-success" style="float: right">Create</a>
        <div class="row">
            <!-- /col-md-12 -->
            <div class="col-md-12 mt">
                <div class="content-panel">
                    <table class="table table-hover">

                        <h4><i class="fa fa-angle-right"></i> Users List</h4>

                        <hr>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>E-mail</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <img width="50" src="{{ $user->fullImage }}" alt="Profile image">
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /col-md-12 -->
        </div>
    </section>

@endsection

@section('scripts')

@endsection
