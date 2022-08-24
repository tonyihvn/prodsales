<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\product_stocks;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::paginate(50);
        return view('products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'picture'=>'image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        if(!empty($request->file('picture'))){
            // $picture = $request->file('picture')->getClientOriginalName();
            $picture = time().'.'.$request->picture->extension();
            // $path = $request->file('picture')->store('public/images');
            $request->picture->move(\public_path('images\products'),$picture);
        }else{
            if($request->oldpicture==""){
                $picture = "";
            }else{
                $picture = $request->oldpicture;
            }
        }


        $product_id = products::updateOrCreate(['id'=>$request->id],[
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'measurement_unit' => $request->measurement_unit,
            'size' => $request->size,
            'price'=>$request->price,
            'picture'=>$picture,
            'setting_id'=>$request->setting_id

        ])->id;

        product_stocks::updateOrCreate(['product_id'=>$product_id],[
            'product_id'=>$product_id,
            'quantity' => 0,
            'added_by' => Auth()->user()->id,
            'facility_location'=>$request->setting_id,
            'setting_id'=>$request->setting_id
        ]);

        $products = products::paginate(50);

        return view('products', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        products::findOrFail($id)->delete();
        $message = 'The product has been deleted!';
        return redirect()->route('products')->with(['message'=>$message]);
    }
}
