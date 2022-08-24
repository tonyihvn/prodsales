<?php

namespace App\Http\Controllers;

use App\Models\materials;
use App\Models\material_stock;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = materials::paginate(50);
        return view('materials', compact('materials'));
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
            $request->picture->move(\public_path('images\materials'),$picture);
        }else{
            if($request->oldpicture==""){
                $picture = "";
            }else{
                $picture = $request->oldpicture;
            }
        }


        $material_id = materials::updateOrCreate(['id'=>$request->id],[
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'measurement_unit' => $request->measurement_unit,
            'size' => $request->size,
            'cost_per'=>$request->cost_per,
            'picture'=>$picture,
            'setting_id'=>$request->setting_id

        ])->id;

        material_stock::updateOrCreate(['material_id'=>$material_id],[
            'material_id'=>$material_id,
            'quantity' => 0,
            'added_by' => Auth()->user()->id,
            'facility_location'=>$request->setting_id,
            'setting_id'=>$request->setting_id

        ]);

        $materials = materials::paginate(50);

        return view('materials', compact('materials'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function show(materials $materials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function edit(materials $materials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materials $materials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materials  $materials
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        materials::findOrFail($id)->delete();
        $message = 'The material has been deleted!';
        return redirect()->route('materials')->with(['message'=>$message]);
    }
}
