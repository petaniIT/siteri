@extends('kepegawaian.kepegawaian_view')
@section('page_title')
	Preview Surat
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/surat_tugas_kepegawaian.css') }}">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;: 
      }
	</style>	
@endsection

@section('judul_header')
	Preview Surat Tugas 
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
           <h3 class="box-title">Detail Surat Tugas {{$surat_tugas->jenis_sk->jenis}}</h3>
        </div>

        <div class="box-body">
         	<div class="table-responsive">
         		@if (session()->has('success'))
         		  <div class="alert alert-success alert-block">
         		    <button type="button" class="close" data-dismiss="alert">x</button>
         		      {{ session()->get('success')}}
         		  </div>
         		@endif

            <table class="table table-striped table-bordered">
              <tr>
                <td>No Surat</td>
                <td>{{ $surat_tugas->nomor_surat}}/UN25.1.15/KP/{{ \Carbon\Carbon::parse($surat_tugas->created_at)->year }}</td>
              </tr>

              <tr>
                <td>Yang Bertugas</td>
                <td>
                  @foreach ($dosen_tugas as $bertugas)
                  <p>{{ $bertugas->user['nama'] }} - {{ $bertugas->user['no_pegawai'] }}</p>
                  @endforeach

                  @foreach ($pematerinya as $pematerii)
                  <p>{{ $pematerii->nama}}</p>
                  @endforeach
                </td>
              </tr>
              <tr>
                <td>Tanggal Bertugas</td>
                <td>{{ Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::parse($surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>{{$surat_tugas->keterangan}}</td>
              </tr>

              <tr>
                <td>Status</td>
                <td>{{$surat_tugas->status_sk->status}}</td>
              </tr>

              @if ($surat_tugas->status == 4 || $surat_tugas->status ==6)
              <tr>
              	<td style="color: red;">Pesan Revisi</td>
              	<td>{{ $surat_tugas->revisi }}</td>
              </tr>
              @endif
            </table>

            <a href="{{route('kepegawaian.surat.index') }}" class="btn btn-default">Kembali</a>
            @if ($surat_tugas->surat_in_out == 1)
              @if ($surat_tugas->jenis_surat == 1)
              <a href="{{route('kepegawaian.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning" ><i class="fa fa-print"></i> Cetak</a>
              @elseif($surat_tugas->jenis_surat == 2)
              <a href="{{route('kepegawaian.surat.cetak2', $surat_tugas->id)}}" class="btn btn-warning" ><i class="fa fa-print"></i> Cetak</a>
              @elseif($surat_tugas->jenis_surat == 3)
              <a href="{{route('kepegawaian.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning" ><i class="fa fa-print"></i> Cetak</a>
              @endif
            @endif

            @if ($surat_tugas->surat_in_out == 2)
            <a href="{{route('kepegawaian.surat.cetak3', $surat_tugas->id)}}" class="btn btn-warning" ><i class="fa fa-print"></i> Cetak</a>
            @endif

            @if ($surat_tugas->status < 9)
              <a href="{{route('kepegawaian.surat.edit', $surat_tugas->id)}}" class="btn bg-purple float-right"><i class="fa fa-edit"></i> Ubah</a>
            @endif    
         	</div>
        </div>

        <br>
        <div  class="box-footer">
          @if ($surat_tugas->jenis_surat == 1)
          @include('kepegawaian.surat_tugas.jenis.peserta')
          @elseif ($surat_tugas->jenis_surat == 2)
          @include('kepegawaian.surat_tugas.jenis.panitia')
          @else
          @include('kepegawaian.surat_tugas.jenis.pemateri')
          @endif
        </div>
   		</div>
   	</div>
	</div>
@endsection

@section('script')
   <script type="text/javascript">
      var status = @json($surat_tugas->id_status_surat_tugas);
      for (var i = status; i > 0; i--) {
         // $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
         $("#progres_"+i).addClass('verified');
         $("#progres_"+i).find('i').addClass('fa fa-check');
      }
   </script>
@endsection