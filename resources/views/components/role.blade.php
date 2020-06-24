<div>
    <tr>
        <td>{{ $role->name }}</td>
        <td>
            <div class="row ml-2">
                @foreach($role->abilities as $ability)
                    <div class="ml-1">
                        <span class="badge badge-secondary">{{ $ability->name }}</span>
                    </div>
                @endforeach
            </div>
        </td>
        <td>{{ $role->created_users?$role->created_users->name:'System Admin' }}</td>

        @can('update',$role)
            <td>
                <div class="row justify-content-center">
                    <a href="{{ route('roles.edit',$role) }}" class="btn btn-primary"
                       style="margin-right: 10px;">Edit</a>
                    <form action="{{ route('roles.destroy',$role) }}"
                          onSubmit="return confirm('Are you sure?')" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        @endcan
    </tr>
</div>
