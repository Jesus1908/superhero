<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Codeigniter\Config;

class ReporteController extends BaseController
{

  protected $db;

  public function __construct(){
    $this->db = \Config\Database::connect();
  }
  public function getReport1(){
    $html = view('reportes/reporte1');
    $html2PDF = new Html2PDF();
    $html2PDF->writeHTML($html);

    $this->response->setHeader('Content-Type', 'application/pdf');
   
    $html2PDF->output();
  }

    public function getReport2(){
      $data = [
        "area" => "Sistemas",
        "autor" => "Omar Pachas",
        "productos" => [
          ["id" => 750 ,"descripcion" => "Monitor", "precio" => 750],
          ["id" => 750, "descripcion" => "Impresora", "precio" => 500],
          ["id" => 750, "descripcion" =>"Webcam", "precio" => 220]
        ],
        "estilos" => view('reportes/estilos')
      ];

      $html = view('reportes/reporte2', $data);
      
      try {
        $html2PDF = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [10,10,10,10]);
        $html2PDF->writeHTML(($html));

        $this->response->setHeader('Content-Type', 'application/pdf');
        $html2PDF->output('Reporte-Finanzas.pdf');

      } catch (Html2PdfException $e) {
        $html2PDF->clean();
        $formater = new ExceptionFormatter($e);
        echo $formater->getMessage();
      }
  }

    public function getReport3(){
      
      $cn = \Config\Database::connect();

      $query = "
      SELECT 
        SH.id,
        SH.superhero_name,
        SH.full_name,
        PB.publisher_name,
        AL.alignment
        FROM superhero SH
        LEFT JOIN publisher PB ON SH.publisher_id = PB.id
        LEFT JOIN alignment AL ON SH.alignment_id = AL.id
        ORDER BY 4
        LIMIT 100;
      ";
      $rows = $this->db->query($query);
      $data = [
        "rows" => $rows->getResultArray(),
        "estilos" => view('reportes/estilos')
      ];

      $html = view('reportes/reporte3', $data);
      
      try {
        $html2PDF = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', [20,10,10,10]);
        $html2PDF->writeHTML(($html));

        $this->response->setHeader('Content-Type', 'application/pdf');
        $html2PDF->output('Reporte-superhero.pdf');

      } catch (Html2PdfException $e) {
        $html2PDF->clean();
        $formater = new ExceptionFormatter($e);
        echo $formater->getMessage();
      }
  }

  public function getFiltro(){
    return view('reportes/filtro');
  }

  public function getReportABC() {
      $cn = \Config\Database::connect();

      $query = "
        SELECT 
        SH.id,
        SH.superhero_name,
        PB.publisher_name,
        AL.alignment
        FROM superhero SH
        LEFT JOIN publisher PB ON SH.id = PB.id
        LEFT JOIN alignment AL ON SH.alignment_id = AL.id
        LIMIT 100;
      ";
      $rows = $this->db->query($query);
      $data = [
        "rows" => $rows->getResultArray(),
        "estilos" => view('reportes/estilos')
      ];

      $html = view('reportes/reporteABC', $data);
      
      try {
        $html2PDF = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', [20,10,10,10]);
        $html2PDF->writeHTML(($html));

        $this->response->setHeader('Content-Type', 'application/pdf');
        $html2PDF->output('Reporte-ABC.pdf');

      } catch (Html2PdfException $e) {
        $html2PDF->clean();
        $formater = new ExceptionFormatter($e);
        echo $formater->getMessage();
      }
  }

    /**
     * Muestra formulario con select de publishers
     */
    public function publishers()
    {
        $publishers = $this->db->table('publisher')
            ->select('id, publisher_name')
            ->orderBy('publisher_name', 'ASC')
            ->get()
            ->getResultArray();

        return view('reportes/publisher', [
            'publishers' => $publishers,
        ]);
    }

    /**
     * Genera PDF con héroes de publisher seleccionado
     */
    public function reportByPublisher()
    {
        $publisherId = $this->request->getGet('publisher_id');

        if (empty($publisherId)) {
            return redirect()->to('/reportes/publishers')
                ->with('error', 'Seleccione una casa editorial válida');
        }

        $publisher = $this->db->table('publisher')
            ->where('id', $publisherId)
            ->get()
            ->getRowArray();

        if (!$publisher) {
            return redirect()->to('/reportes/publishers')
                ->with('error', 'Casa editorial no encontrada');
        }

        $query = "
            SELECT SH.id, SH.superhero_name, SH.full_name, AL.alignment
            FROM superhero SH
            LEFT JOIN alignment AL ON SH.alignment_id = AL.id
            WHERE SH.publisher_id = ?
            ORDER BY SH.superhero_name
        ";

        $heroes = $this->db->query($query, [$publisherId])->getResultArray();

        $data = [
            'publisher' => $publisher,
            'rows' => $heroes,
            'estilos' => view('reportes/estilos')
        ];

        $html = view('reportes/reporte_publisher', $data);

        try {
            $html2PDF = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
            $html2PDF->pdf->SetAutoPageBreak(true, 0);
            $html2PDF->writeHTML($html);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $safeName = preg_replace('/[^A-Za-z0-9_-]+/','_', $publisher['publisher_name']);
            $html2PDF->output('Heroes-' . $safeName . '.pdf');
        } catch (Html2PdfException $e) {
            $formater = new ExceptionFormatter($e);
            echo $formater->getMessage();
        }
    }
}