<!DOCTYPE html>
<html>
<head>
    <!-- mk-->

	<title>Green market</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        /* Загальні стилі */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #629170; /* Замінив зелений на сіро-зелений */
            padding: 15px 0;
            z-index: 1000;
        }

        .horizontal-list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            padding-inline: 40px;
        }
        .menu-items {
            display: flex;
            gap: 15px; /* Відстань між пунктами меню */
        }
        .menu-items li,
        .logout-button li {
            /*list-style: none;*/
            margin: 0 15px;
        }
        .horizontal-list a {
            color: #c4cfc9; /* Замінив білий на сіруватий */
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        .horizontal-list a:hover {
            color: white;
        }
        .logout-button button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #629170;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 0;
        }
        .logout-button button:hover {
            background-color: #50735b;
        }

        /* Стилі для назви сайту */
        .site-title {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Висота на всю висоту вікна */
            background-color: #333;
            color: #aab3ae; /* Замінив білий на сіруватий */
            text-align: center;
        }

        .site-title h1 {
            font-size: 5rem;
            margin: 0;
        }


    </style>
</head>
<body>
    <!-- Закріплене меню -->
    <header>
        <nav>
            <ul class="horizontal-list">

                <div class="menu-items">

                    @auth
                        <li><a href="{{ route('profile') }}"><i class="fas fa-user"></i> Your profile</a></li>
                    @else
                        <li><a href="{{ route('register') }}"><i class="fas fa-user"></i> Your profile</a></li>
                    @endauth
                    <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                    @auth
                    @if(Auth::user()->role === 'Farmer')
                        <li><a href="{{ route('addproduct') }}"><i class="fas fa-plus"></i> Add new product</a></li>
                    @endif
                @endauth
                @auth
                    <li><a href="{{ route('createcategory') }}"><i class="fas fa-plus"></i> Create Category</a></li>
                @endauth
                @auth
                    @if(Auth::user()->role === 'Admin')
                        <li><a href="{{ route('users.list') }}"><i class="fas fa-users"></i> Users</a></li>
                        <li><a href="{{ route('categorylist') }}"><i class="fas fa-list-alt"></i> Pending Categories</a></li>
                    @endif
                    @endauth
                </div>
                @auth
                <div class="logout-button">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </div>
                @endauth
            </ul>
        </nav>
    </header>

    <!-- Основний контент сторінки -->
    <main>
        <!-- Назва сайту по центру з окремим фоном -->
        <section class="site-title">
            <h1>Green Market</h1>
        </section>


    </main>

    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>