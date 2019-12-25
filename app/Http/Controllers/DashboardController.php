<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $trx = "SELECT MONTHNAME(trx_date) as month, count(*) as total FROM transactions GROUP BY MONTHNAME(trx_date) ORDER BY MONTH(trx_date)";

        $transactions = DB::select($trx);

        $months = [];
        $totals = [];

        foreach($transactions as $transaction){
            $months[] = $transaction->month;
            $totals[] = $transaction->total;
        }

        $data['chart'] = [
            'months' => $months,
            'totals' => $totals
        ];

        // Latest Transaction
        $data['lt'] = Transaction::orderBy('created_at', 'desc')->limit(5)->get();
        // dd($data['lt']);
        return view('dashboard', $data);
    }
}
