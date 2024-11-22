<?php



// use App\Http\Controllers\ProductController;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display the main page
    public function index()
    {
        // Return the Blade template
        return view('products.index');
    }

    // Handle form submission and save product
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'quantityInStock' => 'required|integer',
            'pricePeritem' => 'required|numeric',
        ]);

        // Create the product and save to database
        $product = Product::create($request->only(['name', 'quantityInstock', 'pricePeritem']));

        // Return the created product as a JSON response
        return response()->json($product);
    }

    // Fetch all products (for dynamic display)
    public function getData()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json($products);
    }

    // Edit an existing product
    public function update(Request $request, Product $product)
    {
        // Validate the updated data
        $request->validate([
            'name' => 'required|string',
            'quantityInstock' => 'required|integer',
            'pricePeritem' => 'required|numeric',
        ]);

        // Update the product in the database
        $product->update($request->only(['name', 'quantityInstock', 'pricePeritem']));

        // Return the updated product as a JSON response
        return response()->json($product);
    }
}

