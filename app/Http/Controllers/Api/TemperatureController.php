<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemperatureController extends Controller
{
    // Untuk mengirim/menyimpan data [POST]
    public function store(Request $request)
    {
        $data = $request->temperature;
        DB::table('temperature')->insert(["temperature"=>$data, "created_at"=> \Carbon\Carbon::now()]);
        return response()->json(
            ["status"=> 201, "message" => "Temperature berhasil disimpan"], 201
        );
    }

    // Untuk menampilkan data [GET]
    public function index()
    {
        $data = DB::table('temperature')->orderBy('id', 'desc')->get();
        return response()->json(
            ["status"=>200, "data"=> $data], 200
        );
    }
}
