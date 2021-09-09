<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = attendance::paginate(50);

        return view('attendance', compact('attendance'));
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        attendance::updateOrCreate(['id'=>$request->id],[
            'date' => $request->date,
            'activity' => $request->activity,
            'women' => $request->women,
            'men'=>$request->men,     
            'children' => $request->children,
            'total'=>$request->women+$request->men+$request->children,
            'remarks'=>$request->remarks."(".$request->stayedback." Workers)",                    
        ]);
        $attendance = attendance::paginate(50);

        return view('attendance', compact('attendance'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        attendance::findOrFail($id)->delete();      
        $message = 'The Attendance Record has been deleted!';      
        return redirect()->route('attendance')->with(['message'=>$message]);

    }
}
