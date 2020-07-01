@can('delete',$article)
    <div {{ $attributes }}>
        <form action="{{ route("articles.destroy",$article) }}"
              onSubmit="return confirm('Are you sure?')" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-link" style="color:red;">Delete</button>
        </form>
    </div>
@endcan

