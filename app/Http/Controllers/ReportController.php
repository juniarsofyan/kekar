<?php

namespace App\Http\Controllers;

use App\CardWork;
use App\CardWorkDetail;
use App\Category;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function byCategory(Request $request)
    {
        $category = isset($request->category) ? $request->category : false;
        $date_start = isset($request->date_start) ? $request->date_start : date('Y-m-01');
        $date_end = isset($request->date_end) ? $request->date_end : date('Y-m-d');

        $query = "SELECT
                    cwm.`date`,
                    ctg.name as category,
                    inv.name as inventory,
                    prj.code as project,
                    prc.name as process,
                    cst.name as customer,
                    count(prc.name) as frequency,
                    sum(cwd.total_hours) as total_hours
                FROM
                    card_work_details cwd
                INNER JOIN
                    card_works cwm
                    ON cwd.card_work_id = cwm.id
                INNER JOIN
                    categories ctg
                    ON cwm.category_id = ctg.id
                INNER JOIN
                    inventories inv
                    ON cwm.inventory_id = inv.id
                INNER JOIN
                    processes prc
                    ON cwm.process_id = prc.id
                INNER JOIN
                    projects prj
                    ON cwm.project_id = prj.id
                INNER JOIN
                    customers cst
                    ON cwm.customer_id = cst.id
                WHERE
                    date BETWEEN :date_start AND :date_end
                    GROUP BY cwm.date, ctg.name, prc.name, inv.name, cst.name, prj.code
                    ORDER BY inv.name, cst.name ASC";

        $results = DB::select(DB::raw($query), array(
            'date_start' => $date_start,
            'date_end' => $date_end
        ));

        $categories = Category::pluck('name', 'id');

        $filters = array(
            "category" => $category,
            "date_start" => $date_start,
            "date_end" => $date_end
        );

        return view('reports.by_category', compact('categories', 'results', 'filters'));
    }
}
