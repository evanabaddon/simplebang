<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class TambangExport implements FromCollection
{	
	private $data;
	use Exportable;

	public function __construct($data) 
    {
        $this->data 	=	 $data;
    }

    public function collection()
    {
        return $this->data;
    }
}