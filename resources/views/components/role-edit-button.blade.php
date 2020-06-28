@can('update',$role)
    <div {{ $attributes }}>
        <a href="{{ route('roles.edit',$role) }}" class="btn btn-primary">Edit</a>
    </div>
@endcan
