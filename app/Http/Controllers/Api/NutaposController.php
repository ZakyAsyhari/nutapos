<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class NutaposController extends Controller
{
    public function soal4(Request $request){

        $validator = Validator::make($request->all(), [
            'total' => 'required|numeric|min:0',
            'persen_pajak' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $net = $request->total - ($request->total  * ($request->persen_pajak / 100));
        $pajak_rp = $request->total  * ($request->persen_pajak / 100);

        $data = $arrayName = array('net_sales' => $net , 'pajak_rp' => $pajak_rp);

        return new PostResource(true, 'Ok', $data);
    }

    public function soal5(Request $request){
        $validator = Validator::make($request->all(), [
            'total_sebelum_diskon' => 'required|numeric|min:0',
            'discount' => 'required|array',
            'discount.*.diskon' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $totalSebelumDiskon = $request->total_sebelum_diskon;
        $totalDiskon = 0;
        foreach ($request->discount as $discount) {
            $diskon = $discount['diskon'];
            $totalDiskon += ($diskon / 100) * $totalSebelumDiskon;
        }

        
        $totalHargaSetelahDiskon = $totalSebelumDiskon - $totalDiskon;
        $data = [
            'total_diskon' => $totalDiskon,
            'total_harga_setelah_diskon' => $totalHargaSetelahDiskon,
        ];

        return new PostResource(true, 'Ok', $data);
    }


    public function soal6(Request $request){

        $validator = Validator::make($request->all(), [
            'harga_sebelum_markup' => 'required|numeric|min:0',
            'markup_persen' => 'required|in:10,20,25',
            'share_persen' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $hargaSebelumMarkup = $request->harga_sebelum_markup;
        $markupPersen = $request->markup_persen;
        $sharePersen = $request->share_persen;

        $hargaMarkUp = ($markupPersen / 100) * $hargaSebelumMarkup;
        $netUntukResto = $hargaSebelumMarkup - $hargaMarkUp;

        $shareUntukOjol = ($sharePersen / 100) * $hargaMarkUp;


        $data = [
            'net_untuk_resto' => $netUntukResto,
            'share_untuk_ojol' => $shareUntukOjol,
        ];
        return new PostResource(true, 'Ok', $data);
    }
}
