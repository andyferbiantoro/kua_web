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
                              <th>Jenis Penyuluh</th>
                              <th>NIK Penyuluh</th>
                              <th>Nama Pegawai</th>
                              <th>Tempat Tanggal Lahir</th>
                              <th>Jenis Kelamin</th>
                              <th>Agama</th>
                              <th>Alamat Tumah</th>
                              <th>Email</th>
                              <th>Aksi</th>
                              
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
                              <th style="display: none;">hidden</th>
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
                              <td>{{$data->jenis_penyuluh }}</td>
                              <td>{{$data->nik_penyuluh }}</td>
                              <td>{{$data->nama_pegawai }}</td>
                              <td>{{$data->tempat_tanggal_lahir }}</td>
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
                              
                              <td style="display: none;">{{$data->jenis_penyuluh}}</td>
                              <td style="display: none;">{{$data->nik_penyuluh}}</td>
                              <td style="display: none;">{{$data->nama_pegawai}}</td>
                              <td style="display: none;">{{$data->gelar_depan}}</td>
                              <td style="display: none;">{{$data->gelar_belakang}}</td>
                              <td style="display: none;">{{$data->tempat_tanggal_lahir}}</td>
                              <td style="display: none;">{{$data->jenis_kelamin}}</td>
                              <td style="display: none;">{{$data->agama}}</td>
                              <td style="display: none;">{{$data->status_keluarga}}</td>
                              <td style="display: none;">{{$data->pendidikan_formal}}</td>
                              <td style="display: none;">{{$data->bidang_keahlian}}</td>
                              <td style="display: none;">{{$data->unit_kerja}}</td>
                              <td style="display: none;">{{$data->tempat_tugas}}</td>
                              <td style="display: none;">{{$data->wilayah_kerja}}</td>
                              <td style="display: none;">{{$data->diklat_fungsional}}</td>
                              <td style="display: none;">{{$data->jenjang_jabatan}}</td>
                              <td style="display: none;">{{$data->tanggal_sk_cpns}}</td>
                              <td style="display: none;">{{$data->masa_kerja_berdasarkan_skpp}}</td>
                              <td style="display: none;">{{$data->alamat_rumah}}</td>
                              <td style="display: none;">{{$data->kabupaten}}</td>
                              <td style="display: none;">{{$data->provinsi}}</td>
                              <td style="display: none;">{{$data->no_telp}}</td>
                              <td style="display: none;">{{$data->alamat_email}}</td>
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
                        <label for="jenis_penyuluh">Janis Penyuluh</label>
                        <input type="text" class="form-control" id="jenis_penyuluh" name="jenis_penyuluh" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nik_penyuluh">NIK Penyuluh</label>
                        <textarea type="text" class="form-control" id="nik_penyuluh" name="nik_penyuluh" required=""></textarea>
                      </div>

                      <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="gelar_depan">Gelar Depan</label>
                        <input type="text" class="form-control" id="gelar_depan" name="gelar_depan"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="gelar_belakang">Gelar Belakang</label>
                        <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tempat_tanggal_lahir">Tempat Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="status_keluarga">Status Keluarga</label>
                        <input type="text" class="form-control" id="status_keluarga" name="status_keluarga"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="pendidikan_formal">Pendidikan Formal</label>
                        <input type="text" class="form-control" id="pendidikan_formal" name="pendidikan_formal"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="bidang_keahlian">Bidang Keahlian</label>
                        <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="unit_kerja">Unit Kerja</label>
                        <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"  required=""></input>
                      </div>

                    </div>


                    <div class="col-lg-6">
                      
                      <div class="form-group">
                        <label for="tempat_tugas">Tempat Tugas</label>
                        <input type="text" class="form-control" id="tempat_tugas" name="tempat_tugas"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="wilayah_kerja">Wilayah Kerja</label>
                        <input type="text" class="form-control" id="wilayah_kerja" name="wilayah_kerja"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="diklat_fungsional">Diklat Fungsional</label>
                        <input type="text" class="form-control" id="diklat_fungsional" name="diklat_fungsional"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="jenjang_jabatan">Jenjang Jabatan</label>
                        <input type="text" class="form-control" id="jenjang_jabatan" name="jenjang_jabatan"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_sk_cpns">Tanggal SK CPNS</label>
                        <input type="date" class="form-control" id="tanggal_sk_cpns" name="tanggal_sk_cpns"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="masa_kerja_berdasarkan_skpp">Masa Kerja Berdasarkan SKPP</label>
                        <input type="text" class="form-control" id="masa_kerja_berdasarkan_skpp" name="masa_kerja_berdasarkan_skpp"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_rumah">Alamat Rumah</label>
                        <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <input type="text" class="form-control" id="kabupaten" name="kabupaten"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_email">Email</label>
                        <input type="text" class="form-control" id="alamat_email" name="alamat_email"  required=""></input>
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
                        <label for="jenis_penyuluh">Janis Penyuluh</label>
                        <input type="text" class="form-control" id="jenis_penyuluh_update" name="jenis_penyuluh" required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="nik_penyuluh">NIK Penyuluh</label>
                        <textarea type="text" class="form-control" id="nik_penyuluh_update" name="nik_penyuluh" required=""></textarea>
                      </div>

                      <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai_update" name="nama_pegawai"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="gelar_depan">Gelar Depan</label>
                        <input type="text" class="form-control" id="gelar_depan_update" name="gelar_depan"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="gelar_belakang">Gelar Belakang</label>
                        <input type="text" class="form-control" id="gelar_belakang_update" name="gelar_belakang"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tempat_tanggal_lahir">Tempat Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tempat_tanggal_lahir_update" name="tempat_tanggal_lahir"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin_update" name="jenis_kelamin"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama_update" name="agama"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="status_keluarga">Status Keluarga</label>
                        <input type="text" class="form-control" id="status_keluarga_update" name="status_keluarga"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="pendidikan_formal">Pendidikan Formal</label>
                        <input type="text" class="form-control" id="pendidikan_formal_update" name="pendidikan_formal"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="bidang_keahlian">Bidang Keahlian</label>
                        <input type="text" class="form-control" id="bidang_keahlian_update" name="bidang_keahlian"  required=""></input>
                      </div>

                       <div class="form-group">
                        <label for="unit_kerja">Unit Kerja</label>
                        <input type="text" class="form-control" id="unit_kerja_update" name="unit_kerja"  required=""></input>
                      </div>

                    </div>


                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="tempat_tugas">Tempat Tugas</label>
                        <input type="text" class="form-control" id="tempat_tugas_update" name="tempat_tugas"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="wilayah_kerja">Wilayah Kerja</label>
                        <input type="text" class="form-control" id="wilayah_kerja_update" name="wilayah_kerja"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="diklat_fungsional">Diklat Fungsional</label>
                        <input type="text" class="form-control" id="diklat_fungsional_update" name="diklat_fungsional"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="jenjang_jabatan">Jenjang Jabatan</label>
                        <input type="text" class="form-control" id="jenjang_jabatan_update" name="jenjang_jabatan"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_sk_cpns">Tanggal SK CPNS</label>
                        <input type="date" class="form-control" id="tanggal_sk_cpns_update" name="tanggal_sk_cpns"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="masa_kerja_berdasarkan_skpp">Masa Kerja Berdasarkan SKPP</label>
                        <input type="text" class="form-control" id="masa_kerja_berdasarkan_skpp_update" name="masa_kerja_berdasarkan_skpp"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat_rumah">Alamat Rumah</label>
                        <input type="text" class="form-control" id="alamat_rumah_update" name="alamat_rumah"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <input type="text" class="form-control" id="kabupaten_update" name="kabupaten"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi_update" name="provinsi"  required=""></input>
                      </div>

                      <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="text" class="form-control" id="no_telp_update" name="no_telp"  required=""></input>
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
      $('#jenis_penyuluh_update').val(data[10]);
      $('#nik_penyuluh_update').val(data[11]);
      $('#nama_pegawai_update').val(data[12]);
      $('#gelar_depan_update').val(data[13]);
      $('#gelar_belakang_update').val(data[14]);
      $('#tempat_tanggal_lahir_update').val(data[15]);
      $('#jenis_kelamin_update').val(data[16]);
      $('#agama_update').val(data[17]);
      $('#status_keluarga_update').val(data[18]);
      $('#pendidikan_formal_update').val(data[19]);
      $('#bidang_keahlian_update').val(data[20]);
      $('#unit_kerja_update').val(data[21]);
      $('#tempat_tugas_update').val(data[22]);
      $('#wilayah_kerja_update').val(data[23]);
      $('#diklat_fungsional_update').val(data[24]);
      $('#jenjang_jabatan_update').val(data[25]);
      $('#tanggal_sk_cpns_update').val(data[26]);
      $('#masa_kerja_berdasarkan_skpp_update').val(data[27]);
      $('#alamat_rumah_update').val(data[28]);
      $('#kabupaten_update').val(data[29]);
      $('#provinsi_update').val(data[30]);
      $('#no_telp_update').val(data[31]);
      $('#alamat_email_update').val(data[32]);
      $('#updateInformasiform').attr('action','kelola_penyuluh_update/'+ data[33]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection



