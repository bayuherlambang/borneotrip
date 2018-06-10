@extends('admin.layouts.app')

@section('additional-header')
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">

    <style type="text/css">
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
        z-index: 20;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

    .pac-container {
        background-color: #FFF;
        z-index: 20;
        position: fixed;
        display: inline-block;
        float: left;
    }
    .modal{
        z-index: 20;   
    }
    .modal-backdrop{
        z-index: 10;        
    }

  .pac-controls {
    display: inline-block;
    padding: 5px 11px;
  }

  .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }
    </style>
@endsection

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Destinasi Wisata</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Home</a></li>
              <li class="breadcrumb-item active">destinasi wisata</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 info">
                @if(Session::has('status'))
                    <div class="alert alert-{{Session::get('status')}}" role="alert" >
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>{{Session::get('title')}}</strong><br>
                        {{session::get('message')}}
                    </div>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary btn-tambah open-modal" data-id="create">Tambah Destinsi Wisata</button>
            </div>
            <div class="col-md-12">
                <br>
                <table id="data-artikel" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <tr>
                            <th>Judul</th>
                            <th>Gambar Banner</th>
                            <th>Intro Artikel</th>
                            <th>Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
      </div>
    </section>

   
@endsection

@section('additional-footer')
    <script src=" {{asset('admin/plugins/datatables/jquery.dataTables.min.js')}} "></script>
    <script src=" {{asset('admin/plugins/datatables/dataTables.bootstrap4.js')}} "></script>
    <script>
        $(document).ready(function(){
            //map_init(0,0);
            //initMap();
            $('.btn-tambah').on('click', function(){
                document.getElementById('form-tambah').reset();
                map_init(0,0);
                $('.modal-new').modal('show');
            })

            var Table = $('#data-artikel').DataTable({
                "ajax": {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "url": "{{ route('admin_destinasi_wisata_data') }}",
                    "type": "post"
                },
                "ordering": false,
                "Processing": true,
                "ServerSide": true,
                "columnDefs": [ ],
                "columns":
                        [
                            {
                                "data": null,
                                "width": '30%',
                                "render": function(data){
                                    return '<a href="#" class="artikel-modal"><h6>'+data["judul_artikel"]+'</h6></a>';
                                }
                            },

                            {
                                "data": null,
                                "width": '20%',
                                "render": function(data){
                                    return '<a href="#" class="img-modal"><h6><img style="width: 100%;" src="{{url('files/tour/')}}/'+data['gambar']+'" ><h6></a>';
                                }
                            },

                            {
                                "data": null,
                                "width": '30%',
                                "render": function(data){
                                    return '<h6>'+data["intro"]+'</h6>';
                                }
                            },

                            {
                                "data": null,
                                "width": '30%',
                                "render": function(data){
                                    return '<h6>'+data["lokasi"]+'</h6>';
                                }
                            },

                            {
                                "data": null,
                                "width": '30%',
                                "render": function(data){
                                    return '<h6>'+data["latitude"]+'</h6>';
                                }
                            },

                            {
                                "data": null,
                                "width": '30%',
                                "render": function(data){
                                    return '<h6>'+data["longitude"]+'</h6>';
                                }
                            },
    
                            {
                                "data": null,
                                "width": '10%',
                                "render": function(data){
                                    return '<h6><span data-toggle="tooltip" data-placement="top" title="diposting tanggal '+data["created_at"]+'">'+data["posted_by"]+'</span></h6>';
                                }
                            },

                            {
                                "data": null,
                                "width": '10%',
                                "render": function(data){
                                    return '<h6>'+status(data)+'</h6>';
                                }
                            },

                            {
                                "data": null,
                                "render": function(data){
                                    return '<h6>'+opsi(data)+'</h6>';
                                }
                            }

                        ]
            });

            function status(data){
                if(data['is_active'] == '1'){
                    return '<span class="label label-success"> Aktif </span>';
                }

                return '<span class="label label-danger"> Tidak Aktif </span>';
            }

            function opsi(data){
                var del = '<span data-toggle="tooltip" data-placement="left" title="hapus artikel">' +
                        '<a class="btn btn-danger btn-xs delete-btn">' +
                        '<i class="fa fa-trash-o"></i>' +
                        '</a>' +
                        '</span>&nbsp;';

                if(data['is_active'] == '1'){
                    var changestatus = '<span data-toggle="tooltip" data-placement="top" title="Ubah menjadi non active atau tidak terpublish">' +
                            '<a class="btn btn-warning btn-xs nonactive-btn">' +
                            '<i class="fa fa-close"></i>' +
                            '</a>' +
                            '</span>&nbsp;';
                } else {
                    var changestatus = '<span data-toggle="tooltip" data-placement="top" title="Ubah menjadi active atau terpublish">' +
                            '<a class="btn btn-success btn-xs active-btn">' +
                            '<i class="fa fa-check"></i>' +
                            '</a>' +
                            '</span>&nbsp;';
                }

                var edit = '<span data-toggle="tooltip" data-placement="right" title="Edit Caption">' +
                        '<a class="btn btn-primary btn-xs edit-btn open-modal">' +
                        '<i class="fa fa-pencil"></i>' +
                        '</a>' +
                        '</span>&nbsp;';

                return del+changestatus+edit;
            }
            

            $('#data-artikel tbody').on('click', '.delete-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                if(confirm("apakah anda yakin akan menghapus destinasi ini ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_destinasi_wisata_delete') }}",
                        data: "id="+datas["id"]
                    }).done(function(res){
                        if(res.success){
                            Table.ajax.reload( null, false );
                            info(res)
                        }
                    })
                }
            })

            $('#data-artikel tbody').on('click', '.active-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                if(confirm("apakah anda yakin akan mengaktifkan artikel ini ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_destinasi_wisata_active') }}",
                        data: "id="+datas["id"]
                    }).done(function(res){
                        if(res.success){
                            Table.ajax.reload( null, false );
                            info(res)
                        }
                    })
                }
            })

            $('#data-artikel tbody').on('click', '.nonactive-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                if(confirm("apakah anda yakin akan mentidakaktifkan artikel ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_destinasi_wisata_deactive') }}",
                        data: "id="+datas["id"]
                    }).done(function(res){
                        if(res.success){
                            Table.ajax.reload( null, false );
                            info(res)
                        }
                    })
                }
            })

            $('#data-artikel tbody').on('click', '.artikel-modal', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                
                document.getElementById("judul").innerHTML = datas['judul_artikel'];
                document.getElementById("intro").innerHTML = datas['intro'];
                document.getElementById("konten").innerHTML = datas['konten'];
                document.getElementById("lokasi").innerHTML = datas['lokasi'];
                
                var baseimg = '{{url('files/tour/')}}/'
                $('.gambar').attr('src', baseimg+datas['gambar']);
                $('.modal-artikel').modal('show');
            })

            $('#data-artikel tbody').on('click', '.img-modal', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                $('.editid').val(datas['id']);
                var baseimg = '{{url('files/tour/')}}/'
                $('.gambar').val(datas['gambar']);
                $('.editgambar').attr('src', baseimg+datas['gambar']);
                $('.modal-gambar').modal('show');
            })
            
            $('#data-artikel tbody').one('click', '.edit-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                $('.editid').val(datas['id']);
                $('.editjudul').val(datas['judul_artikel']);
                
                var baseimg = '{{url('files/tour/')}}/'
                $('.editgambarinput').val(datas['gambar']);
                $('.editgambar').attr('src', baseimg+datas['gambar']);

                $('.editintro').val(datas['intro']);
                $('.editkonten').val(datas['konten']);
                $('.pac-input').val(datas['lokasi']);
                $('.editlatitude').val(datas['latitude']);
                $('.editlongitude').val(datas['longitude']);
                //map_init(0,0);
                $('.modal-edit').modal('show');

            })
            
            $('#form-edit').on('submit', function (e) {
                e.preventDefault();

                var dataform = $('#form-edit').serialize();
                //console.log(data);
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'url': "{{ route('admin_destinasi_wisata_update') }}",
                    type: "post",
                    data: dataform,
                    error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                            //alert(thrownError);
                        }
                 }).done(function(res){
                    if(res.success){
                        Table.ajax.reload( null, false );
                        $('.modal-edit').modal('hide');
                        info(res)
                    }
                })
                
            })

            

        });
    </script>
    <script type="text/javascript" >
    function info(msg)
    {
        $('.info').prepend('<div class="alert alert-'+msg.status+'">' +
                ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong>'+msg.title+'</strong><br> '+msg.message+'</div>');
    }
    
    function map_init(lat,longi){
        var location = new google.maps.LatLng(lat,longi);
        var mapoptions = {
          zoom: 14,
          mapTypeControl: false,
          center:location,
          panControl:false,
          rotateControl:false,
          streetViewControl: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
     


        var map = new google.maps.Map(document.getElementById("map"), mapoptions);
 
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
       

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          draggable : true
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
            var lat = place.geometry.location.lat(),
            lng = place.geometry.location.lng();

            // Then do whatever you want with them
            updateMarkerPosition(marker.getPosition());
            //document.getElementById('latitude').value = lat;
            //document.getElementById('longitude').value = lng;
            google.maps.event.addListener(marker, 'drag', function() {
                // ketika marker di drag, otomatis nilai latitude dan longitude
                //menyesuaikan dengan posisi marker 
                updateMarkerPosition(marker.getPosition());
            });
        });
      }
    
    function updateMarkerPosition(latLng) {
        document.getElementById('latitude').value = [latLng.lat()];
        document.getElementById('longitude').value = [latLng.lng()];
    }

    /*
    function initialize() {
        var geocoder;
        var map;
        var address ="San Diego, CA";
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var myOptions = {
          zoom: 8,
          center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map'), myOptions);
        if (geocoder) {
          geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
              map.setCenter(results[0].geometry.location);

                var infowindow = new google.maps.InfoWindow(
                    { content: '<b>'+address+'</b>',
                      size: new google.maps.Size(150,50)
                    });

                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map, 
                    title:address
                }); 
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

              } else {
                alert("No results found");
              }
            } else {
              alert("Geocode was not successful for the following reason: " + status);
            }
          });
        }
      }
      */
      //initMap();
    </script>

    <div class="modal modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Destinasi Wisata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <form class="form-horizontal" id="form-tambah" action="{{route('admin_destinasi_wisata_create')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="judul"  required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="gambar" required="required" accept="image/png, image/jpg, image/jpeg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Intro Artikel</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="intro"  required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Konten</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" name="konten" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lokasi" required="required" id="pac-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Latitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="latitude" id="latitude" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Longitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="longitude" id="longitude" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pilih Lokasi</label>
                            <div class="pac-card" id="pac-card">
                              <div id="pac-container">
                                <input id="pac-input" type="text"
                                    placeholder="Enter a location">
                              </div>
                            </div>
                            <div id="map"></div>
                            <div id="infowindow-content">
                              <img src="" width="16" height="16" id="place-icon">
                              <span id="place-name"  class="title"></span><br>
                              <span id="place-address"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Wisata</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" id="form-edit" action="{{route('admin_destinasi_wisata_update')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" value="" name="id" class="editid">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control editjudul" name="judul"  required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>
                            <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <p class="help-block">What's this? :</p>
                                <ul class="help-block">
                                    <li>Gambar gabisa naik pake ajax (developer nggak ngerti gimana caranya)</li>
                                    <li>Untuk update gambar, klik gambar, nanti keluar pop up lagi kok :D</li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Intro Artikel</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control editintro" name="intro"  required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Konten</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control editkonten" name="konten" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" id="pac-input" class="form-control editlokasi pac-input" name="lokasi" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Latitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control editlatitude" name="latitude" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Longitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control editlongitude" name="longitude" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pilih Lokasi</label>
                            
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                    </div>
                    <div class="pac-card" id="pac-card">
                              <div id="pac-container">
                                <input id="pac-input" type="text"
                                    placeholder="Enter a location">
                              </div>
                            </div>
                            <div id="map"></div>
                            <div id="infowindow-content">
                              <img src="" width="16" height="16" id="place-icon">
                              <span id="place-name"  class="title"></span><br>
                              <span id="place-address"></span>
                            </div>
                </form>
            </div>
        </div>
    </div>
  
    <div class="modal modal-gambar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Gambar</h4>
                </div>
                <form class="form-horizontal" id="form-edit-gambar" action="{{route('admin_destinasi_wisata_update_gambar')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" value="" name="id" class="editid">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="gambar" accept="image/png, image/jpg, image/jpeg">
                            </div>
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>
                            <div class="col-sm-9">
                                <img class="editgambar" src="" style="width:100%">
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-artikel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                    <div class="modal-body">
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                            <h3 class="box-title">Preview Artikel</h3>
                        </div>
                        <div class="box-body">
                            <h6>Judul:</h6><h6 id="judul"></h6><hr>
                            <h6>Gambar Banner:</h6><br><img class="gambar" width="90%"><hr>
                            <h6>Intro:</h6><h6 id="intro"></h6><hr>
                            <h6>Konten:</h6><h6 id="konten"></h6><hr>
                            <h6>Lokasi:</h6><h6 id="lokasi"></h6><hr>
                        </div>
                        <!-- /.box-body -->
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgHnyFEq0oIjEJ_aBc7weL77z0Tq_STwE&libraries=places" async defer></script>


@endsection