@can('update',$article)
    <div {{ $attributes }}>
        <form action="{{ route("articles.edit",$article) }}">
            <button class="btn btn-link">Edit</button>
        </form>
    </div>
@endcan
