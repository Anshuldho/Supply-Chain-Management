<!-- resources/views/scm/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
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
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background: #f8f9fa;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        button {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Create New Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Create Product</button>
    </form>
</div>
</body>
</html>
