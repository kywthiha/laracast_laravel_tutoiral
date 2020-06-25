@can('update',$article)
    <div {{ $attributes }}>
        <form action="{{ route("articles.edit",$article) }}">
            <button class="btn btn-xs btn-primary" style="font-size: x-small;">Edit</button>
        </form>
    </div>
@endcan
