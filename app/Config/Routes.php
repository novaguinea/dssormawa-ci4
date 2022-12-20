<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) 
{
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Pages::index');

//routes for users configuration
$routes->get('/login', 'Pages::login');
$routes->post('/login/validate', 'Users::login');
$routes->get('/users', 'Users::index');
$routes->get('/users/add', 'Users::add');
$routes->get('/users/delete/(:segment)', 'Users::delete/$1');
$routes->get('/users/(:segment)', 'Users::detail/$1');

$routes->post('/users/saveUser', 'Users::saveUser');
    
//routes for rules
$routes->get('/rules', 'Rules::index');
$routes->get('/rules/detail/(:segment)', 'Rules::detailCategory/$1'); //detail category
$routes->get('/rules/detail/criterion/(:segment)', 'Rules::detailCriterion/$1'); //detail criterion

$routes->get('/rules/deleteCategory/(:segment)', 'Rules::deleteCategory/$1');
$routes->get('/rules/deleteCriterion/(:segment)', 'Rules::deleteCriterion/$1');
$routes->get('/rules/deleteScoringIndicator/(:segment)/(:segment)', 'Rules::deleteScoringIndicator/$1/$2');

$routes->post('/rules/addCategory', 'Rules::addCategory');
$routes->get('/rules/addCriterion/(:segment)', 'Rules::addCriterion/$1');
$routes->get('/rules/addScoringIndicator/(:segment)', 'Rules::addScoringIndicator/$1');

$routes->post('/rules/saveCriterion', 'Rules::saveCriterion');
$routes->post('/rules/saveScoringIndicator', 'Rules::saveScoringIndicator');

$routes->get('/data/dump', 'Data::dump');
$routes->get('/data/dump/(:segment)', 'Data::normalizationPerCri/$1');

$routes->get('/data', 'Data::index');
$routes->post('/data/updateStatusData', 'Data::updateStatus');
$routes->get('/data/(:segment)', 'Data::detailOrmawa/$1');
$routes->get('/data/detail/(:segment)', 'Data::detailDataCriterion/$1');
$routes->get('/data/detail/(:segment)/(:segment)', 'Data::viewDetailData/$1/$2');

/**
 * 
 * ORMAWA side routes
 * focused on filling data ormawa and view data also view result
 * 
 */

$routes->get('/ormawa/category', 'DataOrmawa::listOfCategory');
$routes->get('/ormawa/category/(:segment)', 'DataOrmawa::detailCategory/$1');
$routes->get('/ormawa/category/criterion/(:segment)', 'DataOrmawa::detailCriterion/$1');
$routes->post('/ormawa/category/criterion/saveData', 'DataOrmawa::inputData');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';  
}
