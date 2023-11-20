<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();
        // return response()->json($products);

        // return $this->sendRequest($products->toArray(),'products retrived');
        return $this->sendResponse(ProductResource::collection($products),'products retrived');
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                "name" => 'required',
                "description" => 'required',
            ]
        );
        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $product= Product::create($request->all());
        return $this->sendResponse(new ProductResource($product), 'product create successfull');
        
    }

    public function show($id){
        $product= Product::findOrFail($id);
        return $this->sendResponse(new ProductResource($product), 'product retrive');

        // if(is_null($product)){
        //     return $this->sendError('product not found');
        // }
        // return $this->sendResponse(new ProductResource($product), 'product retrive');
    }
    public function update(Request $request, Product $product){
        $validator = Validator::make(
            $request->all(),
            [
                "name" => 'required',
                "description" => 'required',
            ]
        );

        if($validator ->fails()){
         return $this->sendError('validatin error', $validator->errors());
        }
        $product->update($request->all());
        return $this->sendResponse(new ProductResource($product), 'product update');

    }

    public function destroy(Product $product){
        $product->delete();
        return $this->sendResponse(new ProductResource($product), 'product delete');

    }
}
