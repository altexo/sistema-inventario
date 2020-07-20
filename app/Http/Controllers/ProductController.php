<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use Spatie\Searchable\Search;
use App\Product;
use App\StockEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helpers\InStock;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        $products = Product::paginate(15);
        //  Session::put('success', 'Connection timeout');
        return view('products.products', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'product_name' => 'required|max:100|min:3',
            'type' => 'required',
            ]);
            $product = new Product;
            $stock_entries = new StockEntry;
            try {
                DB::transaction(function () use ($product, $stock_entries, $request) { 
                        
                    $product->name = $request->product_name;
                    $product->type = $request->type;
                    $product->in_stock = 0;
                    $product->last_price = 0;
                    $product->save();
                    if(isset($request->add_to_stock)){
                        //Create new Stock Entrie
           
                        $stock_entries->product_id = $product->id;
                        $stock_entries->quantity =  $request->quantity;
                        $stock_entries->price = $request->price;
                        //Product updates
                        $product->in_stock = $product->in_stock + $request->quantity;
                        $product->last_price = $request->price;
                        //Save both
                        $stock_entries->save();
                        $product->save();
            
            
                    }
                     
                    }, 2);
                } catch (\Exception $e) {
                    Session::put('error', $e->getMessage());
                    return back();
                }
        //    Session::put('success', 'El Producto se registró correctamente.');

   
        

        Session::put('success', 'El producto se guardo correctamente');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        $product = Product::find($id);
        $stock_entries = StockEntry::where('product_id', $id)->take(5)->get();
        return view('products.view', ['product' => $product, 'stock_entries'=> $stock_entries]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
        // $product = Product::find($id);
        return view('products.edit', ['product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:100|min:3'
        ]);

        $product->name = $request->name;
        try {
            $product->save();
            Session::put('success', 'El producto se actualizó con exito.');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
          
        return $this->edit($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        $product = Product::find($id);
        try {
            $product->delete();
            Session::put('success', 'El producto se borro con exito.');
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
        }
           
        return redirect('products');
    }

    public function searchProduct(Request $request){
        if(!$request->input('query')){
            return null;
        }
        $results = (new Search())
        ->registerModel(Product::class, 'name')
        ->search($request->input('query'));
        
        return response()->json($results);
    }    
}
