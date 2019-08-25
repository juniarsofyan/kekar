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
            ->select(DB::raw('count(card_works.id) as total_card_works'), DB::raw('YEAR(date) year, MONTH(date) month'))
            ->whereBetween('date', [$date_start, $date_end])
            ->groupby('year', 'month')
            ->get();

        return view('dashboards.index', compact('total_hours', 'total_card_works'));
    }
}
