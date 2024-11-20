<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
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


        .product-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 80px auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }



    </style>
</head>
<body>
    <!-- Меню зверху -->
    <header>
        <nav>
            <ul class="horizontal-list">
                <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('register') }}"><i class="fas fa-user"></i> Your profile</a></li>
                <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                <li><a href="{{ route('addproduct') }}"><i class="fas fa-list-ul"></i> Add new product</a></li>

            </ul>
        </nav>
    </header>
    <div class="product-details">
        <h1>{{ $product->name }}</h1>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ $product->price }} $</p>
        <p><strong>Category:</strong>
        <ul>
            @forelse ($categories as $category)
                <li>{{ $category->name }}</li>
            @empty
                <li>No categories assigned.</li>
            @endforelse
        </ul>
        </p>
    </div>

</body>
</html>