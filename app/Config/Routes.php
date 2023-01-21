<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->get('/', 'Home::index');

$routes->get('workout', 'Workout::index');
$routes->get('workout/(:num)', 'Workout::show/$1');
$routes->post('workout', 'Workout::create');
$routes->put('workout/(:num)', 'Workout::update/$1');
$routes->delete('workout/(:num)', 'Workout::delete/$1');

$routes->get('workout-type', 'WorkoutType::index');
$routes->get('workout-type/(:num)', 'WorkoutType::show/$1');
$routes->post('workout-type', 'WorkoutType::create');
$routes->put('workout-type/(:num)', 'WorkoutType::update/$1');
$routes->delete('workout-type/(:num)', 'WorkoutType::delete/$1');

$routes->get('training-session', 'TrainingSession::index');
$routes->get('training-session/(:num)', 'TrainingSession::show/$1');
$routes->get('training-session/workout/(:num)', 'TrainingSession::getByWorkoutId/$1');

$routes->post('training-session', 'TrainingSession::create');
$routes->put('training-session/(:num)', 'TrainingSession::update/$1');
$routes->delete('training-session/(:num)', 'TrainingSession::delete/$1');

$routes->get('exercise', 'Exercise::index');
$routes->get('exercise/(:num)', 'Exercise::show/$1');
$routes->get('exercise/training-session/(:num)', 'Exercise::getExercisesByTrainingSessionId/$1');

$routes->post('exercise', 'Exercise::create');
$routes->put('exercise/(:num)', 'Exercise::update/$1');
$routes->delete('exercise/(:num)', 'Exercise::delete/$1');

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
