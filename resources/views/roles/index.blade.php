<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="container-fluid">
                    @can('create',\App\Role::class)
                        <div class="row justify-content-end" style="margin-bottom: 10px;">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary">Add +</a>
                        </div>
                    @endcan
                    <x-role-list :roles="$roles"/>
                </div>
            </div>
        </div>
    </div>
</x-master>


