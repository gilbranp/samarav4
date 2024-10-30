<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;

class TrackingDonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donates = Donate::orderBy('created_at', 'desc')->take(5)->get();
        // Hitung total donasi uang
        $totalCashDonate = Donate::whereNotNull('amount')->sum('amount');
        // Hitung total donasi barang
        $totalItemDonate = Donate::whereNotNull('item_name')->sum('item_qty');

        return view('backend.donate.donate', compact('donates', 'totalCashDonate', 'totalItemDonate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function tracking(string $id)
    {
        $donate = Donate::find($id);
        $courierId = $donate->courier_id;
        $resi = $donate->awb;
        $basePath = env('BINDERBYTE_BASE_API', '');
        $path = $basePath . "?api_key=" . env('BINDERBYTE_API_KEY', '') . "&courier=" . $courierId . "&awb=" . $resi;
        $response = $this->_getDataByCurl($path);

        $responsehistory = $response->data->history;
        $donationArray = (array) $responsehistory;
        $jmlhHistory = count($donationArray);
        // Reverse the array
        $reversedArray = array_reverse($donationArray);
        // Convert array back to object
        $track = (object) $reversedArray;

        return view('backend.donate.tracking', compact('donate', 'track', 'jmlhHistory'));
    }

    private function _getDataByCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 999999);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }
}
