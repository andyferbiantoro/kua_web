@extends('layouts.app')

@section('title')
Data Jadwal Pra-Nikah
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Jadwal Pra-Nikah</p>
                  
               

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
                              <th>Nama Penyuluh</th>
                              <th>Nama Pengantin</th>
                              <th>Tanggal</th>
                              <th>Jam</th>
                              <th>Lokasi</th>
                              <th>Aksi</th>
                              <th style="display: none;">hidden</th>
                              <th>Status Penyuluhan</th>
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($jadwal as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nama_pegawai}}</td>
                              <td>{{$data->nama_calon_suami}} dan {{$data->nama_calon_istri}}</td>
                              <td>{{$data->tanggal }}</td>
                              <td>{{$data->jam }}</td>
                              <td>{{$data->lokasi }}</td>
                              <td>
                                @if($data->status == 0)
                                <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#VerifiModal">
                                  <button class="btn btn-danger btn-sm " >Verifikasi Jadwal</button>
                                </a>
                                @endif

                                @if($data->status == 1)
                                <button class="btn btn-outline-success btn-fw" title="Ter-Verivikasi">Terverifikasi</button>
                                @endif
                              </td>
                              <td style="display: none;">{{$data->id}}</td>

                              <td>
                                @if($data->bukti_penyuluhan == null && $data->status_penyuluhan == 0)
                                 <label>upload bukti penyuluhan untuk menyelesaikan</label>
                                 <button class="btn btn-warning btn-sm edit" title="Edit">Upload bukti</button>
                                @endif

                                @if($data->status_penyuluhan == 0 && $data->bukti_penyuluhan != null)
                                  <a href="#" data-toggle="modal" onclick="finishData({{$data->id}})" data-target="#SelesaikanModal">
                                    <button class="btn btn-danger btn-sm" >Selesaikan Penyuluhan</button>
                                  </a>
                                @endif

                                 @if($data->status_penyuluhan == 1 && $data->bukti_penyuluhan != null)
                                 <button class="btn btn-outline-success btn-fw" title="Ter-Verivikasi">Penyuluhan Telah Diselesaikan</button>
                                @endif

                              </td>

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




       <!-- Modal konfirmasi Hapus -->
    <div id="VerifiModal" class="modal fade" role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Verifikasi Jadwal Pra-Nikah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <p>Apakah anda yakin ingin verifikasi jadal pra-nikah ini ?</p><br>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
              <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Vesifikasi</button>
            </div>
          </div>
        </form>
      </div>
    </div> 




    <div id="SelesaikanModal" class="modal fade" role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="finishForm" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Verifikasi Jadwal Pra-Nikah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <p>Apakah anda yakin ingin menyelesaikan jadal pra-nikah ini ?</p><br>
              
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
              <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmitFinish()">Selesaikan</button>
            </div>
          </div>
        </form>
      </div>
    </div> 






    <!-- Modal Update -->
        <div id="BuktiPenyuluhan" class="modal fade" role="dialog">
          <div class="modal-dialog">
           <!--Modal content-->
           <form action="" id="BuktiPenyuluhanform" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Upload Bukti Penyuluhan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                  <div class="form-group">
                    <div class="form-group">
                        <label for="bukti_penyuluhan">Bukti Penyuluhan</label>
                        <input type="file" class="form-control" id="bukti_penyuluhan" name="bukti_penyuluhan"  required=""></input>
                      </div>

                  </div> 
                   <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                <button type="submit"  class="btn btn-primary float-right mr-2" >Upload</button>
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
    var url = '{{route("penyuluh_verifikasi_jadwal", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
</script>

<script type="text/javascript">
  function finishData(id) {
    var id = id;
    var url = '{{route("penyuluh_selesaikan_bimbingan", ":id") }}';
    url = url.replace(':id', id);
    $("#finishForm").attr('action', url);
  }

  function formSubmitFinish() {
    $("#finishForm").submit();
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
      $('#BuktiPenyuluhanform').attr('action','penyuluh_upload_bukti/'+ data[7]);
      $('#BuktiPenyuluhan').modal('show');
    });
  });
</script>


@endsection



