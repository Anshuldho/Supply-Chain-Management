<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model
use App\Models\User; // Import the User model

class ProductController extends Controller
{
    // Show the list of products
    public function index()
    {
        // Retrieve all products
        $products = Product::all();

        // Example for getting logged-in users (assuming is_logged_in is a column in the users table)
        $loggedInUsers = User::where('is_logged_in', true)->get();

        // Return the view with products and loggedInUsers
        return view('scm.products', compact('products', 'loggedInUsers'));
    }

    // Show the create product form
    public function create()
    {
        return view('scm.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Create and save a new product
        $product = new Product();
        $product->name = $validated['name'];
        $product->location = $validated['location'];
        $product->save(); // Laravel will automatically handle the timestamp

        // Redirect to the product list with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Delete a product
    public function destroy($id)
    {
        // Find the product by id or fail if it doesn't exist
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Redirect back to the product list with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
