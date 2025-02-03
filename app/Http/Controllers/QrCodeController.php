<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

class QrCodeController extends Controller
{
    public function generateQrCode(Request $request)
    {
        // Step 1: Validate request data
        $request->validate([
            'data' => 'required|string',
        ]);

        // Step 2: Get data for the QR code
        $data = $request->input('data');

        // Step 3: Generate QR Code as an SVG (No Imagick needed)
        $qrCode = QrCode::format('svg')->size(300)->generate($data);

        // Step 4: Return the QR code as a response
        return Response::make($qrCode, 200, ['Content-Type' => 'image/svg+xml']);
    }
}
