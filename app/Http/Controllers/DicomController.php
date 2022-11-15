<?php

namespace App\Http\Controllers;

use App\Models\Dicom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DicomController extends Controller
{
    public function upload(Request $request){
        $this->validate($request, [
            'dicom' => 'required|mimes:jpg,png,jpeg,gif,svg,dcm|max:2048',
        ]);
        $path = Storage::putFile('public', $request->file('dicom'));
        $data = Dicom::create([
            'dicom' => $path,
        ]);
        return response($data, Response::HTTP_CREATED);
    }
    public function get($id){
        $data = Dicom::where('id', $id)->get();
        foreach($data as $img){
            $image = Storage::url($img->dicom);
            return $image;
        }
    }
    public function destroy($id){
        $data = Dicom::where('id', $id)->get();
        Dicom::where('id', $id)->delete();
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
