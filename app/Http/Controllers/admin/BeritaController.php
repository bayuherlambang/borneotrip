<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Berita;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;

class BeritaController extends Controller
{
    public function index()
    {
        //$this->logActivity("Membuka Halaman Layanan Informasi Berkala");
        //$title = 'Destinasi Wisata';
        return View('admin/page/berita');
    }

    public function getData()
    {
        $berita = Berita::orderBy('id', 'asc')->get();
        $data['data'] = $berita->map(function($d){
            return [
                'id' => $d->id,
                'judul_artikel' => $d->title,
                'tanggal_update' => $d->updated_at(),
                'is_active' => $d->is_active,
                'posted_by' => $d->posted_by,
                'modified_by' => $d->modified_by,
                'created_at' => $d->created_at(),
                'intro' => $d->intro,
                'konten' => $d->content, 
            ];
        });

        return response()->json($data);
    }

    public function create(Request $request)
    {

        
        $judul = $request->input('judul');
        $intro = $request->input('intro');
        $konten = $request->input('konten');
        
        
        $upload = Berita::create([
            'title' => $judul,
            'intro' => $intro,
            'content' => $konten,
            'is_active' => true,
            'posted_by' => auth()->user()->username,
            'dilihat_sebanyak' => 1,
            'modified_by' => auth()->user()->username,
        ]);
        //$this->logActivity("Mengunggah dokumen regulasi dengan judul ".$upload->title);

        return redirect()->route('admin_berita_index')
            ->with([
                'status' => 'success',
                'title' => 'Berhasil Menambah Berita',
                'message' => 'Berita '.$judul.' Berhasil Diunggah'
            ]);
    }
    public function update(Request $request)
    {
        $update = Berita::find($request->input('id'));

        $update->update([
            //'image' => $filename,
            'title' => $request->input('judul'),
            'intro' => $request->input('intro'),
            'content' => $request->input('konten'),
            'modified_by' => auth()->user()->username,
        ]);

        //$this->logActivity("Mengupdate artikel dihalaman layanan informasi yang wajib ada dengan judul ".$data->title);

       return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Berita Berhasil Perbaharui',
            'title' => 'Sukses!',
        ]);

    }

    
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $delete = Berita::find($id);
        $delete->delete();
        //$this->logActivity("Menghapus artikel dengan judul ".$delete->title);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Berita Berhasil Dihapus',
            'title' => 'Sukses!',
        ]);
    }

    public function setActive(Request $request)
    {
        $id = $request->input('id');

        $active = Berita::find($id);
        $active->update([
            'is_active' => true,
            'modified_by' => auth()->user()->username,

        ]);
        //$this->logActivity("Mengubah status menjadi aktif dokumen regulasi dengan judul ".$active->title);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Berita '.$active->title.' Berhasil Diaktifkan atau Dipublikasi',
            'title' => 'Sukses!',
        ]);
    }

    public function setDeactive(Request $request)
    {
        $id = $request->input('id');

        $active = Berita::find($id);
        $active->update([
            'is_active' => false,
            'modified_by' => auth()->user()->username,

        ]);


        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Berita '.$active->title.' Berhasil ditidakaktifkan atau Tidak dipublikasi',
            'title' => 'Sukses!',
        ]);
    }
    
}
