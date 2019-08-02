<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Process;

class ProcessController extends Controller
{
    public function index()
    {
        $processes = Process::orderBy('created_at', 'DESC')->paginate(10);
        return view('processes.index', compact('processes'));
    }

    public function create()
    {
        return view('processes.create');
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'process_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $processes = Process::firstOrCreate(
                [
                    'name' => $request->process_name,
                    'description' => $request->description
                ]
            );

            return redirect()->route('process.index')->with(['success' => 'Process: ' . $processes->name . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $processes = Process::findOrFail($id);
        $processes->delete();
        return redirect()->back()->with(['success' => 'Process: ' . $processes->name . " telah dihapus!"]);
    }

    public function edit($id)
    {
        $processes = Process::findOrFail($id);
        return view('processes.edit', compact('processes'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'process_name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            //select data berdasarkan id
            $processes = Process::findOrFail($id);
            //update data
            $processes->update([
                'name' => $request->process_name,
                'description' => $request->description
            ]);

            //redirect ke route kategori.index
            return redirect(route('process.index'))->with(['success' => 'Process: ' . $processes->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
