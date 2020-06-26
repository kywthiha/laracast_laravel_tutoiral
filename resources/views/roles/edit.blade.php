<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <h4 class="h4">Edit Role</h4>
            <form action="{{route('roles.update',$role)}}" method="POST">
                @method('PUT')
                @csrf
                <x-role-manage-form :role="$role" :abilities="$abilities"/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-master>
