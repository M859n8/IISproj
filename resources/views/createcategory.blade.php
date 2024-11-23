<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                @auth
                    @if(Auth::user()->role === 'Admin')
                        <li><a href="{{ route('users.list') }}"><i class="fas fa-users"></i> Users</a></li>
                        <li><a href="{{ route('categorylist') }}"><i class="fas fa-list-alt"></i> Pending Categories</a></li>
                    @endif
                @endauth
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Create New Category</h2>

    @if(session('success'))
        <p class="text-success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('createCategory') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name: *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                required 
                value="{{ old('name') }}"
                style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;"
            >
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="parent_id">Parent Category: *</label>
            <select 
                id="parent_id" 
                name="parent_id" 
                style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;"
            >
                <option value="">No Parent</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <p>* mandatory fields</p>

        <button type="submit" class="btn">Create Category</button>
    </form>
</div>

</body>
</html>
