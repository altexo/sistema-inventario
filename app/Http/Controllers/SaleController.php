<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SalesDetails;
use App\TemporarySale;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class SaleController extends Controller
{

    public $productsExport;
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
        //Hay que utilizar ->withTrashed() al reimprimir recibo y generar reportes
        $sale_details = SalesDetails::join('products', 'sales_details.product_id', '=', 'products.id')->where('sale_id', $last_sale->id)->get();

        return view('documents.recibo-venta-capytan', ['sale' => $last_sale, 'sale_details'=> $sale_details]);
    }

    public function showHistory(){
        //return request()->all();
        //return $sales = DB::select('select DATE(created_at) from sales');
        if((request()->has('fromDate') && request('fromDate') != '') || (request()->has('toDate') && request('toDate') != '')):
            $fromDate = request('fromDate');
            $toDate = request('toDate');
            if(($fromDate != '') && ($toDate != '') ):
                if (request()->has('facturado') && request('facturado') != ''){
                    $sales = Sale::with('products')->whereBetween(DB::raw('DATE(sales.created_at)'), array(request('fromDate'), request('toDate')))->where('invoiced', request('facturado'))->paginate(15);
                }else{
                    $sales = Sale::with('products')->whereBetween(DB::raw('DATE(sales.created_at)'), array(request('fromDate'), request('toDate')))->paginate(15);
                }
               
                $sales->appends(request()->input())->links();
               
            elseif($fromDate != ''):     
                if (request()->has('facturado') && request('facturado') != ''){
                    $sales = Sale::with('products')->whereDate(DB::raw('DATE(sales.created_at)'), '>=', $fromDate)->where('invoiced', request('facturado'))->paginate(15);
                }
                else{
                    $sales = Sale::with('products')->whereDate(DB::raw('DATE(sales.created_at)'), '>=', $fromDate)->paginate(15);
                }
                $sales->appends(request()->input())->links();
            elseif($toDate != ''):
                if (request()->has('facturado') && request('facturado') != ''){
                    $sales = Sale::with('products')->whereDate(DB::raw('DATE(sales.created_at)'), '<=', $toDate)->where('invoiced', request('facturado'))->paginate(15);
                }
                else{
                    $sales = Sale::with('products')->whereDate(DB::raw('DATE(sales.created_at)'), '<=', $toDate)->paginate(15);
                }
                $sales->appends(request()->input())->links();
            endif;     
        else:
            if (request()->has('facturado') && request('facturado') != ''){
                $sales = Sale::with('products')->where('invoiced', request('facturado'))->paginate(15);
                $sales->appends(request()->input())->links();
            }else{
                $sales = Sale::with('products')->paginate(15);
            }

            
        endif;
        //return $sales;
        if (request()->has('facturado') && request('facturado') != ''){
           

            // $sales = $this->manuallyPaginate($sales->where('invoiced', request('facturado')));//->appends('search', request('search'));;
            // $sales->appends(request()->query())->links(); 
           
        }

        return view('sales.history', ['sales' => $sales]);
    }

    public function deleteSale(){
        $sale = Sale::where('sales.id', request('id'))->first();
        try{
            DB::transaction(function () use ($sale) {
                foreach($sale->saleDetails as $sale_detail){
                    $product = Product::find($sale_detail->product_id);
                    $product->in_stock = ($product->in_stock + $sale_detail->quantity);
                    $product->save();
                    $sale_detail->delete();
                }
                $sale->delete();
            });
            Session::put('success', 'La venta se canceló correctamente');
        }catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return back(); 
        }
        return $this->showHistory();
    }

    public function export(){
        if(request()->has('fromDate') || request()->has('toDate')):
            $fromDate = request('fromDate');
            $toDate = request('toDate');

            return Excel::download(new SalesExport($fromDate, $toDate), 'ventas.xlsx');
        else:

            return Excel::download(new SalesExport, 'ventas.xls');
        endif;
    }

    private function manuallyPaginate($products)
    {
        $perPage = 1;
        $pageStart = request('page', 1);
        $offSet    = ($pageStart * $perPage) - $perPage;
        $productsForCurrentPage = $products->slice($offSet, $perPage);

        return new LengthAwarePaginator(
            $productsForCurrentPage, $products->count(), $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
    }
  

}


