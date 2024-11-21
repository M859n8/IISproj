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
            justify-content: center;
            list-style: none;
        }

        .horizontal-list li {
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

        .horizontal-list .logout {
            margin-left: auto; /* Це вирівняє елемент по правому краю */
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
                <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>
                @auth
                    @if(Auth::user()->role === 'Farmer')
                        <li><a href="{{ route('addproduct') }}"><i class="fas fa-plus"></i> Add new product</a></li>
                    @endif
                @endauth
                <li class="logout"><form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form></li>
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
