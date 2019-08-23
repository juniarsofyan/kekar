<?php

namespace App\Http\Controllers;

use App\CardWork;
use App\Component;
use App\Category;
use App\Project;
use App\Inventory;
use App\Process;
use App\Customer;
use App\Officer;
use Illuminate\Http\Request;
use DB;

class CardWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = isset($request->category) ? $request->category : false;
        $customer = isset($request->customer) ? $request->customer : false;
        $date_start = isset($request->date_start) ? $request->date_start : date('Y-m-01');
        $date_end = isset($request->date_end) ? $request->date_end : date('Y-m-d');
        $category_where_clause = "";
        $customer_where_clause = "";

        // PREPARE PARAMETER BINDINGS
        $parameter_bindings = array(
            'date_start' => $date_start,
            'date_end' => $date_end
        );

        $cardworks = DB::table('card_works')
            ->join('categories', 'card_works.category_id', '=', 'categories.id')
            ->join('inventories', 'card_works.inventory_id', '=', 'inventories.id')
            ->join('processes', 'card_works.process_id', '=', 'processes.id')
            ->join('customers', 'card_works.customer_id', '=', 'customers.id')
            ->join('projects', 'card_works.project_id', '=', 'projects.id')
            ->join('officers', 'card_works.officer_id', '=', 'officers.id')
            ->join('card_work_details', 'card_works.id', '=', 'card_work_details.card_work_id')
            ->join('components', 'card_work_details.component_id', '=', 'components.id')
            ->select('card_works.id', 'card_works.date', 'card_works.po_number', 'categories.name AS category', 'inventories.name AS inventory', 'processes.name AS proccess', 'customers.name AS customer', 'projects.code AS project', 'officers.name AS officer', 'components.name AS component', 'card_work_details.problem', 'card_work_details.solution', 'card_work_details.total_hours', 'card_work_details.qty')
            ->whereBetween('date', [$date_start, $date_end]);

        // IF CATEGORY SELECTION IS NOT EMPTY
        // ADD CATEGORY WHERE CLAUSE AND ITS PARAMETER BINDING
        if (!empty($category)) {
            $cardworks->where('card_works.category_id', $category);
        }

        // IF CUSTOMER SELECTION IS NOT EMPTY
        // ADD CUSTOMER WHERE CLAUSE AND ITS PARAMETER BINDING
        if (!empty($customer)) {
            $cardworks->where('card_works.customer_id', $customer);
        }

        $cardworks->orderBy('card_works.date', 'desc');
        $cardworks = $cardworks->get();

        $categories = Category::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');

        $filters = array(
            "category" => $category,
            "customer" => $customer,
            "date_start" => $date_start,
            "date_end" => $date_end
        );

        return view('cardworks.index', compact('cardworks', 'categories', 'customers', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $inventories = Inventory::orderBy('name', 'asc')->pluck('name', 'id');
        $processes = Process::orderBy('name', 'asc')->pluck('name', 'id');
        $customers = Customer::orderBy('name', 'asc')->pluck('name', 'id');
        $projects = Project::orderBy('code', 'asc')->pluck('code', 'id');
        $officers = Officer::orderBy('name', 'asc')->pluck('name', 'id');
        $components = Component::orderBy('name', 'asc')->pluck('name', 'id');

        return view('cardworks.create', compact('categories', 'inventories', 'processes', 'customers', 'projects', 'officers', 'components'));
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
            'po_number' => 'nullable|string',
            'inventory' => 'required|string',
            'process' => 'required|string',
            'customer' => 'required|string',
            'project' => 'required|string',
            'officer' => 'required|string',
            'component' => 'required|integer',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'total_hours' => 'required|integer',
            'qty' => 'required|integer',
        ]);

        try {
            // ubah format tanggal
            $request->date = str_replace('/', '-', $request->date);
            $request->date = date('Y-m-d', strtotime($request->date));

            $cardwork = CardWork::firstOrCreate([
                'date' => $request->date,
                'category_id' => $request->category,
                'po_number' => $request->po_number,
                'inventory_id' => $request->inventory,
                'process_id' => $request->process,
                'customer_id' => $request->customer,
                'project_id' => $request->project,
                'officer_id' => $request->officer,
                'user_id' => \Auth::user()->id
            ]);

            $cardwork->cardWorkDetails()->create([
                'component_id' => $request->component,
                'problem' => $request->problem,
                'solution' => $request->solution,
                'total_hours' => $request->total_hours,
                'qty' => $request->qty
            ]);

            return redirect()->route('cardwork.index')->with(['success' => 'Kartu Kerja Ditambahkan']);
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

        $cardworks = DB::table('card_works')
            ->join('card_work_details', 'card_works.id', '=', 'card_work_details.card_work_id')
            ->select('card_works.id', 'card_works.date', 'card_works.category_id', 'card_works.po_number', 'card_works.inventory_id', 'card_works.process_id', 'card_works.customer_id', 'card_works.project_id', 'card_works.officer_id', 'card_work_details.component_id', 'card_work_details.problem', 'card_work_details.solution', 'card_work_details.total_hours', 'card_work_details.qty')
            ->where('card_works.id', $id)
            ->first();

        $cardworks->date = date('d/m/Y', strtotime($cardworks->date));
        $categories = Category::pluck('name', 'id');
        $inventories = Inventory::pluck('name', 'id');
        $processes = Process::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        $projects = Project::pluck('code', 'id');
        $officers = Officer::pluck('name', 'id');
        $components = Component::pluck('name', 'id');


        return view('cardworks.edit', compact('categories', 'inventories', 'processes', 'customers', 'projects', 'cardworks', 'officers', 'components'));
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
            'po_number' => 'nullable|string',
            'inventory' => 'required|string',
            'process' => 'required|string',
            'customer' => 'required|string',
            'project' => 'required|string',
            'officer' => 'required|string'
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
                'officer_id' => $request->officer,
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
        $cardwork = CardWork::findOrFail($id);
        $cardwork->cardWorkDetails()->delete();
        $cardwork->delete();

        return redirect()->back()->with(['success' => "Kartu Kerja telah dihapus!"]);
    }
}
