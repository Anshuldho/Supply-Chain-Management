<!-- resources/views/scm/products.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
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
    </style>
</head>
<body>
<div class="container">
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
</body>
</html>
