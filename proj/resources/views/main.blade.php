<!DOCTYPE html>
<html>
<head>
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
            justify-content: center;
            list-style: none;
        }

        .horizontal-list li {
            margin: 0 15px;
        }

        .horizontal-list a {
            color:#c4cfc9; /* Замінив білий на сіруватий */
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .horizontal-list a:hover {
            color: white;
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

        /* Стилі для пошукової секції */
        .search-section {
            padding: 50px;
            margin-top: 20px;
            background-color: #fff;
        }

        .search-section h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .search-section form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-section input[type="text"] {
            padding: 10px;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-section button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #629170; /* Замінив зелений на сіро-зелений */
            color: #c4cfc9; /* Замінив білий на сіруватий */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-section button:hover {
            background-color: #50735b; /* Трохи темніший відтінок сіро-зеленого для ефекту при наведенні */
        }

    </style>
</head>
<body>
    <!-- Закріплене меню -->
    <header>
        <nav>
            <ul class="horizontal-list">
                <li><a href="{{ route('profile') }}"><i class="fas fa-user"></i> Your profile</a></li>
                <li><a href="#search"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                <li><a href="{{ route('categories') }}"><i class="fas fa-list-ul"></i> Categories</a></li>
            </ul>
        </nav>
    </header>

    <!-- Основний контент сторінки -->
    <main>
        <!-- Назва сайту по центру з окремим фоном -->
        <section class="site-title">
            <h1>Green Market</h1>
        </section>

        <!-- Блок пошуку (з'являється при кліку на "Search") -->
        <section id="search" class="search-section">
            <h2>Search</h2>
            <form action="{{ route('search.results') }}" method="GET">
                <input type="text" name="query" placeholder="Search for products..." required>
                <button type="submit">Search</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>