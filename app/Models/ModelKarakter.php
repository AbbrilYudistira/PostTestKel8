<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKarakter extends Model 
{
    protected $table = "karakter";
    protected $primaryKey = "ID";
    protected $allowedFields = ['Nama', 'Email', 'Bidang', 'Alamat'];

    function cari($katakunci)
    {
        $builder = $this->table("Karakter");
        $arr_katakunci = explode(" ", $katakunci);
        for($x=0; $x<count($arr_katakunci); $x++){
            $builder->orLike('Nama', $arr_katakunci[$x]);
            $builder->orLike('Email', $arr_katakunci[$x]);
            $builder->orLike('Alamat', $arr_katakunci[$x]);
        }
        return $builder;
    }
}