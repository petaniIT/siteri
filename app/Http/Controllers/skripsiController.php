<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\skripsi;
use App\mahasiswa;
use App\detail_skripsi;
use App\User;
use App\keris;
use App\status_skripsi;
use Exception;

class skripsiController extends suratTugasController
{
    public function index()
    {
    	$data_skripsi = skripsi::with(['mahasiswa', 'status_skripsi'])->get();

        // dd($data_skripsi);
    	return view('akademik.skripsi.index', ['data_skripsi' => $data_skripsi]);
    }

    //Tdk jadi digunakan
    // public function ubahJudul($id)
    // {
    // 	$skripsi = skripsi::where('id', $id)
    //     ->with(['status_skripsi', 'mahasiswa'])
    //     ->first();
    // 	return view('akademik.skripsi.ubahJudul', ['skripsi' => $skripsi]);

    // }

    //Tdk jadi digunakan
    // public function store_ubahJudul(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'judul' => 'required',
    //         'judul_inggris' => 'required',
    //     ]);
    //     $detail_skripsi = detail_skripsi::where('id_skripsi', $id)->orderBy('created_at', 'desc')->first();
    //     try{
    //         $detail_skripsi->judul = $request->input('judul');
    //         $detail_skripsi->judul_inggris = $request->input('judul_inggris');
    //         $detail_skripsi->save();
    //         return redirect()->route('akademik.data-skripsi.ubah-judul', $id)->with('success', 'Data Berhasil Dirubah');
    //     } catch (Exception $e) {
    //         return redirect()->route('akademik.data-skripsi.ubah-judul', $id)->with('error', $e->getMessage());
    //     }
    // }

    public function ubahJudulPembimbing($id)
    {
        $skripsi = skripsi::where('id', $id)
        ->with(['status_skripsi', 'mahasiswa'])
        ->first();

        $dosen1 = user::where('is_dosen', 1)
        ->whereHas('fungsional', function(Builder $query)
        {
            $query->whereIn('jab_fungsional', [
                'Guru Besar',
                'Lektor Kepala',
                'Lektor'
            ]);
        })->get();
        $dosen2 = user::where('is_dosen', 1)->get();
        $keris = keris::all();
        return view('akademik.skripsi.ubahJudulPembimbing', ['skripsi' => $skripsi, 'dosen1' => $dosen1, 'dosen2' => $dosen2, 'keris' => $keris]);
    }

    public function store_ubahJudulPembimbing(Request $request, $id)
    {
        $this->validate($request, [
            'no_surat' => 'required|unique:surat_tugas,no_surat|unique:sk_skripsi,no_surat_pembimbing|unique:sk_skripsi,no_surat_penguji|unique:sk_sempro,no_surat|',
            'id_keris' => 'required',
            'judul' => 'required',
            'id_pembimbing_utama' => "required",
            'id_pembimbing_pendamping' => "required",
        ]);
        try{
            skripsi::where('id',$id)->update([
                'id_status_skripsi' => 1
            ]);
            $detail_skripsi = detail_skripsi::create([
                'judul' => $request->input('judul'),
                'id_skripsi' => $id,
                'id_keris' => $request->input('id_keris')
            ]);
            $id_baru = $this->store_sutgas(
                $request,
                1,
                $request->status,
                $detail_skripsi->id,
                'id_pembimbing_utama',
                'id_pembimbing_pendamping'
            );
            return redirect()->route('akademik.sutgas-pembimbing.show', $id_baru)->with('success','Surat Tugas Pembimbing Baru Berhasil Di Buat');
        }catch(Exception $e){
            return redirect()->route('akademik.data-skripsi.ubah-judul-pembimbing', $id)->with('error', $e->getMessage());
        }
    }

    public function updateJudul(Request $request, $id)
    {
    	$skripsi = skripsi::where('id', $id)
        ->with(['status_skripsi', 'mahasiswa'])->first();
        $detail_skripsi = detail_skripsi::where('id_skripsi', $id)->orderBy('created_at', 'desc')->first();
        return view('akademik.skripsi.updateJudul', ['skripsi' => $skripsi, 'detail_skripsi' => $detail_skripsi]);
    }

    public function Update_updateJudul(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            // 'judul_inggris' => 'required'
        ]);

        try{
            detail_skripsi::where('id',$id)->update([
                'judul' => $request->input('judul'),
                'judul_inggris' => $request->input('judul_inggris')
            ]);
            return redirect()->route('akademik.data-skripsi.update-judul', $request->input('id_skripsi'))->with('success', 'Data Berhasil Dirubah');
        }catch(Exception $e){
            return redirect()->route('akademik.data-skripsi.update-judul',$request->input('id_skripsi'))->with('error',$e->getMessage());
        }

    }

    public function editStatus($id_skripsi)
    {
        $status_skripsi = status_skripsi::where('status', 'Sudah Sempro')->orWhere('status', 'Sudah Punya Penguji')->get();
        $skripsi = skripsi::where('id', $id_skripsi)->with('mahasiswa')->first();
        return view('akademik.skripsi.editStatus', [
            'skripsi' => $skripsi,
            'status_skripsi' => $status_skripsi
        ]);
    }

    public function updateStatus(Request $request, $id_skripsi)
    {
        $this->validate($request,[
            'id_status_skripsi' => 'required'
        ]);

        skripsi::where('id',$id_skripsi)->update([
                'id_status_skripsi' => $request->input('id_status_skripsi')
        ]);
        return redirect()->route('akademik.data-skripsi.edit-status', $id_skripsi)->with('success', 'Data Berhasil Dirubah');
    }
}
