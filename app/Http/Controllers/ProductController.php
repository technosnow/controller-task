<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'=>['required','string'],
            'price'=>['required','numeric'],
            'quantity'=>['required','integer'],
            'dexcription'=>['nullable','string','max : 5000', 'min : 10'],
        ]);
        Product::query()->create([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'description'=>$request->description,

        ]);
        return "stored";
    }
    public function index(){

        return Product::query()->get();
    }
    public function show($id){
        return Product::query()->where('id',$id)->first();
    }
    public function update($id,Request $request){
        $request->validate([
            'name'=>['nullable','string'],
            'price'=>['nullable','numeric'],
            'quantity'=>['nullable','integer'],
            'dexcription'=>['nullable','string','max : 5000', 'min : 10'],
        ]);

        Product::query()->where('id',$id)->update([

            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'description'=>$request->description,

        ]);
        return "updated";
    }
    public function destroy($id){
        Product::query()->where('id',$id)->delete();
        return 'deleted';
    }
}

