@extends('layouts.app')

@section('title')
Sertifikat Calon Suami
@endsection


@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Sertifikat Calon Suami</p>
            @foreach($sertifikat as $data)
           <!--  <a href="{{route('cetak_sertifikat_suami',$data->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download fa-sm text-white-50"></i> Download PDF</a> -->

            
        <div class="row">
          <div class="col-12">

            <img src="../public/uploads/logo_kua/logo_kua.jpg" style="width: 70px; height: auto; margin-left: 46%; position: relative;"></p>
            <br>
            <p><h2 style="text-align: center;">SERTIFIKAT</h2></p>
            <p><h5 style="text-align: center;">Nomor : {{$data->nomor}}/Kua.13.30.14/Pw.00/XII/2021</h5></p>
            <br>

            <p style="text-align: center;">Diberikan Kepada : </p>
            <p><h2 style="text-align: center;">{{$data->nama_calon_suami}}</h2></p>
            <br>

            <div class="row">
              <div class="col-md-4">
                <p>Tempat/Tanggal Lahir</p>

              </div>
              <div class="col-md-1">:</div>
              <div class="col-md-4">
                {{$data->ttl_calon_suami}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <p>Nomor Induk Kependudukan (NIK)</p>

              </div>
              <div class="col-md-1">:</div>
              <div class="col-md-4">
                {{$data->nik_calon_suami}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <p>Alamat</p>

              </div>
              <div class="col-md-1">:</div>
              <div class="col-md-4">
                {{$data->alamat_calon_suami}}
              </div>
            </div>

             <div class="row">
              <div class="col-md-12">
                <p>Telah mengikuti Bimbingan Perkawinan Pranikah Bagi Calon Pengantin Angkatan XXIX yang diselenggarakan Oleh </p>
                <p>KUA Kecamatan Srono Kabupaten Banyuwangi pada Tanggal {{date("j F Y", strtotime($data->tanggal_awal))}} s/d {{date("j F Y", strtotime($data->tanggal_akhir))}} DI Balai Nikah KUA Srono</p>

              </div>
            
            </div><br>

            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-1">
                <img src="{{asset('uploads/foto_calon_suami/'.$data->foto_calon_suami)}}" style="width: 120px; height: auto; margin-left: 25%; position: relative;">
                
              </div>
              <div class="col-md-2"></div>
              <div class="col-md-4">
                Banyuwangi, {{date("j F Y", strtotime($data->tanggal_terbit))}}<br>
                Kepala KUA Kecamatan Srono<br><br><br><br>
                {{$data->nama_kepala_kua}}<br>
                NIP. {{$data->nip}}<br>
              </div>
              <div class="col-md-1"></div>
              
            </div>

            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Materi Bimbingan</p>
           
              <table style="width:100%" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="text-align: center; vertical-align: middle;">No</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Materi</th>

                  </tr>
                </thead>
                <tbody>
                  @php $no=1 @endphp
                  @foreach($materi as $data)
                  <tr>
                    <td style="text-align: center;">{{$no++ }}</td>
                    <td style="text-align: center;">{{$data->nama_materi }}</td>
                    
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





@endsection 

