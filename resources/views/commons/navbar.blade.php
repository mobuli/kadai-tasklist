<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    @if (Auth::check())
        <a class="navbar-brand" href="{{ route('tasks.index') }}">{{ Auth::user()->name }}さんのTasklist</a>
    @endif

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item"><a href="{{ route('tasks.create') }}" class="nav-link">新しいタスクを追加</a></li>
                    <li class="nav-item"><a href="{{ route('logout.get') }}" class="nav-link">ログアウト</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('signup.get') }}" class="nav-link">Signup</a></li>
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>