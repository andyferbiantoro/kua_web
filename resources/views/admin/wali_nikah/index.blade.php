@extends('layouts.app')

@section('title')
Data Wali Nikah
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Wali Nikah</p>
                  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambah">
                    Tambah Wali Nikah
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
                              <th>Nama Lengkap</th>
                              <th>Tempat Tanggal Lahir</th>
                              <th>NIK</th>
                              <th>Kewarganegaraan</th>
                              <th>Agama</th>
                              <th>Pekerjaan</th>
                              <th>Alamat</th>
                              <th>Aksi</th>
                              
                              <th style="display: none;">hidden</th>
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($wali_nikah as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nama_lengkap }}</td>
                              <td>{{$data->tempat_lahir }}, {{date("j F Y", strtotime($data->tanggal_lahir))}}</td>
                              <td>{{$data->nik }}</td>
                              <td>{{$data->kewarganegaraan }}</td>
                              <td>{{$data->agama }}</td>
                              <td>{{$data->pekerjaan }}</td>
                              <td>{{$data->alamat }}</td>
                              <td>
                                <button class="btn btn-success btn-sm icon-file menu-icon edit" title="Edit"></button>

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
                   <form method="post" action="{{route('wali_nikah_add')}}" enctype="multipart/form-data">


                    {{csrf_field()}}

                      <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                      <div class="form-group form-success">
                        <label >Tempat Lahir</label>
                        <select  name="tempat_lahir" class="form-control"  required="">
                         <option selected disabled> -- Pilih Tempat Lahir -- </option>
                         @foreach($cities as $data)
                         <option >{{$data->city_name}}</option>
                         @endforeach
                       </select>
                       <span class="form-bar"></span>
                     </div>

                     <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"  required=""></input>
                    </div>

                      <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                      <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                      <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                       <div class="form-group">
                        <label for="alamat">Alamat Tempat Tinggal</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"  required=""></input>
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
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap_update" name="nama_lengkap" required=""></input>
                      </div>

                     <div class="form-group form-success">
                        <label >Tempat Lahir</label>
                        <select  name="tempat_lahir" class="form-control" >
                         <option selected disabled> -- Pilih Tempat Lahir -- </option>
                         @foreach($cities as $data)
                         <option >{{$data->city_name}}</option>
                         @endforeach
                       </select>
                       <span class="form-bar"></span>
                     </div>

                     <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" ></input>
                    </div>

                      <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik_update" name="nik"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="kewarganegaraan_update" name="kewarganegaraan"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama_update" name="agama"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_update" name="pekerjaan"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="alamat">Alamat Tempat Tinggal</label>
                        <input type="text" class="form-control" id="alamat_update" name="alamat"  required=""></input>
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
    var url = '{{route("wali_nikah_delete", ":id") }}';
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
      $('#nama_lengkap_update').val(data[1]);
      $('#ttl_update').val(data[2]);
      $('#nik_update').val(data[3]);
      $('#kewarganegaraan_update').val(data[4]);
      $('#agama_update').val(data[5]);
      $('#pekerjaan_update').val(data[6]);
      $('#alamat_update').val(data[7]);
      $('#updateInformasiform').attr('action','wali_nikah_update/'+ data[9]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection



