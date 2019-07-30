<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Component;

class ComponentController extends Controller
{
    public function index()
    {
        $components = Component::orderBy('created_at', 'DESC')->paginate(10);
        return view('komponents.index', compact('components'));
    }

    public function create()
    {
        return view('komponents.create');
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'component_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $components = Component::firstOrCreate([
                'name' => $request->component_name
            ], [
                'description' => $request->description
            ]);
            return redirect()->route('component.index')->with(['success' => 'Kategori: ' . $components->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $components = Component::findOrFail($id);
        $components->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $components->name . " telah dihapus!"]);
    }

    public function edit($id)
    {
        $components = Component::findOrFail($id);
        return view('komponents.edit', compact('components'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'component_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            //select data berdasarkan id
            $components = Component::findOrFail($id);
            //update data
            $components->update([
                'name' => $request->component_name,
                'description' => $request->description
            ]);

            //redirect ke route kategori.index
            return redirect(route('component.index'))->with(['success' => 'Kategori: ' . $components->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
