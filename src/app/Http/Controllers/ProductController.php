<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function phones(){
        $url = config('app.urls.phones');
        $response = Http::get($url);
        if(!$response->ok()){
            abort($response->status(),$response->reason());
        }

        $json = $response->json();
        $products = $json['products'];

        $products = array_filter($products, function($item){
            return preg_match('/iPhone.*/',$item['title']);
        });

        foreach ($products as $product){
            $model = new Product();
            $model->id = $product['id'];
            $model->title = $product['title'];
            $model->price = $product['price'];
            $model->description = $product['description'];
            $model->save();
        }

        return response('iPhones added to database!',200);
    }
}
