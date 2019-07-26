<?php

namespace App\Resto;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tbl_menu';
    public $timestamps = true;
    protected $fillable = [
        'nama_menu', 'harga'
    ];

    public function getAll(){
        $check = self::count();
        if ($check == 0) {
            return false;
        }
        return self::all();
    }

    public function getPrice($catch){
        $check = self::find($catch['menu_id']);
        if($check != NULL){
            return $check->harga;
        }
        return 0;
    }
}
