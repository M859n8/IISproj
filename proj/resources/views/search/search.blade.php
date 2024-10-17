<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Загальні стилі */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color:  #629170; /* Сіро-зелений фон */
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
            color: #c4cfc9; /* Сіруватий колір тексту */
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .horizontal-list a:hover {
            text-decoration: underline;
        }

        /* Пошукова форма */
        .search-section {
            margin-top: 100px; /* Відступ зверху після меню */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 50%;
            margin: 100px auto;
            text-align: center;
        }

        .search-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .search-section form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .search-section select,
        .search-section input[type="text"] {
            width: 70%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-section button {
            padding: 10px 20px;
            background-color:  #629170;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-section button:hover {
            background-color: #50735b;
        }

    </style>
</head>
<body>
    <!-- Меню зверху -->
    <header>
        <h1>Green Market</h1>
        <nav>
            <ul class="horizontal-list">
                <li><a href="{{ route('profile') }}"><i class="fas fa-user"></i> Your profile</a></li>
                <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                <li><a href="{{ route('categories') }}"><i class="fas fa-list-ul"></i> Categories</a></li>
            </ul>
        </nav>

    </header>

    <!-- Пошукова форма -->
    <section class="search-section">
        <h2>Find your product</h2>
        <form action="{{ route('search') }}" method="GET">
            <!-- Вибір категорії -->
            <label for="category">Select Category:</label>
            <select id="category" name="category">
                <option value="">All Categories</option>
                <option value="fruits">Fruits</option>
                <option value="vegetables">Vegetables</option>
                <option value="dairy">Dairy</option>
                <option value="bakery">Bakery</option>
                <!-- Додати інші категорії за потреби -->
            </select>

            <!-- Пошук товару -->
            <label for="search">Search Product:</label>
            <input type="text" id="search" name="query" placeholder="Enter product name">

            <!-- Кнопка пошуку -->
            <button type="submit">Search</button>
        </form>
        @if($products->isNotEmpty())
            <ul>
                @foreach ($products as $product)
                    <li>{{ $product->name }} - {{ $product->price }} грн</li>
                @endforeach
            </ul>
        @else
            <p>Нічого не знайдено</p>
        @endif
    </section>
</body>
</html>
