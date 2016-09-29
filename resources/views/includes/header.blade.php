<nav>
    <div class="navbar-fixed">
        <a href="#" class="brand-logo">Tasks Manager</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            @if(Auth::check())
                <li>Hoşgeldin, {{Auth::user()->first_name}}</li>
                <li><a href="{{route('logout')}}">Logout</a></li>
            @endif
        </ul>
    </div>
</nav>



