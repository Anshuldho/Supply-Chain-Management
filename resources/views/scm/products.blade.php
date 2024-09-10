<!-- resources/views/scm/products.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
            font-family: 'Arial', sans-serif;
        }
        .container {
            display: flex;
            max-width: 1200px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            flex: 3;
        }
        .sidebar {
            flex: 1;
            margin-left: 20px;
            background: #f7fafc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #edf2f7;
            color: #333;
        }
        tr:hover {
            background-color: #f7fafc;
        }
        .timestamp {
            color: #666;
            font-size: 0.9em;
        }
        p {
            text-align: center;
            color: #555;
            font-size: 1.1em;
        }
        .delete-btn {
            background-color: #e3342f;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #cc1f1a;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container input, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            background-color: #38a169;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #2f855a;
        }
        .login-form button, .logout-form button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #3182ce;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-form button:hover, .logout-form button:hover {
            background-color: #2b6cb0;
        }
        .login-form button i {
            margin-right: 8px;
            font-size: 1em;
        }
    </style>
</head>
<body>
@auth
    <div class="container">
        <div class="main-content">
            <h1 class="text-2xl font-bold mb-4">Products List</h1>
            @if($products->isEmpty())
                <p class="text-center text-gray-500">No products found.</p>
            @else
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Timestamp</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->location }}</td>
                            <td class="timestamp">{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="sidebar">
            <h2 class="text-xl font-semibold mb-4">Add New Product</h2>
            <div class="form-container">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Product Name" required>
                    <input type="text" name="location" placeholder="Product Location" required>
                    <button type="submit">Add Product</button>
                </form>
            </div>

            <h2 class="text-xl font-semibold mt-6 mb-4">Logged In Users</h2>
            <ul>
                @foreach($loggedInUsers as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>

            <h2 class="text-xl font-semibold mt-6 mb-4">Logout</h2>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
@else
    <div class="container">
        <div class="sidebar">
            <h2 class="text-xl font-semibold mb-4">Login</h2>
            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
    </div>
@endauth
</body>
</html>
