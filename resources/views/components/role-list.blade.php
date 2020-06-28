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
        @each('components.role',$roles,'role')
        </tbody>
    </table>
</div>
