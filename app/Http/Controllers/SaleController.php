<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SalesDetails;
use App\TemporarySale;
use Illuminate\Http\Request;

class SaleController extends Controller
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

    public function index(){
        return view('sales.sale');
    }

    public function createSale(Request $request){
        //Validaciones y transaccion
        $tempSales = TemporarySale::all();
        $total = 0;
        if (count($tempSales) <= 0) {
            return  null;
        }
        foreach($tempSales as $ts){
            $total = $total+($ts->sale_price * $ts->quantity);
        }
        $sale = new Sale;
        $sale->description = $request->noteSale;
        $sale->invoiced = $request->invoiceSale;
        $sale->total = $total;
        $sale->save();

        foreach ($tempSales as $ts) {
            $saleDetails = new SalesDetails;
            $saleDetails->product_id = $ts->product_id;
            $saleDetails->sale_id = $sale->id;
            $saleDetails->quantity = $ts->quantity;
            $saleDetails->sale_price = $ts->sale_price;
            $saleDetails->save();
            $ts->delete();
        }

        return response()->json(['success'=>true, 'sale'=> $sale]);


    }

}
