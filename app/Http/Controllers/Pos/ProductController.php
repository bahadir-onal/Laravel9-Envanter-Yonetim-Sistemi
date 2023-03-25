<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function ProductAll()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all',compact('products'));
    }

    public function ProductAdd()
    {
        $category = Category::all();
        $supplier = Supplier::all();
        $unit = Unit::all();

        return view('backend.product.product_add',compact('category','supplier','unit'));
    }

    public function ProductStore(Request $request)
    {
        Product::insert([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'quantity' => '0',
            'created_by' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }

    public function ProductEdit($id)
    {
        $category = Category::all();
        $supplier = Supplier::all();
        $unit = Unit::all();
        $product = Product::findOrFail($id);

        return view('backend.product.product_edit',compact('category','supplier','unit','product'));
    }

    public function ProductUpdate(Request $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }

    public function ProductDelete($id)
    {
        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }
}
