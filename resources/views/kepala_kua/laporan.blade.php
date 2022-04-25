@extends('layouts.app')

@section('title')
Data Laporan
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Laporan</p>
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
                              <th>NIK Calon Suami</th>
                              <th>NIK Calon Istri</th>
                              <th>Nama Calon Suami</th>
                              <th>Nama Calon Istri</th>
                              <th>Alamat Calon Suami</th>
                              <th>Alamat Calon Istri</th>
                              <th>Sertifikat Suami</th>
                              <th>Sertifikat Istri</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($laporan as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->nik_calon_suami}}</td>
                              <td>{{$data->nik_calon_istri}}</td>
                              <td>{{$data->nama_calon_suami }}</td>
                              <td>{{$data->nama_calon_istri }}</td>
                              <td>{{$data->alamat_calon_istri }}</td>
                              <td>{{$data->alamat_calon_istri }}</td>
                               <td> <a href="{{ route('kepala_kua_lihat_sertifikat_suami',$data->id) }}"><button class="btn btn-success ">Lihat Sertifikat</button></a> </td>
                              <td> <a href="{{ route('kepala_kua_lihat_sertifikat_suami',$data->id) }}"><button class="btn btn-success ">Lihat Sertifikat</button></a> </td>
                    
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

