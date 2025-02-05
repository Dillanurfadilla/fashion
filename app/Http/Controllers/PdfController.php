<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\FashionModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PdfController extends Controller
{
    public function fashionpdf()
    {
        // Fetch data from database
        $data['fashion'] = FashionModel::orderBy('id', 'desc')->paginate(10);

        // Create PDF instance
        $pdf = new Dompdf();

        // Load HTML content (Blade view)
        $html = view('fashion.pdf', $data)->render();
        $pdf->loadHtml($html);

        // (Optional) Set options for PDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $pdf->setOptions($options);

        // Render PDF (streaming to browser)
        $pdf->render();

        // Stream the generated PDF to the browser
        return $pdf->stream('fashion.pdf');
    }
}
