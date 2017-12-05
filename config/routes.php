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

$routes->get('/kouluttaja/new', function(){
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

$routes->post('/kouluttaja/:id/destroy', function($id){
    UserController::destroy($id); 
});

$routes->get('/kouluttaja/:id', function($id) {
    UserController::show($id);
});

// Liiga-reitit
$routes->get('/liiga', function() {
    HelloWorldController::liiga_list();
});
$routes->get('/liiga/1', function() {
    HelloWorldController::liiga_show();
});
$routes->get('/liiga_edit', function() {
    HelloWorldController::liiga_edit();
});

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

$routes->get('/laji_edit', function() {
    HelloWorldController::laji_edit();
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

