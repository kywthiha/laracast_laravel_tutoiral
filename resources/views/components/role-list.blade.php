<div>
    <table id="users_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Abilities</th>
            <th>Created By</th>
            @can('create',\App\Role::class)
                <th>Action</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <x-role :role="$role"></x-role>
        @endforeach

        </tbody>
    </table>
</div>
