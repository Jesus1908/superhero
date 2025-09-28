<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/senati', 'Home::index');

//Reportes
$routes->get('/reportes/r1', 'ReporteController::getReport1');
$routes->get('/reportes/r2', 'ReporteController::getReport2');
$routes->get('/reportes/r3', 'ReporteController::getReport3');
$routes->get('/reportes/ABC', 'ReporteController::getReportABC');
$routes->get('/reportes/filtro', 'ReporteController::getFiltro');
$routes->get('/reportes/publishers', 'ReporteController::publishers');
$routes->get('/reportes/generar', 'ReporteController::reportByPublisher');
$routes->get('/reportes/generar-poderes/(:num)', 'ReporteController::generarPdfPoderes/$1');

//Buscador
$routes->get('/api/buscar', 'ReporteController::buscar');
$routes->get('/reportes/buscar', 'ReporteController::buscarView');

//Reporte Tarea 1
$routes->get('/reportes/tarea1', 'ReporteController::tarea1Form');
$routes->post('/reportes/generar-tarea1', 'ReporteController::generarTarea1');