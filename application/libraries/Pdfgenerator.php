<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include Dompdf
require_once FCPATH . 'vendor/dompdf/dompdf/dompdf_config.inc.php';

class Pdfgenerator
{
  private $dompdf;

  public function __construct() {
    $this->dompdf = new DOMPDF();
  }

  public function generate($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $this->dompdf->load_html($html);
    $this->dompdf->set_paper($paper, $orientation);
    $this->dompdf->render();
    if ($stream) {
      $this->dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    } else {
      return $this->dompdf->output();
    }
  }
  
  public function generate_pdf($booking_id, $html, $filename = '', $stream = FALSE, $paper = 'A4', $orientation = "portrait")
  {
    $filename = (!empty($filename) ? $filename : date("Y-m-d") . "-" . $booking_id . '.pdf');

    $this->dompdf->load_html($html);
    $this->dompdf->set_paper($paper, $orientation);
    $this->dompdf->render();
    if ($stream) {
      $this->dompdf->stream($filename, array("Attachment" => 0));
    } else {
      $output = $this->dompdf->output();
      file_put_contents('assets/pdf/'.$filename, $output);
      $file_path = 'assets/pdf/'.$filename;
      return $file_path;
    }
  }
}
