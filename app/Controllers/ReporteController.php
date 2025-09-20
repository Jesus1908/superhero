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

    public function publishers()
    {
        $publishers = $this->db->table('publisher')
            ->select('id, publisher_name')
            ->orderBy('publisher_name', 'ASC')
            ->get()
            ->getResultArray();

        return view('reportes/publisher',
         [
            'publishers' => $publishers,
        ]);
    }

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

    public function buscar() {
        $nombre = $this->request->getGet('nombre');
        
        $query = $this->db->table('superhero SH')
            ->select('SH.*, PB.publisher_name, AL.alignment, G.gender, R.race, EC.colour as eye_colour, HC.colour as hair_colour')
            ->join('publisher PB', 'SH.publisher_id = PB.id')
            ->join('alignment AL', 'SH.alignment_id = AL.id')
            ->join('gender G', 'SH.gender_id = G.id', 'left')
            ->join('race R', 'SH.race_id = R.id', 'left')
            ->join('colour EC', 'SH.eye_colour_id = EC.id', 'left')
            ->join('colour HC', 'SH.hair_colour_id = HC.id', 'left')
            ->like('SH.superhero_name', $nombre)
            ->limit(10);
        
        $heroes = $query->get()->getResultArray();
        
        $html = '';
        foreach($heroes as $hero) {
            $html .= '<div class="hero-info">';
            $html .= '<h3>'.esc($hero['superhero_name']).'</h3>';
            $html .= '<p><strong>Nombre real:</strong> '.($hero['full_name'] ? esc($hero['full_name']) : 'No especificado').'</p>';
            $html .= '<p><strong>Casa editorial:</strong> '.esc($hero['publisher_name']).'</p>';
            $html .= '<p><strong>Alineación:</strong> '.esc($hero['alignment']).'</p>';
            $html .= '<p><strong>Género:</strong> '.($hero['gender'] ? esc($hero['gender']) : 'No especificado').'</p>';
            $html .= '<p><strong>Raza:</strong> '.($hero['race'] ? esc($hero['race']) : 'No especificado').'</p>';
            $html .= '<p><strong>Color de ojos:</strong> '.($hero['eye_colour'] ? esc($hero['eye_colour']) : 'No especificado').'</p>';
            $html .= '<p><strong>Color de cabello:</strong> '.($hero['hair_colour'] ? esc($hero['hair_colour']) : 'No especificado').'</p>';
            $html .= '<p><strong>Altura:</strong> '.($hero['height_cm'] ? esc($hero['height_cm']).' cm' : 'No especificado').'</p>';
            $html .= '<p><strong>Peso:</strong> '.($hero['weight_kg'] ? esc($hero['weight_kg']).' kg' : 'No especificado').'</p>';
            $html .= '</div>';
        }
        
        return $this->response->setBody($html);
    }

    public function buscarView() {
        return view('reportes/buscar');
    }
}