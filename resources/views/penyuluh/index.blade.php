@extends('layouts.app')

@section('title')
Data Materi Pra-Nikah
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Materi Pra-Nikah</p>
                  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambah">
                    Tambah Materi 
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
                              <th>Nama Materi</th>
                              <th>Calon Pengantin</th>
                              <th>Aksi</th>
                              
                              <th style="display: none;">hidden</th>
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($bimbingan as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->list_nama_materi}}</td>
                              <td>{{$data->nama_calon_suami}} dan {{$data->nama_calon_istri}}</td>
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
                    <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Materi</h5>

                  </div>
                  <div class="modal-body">
                   <form method="post" action="{{route('penyuluh_materi_add')}}" enctype="multipart/form-data">

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
                      <label>Materi Bimbingan</label>
                      @foreach($materi as $data)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$data->id}}" id="{{$data->id}}" name="id_materi_bimbingan[]">
                        <label class="form-check-label" for="{{$data->id}}">
                          {{$data->nama_materi}}
                        </label>
                      </div>
                      @endforeach
                    </div>
                     
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="id_user_penyuluh" name="id_user_penyuluh" value="{{ Auth::user()->id }}" />
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

              

                    <div class="form-group" style="margin-left:20px">
                      <label id="detail_materi_update">Materi Bimbingan</label>
                      @foreach($materi as $data)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$data->id}}" id="detail_materi_update" name="id_materi_bimbingan[]">
                        <label class="form-check-label" for="{{$data->id}}">
                          {{$data->nama_materi}}
                        </label>
                      </div>
                      @endforeach
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
    var url = '{{route("penyuluh_materi_delete", ":id") }}';
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
      $('#nama_materi_update').val(data[1]);
      $('#updateInformasiform').attr('action','penyuluh_materi_update/'+ data[4]);
      $('#updateInformasi').modal('show');
    });
  });
</script>

@endsection



