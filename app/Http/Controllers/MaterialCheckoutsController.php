<?php

namespace App\Http\Controllers;

use App\Models\material_checkouts;

use App\Models\material_stock;
use Illuminate\Http\Request;

class MaterialCheckoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcheckouts = material_checkouts::paginate(50);
        return view('mcheckouts', compact('mcheckouts'));
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
        foreach($request->mid as $key => $material_id){

            material_checkouts::updateOrCreate(['id'=>$request->id],[
                'material_id' => $material_id,
                'checkout_by' => $request->checkout_by,
                'quantity' => $request->qty[$key],
                'approved_by' => $request->approved_by,
                'production_batch' => $request->production_batch,
                'dated' => $request->dated,
                'details' => $request->details,
                'setting_id'=>$request->setting_id

            ]);


        // Update Stock
        material_stock::updateOrCreate(['material_id'=>$material_id],[
            'material_id'=>$material_id,
        ])->decrement('quantity',$request->qty[$key]);

        }
        $mcheckouts = material_checkouts::paginate(50);

        return view('mcheckouts', compact('mcheckouts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\material_checkouts  $material_checkouts
     * @return \Illuminate\Http\Response
     */
    public function show(material_checkouts $material_checkouts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\material_checkouts  $material_checkouts
     * @return \Illuminate\Http\Response
     */
    public function edit(material_checkouts $material_checkouts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\material_checkouts  $material_checkouts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, material_checkouts $material_checkouts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\material_checkouts  $material_checkouts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$mid,$qty)
    {
        material_stock::where('material_id',$mid)->increment('quantity',$qty);

        material_checkouts::findOrFail($id)->delete();

        $message = 'The material checkout record has been deleted!';
        return redirect()->route('mcheckouts')->with(['message'=>$message]);
    }

}
