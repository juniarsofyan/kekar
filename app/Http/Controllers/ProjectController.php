<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Project Create|Project View|Project Update|Project Delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Project Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Project Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Project Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $projects = Project::orderBy('created_at', 'DESC')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'code' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $projects = Project::firstOrCreate([
                'code' => $request->code,
                'description' => $request->description
            ]);

            return redirect()->route('project.index')->with(['success' => 'Project: ' . $projects->code . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();
        return redirect()->back()->with(['success' => 'Project: ' . $projects->code . " telah dihapus!"]);
    }

    public function edit($id)
    {
        $projects = Project::findOrFail($id);
        return view('projects.edit', compact('projects'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'code' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            //select data berdasarkan id
            $projects = Project::findOrFail($id);
            //update data
            $projects->update([
                'code' => $request->code,
                'description' => $request->description
            ]);

            return redirect(route('project.index'))->with(['success' => 'Project: ' . $projects->code . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
