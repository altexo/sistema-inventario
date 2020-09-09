<?php

namespace App\Exports;

use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class SalesExport implements FromCollection, WithHeadings
{

    public $fromDate;
    public $toDate;
    public function __construct($fromDate = '', $toDate = '')
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      
            if(($this->fromDate != '') && ($this->toDate != '') ):
                $sales = Sale::with('products')->whereBetween(DB::raw('DATE(sales.created_at)'), [$this->fromDate, $this->toDate])->get();
            elseif($this->fromDate != ''):     
                $sales = Sale::with('products')->whereDate(DB::raw('DATE(sales.created_at)'), '>=', $this->fromDate)->get();
            elseif($this->toDate != ''):
                $sales = Sale::with('products')->whereDate(DB::raw('DATE(sales.created_at)'), '<=', $this->toDate)->get();
            else:
                $sales = Sale::with('products')->get;
            endif;     
       

        return $this->generateSalesCollection($sales);

    }

    private function generateSalesCollection($sales) : Collection {
        //Validar si sales tiene 0 elementos
        $salesArray = [];
       
        foreach($sales as $sale){
           $this->productsExport = '';
            foreach($sale->products as $product){
                $this->productsExport = $product->name . ' ' . $product->pivot->quantity . ' ' . $product->type . ' | precio/unitario ' . $product->pivot->sale_price . '\n'; 
            }
            $facturado = 'No';
            if ($sale->invoiced == 1){ 
                $facturado = 'Si' ;
            }
            array_push($salesArray, ['fecha' => $sale->created_at, 'productos' => $this->productsExport, 'cliente' => $sale->client, 'nota' => $sale->description, 'facturado' =>$facturado,'importe' => $sale->total]);
        }
        return new Collection($salesArray);
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Productos',
            'Cliente',
            'Nota',
            'Facturado',
            'Importe',
        ];
    }
}
