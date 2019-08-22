<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'customer_name' => 'required|string|max:50',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string'
        ]);

        try {
            $customers = Customer::firstOrCreate(
                [
                    'name' => $request->customer_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address
                ]
            );

            return redirect()->route('customer.index')->with(['success' => 'Customer: ' . $customers->name . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $customers = Customer::findOrFail($id);
        $customers->delete();
        return redirect()->back()->with(['success' => 'Customer: ' . $customers->name . " telah dihapus!"]);
    }

    public function edit($id)
    {
        $customers = Customer::findOrFail($id);
        return view('customers.edit', compact('customers'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'customer_name' => 'required|string|max:50',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string'
        ]);

        try {
            //select data berdasarkan id
            $customers = Customer::findOrFail($id);
            //update data
            $customers->update([
                'name' => $request->customer_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address
            ]);

            //redirect ke route kategori.index
            return redirect(route('customer.index'))->with(['success' => 'Customer: ' . $customers->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
