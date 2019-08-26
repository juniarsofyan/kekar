<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $date_start = date('Y-m-01');
        $date_end = date('Y-m-d');

        $total_hours = DB::table('card_work_details')
            ->join('card_works', 'card_works.id', '=', 'card_work_details.card_work_id')
            ->join('categories', 'card_works.category_id', '=', 'categories.id')
            ->select('categories.name AS category', DB::raw('SUM(card_work_details.total_hours) As total_hours'))
            ->groupBy('categories.name')
            ->whereBetween('date', [$date_start, $date_end])
            ->orderBy('categories.name', 'asc')
            ->get();

        $total_card_works = DB::table('card_works')
            ->select(DB::raw('MONTH(date) month'), DB::raw('count(card_works.id) as total'))
            ->whereBetween('date', [$date_start, $date_end])
            ->groupby('month')
            ->get();

        foreach ($total_card_works as $key => $value) {
            $total_card_works{
                $key}->month = date('F', mktime(0, 0, 0, $value->month, 10));
        }


        return view('dashboards.index', compact('total_hours', 'total_card_works'));
    }
}
