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
                 <!--  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambah">
                    Tambah Materi 
                  </button><br><br> -->
               

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
                              <th>Nama Materi</th>
                              <th>Calon Pengantin</th>
                              
                             
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($materi as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nama_pegawai}}</td>
                              <td>{{$data->nama_materi }}</td>
                              <td>{{$data->nama_calon_suami }} dan {{$data->nama_calon_istri }}</td>
                            
                    
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




@endsection 

