<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Illuminate\Support\Carbon;
use Image;

class CustomerController extends Controller
{
    public function CustomerAll()
    {
        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all',compact('customers'));
    }

    public function CustomerAdd()
    {
        return view('backend.customer.customer_add');
    }

    public function CustomerStore(Request $request)
    {
        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);

        $save_url = 'upload/customer/'.$name_gen;

        Customer::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'customer_image' => $save_url,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now() 
        ]);

        $notification = array(
            'message' => 'Customer inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
    }

    public function CustomerEdit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit',compact('customer'));
    }

    public function CustomerUpdate(Request $request)
    {
        $customer_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('customer_image')) {
            $image = $request->file('customer_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
            $save_url = 'upload/customer/'.$name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'customer_image' => $save_url,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now() 
            ]);

            $notification = array(
                'message' => 'Customer updated with image successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);

        } else {

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now() 
            ]);

            $notification = array(
                'message' => 'Customer updated without image successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);
        }
    }

    public function CustomerDelete($id)
    {
        $customer = Customer::findOrFail($id);
        $image = $customer->customer_image;
        unlink($image);

        $customer->delete();

        $notification = array(
            'message' => 'Customer deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}