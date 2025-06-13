<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
        @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                    @auth<span class="mr-2 text-gray-600 small">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>@endauth
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                        @csrf
                        <button type="submit" class="btn btn-link p-0">Logout</button>
                    </form>
                </div>
            </li>
        @endauth
    </ul>
</nav>
