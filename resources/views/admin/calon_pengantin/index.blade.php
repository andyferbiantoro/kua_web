@extends('layouts.app')

@section('title')
Data Calon Penganting
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Calon Pengantin</p>
                  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambah">
                    Tambah Calon Pengantin
                  </button><br><br>
               

                @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
                @endif
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="dataTable" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NIK Calon Suami</th>
                              <th>NIK Calon Istri</th>
                              <th>Nama Calon Suami</th>
                              <th>Nama Calon Istri</th>
                              <th>Alamat Calon Suami</th>
                              <th>Alamat Calon Istri</th>
                              <th>No Handphone</th>
                              <th>E-Mail</th>
                              <th>Tanggal Menikah</th>
                              <th>Aksi</th>
                              <th style="display: none;">nohp suami hidden</th>
                              <th style="display: none;">nohp istri hidden</th>
                              <th style="display: none;">email suami hidden</th>
                              <th style="display: none;">email istri hidden</th>
                              <th style="display: none;">hidden</th>
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($catin as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nik_calon_suami }}</td>
                              <td>{{$data->nik_calon_istri }}</td>
                              <td>{{$data->nama_calon_suami }}</td>
                              <td>{{$data->nama_calon_istri }}</td>
                              <td>{{$data->alamat_calon_suami }}</td>
                              <td>{{$data->alamat_calon_istri }}</td>
                              <td>{{$data->no_hp_calon_suami }} & {{$data->no_hp_calon_istri }}</td>
                              <td>{{$data->email_calon_suami }} & {{$data->email_calon_istri }}</td>
                              <td>{{date("j F Y", strtotime($data->tanggal_rencana_menikah))}}</td>
                              <td>
                                <button class="btn btn-success btn-sm icon-file menu-icon edit" title="Edit"></button>

                                <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                  <button class="btn btn-danger btn-sm icon-trash menu-icon" title="Hapus"></button>
                                </a>
                              </td>
                              <td style="display: none;">{{$data->no_hp_calon_suami}}</td>
                              <td style="display: none;">{{$data->no_hp_calon_istri}}</td>
                              <td style="display: none;">{{$data->email_calon_suami}}</td>
                              <td style="display: none;">{{$data->email_calon_istri}}</td>
                              <td style="display: none;">{{$data->id}}</td>

                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>



            <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Calon Pengantin</h5>

                  </div>
                  <div class="modal-body">
                   <form method="post" action="{{route('calon_pengantin_add')}}" enctype="multipart/form-data">


                    {{csrf_field()}}

                    <div class="row"> 
                      <div class="col-lg-6">

                       <div class="form-group">
                        <label for="nama">NIK Calon Suami</label>
                        <input type="text" class="form-control" id="nik_calon_suami" name="nik_calon_suami" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_calon_suami">Nama Calon Suami</label>
                        <textarea type="text" class="form-control" id="nama_calon_suami" name="nama_calon_suami" required=""></textarea>
                      </div>

                      <div class="form-group">
                        <label for="no_hp_calon_suami">No handphone Calon Suami</label>
                        <input type="text" class="form-control" id="no_hp_calon_suami" name="no_hp_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="email_calon_suami">Email Calon Suami</label>
                        <input type="text" class="form-control" id="email_calon_suami" name="email_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_calon_suami">Alamat Calon Suami</label>
                        <input type="text" class="form-control" id="alamat_calon_suami" name="alamat_calon_suami"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="ttl_calon_suami">Tempat Tanggal Lahir Calon Suami</label>
                        <input type="text" class="form-control" id="ttl_calon_suami" name="ttl_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_rencana_menikah">Tanggal Rencana Menikah</label>
                        <input type="date" class="form-control" id="tanggal_rencana_menikah" name="tanggal_rencana_menikah"  required=""></input>
                      </div>

                    </div>


                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="nama">NIK Calon Istri</label>
                        <input type="text" class="form-control" id="nik_calon_istri" name="nik_calon_istri" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_calon_istri">Nama Calon Istri</label>
                        <textarea type="text" class="form-control" id="nama_calon_istri" name="nama_calon_istri" required=""></textarea>
                      </div>

                      <div class="form-group">
                        <label for="no_hp_calon_istri">No handphone Calon Istri</label>
                        <input type="text" class="form-control" id="no_hp_calon_istri" name="no_hp_calon_istri"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="email_calon_istri">Email Calon Istri</label>
                        <input type="text" class="form-control" id="email_calon_istri" name="email_calon_istri"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_calon_istri">Alamat Calon Istri</label>
                        <input type="text" class="form-control" id="alamat_calon_istri" name="alamat_calon_istri"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="ttl_calon_istri">Tempat Tanggal Lahir Calon Istri</label>
                        <input type="text" class="form-control" id="ttl_calon_istri" name="ttl_calon_istri"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"  required=""></input>
                      </div>

                    </div>

                  </div> 

                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="Submit">Tambahkan</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

                </div>
              </form>
            </div>
          </div>
        </div>






        <!-- Modal Update -->
        <div id="updateInformasi" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
           <!--Modal content-->
           <form action="" id="updateInformasiform" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Anda yakin ingin memperbarui Data Menu ini ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ csrf_field() }}
                {{ method_field('POST') }}

               <div class="row"> 
                      <div class="col-lg-6">

                       <div class="form-group">
                        <label for="nama">NIK Calon Suami</label>
                        <input type="text" class="form-control" id="nik_calon_suami_update" name="nik_calon_suami" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_calon_suami">Nama Calon Suami</label>
                        <textarea type="text" class="form-control" id="nama_calon_suami_update" name="nama_calon_suami" required=""></textarea>
                      </div>

                      <div class="form-group">
                        <label for="no_hp_calon_suami">No handphone Calon Suami</label>
                        <input type="text" class="form-control" id="no_hp_calon_suami_update" name="no_hp_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="email_calon_suami">Email Calon Suami</label>
                        <input type="text" class="form-control" id="email_calon_suami_update" name="email_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_calon_suami">Alamat Calon Suami</label>
                        <input type="text" class="form-control" id="alamat_calon_suami_update" name="alamat_calon_suami"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="ttl_calon_suami">Tempat Tanggal Lahir Calon Suami</label>
                        <input type="text" class="form-control" id="ttl_calon_suami_update" name="ttl_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_rencana_menikah">Tanggal Rencana Menikah</label>
                        <input type="date" class="form-control" id="tanggal_rencana_menikah_update" name="tanggal_rencana_menikah"  required=""></input>
                      </div>

                    </div>


                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="nama">NIK Calon Istri</label>
                        <input type="text" class="form-control" id="nik_calon_istri_update" name="nik_calon_istri" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_calon_istri">Nama Calon Istri</label>
                        <textarea type="text" class="form-control" id="nama_calon_istri_update" name="nama_calon_istri" required=""></textarea>
                      </div>

                      <div class="form-group">
                        <label for="no_hp_calon_istri">No handphone Calon Istri</label>
                        <input type="text" class="form-control" id="no_hp_calon_istri_update" name="no_hp_calon_istri"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="email_calon_istri">Email Calon Istri</label>
                        <input type="text" class="form-control" id="email_calon_istri_update" name="email_calon_istri"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_calon_istri">Alamat Calon Istri</label>
                        <input type="text" class="form-control" id="alamat_calon_istri_update" name="alamat_calon_istri"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="ttl_calon_istri">Tempat Tanggal Lahir Calon Istri</label>
                        <input type="text" class="form-control" id="ttl_calon_istri_update" name="ttl_calon_istri"  required=""></input>
                      </div>

                    </div>

                  </div> 
                   <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                <button type="submit"  class="btn btn-primary float-right mr-2" >Perbarui</button>
              </div>
            </div>
          </form>
        </div>
      </div>


       <!-- Modal konfirmasi Hapus -->
    <div id="DeleteModal" class="modal fade" role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Data Pengantin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <p>Apakah anda yakin ingin menghapus data pengantin ini ?</p>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
              <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
            </div>
          </div>
        </form>
      </div>
    </div> 

  </div>

@endsection 

@section('scripts')
<script type="text/javascript">
  function deleteData(id) {
    var id = id;
    var url = '{{route("calon_pengantin_delete", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
</script>


<script>
  $(document).ready(function() {
    var table = $('#dataTable').DataTable();
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
      console.log(data);
      $('#nik_calon_suami_update').val(data[1]);
      $('#nama_calon_suami_update').val(data[3]);
      $('#no_hp_calon_suami_update').val(data[11]);
      $('#email_calon_suami_update').val(data[13]);
      $('#alamat_calon_suami_update').val(data[5]);
      $('#tanggal_rencana_menikah_update').val(data[9]);
      $('#nik_calon_istri_update').val(data[2]);
      $('#nama_calon_istri_update').val(data[4]);
      $('#no_hp_calon_istri_update').val(data[12]);
      $('#email_calon_istri_update').val(data[14]);
      $('#alamat_calon_istri_update').val(data[6]);

      $('#updateInformasiform').attr('action','calon_pengantin_update/'+ data[15]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection



