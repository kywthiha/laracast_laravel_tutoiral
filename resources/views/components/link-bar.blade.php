<div>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a href="/" accesskey="1" title="" class="nav-link {{ $isActive("/")? 'active':'' }}">Homepage</a>
        </li>
        <li class="nav-item">
            <a href="/users" class="nav-link {{ $isActive("users") ? 'active':'' }}" accesskey="2" title="" class="nav-link">Users</a>
        </li>
        <li class="nav-item">
            <a href="/about" accesskey="3" title="" class="nav-link {{ $isActive("about") ? 'active':'' }}">About Us</a>
        </li>
        <li class="nav-item">
            <a href="/articles" accesskey="4" title="" class="nav-link {{ $isActive("articles") ? 'active':'' }}">Articles</a>
        </li>
        <li class="nav-item">
            <a href="/roles" accesskey="5" title="" class="nav-link {{ $isActive("roles") ? 'active':'' }}">Roles</a>
        </li>
    </ul>
</div>
