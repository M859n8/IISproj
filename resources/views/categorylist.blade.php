<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Categories</title>
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
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #629170;
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
            color: #c4cfc9;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .horizontal-list a:hover {
            color: white;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #629170;
            color: white;
        }

        .btn-approve {
            padding: 5px 10px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-approve:hover {
            background-color: #229954;
        }

        .btn-delete {
            padding: 5px 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #c0392b;
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
                @auth
                    <li><a href="{{ route('profile') }}"><i class="fas fa-user"></i> Your profile</a></li>
                @else
                    <li><a href="{{ route('register') }}"><i class="fas fa-user"></i> Your profile</a></li>
                @endauth
                <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Search</a></li>
                @auth
                    <li><a href="{{ route('createcategory') }}"><i class="fas fa-plus"></i> Create Category</a></li>
                @endauth
                @auth
                    @if(Auth::user()->role === 'Admin')
                        <li><a href="{{ route('users.list') }}"><i class="fas fa-users"></i> Users</a></li>
                    @endif
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Pending Categories</h2>

            @if(session('success'))
                <div style="color: green; margin-top: 10px;">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                            <td>
                                <form action="{{ route('categoriesApprove', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-approve">Approve</button>
                                </form>

                                <form action="{{ route('categoriesDelete', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Green Market. All rights reserved.</p>
    </footer>
</body>
</html>
