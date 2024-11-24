<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        
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
           background-color: #629170; 
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
            gap: 15px; 
        }
        .menu-items li,
        .logout-button li {
            margin: 0 15px;
        }
        .horizontal-list a {
            color: #c4cfc9; 
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

        /* page content */
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
        .order-details {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 15px;
        }

        button {
            padding: 5px 10px;
            background-color:  #629170;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #50735b;
        }



    </style>
</head>
<body>
    <!-- menu -->
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
    <!-- product content section  -->
    <div class="product-details">
        <h1>{{ $product->name }}</h1>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ $product->price }} $</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }} </p>

        <p><strong>Category:</strong>
        <ul>
            @forelse ($categories as $category)
                <li>{{ $category->name }}</li>
            @empty
                <li>No categories assigned.</li>
            @endforelse
        </ul>
        </p>

        <!-- order a product section  -->
        <h3>Order a product:</h3>
        @auth
        @if(Auth::user()->role === 'Customer')
            <form action="{{ route('createOrder', ['id' => $product->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="order-details">

                <div class="quantity-input">
                    <label for="quantity_{{ $product->id }}">Quantity:</label>

                    <input
                        type="number"
                        id="quantity_{{ $product->id }}"
                        name="quantity"
                        min="1"
                        max="{{ $product->quantity }}"
                        required
                        oninput="validateQuantity('{{ $product->quantity }}', this)"
                    >
                    <span> {{ $product->unit }}</span>
                </div>
                <small id="error-message-{{ $product->id }}" style="color: red; display: none;">
                    Entered quantity exceeds available stock.
                </small>
                <button id="order-button-{{ $product->id }}" type="submit">Order</button>
            </form>
            </div>
            <!-- self-picking section  -->
            @if ($selfPicking)
                <div class="self-picking-details">
                    <h3>Self-Picking Details:</h3>
                    <p>Place: {{ $selfPicking->address }}</p>
                    <p>Ends at: {{ $selfPicking->end_time }}</p>

                    @if($selfPicking->end_time > now())
                        <form method="POST" action="{{ route('self-picking.subscribe', $selfPicking->id) }}">
                            @csrf
                            <button type="submit" class="subscribe-button">Subscribe</button>
                        </form>
                    @else
                        <p>This self-picking has ended.</p>
                    @endif
                </div>
            @else
                <p>No self-picking available for this product.</p>
            @endif

        @else
            <p><a href="{{ route('login') }}">Log in as customer</a> to order this product.</p>

        @endif
        @else
            <p><a href="{{ route('login') }}">Log in as customer</a> to order this product.</p>
        @endauth

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

    </div>

</body>
</html>

<!-- check ordered quantity  -->
<script>
    function validateQuantity(maxQuantity, inputElement) {
        maxQuantity = parseInt(maxQuantity, 10); 
        const errorMessage = document.getElementById(`error-message-${inputElement.id.split('_')[1]}`);
        const orderButton = document.getElementById(`order-button-${inputElement.id.split('_')[1]}`);
        if (parseInt(inputElement.value, 10) > maxQuantity) {
            errorMessage.style.display = 'block';
            inputElement.setCustomValidity('Entered quantity exceeds available stock.');
            orderButton.style.display = 'none'; 
        } else {
            errorMessage.style.display = 'none'; 
            inputElement.setCustomValidity('');
            orderButton.style.display = 'inline-block';
        }
    }
</script>
