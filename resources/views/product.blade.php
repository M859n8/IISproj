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

            </ul>
        </nav>
    </header>
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


        <h1>Order a product</h1>

        @if(Auth::user()->role === 'Customer')

            <form action="{{ route('createOrder', ['id' => $product->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <label for="quantity_{{ $product->id }}">Quantity:</label>
                <!-- <input type="number" id="quantity_{{ $product->id }}" name="quantity" min="1" required> -->
                <div style="display: flex; align-items: center;">
                    <input 
                        type="number" 
                        id="quantity_{{ $product->id }}" 
                        name="quantity" 
                        min="1" 
                        max="{{ $product->quantity }}" 
                        required 
                        oninput="validateQuantity('{{ $product->quantity }}', this)"
                        style="margin-right: 5px;"
                    >
                    <span>{{ $product->unit }}</span>
                </div>
                <small id="error-message-{{ $product->id }}" style="color: red; display: none;">
                    Entered quantity exceeds available stock.
                </small>
                <button id="order-button-{{ $product->id }}" type="submit">Order</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Log in as customer</a> to order this product.</p>

        @endif

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
    </div>

</body>
</html>

<script>
    function validateQuantity(maxQuantity, inputElement) {
        maxQuantity = parseInt(maxQuantity, 10); // Перетворення в число
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
