<?php

namespace App\Http\Controllers\guest;

use App\Slider;
use App\Articles;
use App\CategoryPosts;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->get();
        $slider = $sliders->map(function($d){
        	return [
        		'caption' => $d->caption,
        		'image' => url('files/slider/').'/'.$d->image,
        	];
        });

        $tours = Articles::where(['is_active' => true])->orderBy('id', 'asc')->get();
        $tour = $tours->map(function($d){
            return [
                'id' => $d->id,
                'gambar' => url('files/tour/').'/'.$d->image,
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
                'longitude' => $d->longitude,
                'kategori' => CategoryPosts::where('id', $d->category_id)->first()->name
            ];
        });
        
        $kat = CategoryPosts::orderBy('id', 'desc')->get();
        $kategori = $kat->map(function($d){
            return [
                'id' => $d->id,
                'name' => $d->name,
            ];
        });

        return View('guest/home', compact('slider', 'tour', 'kategori'));
    }
    public function page($judul, $id)
    {
        $data = Articles::find($id);
        //redirect ke 404 -_-
        //if($data == null) return redirect()->route('404');
        $data->visit();
        return View('guest/page/single', compact('data'));
    }
    public function lokasi($lokasi)
    {
        if ($lokasi!='') {
            $tours = Articles::where("lokasi", "LIKE", "%{$lokasi}%")->where('is_active', true)->orderBy('id', 'asc')->get();
            $tour = $tours->map(function($d){
            return [
                'id' => $d->id,
                'gambar' => url('files/tour/').'/'.$d->image,
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
                'longitude' => $d->longitude,
                'kategori' => CategoryPosts::where('id', $d->category_id)->first()->name
            ];
        });



            $kat = CategoryPosts::orderBy('id', 'desc')->get();
            $kategori = $kat->map(function($d){
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            });
            if($tours){
                return View('guest/page/list', compact('tour', 'kategori', 'lokasi'));
            }
            else{
                $error="nothing here";
                return View('guest/page/list', compact('error'));
            }

        }
        
    }

    public function notFound()
    {
        return View('guest/page/404_not_found');
    }
}
