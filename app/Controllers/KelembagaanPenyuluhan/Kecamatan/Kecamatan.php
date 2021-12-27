<?php

namespace App\Controllers\KelembagaanPenyuluhan\Kecamatan;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Kecamatan\DAKModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\FasilitasiBppModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KecamatanModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KlasifikasiModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\PenghargaanModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\PotensiWilayahModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\WilkecModel;
use App\Models\KodeWilayah\KodeWilModel;
use Exception;

class Kecamatan extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->model = new KecamatanModel();
        $this->wkmodel = new WilkecModel();
        $this->klmodel = new KlasifikasiModel();
        $this->fasmodel = new FasilitasiBppModel();
        $this->awmodel = new PenghargaanModel();
        $this->dakmodel = new DAKModel();
        $this->pwmodel = new PotensiWilayahModel();
    }

    public function kecamatan()
    {

        $kec_model = new KecamatanModel;
        $kode_model = new KodeWilModel();

        // $kode_prop = substr(session()->get('kodebapel'), 0, 2);
        $kec_data = $kec_model->getKecTotal($this->session->get('kodebapel'));
        $penyuluhPNS = $kec_model->getPenyuluhPNS(session()->get('kodebapel'));
        $penyuluhTHL = $kec_model->getPenyuluhTHL(session()->get('kodebapel'));
        $kec = $kec_model->getKec(session()->get('kodebapel'));
        $kode = $kode_model->getKodeWil(session()->get('kodebapel'));
        $no_urut = $kec_model->getNoUrut(session()->get('kodebapel'));

        $data = [
            //'jumpns' => $kec_data['jumpns'],
            'nama_kabupaten' => $kec_data['nama_kab'],
            'tabel_data' => $kec_data['table_data'],
            'penyuluhPNS' => $penyuluhPNS,
            'penyuluhTHL' => $penyuluhTHL,
            'title' => 'Kecamatan',
            'name' => 'Kecamatan',
            'urut' => $no_urut['no_urut'],
            'kode_prop' => $kode['kode_prop'],
            'kode_kab' => $kode['kode_kab'],
            'kec' => $kec,
            'validation' => \Config\Services::validation()
        ];
        return view('KelembagaanPenyuluhan/Kecamatan/kecamatan', $data);
    }

    public function profilkec()
    {
        $wilModel = new KodeWilModel();
        $kec_model = new KecamatanModel;

        // $kode_kab = session()->get('kodebapel');
        // 

        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM reff_fasilitasi_bpp');
        $query->getResultArray();

        $query2 = $db->query('SELECT * FROM reff_klasifikasi_bpp');
        $query2->getResultArray();

        $get_param = $this->request->getGet();
        $kode_kec = $get_param['kode_kec'];
        $kode_bpp = $get_param['kodebpp'];
        $kode_bp3k = $get_param['kode_bp3k'];

        $profilkec = $kec_model->getProfilKec($kode_kec, $kode_bpp);
        $wilkec = $kec_model->getWIlkec($kode_kec, $kode_bp3k);
        $namawil = $wilModel->getNamaWil(session()->get('kodebapel'));
        $penyuluhPNS = $kec_model->getPenyuluhPNS(session()->get('kodebapel'));
        $penyuluhTHL = $kec_model->getPenyuluhTHL(session()->get('kodebapel'));
        $kec = $kec_model->getKec(session()->get('kodebapel'));
        $fasdata = $kec_model->getFas($kode_kec, $kode_bpp);
        $kode = $wilModel->getKodeWil(session()->get('kodebapel'));
        $idbpp = $kec_model->getIdBpp(session()->get('kodebapel'));
        $klas = $kec_model->getKlasifikasi($kode_kec, $kode_bpp);
        $award = $kec_model->getAward($kode_kec, $kode_bp3k);
        $dana = $kec_model->getDana($kode_kec, $kode_bpp);
        $potensi = $kec_model->getPotensiWilayah($kode_kec, $kode_bpp);
        $jenis_komoditas = $kec_model->getJenisKomoditas();
        $penyuluh = $kec_model->getPenyuluh($kode_kec);
        $bp = $kec_model->getBP3K($kode_kec);

        $data = [
            'title' => 'Profil BPP',
            'bp' => $bp['kode_bp3k'],
            'dt' => $profilkec,
            'wilkec' => $wilkec['wilkec'],
            'fasilitasi' => $query->getResultArray(),
            'klasifikasi' => $query2->getResultArray(),
            'namaprov' => $namawil['namaprov'],
            'namakab' => $namawil['namakab'],
            'fasdata' => $fasdata['fasdata'],
            'penyuluhPNS' => $penyuluhPNS,
            'penyuluhTHL' => $penyuluhTHL,
            'jenis_komoditas' => $jenis_komoditas,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode['kode_prop'],
            'kode_kab' => $kode['kode_kab'],
            'idbpp' => $idbpp['idbpp'],
            'klas' => $klas['klas'],
            'penghargaan' => $award['penghargaan'],
            'dana' => $dana['dana'],
            'potensi' => $potensi['potensi'],
            'pns_kec' => $penyuluh['pns_kec'],
            'thl_kec' => $penyuluh['thl_kec'],
            'swa_kec' => $penyuluh['swa_kec'],
            'p3k_kec' => $penyuluh['p3k_kec'],
            'swasta_kec' => $penyuluh['swasta_kec'],
            'kec' => $kec
        ];
        return view('KelembagaanPenyuluhan/Kecamatan/detail_kecamatan', $data);
    }

    public function save()
    {
        $this->model->save([
            'kode_prop' => $this->request->getVar('kode_prop'),
            'satminkal' => $this->request->getVar('satminkal'),
            'bentuk_lembaga' => $this->request->getVar('bentuk_lembaga'),
            'nama_bpp' => $this->request->getVar('nama_bpp'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'alamat' => $this->request->getVar('alamat'),
            'tgl_berdiri' => $this->request->getVar('tgl_berdiri'),
            'bln_berdiri' => $this->request->getVar('bln_berdiri'),
            'thn_berdiri' => $this->request->getVar('thn_berdiri'),
            'status_gedung' => $this->request->getVar('status_gedung'),
            'kondisi_bangunan' => $this->request->getVar('kondisi_bangunan'),
            'koordinat_lokasi_bpp' => $this->request->getVar('koordinat_lokasi_bpp'),
            'telp_bpp' => $this->request->getVar('telp_bpp'),
            'telp_hp' => $this->request->getVar('telp_hp'),
            'email' => $this->request->getVar('email'),
            'website' => $this->request->getVar('website'),
            'ketua' => $this->request->getVar('ketua'),
            'kode_bp3k' => $this->request->getVar('kode_bp3k'),
            'urut' => $this->request->getVar('urut'),
            'kode_koord_penyuluh' => $this->request->getVar('kode_koord_penyuluh'),
            'nama_koord_penyuluh' => $this->request->getVar('nama_koord_penyuluh'),
            'nama_koord_penyuluh_thl' => $this->request->getVar('nama_koord_penyuluh_thl'),
            'koord_lainya_nip' => $this->request->getVar('koord_lainya_nip'),
'koord_lainya_nama' => $this->request->getVar('koord_lainya_nama'),
            'roda_4_apbn' => $this->request->getVar('roda_4_apbn'),
            'roda_4_apbd' => $this->request->getVar('roda_4_apbd'),
            'roda_2_apbn' => $this->request->getVar('roda_2_apbn'),
            'roda_2_apbd' => $this->request->getVar('roda_2_apbd'),
            'pc_apbn' => $this->request->getVar('pc_apbn'),
            'pc_apbd' => $this->request->getVar('pc_apbd'),
            'laptop_apbn' => $this->request->getVar('laptop_apbn'),
            'laptop_apbd' => $this->request->getVar('laptop_apbd'),
            'printer_apbn' => $this->request->getVar('printer_apbn'),
            'printer_apbd' => $this->request->getVar('printer_apbd'),
            'modem_apbn' => $this->request->getVar('modem_apbn'),
            'modem_apbd' => $this->request->getVar('modem_apbd'),
            'lcd_apbn' => $this->request->getVar('lcd_apbn'),
            'lcd_apbd' => $this->request->getVar('lcd_apbd'),
            'soil_apbn' => $this->request->getVar('soil_apbn'),
            'soil_apbd' => $this->request->getVar('soil_apbd'),
            'kios_saprotan' => $this->request->getVar('kios_saprotan'),
            'pedagang_pengepul' => $this->request->getVar('pedagang_pengepul'),
            'gudang_pangan' => $this->request->getVar('gudang_pangan'),
            'perbankan' => $this->request->getVar('perbankan'),
            'industri_penyuluhan' => $this->request->getVar('industri_penyuluhan'),
            'luas_lahan_bp3k' => $this->request->getVar('luas_lahan_bp3k'),
            'luas_lahan_petani' => $this->request->getVar('luas_lahan_petani')
        ]);


        return redirect()->to('/kecamatan');
    }

    public function update($id)
    {

        $this->model->save([
            'id' => $id,
            'kode_prop' => $this->request->getVar('kode_prop'),
            'satminkal' => $this->request->getVar('satminkal'),
            'bentuk_lembaga' => $this->request->getVar('bentuk_lembaga'),
            'nama_bpp' => $this->request->getVar('nama_bpp'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'alamat' => $this->request->getVar('alamat'),
            'tgl_berdiri' => $this->request->getVar('tgl_berdiri'),
            'bln_berdiri' => $this->request->getVar('bln_berdiri'),
            'thn_berdiri' => $this->request->getVar('thn_berdiri'),
            'status_gedung' => $this->request->getVar('status_gedung'),
            'kondisi_bangunan' => $this->request->getVar('kondisi_bangunan'),
            'koordinat_lokasi_bpp' => $this->request->getVar('koordinat_lokasi_bpp'),
            'telp_bpp' => $this->request->getVar('telp_bpp'),
            'telp_hp' => $this->request->getVar('telp_hp'),
            'email' => $this->request->getVar('email'),
            'website' => $this->request->getVar('website'),
            'ketua' => $this->request->getVar('ketua'),
            'kode_bp3k' => $this->request->getVar('kode_bp3k'),
            'urut' => $this->request->getVar('urut'),
            'kode_koord_penyuluh' => $this->request->getVar('kode_koord_penyuluh'),
            'nama_koord_penyuluh' => $this->request->getVar('nama_koord_penyuluh'),
            'nama_koord_penyuluh_thl' => $this->request->getVar('nama_koord_penyuluh_thl'),
            'koord_lainya_nip' => $this->request->getVar('koord_lainya_nip'),
'koord_lainya_nama' => $this->request->getVar('koord_lainya_nama'),
            'roda_4_apbn' => $this->request->getVar('roda_4_apbn'),
            'roda_4_apbd' => $this->request->getVar('roda_4_apbd'),
            'roda_2_apbn' => $this->request->getVar('roda_2_apbn'),
            'roda_2_apbd' => $this->request->getVar('roda_2_apbd'),
            'pc_apbn' => $this->request->getVar('pc_apbn'),
            'pc_apbd' => $this->request->getVar('pc_apbd'),
            'laptop_apbn' => $this->request->getVar('laptop_apbn'),
            'laptop_apbd' => $this->request->getVar('laptop_apbd'),
            'printer_apbn' => $this->request->getVar('printer_apbn'),
            'printer_apbd' => $this->request->getVar('printer_apbd'),
            'modem_apbn' => $this->request->getVar('modem_apbn'),
            'modem_apbd' => $this->request->getVar('modem_apbd'),
            'lcd_apbn' => $this->request->getVar('lcd_apbn'),
            'lcd_apbd' => $this->request->getVar('lcd_apbd'),
            'soil_apbn' => $this->request->getVar('soil_apbn'),
            'soil_apbd' => $this->request->getVar('soil_apbd'),
            'kios_saprotan' => $this->request->getVar('kios_saprotan'),
            'pedagang_pengepul' => $this->request->getVar('pedagang_pengepul'),
            'gudang_pangan' => $this->request->getVar('gudang_pangan'),
            'perbankan' => $this->request->getVar('perbankan'),
            'industri_penyuluhan' => $this->request->getVar('industri_penyuluhan'),
            'luas_lahan_bp3k' => $this->request->getVar('luas_lahan_bp3k'),
            'luas_lahan_petani' => $this->request->getVar('luas_lahan_petani')
        ]);


        //session()->setFlashdata('pesan', 'Edit data berhasil.');

        return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getVar('kecamatan'));
        // dd($this->request->getVar());
    }

    public function update_foto($id)
    {
        $fileSampul = $this->request->getFile('foto');
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('fotolama');
        } else {
            $namaSampul = $fileSampul->getName();

            $fileSampul->move('assets/img', $namaSampul);
            try {
                unlink('assets/img/' . $this->request->getVar('fotolama'));
            } catch (Exception $e) {
            }
        }
        $fileSampul2 = $this->request->getFile('foto_depan');
        if ($fileSampul2->getError() == 4) {
            $namaSampul2 = $this->request->getVar('fotolama2');
        } else {
            $namaSampul2 = $fileSampul2->getName();

            $fileSampul2->move('assets/img', $namaSampul2);
            try {
                unlink('assets/img/' . $this->request->getVar('fotolama2'));
            } catch (Exception $e) {
            }
        }
        $fileSampul3 = $this->request->getFile('foto_belakang');
        if ($fileSampul3->getError() == 4) {
            $namaSampul3 = $this->request->getVar('fotolama3');
        } else {
            $namaSampul3 = $fileSampul3->getName();

            $fileSampul3->move('assets/img', $namaSampul3);
            try {
                unlink('assets/img/' . $this->request->getVar('fotolama3'));
            } catch (Exception $e) {
            }
        }
        $fileSampul4 = $this->request->getFile('foto_samping');
        if ($fileSampul4->getError() == 4) {
            $namaSampul4 = $this->request->getVar('fotolama4');
        } else {
            $namaSampul4 = $fileSampul4->getName();

            $fileSampul4->move('assets/img', $namaSampul4);
            try {
                unlink('assets/img/' . $this->request->getVar('fotolama4'));
            } catch (Exception $e) {
            }
        }
        $fileSampul5 = $this->request->getFile('foto_dalam');
        if ($fileSampul5->getError() == 4) {
            $namaSampul5 = $this->request->getVar('fotolama5');
        } else {
            $namaSampul5 = $fileSampul5->getName();

            $fileSampul5->move('assets/img', $namaSampul5);
            try {
                unlink('assets/img/' . $this->request->getVar('fotolama5'));
            } catch (Exception $e) {
            }
        }

        $this->model->save([
            'id' => $id,
            'foto' => $namaSampul,
            'foto_depan' => $namaSampul2,
            'foto_belakang' => $namaSampul3,
            'foto_samping' => $namaSampul4,
            'foto_dalam' => $namaSampul5,
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kode_prop' => $this->request->getVar('kode_prop'),
            'satminkal' => $this->request->getVar('satminkal'),
            'kode_bp3k' => $this->request->getVar('kode_bp3k'),
            'urut' => $this->request->getVar('urut')

        ]);


        //session()->setFlashdata('pesan', 'Edit data berhasil.');

        return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getVar('kecamatan') . '&kodebpp=' . $id);
        // dd($this->request->getVar());
    }

    public function delete($id)
    {
        $dt = $this->model->find($id);
        if ($dt['foto'] != 'logo.png') {
            try {
                unlink('assets/img/' . $dt['foto']);
            } catch (Exception $e) {
            }
        }
        $this->model->delete($id);
        return redirect()->to('/kecamatan');
    }

    public function wilkec($id)
    {
        $kec_model = new KecamatanModel();

        $dataWK = $kec_model->getWK($id);
        echo json_encode($dataWK);
    }

    public function save_wilkec()
    {
        try {
            $res = $this->wkmodel->save([
                'kode_bp3k' => $this->request->getPost('kode_bp3k'),
                'kode_prop' => $this->request->getPost('kode_prop'),
                'satminkal' => $this->request->getPost('satminkal'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'jum_petani' => $this->request->getPost('jum_petani')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function update_wilkec($id)
    {
        $kode_bp3k = $this->request->getPost('kode_bp3k');
        $kode_prop = $this->request->getPost('kode_prop');
        $satminkal = $this->request->getPost('satminkal');
        $kecamatan = $this->request->getPost('kecamatan');
        $jum_petani = $this->request->getPost('jum_petani');
        $this->wkmodel->save([
            'id' => $id,
            'kode_bp3k' => $kode_bp3k,
            'kode_prop' => $kode_prop,
            'satminkal' => $satminkal,
            'kecamatan' => $kecamatan,
            'jum_petani' => $jum_petani
        ]);

        //return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getPost('kecamatan'));
    }

    public function delete_wilkec($id)
    {
        $this->wkmodel->delete($id);
        //return redirect()->to('/kecamatan');
    }

    public function detail_klasifikasi($id)
    {
        $kec_model = new KecamatanModel();

        $dataKlas = $kec_model->getKlas($id);
        echo json_encode($dataKlas);
    }

    public function save_klas()
    {
        try {
            $res = $this->klmodel->save([
                'id_bpp' => $this->request->getPost('id_bpp'),
                'tahun' => $this->request->getPost('tahun'),
                'klasifikasi' => $this->request->getPost('klasifikasi'),
                'skor' => $this->request->getPost('skor')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function update_klas($id)
    {
        $id_bpp = $this->request->getPost('id_bpp');
        $tahun = $this->request->getPost('tahun');
        $klasifikasi = $this->request->getPost('klasifikasi');
        $skor = $this->request->getPost('skor');
        $this->klmodel->save([
            'id' => $id,
            'id_bpp' => $id_bpp,
            'tahun' => $tahun,
            'klasifikasi' => $klasifikasi,
            'skor' => $skor
        ]);

        //return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getPost('kecamatan'));
    }

    public function delete_klas($id)
    {
        $this->klmodel->delete($id);
        //return redirect()->to('/kecamatan');
    }

    public function fasilitas($id)
    {
        $kecModel = new KecamatanModel();

        $dataFas = $kecModel->getFasilitasi($id);
        echo json_encode($dataFas);
    }

    public function save_fas()
    {
        try {
            $res = $this->fasmodel->save([
                'id_bpp' => $this->request->getPost('id_bpp'),
                'fasilitasi' => $this->request->getPost('fasilitasi'),
                'kegiatan' => $this->request->getPost('kegiatan'),
                'tahun' => $this->request->getPost('tahun')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function update_fas($id)
    {
        $id_bpp = $this->request->getPost('id_bpp');
        $tahun = $this->request->getPost('tahun');
        $fasilitasi = $this->request->getPost('fasilitasi');
        $kegiatan = $this->request->getPost('kegiatan');
        $this->fasmodel->save([
            'id' => $id,
            'id_bpp' => $id_bpp,
            'fasilitasi' => $fasilitasi,
            'tahun' => $tahun,
            'kegiatan' => $kegiatan
        ]);
    }

    public function delete_fas($id)
    {
        $this->fasmodel->delete($id);
        //return redirect()->to('/lembaga');
    }

    public function penghargaan($id)
    {
        $kec_model = new KecamatanModel();

        $dataAw = $kec_model->getPenghargaan($id);
        echo json_encode($dataAw);
    }

    public function save_award()
    {
        try {
            $res = $this->awmodel->save([
                'kode_bp3k' => $this->request->getPost('kode_bp3k'),
                'kode_prop' => $this->request->getPost('kode_prop'),
                'satminkal' => $this->request->getPost('satminkal'),
                'nama_penghargaan' => $this->request->getPost('nama_penghargaan'),
                'peringkat' => $this->request->getPost('peringkat'),
                'tingkat' => $this->request->getPost('tingkat'),
                'tahun' => $this->request->getPost('tahun')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function update_award($id)
    {
        $kode_bp3k = $this->request->getPost('kode_bp3k');
        $kode_prop = $this->request->getPost('kode_prop');
        $satminkal = $this->request->getPost('satminkal');
        $nama_penghargaan = $this->request->getPost('nama_penghargaan');
        $peringkat = $this->request->getPost('peringkat');
        $tingkat = $this->request->getPost('tingkat');
        $tahun = $this->request->getPost('tahun');
        $this->awmodel->save([
            'id' => $id,
            'kode_bp3k' => $kode_bp3k,
            'kode_prop' => $kode_prop,
            'satminkal' => $satminkal,
            'nama_penghargaan' => $nama_penghargaan,
            'peringkat' => $peringkat,
            'tingkat' => $tingkat,
            'tahun' => $tahun
        ]);

        //return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getPost('kecamatan'));
    }

    public function delete_award($id)
    {
        $this->awmodel->delete($id);
        //return redirect()->to('/kecamatan');
    }

    public function dana($id)
    {
        $kec_model = new KecamatanModel();

        $dataDak = $kec_model->getDak($id);
        echo json_encode($dataDak);
    }

    public function save_dak()
    {
        try {
            $res = $this->dakmodel->save([
                'id_bpp' => $this->request->getPost('id_bpp'),
                'tahun_dak' => $this->request->getPost('tahun_dak')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function update_dak($id)
    {
        $id_bpp = $this->request->getPost('id_bpp');
        $tahun_dak = $this->request->getPost('tahun_dak');
        $this->dakmodel->save([
            'id' => $id,
            'id_bpp' => $id_bpp,
            'tahun_dak' => $tahun_dak
        ]);

        //return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getPost('kecamatan'));
    }

    public function delete_dak($id)
    {
        $this->dakmodel->delete($id);
        //return redirect()->to('/kecamatan');
    }

    public function powil($id_potensi)
    {
        $kec_model = new KecamatanModel();

        $dataPW = $kec_model->getPowil($id_potensi);
        echo json_encode($dataPW);
    }

    public function save_powil()
    {
        try {
            $res = $this->pwmodel->save([
                'id_bpp' => $this->request->getPost('id_bpp'),
                'kode_komoditas' => $this->request->getPost('kode_komoditas'),
                'luas_lhn' => $this->request->getPost('luas_lhn')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function update_powil($id_potensi)
    {
        $id_bpp = $this->request->getPost('id_bpp');
        $kode_komoditas = $this->request->getPost('kode_komoditas');
        $luas_lhn = $this->request->getPost('luas_lhn');
        $this->pwmodel->save([
            'id_potensi' => $id_potensi,
            'id_bpp' => $id_bpp,
            'kode_komoditas' => $kode_komoditas,
            'luas_lhn' => $luas_lhn
        ]);

        //return redirect()->to('/detail_kecamatan?kode_kec=' . $this->request->getPost('kecamatan'));
    }

    public function delete_powil($id_potensi)
    {
        $this->pwmodel->delete($id_potensi);
        //return redirect()->to('/kecamatan');
    }
}