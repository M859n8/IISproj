<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>

        header {
            font-family: Arial, sans-serif;
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
            color:#c4cfc9; /* Замінив білий на сіруватий */
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .horizontal-list a:hover {
            color: white;
        }



        /* Стилі для реєстраційної форми */
        .container {
            margin-top: 150px; /* Відступ для закріпленого меню */
            width: 50%;
            margin: 80px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .text-danger {
            color: red;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #629170;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #50735b;
        }

        .text-right {
            text-align: right; /* Вирівнювання тексту вправо */
        }

        #login-link {
            color: #629170; /* Зелений колір */
            text-decoration: underline; /* Підкреслення */
            font-weight: bold; /* Жирний текст */
            cursor: pointer; /* Курсор при наведенні */
        }

        #login-link:hover {
            color: #50735b; /* Темніший зелений при наведенні */
        }

    </style>
</head>

<body>

    <!-- Закріплене меню -->
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
    <div class="container">
        <h2>User Registration</h2>

        <form id="user-form" action="{{ route('regProfile') }}" method="POST">
            @csrf


            <!-- Фамілія -->
            <div class="form-group">
                <label for="name">Surname</label>
                <input type="text" name="surname" id="surname" value="{{ old('surname') }}" required autofocus>
                @error('surname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ім'я -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Електронна пошта -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Пароль -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Підтвердження пароля -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Кнопка реєстрації -->
            <div class="form-group">
                <button type="submit" class="btn">Register</button>
            </div>

            <!-- Кнопка логіну
            <div class="form-group">
                <button type="button" id="login-btn" class="btn btn-secondary">Login</button>
            </div> -->
        </form>
        <!-- Кнопка логіну -->
        <div class="form-group text-right">
            <a href="{{ route('login') }}" id="login-link">Login</a>
        </div>
        <!-- <script>
            document.getElementById('login-btn').addEventListener('click', function() {
                window.location.href = "{{ route('login') }}"; // Перенаправлення на сторінку логіну
            });
        </script> -->
    </div>
</body>
</html>
