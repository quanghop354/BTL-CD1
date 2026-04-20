<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Library Management System') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            min-height: 100vh;
            /* === THÊM ẢNH BACKGROUND Ở ĐÂY === */
            background-image: url(Copy-Item "C\Users\ASUS\Pictures\lytv.png" "c:\xampp\htdocs\library-management\public\images\library-bg.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(11, 30, 68, 0.55);
            pointer-events: none;
        }

        .page-wrapper {
            position: relative;
            z-index: 1;
        }

        .site-header {
            width: 100%;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            color: #fff;
            font-size: 1.35rem;
            font-weight: 700;
            text-decoration: none;
        }

        .brand i {
            color: #8ec5fc;
        }

        .hero {
            max-width: 980px;
            margin: 5rem auto 2rem;
            padding: 3rem 2rem;
            background: rgba(4, 23, 63, 0.75);
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: 0 32px 80px rgba(0,0,0,0.24);
            text-align: center;
        }

        .hero h1 {
            font-size: clamp(2.75rem, 5vw, 4rem);
            line-height: 1.05;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.85);
            margin-bottom: 2rem;
            max-width: 760px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, #4f46e5, #22c55e);
            color: #fff;
            padding: 0.95rem 1.7rem;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(34, 197, 94, 0.22);
        }

        .features {
            max-width: 1100px;
            margin: 0 auto 4rem;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            background: rgba(255,255,255,0.09);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 22px;
            padding: 1.9rem;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: transform 0.25s ease, border-color 0.25s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255,255,255,0.28);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            display: grid;
            place-items: center;
            border-radius: 18px;
            background: rgba(255,255,255,0.12);
            color: #8ec5fc;
            font-size: 1.25rem;
        }

        .feature-card h3 {
            font-size: 1.15rem;
            margin: 0;
        }

        .feature-card p {
            color: rgba(255,255,255,0.78);
            line-height: 1.7;
            margin: 0;
        }

        .footer {
            text-align: center;
            padding: 2rem 1rem;
            color: rgba(255,255,255,0.65);
        }

        @media (max-width: 768px) {
            .site-header {
                flex-direction: column;
                gap: 1rem;
            }

            .hero {
                margin: 4rem 1rem 2rem;
                padding: 2.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <header class="site-header">
            <a class="brand" href="/">
                <i class="fas fa-book-open"></i>
                LibraryMS
            </a>
            <a href="{{ route('dashboard') }}" class="btn-primary">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </header>

        <main>
            <section class="hero">
                <h1>Chào mừng đến với hệ thống quản lý thư viện</h1>
                <p>Quản lý sách, độc giả, danh mục và quá trình mượn trả trong một nền tảng đơn giản, nhanh chóng và trực quan.</p>
                <a href="{{ route('dashboard') }}" class="btn-primary">
                    <i class="fas fa-rocket"></i>
                    Bắt đầu ngay
                </a>
            </section>

            <section class="features">
                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-book"></i></div>
                    <h3>Quản lý sách</h3>
                    <p>Quản lý kho sách với thông tin chi tiết, danh mục và trạng thái sẵn sàng mượn.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-users"></i></div>
                    <h3>Quản lý độc giả</h3>
                    <p>Quản lý hồ sơ độc giả, lịch sử mượn và thông tin liên hệ dễ dàng.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-exchange-alt"></i></div>
                    <h3>Mượn trả</h3>
                    <p>Theo dõi quá trình mượn và trả sách, báo cáo sách quá hạn và lịch sử trả.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-tags"></i></div>
                    <h3>Danh mục</h3>
                    <p>Phân loại sách theo danh mục để tìm kiếm nhanh và tổ chức thư viện khoa học.</p>
                </article>
            </section>
        </main>

        <footer class="footer">
            <p> {{ date('Y') }} Library Management System. Built with Laravel.</p>
        </footer>
    </div>
</body>
</html>
