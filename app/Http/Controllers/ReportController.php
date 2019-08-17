<?php

namespace App\Http\Controllers;

use App\CardWork;
use App\CardWorkDetail;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function perProcess(Request $request)
    {
        $date_start = $request->date_start;
        $date_end = $request->date_end;

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
                    date BETWEEN '2019-01-01' AND '2019-08-31'
                    GROUP BY cwm.date, ctg.name, prc.name, inv.name, cst.name, prj.code
                    ORDER BY inv.name, cst.name ASC";

        $results = DB::select(DB::raw($query), array(
            'date_start' => $date_start,
            'date_end' => $date_end
        ));

        return view('reports.per_process', compact('results'));
    }
}
