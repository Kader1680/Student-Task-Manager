<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generateInvoicePdf($id)
    {
        $project = Project::where('id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $data = [
            'invoiceNumber' => 'INV-' . now()->format('Ymd') . '-' . $project->id,
            'invoiceDate'   => now()->format('Y-m-d'),
            'project'       => $project,
        ];

        $pdf = Pdf::loadView('invoices.project', $data);

        return $pdf->download('invoice-' . $project->id . '.pdf');
    }
}
