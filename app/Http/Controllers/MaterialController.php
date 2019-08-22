<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::orderBy('created_at', 'DESC')->get();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'material_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $materials = Material::firstOrCreate([
                'name' => $request->material_name,
                'description' => $request->description
            ]);
            return redirect()->route('material.index')->with(['success' => 'Kategori: ' . $materials->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $materials = Material::findOrFail($id);
        $materials->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $materials->name . " telah dihapus!"]);
    }

    public function edit($id)
    {
        $materials = Material::findOrFail($id);
        return view('materials.edit', compact('materials'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'material_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            //select data berdasarkan id
            $materials = Material::findOrFail($id);
            //update data
            $materials->update([
                'name' => $request->material_name,
                'description' => $request->description
            ]);

            //redirect ke route kategori.index
            return redirect(route('material.index'))->with(['success' => 'Kategori: ' . $materials->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
