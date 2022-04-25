@extends('layouts.app')

@section('title')
Data Sertifikat Calon Pengantin
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Sertifikat Calon Pengantin</p>
                  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambah">
                    Tambah Sertifikat 
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
                              <th>Nama Calon Pengantin</th>
                              <th>Sertifikat Calon Suami</th>
                              <th>Sertifikat Calon Istri</th>
                            
                              <th>Aksi</th>
                              
                              <th style="display: none;">hidden</th>
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($sertifikat as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nama_calon_suami}} dan {{$data->nama_calon_istri}}</td>
                              <td> <a href="{{ route('lihat_sertifikat_suami',$data->id) }}"><button class="btn btn-success ">Lihat Sertifikat</button></a> </td>
                              <td> <a href="{{ route('lihat_sertifikat_istri',$data->id) }}"><button class="btn btn-success ">Lihat Sertifikat</button></a> </td>
                              
                              <td>
                                <!-- <button class="btn btn-success btn-sm icon-file menu-icon edit" title="Edit"></button> -->

                                <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                  <button class="btn btn-danger btn-sm icon-trash menu-icon" title="Hapus"></button>
                                </a>
                              </td>
                           
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
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Wali Nikah</h5>

                  </div>
                  <div class="modal-body">
                   <form method="post" action="{{route('sertifikat_add')}}" enctype="multipart/form-data">


                    {{csrf_field()}}

                   

                     <div class="form-group">
                     <label>Calon Pengantin</label>
                      <select type="text" class="form-control" id="id_calon_pengantin" name="id_calon_pengantin" required="">
                        <option selected disabled> -- Pilih Calon Pengantin -- </option>
                        @foreach($pengantin as $data)
                        <option value="{{$data->id}}">{{$data->nama_calon_suami}} dan {{$data->nama_calon_istri}}</option>
                        @endforeach
                      </select><br>
                    </div>
                   

                      <div class="form-group">
                        <label for="nomor">Nomor</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                         <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_terbit">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_kepala_kua">Nama Kepala Kua</label>
                        <input type="text" class="form-control" id="nama_kepala_kua" name="nama_kepala_kua"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nip">Nip</label>
                        <input type="text" class="form-control" id="nip" name="nip"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="foto_calon_suami">Foto Calon Suami</label>
                        <input type="file" class="form-control" id="foto_calon_suami" name="foto_calon_suami"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="foto_calon_istri">Foto Calon Istri</label>
                        <input type="file" class="form-control" id="foto_calon_istri" name="foto_calon_istri"  required=""></input>
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
          <div class="modal-dialog">
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

             

                    
                    <div class="form-group">
                     <label>Calon Pengantin</label>
                      <select type="text" class="form-control" id="id_calon_pengantin_update" name="id_calon_pengantin" required="">
                        <option selected disabled> -- Pilih Calon Pengantin -- </option>
                        @foreach($pengantin as $data)
                        <option value="{{$data->id}}">{{$data->nama_calon_suami}} dan {{$data->nama_calon_istri}}</option>
                        @endforeach
                      </select><br>
                    </div>
                   

                       <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_update" name="tanggal" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="jam">Jam</label>
                         <input type="time" class="form-control" id="jam_update" name="jam" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi_update" name="lokasi"  required=""></input>
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
              <h5 class="modal-title">Hapus Data Wali Nikah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <p>Apakah anda yakin ingin menghapus data wali nikah ini ?</p>
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
    var url = '{{route("sertifikat_delete", ":id") }}';
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
      $('#tanggal_update').val(data[3]);
      $('#jam_update').val(data[4]);
      $('#lokasi_update').val(data[5]);
      $('#updateInformasiform').attr('action','sertifikat_update/'+ data[7]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection



