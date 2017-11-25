<?php

class OmaPokemonController extends BaseController{
    // Näyttää kaikki OmaPokémonit
    public static function index(){
        $kaikki = OmaPokemon::all();
        View::make('suunnitelmat/poke/poke_list.html', array('kaikki' => $kaikki));
    }
    // Näyttää kaikki tietyn kouluttajan OmaPokémonit
    public static function showByTrainer($kid){
        $kaikki = OmaPokemon::findByTrainer($kid);
        View::make('suunnitelmat/poke/poke_list.html', array('kaikki' => $kaikki));
    }
        // Näyttää kaikki tietyn lajin OmaPokémonit
    public static function showByPokemon($pid){
        $kaikki = OmaPokemon::findByPokemon($pid);
        View::make('suunnitelmat/poke/poke_list.html', array('kaikki' => $kaikki));
    }

}