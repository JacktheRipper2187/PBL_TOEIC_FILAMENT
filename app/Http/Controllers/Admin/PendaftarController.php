<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\PendaftarsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Exception;

class PendaftarController extends Controller
{
    /**
     * Export data pendaftar ke file Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel()
    {
        try {
            $filename = 'pendaftars-' . now()->format('Y-m-d-H-i-s') . '.xlsx';
            return Excel::download(new PendaftarsExport, $filename);
        } catch (Exception $e) {
            Log::error('Export Excel Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal export Excel.'], 500);
        }
    }

    /**
     * Export data pendaftar ke file PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPdf()
    {
        try {
            $pendaftars = Pendaftar::all();
            if ($pendaftars->isEmpty()) {
                return response()->json(['error' => 'Data pendaftar kosong.'], 404);
            }
            $pdf = Pdf::loadView('admin.pendaftars.export_pdf', compact('pendaftars'));
            $filename = 'pendaftars-' . now()->format('Y-m-d-H-i-s') . '.pdf';
            return $pdf->download($filename);
        } catch (Exception $e) {
            Log::error('Export PDF Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal export PDF.'], 500);
        }
    }
}
