@can('delete',$user)
    <div {{ $attributes }}>
        <form action="{{ route('users.delete',$user) }}}" method="POST" onSubmit="return confirm('Are you ok')">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </div>
@endcan
