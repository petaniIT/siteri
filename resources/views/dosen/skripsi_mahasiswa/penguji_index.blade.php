@extends('layouts.template')

@section('side_menu')
   @include('include.dosen_menu')
@endsection

@section('page_title')
	Penguji Sidang Skripsi
@endsection

@section('judul_header')
	Penguji Sidang Skripsi
@endsection

@section('content')
	<div class="row">
		<div class="col col-xs-12">
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              	<li class="active"><a href="#tab_1" data-toggle="tab">Penguji Utama</a></li>
              	<li><a href="#tab_2" data-toggle="tab">Penguji Pendamping</a></li>
              	
            </ul>
            <div class="tab-content">
            	<div class="tab-pane active" id="tab_1">
            		<p>Daftar Mahasiswa yang Anda Uji Sidang Skripsi Sebagai Penguji Utama</p>

               	<table id="tabel_1" class="table table-bordered table-hovered">
               		<thead>
	               		<tr>
	               		   <th>No</th>
	               			<th>NIM</th>
	               			<th>Nama</th>
	               			<th>Prodi</th>
	               			<th>Tanggal Skripsi</th>
                           <th>Pelaksanan</th>
	               			<th>Opsi</th>
	               		</tr>
	               	</thead>
               		<tbody>
            				@foreach ($sutgas_penguji_1 as $item)
               				<tr>
                              <td>{{ $loop->index+1 }}</td>
                              <td>{{ $item->detail_skripsi->skripsi->nim }}</td>
                              <td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
                              <td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>{{ Carbon\Carbon::parse($item->tanggal)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                              <td>
                                 @if (Carbon\Carbon::parse($item->tanggal)->gte(Carbon\Carbon::today()))
                                    Belum Dilaksanakan
                                 @else
                                    Selesai Dilaksanakan
                                 @endif
                              </td>
	   			      			<td>
	   			      				<a href="{{ route('dosen.penguji-skripsi.show', $item->detail_skripsi->skripsi->nim) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
	   			      			</td>
               				</tr>
            				@endforeach
               		</tbody>
               	</table> 
              	</div>
              	<!-- /.tab-pane -->
              	<div class="tab-pane" id="tab_2">
              		<p>Daftar Mahasiswa yang Anda Uji Sidang Skripsi Sebagai Penguji Pendamping</p>
               	<table id="tabel_2" class="table table-bordered table-hovered">
               		<thead>
	               		<tr>
	               			<th>No</th>
	               			<th>NIM</th>
	               			<th>Nama</th>
	               			<th>Prodi</th>
	               			<th>Tanggal Sempro</th>
                           <th>Pelaksanan</th>
	               			<th>Opsi</th>
	               		</tr>
	               	</thead>
            				@foreach ($sutgas_penguji_2 as $item)
               				<tr>
               					<td>{{ $loop->index+1 }}</td>
               					<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
               					<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>{{ Carbon::parse($item->tanggal)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                              <td>
                                 @if (Carbon\Carbon::parse($item->tanggal)->gte(Carbon\Carbon::today()))
                                    Belum Dilaksanakan
                                 @else
                                    Selesai Dilaksanakan
                                 @endif
                              </td>
	   			      			<td>
	   			      				<a href="{{ route('dosen.penguji-skripsi.show', $item->detail_skripsi->skripsi->nim) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
	   			      			</td>
               				</tr>
            				@endforeach
               		</tbody>
               	</table> 
              	</div>
              	<!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$('#tabel_1').DataTable({})
		$('#tabel_2').DataTable({})
	</script>
@endsection