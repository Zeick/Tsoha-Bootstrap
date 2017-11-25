<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/poke', function() {
    OmaPokemonController::index();
});
$routes->get('/poke/k/:kid', function($kid) {
    OmaPokemonController::showByTrainer($kid);
});
$routes->get('/poke/p/:pid', function($pid) {
OmaPokemonController::showByPokemon($pid);
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
$routes->get('/poke_edit', function() {
    HelloWorldController::poke_edit();
});
$routes->get('/kouluttaja', function() {
    HelloWorldController::kouluttaja_list();
});
$routes->get('/kouluttaja/1', function() {
    HelloWorldController::kouluttaja_show();
});
$routes->get('/kouluttaja_edit', function() {
    HelloWorldController::kouluttaja_edit();
});
$routes->get('/liiga', function() {
    HelloWorldController::liiga_list();
});
$routes->get('/liiga/1', function() {
    HelloWorldController::liiga_show();
});
$routes->get('/liiga_edit', function() {
    HelloWorldController::liiga_edit();
});
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


