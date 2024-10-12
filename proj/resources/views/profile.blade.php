<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Your Profile</h1>
        <nav>
            <ul class="horizontal-list">
                <li><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                <li><a href="{{ route('categories') }}"><i class="fas fa-list-ul"></i> Categories</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Profile Information</h2>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john.doe@example.com</p>
            <p><strong>Joined:</strong> January 1, 2024</p>
        </section>

        <section>
            <h2>Order History</h2>
            <ul>
                <li>Order #12345 - 2 Apples, 1 Banana - Total: $10.00</li>
                <li>Order #12346 - 3 Oranges, 1 Mango - Total: $15.50</li>
            </ul>
        </section>

        <section>
            <h2>Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="John Doe">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="john.doe@example.com">
                <button type="submit">Update Profile</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>