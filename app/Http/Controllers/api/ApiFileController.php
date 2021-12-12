<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ApiFileController extends Controller
{
    /**************************************
     *
     **************************************/
    public function upload(Request $request){
        $ret = true;
        $datetime = (String)strtotime("now");
        $temporary_file = $request->file('file1')->store('files_tmp');
        $origiinal_name = $request->file('file1')->getClientOriginalName();
    //var_dump( "temporary_file=". $temporary_file );
        $filename = $datetime . "_" . $origiinal_name;
        $storage_path = storage_path('app/') . $temporary_file;
        Storage::copy($temporary_file , 'files/' . $filename );
        Storage::delete($temporary_file );
        $arr = [
            'ret' => 'OK',
            'filename' => $filename,
        ];
        return response()->json($arr);
    }

}
