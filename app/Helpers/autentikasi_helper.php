<?php

function is_logged_in()
{
	//echo "test";
	$session = session();
	// echo $session->get('kodebapel');
	if ($session->get('kodebapel') == "") {
		return redirect()->to('login');
	}
	// return $session->get('kodebapel');
}

function format_rupiah($angka)
{
	$rupiah = number_format($angka, 0, ',', '.');
	return $rupiah;
}

function format_date($date = "", $output_type = "")
{
	$month = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$month2 = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	switch ($output_type) {
		case 1: //format 2012-06-15 20:38:52 menjadi 15 Juni 2012 20.38 WIB
			$tanggal = explode(" ", $date);
			$detail_tgl = explode("-", $tanggal[0]);
			$detail_waktu = explode(":", $tanggal[1]);
			for ($i = 1; $i <= 12; $i++) {
				if ($i == $detail_tgl[1]) $bulan = $month[$i];
			}
			$tanggal_baru = $detail_tgl[2] . ' ' . $bulan . ' ' . $detail_tgl[0] . ' ' . $detail_waktu[0] . '.' . $detail_waktu[1] . ' WIB';
			break;
		case 2: //format 2012-06-15 menjadi 15 Juni 2012 
			$tanggal = explode("-", $date);
			if ($tanggal[0] == '' || $tanggal[1] == '' || $tanggal[2] == '') {
				$tanggal[0] = '0000';
				$tanggal[1] = '00';
				$tanggal[2] = '00';
			}
			for ($i = 0; $i <= 12; $i++) {
				if ($i == $tanggal[1]) $bulan = $month[$i];
			}
			$tanggal_baru = $tanggal[2] . ' ' . $tanggal[1] . ' ' . $tanggal[0];
			break;
		case 3: // format 20 juni 2013 ke 2013-06-20
			$tanggal = explode(' ', trim($date));
			if (count($tanggal) != 3)
				$tanggal_baru = array(
					'code' => 'error',
					'msg' => "Format Tanggal Inventarisasi Salah pada baris ke-"
				);
			else {
				$bln = ucfirst($tanggal[1]);
				if (!in_array($bln, $month)) {
					$tanggal_baru = array(
						'code' => 'error',
						'msg' => "Format Bulan Inventarisasi Salah pada baris ke-"
					);
				} else {
					$bulan = array_search($bln, $month);
					$bulan = ($bulan < 10) ? '0' . $bulan : $bulan;
					$tanggal_baru = array(
						'code' => 'success',
						'msg' => $tanggal[2] . '-' . $bulan . '-' . $tanggal[0]
					);
				}
			}
			break;
		case 4: //format 2012-06-15 20:38:52 menjadi 15 Juni 2012
			$tanggal = explode(" ", $date);
			$detail_tgl = explode("-", $tanggal[0]);
			$detail_waktu = explode(":", $tanggal[1]);
			for ($i = 1; $i <= 12; $i++) {
				if ($i == $detail_tgl[1]) $bulan = $month[$i];
			}
			$tanggal_baru = $detail_tgl[2] . ' ' . $bulan . ' ' . $detail_tgl[0];
			break;
		case 5: //format 2012-06-15 20:38:52 menjadi Jun 2012
			$tanggal = explode(" ", $date);
			$detail_tgl = explode("-", $tanggal[0]);
			$detail_waktu = explode(":", $tanggal[1]);
			for ($i = 1; $i <= 12; $i++) {
				if ($i == $detail_tgl[1]) $bulan = $month2[$i];
			}
			$tanggal_baru = $bulan . ' ' . $detail_tgl[0];
			break;
		default:
			$tanggal_baru = "";
	}
	return $tanggal_baru;
}


// function check_access($role_id, $menu_id)
// {
//     $ci = get_instance();

//     $ci->db->where('role_id', $role_id);
//     $ci->db->where('menu_id', $menu_id);
//     $result = $ci->db->get('user_access_menu');

//     if ($result->num_rows() > 0) {
//         return "checked='checked'";
//     }
// }