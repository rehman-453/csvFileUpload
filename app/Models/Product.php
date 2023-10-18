<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['prod_id','name','price','description','image'];

    public static function GetAllProducts()
    {
        $result = DB::table('products')->select('*')->orderby('created_at','desc')->get();

        return $result;
    }
}
