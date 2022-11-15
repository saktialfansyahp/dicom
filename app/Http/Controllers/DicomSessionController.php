<?php

namespace App\Http\Controllers;

use App\Models\DicomSession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DicomSessionController extends Controller
{
    public function upload(Request $request){
        $this->validate($request, [
            'dicom' => 'required|mimes:jpg,png,jpeg,gif,svg,dcm|max:2048',
        ]);
        $path = Storage::putFile('public', $request->file('dicom'));
        $data = DicomSession::create([
            'dicom' => $path,
        ]);
        return response($data, Response::HTTP_CREATED);
    }
    public function get($id){
        $data = DicomSession::where('id', $id)->get();
        foreach($data as $img){
            $image = Storage::url($img->dicom);
            return $image;
        }
    }
    public function destroy($id){
        $data = DicomSession::where('id', $id)->get();
        DicomSession::where('id', $id)->delete();
        foreach($data as $img){
            $hapus = $img->dicom;
            try {
                Storage::delete($hapus);
                return 'deleted';
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
