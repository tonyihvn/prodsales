<?php

namespace App\Http\Controllers;

use App\Models\product_sales;
use App\Models\products;
use App\Models\product_stocks;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PDF;

use App\Models\transactions;
use Illuminate\Http\Request;

class ProductSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = product_sales::paginate(50);
        return view('sales', compact('sales'));
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
        if($request->amount_paid==$request->total_due){
            $pay_status = "Paid";
        }elseif($request->amount_paid>$request->total_due){
            $pay_status = "Overpaid";
        }elseif($request->amount_paid<$request->total_due){
            $pay_status = "Half Payment";
        }else{
            $pay_status = "Not Paid";
        }

        if (User::where('id', '=', $request->buyer)->exists()) {
            $buyer = $request->buyer;
         }else{
            $password = Hash::make("prayer22");

            $buyer = User::create([
                'name' => $request->customer,
                'email' => 'guest@prodsales.com',
                'dob' => $request->dated_sold,
                'password' => $password,
                'about' => $request->details,
                'role'=>"Customer",
                'category'=>"Customer",
                'status'=>"InActive",
                'setting_id' => Auth()->user()->setting_id
            ])->id;
         }

         if($request->group_id==""){
            $group_id =  substr(md5(uniqid(mt_rand(), true).microtime(true)),0, 7);

         }else{
            $group_id = $request->group_id;
         }

        foreach($request->product_id as $key => $product_id){

            product_sales::create([
                'product_id' => $product_id,
                'quantity' => $request->qty[$key],
                'sales_person' => Auth()->user()->id,
                'confirmed_by' => Auth()->user()->id,
                'buyer' => $buyer,
                'price' => $request->unit[$key],
                'amount_paid' => $request->amount[$key],
                'pay_status' => $pay_status,
                'dated_sold' => $request->dated_sold,
                'group_id' => $group_id,
                'details' => $request->details,
                'setting_id'=>Auth()->user()->setting_id

            ]);


            // Update Product Stock
            product_stocks::updateOrCreate(['product_id'=>$product_id],[
                'product_id'=>$product_id,
            ])->decrement('quantity',$request->qty[$key]);

        }

        // RECORD TRANSACTION
        transactions::create([
            'title'=>"Item Sales - Invoice No: ".$group_id,
            'amount'=>$request->total_due,
            'account_head' => 1,
            'dated' => $request->dated_sold,
            'reference_no' => $group_id,
            'detail' => $request->details,
            'from' => $buyer,
            'to' => Auth()->user()->id,
            'approved_by' => Auth()->user()->id,
            'recorded_by' => Auth()->user()->id,
            'payment_status' => $pay_status,
            'transaction_id' => $group_id,
            'balance' => $request->total_due-$request->amount_paid,
            'beneficiary' => Auth()->user()->setting_id,
            'setting_id' => Auth()->user()->setting_id
        ]);

        $sales = product_sales::paginate(50);

        $message = "Items sold";
        return view('sales', compact('sales'))->with(['message'=>$message]);

    }


    public function sale()
    {
        $products = products::select('id','name','price','picture','measurement_unit')->get();
        return view('newsales', compact('products'));
    }

    public function invoice($category,$tid)
    {
        $sale = transactions::where('id',$tid)->first();

        $products = product_sales::where('group_id',$sale->reference_no)->get();

        $customer = User::where('id',$sale->from)->first();


        $pdf_doc = PDF::loadView('invoice', compact('sale','products','customer','category'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf_doc->stream('invoice'.$tid.'.pdf');


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product_sales  $product_sales
     * @return \Illuminate\Http\Response
     */
    public function show(product_sales $product_sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_sales  $product_sales
     * @return \Illuminate\Http\Response
     */
    public function edit(product_sales $product_sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product_sales  $product_sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product_sales $product_sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product_sales  $product_sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(product_sales $product_sales)
    {
        //
    }
}
