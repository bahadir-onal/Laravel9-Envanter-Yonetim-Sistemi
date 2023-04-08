<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    public function PurchaseAll()
    {
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.purchase.purchase_all',compact('allData'));
    }

    public function PurchaseAdd()
    {
        $category = Category::all();
        $supplier = Supplier::all();
        $unit = Unit::all();

        return view('backend.purchase.purchase_add',compact('category','supplier','unit'));
    }

    public function PurchaseStore(Request $request)
    {
        if ($request->category_id == null) {

            $notification = array(
                'message' => 'Sorry you do not select any item',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);

        } else {
            $count_category = count($request->category_id);

            for ($i=0; $i < $count_category; $i++) { 

                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
    
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->created_by = Auth::id();
                $purchase->status = '0';
                $purchase->save();
            }
        }

        $notification = array(
            'message' => 'Data save successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.all')->with($notification);
    }

    public function PurchaseDelete($id)
    {
        Purchase::findorFail($id)->delete();

        $notification = array(
            'message' => 'Data deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PurchasePending()
    {
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status', '0')->get();
        return view('backend.purchase.puchase_pending',compact('allData'));
    }

    public function PurchaseApprove($id)
    {

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);

             $notification = array(
                'message' => 'Status Approved Successfully', 
                'alert-type' => 'success'
                );
            return redirect()->route('purchase.all')->with($notification); 
        }

    }

    public function DailyPurchaseReport()
    {
        return view('backend.purchase.daily_purchase_report');
    }

    public function DailyPurchasePdf(Request $request)
    {
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d',strtotime($request->end_date));

        $allData = Purchase::whereBetween('date',[$startDate,$endDate])->where('status','1')->get();

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        return view('backend.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));
    }
}
