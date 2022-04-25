<!DOCTYPE html>
<html>

<body>
 <style type="text/css" media="all">
 @include('partials.header');

 table,
 td,
 th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}

.table-no-border tr td th {
  border: none;
}

td {
  height: 50px;
  vertical-align: middle;
  text-align: center;
}
</style>



<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
       

        <div class="row">
          <div class="col-12">

            <img src="../public/uploads/logo_kua/logo_kua.jpg" style="width: 70px; height: auto; margin-left: 46%; position: relative;"></p>
            <br>
            <h2 style="text-align: center;">SERTIFIKAT</h2>
            @foreach($sertifikat as $data)
            <h5 style="text-align: center;">Nomor : {{$data->nomor}}/Kua.13.30.14/Pw.00/XII/2021</h5>
            <br>

            <p style="text-align: center;">Diberikan Kepada : </p>
            <h2 style="text-align: center; text-decoration: underline;">{{$data->nama_calon_istri}}</h2>
            <br>

            
            <a style="margin-left: 10%; position: relative;">Tempat/Tanggal Lahir </a>
            <a style="margin-left: 15%; position: relative">: {{$data->ttl_calon_istri}}</a><br>

            <a style="margin-left: 10%; position: relative;">Nomor Induk Kependudukan(NIK) </a>
            <a style="margin-left: 7%; position: relative">: {{$data->nik_calon_istri}}</a><br>

            <a style="margin-left: 10%; position: relative;">Alamat  </a>
            <a style="margin-left: 24%; position: relative"> : {{$data->alamat_calon_istri}}</a><br><br>
            

            <a style="margin-left: 10%; position: relative;">Telah mengikuti Bimbingan Perkawinan Pranikah Bagi Calon Pengantin Angkatan XXIX yang diselenggarakan Oleh KUA</a><br>

            <a style="margin-left: 10%; position: relative;"> Kecamatan Srono Kabupaten Banyuwangi pada Tanggal {{date("j F Y", strtotime($data->tanggal_awal))}} s/d {{date("j F Y", strtotime($data->tanggal_akhir))}} DI Balai Nikah KUA Srono </a><br><br>

            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                
                <img src="{{asset('uploads/foto_calon_istri/'.$data->foto_calon_istri)}}" style="width: 120px; height: auto; margin-left: 30%; position: absolute;">

              </div>
              
              <div class="col-md-4" style="margin-left: 55%;">
                Banyuwangi, {{date("j F Y", strtotime($data->tanggal_terbit))}}<br>
                Kepala KUA Kecamatan Srono<br><br><br><br><br>
                {{$data->nama_kepala_kua}}<br>
                NIP. {{$data->nip}}<br>
              </div>
            </div>

            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br>




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

</body>
</html>
