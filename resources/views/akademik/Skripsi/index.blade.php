@extends('akademik.akademik_view')

@section('page_title')
	Daftar Semua SK skripsi
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<style type="text/css">
		#success_delete{
			 position: fixed;
			 display: none; 
			 width: 20%; 
			 text-align: center;
			 top: 13%;
			 left: 40%;
			 padding: 15px;
			 background-color: rgba(0, 0, 0, 0.7);
			 color: white;
		}
	</style>
@endsection

@section('judul_header')
	SK Skripsi
@endsection

@section('content')
<p style="color: red;">{{session('error')}}</p>

@php
	Session::forget('error');
@endphp
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Daftar SK Skripsi</h3>
	            
	              <div style="float: right;">
	            	<a href="{{ route('akademik.skripsi.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Buat SK Baru</a>
	              </div>
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="tbl_data1" class="table table-bordered table-hovered">
		            		<thead>
			            		<tr>
			            			<th>No</th>
			            			<th>Tanggal Dibuat</th>
			            			<th>Status</th>
			            			<th>Verifikasi KTU</th>
			            			<th>Verifikasi Dekan</th>
			            			<th>Pilihan</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		@php $no = 0 @endphp
			            		@foreach($sk_akademik as $item)
			            			<tr id="sk_{{$item->id}}">
			            				<td>{{$no+=1}}</td>
			            				<td>
			            					{{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
			            				</td>
			            				<td>{{$item->status_sk_akademik->status}}</td>
			            				<td>
			            					@if($item->verif_ktu == 0) 
			            						<label class="label bg-red">Belum Diverifikasi</label> 
			            					@else 
			            						<label class="label bg-green">Sudah Diverifiaksi</label>
			            					@endif
			            				</td>
			            				<td>
			            					@if($item->verif_dekan == 0) 
			            						<label class="label bg-red">Belum Diverifikasi</label> 
			            					@else 
			            						<label class="label bg-green">Sudah Diverifiaksi</label>
			            					@endif
			            				</td>
			            				<td>
			            					<a href="{{ route('akademik.skripsi.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@if($item->verif_dekan == 0)
			            					<a href="{{ route('akademik.skripsi.edit', $item->id) }}" class="btn btn-warning" title="Ubah SK"><i class="fa fa-edit"></i></a>
			            					@endif
			            					<a href="#" class="btn btn-danger" id="{{ $item->id }}" name="delete_sk" title="Hapus SK" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i></a>
			            				</td>
			            			</tr>
			            		@endforeach
			            	</tbody>
			            </table>
	            	</div>
	            </div>
      		</div>
      	</div>
	</div>

	<div id="success_delete">
        <h4><i class="icon fa fa-check"></i>  <span></span></h4>
    </div>

	<div class="modal modal-danger fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi Penghapusan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data SK ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>           
			<button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Hapus SK</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
	<script type="text/javascript">
		$(function() {
			$('#tbl_data1').DataTable()

			$("a[name='delete_sk']").click(function(event) {
				event.preventDefault();
				var id_sk = $(this).attr('id');
				var url_del = "{{route('akademik.skripsi.destroy')}}" + '/' + id_sk;
				console.log(url_del);
				
				$('div.modal-footer').off().on('click', '#hapusBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: url_del,
						type: 'POST',
						// dataType: '',
						data: {_method: 'DELETE'},
					})
					.done(function(hasil) {
						console.log("success");
						$("tr#sk_"+id_sk).hide();
						$("#success_delete").show();
						$("#success_delete").find('span').html(hasil);
						$("#success_delete").fadeOut(1800);
					})
					.fail(function() {
						console.log("error");
					});
				});
			
			});
		})
	</script>
@endsection