<?php

class PokemonController extends BaseController {

    // Hakee kaikki Pokémon-lajit tietokannasta listasivulle
    public static function index() {
        $kaikki = Pokemon::all();
        View::make('suunnitelmat/laji/laji_list.html', array('kaikki' => $kaikki));
    }

    // Näyttää yksittäisen Pokémon-lajin tiedot lajin sivulla
    public static function show($id) {
        $poke = Pokemon::find($id);
        View::make('suunnitelmat/laji/laji_show.html', array('poke' => $poke));
    }

    // Uuden Pokémon-lajin luontilomakesivun generointi
    public static function newPokemon() {
        View::make('suunnitelmat/laji/laji_new.html');
    }

    // Uuden Pokémon-lajin tallentaminen tietokantaan
    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'tunnusluku' => $params['tunnusluku'],
            'pituus' => $params['pituus'],
            'paino' => $params['paino'],
            'kuvaus' => $params['kuvaus']
        );
        $poke = new Pokemon($attributes);
        $errors = $poke->errors();
        if (count($errors) == 0) {
            // Parametrit kunnossa -> Tallennetaan Pokémon tietokantaan
            $poke->save();
            Redirect::to('/laji/' . $poke->id, array('message' => 'Pokémon on lisätty onnistuneesti tietokantaan!'));
        } else{
            // Parametrit eivät kunnossa -> Ei tallenneta Pokémonia tietokantaan
            View::make('suunnitelmat/laji/laji_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
