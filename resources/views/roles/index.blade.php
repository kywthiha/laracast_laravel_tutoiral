@extends('posts.layouts.app')
@section('link')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@endsection
@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="container-fluid">
                    <div class="row justify-content-end" style="margin-bottom: 10px;">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Add +</a>
                    </div>
                    <table id="users_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Abilities</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div class="row">
                                        @foreach($role->abilities as $ability)
                                            <div class="col">
                                                <span class="badge badge-primary">{{ $ability->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $role->created_users?$role->created_users->name:'System Admin' }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <a href="{{ route('roles.edit',$role) }}" class="btn btn-primary" style="margin-right: 10px;">Edit</a>
                                        <form action="{{ route('roles.delete',$role) }}" onSubmit="return confirm('Are you sure?')" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#users_table').DataTable();
        });
    </script>
@endsection

