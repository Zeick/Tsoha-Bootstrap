<?php

class PokemonController extends BaseController{
    public static function index(){
        $kaikki = Pokemon::all();
        View::make('suunnitelmat/laji/laji_list.html', array('kaikki' => $kaikki));
    }
    public static function show($id){
        $poke = Pokemon::find($id);
        View::make('suunnitelmat/laji/laji_show.html', array('poke' => $poke));
    }
    public static function newPokemon(){
        View::make('suunnitelmat/laji/laji_new.html');
    }
    
    public static function store(){
        $params = $_POST;
        $poke = new Pokemon(array(
            'nimi' => $params['nimi'],
            'tunnusluku' => $params['tunnusluku'],
            'pituus' => $params['pituus'],
            'paino' => $params['paino'],
            'kuvaus' => $params['kuvaus']
        ));
        $poke->save();
        Redirect::to('/laji/' . $poke->id, array('message' => 'Pokémon on lisätty onnistuneesti tietokantaan!'));
    }
}
