<div>
    <ul class="navbar-nav mr-auto">
        @can('viewAny', App\User::class)
            <li class="nav-item">
                <a href="/users" class="nav-link {{ $isActive("users") ? 'active':'' }}" class="nav-link">Users</a>
            </li>
        @endcan
        @can('viewAny', App\Article::class)
            <li class="nav-item">
                <a href="/articles" title="" class="nav-link {{ $isActive("articles") ? 'active':'' }}">Articles</a>
            </li>
        @endcan
        @can('viewAny', App\Role::class)
            <li class="nav-item">
                <a href="/roles" title="" class="nav-link {{ $isActive("roles") ? 'active':'' }}">Roles</a>
            </li>
        @endcan
    </ul>
</div>
