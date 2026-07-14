<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>NB Poultry Farm - @yield('title')</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite([
        'resources/css/app.css',
        'resources/css/dashboard.css',
        'resources/js/app.js'
    ])

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="profile">

            <div class="profile-image">

                <i class="fas fa-user"></i>

            </div>

            <div class="role">

                POULTRY STAFF

            </div>

        </div>

        <nav>

            <ul>

                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <a href="{{ route('dashboard') }}">

                        <i class="fas fa-chart-line"></i>

                        Dashboard

                    </a>

                </li>

                <li class="{{ request()->routeIs('production') ? 'active' : '' }}">

                    <a href="{{ route('production') }}">

                        <i class="fas fa-egg"></i>

                        Production

                    </a>

                </li>

                <li class="{{ request()->routeIs('inventory') ? 'active' : '' }}">

                    <a href="{{ route('inventory') }}">

                        <i class="fas fa-box"></i>

                        Inventory

                    </a>

                </li>

            </ul>

        </nav>

        <form action="{{ route('logout') }}"
            method="POST"
            class="logout">

            @csrf

            <button type="submit">

                <i class="fas fa-sign-out-alt"></i>

                Logout

            </button>

        </form>

    </aside>

    <!-- MAIN -->

    <main class="main-content">

        <!-- HEADER -->

        <header class="page-header">

            <h2>

                @yield('title')

            </h2>

            <div class="header-right">

                <div class="notification">

                    <i class="fas fa-bell"></i>

                    <span></span>

                </div>

            </div>

        </header>

        <!-- PAGE -->

        @yield('content')

    </main>

</div>

<footer class="footer">

    © {{ date('Y') }} NB Poultry Farm Management Information System | Version 1.0.0

</footer>
@stack('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>