@can('changePassword',$user)
    <div {{ $attributes }}>
        <a href="{{route('user.edit_password')}}" class="btn btn-primary">
            {{ __('Change Password') }}
        </a>
    </div>
@endcan
