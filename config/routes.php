<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

// OmaPokémon-reitit
$routes->get('/poke', function() {
    OmaPokemonController::index();
});
$routes->get('/poke/k/:kid', function($kid) {
    OmaPokemonController::showByTrainer($kid);
});
$routes->get('/poke/p/:pid', function($pid) {
    OmaPokemonController::showByPokemon($pid);
});
$routes->get('/poke/new', function() {
    OmaPokemonController::newPokemon();
});
$routes->post('/poke', function() {
    OmaPokemonController::store();
});

$routes->get('/poke/:id/edit', function($id) {
    OmaPokemonController::edit($id);
});
$routes->post('/poke/:id/edit', function($id) {
    OmaPokemonController::update($id);
});

$routes->post('/poke/:id/destroy', function($id) {
    OmaPokemonController::destroy($id);
});
$routes->get('/poke/:id', function($id) {
    OmaPokemonController::show($id);
});

// Kouluttaja-reitit
$routes->get('/kouluttaja', function() {
    UserController::index();
});

$routes->get('/kouluttaja/new', function() {
    UserController::newKouluttaja();
});

$routes->post('/kouluttaja', function() {
    UserController::store();
});

$routes->get('/kouluttaja/:id/edit', function($id) {
    UserController::edit($id);
});

$routes->post('/kouluttaja/:id/edit', function($id) {
    UserController::update($id);
});

$routes->post('/kouluttaja/:id/destroy', function($id) {
    UserController::destroy($id);
});

$routes->get('/kouluttaja/:id', function($id) {
    UserController::show($id);
});

// Liiga-reitit
$routes->get('/liiga', function() {
    LiigaController::index();
});
$routes->get('/liiga/new', function() {
    LiigaController::newLiiga();
});
$routes->post('/liiga', function() {
    LiigaController::store();
});
$routes->get('/liiga/:id', function($id) {
    LiigaController::show($id);
});

$routes->get('/liiga/:id/edit', function($id) {
    LiigaController::edit($id);
});
$routes->post('/liiga/:id/edit', function($id) {
    LiigaController::update($id);
});
$routes->post('/liiga/:id/destroy', function($id) {
    LiigaController::destroy($id);
});

// Jäsenyys-reitit
$routes->get('/jasenyys', function() {
    JasenyysController::index();
});
$routes->post('/liiga/liity', function() {
    JasenyysController::store();
});

$routes->post('/liiga/eroa', function() {
    JasenyysController::destroy();
});

/*$routes->post('/jasenyys/:nimi/jasen/:jasen', function($nimi, $jasen) {
  JasenyysController::destroy($nimi, $jasen);
  });*/

// Laji-reitit
$routes->get('/laji', function() {
    PokemonController::index();
});
$routes->post('/laji', function() {
    PokemonController::store();
});
$routes->get('/laji/new', function() {
    PokemonController::newPokemon();
});
$routes->get('/laji/:id', function($id) {
    PokemonController::show($id);
});
$routes->get('/laji/:id/edit', function($id) {
    PokemonController::edit($id);
});
$routes->post('/laji/:id/edit', function($id) {
    PokemonController::update($id);
});
$routes->post('/laji/:id/destroy', function($id) {
    PokemonController::destroy($id);
});

// Kirjautumisreitit
$routes->get('/login', function() {
    UserController::login();
});
$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});

