<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <h4 class="h4">New Role</h4>
            <form action="{{route('roles.store')}}" method="POST">
                @csrf
                <x-role-manage-form :role="$role" :abilities="$abilities"/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-master>
