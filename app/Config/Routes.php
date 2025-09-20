<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/senati', 'Home::index');

//Reportes
$routes->get('/reportes/r1', 'ReporteController::getReport1');
$routes->get('/reportes/r2', 'ReporteController::getReport2');
$routes->get('/reportes/r3', 'ReporteController::getReport3');
$routes->get('/reportes/ABC', 'ReporteController::getReportABC');
$routes->get('/reportes/filtro', 'ReporteController::getFiltro');

// Nuevas rutas para selección de publisher y generación de PDF
$routes->get('/reportes/publishers', 'ReporteController::publishers');
$routes->get('/reportes/generar', 'ReporteController::reportByPublisher');