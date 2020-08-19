<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SalesDetails;
use App\TemporarySale;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
        $success = false;
        $msg = "";
        //Validaciones y transaccion
        $request->validate([
            'noteSale' => 'max:300|min:3',
            'invoiceSale' => 'required',
        ]);
        $tempSales = TemporarySale::all();
       
        if (count($tempSales) <= 0) {
            return  null;
        }
        try {
            DB::transaction(function () use ($tempSales, $request) { 
                $total = 0;
                foreach($tempSales as $ts){
                    $total = $total+($ts->sale_price * $ts->quantity);
                }
                $sale = new Sale;
                $sale->description = $request->noteSale;
                $sale->invoiced = $request->invoiceSale;
                $sale->client = $request->clientName;
                $sale->total = $total;
                $sale->save();
        
                foreach ($tempSales as $ts) {
                    $saleDetails = new SalesDetails;
                    $product = Product::find($ts->product_id);
                    $product->in_stock = $product->in_stock - $ts->quantity;
                    $saleDetails->product_id = $ts->product_id;
                    $saleDetails->sale_id = $sale->id;
                    $saleDetails->quantity = $ts->quantity;
                    $saleDetails->sale_price = $ts->sale_price;
                    $saleDetails->save();
                    $product->save();
                    $ts->delete();
                }        
                 
                }, 2);
               
                $success = true;
            } catch (\Exception $e) {
                $msg = $e->getMessage();
            }
       

        return response()->json(['success'=>$success, 'message' => $msg]);


    }

    public function printSale(){
        $last_sale = Sale::latest()->first();
       // return $last_sale->created_at->format('m');
        //Hay que utilizar ->withTrashed() al reimprimir recibo y generar reportes
        $sale_details = SalesDetails::join('products', 'sales_details.product_id', '=', 'products.id')->where('sale_id', $last_sale->id)->get();

        return view('documents.recibo-venta-capytan', ['sale' => $last_sale, 'sale_details'=> $sale_details]);
    }

    public function showHistory(){
        $sales = Sale::with('products')->get();
        return view('sales.history', ['sales' => $sales]);
    }

}


