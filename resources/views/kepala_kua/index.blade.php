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
                              <td> <a href="{{ route('kepala_kua_lihat_sertifikat_suami',$data->id) }}"><button class="btn btn-success ">Lihat Sertifikat</button></a> </td>
                              <td> <a href="{{ route('kepala_kua_lihat_sertifikat_istri',$data->id) }}"><button class="btn btn-success ">Lihat Sertifikat</button></a> </td>
                              
                              <td>
                                @if($data->status == 0)
                                  <a href="#" data-toggle="modal" onclick="VerifikasiData({{$data->id}})" data-target="#VerifikasiModal">
                                    <button class="btn btn-danger btn-sm " >Verifikasi Sertifikat</button>
                                  </a>
                                @endif

                                @if($data->status == 1)
                                  <button class="btn btn-success btn-sm" title="Ter-Verivikasi">Terverifikasi</button>
                                @endif
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




       <!-- Modal konfirmasi Hapus -->
    <div id="VerifikasiModal" class="modal fade" role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Verifikasi Sertifikat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <p>Apakah anda yakin ingin memverifikasi sertifikat ini ?</p><br>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
              <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Verifikasi</button>
            </div>
          </div>
        </form>
      </div>
    </div> 

  </div>

@endsection 

@section('scripts')
<script type="text/javascript">
  function VerifikasiData(id) {
    var id = id;
    var url = '{{route("verifikasi_sertifikat", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
</script>


@endsection



