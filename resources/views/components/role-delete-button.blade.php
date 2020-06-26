<div>
    @can('delete',$role)
        <div {{ $attributes }}>
            <form action="{{ route('roles.destroy',$role) }}"
                  onSubmit="return confirm('Are you sure?')" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endcan
</div>
