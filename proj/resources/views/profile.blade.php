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
                <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>
                <li><a href="{{ route('addproduct') }}"><i class="fas fa-list-ul"></i> Add new product</a></li>

            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Profile Information</h2>
            <p><strong>Surname:</strong> {{ $user->surname }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>
        </section>

        <section>
            <h2>Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $user->email }}">

                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" value="{{ $user->surname }}" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                
                <!-- <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required> -->
                
                <button type="submit">Update Profile</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>
