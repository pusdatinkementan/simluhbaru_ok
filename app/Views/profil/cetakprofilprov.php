<?php
//echo 'test';die();

//debugCode(last_query());
//require_once('./assets/tcpdf/config/lang/eng.php');
require_once('./assets/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Printed on '.date('Y-m-d H:i').' - SIstem Informasi Manajemen Penyuluhan Pertanian', 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KEMENTERIAN PERTANIAN');
$pdf->SetTitle('PROFIL LEMBAGA - SIMLUHTAN');
$pdf->SetSubject('SIMLUHTAN');
$pdf->SetKeywords('simluhtan');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO_WIDTH, 'Testing Simpeg', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->setPrintHeader(false);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings

$pdf->setCompression(TRUE);

$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);


// ---------------------------------------------------------

// set font
$pdf->SetFont('freesans', '', 10);

// add a page
$pdf->addPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
//$barcode = $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 150, 0, 20, 20, $style, 'N');
//$pdf->Text(20, 205, 'QRCODE H');


$header = '<table width="100%" border = "0">
			<tr>
				<td align="center"><h3>PROFIL KELEMBAGAAN PENYULUHAN PERTANIAN</h3></td>
				
			</tr>
			</table></br>';
$pdf->writeHTML($header, true, false, true, false,'');

$pdf->Ln(10);

$table = '<table id="listpeg" border="0" width="100%"  cellpadding="2">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>I. DATA LEMBAGA</strong></td>
    </tr>
	<tr>
      <td colspan="3" >&nbsp;</td>
    </tr>
    <tr>
      <td width="43%">Nama Kelembagaan</td>
	  <td width="2%">:</td>
      <td width="55%">'.$dt['deskripsi_lembaga_lain'].' '. session()->get('nama').'</td>	  
    </tr>
	
    <tr>
      <td>Pembentukan Lembaga</td>
	  <td>:</td>
      <td>'.format_date($dt['thn_berdiri'] . '-' . $dt['bln_berdiri'] . '-' . $dt['tgl_berdiri'], 2).' ('.$dt['dasar_hukum'].' '.(($dt['no_peraturan'] <> '') ? ' No. '.$dt['no_peraturan']: '').')'.'</td>
    </tr>
	<tr>
      <td>Alamat</td>
	  <td>:</td>
      <td>'.$dt['alamat'].'</td>
    </tr>
	<tr>
      <td>Provinsi</td>
	  <td>:</td>
      <td>'.$namaprov.'</td>
    </tr>	
	<tr>
      <td>Titik Koordinat Lembaga </td>
	  <td>:</td>
      <td>'.$dt['koordinat'].'</td>
    </tr>
	
	<tr>
      <td>Nama Pimpinan</td>
	  <td>:</td>
      <td>'.$dt['ketua'].'</td>
    </tr>	
	<tr>
      <td>No HP Pimpinan </td>
	  <td>:</td>
      <td>'.$dt['telp_hp'].'</td>
    </tr>
	
	
	<tr>
      <td>Nama Kepala '. (($dt['eselon3_luh'] == '') ? 'Unit Kerja' : $dt['eselon3_luh']).' yang Menangani Penyuluhan</td>
	  <td>:</td>
      <td>'.$dt['nama_kabid'].(($dt['nama_bidang_luh'] <> '') ? ' (Kepala '.$dt['nama_bidang_luh'].')' : '').'</td>
    </tr>
	<tr>
      <td>No HP Kepala '.( ($dt['eselon3_luh'] == '') ? 'Unit Kerja' : $dt['eselon3_luh']).' yang Menangani Penyuluhan</td>
	  <td>:</td>
      <td>'.$dt['hp_kabid'].'</td>
    </tr>
	<tr>
      <td>Nama Kepala Seksi yang Menangani Penyuluhan </td>
	  <td>:</td>
      <td>'.$dt['nama_kasie'].(($dt['seksi_luh'] <> '') ? ' (Kepala '.$dt['seksi_luh'].')' : '').'</td>
    </tr>
	<tr>
      <td>No HP Kepala Seksi yang Menangani Penyuluhan </td>
	  <td>:</td>
      <td>'.$dt['hp_kasie'].'</td>
    </tr>
	
	<tr>
      <td>Nama Koordinator PP</td>
	  <td>:</td>
      <td>'.$dt['namakoord'].'</td>
    </tr>
	<tr>
      <td>No Telepon/Fax </td>
	  <td>:</td>
      <td>'.$dt['telp_kantor'].'/'.$dt['fax_kantor'].'</td>
    </tr>
	<tr>
      <td>Alamat Email </td>
	  <td>:</td>
      <td>'.$dt['email'].'</td>
    </tr>
	<tr>
      <td>Alamat Website </td>
	  <td>:</td>
      <td>'.$dt['website'].'</td>
    </tr>
	<tr>
      <td>Akun Instagram Lembaga</td>
	  <td>:</td>
      <td>'.$dt['instagram'].'</td>
    </tr>
	<tr>
      <td>Akun Facebook Lembaga </td>
	  <td>:</td>
      <td>'.$dt['facebook'].'</td>
    </tr>
	<tr>
      <td>Alamat Twitter </td>
	  <td>:</td>
      <td>'.$dt['twitter'].'</td>
    </tr>
	
</table>';
$pdf->writeHTML($table, true, false, true, false,'');
$pdf->SetFont('freesans', '', 10);

$table ='
<div bgcolor="#CCCCCC"><strong>II. DATA PENYULUH PERTANIAN PNS PROVINSI</strong></div><br>';

$no = 0;
$table .= ' <table width="100%" border="1"  cellpadding="5">
          <tr>
            <td width="5%" align="center">No</td>
            <td width="25%" align="center">NIP </td>
            <td width="70%" align="center">Nama</td>
          </tr>
		  ';
	if ($jum_pns > 0){
		foreach ($datapns as $row => $pns) { 
			$table .= '
				<tr>
					<td align="left">'.++$no.'</td>
					<td align="center">'.$pns['nip'].'</td>
					<td align="left">'.trim($pns['gelar_dpn'].' '.$pns['nama'].' '.$pns['gelar_blk']).'</td>		
					
				</tr>';
			}
	}
	else{
		$table .= '<tr>
            
			<td align="center" colspan="3">Belum ada data penyuluh PNS</td>         
          </tr>';
	} 	

 
$table 	.= '  </table>';
  $pdf->writeHTML($table, true, false, true, false,'');

$table ='
<div bgcolor="#CCCCCC"><strong>III. DATA PENYULUH PERTANIAN PPPK PROVINSI</strong></div><br>';

$no = 0;
$table .= ' <table width="100%" border="1"  cellpadding="5">
          <tr>
            <td width="5%" align="center">No</td>
            <td width="25%" align="center">NIP </td>
            <td width="70%" align="center">Nama</td>
          </tr>
		  ';
	if ($jum_p3k > 0){
		foreach ($datap3k as $row => $p3k) { 
			$table .= '
				<tr>
					<td align="left">'.++$no.'</td>
					<td align="center">'.$p3k['nip'].'</td>
					<td align="left">'.trim($p3k['gelar_dpn'].' '.$p3k['nama'].' '.$p3k['gelar_blk']).'</td>		
					
				</tr>';
			}
	}
	else{
		$table .= '<tr>
            
			<td align="center" colspan="3">Belum ada data penyuluh PPPK</td>         
          </tr>';
	} 	

 
$table 	.= '  </table>';
  $pdf->writeHTML($table, true, false, true, false,'');


$pdf->Output();

//============================================================+
// END OF FILE
//============================================================+
