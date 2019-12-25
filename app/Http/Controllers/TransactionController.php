<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Transaction;
use Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 10;
        $data['products'] = Product::pluck('product_name', 'product_id');
        $data['transactions'] = Transaction::with(['product'])->paginate($paginate);
        return view('transaction.index', $data)->with('i', ($request->input('page', 1) - 1) * $paginate); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::where('product_status', 'Active')->pluck('product_name', 'product_id');
        return view('transaction.create', $data);
    }

    public function import()
    {
        return view('transaction.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $messages = [
            'product_id.required' => 'Produk wajib diisi',
            'trx_date.required' => 'Tanggal wajib diisi'
        ];
        $request->validate([
            'product_id' => 'required',
            'trx_date' => 'required'
        ], $messages);

        // Ambil data harga dari table product berdasarkan inputan product_id
        $data_product = Product::find($request->product_id);
        $harga_product = $data_product->product_price;
        
        // Simpan ke database
        $trx = new Transaction;
        $trx->product_id = $request->product_id;
        $trx->trx_date = $request->trx_date;
        $trx->trx_price = $harga_product;
        
        $simpan = $trx->save();

        if($simpan){
            return redirect()->route('transaction.index')->with('success', 'Transaction created successfully.');
        }
    }
    public function store_import(Request $request)
    {
        $messages = [
            'file_trx.required' => 'File wajib diisi',
            'file_trx.mimes' => 'File hanya boleh berformat .xls atau .xlsx'
        ];
        $request->validate([
            'file_trx' => 'required|mimes:xls,xlsx'
        ], $messages);

        $path = $request->file('file_trx')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                    'product_id' => $value->product_id, 
                    'trx_date' => $value->trx_date, 
                    'trx_price' => $value->trx_price
                ];
            }

            if(!empty($arr)){
                Transaction::insert($arr);
            }
        }

        return redirect()->route('transaction.index')->with('success', 'Transaction imported successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $messages = [
            'product_id.required' => 'Produk wajib diisi',
            'trx_date.required' => 'Tanggal wajib diisi'
        ];
        $request->validate([
            'product_id' => 'required',
            'trx_date' => 'required'
        ], $messages);

        // Ambil data harga dari table product berdasarkan inputan product_id
        $data_product = Product::find($request->product_id);
        $harga_product = $data_product->product_price;
        
        // Simpan ke database
        $trx = Transaction::find($id);
        $trx->product_id = $request->product_id;
        $trx->trx_date = date('Y-m-d H:i:s', strtotime($request->trx_date));
        $trx->trx_price = $harga_product;
        
        $ubah = $trx->save();

        if($ubah){
            return redirect()->route('transaction.index')->with('info', 'Transaction updated successfully.');
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
        $trx = Transaction::find($id);
        $hapus = $trx->delete();

        if($hapus){
            return redirect()->route('transaction.index')->with('warning', 'Transaction deleted successfully');
        }
    }

    public function download()
    {
        $field = "transactions.trx_id as Id_Transaksi, products.product_name as Nama_Produk,  
        transactions.trx_date as Tanggal_Transaksi,
        transactions.trx_price as Total";

        $data = Transaction::selectRaw($field)
                ->join('products', 'transactions.product_id', '=', 'products.product_id')
                ->get()->toArray();

        // dd($data);

        return Excel::create('nama_file_trx', function($excel) use($data) {

            $excel->sheet('nama_sheet_trx', function($sheet) use($data){
                
                $sheet->fromArray($data);

            });

        })->download();
    }
}
