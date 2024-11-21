<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
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

        .btn-order-ready {
            display: inline-block; /* Щоб кнопка не була розтягнута */
            padding: 5px 15px; /* Менший відступ */
            background-color: #4caf50; /* Зелений колір */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px; /* Зменшений розмір шрифту */
            cursor: pointer;
        }

        .btn-order-ready:hover {
            background-color: #3e8e41; /* Трохи темніший колір при наведенні */
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
                <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                @auth
                    @if(Auth::user()->role === 'Farmer')
                        <li><a href="{{ route('addproduct') }}"><i class="fas fa-list-ul"></i> Add new product</a></li>
                    @endif
                @endauth
                @if(Auth::user()->role === 'Admin')
                    <li><a href="{{ route('users.list') }}"><i class="fas fa-users"></i> Users</a></li>
                @endif
                <li class="logout"><form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form></li>
            </ul>
        </nav>
    </header>


    <main>
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
        <section class="orders-section">
            <h2>Your Orders</h2>
            @if($orders->isEmpty())
                <p>No orders to display.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Product Name</th>
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
                                        @if($order->status !== 'prepared')
                                         <!-- to do -->
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>


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
        
        @if(Auth::user()->role === 'Farmer')
        <section>
            <h2>My Products</h2>
            @foreach(Auth::user()->products as $product)
                <div>
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Price:</strong> {{ $product->price }} USD</p>
                    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <a href="{{ route('editproduct', $product->id) }}">Edit</a>
                </div>
            @endforeach
        </section>
        @endif



        <!-- <section>
            <h2>Logout</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </section> -->
    </main>



    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>
