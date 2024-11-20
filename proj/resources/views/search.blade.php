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
           margin: 0;
           padding: 0;
           box-sizing: border-box;
           position: fixed;
           top: 0;
           width: 100%;
           background-color: #629170; /* Замінив зелений на сіро-зелений */
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
            color: white;
        }

        /* Пошукова форма */
        .search-section {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 80%;
            margin: auto;
            margin-top: 100px;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .search-section form {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
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
        .result-section {
            margin-top: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 20px auto;
        }

        .product-table {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .table-header, .product-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .table-header {
            font-weight: bold;
            background-color: #f0f0f0;
            padding-bottom: 15px;
        }

        .table-header span, .product-row span, .product-row a {
            padding: 5px 10px;
        }
        .table-header span {
            padding: 5px 10px;
            /* Використовуємо ті ж значення flex-grow для відповідних колонок */
            flex-grow: 2; /* Для назви продукту */
        }

        .table-header .description-header {
            flex-grow: 4; /* Для опису продукту */
        }

        .table-header .price-header{
            flex-grow: 1; /* Для ціни і категорії */
        }

        .product-name {
            font-weight: bold;
            color: black;
            text-decoration: none;
            flex-grow: 2; /* Назва продукту */
        }

        .product-name:hover {
            text-decoration: underline;
        }

        .product-description {
            color: #666;
            flex-grow: 4; /* Опис продукту – більше місця */
        }

        .product-price {
            color: #999;
            flex-grow: 1; /* Ціна продукту */
        }




    </style>
</head>
<body>
    <!-- Меню зверху -->
    <header>
        <nav>
            <ul class="horizontal-list">
                <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>

                @auth
                    <li><a href="{{ route('profile') }}"><i class="fas fa-user"></i> Your profile</a></li>
                @else
                    <li><a href="{{ route('register') }}"><i class="fas fa-user"></i> Your profile</a></li>
                @endauth

                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                <li><a href="{{ route('addproduct') }}"><i class="fas fa-list-ul"></i> Add new product</a></li>
            </ul>
        </nav>

    </header>

    <!-- Пошукова форма -->
    <!-- Пошукова форма -->
    <section class="search-section">
        <h2>Find your product</h2>

        <form action="{{ route('search') }}" method="GET">
            <!-- Вибір категорії -->
            <select id="category" name="category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    @include('partials.category-option', ['category' => $category, 'level' => 0])
                @endforeach
            </select>

            <!-- Пошук товару -->
            <input type="text" id="search" name="query" placeholder="Enter product name">

            <!-- Кнопка пошуку -->
            <button type="submit">Search</button>
        </form>
    </section>

    <section class="result-section">
        @if(isset($products) && $products->isNotEmpty())
            <div class="product-table">
                <div class="table-header">
                    <span class="name-header">Назва</span>
                    <span class="description-header">Опис</span>
                    <span class="price-header">Ціна</span>
                </div>
                @foreach ($products as $product)
                    <div class="product-row">
                        <a href="{{ route('productPage', $product->id) }}" class="product-name">{{ $product->name }}</a>
                        <span class="product-description">{{ $product->description }}</span>
                        <span class="product-price">{{ $product->price }} $</span>
                    </div>
                @endforeach
            </div>
        @elseif(isset($products))
            <p>Not found</p>
        @endif
    </section>


</body>
</html>
