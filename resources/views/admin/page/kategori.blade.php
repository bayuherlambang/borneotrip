@extends('admin.layouts.app')

@section('additional-header')
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kategori</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
                <button class="btn btn-primary btn-tambah">Tambah Kategori</button>
            </div>
            <div class="col-md-12">
                <br>
                <table id="data-artikel" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Jenis Kategori</th>
                        <th>Diperbarui Tanggal</th>
                        <th>Opsi</th>
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
                    "url": "{{ route('admin_kategori_data') }}",
                    "type": "post",
                    error: function (request, status, error) {
                            alert(request.responseText);
                    }
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
                                    return '<h6>'+data['name']+'</h6>';
                                }
                            },
                            {
                                "data": null,
                                "width": '15%',
                                "render": function(data){
                                    return '<h6>'+data["updated_at"]+'<br></h6>';
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


            function opsi(data){
                var del = '<span data-toggle="tooltip" data-placement="left" title="hapus slider">' +
                        '<a class="btn btn-danger btn-xs delete-btn">' +
                        '<i class="fa fa-trash-o"></i>' +
                        '</a>' +
                        '</span>&nbsp;';


                var edit = '<span data-toggle="tooltip" data-placement="right" title="Edit Caption">' +
                        '<a class="btn btn-primary btn-xs edit-btn" id="">' +
                        '<i class="fa fa-pencil"></i>' +
                        '</a>' +
                        '</span>&nbsp;';

                return del+edit;
            }

            $('#data-artikel tbody').on('click', '.delete-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                if(confirm("apakah anda yakin akan menghapus slider ?")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('admin_kategori_delete') }}",
                        data: "id="+datas["id"]
                    }).done(function(res){
                        if(res.success){
                            Table.ajax.reload( null, false );
                            info(res)
                        }
                    })
                }
            })



            $('#data-artikel tbody').on('click', '.edit-btn', function(){
                var datas  = Table.row( $(this).parents('tr') ).data();
                $('.editid').val(datas['id']);
                $('.editname').val(datas['name']);
                $('.modal-edit').modal('show');
            })

            $('#form-edit').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('admin_kategori_update') }}",
                    data: $('#form-edit').serialize(),
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Kategori</h4>
                </div>
                <form class="form-horizontal" id="form-tambah" action="{{route('admin_kategori_create')}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name">
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
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" id="form-edit" action="" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" value="" name="id" class="editid">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control editname" name="name">
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

@endsection