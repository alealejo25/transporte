<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class AbonosPorLineaExport implements WithMultipleSheets
{
    protected $data;

    public function __construct($agrupado)
    {
        $this->data = $agrupado;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->data as $empresa => $lineas) {
            foreach ($lineas as $linea => $fechas) {
                $sheetTitle = substr("Linea " . $linea, 0, 31);
                $rows = [];
                $totalJub = 0;
                $totalAbono = 0;

                foreach ($fechas as $fecha => $boletos) {
                    $jub = $boletos->sum('abonojubilado');
                    $abo = $boletos->sum('abono');
                    $totalJub += $jub;
                    $totalAbono += $abo;

                    $rows[] = [
                        'Fecha' => Carbon::parse($fecha)->format('d-m-y'),
                        'Abonos Jubilados' => $jub,
                        'Abonos Comunes' => $abo,
                        'Total Día' => $jub + $abo
                    ];
                }

                // Agregar la fila TOTAL al final de cada hoja
                $rows[] = [
                    'Fecha' => 'TOTAL',
                    'Abonos Jubilados' => $totalJub,
                    'Abonos Comunes' => $totalAbono,
                    'Total Día' => $totalJub + $totalAbono
                ];

                $sheets[] = new class(collect($rows), $sheetTitle) implements FromCollection, WithTitle, WithHeadings {
                    protected $collection;
                    protected $title;

                    public function __construct(Collection $collection, $title)
                    {
                        $this->collection = $collection;
                        $this->title = $title;
                    }

                    public function collection()
                    {
                        return $this->collection;
                    }

                    public function title(): string
                    {
                        return $this->title;
                    }

                    public function headings(): array
                    {
                        return ['Fecha', 'Abonos Jubilados', 'Abonos Comunes', 'Total Día'];
                    }
                };
            }
        }

        return $sheets;
    }
}