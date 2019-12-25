<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// From Maatwebsite
use Maatwebsite\Excel\Concerns\ToModel;

class Transaction extends Model
{
    protected $table = "transactions";
    protected $primaryKey = "trx_id";

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
