<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <h4 class="h4">Edit Role</h4>
            <form action="{{route('roles.update',$role)}}" method="POST">
                @method('PUT')
                @csrf
                <x-article-input-text label="Role Name" name="name" :description="$role->name"/>
                <x-article-input-textarea label="Description" name="description" :description="$role->description"/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-master>
