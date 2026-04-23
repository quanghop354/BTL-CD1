<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Lý Thư Viện')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #f6f6f6ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand {
            font-weight: 700;
            color: #2c3e50 !important;
            font-size: 1.25rem;
        }

        .navbar-nav .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #667eea !important;
            transform: translateY(-1px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 8px;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #ffffffff 100%);
            color: white;
            transform: translateX(5px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #ffffffff 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .btn {
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #ffffffff 100%);
        }

        .btn-outline-primary {
            border-color: #667eea;
            color: #667eea;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #ffffffff 100%);
            color: white;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.8) !important;
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #6c757d;
            font-weight: 500;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background: linear-gradient(135deg, #667eea 0%, #f8f8f8ff 100%);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid #f8f9fa;
        }

        .badge {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
            backdrop-filter: blur(10px);
        }

        .pagination {
            gap: 6px;
            margin-bottom: 0;
            align-items: center;
        }

        .page-item .page-link {
            border-radius: 50% !important;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .page-item:not(.active) .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            border: none;
        }

        .page-item.disabled .page-link {
            background: #f8f9fa;
            color: #adb5bd;
            box-shadow: none;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        {{-- Sidebar Bên Trái --}}
        @if(!request()->routeIs('login') && !request()->routeIs('register'))
        <div class="sidebar bg-dark text-white p-3 d-flex flex-column" style="width: 260px; flex-shrink: 0; box-shadow: 2px 0 10px rgba(0,0,0,0.2); z-index: 10;">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="fas fa-book fa-2x me-2 text-primary" style="color: #667eea !important;"></i>
                <span class="fs-4 fw-bold">LibTech</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                @auth
                    <li class="nav-item mb-2">
                        <a href="{{ route('dashboard') }}" class="nav-link text-white">
                            <i class="fas fa-home me-2"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('books.index') }}" class="nav-link text-white">
                            <i class="fas fa-book me-2"></i> Sách
                        </a>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item mb-2">
                            <a href="{{ route('readers.index') }}" class="nav-link text-white">
                                <i class="fas fa-users me-2"></i> Độc Giả
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('categories.index') }}" class="nav-link text-white">
                                <i class="fas fa-tags me-2"></i> Thể Loại
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('authors.index') }}" class="nav-link text-white">
                                <i class="fas fa-user-tie me-2"></i> Tác Giả
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('publishers.index') }}" class="nav-link text-white">
                                <i class="fas fa-building me-2"></i> Nhà Xuất Bản
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('shelves.index') }}" class="nav-link text-white">
                                <i class="fas fa-layer-group me-2"></i> Kệ Sách
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('reviews.index') }}" class="nav-link text-white">
                                <i class="fas fa-star me-2"></i> Đánh Giá
                            </a>
                        </li>
                    @endif
                    <li class="nav-item mb-2">
                        <a href="{{ route('borrows.index') }}" class="nav-link text-white">
                            <i class="fas fa-handshake me-2"></i> Mượn Trả
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('payments.index') }}" class="nav-link text-white">
                            <i class="fas fa-file-invoice-dollar me-2"></i> Thanh Toán
                        </a>
                    </li>
                @else
                    <li class="nav-item mb-2">
                        <a href="{{ route('login') }}" class="nav-link text-white">Đăng nhập</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('register') }}" class="nav-link text-white">Đăng ký</a>
                    </li>
                @endauth
            </ul>
            
            @auth
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-2x me-2"></i>
                    <strong class="me-2">{{ Auth::user()->name }}</strong>
                    <span class="badge bg-info ms-auto">{{ Auth::user()->isAdmin() ? 'Admin' : 'User' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Thông tin cá nhân</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
        @endif

        {{-- Nội dung chính --}}
        <div class="main-content flex-grow-1 d-flex flex-column" style="width: {{ request()->routeIs('login') || request()->routeIs('register') ? '100%' : 'calc(100% - 260px)' }}; height: 100vh; overflow-y: auto; overflow-x: hidden;">
            <div class="container-fluid px-4 mt-4 flex-grow-1">
                @yield('breadcrumb')

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <footer class="mt-auto">
                <div class="container-fluid px-4 text-start">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h5 class="text-white mb-3"><i class="fas fa-book-reader me-2"></i>LibTech</h5>
                            <p class="text-light opacity-75">Nơi lưu giữ tri thức và khơi nguồn đam mê đọc sách. Cung cấp hàng ngàn đầu sách đa dạng thể loại cho mọi lứa tuổi.</p>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h5 class="text-white mb-3">Liên Hệ</h5>
                            <ul class="list-unstyled text-light opacity-75">
                                <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Đường ABC,Quận Hà Đông, TP.Hà Nội</li>
                                <li class="mb-2"><i class="fas fa-phone me-2"></i> Hotline: 0356798504</li>
                                <li class="mb-2"><i class="fas fa-envelope me-2"></i> Email: quanghop300504@gamil.com</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-white mb-3">Giờ Hoạt Động</h5>
                            <ul class="list-unstyled text-light opacity-75">
                                <li class="mb-2">Thứ 2 - Thứ 6: 08:00 - 20:00</li>
                                <li class="mb-2">Thứ 7 - CN: 08:00 - 17:00</li>
                                <li class="mb-2">Ngày lễ: Nghỉ</li>
                            </ul>
                        </div>
                    </div>
                    <hr class="border-light opacity-25 my-4">
                    <div class="text-center text-light opacity-75">
                        <p class="mb-0">&copy; 2026 Hệ Thống Quản Lý Thư Viện. Tất cả quyền được bảo lưu.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>