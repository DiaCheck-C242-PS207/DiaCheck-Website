<nav class="navbar sticky-top navbar-expand-md py-1 shadow-sm mb-4">
    <div class="container">
        <a href="{{ route('home') }}" class="logo-nav">
            <img src="{{ url('assets/images/diacheck-icon.png') }}" alt="DiaCheck Icon">
            <h5 class="fw-bold text-color py-0 my-0"><b class="primary-color">Dia</b>Check</h5>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex justify-content-center me-5 w-100">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link text-center d-flex align-items-center gap-1 {{ $active == 'home' ? 'active' : '' }}"><i class='bx {{ $active == 'home' ? 'bxs-home' : 'bx-home-alt-2' }}'></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link text-center d-flex align-items-center gap-1 {{ $active == 'prediction' ? 'active' : '' }}"><i class='bx {{ $active == 'prediction' ? 'bxs-notepad' : 'bx-notepad' }}'></i> Prediction</a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link text-center d-flex align-items-center gap-1 {{ $active == 'articles' ? 'active' : '' }}"><i class='bx {{ $active == 'articles' ? 'bxs-news' : 'bx-news' }}'></i> Articles</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}"
                        class="nav-link text-center d-flex align-items-center gap-1 {{ $active == 'profile' ? 'active' : '' }}"><i class='bx {{ $active == 'profile' ? 'bxs-user' : 'bx-user' }}'></i> Profile</a>
                </li>
            </ul>
        </div>
        <div class="dark-mode">
            <button class="dark-mode-toggle"><i class='bx bx-sun'></i></button>
        </div>
    </div>
</nav>


@push('scripts')
    <script>
        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Are you sure you want to logout?',
                showCancelButton: true,
                confirmButtonText: 'Logout',
                customClass: {
                    popup: 'bg-modal',
                    title: 'text-color',
                    htmlContainer: 'text-color fw-normal',
                    icon: 'border-primary primary-color',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
