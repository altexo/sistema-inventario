<?php

namespace App\Http\Controllers;

use App\Product;
use App\StockEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class StockEntryController extends Controller
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
        //
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
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1'
            ]);
        
        try {
            DB::transaction(function () use ($request) {
                $stock_entry = new StockEntry;
                $stock_entry->product_id = $request->product_id;
                $stock_entry->quantity = $request->quantity;
                $stock_entry->price = $request->price;
                $stock_entry->save();
                
                $product = Product::find($request->product_id);
                $product->in_stock = $product->in_stock + $request->quantity;
                $product->last_price = $request->price;
                $product->save();
                // DB::table('products')->where('id', $request->product_id)->increment('in_stock', $request->quantity);
                // DB::table('products')->where('id', $request->product_id)->update(['last_price' => $request->price]);
              
            }, 3);
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            return back();
        }
        Session::put('success', 'El inventario se actualizó correctamente');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock_entry = StockEntry::find($id);
        $product = Product::find($stock_entry->product_id);
        if($stock_entry->quantity <= $product->in_stock){
            try {
                DB::transaction(function () use ($stock_entry, $product) { 
                    $product->in_stock = $product->in_stock - $stock_entry->quantity;
                    $stock_entry->delete();
                    $product->save();
                     
                    }, 3);
                } catch (\Exception $e) {
                    Session::put('error', $e->getMessage());
                    return back();
                }
            Session::put('success', 'El registro se eliminó correctamente');
        }else{
            Session::put('error', 'Este registro no puede ser eliminado. Existe menos producto en inventario que la cantidad del registro que intenta eliminar.');
        }

       
        return back();
    }
}
