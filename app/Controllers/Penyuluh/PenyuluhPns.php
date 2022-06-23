<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhPNSModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KecamatanModel;
use App\Models\KelembagaanPenyuluhan\Kabupaten\KabupatenModel;

ini_set("memory_limit", "16M");
class PenyuluhPns extends BaseController
{

    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new PenyuluhPNSModel();
        //ini_set('memory_limit', '-1');
        ini_set('memory_limit', '380M');
    }

    public function penyuluhpns()
    {
        if (session()->get('username') == "")
            return redirect()->to('login');
        $penyuluh_model = new PenyuluhPNSModel();
        $prov = $this->request->getPost('filter_prov');
        $kabu = $this->request->getPost('filter_kab');
        $keca = $this->request->getPost('filter_kec');
        $list_prov = [];
        $list_kab = [];
        $list_kec = [];
        $level = "";

        //update rizki
        //kabupaten		
        $opsi = array();
        if (empty(session()->get('status_user')) || session()->get('status_user') == '200') {
            $bapel_model = new KabupatenModel();
            $unitparent = $bapel_model->getBapelresume(session()->get('kodebapel'));
            $opsi['3-' . $unitparent["kabupaten"]] = $unitparent["bapel"];
            $bpp_model = new KecamatanModel();
            $unitchild = $bpp_model->getBppresume(session()->get('kodebapel'));

            foreach ($unitchild as $k => $v)
                $opsi['4-' . $v["kecamatan"]] = $v["nama_bpp"];
        }

        //dd($opsi);

        //end

        if ($keca != "") {
            $kode = $keca;
            $level = "3";
            $list_prov = $penyuluh_model->getProv_Filter($kode);
        } elseif ($kabu != "") {
            $kode = $kabu;
            $level = "2";
            $list_prov = $penyuluh_model->getProv_Filter($kode);
        } elseif ($prov != "") {
            $kode = $prov;
            $level = "1";
            $list_prov = $penyuluh_model->getProv_Filter($kode);
        } else {
            if (empty(session()->get('status_user')) || session()->get('status_user') == '2') {
                $kode = '00';
                $list_prov = $penyuluh_model->getPropvinsi();
                $level = "0";
            } elseif (session()->get('status_user') == '1') {
                $kode = session()->get('kodebakor');
                $level = "1";
                $list_prov = $penyuluh_model->getProv_Filter($kode);
                $list_kab = $penyuluh_model->getKab_Filter($kode);
            } elseif (session()->get('status_user') == '200') {
                $kode = session()->get('kodebapel');
                $level = "2";
                $list_prov = $penyuluh_model->getProv_Filter($kode);
                $list_kab = $penyuluh_model->getKab_Def($kode);
                $list_kec = $penyuluh_model->getKec_Filter($kode);
            } elseif (session()->get('status_user') == '300') {
                $kode = session()->get('kodebpp');
                $level = "3";
                $list_prov = $penyuluh_model->getProv_Filter($kode);
                $list_kab = $penyuluh_model->getKab_Def($kode);
                $list_kec = $penyuluh_model->getKec_Def($kode);
            }
        }

        $jenjangjabatan = $penyuluh_model->getjenjangjabatan();
        $status = $penyuluh_model->getStatus();
        $status_search = $penyuluh_model->getStatus(1);
        $namaprop = $penyuluh_model->getPropvinsi();
        $tingkatpen = $penyuluh_model->getTingkat();
        $tugas = $penyuluh_model->getTugas(session()->get('kodebapel'));
        $bpp = $penyuluh_model->getBpp(session()->get('kodebapel'));
        $unitkerja = $penyuluh_model->getUnitKerja(session()->get('kodebapel'));
        $pendidikan = $penyuluh_model->getPendidikan();
        $keahlian = $penyuluh_model->getKeahlian();

        $data = [
            'level' => $level,
            'opsi' => $opsi,
            'status' => $status,
            'status_search' => $status_search,
            'tugas' => $tugas,
            'unitkerja' => $unitkerja,
            'namaprop' => $namaprop,
            'list_prov' => $list_prov,
            'list_kab' => $list_kab,
            'list_kec' => $list_kec,
            'tingkatpen' => $tingkatpen,
            'bpp' => $bpp,
            'getPostProv' => $prov,
            'jenjang' => $jenjangjabatan,
            'getPostKab' => $kabu,
            'getPostKec' => $keca,
            'pendidikan' => $pendidikan,
            'keahlian' => $keahlian,
            'title' => 'Penyuluh PNS',
            'name' => 'PNS'
        ];
        // var_dump($data);die();

        return view('kab/penyuluh/penyuluhpns', $data);
    }



    public function penyuluh_data()
    {
        //$draw = intval($this->input->get("draw"));
        //$start = intval($this->input->get("start"));
        //$length = intval($this->input->get("length"));
        $penyuluh_model = new PenyuluhPNSModel();
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $kode = session()->get('kodebapel');
        $level = "2";
        $fstatus = $_POST['fstatus'];
        $funit = $_POST['funit'];
        $fjab = $_POST['fjab'];
        $fjenkel = $_POST['fjenkel'];
        $fpend = $_POST['fpend'];
        $fahli = $_POST['fahli'];
        $idx = $start;
        //print_r($idx);die();
        ## Search 
        $search = array();
        if ($fstatus != '')
            $search["status"] = $fstatus;
        if ($fjenkel != '')
            $search["jenkel"] = $fjenkel;
        if ($fjab != '')
            $search["jab"] = $fjab;
        if ($fpend != '')
            $search["pendidikan"] = $fpend;
        if ($fahli != '')
            $search["keahlian"] = $fahli;
        if ($funit != '') {
            $split = explode('-', $funit);
            $search["kode_kab"] = $split[0];
            $search["kode_satker"] = $split[1];
        }

        $no = 0;
        //print_r($search);die();
        $dt = $penyuluh_model->getPenyuluhPNSTotal($kode, $level, $search, $length, $start);
        $list = $dt['table_data'];
        $all = $penyuluh_model->getPenyuluhPNSTotal($kode, $level, $search);
        $data = array();
        foreach ($list as $row) {
            $data[$no] = array(
                '<p class="text-xs font-weight-bold mb-0">' . ($no + $idx + 1) . '</p>',
                '<div class="dropdown show">
					<a class="btn btn-link dropdown-toggle" style="margin-bottom:0px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						' . $row['noktp'] . '
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="' . base_url('profil/penyuluh/detail/' . $row['nip']) . '"><i class="fas fa-plus"></i> Detail Penyuluh</a>
						<a class="dropdown-item" id="btnEditStatus" data-id="' . $row['id'] . '"><i class="fas fa-plus"></i> Manajemen Status</a>
						<a class="dropdown-item" id="btnEdit" data-id="' . $row['id'] . '"> <i class="fas fa-edit"></i> Ubah</a>
						<a class="dropdown-item" id="btnHapus" id="btnHapus" data-id="' . $row['id'] . '" href="#"><i class="fas fa-trash"></i> Hapus</a>
					</div>
				</div>',
                '<p class="text-xs font-weight-bold mb-0">' . $row['nip'] . '</p>',
                '<p class="text-xs font-weight-bold mb-0">' . $row['gelar_dpn'] . ' ' . $row['nama'] . ' ' . $row['gelar_blk'] . '</p>',
                '<p class="text-xs font-weight-bold mb-0">' . $row['nama_bpp'] . ' ' . $row['nama_bapel2'] . '</p>',
                '<p class="text-xs font-weight-bold mb-0">Kec. ' . ucwords(strtolower($row['kecamatan_tugas'])) . '</p>',
                '<p class="text-xs font-weight-bold mb-0">' . $row['status_kel'] . '</p>',
                '<p class="text-xs font-weight-bold mb-0">' . $row['jabatan'] . '/' . $row['gol_ruang'] . '</p>',
                '<p class="text-xs font-weight-bold mb-0">' . $row['tgl_update'] . '</p>'
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($all['table_data']),
            "recordsFiltered" => count($all['table_data']),
            "data" => (count($data) > 0) ? $data : array(),
        );
        //print_r($output);die();
        echo json_encode($output);
        exit();
    }

    public function editstatus($id)
    {
        $pns = $this->model->getDetailEditStatus($id);
        echo $pns;
    }

    public function getlistkab($provinsi)
    {
        $kab = $this->model->getKab_Filter($provinsi);
        $data = [];
        foreach ($kab as $item) {
            array_push($data, [
                'id_kab' => $item['id_dati2'],
                'nama_kab' => $item['nama_dati2']
            ]);
        }
        return json_encode($data);
    }

    public function getlistkec($kabupaten = '')
    {
        $kec = $this->model->getKec_Filter($kabupaten);
        $data = [];
        foreach ($kec as $item) {
            array_push($data, [
                'id_kec' => $item['id_daerah'],
                'nama_kec' => $item['deskripsi']
            ]);
        }
        return json_encode($data);
    }

    public function updatestatus($id)
    {
        //$id = $this->request->getVar('idjab');
        $nama = $this->request->getPost('nama');
        $nip = $this->request->getPost('nip');
        $nip_lama = $this->request->getPost('nip_lama');
        $gelar_blk = $this->request->getPost('gelar_blk');
        $gelar_dpn = $this->request->getPost('gelar_dpn');
        $status = $this->request->getPost('status');
        $tgl_status = $this->request->getPost('tgl_status');
        $ket_status = $this->request->getPost('ket_status');

        $this->model->save([
            'id' => $id,
            'nama' => $nama,
            'nip_lama' => $nip_lama,
            'nip' => $nip,
            'gelar_dpn' => $gelar_dpn,
            'gelar_blk' => $gelar_blk,
            'status' => $status,
            'tgl_status' => $tgl_status,
            'ket_status' => $ket_status
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }

    public function showDesa($id_thl)
    {

        $data['q'] = $this->model->getDesa($id_thl);

        foreach ($data['q'] as $dtDesa) {

            echo '<option value="' . $dtDesa['id_desa'] . '">' . $dtDesa['nm_desa'] . '</option>';
        }
    }

    public function showDesaAdv()

    {

        ini_set("memory_limit", "912M");

        $id_wil_arr = $this->request->getPost('wil_kerja_notin');

        $jum_wil = $this->request->getPost('jum_wil');

        $id_wil = $id_wil_arr;

        $data['q'] = $this->model->getDesaAdv($id_wil, $jum_wil);

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



    public function save()
    {

        if ($this->request->getPost('kode_kab') == '3') {
            try {
                $res = $this->model->save([
                    'nip' => $this->request->getPost('nip'),
                    'nama' => $this->request->getPost('nama'),
                    'gelar_dpn' => $this->request->getPost('gelar_dpn'),
                    'gelar_blk' => $this->request->getPost('gelar_blk'),
                    'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'status_kel' => $this->request->getPost('status_kel'),
                    'agama' => $this->request->getPost('agama'),
                    'gol_darah' => $this->request->getPost('gol_darah'),
                    'keahlian' => $this->request->getPost('keahlian'),
                    'satminkal' => $this->request->getPost('satminkal'),
                    'kode_kab' => $this->request->getPost('kode_kab'),
                    'tgl_skcpns' => $this->request->getPost('tgl_skcpns'),
                    'peng_kerja_thn' => $this->request->getPost('peng_kerja_thn'),
                    'peng_kerja_bln' => $this->request->getPost('peng_kerja_bln'),
                    'alamat' => $this->request->getPost('alamat'),
                    'dati2' => $this->request->getPost('dati2'),
                    'kodepos' => $this->request->getPost('kodepos'),
                    'kode_prop' => $this->request->getPost('kode_prop'),
                    'telp' => $this->request->getPost('telp'),
                    'hp' => $this->request->getPost('hp'),
                    'email' => $this->request->getPost('email'),
                    'status' => $this->request->getPost('status'),
                    'gol' => $this->request->getPost('gol'),
                    'jabatan' => $this->request->getPost('jabatan'),
                    'tgltmtgol' => $this->request->getPost('tgltmtgol'),
                    'batas_pensiun' => $this->request->getPost('batas_pensiun'),
                    'tgl_pensiun' => $this->request->getPost('tgl_pensiun'),
                    'bulan_pensiun' => $this->request->getPost('bulan_pensiun'),
                    'tahun_pensiun' => $this->request->getPost('tahun_pensiun'),
                    'tgl_update' => $this->request->getPost('tgl_update'),
                    'unit_kerja' => $this->request->getPost('unit_kerja_kab'),
                    'tempat_tugas' => $this->request->getPost('satminkal'),
                    'kecamatan_tugas' => $this->request->getPost('kecamatan_tugas1'),
                    'kecamatan_tugas2' => $this->request->getPost('kecamatan_tugas2'),
                    'kecamatan_tugas3' => $this->request->getPost('kecamatan_tugas3'),
                    'kecamatan_tugas4' => $this->request->getPost('kecamatan_tugas4'),
                    'kecamatan_tugas5' => $this->request->getPost('kecamatan_tugas5'),
                    'kecamatan_tugas6' => $this->request->getPost('kecamatan_tugas6'),
                    'kecamatan_tugas7' => $this->request->getPost('kecamatan_tugas7'),
                    'kecamatan_tugas8' => $this->request->getPost('kecamatan_tugas8'),
                    'kecamatan_tugas9' => $this->request->getPost('kecamatan_tugas9'),
                    'kecamatan_tugas10' => $this->request->getPost('kecamatan_tugas10'),
                    'tgl_sk_luh' => $this->request->getPost('tgl_sk_luh'),
                    'bln_sk_luh' => $this->request->getPost('bln_sk_luh'),
                    'thn_sk_luh' => $this->request->getPost('thn_sk_luh'),
                    'tingkat_pendidikan' => $this->request->getPost('tingkat_pendidikan'),
                    'bidang_pendidikan' => $this->request->getPost('bidang_pendidikan'),
                    'mapping' => $this->request->getPost('mapping'),
                    'jurusan' => $this->request->getPost('jurusan'),
                    'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                    'noktp' => $this->request->getPost('noktp')
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
        } elseif ($this->request->getPost('kode_kab') == '4') {

            try {
                $res = $this->model->save([
                    'nip' => $this->request->getPost('nip'),
                    'nama' => $this->request->getPost('nama'),
                    'gelar_dpn' => $this->request->getPost('gelar_dpn'),
                    'gelar_blk' => $this->request->getPost('gelar_blk'),
                    'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'status_kel' => $this->request->getPost('status_kel'),
                    'agama' => $this->request->getPost('agama'),
                    'gol_darah' => $this->request->getPost('gol_darah'),
                    'keahlian' => $this->request->getPost('keahlian'),
                    'satminkal' => $this->request->getPost('satminkal'),
                    'kode_kab' => $this->request->getPost('kode_kab'),
                    'tgl_skcpns' => $this->request->getPost('tgl_skcpns'),
                    'peng_kerja_thn' => $this->request->getPost('peng_kerja_thn'),
                    'peng_kerja_bln' => $this->request->getPost('peng_kerja_bln'),
                    'alamat' => $this->request->getPost('alamat'),
                    'dati2' => $this->request->getPost('dati2'),
                    'kodepos' => $this->request->getPost('kodepos'),
                    'kode_prop' => $this->request->getPost('kode_prop'),
                    'telp' => $this->request->getPost('telp'),
                    'hp' => $this->request->getPost('hp'),
                    'email' => $this->request->getPost('email'),
                    'status' => $this->request->getPost('status'),
                    'gol' => $this->request->getPost('gol'),
                    'jabatan' => $this->request->getPost('jabatan'),
                    'tgltmtgol' => $this->request->getPost('tgltmtgol'),
                    'batas_pensiun' => $this->request->getPost('batas_pensiun'),
                    'tgl_pensiun' => $this->request->getPost('tgl_pensiun'),
                    'bulan_pensiun' => $this->request->getPost('bulan_pensiun'),
                    'tahun_pensiun' => $this->request->getPost('tahun_pensiun'),
                    'tgl_update' => $this->request->getPost('tgl_update'),
                    'unit_kerja' => $this->request->getPost('unit_kerja'),
                    'tempat_tugas' => $this->request->getPost('kecamatan_tugas'),
                    'kecamatan_tugas' => $this->request->getPost('kecamatan_tugas'),
                    'kecamatan_tugas2' => $this->request->getPost('kecamatan_tugas2'),
                    'kecamatan_tugas3' => $this->request->getPost('kecamatan_tugas3'),
                    'kecamatan_tugas4' => $this->request->getPost('kecamatan_tugas4'),
                    'kecamatan_tugas5' => $this->request->getPost('kecamatan_tugas5'),
                    'kecamatan_tugas6' => $this->request->getPost('kecamatan_tugas6'),
                    'kecamatan_tugas7' => $this->request->getPost('kecamatan_tugas7'),
                    'kecamatan_tugas8' => $this->request->getPost('kecamatan_tugas8'),
                    'kecamatan_tugas9' => $this->request->getPost('kecamatan_tugas9'),
                    'kecamatan_tugas10' => $this->request->getPost('kecamatan_tugas10'),
                    'wil_kerja' => $this->request->getPost('wil_kerja'),
                    'wil_kerja2' => $this->request->getPost('wil_kerja2'),
                    'wil_kerja3' => $this->request->getPost('wil_kerja3'),
                    'wil_kerja4' => $this->request->getPost('wil_kerja4'),
                    'wil_kerja5' => $this->request->getPost('wil_kerja5'),
                    'wil_kerja6' => $this->request->getPost('wil_kerja6'),
                    'wil_kerja7' => $this->request->getPost('wil_kerja7'),
                    'wil_kerja8' => $this->request->getPost('wil_kerja8'),
                    'wil_kerja9' => $this->request->getPost('wil_kerja9'),
                    'wil_kerja10' => $this->request->getPost('wil_kerja10'),
                    'tgl_sk_luh' => $this->request->getPost('tgl_sk_luh'),
                    'bln_sk_luh' => $this->request->getPost('bln_sk_luh'),
                    'thn_sk_luh' => $this->request->getPost('thn_sk_luh'),
                    'tingkat_pendidikan' => $this->request->getPost('tingkat_pendidikan'),
                    'bidang_pendidikan' => $this->request->getPost('bidang_pendidikan'),
                    'mapping' => $this->request->getPost('mapping'),
                    'jurusan' => $this->request->getPost('jurusan'),
                    'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                    'noktp' => $this->request->getPost('noktp')
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
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penyuluhpns');
    }

    public function edit($id)
    {
        $pns = $this->model->getDetailEdit($id);
        echo $pns;
    }

    public function update($id)
    {

        $nip = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama');
        $gelar_dpn = $this->request->getPost('gelar_dpn');
        $gelar_blk = $this->request->getPost('gelar_blk');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $status_kel = $this->request->getPost('status_kel');
        $agama = $this->request->getPost('agama');
        $gol_darah = $this->request->getPost('gol_darah');
        $keahlian = $this->request->getPost('keahlian');
        $satminkal = $this->request->getPost('satminkal');
        $kode_kab = $this->request->getPost('kode_kab');
        $tgl_skcpns = $this->request->getPost('tgl_skcpns');
        $peng_kerja_thn = $this->request->getPost('peng_kerja_thn');
        $peng_kerja_bln = $this->request->getPost('peng_kerja_bln');
        $alamat = $this->request->getPost('alamat');
        $dati2 = $this->request->getPost('dati2');
        $kodepos = $this->request->getPost('kodepos');
        $kode_prop = $this->request->getPost('kode_prop');
        $telp = $this->request->getPost('telp');
        $hp = $this->request->getPost('hp');
        $email = $this->request->getPost('email');
        $status = $this->request->getPost('status');
        $gol = $this->request->getPost('gol');
        $jabatan = $this->request->getPost('jabatan');
        $tgltmtgol = $this->request->getPost('tgltmtgol');
        $batas_pensiun = $this->request->getPost('batas_pensiun');
        $tgl_pensiun = $this->request->getPost('tgl_pensiun');
        $bulan_pensiun = $this->request->getPost('bulan_pensiun');
        $tahun_pensiun = $this->request->getPost('tahun_pensiun');
        $tgl_update = $this->request->getPost('tgl_update');
        $unit_kerja = $this->request->getPost('unit_kerja_kab');
        $tempat_tugas = $this->request->getPost('satminkal');
        $kecamatan_tugas = $this->request->getPost('kecamatan_tugas1');
        $kecamatan_tugas2 = $this->request->getPost('kecamatan_tugas2');
        $kecamatan_tugas3 = $this->request->getPost('kecamatan_tugas3');
        $kecamatan_tugas4 = $this->request->getPost('kecamatan_tugas4');
        $kecamatan_tugas5 = $this->request->getPost('kecamatan_tugas5');
        $kecamatan_tugas6 = $this->request->getPost('kecamatan_tugas6');
        $kecamatan_tugas7 = $this->request->getPost('kecamatan_tugas7');
        $kecamatan_tugas8 = $this->request->getPost('kecamatan_tugas8');
        $kecamatan_tugas9 = $this->request->getPost('kecamatan_tugas9');
        $kecamatan_tugas10 = $this->request->getPost('kecamatan_tugas10');
        $tgl_sk_luh = $this->request->getPost('tgl_sk_luh');
        $bln_sk_luh = $this->request->getPost('bln_sk_luh');
        $thn_sk_luh = $this->request->getPost('thn_sk_luh');
        $tingkat_pendidikan = $this->request->getPost('tingkat_pendidikan');
        $bidang_pendidikan = $this->request->getPost('bidang_pendidikan');
        $mapping = $this->request->getPost('mapping');
        $jurusan = $this->request->getPost('jurusan');
        $nama_sekolah = $this->request->getPost('nama_sekolah');
        $noktp = $this->request->getPost('noktp');

        $nip = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama');
        $gelar_dpn = $this->request->getPost('gelar_dpn');
        $gelar_blk = $this->request->getPost('gelar_blk');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $status_kel = $this->request->getPost('status_kel');
        $agama = $this->request->getPost('agama');
        $gol_darah = $this->request->getPost('gol_darah');
        $keahlian = $this->request->getPost('keahlian');
        $satminkal = $this->request->getPost('satminkal');
        $tgl_skcpns = $this->request->getPost('tgl_skcpns');
        $peng_kerja_thn = $this->request->getPost('peng_kerja_thn');
        $peng_kerja_bln = $this->request->getPost('peng_kerja_bln');
        $alamat = $this->request->getPost('alamat');
        $dati2 = $this->request->getPost('dati2');
        $kodepos = $this->request->getPost('kodepos');
        $kode_prop = $this->request->getPost('kode_prop');
        $telp = $this->request->getPost('telp');
        $hp = $this->request->getPost('hp');
        $email = $this->request->getPost('email');
        $status = $this->request->getPost('status');
        $gol = $this->request->getPost('gol');
        $jabatan = $this->request->getPost('jabatan');
        $tgltmtgol = $this->request->getPost('tgltmtgol');
        $batas_pensiun = $this->request->getPost('batas_pensiun');
        $tgl_pensiun = $this->request->getPost('tgl_pensiun');
        $bulan_pensiun = $this->request->getPost('bulan_pensiun');
        $tahun_pensiun = $this->request->getPost('tahun_pensiun');
        $tgl_update = $this->request->getPost('tgl_update');
        $unit_kerja = $this->request->getPost('unit_kerja');
        $tempat_tugas = $this->request->getPost('kecamatan_tugas');
        $kecamatan_tugas = $this->request->getPost('kecamatan_tugas');
        $wil_kerja = $this->request->getPost('wil_kerja');
        $wil_kerja2 = $this->request->getPost('wil_kerja2');
        $wil_kerja3 = $this->request->getPost('wil_kerja3');
        $wil_kerja4 = $this->request->getPost('wil_kerja4');
        $wil_kerja5 = $this->request->getPost('wil_kerja5');
        $wil_kerja6 = $this->request->getPost('wil_kerja6');
        $wil_kerja7 = $this->request->getPost('wil_kerja7');
        $wil_kerja8 = $this->request->getPost('wil_kerja8');
        $wil_kerja9 = $this->request->getPost('wil_kerja9');
        $wil_kerja10 = $this->request->getPost('wil_kerja10');
        $tgl_sk_luh = $this->request->getPost('tgl_sk_luh');
        $bln_sk_luh = $this->request->getPost('bln_sk_luh');
        $thn_sk_luh = $this->request->getPost('thn_sk_luh');
        $tingkat_pendidikan = $this->request->getPost('tingkat_pendidikan');
        $bidang_pendidikan = $this->request->getPost('bidang_pendidikan');
        $mapping = $this->request->getPost('mapping');
        $jurusan = $this->request->getPost('jurusan');
        $nama_sekolah = $this->request->getPost('nama_sekolah');
        $noktp = $this->request->getPost('noktp');


        $this->model->save([
            'id' => $id,
            'nip' => $nip,
            'nama' => $nama,
            'gelar_dpn' => $gelar_dpn,
            'gelar_blk' => $gelar_blk,
            'tgl_lahir' => $tgl_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'status_kel' => $status_kel,
            'agama' => $agama,
            'gol_darah' => $gol_darah,
            'keahlian' => $keahlian,
            'satminkal' => $satminkal,
            'kode_kab' => $kode_kab,
            'tgl_skcpns' => $tgl_skcpns,
            'peng_kerja_thn' => $peng_kerja_thn,
            'peng_kerja_bln' => $peng_kerja_bln,
            'alamat' => $alamat,
            'dati2' => $dati2,
            'kodepos' => $kodepos,
            'kode_prop' => $kode_prop,
            'telp' => $telp,
            'hp' => $hp,
            'email' => $email,
            'status' => $status,
            'gol' => $gol,
            'jabatan' => $jabatan,
            'tgltmtgol' => $tgltmtgol,
            'batas_pensiun' => $batas_pensiun,
            'tgl_pensiun' => $tgl_pensiun,
            'bulan_pensiun' => $bulan_pensiun,
            'tahun_pensiun' => $tahun_pensiun,
            'tgl_update' => $tgl_update,
            'unit_kerja' => $unit_kerja,
            'tempat_tugas' => $tempat_tugas,
            'kecamatan_tugas' => $kecamatan_tugas,
            'kecamatan_tugas2' => $kecamatan_tugas2,
            'kecamatan_tugas3' => $kecamatan_tugas3,
            'kecamatan_tugas4' => $kecamatan_tugas4,
            'kecamatan_tugas5' => $kecamatan_tugas5,
            'kecamatan_tugas6' => $kecamatan_tugas6,
            'kecamatan_tugas7' => $kecamatan_tugas7,
            'kecamatan_tugas8' => $kecamatan_tugas8,
            'kecamatan_tugas9' => $kecamatan_tugas9,
            'kecamatan_tugas10' => $kecamatan_tugas10,
            'wil_kerja' => $wil_kerja,
            'wil_kerja2' => $wil_kerja2,
            'wil_kerja3' => $wil_kerja3,
            'wil_kerja4' => $wil_kerja4,
            'wil_kerja5' => $wil_kerja5,
            'wil_kerja6' => $wil_kerja6,
            'wil_kerja7' => $wil_kerja7,
            'wil_kerja8' => $wil_kerja8,
            'wil_kerja9' => $wil_kerja9,
            'wil_kerja10' => $wil_kerja10,
            'tgl_sk_luh' => $tgl_sk_luh,
            'bln_sk_luh' => $bln_sk_luh,
            'thn_sk_luh' => $thn_sk_luh,
            'tingkat_pendidikan' => $tingkat_pendidikan,
            'bidang_pendidikan' => $bidang_pendidikan,
            'mapping' => $mapping,
            'jurusan' => $jurusan,
            'nama_sekolah' => $nama_sekolah,
            'noktp' => $noktp
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
}
