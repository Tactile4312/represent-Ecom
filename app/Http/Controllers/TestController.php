<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as Pdf;

class TestController extends Controller
{
    public function generatePdf()
    {
        $pdf = Pdf::loadView('test.pdf');
        return $pdf->download('hello-world.pdf');
    }
}
