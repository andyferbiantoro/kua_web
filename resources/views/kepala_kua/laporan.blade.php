@extends('layouts.app')

@section('title')
Data Laporan
@endsection


@section('content')

<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
                  <p class="card-title">Data Laporan Bulanan Daftar Jumlah Calon Pengantin</p>
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
                  <div class="col-lg-10">
                    <form action="{{route('laporan')}}" method="GET">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-row">
                            <label>Mulai Tanggal</label>
                            <input type="date" class="form-control" name="from" placeholder="Cari tanggal .." value="{{ old('from') }}">
                          </div>
                        </div>

                        <div class="col-lg-3">
                         <div class="form-row">
                          <label>Sampai Tanggal</label>
                          <input type="date" class="form-control" name="to" placeholder="Cari tanggal .." value="{{ old('to') }}">
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <label></label>
                        <input type="submit" class="btn btn-primary" value="Filter Tanggal">
                      </div>
                    </div> 
                  </form>
                </div>
                <br>
                <div class="col-lg-2"> 
                 <button class="btn btn-success" onclick="print('printPDF')">Cetak PDF</button>
               </div>
               <br><br> 

                <div id="printPDF">
                  @if($from == null && $to == null)
                  <div class="row">
                    <div class="col-lg-12"><p style="color: red" class="text-center">Tanggal Tidak Difilter</p></div>
                  </div><br>
                  @endif
                  @if($from != null && $to != null)
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">Mulai tanggal : {{date("j F Y", strtotime($from))}}</div>
                    <div class="col-lg-3">Sampai tanggal : {{date("j F Y", strtotime($to))}}</div>
                    <div class="col-lg-3"></div>
                  </div><br><br>
                  @endif
                
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table  class="table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Tanggal Penyuluhan</th>
                              <th>Nama Calon Suami</th>
                              <th>NIK Calon Suami</th>
                              <th>Nama Calon Istri</th>
                              <th>NIK Calon Istri</th>
                              <th>Alamat Calon Suami</th>
                              <th>Alamat Calon Istri</th>
                              <th>Status Terlaksana</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                             @php $no=1 @endphp
                              @foreach($laporan as $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->tanggal}}</td>
                              <td>{{$data->nama_calon_suami}}</td>
                              <td>{{$data->nik_calon_suami}}</td>
                              <td>{{$data->nama_calon_istri}}</td>
                              <td>{{$data->nik_calon_istri}}</td>
                              <td>{{$data->alamat_calon_suami}}</td>
                              <td>{{$data->alamat_calon_istri}}</td>
                              @if($data->status == 0)
                                <td>Belum Terlaksana</td>
                              @endif

                              @if($data->status == 1)
                                <td>Sudah Terlaksana</td>
                              @endif
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                      <br><br>
                      <div class="col-6">
                      <table class="table table-hover">
                        <tr>
                          <th>Jumlah Calon Pengantin yang daftar</th>
                          <th>:</th>
                          <td>{{$jml_daftar}} Orang</td>
                        </tr> 

                        <tr>
                          <th>Jumlah Terlaksana</th>
                          <th>:</th>
                          <td>{{$jml_terlaksana}} Orang</td>
                        </tr> 

                        <tr>
                          <th>Jumlah Tidak Terlakasana</th>
                          <th>:</th>
                          <td>{{$jml_tdk_terlaksana}} Orang</td>
                        </tr> 
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



@endsection 


@section('scripts')

<script type="text/javascript">
    function print(elem) {
        var mywindow = window.open('', 'PRINT', 'height=1000,width=1200');

        mywindow.document.write('<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">');
        mywindow.document.write('</head><body>');
        mywindow.document.write('<h1 class="text-center">' + 'Laporan' + '</h1>');
        mywindow.document.write('<br><br>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    // mywindow.close();

    return true;

}
</script>



@endsection

