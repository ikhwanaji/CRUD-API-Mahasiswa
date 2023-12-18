<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\mahasiswa;



class MahasiswaController extends Controller
{
    function index()
    {
        $Mahasiswa = mahasiswa::all();

        $response =[
            'success' => true,
            'message' => 'list mahasiswa',
            'data' => $Mahasiswa
        ];
        return response()->json($response,200);
    }

    function store(Request $request)
    {
        $kode = "";
        $response= [];

        $validator = Validator::make($request->all(),[
            "nama"=> "required",
            "nim"=> "required",
            "jurusan"=> "required",
            "tanggal_lahir"=> "required",
            "alamat"=> "required"
        ]);

        if ($validator->fails()){
            $kode = 401;
            $response=[
                "success"=> false,
                "massage"=> "semua kolom wajib diisi",
                "data" => $validator->errors()
            ];
        } else{
            $Mahasiswa =mahasiswa::create($request->all());

            if ($Mahasiswa){
                $kode = 201;
                $response = [
                    "success" => true,
                    "massage" => "data Mahasiswa berhasil disimpan",
                    "data" => $Mahasiswa
                ];
            }else {
                $kode = 201 ;
                $response = [
                    "success" => false,
                    "massage" => "data pegawai gagal disimpan",
                    "data" => ''
                ];
            }
        }
        return response()->json($response, $kode);   
    }

    function show($id){
        $Mahasiswa = mahasiswa::find($id);

        if ($Mahasiswa){
            $kode = 200;
            $response = [
                'success' => true,
                'massage' => 'data mahasiswa berhasil ditemukan',
                'data' => $Mahasiswa
            ];
        }
        return response()->json($response, $kode);
    }

    function destroy($id){
        $Mahasiswa = mahasiswa::whereId($id)->First();

        if ($Mahasiswa != null){
            $Mahasiswa->delete();
            $kode = 200;
            $response = [
                'Success'=> true,
                'massage'=> 'data berhasil dihapus',
                'data'=>''
            ];
        }else{
            $kode = 404;
            $response = [
                'Success'=> false,
                'massage'=> 'data gagal dihapus dihapus',
                'data'=>''
            ];
        }
        return response()->json($response, $kode);
    }
      /**
     * Update the specified resource in storage.
     */
    function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "nama"=> "required",
            "nim"=> "required",
            "jurusan"=> "required",
            "tanggal_lahir"=> "required",
            "alamat"=> "required"
        ]);

        if ($validator->fails()){
            $kode = 401;
            $response = [
                'success' => false,
                'massage' => 'Semua kolom wajib diisi',
                'data' => $validator->errors()
            ];
        } else{
            $Mahasiswa = mahasiswa::whereId($id)->update([
                "nama" => $request->input('nama'),
                "nim" => $request->input('nim'),
                "jurusan" => $request->input('jurusan'),
                "tanggal_lahir" => $request->input('tanggal_lahir'),
                "alamat" => $request->input('alamat'),
            ]);
            if ($Mahasiswa){
                $kode = 400 ;
                $response =[
                    'success' => true,
                    'massage' => 'data mahasiswa berhasil di update',
                    'data' =>$Mahasiswa
                ];
            } else{
                $kode = 400;
                $response = [
                    'success' => false,
                    'massage' => 'data mahasiswa gagal di update',
                    'data' => ''
                ];
            }
        }
        return response()->json($response, $kode);
    }
}

   