<?php

namespace App\Http\Controllers;

use App\Models\production_jobs;
use Illuminate\Http\Request;

class ProductionJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productionjobs = production_jobs::paginate(50);
        return view('production_jobs', compact('productionjobs'));
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
        $pjobs = production_jobs::updateOrCreate(['id'=>$request->id],[
            'product_id' => $request->product_id,
            'staff_incharge' => $request->staff_incharge,
            'target_quantity' => $request->target_quantity,
            'dated_started' => $request->dated_started,
            'dated_ended' => $request->dated_ended,
            'status'=>$request->status,
            'batchno'=>$request->batchno,
            'estimated_cost_of_production'=>$request->estimated_cost_of_production,
            'setting_id'=>$request->setting_id

        ])->id;

        $productionjobs = production_jobs::paginate(50);
        return view('production_jobs', compact('productionjobs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\production_jobs  $production_jobs
     * @return \Illuminate\Http\Response
     */
    public function show(production_jobs $production_jobs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\production_jobs  $production_jobs
     * @return \Illuminate\Http\Response
     */
    public function edit(production_jobs $production_jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\production_jobs  $production_jobs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, production_jobs $production_jobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\production_jobs  $production_jobs
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        production_jobs::findOrFail($id)->delete();
        $message = 'The Production record has been deleted!';
        return redirect()->route('productionjobs')->with(['message'=>$message]);
    }
}
