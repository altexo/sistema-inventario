<?php

namespace App\Http\Controllers;

use App\TemporarySale;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class TemporarySaleController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        $tempSales = TemporarySale::with('product')->get();
        foreach($tempSales as $ts){
            $total = $total+($ts->sale_price * $ts->quantity);
        }
        return response()->json(['in_sale'=>  $tempSales, 'total'=> $total]);
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
        //Faltan validaciones 
        try {
            $temporarySale = new TemporarySale;
            $temporarySale->product_id = $request->item['details']['id'];
            $temporarySale->sale_price = $request->item['toAdd']['price'];
            $temporarySale->quantity = $request->item['toAdd']['quantity'];
            $temporarySale->save();
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'data'=>$e->getMessage()]);
        }
        //Hay que validar respuesta en front end
        return response()->json(['error' => false, 'data'=> $temporarySale]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TemporarySale  $temporarySale
     * @return \Illuminate\Http\Response
     */
    public function show(TemporarySale $temporarySale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemporarySale  $temporarySale
     * @return \Illuminate\Http\Response
     */
    public function edit(TemporarySale $temporarySale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemporarySale  $temporarySale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemporarySale $temporarySale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemporarySale  $temporarySale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        //Falta validaciones y try catch handle error
        try {
            $tempSale = TemporarySale::find($id);
            $tempSale->delete();   
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'data' => $e->getMessage()]);
        }
         
        return response()->json(['error'=> false, 'data'=> $tempSale]);
    }
}