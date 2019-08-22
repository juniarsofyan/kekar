<?php

namespace App\Http\Controllers;

use App\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officers = Officer::orderBy('created_at', 'DESC')->get();
        return view('officers.index', compact('officers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('officers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'nullable|string'
        ]);

        try {
            $officers = Officer::firstOrCreate([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address
            ]);

            return redirect()->route('officer.index')->with(['success' => 'Kategori: ' . $officers->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Officer  $officer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $officers = Officer::findOrFail($id);
        return view('officers.edit', compact('officers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Officer  $officer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'nullable|string'
        ]);

        try {
            //select data berdasarkan id
            $officers = Officer::findOrFail($id);
            //update data
            $officers->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address
            ]);

            //redirect ke route kategori.index
            return redirect(route('officer.index'))->with(['success' => 'Kategori: ' . $officers->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Officer  $officer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $officers = Officer::findOrFail($id);
        $officers->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $officers->name . " telah dihapus!"]);
    }
}
