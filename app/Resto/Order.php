<?php

namespace App\Resto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Order extends Model
{
    protected $table = 'tbl_order';
    public $timestamps = true;
    protected $fillable = [
        'tgl_pesan', 'no_meja', 'menu_id', 'harga', 'qty', 'total'
    ];

    public function validateOrder($catch){
        $validator = Validator::make($catch, [
            'no_meja.*' => 'numeric|required',
            'menu_id.*' => 'numeric|required',
            'harga.*' => 'numeric|required',
            'harga-jual.*' => 'numeric|required',
            'qty.*' => 'numeric|required|min:1',
        ]);
        if ($validator->fails()) {
            return true;
        }
        return false;
    }
}
