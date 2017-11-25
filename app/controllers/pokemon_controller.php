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
        } else {
            // Parametrit eivät kunnossa -> Ei tallenneta Pokémonia tietokantaan
            View::make('suunnitelmat/laji/laji_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    // Olemassaolevan Pokémon-lajin tietojen muuttamislomakkeen luominen
    public static function edit($id) {
        $poke = Pokemon::find($id);
        View::make('suunnitelmat/laji/laji_edit.html', array('attributes' => $poke));
    }

    // Pokémon-lajin tietojen muuttaminen lomakkeen lähettämisen aikana
    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
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
            $poke->update();
            Redirect::to('/laji/' . $poke->id, array('message' => 'Pokémon-lajin tietoja on onnistuneesti muokattu!'));
        } else {
            // Parametrit eivät kunnossa -> Ei tallenneta Pokémonia tietokantaan
            View::make('suunnitelmat/laji/laji_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    // Poistetaan Pokémon-laji
    public static function destroy($id){
        $poke = new Pokemon(array('id' => $id));
        $poke->destroy();
        Redirect::to('/laji', array('message' => 'Pokémon-laji on poistettu tietokannasta onnistuneesti.'));
    }
}
