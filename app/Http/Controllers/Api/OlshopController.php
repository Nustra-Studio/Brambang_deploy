<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanOlshop;

class OlshopController extends Controller
{
    public function syncLaporan(Request $request)
    {
        if ($request->header('X-OLSHOP-KEY') !== env('OLSHOP_KEY')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validatedData = $request->validate([
            'data' => 'required|array',
            'data.*.laporan_keuangan_id' => 'required|numeric',
            'data.*.nama_laporan' => 'required|string',
            'data.*.tanggal_laporan' => 'required|date',
            'data.*.jumlah_laporan' => 'required|numeric',
            'data.*.keterangan_laporan' => 'nullable|string',
            'data.*.status_laporan' => 'required|string',
            'data.*.kategori_laporan' => 'nullable|string',
        ]);

        foreach ($validatedData['data'] as $item) {
            LaporanOlshop::updateOrCreate(
                ['laporan_keuangan_id' => $item['laporan_keuangan_id']],
                $item
            );
        }

        return response()->json(['message' => 'Data synced successfully'], 200);
    }

    public function deleteLaporan(Request $request, $id)
    {
        if ($request->header('X-OLSHOP-KEY') !== env('OLSHOP_KEY')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $laporan = LaporanOlshop::where('laporan_keuangan_id', $id)->first();

        if (!$laporan) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $laporan->delete();

        return response()->json(['message' => 'Data deleted successfully'], 200);
    }

}
