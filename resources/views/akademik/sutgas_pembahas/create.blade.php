@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Buat Surat Tugas Pembahas Sempro
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		form{
			width: 90%;
			margin: auto;
		}

		#nim, #nama_mhs{
			/*width: 80%;*/
		}

		#no_surat{
			width: 25%;
		}

		#format_nomor{
			font-size: 16px;
		}

		#btn_group{
			float: right;
			margin-right: 20px;
		}
	</style>
@endsection

@section('judul_header')
	Surat Tugas pembahas Sempro
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Buat Surat Tugas Pembahas Sempro</h3>

               <br><br>
               @if (session('success'))
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-check"></i> Sukses</h4>
                   {{session('success')}}
               </div>
               @php
               Session::forget('success');
               @endphp

               @endif
               @if (session('error'))
               <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-ban"></i>Error</h4>
                   {{session('error')}}
               </div>

               @php
               Session::forget('error');
               @endphp
               @endif
            </div>

            <form action="{{ route('akademik.sutgas-pembahas.store') }}" method="post">
               <div class="box-body">
            		@csrf
            		<div class="form-group">
            			<label for="no_surat">No Surat</label><br>
            			<input type="text" name="no_surat" id="no_surat" value="{{ old('no_surat') }}">
            			<span id="format_nomor">/UN25.1.15/SP/{{ Carbon\Carbon::today()->year }}</span>

                     @error('no_surat')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
            		</div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nim">NIM Mahasiswa</label><br>
                           <select id="nim" name="nim" class="form-control select2">
                              <option value="">-- Pilih NIM --</option>
                              @foreach ($mahasiswa as $item)
                                 <option value="{{ $item->nim }}" {{ ($item->nim == old('nim')? 'selected' : '') }}>
                                    {{ $item->nim }}
                                 </option>
                              @endforeach
                           </select>

                           @error('nim')
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nama_mhs">Nama Mahasiswa</label>
                           <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" readonly="">
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="judul_inggris">Judul Bahasa Inggris Skripsi</label>
                     <textarea name="judul_inggris" id="judul_inggris" class="form-control" rows="3">{{ old('judul_inggris') }}</textarea>

                     @error('judul_inggris')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group" style="width: 40%;">
                     <label for="tanggal">Tanggal-Jam Pelaksanaan</label><br>
                     <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">

                     @error('tanggal')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="tempat">Tempat Pelaksanaan</label><br>

                     <div class="input-group">
                        <div class="input-group-addon">
                           Ruang Kuliah :
                        </div>
                        <input type="text" name="tempat" id="tempat" class="form-control" value="{{ old('tempat') }}">
                     </div>
                     <span><i>Note: Pisahkan nama ruang dengan tanda koma (,) jika ingin memasukkan banyak ruang</i></span>

                     @error('tempat')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

            		<div class="form-group">
            			<label for="id_pembahas1">Pembahas 1</label><br>
            			<select name="id_pembahas1" id="id_pembahas1" class="form-control select2">
            				<option value="">--Pilih Pembahas 1--</option>
            				@foreach ($dosen1 as $item)
            					<option value="{{ $item->no_pegawai }}" {{ ($item->no_pegawai == old('id_pembahas1')? 'selected' : '') }}>
                              {{ $item->nama }}
                           </option>
            				@endforeach
            			</select>

                     @error('id_pembahas1')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
            		</div>

            		<div class="form-group">
            			<label for="id_pembahas2">Pembahas 2</label><br>
            			<select name="id_pembahas2" id="id_pembahas2" class="form-control select2">
            				<option value="">--Pilih Pembahas 2--</option>
            				@foreach ($dosen2 as $item)
            					<option value="{{ $item->no_pegawai }}" {{ ($item->no_pegawai == old('id_pembahas2')? 'selected' : '') }}>
                              {{ $item->nama }}
                           </option>
            				@endforeach
            			</select>

                     @error('id_pembahas2')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
            		</div>
               </div>

               <div class="box-footer">
                  <input type="hidden" name="status" value="">
                  <a href="{{ route('akademik.sutgas-pembahas.index') }}" class="btn btn-default">Batal</a> &ensp;

                  <div id="btn_group">
                     {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                     <button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> &ensp;
                     <button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>
                  </div>
               </div>
            </form>

   		</div>
   	</div>
	</div>
@endsection

@section('script')
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script type="text/javascript">
		$('.select2').select2();

      $("button[name='simpan_draf']").click(function(event) {
         event.preventDefault();
         $("input[name='status']").val(1);
         $('form').trigger('submit');
      });

      $("button[name='simpan_kirim']").click(function(event) {
         event.preventDefault();
         $("input[name='status']").val(2);
         $('form').trigger('submit');
      });

      var mahasiswa = @json($mahasiswa);
      var nim_old = @json(old('nim'));
      var dosen1 = @json($dosen1);
      var dosen2 = @json($dosen2);

      if(nim_old != null){
         var nama = "";
         var id_pembimbing1 = 0;
         var id_pembimbing2 = 0;
         var old_id_pembahas1 = @json(old('id_pembahas1'));
         var old_id_pembahas2 = @json(old('id_pembahas2'));

         console.log('ada gan');
         $.each(mahasiswa, function(index, val) {
             if(nim_old == val.nim){
               nama = val.nama;
               // id_pembimbing1 = val.detail_skripsi.id_pembimbing_utama;
               // id_pembimbing2 = val.detail_skripsi.id_pembimbing_pendamping;
               return false;
             }
         });
         $("input[name='nama_mhs']").val(nama);

         var route = "{{ route('akademik.getPembimbing') }}" + "/" + nim_old;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $.ajax({
            url: route,
            type: 'GET',
            // dataType: 'json',
            // data: {'nim': nim},
         })
         .done(function(pembimbing) {
            console.log("success");
            setDosen_old(pembimbing['dosen1'].no_pegawai, pembimbing['dosen2'].no_pegawai, old_id_pembahas1, old_id_pembahas2);
         })
         .fail(function() {
            console.log("error");
         });
      }

		$("select[name='nim']").change(function(event) {
			var nim = $(this).val();
			var nama = "";
         var id_pembimbing1 = 0;
         var id_pembimbing2 = 0;
			$.each(mahasiswa, function(index, val) {
				 if(nim == val.nim){
				 	nama = val.nama;
               // id_pembimbing1 = val.detail_skripsi.id_pembimbing_utama;
               // id_pembimbing2 = val.detail_skripsi.id_pembimbing_pendamping;
				 	return false;
				 }
			});

			$("input[name='nama_mhs']").val(nama);

         var route = "{{ route('akademik.getPembimbing') }}" + "/" + nim;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $.ajax({
            url: route,
            type: 'GET',
            // dataType: 'json',
            // data: {'nim': nim},
         })
         .done(function(pembimbing) {
            console.log("success");
            // console.log(pembimbing);
            setDosen(pembimbing['dosen1'].no_pegawai, pembimbing['dosen2'].no_pegawai);
         })
         .fail(function() {
            console.log("error");
         });
		});

      function setDosen(id_pembimbing1, id_pembimbing2) {
         $("select[name='id_pembahas1']").find("option:not(:first-child)").remove();
         $("select[name='id_pembahas2']").find("option:not(:first-child)").remove();

         // $.each(dosen, function(index, val) {
         //    if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
         //       $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
         //       $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
         //    }
         // });

         $.each(dosen1, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               // $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
            }
         });

         $.each(dosen2, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               // $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
            }
         });
         
         
      }

      function setDosen_old(id_pembimbing1, id_pembimbing2, old_pembahas1, old_pembahas2) {
         $("select[name='id_pembahas1']").find("option:not(:first-child)").remove();
         $("select[name='id_pembahas2']").find("option:not(:first-child)").remove();

         // $.each(dosen, function(index, val) {
         //    if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
         //       if(val.no_pegawai == old_pembahas1){
         //          $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
         //       }
         //       else{
         //          $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
         //       }

         //       if (val.no_pegawai == old_pembahas2) {
         //          $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
         //       }
         //       else{
         //          $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
         //       }
         //    }
         // });

         $.each(dosen1, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               if(val.no_pegawai == old_pembahas1){
                  $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
               }
               else{
                  $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               }

               // if (val.no_pegawai == old_pembahas2) {
               //    $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
               // }
               // else{
               //    $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               // }
            }
         });

         $.each(dosen2, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               // if(val.no_pegawai == old_pembahas1){
               //    $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
               // }
               // else{
               //    $("select[name='id_pembahas1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               // }

               if (val.no_pegawai == old_pembahas2) {
                  $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
               }
               else{
                  $("select[name='id_pembahas2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               }
            }
         });
         
      }
	</script>
@endsection
