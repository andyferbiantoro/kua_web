@extends('layouts.app')

@section('title')
Data Penyuluh
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Penyuluh</p>
                  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambah">
                    Tambah Penyuluh
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
                              <th>NIK Penyuluh</th>
                              <th>Nama Pegawai</th>
                              <th>Tempat Tanggal Lahir</th>
                              <th>Jenis Kelamin</th>
                              <th>Agama</th>
                              <th>Alamat Rumah</th>
                              <th>Email</th>
                              <th>Aksi</th>
                              
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($penyuluh as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nik_penyuluh }}</td>
                              <td>{{$data->nama_pegawai }}</td>
                              <td>{{$data->tempat_lahir }}, {{date("j F Y", strtotime($data->tanggal_lahir))}}</td>
                              <td>{{$data->jenis_kelamin }}</td>
                              <td>{{$data->agama }}</td>
                              <td>{{$data->alamat_rumah }}</td>
                              <td>{{$data->alamat_email }}</td>
                              <td>
                                <button class="btn btn-success btn-sm icon-file menu-icon edit" title="Edit"></button>

                                <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                  <button class="btn btn-danger btn-sm icon-trash menu-icon" title="Hapus"></button>
                                </a>

                              </td>
                              
                              <td style="display: none;">{{$data->pendidikan_formal}}</td>
                              <td style="display: none;">{{$data->no_telp}}</td>
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
                    <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Penyuluh</h5>

                  </div>
                  <div class="modal-body">
                   <form method="post" action="{{route('kelola_penyuluh_add')}}" enctype="multipart/form-data">


                    {{csrf_field()}}

                    <div class="row"> 
                      <div class="col-lg-6">

                      

                      <div class="form-group">
                        <label for="nik_penyuluh">NIK Penyuluh</label>
                        <input type="number" class="form-control" id="nik_penyuluh" name="nik_penyuluh" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
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
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                       <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                    </div>


                    <div class="col-lg-6">
                      
                      
                       <div class="form-group">
                        <label for="pendidikan_formal">Pendidikan Formal</label>
                        <input type="text" class="form-control" id="pendidikan_formal" name="pendidikan_formal"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_rumah">Alamat Rumah</label>
                        <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"  required="" ></input>
                      </div>

                      <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="number" class="form-control" id="no_telp" name="no_telp"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_email">Email</label>
                        <input type="email" class="form-control" id="alamat_email" name="alamat_email"  required=""></input>
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
                        <label for="nik_penyuluh">NIK Penyuluh</label>
                        <input type="number" class="form-control" id="nik_penyuluh_update" name="nik_penyuluh" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai_update" name="nama_pegawai"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
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
                      <input type="date" class="form-control" id="tanggal_lahir_update" name="tanggal_lahir" ></input>
                    </div>

                      <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin_update" name="jenis_kelamin"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                       <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama_update" name="agama"  required="" onkeypress="return event.charCode < 48 || event.charCode  >57"></input>
                      </div>

                    </div>


                    <div class="col-lg-6">
                      

                       <div class="form-group">
                        <label for="pendidikan_formal">Pendidikan Formal</label>
                        <input type="text" class="form-control" id="pendidikan_formal_update" name="pendidikan_formal"  ></input>
                      </div>
                    

                      <div class="form-group">
                        <label for="alamat_rumah">Alamat Rumah</label>
                        <input type="text" class="form-control" id="alamat_rumah_update" name="alamat_rumah"  required="" ></input>
                      </div>

                     
                      <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="number" class="form-control" id="no_telp_update" name="no_telp"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_email">Email</label>
                        <input type="text" class="form-control" id="alamat_email_update" name="alamat_email"  required=""></input>
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
    var url = '{{route("kelola_penyuluh_delete", ":id") }}';
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
      $('#nik_penyuluh_update').val(data[1]);
      $('#nama_pegawai_update').val(data[2]);
      $('#jenis_kelamin_update').val(data[4]);
      $('#agama_update').val(data[5]);
      $('#pendidikan_formal_update').val(data[9]);
      $('#alamat_rumah_update').val(data[6]);
      $('#no_telp_update').val(data[10]);
      $('#alamat_email_update').val(data[7]);
      $('#updateInformasiform').attr('action','kelola_penyuluh_update/'+ data[11]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection



