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
/*************************************************/
        .result-section {
            margin-top: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 20px auto;
        }

       .product-table {
           width: 100%;
           border-collapse: collapse;
           margin: 20px 0;
           font-size: 16px;
           text-align: left;
       }

       .product-table th, .product-table td {
           padding: 12px;
           border: 1px solid #ddd;
       }

       .product-table th {
           background-color: #f4f4f4;
           font-weight: bold;
       }

       .product-table tr:nth-child(even) {
           background-color: #f9f9f9;
       }

       .product-table a.product-name {
           color: #122910;
           text-decoration: none;
       }

       .product-table a.product-name:hover {
           text-decoration: underline;
       }

       .star-symbol {
           color: gold;
           margin-left: 5px;
       }

    </style>
</head>
<body>
    <!-- Меню зверху -->
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
                    @auth
                    @if(Auth::user()->role === 'Farmer')
                        <li><a href="{{ route('addproduct') }}"><i class="fas fa-plus"></i> Add new product</a></li>
                    @endif
                    <li><a href="{{ route('createcategory') }}"><i class="fas fa-plus"></i> Create Category</a></li>
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

            <select id="farmer" name="farmer">
                <option value="">All Farmers</option>
                @foreach($farmers as $farmer)
                    <option value="{{ $farmer->id }}" {{ request('farmer') == $farmer->id ? 'selected' : '' }}>
                        {{ $farmer->name }}</option>
                @endforeach
            </select>

            <!-- Пошук товару -->
            <input type="text" id="search" name="query" placeholder="Enter product name">

            <select name="sort_order" id="sort-order" onchange="this.form.submit()">
                <option value="" {{ request('sort_order') === null ? 'selected' : '' }}>Sort by price</option>
                <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>Low to High</option>
                <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>High to Low</option>
            </select>
            <!-- Кнопка пошуку -->
            <button type="submit">Search</button>
        </form>
    </section>

    <section class="result-section">

        <!-- Result table -->
        @if(isset($products) && $products->isNotEmpty())
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><a href="{{ route('productPage', $product->id) }}" class="product-name">{{ $product->name }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }} $</td>
                            <td>
                                {{ $product->rating_count > 0 ? round($product->rating_sum / $product->rating_count, 2) : 'No ratings yet' }}
                                <span class="star-symbol">★</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(isset($products))
            <p>Not found</p>
        @endif
    </section>


</body>
</html>
