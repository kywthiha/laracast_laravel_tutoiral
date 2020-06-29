<div>
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
        <td style="width: 200px;">
            <div class="row justify-content-between" style="padding: 10px;">
                <x-assign-role-button :user="$user"/>
                <x-user-delete-button :user="$user"/>
            </div>
        </td>
    </tr>
</div>
