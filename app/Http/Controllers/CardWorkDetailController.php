<?php

namespace App\Http\Controllers;

use App\CardWorkDetail;
use App\CardWork;
use App\Material;
use App\Component;
use DB;
use Illuminate\Http\Request;

class CardWorkDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cardwork_id)
    {
        $cardwork_details = DB::table('card_work_details')
            ->join('card_works', 'card_work_details.card_work_id', '=', 'card_works.id')
            ->join('components', 'card_work_details.component_id', '=', 'components.id')
            ->join('materials', 'card_work_details.material_id', '=', 'materials.id')
            ->select('card_work_details.id', 'card_work_details.card_work_id', 'components.name AS component', 'materials.name AS material', 'dimension', 'problem', 'solution', 'total_hours', 'qty', 'weight')
            ->where('card_work_id', $cardwork_id)
            ->get();

        $cardworks = array('id' => $cardwork_id);
        $components = Component::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');

        return view('cardworkdetails.index', compact('cardworks', 'cardwork_details', 'components', 'materials'));
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
            'component' => 'required|integer',
            'material' => 'required|integer',
            'dimension' => 'nullable|string',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'total_hours' => 'required|integer',
            'qty' => 'required|integer',
            'weight' => 'nullable'
        ]);

        try {
            $cardworks = CardWork::findOrFail($request->cardwork_id);

            $cardwork_details = $cardworks->cardWorkDetails()->create([
                'component_id' => $request->component,
                'material_id' => $request->material,
                'dimension' => $request->dimension,
                'problem' => $request->problem,
                'solution' => $request->solution,
                'total_hours' => $request->total_hours,
                'qty' => $request->qty,
                'weight' => $request->weight
            ]);

            return redirect()->route('cardworkdetail.index', $request->cardwork_id)->with(['success' => 'Detail Kartu Kerja ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cardwork_id, $id)
    {
        $cardwork_detail = DB::table('card_work_details')
            ->join('card_works', 'card_work_details.card_work_id', '=', 'card_works.id')
            ->join('components', 'card_work_details.component_id', '=', 'components.id')
            ->join('materials', 'card_work_details.material_id', '=', 'materials.id')
            ->select('card_work_details.id', 'card_work_details.card_work_id', 'card_work_details.component_id', 'card_work_details.material_id', 'dimension', 'problem', 'solution', 'total_hours', 'qty', 'weight')
            ->where('card_work_details.card_work_id', $cardwork_id)
            ->where('card_work_details.id', $id)
            ->first();

        $cardwork_details = DB::table('card_work_details')
            ->join('card_works', 'card_work_details.card_work_id', '=', 'card_works.id')
            ->join('components', 'card_work_details.component_id', '=', 'components.id')
            ->join('materials', 'card_work_details.material_id', '=', 'materials.id')
            ->select('card_work_details.id', 'card_work_details.card_work_id', 'components.name AS component', 'materials.name AS material', 'dimension', 'problem', 'solution', 'total_hours', 'qty', 'weight')
            ->where('card_work_id', $cardwork_id)
            ->get();

        $cardworks = array('id' => $cardwork_id);
        $components = Component::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');

        return view('cardworkdetails.index', compact('cardworks', 'cardwork_detail', 'cardwork_details', 'components', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'component' => 'required|integer',
            'material' => 'required|integer',
            'dimension' => 'nullable|string',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'total_hours' => 'required|integer',
            'qty' => 'required|integer',
            'weight' => 'nullable'
        ]);

        try {
            $cardworks = CardWork::findOrFail($request->cardwork_id);

            $cardwork_details = $cardworks->cardWorkDetails()->where('id', $id)->update([
                'component_id' => $request->component,
                'material_id' => $request->material,
                'dimension' => $request->dimension,
                'problem' => $request->problem,
                'solution' => $request->solution,
                'total_hours' => $request->total_hours,
                'qty' => $request->qty,
                'weight' => $request->weight
            ]);

            return redirect()->route('cardworkdetail.index', $request->cardwork_id)->with(['success' => 'Detail Kartu Kerja ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card_work_details = CardWorkDetail::findOrFail($id);
        $card_work_details->delete();
        return redirect()->back()->with(['success' => "Detail Kartu Kerja telah dihapus!"]);
    }
}
