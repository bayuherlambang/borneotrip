@extends('admin.layouts.app')

@section('additional-header')
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Berita</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Home</a></li>
              <li class="breadcrumb-item active">berita</li>
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
                <button class="btn btn-primary btn-tambah">Tambah Berita</button>
            </div>
            <div class="col-md-12">
                <br>
                <table id="data-artikel" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <tr>
                            <th>Judul</th>
                            <th>Intro Artikel</th>
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

            $('.btn-tambah').on('click', function(){
                document.getElementById('form-tambah').reset();
                $('.modal-new').modal('show');
            })

            var Table = $('#data-artikel').DataTable({
                "ajax": {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "url": "{{ route('admin_berita_data') }}",
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
                                "width": '30%',
                                "render": function(data){
                                    return '<h6>'+data["intro"]+'</h6>';
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
                var del = '<span data-toggle="tooltip" data-placement="left" title="hapus slider">' +
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
                        '<a class="btn btn-primary btn-xs edit-btn" id="">' +
                        '<i class="fa fa-pencil"></i>' +
                        '</a>' +
                        '</span>&nbsp;';

                return del+changestatus+edit;
            }
            

            $('#data-artikel tbody').on('click', '.delete-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                if(confirm("apakah anda yakin akan menghapus berita ini ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_berita_delete') }}",
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
                if(confirm("apakah anda yakin akan mengaktifkan berita ini ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_berita_active') }}",
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
                if(confirm("apakah anda yakin akan mentidakaktifkan berita ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_berita_deactive') }}",
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
                //$('.judul').val(datas['judul_artikel']);
                document.getElementById("judul").innerHTML = datas['judul_artikel'];
                document.getElementById("intro").innerHTML = datas['intro'];
                document.getElementById("konten").innerHTML = datas['konten'];
                document.getElementById("lokasi").innerHTML = datas['lokasi'];
                
                $('.modal-artikel').modal('show');
            })

            
            $('#data-artikel tbody').on('click', '.edit-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                $('.editid').val(datas['id']);
                $('.editjudul').val(datas['judul_artikel']);
                $('.editintro').val(datas['intro']);
                $('.editkonten').val(datas['konten']);
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
                    'url': "{{ route('admin_berita_update') }}",
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
    </script>

    <div class="modal modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Berita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" id="form-tambah" action="{{route('admin_berita_create')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="judul"  required="required">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Berita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" id="form-edit" action="{{route('admin_berita_update')}}" method="POST" enctype="multipart/form-data">
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
                            <label class="col-sm-3 control-label">Intro Artikel</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control editintro" name="intro"  required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Konten</label>
                            <div class="col-sm-9">
                                <textarea type="text"  class="form-control editkonten" name="konten" required="required"></textarea>
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
                            <h6>Intro:</h6><h6 id="intro"></h6><hr>
                            <h6>Konten:</h6><h6 id="konten"></h6><hr>
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

@endsection