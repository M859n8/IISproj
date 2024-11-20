<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new product</title>
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
                <li><a href="{{ route('register') }}"><i class="fas fa-user"></i> Your profile</a></li>
                <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> Your shopping cart</a></li>

            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Add new product</h2>

        <form action="{{ route('createProduct') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name: *</label>
                <input type="text" id="name" name="name"  required >

            </div>
            <div class="form-group">
                <label for="price">Price: *</label>
                <input type="number" id="price" name="price" min="0"  required>

            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description"  >

            </div>

            <div class="form-group">
                 <label for="category">Categories:</label>


                 <select id="category" name="category_id">
                     <option value="">Select category</option>
                     @foreach($categories as $category)
                         @include('partials.category-option', ['category' => $category, 'level' => 0])
                     @endforeach
                 </select>
            </div>



            <div class="form-group">
            <button type="submit" class="btn">Create Product</button>
            </div>


        </form>
</body>
</html>