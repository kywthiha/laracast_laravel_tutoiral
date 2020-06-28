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
        <td>
            <div class="row justify-content-between" style="padding-left: 10px;padding-right: 10px;">
                <x-role-edit-button :role="$role"/>
                <x-role-delete-button :role="$role"/>
            </div>
        </td>
    </tr>
</div>
