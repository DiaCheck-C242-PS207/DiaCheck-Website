<nav class="nav-bottom fixed-bottom">
    <ul>
        <li class="list {{ $active === 'home' ? 'active' : '' }}">
            <a href="{{ route('home') }}" title="Home">
                <span class="icon">
                    <i class='bx {{ $active == 'home' ? 'bxs-home' : 'bx-home-alt-2' }}'></i>
                </span>
            </a>
        </li>
        <li class="list {{ $active === 'prediction' ? 'active' : '' }}">
            <a href="#" title="Prediction">
                <span class="icon">
                    <i class='bx {{ $active == 'prediction' ? 'bxs-notepad' : 'bx-notepad' }}'></i>
                </span>
            </a>
        </li>
        <li class="list {{ $active === 'articles' ? 'active' : '' }}">
            <a href="#" title="Articles">
                <span class="icon">
                    <i class='bx {{ $active == 'articles' ? 'bxs-news' : 'bx-news' }}'></i>
                </span>
            </a>
        </li>
        <li class="list {{ $active === 'profile' ? 'active' : '' }}">
            <a href="{{ route('profile.index') }}" title="Profile">
                <span class="icon">
                    <i class='bx {{ $active == 'profile' ? 'bxs-user' : 'bx-user' }}'></i>
                </span>
            </a>
        </li>
    </ul>
</nav>