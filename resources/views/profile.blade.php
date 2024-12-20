<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0; 
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden; 
        }

        header {
            font-family: Arial, sans-serif;
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
            margin: 0;
        }

        main {
            margin-top: 100px; 
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
        .order-section td {
            padding: 5px;
        }
        .order-section th {
            padding: 5px;
        }

        .product-actions a {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .product-actions a:hover {
            background-color: #0056b3;
        }

        
        .self-picking-form {
            max-width: 300px; 
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .self-picking-form input[type="text"],
        .self-picking-form input[type="datetime-local"],
        .self-picking-form button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Button "Start Event" */
        .self-picking-form button {
            background-color: #629170;
            color: #fff;
            cursor: pointer;
            margin-top: 10px;
        }

        .self-picking-form button:hover {
            background-color: #50735b;
        }

        /* Button "Create Self Picking" */
        .create-self-picking-button {
            background-color: #629170;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: block;
            margin-top: 10px;
        }

        .create-self-picking-button:hover {
            background-color: #50735b;
        }



    </style>
</head>
<body>
    <!-- Menu -->
    <header>
        <nav>
            <ul class="horizontal-list">
                <div class="menu-items">
                    <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>
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


    <main>
        <!-- Section with information about user -->
        <section>
            <h2>Profile Information</h2>
            <p><strong>Surname:</strong> {{ Auth::user()->surname }}</p>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
            <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
        </section>

        @php
            $userType = auth()->user()->role;
        @endphp

        @auth
        @if(Auth::user()->role !== 'Admin')
        <!-- Section with orders -->
        <section class="order-section">
            <h2>Your Orders</h2>
            @if($orders->isEmpty())
                <p>No orders to display.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            @if($userType === 'Farmer')
                                <th>Action</th>
                            @endif
                            @if($userType === 'Customer')
                                <th>Rate</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Show list of orders -->
                        @foreach($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $order->product->name ?? 'Product not found' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->status }}</td>

                                @if($userType === 'Farmer')
                                    <td>
                                        @if($order->status !== 'prepared')
                                            <form action="{{ route('orderReady', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-order-ready">Order ready</button>
                                            </form>
                                        @else
                                            <span>None</span>
                                        @endif
                                    </td>
                                @endif

                                @if($userType === 'Customer')
                                    <td>
                                        @if($order->status === 'prepared')
                                            <form method="POST" action="{{ route('rateProduct', $order->id) }}">
                                                @csrf
                                                <input 
                                                    type="number" 
                                                    name="rating" 
                                                    min="1" 
                                                    max="5" 
                                                    step="1" 
                                                    placeholder="Rate from 1 to 5" 
                                                    style="width: 100%; box-sizing: border-box;" 
                                                    required>
                                                <button type="submit">Rate</button>
                                            </form>
                                        @endif
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>
        @endif
        @endauth


        @auth
        @if(Auth::user()->role === 'Customer')
        <!-- Section for self picking events for customer -->
        <section class="selfpicking-section">
            <h2>Your Self-Picking events</h2>

            @if($selfPickings->isEmpty())
                <p>You have no active self-pickings.</p>
            @else
                <ul class="self-pickings-list">
                    @foreach($selfPickings as $selfPicking)
                        <li>
                            <h3>{{ $selfPicking->product->name }}</h3>
                            <p>Place: {{ $selfPicking->address }}</p>
                            <p>End Time: {{ $selfPicking->end_time }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
        @endif
        @endauth


        <!-- Section for editing profile -->
        <section>
            <h2>Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>

                <button type="submit">Update Profile</button>
            </form>
        </section>

        
        @auth
        @if(Auth::user()->role === 'Farmer')
        <!-- Section for list of products for farmer -->
        <section class="order-section">
            <h2>My Products</h2>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Self-Picking</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }} USD</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                            @if($product->selfPicking)
                                <span>In Progress</span>
                            @else
                                <button type="button" class="create-self-picking-button">Create Self Picking</button>

                                <div class="self-picking-form" style="display:none;">
                                    <form action="{{ route('selfpicking.start', $product->id) }}" method="POST">
                                        @csrf
                                        <label for="address">Address:</label>
                                        <input type="text" id="address" name="address" required>
                                        
                                        <label for="city">City:</label>
                                        <input type="text" id="city" name="city" required>
                                        
                                        <label for="zip_code">Postal Code:</label>
                                        <input type="text" id="zip_code" name="zip_code" required>
                                        
                                        <label for="end_time">Event End Time:</label>
                                        <input type="datetime-local" id="end_time" name="end_time" required>
                                        
                                        <button type="submit">Start Event</button>
                                    </form>
                                </div>
                            @endif
                            </td>
                            <td>
                                <div class="product-actions">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                    <a href="{{ route('editproduct', $product->id) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        @endif
        @endauth

    </main>



    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all button and hidden form
        const buttons = document.querySelectorAll('.create-self-picking-button');
        const forms = document.querySelectorAll('.self-picking-form');

        // Add event listener for all button
        buttons.forEach((button, index) => {
            button.addEventListener('click', function(e) {
                const form = forms[index]; 

                if (form.style.display === 'none' || form.style.display === '') {
                    form.style.display = 'block'; // Show form
                    button.textContent = 'Hide'; // Change text of button
                } else {
                    form.style.display = 'none'; // Hide form
                    button.textContent = 'Create Self Picking'; 
                }
            });
        });
    });
</script>