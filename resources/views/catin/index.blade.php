@extends('layouts.app')

@section('title')
Calon Pengantin Jadwal Pra-Nikah
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
