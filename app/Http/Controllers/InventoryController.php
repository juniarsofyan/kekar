<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::orderBy('created_at', 'DESC')->get();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'inventory_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $inventories = Inventory::firstOrCreate(
                [
                    'name' => $request->inventory_name,
                    'description' => $request->description
                ]
            );

            return redirect()->route('inventory.index')->with(['success' => 'Inventory: ' . $inventories->name . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $inventories = Inventory::findOrFail($id);
        $inventories->delete();
        return redirect()->back()->with(['success' => 'Inventory: ' . $inventories->name . " telah dihapus!"]);
    }

    public function edit($id)
    {
        $inventories = Inventory::findOrFail($id);
        return view('inventories.edit', compact('inventories'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'inventory_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            //select data berdasarkan id
            $inventories = Inventory::findOrFail($id);
            //update data
            $inventories->update([
                'name' => $request->inventory_name,
                'description' => $request->description
            ]);

            //redirect ke route kategori.index
            return redirect(route('inventory.index'))->with(['success' => 'Inventory: ' . $inventories->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
