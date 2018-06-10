<?php

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'admin_home']);

    Route::group(['prefix' => 'destinasi'], function(){
        Route::get('/', ['uses' => 'Destinasi@index', 'as' => 'admin_destinasi_index']);
        Route::post('getAllData', ['uses' => 'Destinasi@getData', 'as' => 'admin_destinasi_data']);
        Route::post('update-gambar', ['uses' => 'Destinasi@updateGambar', 'as' => 'admin_destinasi_update_gambar']);
        Route::post('create', ['uses' => 'Destinasi@create', 'as' => 'admin_destinasi_create']);
        Route::post('delete', ['uses' => 'Destinasi@delete', 'as'=>'admin_destinasi_delete']);
        Route::post('update', ['uses' => 'Destinasi@update', 'as'=>'admin_destinasi_update']);
        Route::post('active', ['uses' => 'Destinasi@setActive', 'as'=>'admin_destinasi_active']);
        Route::post('deactive', ['uses' => 'Destinasi@setDeactive', 'as'=>'admin_destinasi_deactive']);
    }); 

    Route::group(['prefix' => 'slider'], function(){
        Route::get('/', ['uses' => 'Slider@index', 'as' => 'admin_slider_index']);
        Route::post('getAllData', ['uses' => 'Slider@getData', 'as' => 'admin_slider_data']);
        Route::post('create', ['uses' => 'Slider@create', 'as' => 'admin_slider_create']);
        Route::post('delete', ['uses' => 'Slider@delete', 'as'=>'admin_slider_delete']);
        Route::post('update', ['uses' => 'Slider@update', 'as'=>'admin_slider_update']);
        Route::post('active', ['uses' => 'Slider@setActive', 'as'=>'admin_slider_active']);
        Route::post('deactive', ['uses' => 'Slider@setDeactive', 'as'=>'admin_slider_deactive']);
    });

    Route::group(['prefix' => 'destinasi-kuliner'], function(){
        Route::get('/', ['uses' => 'DestinasiKuliner@index', 'as' => 'admin_destinasi_kuliner_index']);
        Route::post('getAllData', ['uses' => 'DestinasiKuliner@getData', 'as' => 'admin_destinasi_kuliner_data']);
        Route::post('create', ['uses' => 'DestinasiKuliner@create', 'as' => 'admin_destinasi_kuliner_create']);
        Route::post('update-gambar', ['uses' => 'DestinasiKuliner@updateGambar', 'as' => 'admin_destinasi_kuliner_update_gambar']);
        Route::post('update', ['uses' => 'DestinasiKuliner@update', 'as' => 'admin_destinasi_kuliner_update']);
        Route::post('delete', ['uses' => 'DestinasiKuliner@delete', 'as'=>'admin_destinasi_kuliner_delete']);
        Route::post('active', ['uses' => 'DestinasiKuliner@setActive', 'as'=>'admin_destinasi_kuliner_active']);
        Route::post('deactive', ['uses' => 'DestinasiKuliner@setDeactive', 'as'=>'admin_destinasi_kuliner_deactive']);
    });

    Route::group(['prefix' => 'destinasi-wisata'], function(){
        Route::get('/', ['uses' => 'DestinasiWisata@index', 'as' => 'admin_destinasi_wisata_index']);
        Route::post('getAllData', ['uses' => 'DestinasiWisata@getData', 'as' => 'admin_destinasi_wisata_data']);
        Route::post('create', ['uses' => 'DestinasiWisata@create', 'as' => 'admin_destinasi_wisata_create']);
        Route::post('update-gambar', ['uses' => 'DestinasiWisata@updateGambar', 'as' => 'admin_destinasi_wisata_update_gambar']);
        Route::post('update', ['uses' => 'DestinasiWisata@update', 'as' => 'admin_destinasi_wisata_update']);
        Route::post('delete', ['uses' => 'DestinasiWisata@delete', 'as'=>'admin_destinasi_wisata_delete']);
        Route::post('active', ['uses' => 'DestinasiWisata@setActive', 'as'=>'admin_destinasi_wisata_active']);
        Route::post('deactive', ['uses' => 'DestinasiWisata@setDeactive', 'as'=>'admin_destinasi_wisata_deactive']);
    });
    Route::group(['prefix' => 'destinasi-event'], function(){
        Route::get('/', ['uses' => 'Event@index', 'as' => 'admin_destinasi_event_index']);
        Route::post('getAllData', ['uses' => 'Event@getData', 'as' => 'admin_destinasi_event_data']);
        Route::post('create', ['uses' => 'Event@create', 'as' => 'admin_destinasi_event_create']);
        Route::post('update-gambar', ['uses' => 'Event@updateGambar', 'as' => 'admin_destinasi_event_update_gambar']);
        Route::post('update', ['uses' => 'Event@update', 'as' => 'admin_destinasi_event_update']);
        Route::post('delete', ['uses' => 'Event@delete', 'as'=>'admin_destinasi_event_delete']);
        Route::post('active', ['uses' => 'Event@setActive', 'as'=>'admin_destinasi_event_active']);
        Route::post('deactive', ['uses' => 'Event@setDeactive', 'as'=>'admin_destinasi_event_deactive']);
    });
    Route::group(['prefix' => 'kategori'], function(){
        Route::get('/', ['uses' => 'Category@index', 'as' => 'admin_kategori_index']);
        Route::post('getAllData', ['uses' => 'Category@getData', 'as' => 'admin_kategori_data']);
        Route::post('create', ['uses' => 'Category@create', 'as' => 'admin_kategori_create']);
        Route::post('update', ['uses' => 'Category@update', 'as' => 'admin_kategori_update']);
        Route::post('delete', ['uses' => 'Category@delete', 'as'=>'admin_kategori_delete']);
    });
    /*
    Route::group(['prefix' => 'export', 'middleware' => 'administrator'], function(){
        Route::get('permohonan-data', ['uses' => 'Export@historyPermohonanData', 'as' => 'admin-export-permohonan-data']);
        Route::get('permohonan-data/{id}', ['uses' => 'Export@historyPermohonanDataById', 'as' => 'admin-export-permohonan-data-by-id']);
        Route::get('log-login', ['uses' => 'Export@logLogin', 'as' => 'admin-export-log-login']);
        Route::get('log-activity', ['uses' => 'Export@logAktifitas', 'as' => 'admin-export-log-activity']);
    });

    

    

    Route::group(['prefix' => 'layanan-informasi-publik'], function(){
        Route::get('/', ['uses' => 'LayananInformasiPublik@index', 'as' => 'admin_layanan_informasi_publik_index']);
        Route::post('update', ['uses' => 'LayananInformasiPublik@update', 'as'=>'admin_layanan_informasi_publik_update']);
    });

    Route::group(['prefix' => 'layanan-informasi-berkala'], function(){
        Route::get('/', ['uses' => 'LayananInformasiBerkala@index', 'as' => 'admin_layanan_informasi_berkala_index']);
        Route::post('getAllData', ['uses' => 'LayananInformasiBerkala@getAllData', 'as' => 'admin_layanan_informasi_berkala_data']);
        Route::post('create', ['uses' => 'LayananInformasiBerkala@create', 'as' => 'admin_layanan_informasi_berkala_create']);
        Route::post('update', ['uses' => 'LayananInformasiBerkala@update', 'as' => 'admin_layanan_informasi_berkala_update']);
        Route::post('delete', ['uses' => 'LayananInformasiBerkala@delete', 'as'=>'admin_layanan_informasi_berkala_delete']);
        Route::post('active', ['uses' => 'LayananInformasiBerkala@active', 'as'=>'admin_layanan_informasi_berkala_active']);
        Route::post('deactive', ['uses' => 'LayananInformasiBerkala@deactive', 'as'=>'admin_layanan_informasi_berkala_deactive']);
    });

    Route::group(['prefix' => 'layanan-informasi-serta-merta'], function(){
        Route::get('/', ['uses' => 'LayananInformasiSertaMerta@index', 'as' => 'admin_layanan_informasi_serta_merta_index']);
        Route::post('getAllData', ['uses' => 'LayananInformasiSertaMerta@getAllData', 'as' => 'admin_layanan_informasi_serta_merta_data']);
        Route::post('create', ['uses' => 'LayananInformasiSertaMerta@create', 'as' => 'admin_layanan_informasi_serta_merta_create']);
        Route::post('update', ['uses' => 'LayananInformasiSertaMerta@update', 'as' => 'admin_layanan_informasi_serta_merta_update']);
        Route::post('delete', ['uses' => 'LayananInformasiSertaMerta@delete', 'as'=>'admin_layanan_informasi_serta_merta_delete']);
        Route::post('active', ['uses' => 'LayananInformasiSertaMerta@active', 'as'=>'admin_layanan_informasi_serta_merta_active']);
        Route::post('deactive', ['uses' => 'LayananInformasiSertaMerta@deactive', 'as'=>'admin_layanan_informasi_serta_merta_deactive']);
    });

    Route::group(['prefix' => 'dokumen-dan-formulir'], function(){
        Route::get('/', ['uses' => 'DokumenDanFormulir@index', 'as' => 'admin_dokumen_dan_formulir_index']);
        Route::post('getAllData', ['uses' => 'DokumenDanFormulir@getAllData', 'as' => 'admin_dokumen_dan_formulir_data']);
        Route::post('create', ['uses' => 'DokumenDanFormulir@create', 'as' => 'admin_dokumen_dan_formulir_create']);
        Route::post('update', ['uses' => 'DokumenDanFormulir@update', 'as' => 'admin_dokumen_dan_formulir_update']);
        Route::post('delete', ['uses' => 'DokumenDanFormulir@delete', 'as'=>'admin_dokumen_dan_formulir_delete']);
        Route::post('active', ['uses' => 'DokumenDanFormulir@active', 'as'=>'admin_dokumen_dan_formulir_active']);
        Route::post('deactive', ['uses' => 'DokumenDanFormulir@deactive', 'as'=>'admin_dokumen_dan_formulir_deactive']);
    });

    Route::group(['prefix' => 'users', 'middleware' => 'administrator'], function(){
        Route::get('/', ['uses' => 'Users@index', 'as' => 'admin_users_index']);
        Route::post('getAllData', ['uses' => 'Users@getAllData', 'as' => 'admin_users_data']);
        Route::post('create', ['uses' => 'Users@create', 'as' => 'admin_users_create']);
        Route::post('resetPassword', ['uses' => 'Users@resetPassword', 'as' => 'admin_users_chpass']);
        Route::post('update', ['uses' => 'Users@update', 'as' => 'admin_users_update']);
        Route::post('delete', ['uses' => 'Users@delete', 'as'=>'admin_users_delete']);
    });

    Route::group(['prefix' => 'layanan-informasi-yang-wajib-ada'], function(){
        Route::get('/', ['uses' => 'LayananInformasiYangWajibAda@index', 'as' => 'admin_layanan_informasi_yang_wajib_ada_index']);
        Route::post('update', ['uses' => 'LayananInformasiYangWajibAda@update', 'as'=>'admin_layanan_informasi_yang_wajib_ada_update']);
    });

    Route::group(['prefix' => 'kegiatan-kip'], function(){
        Route::get('/', ['uses' => 'KegiatanKip@index', 'as' => 'admin_kegiatan_kip_index']);
        Route::post('getAllData', ['uses' => 'KegiatanKip@getData', 'as' => 'admin_kegiatan_kip_data']);
        Route::post('create', ['uses' => 'KegiatanKip@create', 'as' => 'admin_kegiatan_kip_create']);
        Route::post('delete', ['uses' => 'KegiatanKip@delete', 'as'=>'admin_kegiatan_kip_delete']);
        Route::post('update', ['uses' => 'KegiatanKip@update', 'as'=>'admin_kegiatan_kip_update']);
        Route::post('active', ['uses' => 'KegiatanKip@setActive', 'as'=>'admin_kegiatan_kip_active']);
        Route::post('deactive', ['uses' => 'KegiatanKip@setDeactive', 'as'=>'admin_kegiatan_kip_deactive']);
    });

    Route::group(['prefix' => 'permohonan-data'], function(){
        Route::get('/', ['uses' => 'PermohonanData@index', 'as' => 'admin_permohonan_data_index']);
        Route::post('all', ['uses' => 'PermohonanData@all', 'as' => 'admin_permohonan_data_all']);
        Route::post('delete', ['uses' => 'PermohonanData@delete', 'as' => 'admin_permohonan_data_delete']);
        Route::post('accept', ['uses' => 'PermohonanData@accept', 'as' => 'admin_permohonan_data_accept']);
        Route::post('reject', ['uses' => 'PermohonanData@reject', 'as' => 'admin_permohonan_data_reject']);
        Route::post('process', ['uses' => 'PermohonanData@process', 'as' => 'admin_permohonan_data_process']);
        Route::post('bentuk-informasi', ['uses' => 'PermohonanData@bentukInformasi', 'as' => 'admin_permohonan_data_bentuk_informasi']);
        Route::post('upload-berkala', ['uses' => 'PermohonanData@uploadBerkala', 'as' => 'admin_permohonan_data_upload_berkala']);
    });
    */
});

