<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\Guest\GuestModel\GuestModel;
use App\Models\KelembagaanPenyuluhan\Kabupaten\FasilitasiBapelModel;
use App\Models\KelembagaanPenyuluhan\Kabupaten\KabupatenModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\DAKModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\FasilitasiBppModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KecamatanModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KlasifikasiModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\PenghargaanModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\PotensiWilayahModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\WilkecModel;
use App\Models\KelembagaanPenyuluhan\Provinsi\ProvModel;
use App\Models\KodeWilayah\KodeWilModel;
use App\Models\LembagaModel;
use App\Models\WilayahModel;
use Exception;


class Cetaklembaga extends BaseController
{
    protected $session;
    protected $modelLembaga;
    protected $modelProv;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('autentikasi');
        $this->modelLembaga = new LembagaModel();
        $this->modelProv = new WilayahModel();
        $this->provmodel = new ProvModel();
        $this->model = new KabupatenModel();
        $this->fmodel = new FasilitasiBapelModel();
        $this->kecmodel = new KecamatanModel();
        $this->wkmodel = new WilkecModel();
        $this->klmodel = new KlasifikasiModel();
        $this->fasmodel = new FasilitasiBppModel();
        $this->awmodel = new PenghargaanModel();
        $this->dakmodel = new DAKModel();
        $this->pwmodel = new PotensiWilayahModel();
		session();

        
    }

    public function index()
    {
		if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        $this->response->setHeader('Content-Type', 'application/pdf');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM reff_fasilitasi_bpp');
        $query->getResultArray();

        $lembagaModel = new LembagaModel();
        $kabModel = new KabupatenModel();
        $wilModel = new KodeWilModel();
        $provModel = new ProvModel();
        $kec_model = new KecamatanModel();
        // if (empty($this->session->get('kodebapel'))) {
        //     return redirect()->to('login');
        // } else {


        if (empty(session()->get('status_user')) || session()->get('status_user') == '99') {
            $kode = session()->get('userid');

            $data = [
                'title' => 'Profil Guest'
            ];
            return view('profil/profilguest', $data);
        } elseif (session()->get('status_user') == '1') {
            $kode = session()->get('kodebakor');
            $dtlembaga = $lembagaModel->getProfil($kode);
            $dtprov = $this->modelProv->getProv();
            $namawil = $wilModel->getNamaWil($kode);
            $pns = $provModel->getTotalPNS($kode);
			$p3k = $provModel->getTotalp3k($kode);
            $bakor_data = $provModel->getProv($kode);
            $pnsprov = $provModel->getPenyuluhPNS($kode);


            // dd($dtlembaga);
            $data = [
                'title' => 'Profil Lembaga',
                'dt' => $dtlembaga,
                'tabel_data' => $bakor_data['table_data'],
                'namaprov' => $namawil['namaprov'],
                'namakab' => $namawil['namakab'],
                'pnsprov' => $pnsprov,
                'jum_pns' => $pns['jum_pns'],
                'datapns' => $pns['datapns'],
				'jum_p3k' => $p3k['jum_p3k'],
                'datap3k' => $p3k['datap3k'],
                'fotoprofil' => $dtlembaga['foto']

            ];
            return view('profil/cetakprofilprov', $data);
        } elseif (session()->get('status_user') == '4') {
        } elseif (session()->get('status_user') == '200') {
            $kode = session()->get('kodebapel');

            $dtlembaga = $lembagaModel->getProfil(session()->get('kodebapel'));
            $penyuluhPNS = $kabModel->getPenyuluhPNS(session()->get('kodebapel'));
            $penyuluhTHL = $kabModel->getPenyuluhTHL(session()->get('kodebapel'));
            $bapel_data = $kabModel->getKabTotal(session()->get('kodebapel'));
            $bapel = $kabModel->getBapel(session()->get('kodebapel'));
            $fasdata = $kabModel->getFas(session()->get('kodebapel'));
            $id_gap = $kabModel->getIdGap(session()->get('kodebapel'));
            $namawil = $wilModel->getNamaWil(session()->get('kodebapel'));
            $pns = $kabModel->getTotalPNS(session()->get('kodebapel'));
            $thl = $kabModel->getTotalTHLAPBN(session()->get('kodebapel'));
            $thl_apbd = $kabModel->getTotalTHLAPBD(session()->get('kodebapel'));
			$p3k = $kabModel->getTotalp3k(session()->get('kodebapel'));
            $data = [
                'title' => 'Profil Lembaga',
                'dt' => $dtlembaga,

                'penyuluhPNS' => $penyuluhPNS,
                'penyuluhTHL' => $penyuluhTHL,
                'namaprov' => $namawil['namaprov'],
                'tabel_data' => $bapel_data['table_data'],
                'bapel' => $bapel['bapel_data'],
                'fasdata' => $fasdata['fasdata'],
                'idgap' => $id_gap['idgap'],
                'fasilitasi' => $query->getResultArray(),
                'fotoprofil' => $dtlembaga['foto'],
                'jum_pns' => $pns['jum_pns'],
                'datapns' => $pns['datapns'],
                'datathl' => $thl['datathl'],
                'jum_thl' => $thl['jum_thl'],
				'jum_p3k' => $p3k['jum_p3k'],
                'datap3k' => $p3k['datap3k'],
                'datathl_apbd' => $thl_apbd['datathl_apbd'],
                'jum_thl_apbd' => $thl_apbd['jum_thl_apbd'],
                'validation' => \Config\Services::validation()

            ];

            return view('profil/cetakprofilkab', $data);
        } elseif (session()->get('status_user') == '300') {
            $kode = session()->get('kodebpp');

            $db = \Config\Database::connect();
            $query = $db->query('SELECT * FROM reff_fasilitasi_bpp');
            $query->getResultArray();

            $query2 = $db->query('SELECT * FROM reff_klasifikasi_bpp');
            $query2->getResultArray();


            $dtlembaga = $lembagaModel->getProfil($kode);
            // $dtprov = $this->modelProv->getProv();
            $wilkec = $lembagaModel->getWIlkec($kode);
            $penyuluh = $lembagaModel->getPenyuluh($kode);
            $klas = $lembagaModel->getKlasifikasi($kode);
            $penyuluhPNS = $lembagaModel->getPenyuluhPNS(session()->get('kodebapel'));
            $penyuluhTHL = $lembagaModel->getPenyuluhTHL(session()->get('kodebapel'));
            $award = $lembagaModel->getAward($kode);
            $dana = $lembagaModel->getDana($kode);
            $fasdata = $lembagaModel->getFas($kode);
            $kec = $lembagaModel->getKec(session()->get('kodebapel'));
            $potensi = $lembagaModel->getPotensiWilayah($kode);
            $idbpp = $lembagaModel->getIdBpp(session()->get('kodebapel'));
            $kode = $wilModel->getKodeWil($kode);

            $jenis_komoditas = $lembagaModel->getJenisKomoditas();
            // $pns = $provModel->getTotalPNS($kode);

            $data = [
                'title' => 'Profil Lembaga',

                // 'prov' => $dtprov,
                'wilkec' => $wilkec['wilkec'],
                'fasdata' => $fasdata['fasdata'],
                'fasilitasi' => $query->getResultArray(),
                'klasifikasi' => $query2->getResultArray(),
                'jenis_komoditas' => $jenis_komoditas,
                'dt' => $dtlembaga,
                'klas' => $klas['klas'],
                'penghargaan' => $award['penghargaan'],
                'penyuluhPNS' => $penyuluhPNS,
                'penyuluhTHL' => $penyuluhTHL,
                'dana' => $dana['dana'],
                'potensi' => $potensi['potensi'],
                'pns_kec' => $penyuluh['pns_kec'],
                'thl_kec' => $penyuluh['thl_kec'],
                'swa_kec' => $penyuluh['swa_kec'],
                'swasta_kec' => $penyuluh['swasta_kec'],
                'idbpp' => $idbpp['idbpp'],
                'p3k_kec' => $penyuluh['p3k_kec'],
                'kec' => $kec,
                'fotoprofil' => $dtlembaga['foto']
                // 'jum_pns' => $pns['jum_pns'],
                // 'datapns' => $pns['datapns']
            ];
            return view('profil/cetakprofilkec', $data);
        }
    }

    public function detailProv($id)
    {
        $provModel = new ProvModel();

        $dataprov = $provModel->getDetailProv($id);
        echo json_encode($dataprov);
    }

    public function updateprov($id_bakor)
    {
		
        $nama_bapel = $this->request->getPost('nama_bapel');
        $dasar_hukum = $this->request->getPost('dasar_hukum');
        $no_peraturan = $this->request->getPost('no_peraturan');
        $tgl_berdiri = $this->request->getPost('tgl_berdiri');
        $bln_berdiri = $this->request->getPost('bln_berdiri');
        $thn_berdiri = $this->request->getPost('thn_berdiri');
        $alamat = $this->request->getPost('alamat');
        $telp_kantor = $this->request->getPost('telp_kantor');
        $email = $this->request->getPost('email');
        $website = $this->request->getPost('website');
        $ketua = $this->request->getPost('ketua');
        $telp_hp = $this->request->getPost('telp_hp');
        $nama_bidang_luh = $this->request->getPost('nama_bidang_luh');
        $nama_kabid = $this->request->getPost('nama_kabid');
        $deskripsi_lembaga_lain = $this->request->getPost('deskripsi_lembaga_lain');
        $hp_kabid = $this->request->getPost('hp_kabid');
        $seksi_luh = $this->request->getPost('seksi_luh');
        $koordinat = $this->request->getPost('koordinat');
        $nama_kasie = $this->request->getPost('nama_kasie');
        $hp_kasie = $this->request->getPost('hp_kasie');
        $eselon3_luh = $this->request->getPost('eselon3_luh');
        $nama_koord_penyuluh = $this->request->getPost('nama_koord_penyuluh');
		$facebook = $this->request->getPost('facebook');
		$twitter = $this->request->getPost('twitter');
		$instagram = $this->request->getPost('instagram');
		//echo $facebook.' - '.$twitter.' - '.$instagram;
		//print_r($_POST);die();
        $this->provmodel->save([
            'id_bakor' => $id_bakor,
            'nama_bapel' => $nama_bapel,
            'dasar_hukum' => $dasar_hukum,
            'no_peraturan' => $no_peraturan,
            'tgl_berdiri' => $tgl_berdiri,
            'bln_berdiri' => $bln_berdiri,
            'thn_berdiri' => $thn_berdiri,
            'telp_kantor' => $telp_kantor,
            'alamat' => $alamat,
            'email' => $email,
            'deskripsi_lembaga_lain' => $deskripsi_lembaga_lain,
            'website' => $website,
            'ketua' => $ketua,
            'telp_hp' => $telp_hp,
            'nama_bidang_luh' => $nama_bidang_luh,
            'nama_kabid' => $nama_kabid,
            'hp_kabid' => $hp_kabid,
            'koordinat' => $koordinat,
            'seksi_luh' => $seksi_luh,
            'nama_kasie' => $nama_kasie,
            'hp_kasie' => $hp_kasie,
            'eselon3_luh' => $eselon3_luh,
            'nama_koord_penyuluh' => $nama_koord_penyuluh,
			'instagram' => $instagram,
			'twitter' => $twitter,
			'facebook' => $facebook
			
        ]);
		//$db = Database::connect();
		//echo $db->getLastQuery();die();
	
        return redirect()->to('/lembaga');
    }

    public function detailKab($id)
    {
        $kabModel = new KabupatenModel();

        $dataKab = $kabModel->getDetailKab($id);
        echo json_encode($dataKab);
    }

    public function fasilitas($id)
    {
        $kabModel = new KabupatenModel();

        $dataFas = $kabModel->getFasilitasi($id);
        echo json_encode($dataFas);
    }

    public function update($id_gapoktan)
    {
        $nama_bapel = $this->request->getPost('nama_bapel');
        $dasar_hukum = $this->request->getPost('dasar_hukum');
        $no_peraturan = $this->request->getPost('no_peraturan');
        $tgl_berdiri = $this->request->getPost('tgl_berdiri');
        $bln_berdiri = $this->request->getPost('bln_berdiri');
        $thn_berdiri = $this->request->getPost('thn_berdiri');
        $alamat = $this->request->getPost('alamat');
        $telp_kantor = $this->request->getPost('telp_kantor');
        $email = $this->request->getPost('email');
        $website = $this->request->getPost('website');
        $ketua = $this->request->getPost('ketua');
        $telp_hp = $this->request->getPost('telp_hp');
        $telp_hp_koord = $this->request->getPost('telp_hp_koord');
        $email_koord = $this->request->getPost('email_koord');
        $deskripsi_lembaga_lain = $this->request->getPost('deskripsi_lembaga_lain');
        $jenis_pertanian = $this->request->getPost('jenis_pertanian');
        $jenis_tp = $this->request->getPost('jenis_tp');
        $jenis_hor = $this->request->getPost('jenis_hor');
        $jenis_bun = $this->request->getPost('jenis_bun');
        $jenis_nak = $this->request->getPost('jenis_nak');
        $jenis_pkh = $this->request->getPost('jenis_pkh');
        $jenis_ketahanan_pangan = $this->request->getPost('jenis_ketahanan_pangan');
        $jenis_pangan = $this->request->getPost('jenis_pangan');
        $bidang_luh = $this->request->getPost('bidang_luh');
        $nama_kabid = $this->request->getPost('nama_kabid');
        $hp_kabid = $this->request->getPost('hp_kabid');
        $seksi_luh = $this->request->getPost('seksi_luh');
        $nama_kasie = $this->request->getPost('nama_kasie');
        $hp_kasie = $this->request->getPost('hp_kasie');
        $uptd_luh = $this->request->getPost('uptd_luh');
        $nama_kauptd = $this->request->getPost('nama_kauptd');
        $koord = $this->request->getPost('koord');
        $hp_kauptd = $this->request->getPost('hp_kauptd');
        $nama_koord_penyuluh = $this->request->getPost('nama_koord_penyuluh');
        $nama_koord_penyuluh_thl = $this->request->getPost('nama_koord_penyuluh_thl');
        $koord_lainya_nip = $this->request->getPost('koord_lainya_nip');
        $koord_lainya_nama = $this->request->getPost('koord_lainya_nama');
        $kode_koord_penyuluh = $this->request->getPost('kode_koord_penyuluh');
		$facebook = $this->request->getPost('facebook');
		$twitter = $this->request->getPost('twitter');
		$instagram = $this->request->getPost('instagram');
        $this->model->save([
            'id_gapoktan' => $id_gapoktan,
            'nama_bapel' => $nama_bapel,
            'dasar_hukum' => $dasar_hukum,
            'no_peraturan' => $no_peraturan,
            'tgl_berdiri' => $tgl_berdiri,
            'bln_berdiri' => $bln_berdiri,
            'thn_berdiri' => $thn_berdiri,
            'telp_kantor' => $telp_kantor,
            'alamat' => $alamat,
            'email' => $email,
            'website' => $website,
            'ketua' => $ketua,
            'telp_hp' => $telp_hp,
            'telp_hp_koord' => $telp_hp_koord,
            'email_koord' => $email_koord,
            'deskripsi_lembaga_lain' => $deskripsi_lembaga_lain,
            'jenis_pertanian' => $jenis_pertanian,
            'jenis_tp' => $jenis_tp,
            'jenis_hor' => $jenis_hor,
            'jenis_bun' => $jenis_bun,
            'jenis_nak' => $jenis_nak,
            'jenis_pkh' => $jenis_pkh,
            'jenis_ketahanan_pangan' => $jenis_ketahanan_pangan,
            'jenis_pangan' => $jenis_pangan,
            'bidang_luh' => $bidang_luh,
            'nama_kabid' => $nama_kabid,
            'hp_kabid' => $hp_kabid,
            'seksi_luh' => $seksi_luh,
            'nama_kasie' => $nama_kasie,
            'hp_kasie' => $hp_kasie,
            'uptd_luh' => $uptd_luh,
            'nama_kauptd' => $nama_kauptd,
            'hp_kauptd' => $hp_kauptd,
            'koord' => $koord,
            'nama_koord_penyuluh' => $nama_koord_penyuluh,
            'nama_koord_penyuluh_thl' => $nama_koord_penyuluh_thl,
            'koord_lainya_nip' => $koord_lainya_nip,
            'koord_lainya_nama' => $koord_lainya_nama,
            'kode_koord_penyuluh' => $kode_koord_penyuluh,
			'instagram' => $instagram,
			'twitter' => $twitter,
			'facebook' => $facebook
        ]);

        return redirect()->to('/lembaga');
    }
    public function updatekec($id)
    {

        $this->kecmodel->save([
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
            'luas_lahan_petani' => $this->request->getVar('luas_lahan_petani'),
			'instagram' => $this->request->getVar('instagram'),
			'twitter' => $this->request->getVar('twitter'),
			'facebook' => $this->request->getVar('facebook')
        ]);


        //session()->setFlashdata('pesan', 'Edit data berhasil.');

        return redirect()->to('/lembaga');
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

        $this->kecmodel->save([
            'id' => $id,
            'foto' => $namaSampul,
            'foto_depan' => $namaSampul2,
            'foto_belakang' => $namaSampul3,
            'foto_samping' => $namaSampul4,
            'foto_dalam' => $namaSampul5,
            'kode_prop' => $this->request->getVar('kode_prop'),
            'satminkal' => $this->request->getVar('satminkal'),
            'kode_bp3k' => $this->request->getVar('kode_bp3k'),
            'urut' => $this->request->getVar('urut')

        ]);


        //session()->setFlashdata('pesan', 'Edit data berhasil.');

        return redirect()->to('/lembaga');
        // dd($this->request->getVar());
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

        return redirect()->to('/lembaga');
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

        //return redirect()->to('/lembaga');
    }

    public function delete_klas($id)
    {
        $this->klmodel->delete($id);
        //return redirect()->to('/kecamatan');
    }

    public function fasilitasi($id)
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

        //return redirect()->to('/lembaga');
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

        //return redirect()->to('/lembaga');
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

        //return redirect()->to('/lembaga');
    }

    public function delete_powil($id_potensi)
    {
        $this->pwmodel->delete($id_potensi);
        //return redirect()->to('/kecamatan');
    }

    public function save()
    {
        try {
            $res = $this->fmodel->save([
                'id_bapel' => $this->request->getPost('id_bapel'),
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

    public function updatefas($id)
    {
        $id_bapel = $this->request->getPost('id_bapel');
        $tahun = $this->request->getPost('tahun');
        $fasilitasi = $this->request->getPost('fasilitasi');
        $kegiatan = $this->request->getPost('kegiatan');
        $this->fmodel->save([
            'id' => $id,
            'id_bapel' => $id_bapel,
            'fasilitasi' => $fasilitasi,
            'tahun' => $tahun,
            'kegiatan' => $kegiatan
        ]);

        return redirect()->to('/lembaga');
    }

    public function delete($id)
    {
        $this->fmodel->delete($id);
        return redirect()->to('/lembaga');
    }

    function editFoto()
    {

        $data = [

            'title' => 'Ganti Foto',
            'validation' => \Config\Services::validation()
        ];

        return view('profil/changefoto', $data);
    }

    function saveProfil()
    {
        if (!$this->validate([
            // 'nameTxt' => 'required|min_length[10]'
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    // 'uploaded' => 'pilih gambar dulu',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'bukan gambar',
                    'mime_in' => 'bukan gambar',
                ]
            ]
        ])) {

            return redirect()->to('/profil/lembaga/')->withInput();
        }

        //ambil file
        $foto =  $this->request->getFile('foto');

        if ($foto->getError() == 4) {
            $namafoto = 'logo.png';
        } else {
            //penamaan file 
            $namafoto = $foto->getRandomName();
            //pindahkan file
            $foto->move('assets/img', $namafoto);
        }


        //simpan ke database
        $data = [
            'foto' => $namafoto
        ];

        //dd($data);

        $this->modelLembaga->saveProfil($data);

        return redirect()->to('/profil/lembaga/');
    }
}
