<?php

namespace App\Exports;

use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class SalesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public $fromDate;
    public $toDate;
    public $facturado;
    public $lineBrake;
    public function __construct($fromDate = '', $toDate = '', $facturado = '')
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->facturado = $facturado;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('808080');
                // $event->sheet->getDelegate()->getCell('F9')->getCalculatedValue();
            },
        ];
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
                $sales = Sale::with('products')->get();
            endif;     
            
        if ($this->facturado !== ''){
            $sales->where('invoiced', $this->facturado);
        }

        return $this->generateSalesCollection($sales);

    }

    private function generateSalesCollection($sales) : Collection {
        //Validar si sales tiene 0 elementos
        $salesArray = [];
       
        foreach($sales as $sale){
           $this->productsExport = '';

           if (count($sale->products) > 1) : $this->lineBrake = "\r\n"; else: $this->lineBrake = ""; endif; 
            foreach($sale->products as $product){
                $this->productsExport .= $product->name . ' ' . $product->pivot->quantity . ' ' . $product->type . ' | precio/unitario ' . $product->pivot->sale_price . $this->lineBrake; 
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
