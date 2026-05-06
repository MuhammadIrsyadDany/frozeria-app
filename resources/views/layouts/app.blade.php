<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frozeria Stok</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .navbar-brand span {
            color: #0d6efd;
        }

        .nav-link.active {
            font-weight: 600;
        }

        .card-stat {
            border-left: 4px solid #0d6efd;
        }

        .card-stat.warning {
            border-left-color: #ffc107;
        }

        .card-stat.danger {
            border-left-color: #dc3545;
        }

        .card-stat.success {
            border-left-color: #198754;
        }

        .badge-kategori {
            font-size: 0.75rem;
            padding: 4px 10px;
        }

        .table th {
            background-color: #f1f3f5;
            font-weight: 600;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid px-4">

            {{-- Brand --}}
            <a class="navbar-brand text-white" href="{{ route('dashboard') }}">
                <i class="bi bi-snow2 me-1"></i>Frozeria <span class="text-warning">Stok</span>
            </a>

            {{-- Toggler Mobile --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Nav Links --}}
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                            href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags me-1"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bantuan') ? 'active' : '' }}"
                            href="{{ route('bantuan') }}">
                            <i class="bi bi-question-circle me-1"></i>Bantuan
                        </a>
                    </li>
                </ul>

                {{-- Tombol Tambah Barang --}}
                @if (request()->routeIs('dashboard'))
                    <a href="{{ route('barang.create') }}" class="btn btn-warning btn-sm fw-semibold">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Barang
                    </a>
                @endif

            </div>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <main class="container-fluid px-4 py-4">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Yield Konten --}}
        @yield('content')

    </main>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Stack Scripts --}}
    @stack('scripts')

</body>

</html>
