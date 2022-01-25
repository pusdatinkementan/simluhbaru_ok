<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhTHLAPBDModel;

class PenyuluhTHLAPBD extends BaseController
{
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new PenyuluhTHLAPBDModel();
    }

    public function penyuluhthlAPBD()
    {

        // $get_param = $this->request->getGet();

        // $kode_kab = $get_param['kode_kab'];
        $penyuluh_model = new PenyuluhTHLAPBDModel();
        $thlapbd_data = $penyuluh_model->getPenyuluhTHLAPBDTotal(session()->get('kodebapel'));
        $namaprop = $penyuluh_model->getPropvinsi();
        $tingkatpen = $penyuluh_model->getTingkat();
        $status = $penyuluh_model->getStatus();
        $tugas = $penyuluh_model->getTugas(session()->get('kodebapel'));
        $bpp = $penyuluh_model->getBpp(session()->get('kodebapel'));
        $unitkerja = $penyuluh_model->getUnitKerja(session()->get('kodebapel'));

        $data = [
            'jml_data' => $thlapbd_data['jum'],
            'nama_kabupaten' => $thlapbd_data['nama_kab'],
            'tabel_data' => $thlapbd_data['table_data'],
            'tugas' => $tugas,
            'unitkerja' => $unitkerja,
            'namaprop' => $namaprop,
            'tingkatpen' => $tingkatpen,
            'bpp' => $bpp,
            'status' => $status,
            'title' => 'Penyuluh THL APBD',
            'name' => 'THL APBD'
        ];

        return view('kab/penyuluh/penyuluhthlAPBD', $data);
    }

    public function showDesa($id_thl)
    {

        $data['q'] = $this->model->getDesa($id_thl);

        foreach ($data['q'] as $dtDesa) {

            echo '<option value="' . $dtDesa['id_desa'] . '">' . $dtDesa['nm_desa'] . '</option>';
        }
    }

    // public function getWilKer($tempat_tugas = null)
    // {
    //     $penyuluh_model = new PenyuluhSwadayaModel();
    //     $tugas = $penyuluh_model->getTugas(session()->get('kodebapel'));
    //     $data = [
    //         'tugas' => $tugas
    //     ];
    //     return json_encode($data);
    // }

    public function editstatus($id)
    {
        $thl = $this->model->getDetailEditStatus($id);
        echo $thl;
    }

    public function updatestatus($id)
    {
        //$id = $this->request->getVar('idjab');
        $nama = $this->request->getPost('nama');
        $gelar_blk = $this->request->getPost('gelar_blk');
        $gelar_dpn = $this->request->getPost('gelar_dpn');
        $status = $this->request->getPost('status');
        $tgl_status = $this->request->getPost('tgl_status');
        $ket_status = $this->request->getPost('ket_status');

        $this->model->save([
            'id' => $id,
            'nama' => $nama,
            'gelar_dpn' => $gelar_dpn,
            'gelar_blk' => $gelar_blk,
            'status' => $status,
            'tgl_status' => $tgl_status,
            'ket_status' => $ket_status
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }

    public function save()
    {
        try {
            $res = $this->model->save([
                'id' => $this->request->getPost('id'),
                'jenis_penyuluh' => $this->request->getPost('jenis_penyuluh'),
                'noktp' => $this->request->getPost('noktp'),
                'nama' => $this->request->getPost('nama'),
                'gelar_dpn' => $this->request->getPost('gelar_dpn'),
                'gelar_blk' => $this->request->getPost('gelar_blk'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'bln_lahir' => $this->request->getPost('bln_lahir'),
                'thn_lahir' => $this->request->getPost('thn_lahir'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'status_kel' => $this->request->getPost('status_kel'),
                'agama' => $this->request->getPost('agama'),
                'ahli_tp' => $this->request->getPost('ahli_tp'),
                'detail_tp' => $this->request->getPost('detail_tp'),
                'ahli_nak' => $this->request->getPost('ahli_nak'),
                'detail_nak' => $this->request->getPost('detail_nak'),
                'ahli_bun' => $this->request->getPost('ahli_bun'),
                'detail_bun' => $this->request->getPost('detail_bun'),
                'ahli_hor' => $this->request->getPost('ahli_hor'),
                'detail_hor' => $this->request->getPost('detail_hor'),
                'ahli_lainnya' => $this->request->getPost('ahli_lainnya'),
                'detail_lainnya' => $this->request->getPost('detail_lainnya'),
                'instansi_pembina' => $this->request->getPost('instansi_pembina'),
                'satminkal' => $this->request->getPost('satminkal'),
                'prop_satminkal' => $this->request->getPost('prop_satminkal'),
                'unit_kerja' => $this->request->getPost('unit_kerja'),
                'kode_kab' => $this->request->getPost('kode_kab'),
                'tempat_tugas' => $this->request->getPost('tempat_tugas'),
                'wil_kerja' => $this->request->getPost('wil_kerja'),
                'alamat' => $this->request->getPost('alamat'),
                'dati2' => $this->request->getPost('dati2'),
                'kodepos' => $this->request->getPost('kodepos'),
                'kode_prop' => $this->request->getPost('kode_prop'),
                'telp' => $this->request->getPost('telp'),
                'email' => $this->request->getPost('email'),
                'tgl_update' => $this->request->getPost('tgl_update'),
                'no_peserta' => $this->request->getPost('no_peserta'),
                'angkatan' => $this->request->getPost('angkatan'),
                'penyuluh_di' => $this->request->getPost('penyuluh_di'),
                'kecamatan_tugas' => $this->request->getPost('tempat_tugas'),
                'wil_kerja2' => $this->request->getPost('wil_kerja2'),
                'wil_kerja3' => $this->request->getPost('wil_kerja3'),
                'wil_kerja4' => $this->request->getPost('wil_kerja4'),
                'wil_kerja5' => $this->request->getPost('wil_kerja5'),
                'wil_kerja6' => $this->request->getPost('wil_kerja6'),
                'wil_kerja7' => $this->request->getPost('wil_kerja7'),
                'wil_kerja8' => $this->request->getPost('wil_kerja8'),
                'wil_kerja9' => $this->request->getPost('wil_kerja9'),
                'wil_kerja10' => $this->request->getPost('wil_kerja10'),
                'mapping' => $this->request->getPost('mapping'),
                'sumber_dana' => $this->request->getPost('sumber_dana'),
                'tingkat_pendidikan' => $this->request->getPost('tingkat_pendidikan'),
                'bidang_pendidikan' => $this->request->getPost('bidang_pendidikan'),
                'jurusan' => $this->request->getPost('jurusan'),
                'nama_sekolah' => $this->request->getPost('nama_sekolah')
            ]);

            if ($res == false) {
                $data = [
                    "value" => false,
                    "message" => 'data tidak lengkap'
                ];
            } else {
                $data = [
                    "value" => true
                ];
            }
            return json_encode($data);
        } catch (\Exception $e) {
            $data = [
                "value" => false,
                "message" => $e->getMessage()
            ];
            return json_encode($data);
        }
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penyuluhthlapbd');
    }

    public function edit($id_thl)
    {
        $apbd = $this->model->getDetailEdit($id_thl);
        echo $apbd;
    }

    public function update($id_thl)
    {
        //$id = $this->request->getVar('idjab');
        $id = $this->request->getPost('id');
        $jenis_penyuluh = $this->request->getPost('jenis_penyuluh');
        $noktp = $this->request->getPost('noktp');
        $nama = $this->request->getPost('nama');
        $gelar_dpn = $this->request->getPost('gelar_dpn');
        $gelar_blk = $this->request->getPost('gelar_blk');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $bln_lahir = $this->request->getPost('bln_lahir');
        $thn_lahir = $this->request->getPost('thn_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $status_kel = $this->request->getPost('status_kel');
        $agama = $this->request->getPost('agama');
        $ahli_tp = $this->request->getPost('ahli_tp');
        $detail_tp = $this->request->getPost('detail_tp');
        $ahli_nak = $this->request->getPost('ahli_nak');
        $detail_nak = $this->request->getPost('detail_nak');
        $ahli_bun = $this->request->getPost('ahli_bun');
        $detail_bun = $this->request->getPost('detail_bun');
        $ahli_hor = $this->request->getPost('ahli_hor');
        $detail_hor = $this->request->getPost('detail_hor');
        $ahli_lainnya = $this->request->getPost('ahli_lainnya');
        $detail_lainnya = $this->request->getPost('detail_lainnya');
        $instansi_pembina = $this->request->getPost('instansi_pembina');
        $satminkal = $this->request->getPost('satminkal');
        $prop_satminkal = $this->request->getPost('prop_satminkal');
        $unit_kerja = $this->request->getPost('unit_kerja');
        $kode_kab = $this->request->getPost('kode_kab');
        $tempat_tugas = $this->request->getPost('tempat_tugas');
        $wil_kerja = $this->request->getPost('wil_kerja');
        $alamat = $this->request->getPost('alamat');
        $dati2 = $this->request->getPost('dati2');
        $kodepos = $this->request->getPost('kodepos');
        $kode_prop = $this->request->getPost('kode_prop');
        $telp = $this->request->getPost('telp');
        $email = $this->request->getPost('email');
        $tgl_update = $this->request->getPost('tgl_update');
        $no_peserta = $this->request->getPost('no_peserta');
        $angkatan = $this->request->getPost('angkatan');
        $penyuluh_di = $this->request->getPost('penyuluh_di');
        $kecamatan_tugas = $this->request->getPost('tempat_tugas');
        $wil_kerja2 = $this->request->getPost('wil_kerja2');
        $wil_kerja3 = $this->request->getPost('wil_kerja3');
        $wil_kerja4 = $this->request->getPost('wil_kerja4');
        $wil_kerja5 = $this->request->getPost('wil_kerja5');
        $wil_kerja6 = $this->request->getPost('wil_kerja6');
        $wil_kerja7 = $this->request->getPost('wil_kerja7');
        $wil_kerja8 = $this->request->getPost('wil_kerja8');
        $wil_kerja9 = $this->request->getPost('wil_kerja9');
        $wil_kerja10 = $this->request->getPost('wil_kerja10');
        $mapping = $this->request->getPost('mapping');
        $sumber_dana = $this->request->getPost('sumber_dana');
        $tingkat_pendidikan = $this->request->getPost('tingkat_pendidikan');
        $bidang_pendidikan = $this->request->getPost('bidang_pendidikan');
        $jurusan = $this->request->getPost('jurusan');
        $nama_sekolah = $this->request->getPost('nama_sekolah');

        $this->model->save([
            'id_thl' => $id_thl,
            'id' => $id,
            'jenis_penyuluh' => $jenis_penyuluh,
            'noktp' => $noktp,
            'nama' => $nama,
            'gelar_dpn' => $gelar_dpn,
            'gelar_blk' => $gelar_blk,
            'tgl_lahir' => $tgl_lahir,
            'bln_lahir' => $bln_lahir,
            'thn_lahir' => $thn_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'status_kel' => $status_kel,
            'agama' => $agama,
            'ahli_tp' => $ahli_tp,
            'detail_tp' => $detail_tp,
            'ahli_nak' => $ahli_nak,
            'detail_nak' => $detail_nak,
            'ahli_bun' => $ahli_bun,
            'detail_bun' => $detail_bun,
            'ahli_hor' => $ahli_hor,
            'detail_hor' => $detail_hor,
            'ahli_lainnya' => $ahli_lainnya,
            'detail_lainnya' => $detail_lainnya,
            'instansi_pembina' => $instansi_pembina,
            'satminkal' => $satminkal,
            'prop_satminkal' => $prop_satminkal,
            'unit_kerja' => $unit_kerja,
            'kode_kab' => $kode_kab,
            'tempat_tugas' => $tempat_tugas,
            'wil_kerja' => $wil_kerja,
            'alamat' => $alamat,
            'dati2' => $dati2,
            'kodepos' => $kodepos,
            'kode_prop' => $kode_prop,
            'telp' => $telp,
            'email' => $email,
            'tgl_update' => $tgl_update,
            'no_peserta' => $no_peserta,
            'angkatan' => $angkatan,
            'penyuluh_di' => $penyuluh_di,
            'kecamatan_tugas' => $kecamatan_tugas,
            'wil_kerja2' => $wil_kerja2,
            'wil_kerja3' => $wil_kerja3,
            'wil_kerja4' => $wil_kerja4,
            'wil_kerja5' => $wil_kerja5,
            'wil_kerja6' => $wil_kerja6,
            'wil_kerja7' => $wil_kerja7,
            'wil_kerja8' => $wil_kerja8,
            'wil_kerja9' => $wil_kerja9,
            'wil_kerja10' => $wil_kerja10,
            'mapping' => $mapping,
            'sumber_dana' => $sumber_dana,
            'tingkat_pendidikan' => $tingkat_pendidikan,
            'bidang_pendidikan' => $bidang_pendidikan,
            'jurusan' => $jurusan,
            'nama_sekolah' => $nama_sekolah
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
}
