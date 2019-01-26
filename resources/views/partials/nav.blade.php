<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.png" alt="Tool" width="30" height="30" class="d-inline-block align-top"> CRUD
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link {{ request()->is('lessons') ? 'active' : '' }}" href="{{ route('lessons.index') }}">Lessons</a>
                <a class="nav-item nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
            </div>
        </div>
    </div>
</nav>
