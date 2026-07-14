<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
   $query = Product::where('shopkeeper_id', session('shop_id'));

if(request()->filled('search'))
{
    $search = request('search');

   $query->where(function($q) use ($search){

    $q->where('product_name','LIKE',"%{$search}%")
      ->orWhere('product_code','LIKE',"%{$search}%")
      ->orWhere('price','LIKE',"%{$search}%")
      ->orWhere('stock','LIKE',"%{$search}%");

});
}

$products = $query->paginate(10)->withQueryString();

    return view('shopkeeper.products.index', compact('products'));
}
 public function store(Request $request)
    {
        // Validation
        $request->validate([
            'product_name' => [
                'required',
                'max:100',
                Rule::unique('products', 'product_name')
                    ->where(function ($query) {
                        return $query->where('shopkeeper_id', session('shop_id'));
                    }),
            ],
            'price'  => 'required|numeric|min:0',
            'unit'   => 'required',
            'stock'  => 'required|integer|min:0',
            'status' => 'required',
        ], [
            'product_name.required' => 'Product name is required.',
            'product_name.unique'   => 'This product already exists.',
            'price.required'        => 'Price is required.',
            'price.numeric'         => 'Price must be a number.',
            'unit.required'         => 'Please select a unit.',
            'stock.required'        => 'Stock is required.',
            'stock.integer'         => 'Stock must be a whole number.',
            'status.required'       => 'Please select a status.',
        ]);

        // Generate Product Code
        $lastProduct = Product::latest()->first();

        if ($lastProduct) {
            $number = (int) substr($lastProduct->product_code, 3);
            $productCode = 'PRD' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $productCode = 'PRD001';
        }

        // Save Product
        Product::create([
            'shopkeeper_id' => session('shop_id'),
            'product_name'  => $request->product_name,
            'product_code'  => $productCode,
            'price'         => $request->price,
            'unit'          => $request->unit,
            'stock'         => $request->stock,
            'status'        => $request->status,
        ]);

        return redirect()->back()->with('success', 'Product Added Successfully.');
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)
                          ->where('shopkeeper_id', session('shop_id'))
                          ->firstOrFail();

        $request->validate([
            'product_name' => [
                'required',
                'max:100',
                Rule::unique('products', 'product_name')
                    ->where(function ($query) {
                        return $query->where('shopkeeper_id', session('shop_id'));
                    })
                    ->ignore($product->id),
            ],
            'price'  => 'required|numeric|min:0',
            'unit'   => 'required',
            'stock'  => 'required|integer|min:0',
            'status' => 'required',
        ], [
            'product_name.required' => 'Product name is required.',
            'product_name.unique'   => 'This product already exists.',
            'price.required'        => 'Price is required.',
            'price.numeric'         => 'Price must be a number.',
            'unit.required'         => 'Please select a unit.',
            'stock.required'        => 'Stock is required.',
            'stock.integer'         => 'Stock must be a whole number.',
            'status.required'       => 'Please select a status.',
        ]);

        $product->update([
            'product_name' => $request->product_name,
            'price'        => $request->price,
            'unit'         => $request->unit,
            'stock'        => $request->stock,
            'status'       => $request->status,
        ]);

        return redirect()->back()->with('success', 'Product Updated Successfully.');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)
                          ->where('shopkeeper_id', session('shop_id'))
                          ->firstOrFail();

        $product->delete();

        return redirect()->back()->with('success', 'Product Deleted Successfully.');
    }
}