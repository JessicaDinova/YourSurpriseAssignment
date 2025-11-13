<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $products = Product::where('active', 1)
            ->paginate($perPage);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('categoryInfo')
            ->find($id);
        
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $apiUrl = "https://dummyjson.com/products/category/{$product->categoryInfo->slug}";

        try {
            $response = Http::get($apiUrl);
            
            if ($response->successful()) {
                $categoryData = $response->json();
                
                $externalProduct = collect($categoryData['products'])
                    ->firstWhere('id', $product->id);
                
                if ($externalProduct) {
                    $product->api_response = $externalProduct;
                } else {
                    $product->api_response = ['error' => 'Product not found in external API'];
                }
            } else {
                $product->api_response = ['error' => 'Failed to fetch from external API'];
            }
        } catch (\Exception $e) {
            $product->api_response = ['error' => 'API request failed: ' . $e->getMessage()];
        }

        return response()->json($product);
    }
}