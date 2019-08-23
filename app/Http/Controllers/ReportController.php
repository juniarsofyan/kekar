<?php

namespace App\Http\Controllers;

use App\CardWork;
use App\CardWorkDetail;
use App\Category;
use App\Customer;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function byCategory(Request $request)
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

        // IF CATEGORY SELECTION IS NOT EMPTY
        // ADD CATEGORY WHERE CLAUSE AND ITS PARAMETER BINDING
        if (!empty($category)) {
            $category_where_clause = "ctg.id = :category_id AND ";
            $parameter_bindings = array('category_id' => $category) + $parameter_bindings;
        }

        // IF CUSTOMER SELECTION IS NOT EMPTY
        // ADD CUSTOMER WHERE CLAUSE AND ITS PARAMETER BINDING
        if (!empty($customer)) {
            $customer_where_clause = "cst.id = :customer_id AND ";
            $parameter_bindings = array('customer_id' => $customer) + $parameter_bindings;
        }

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
                    {$category_where_clause}
                    {$customer_where_clause}
                    date BETWEEN :date_start AND :date_end
                    GROUP BY cwm.date, ctg.name, prc.name, inv.name, cst.name, prj.code
                    ORDER BY inv.name, cst.name ASC";

        $results = DB::select(DB::raw($query), $parameter_bindings);

        $categories = Category::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');

        $total_hours = array_sum(array_map(function ($item) {
            return $item->total_hours;
        }, $results));

        $total_frequencies = array_sum(array_map(function ($item) {
            return $item->frequency;
        }, $results));

        $total_processes = count($results);

        $filters = array(
            "category" => $category,
            "customer" => $customer,
            "date_start" => $date_start,
            "date_end" => $date_end
        );

        return view('reports.by_category', compact('categories', 'customers', 'results', 'filters', 'total_hours', 'total_frequencies', 'total_processes'));
    }
}
