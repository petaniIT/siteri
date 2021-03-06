@extends('ktu.ktu_view')
@section('page_title')
	Preview Surat
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
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
                  <table class="table table-striped table-bordered">
                     <tr>
                        <td>Tanggal Dibuat</td>   
                        <td>{{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                     </tr>

                     <tr>
                        <td>No Surat</td>
                        <td>{{ $surat_tugas->nomor_surat}}</td>
                     </tr>

                     <tr>
                        <td>Yang Bertugas</td>
                        <td>
                            @foreach ($dosen_tugas as $bertugas)
                           <p>{{ $bertugas->user['nama'] }} - {{ $bertugas->user['no_pegawai'] }}</p>
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
                  </table>    
               </div>
            </div>

            <div  class="box-footer">
               <a href="{{ route('staffpim.index') }}" class="btn btn-default">Kembali</a>
               <a style="margin-left: 3px;" href="{{ route('staffpim.surat.approve', $surat_tugas->id) }}" class="btn btn-primary pull-right"> Setujui </a> 
               <a href="{{ route('staffpim.surat.reject.view', $surat_tugas->id) }}" class="btn btn-danger pull-right"> Tolak </a> 
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