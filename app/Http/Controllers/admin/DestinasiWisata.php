<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Articles;
use App\CategoryPosts;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;

class DestinasiWisata extends Controller
{
    public function index()
    {
        //$this->logActivity("Membuka Halaman Layanan Informasi Berkala");
        $title = 'Wisata';
        return View('admin/page/destinasi_wisata', compact('title'));
    }

    public function getData()
    {
        $cat = CategoryPosts::where('name', 'Wisata')->first()->id;
        $kuliner = Articles::where('category_id', $cat)->orderBy('id', 'asc')->get();
        $data['data'] = $kuliner->map(function($d){
            return [
                'id' => $d->id,
                'gambar' => $d->image,
                'judul_artikel' => $d->title,
                'tanggal_update' => $d->updated_at(),
                'is_active' => $d->is_active,
                'posted_by' => $d->posted_by,
                'modified_by' => $d->modified_by,
                'created_at' => $d->created_at(),
                'intro' => $d->intro,
                'konten' => $d->content, 
                'lokasi' => $d->lokasi,
                'latitude' => $d->latitude,
                'longitude' => $d->longitude
            ];
        });

        return response()->json($data);
    }

    public function create(Request $request)
    {
        /*
        $validation = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg, jpeg',
            'judul' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->route('admin_destinasi_kuliner_index')
                ->with([
                    'status' => 'danger',
                    'title' => 'Error',
                    'message' => 'Terjadi Kesalahan. Periksa Kembali Data yang Diunggah'
                ]);
        }
        */
        
        $judul = $request->input('judul');
        $intro = $request->input('intro');
        $konten = $request->input('konten');
        $lokasi = $request->input('lokasi');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        //$dest = public_path() . '/files/kuliner';
        //$ext = $file->getClientOriginalExtension();

        $file = $request->file('gambar');
        $dest = public_path() . '/files/tour/';
        $ext = $file->getClientOriginalExtension();
        $hash = md5(date('Y-m-d h:i:s').auth()->user()->id.'kopet');
        $filename = $hash.".".$ext;
        $file->move($dest, $filename);
        
        $upload = Articles::create([
            'title' => $judul,
            'image' => $filename,
            'intro' => $intro,
            'content' => $konten,
            'lokasi' => $lokasi,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'is_active' => true,
            'posted_by' => auth()->user()->username,
            'dilihat_sebanyak' => 1,
            'modified_by' => auth()->user()->username,
            'category_id' => CategoryPosts::where('name', 'Wisata')->first()->id
        ]);
        //$this->logActivity("Mengunggah dokumen regulasi dengan judul ".$upload->title);

        return redirect()->route('admin_destinasi_wisata_index')
            ->with([
                'status' => 'success',
                'title' => 'Berhasil Menambah Wisata',
                'message' => 'Destinasi '.$judul.' Berhasil Diunggah'
            ]);
    }
    public function update(Request $request)
    {
        $update = Articles::find($request->input('id'));

       
        /*
        $file = $request->file('gambar');

        $dest = public_path() . '/files/tour/';
        $ext = $file->getClientOriginalExtension();

        $hash = md5(date('Y-m-d h:i:s').auth()->user()->id.'kopet');
        $filename = $hash.".".$ext;
        $file->move($dest, $filename);
        */
        $update->update([
            //'image' => $filename,
            'title' => $request->input('judul'),
            'intro' => $request->input('intro'),
            'content' => $request->input('konten'),
            'lokasi' => $request->input('lokasi'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'modified_by' => auth()->user()->username,
            'category_id' => CategoryPosts::where('name', 'Wisata')->first()->id
        ]);

        //$this->logActivity("Mengupdate artikel dihalaman layanan informasi yang wajib ada dengan judul ".$data->title);

       return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Artikel Berhasil Perbaharui',
            'title' => 'Sukses!',
        ]);

    }
    public function updateGambar(Request $request){
        $update = Articles::find($request->input('id'));
        $oldfile = public_path().'/files/tour/'.$update->image;
        $file = $request->file('gambar');
        $dest = public_path() . '/files/tour/';
        $ext = $file->getClientOriginalExtension();
        $hash = md5(date('Y-m-d h:i:s').auth()->user()->id.'kopet');
        $filename = $hash.".".$ext;
        $file->move($dest, $filename);


        $update->update([
            'image' => $filename,
            'modified_by' => auth()->user()->username,
            'category_id' => CategoryPosts::where('name', 'Wisata')->first()->id
        ]);

        
        unlink($oldfile);

        return redirect()->route('admin_destinasi_wisata_index')
            ->with([
                'status' => 'success',
                'title' => 'Berhasil Menambah Wisata',
                'message' => 'Gambar Berhasil Diupdate'
            ]);
    }
    
    public function delete(Request $request)
    {
        $id = $request->input('id');

        $delete = Articles::find($id);

        $fulldir = public_path().'/files/tour/'.$delete->image;
        unlink($fulldir);

        $delete->delete();
        //$this->logActivity("Menghapus artikel dengan judul ".$delete->title);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Artikel Berhasil Dihapus',
            'title' => 'Sukses!',
        ]);
    }

    public function setActive(Request $request)
    {
        $id = $request->input('id');

        $active = Articles::find($id);
        $active->update([
            'is_active' => true,
            'modified_by' => auth()->user()->username,

        ]);
        //$this->logActivity("Mengubah status menjadi aktif dokumen regulasi dengan judul ".$active->title);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Artikel '.$active->title.' Berhasil Diaktifkan atau Dipublikasi',
            'title' => 'Sukses!',
        ]);
    }

    public function setDeactive(Request $request)
    {
        $id = $request->input('id');

        $active = Articles::find($id);
        $active->update([
            'is_active' => false,
            'modified_by' => auth()->user()->username,

        ]);


        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Artikel '.$active->title.' Berhasil ditidakaktifkan atau Tidak dipublikasi',
            'title' => 'Sukses!',
        ]);
    }
    
}
