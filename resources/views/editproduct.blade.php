<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0; /* Прибираємо відступи у всьому документі */
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden; /* Прибираємо горизонтальне прокручування */
        }

        header {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #629170; /* Зелений колір для меню */
            z-index: 1000;
        }
        .horizontal-list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
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


        main {
            margin-top: 100px; /* Відступ для закріпленого меню */
            padding: 20px;
            background-color: #f4f4f4;
        }

        section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #629170;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #50735b;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #629170;
            color: #fff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="horizontal-list">

                <div class="menu-items">
                    <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>

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
                    @if(Auth::user()->role === 'Admin')
                        <li><a href="{{ route('users.list') }}"><i class="fas fa-users"></i> Users</a></li>
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

    <main>
        <section>
            <h2>Edit Product</h2>
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="{{ $product->price }}" required>

                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" value="{{ $product->quantity }}" required>

                <button type="submit">Update Product</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>
