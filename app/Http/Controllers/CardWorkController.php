<?php

namespace App\Http\Controllers;

use App\CardWork;
use App\Category;
use App\Project;
use App\Inventory;
use App\Process;
use App\Customer;
use Illuminate\Http\Request;
use DB;

class CardWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardworks = DB::table('card_works')
            ->join('categories', 'card_works.category_id', '=', 'categories.id')
            ->join('inventories', 'card_works.inventory_id', '=', 'inventories.id')
            ->join('processes', 'card_works.process_id', '=', 'processes.id')
            ->join('customers', 'card_works.customer_id', '=', 'customers.id')
            ->join('projects', 'card_works.project_id', '=', 'projects.id')
            ->select('card_works.id', 'card_works.po_number', 'categories.name AS category', 'inventories.name AS inventory', 'processes.name AS proccess', 'customers.name AS customer', 'projects.code AS project')
            ->get();

        return view('cardworks.index', compact('cardworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $inventories = Inventory::pluck('name', 'id');
        $processes = Process::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $projects = Project::pluck('code', 'id');

        return view('cardworks.create', compact('categories', 'inventories', 'processes', 'customers', 'projects'));
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
            'date' => 'required|date_format:d/m/Y',
            'category' => 'required|string',
            'po_number' => 'required|string',
            'inventory' => 'required|string',
            'process' => 'required|string',
            'customer' => 'required|string',
            'project' => 'required|string'
        ]);

        try {
            // ubah format tanggal
            $request->date = str_replace('/', '-', $request->date);
            $request->date = date('Y-m-d', strtotime($request->date));

            $cardworks = CardWork::firstOrCreate([
                'date' => $request->date,
                'category_id' => $request->category,
                'po_number' => $request->po_number,
                'inventory_id' => $request->inventory,
                'process_id' => $request->process,
                'customer_id' => $request->customer,
                'project_id' => $request->project,
                'user_id' => \Auth::user()->id
            ]);

            return redirect()->route('cardwork.index')->with(['success' => 'Kartu Kerja: ' . $cardworks->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function show(CardWork $cardWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name', 'id');
        $inventories = Inventory::pluck('name', 'id');
        $processes = Process::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $projects = Project::pluck('code', 'id');
        $cardworks = CardWork::findOrFail($id);

        $cardworks->date = date('d/m/Y', strtotime($cardworks->date));

        return view('cardworks.edit', compact('categories', 'inventories', 'processes', 'customers', 'projects', 'cardworks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'date' => 'required|date_format:d/m/Y',
            'category' => 'required|string',
            'po_number' => 'required|string',
            'inventory' => 'required|string',
            'process' => 'required|string',
            'customer' => 'required|string',
            'project' => 'required|string'
        ]);

        try {
            //select data berdasarkan id
            $cardworks = Cardwork::findOrFail($id);

            // ubah format tanggal
            $request->date = str_replace('/', '-', $request->date);
            $request->date = date('Y-m-d', strtotime($request->date));

            //update data
            $cardworks->update([
                'date' => $request->date,
                'category_id' => $request->category,
                'po_number' => $request->po_number,
                'inventory_id' => $request->inventory,
                'process_id' => $request->process,
                'customer_id' => $request->customer,
                'project_id' => $request->project,
                'user_id' => \Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('cardwork.index'))->with(['success' => 'Kartu Kerja diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardWork  $cardWork
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cardworks = CardWork::findOrFail($id);
        $cardworks->delete();
        return redirect()->back()->with(['success' => "Kartu Kerja telah dihapus!"]);
    }
}
