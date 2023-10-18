<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::GetAllProducts();
        var_dump($products);return;
        return view('products.index',compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('csv');

        $f_upload_path = 'public/uploads/csv';
        $f_name = time().'_'.$file->getClientOriginalName();
        
        $file->move($f_upload_path,$f_name);

        $csvFile = fopen(base_path($f_upload_path.'/'.$f_name), "r");
  
        $heading = true;
        while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
            if (!$heading) {
                $image_path = self::DownloadFile($data[4]);
                Product::create([
                    'prod_id'       =>  $data[0],
                    'name'          =>  $data[1],
                    'price'         =>  $data[2],
                    'description'   =>  $data[3],
                    'image'         =>  $image_path,
                ]);  
            }
            $heading = false;
        }
   
        fclose($csvFile);
        return redirect()->route('home')->with('success','Product Added successfully.');
    }

    public static function DownloadFile($url)
    {
        $savePath = 'public/uploads/images/';
        $imageContent = ($url) ? file_get_contents($url) : '';

        if ($imageContent !== false) {
            if (!file_exists($savePath)) {
                mkdir($savePath, 0777, true);
            }

            $fileName = time().'_'.basename($url);
            $filePath = $savePath . $fileName;

            $result = file_put_contents($filePath, $imageContent);

            if ($result !== false) {
                return $filePath;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
