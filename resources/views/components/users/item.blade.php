<tr>
    <td> {{ $user->key }} </td>
    <td><a href="{{ route('users.show',$user) }}">{{ $user->name }}</a> </td>
    <td>{{ $user->email }}</td>
    <td>
        @foreach($user->roles as $role)
            <span class="badge badge-primary">{{ $role->name }}</span>
        @endforeach
    </td>
    <td>
        <span class="">{{ $user->created_date }}</span>
        <span class="badge badge-dark">{{ $user->created_time }}</span>
    </td>
    <td>
        @isset($user->assigned_user)
            {{ $user->assigned_user->name }}
        @endisset
    </td>
    <td>
        <a href="{{ route('users.assign_role',$user) }}" class="btn btn-sm btn-primary" style="width: 88px;">Assign Role</a>
    </td>
    <td>
        <form action="" method="POST" onSubmit="return confirm('Are you ok')">
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
