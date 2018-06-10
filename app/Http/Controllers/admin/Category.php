<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\CategoryPosts as model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class Category extends Controller
{
    public function index()
    {
        return View('admin/page/kategori');
    }

    public function create(Request $request)
    {

        $new = model::create([
            'nama' => $filename,
        ]);

        //$this->logActivity("Mengunggah slider baru dengan judul ".$new->caption);

        return redirect()->route('admin_kategori_index')
            ->with([
                'status' => 'success',
                'title' => 'Sukses',
                'message' => 'Slider berhasil ditambahkan'
            ]);
    }

    public function getData()
    {
        $kat = model::orderBy('id', 'desc')->get();

        $data['data'] = $kat->map(function($d){
            return [
                'id' => $d->id,
                'name' => $d->name,
                'updated_at' => $d->updated_at()
            ];
        });

        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $active = model::find($id);
        $active->delete();

        //$this->logActivity("Menghapus slider dengan judul ".$active->caption);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Kategori Berhasil dihapus',
            'title' => 'Sukses!',
        ]);
    }

    public function update(Request $request)
    {
        $update = model::find($request->input('id'));
        $update->update([
            'name' => $request->input('name')
        ]);

        //$this->logActivity("Mengupdate slider dengan judul ".$update->caption);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Kategori Berhasil Perbaharui',
            'title' => 'Sukses!',
        ]);
    }
}
