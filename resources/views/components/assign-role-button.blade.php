@can('assignRole',$user)
    <div {{ $attributes }}>
        <a href="{{route('users.assign_role',$user)}}" class="btn btn-sm btn-primary">
            {{ __('Assign Role') }}
        </a>
    </div>
@endcan
