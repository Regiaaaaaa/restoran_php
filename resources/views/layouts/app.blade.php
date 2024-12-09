<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Restoran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Josefin Sans';
            background-color: #f9f9f9;
            margin: 0;
            display: flex; /* Flexbox untuk menampilkan sidebar dan konten utama berdampingan */
            flex-direction: row;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #fff;
            color: #212121;
            width: 220px;  /* Lebar default sidebar lebih kecil */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            justify-content: flex-start;
            transition: width 0.3s ease; /* Smooth transition for width change */
        }

        .sidebar.collapsed {
            width: 80px; 
        }

        .sidebar ul {
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar .nav-item {
            list-style: none;
            margin-bottom: 1rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #212121;
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-link {
            font-size: 0.9rem;
            padding-left: 10px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .nav-link:hover {
            color: #1976d2;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            background-color: transparent;
        }

        .sidebar .nav-link.active {
            color: #1976d2;
            font-weight: bold;
        }

        /* Main content styling */
        .main-content {
            margin-left: 220px;  /* Sesuaikan margin sesuai dengan lebar sidebar */
            padding: 2rem;
            background-color: #fff;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        /* Styling for login and register forms */
        .login-container{
        width: 100%; /* Lebar penuh layar */
        max-width: 400px; /* Maksimal lebar form */
        background: #fff; /* Latar belakang putih */
        padding: 2rem; /* Ruang dalam */
        border-radius: 10px; /* Sudut melengkung */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan */
        align-items: center;
        margin-left: 63vh;
        margin-top: 15vh;
        }

        .register-container{
        width: 100%; /* Lebar penuh layar */
        max-width: 400px; /* Maksimal lebar form */
        background: #fff; /* Latar belakang putih */
        padding: 2rem; /* Ruang dalam */
        border-radius: 10px; /* Sudut melengkung */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan */
        align-items: center;
        margin-left: 63.5vh;
        margin-top: 12vh;
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            font-size: 1.1rem;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 1rem;
        }

        .toggle-btn {
            position: absolute;
            top: 25px;
            right: -25px;
            cursor: pointer;
            background-color: #3498db;
            color: #fff;
            padding: 8px 12px;
            border-radius: 50%;
            font-size: 1.2rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .logout-btn img {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .logout-btn img:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }

        .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    @if(auth()->check())
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <ul>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active @endif">
                    <i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link @if(request()->routeIs('categories.index')) active @endif">
                    <i class="fas fa-list-alt me-2"></i> <span>Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('menus.index') }}" class="nav-link @if(request()->routeIs('menus.index')) active @endif">
                    <i class="fas fa-utensils me-2"></i> <span>Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}" class="nav-link @if(request()->routeIs('orders.index')) active @endif">
                    <i class="fas fa-clipboard-list me-2"></i> <span>Pesanan</span>
                </a>
            </li>
        </ul>
        <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <img src="{{ asset('icons/lot.png') }}" alt="Logout">
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
    @else
    <!-- Main Content for Login/Register -->
    <div class="form-container">
    @if(request()->routeIs('register'))
    <div class="register-container">
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
    @else
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>
    @endif
</div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
