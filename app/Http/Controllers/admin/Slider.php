<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Slider as model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class Slider extends Controller
{
    public function index()
    {
        //$this->logActivity("Mengakses halaman slider");
        return View('admin/page/slider');
    }

    public function create(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'file' => 'required|max:2000|mimes:jpeg,jpg,png',
        ]);

        if($validation->fails()){
            return redirect()->route('admin_slider_index')
                ->with([
                    'status' => 'danger',
                    'title' => 'Error',
                    'message' => 'Terjadi Kesalahan. Periksa Kembali Data yang Diunggah'
                ]);
        }


        $file = $request->file('file');

        $dest = public_path() . '/files/slider/';
        $ext = $file->getClientOriginalExtension();

        $hash = md5(date('Y-m-d h:i:s').auth()->user()->id.'kopet');
        $filename = $hash.".".$ext;
        $file->move($dest, $filename);

        $new = model::create([
            'image' => $filename,
            'caption' => $request->input('caption'),
            'is_active' => false,
            'posted_by' => auth()->user()->username,
            'modified_by' => auth()->user()->username
        ]);

        //$this->logActivity("Mengunggah slider baru dengan judul ".$new->caption);

        return redirect()->route('admin_slider_index')
            ->with([
                'status' => 'success',
                'title' => 'Sukses',
                'message' => 'Slider berhasil ditambahkan'
            ]);
    }

    public function getData()
    {
        $slider = model::orderBy('id', 'desc')->get();

        $data['data'] = $slider->map(function($d){
            return [
                'id' => $d->id,
                'caption' => $d->caption,
                'image' => $d->image,
                'posted_by' => $d->posted_by,
                'modified_by' => $d->modified_by,
                'is_active' => $d->is_active,
                'updated_at' => $d->updated_at(),
                'created_at' => $d->created_at()
            ];
        });

        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $active = model::find($id);
        $fulldir = public_path().'/files/slider/'.$active->image;
        unlink($fulldir);
        $active->delete();

        //$this->logActivity("Menghapus slider dengan judul ".$active->caption);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Slider Berhasil dihapus',
            'title' => 'Sukses!',
        ]);
    }

    public function update(Request $request)
    {
        $update = model::find($request->input('id'));
        $update->update([
            'caption' => $request->input('caption'),
            'modified_by' => auth()->user()->username
        ]);

        //$this->logActivity("Mengupdate slider dengan judul ".$update->caption);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Slider Berhasil Perbaharui',
            'title' => 'Sukses!',
        ]);
    }

    public function setActive(Request $request)
    {
        $id = $request->input('id');

        $active = model::find($id);
        $active->update([
            'is_active' => true,
            'modified_by' => auth()->user()->username

        ]);
        //$this->logActivity("Mengubah status slider menjadi aktif dengan judul ".$active->caption);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Slider Berhasil Diaktifkan atau Dipublikasi',
            'title' => 'Sukses!',
        ]);
    }

    public function setDeactive(Request $request)
    {
        $id = $request->input('id');

        $active = model::find($id);
        $active->update([
            'is_active' => false,
            'modified_by' => auth()->user()->username

        ]);
        //$this->logActivity("Mengubah status slider menjadi tidak aktif dengan judul ".$active->caption);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Slider Berhasil dinonaktifkan atau Tidak dipublikasi',
            'title' => 'Sukses!',
        ]);
    }
}
