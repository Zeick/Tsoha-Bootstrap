<?php

class OmaPokemonController extends BaseController {

    // Näyttää kaikki OmaPokémonit
    public static function index() {
        $kaikki = OmaPokemon::all();
        $lajit = Pokemon::all();
        $lkm = count($kaikki);
        View::make('suunnitelmat/poke/poke_list.html', array('kaikki' => $kaikki, 'lkm' => $lkm, 'lajit' => $lajit));
    }

    // Näyttää kaikki tietyn kouluttajan OmaPokémonit
    public static function showByTrainer($kid) {
        $lajit = Pokemon::all();
        $kaikki = OmaPokemon::findByTrainer($kid);
        View::make('suunnitelmat/poke/poke_list.html', array('kaikki' => $kaikki, 'lajit' => $lajit));
    }

    // Näyttää kaikki tietyn lajin OmaPokémonit
    public static function showByPokemon($pid) {
        $lajit = Pokemon::all();
        $kaikki = OmaPokemon::findByPokemon($pid);
        View::make('suunnitelmat/poke/poke_list.html', array('kaikki' => $kaikki, 'lajit' => $lajit));
    }

    // Näyttää yksittäisen OmaPokemonin tiedot
    public static function show($id) {
        $poke = OmaPokemon::find($id);
        $lajinimi = Pokemon::find($poke->pid)->nimi;
        View::make('suunnitelmat/poke/poke_show.html', array('poke' => $poke, 'lajinimi' => $lajinimi));
    }

    // Uuden OmaPokémonin luomislomakesivun generoiminen
    public static function newPokemon() {
        self::check_logged_in();
        $kouluttajat = User::all();
        $lajit = Pokemon::all();
        View::make('suunnitelmat/poke/poke_new.html', array('kouluttajat' => $kouluttajat, 'lajit' => $lajit));
    }

    // Uuden OmaPokémonin tallentaminen tietokantaan
    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'atk' => $params['atk'],
            'def' => $params['def'],
            'speed' => $params['speed'],
            'spatk' => $params['spatk'],
            'spdef' => $params['spdef'],
            'hp' => $params['hp'],
            'lvl' => $params['lvl'],
            'sukupuoli' => $params['sukupuoli'],
            'lempinimi' => $params['lempinimi'],
            'esine' => $params['esine'],
            'kuvaus' => $params['kuvaus'],
            'pid' => $params['pid'],
            'kid' => $params['kid']
        );
        $poke = new OmaPokemon($attributes);
        $errors = $poke->errors();
        if (count($errors) == 0) {
            $poke->save();
            Redirect::to('/poke/' . $poke->id, array('message' => 'Oma Pokémon on lisätty onnistuneesti tietokantaan!'));
        } else {
            $kouluttajat = User::all();
            $lajit = Pokemon::all();
            View::make('suunnitelmat/poke/poke_new.html', array('errors' => $errors, 'attributes' => $attributes, 'kouluttajat' => $kouluttajat, 'lajit' => $lajit));
        }
    }

    // Olemassaolevan OmaPokémonin tietojen muuttamislomakkeen luominen
    public static function edit($id) {
        self::check_logged_in();
        $kouluttajat = User::all();
        $lajit = Pokemon::all();
        $poke = OmaPokemon::find($id);
        View::make('suunnitelmat/poke/poke_edit.html', array('attributes' => $poke,
            'kouluttajat' => $kouluttajat, 'lajit' => $lajit));
    }

    // Lomakkeen tietojen käyttäminen: OmaPokémonin päivitys.
    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'atk' => $params['atk'],
            'def' => $params['def'],
            'speed' => $params['speed'],
            'spatk' => $params['spatk'],
            'spdef' => $params['spdef'],
            'hp' => $params['hp'],
            'lvl' => $params['lvl'],
            'sukupuoli' => $params['sukupuoli'],
            'lempinimi' => $params['lempinimi'],
            'esine' => $params['esine'],
            'kuvaus' => $params['kuvaus'],
            'pid' => $params['pid'],
            'kid' => $params['kid']
        );
        $poke = new OmaPokemon($attributes);
        $errors = $poke->errors();
        if (count($errors) == 0) {
            $poke->update();
            Redirect::to('/poke/' . $poke->id, array('message' => 'Oman Pokémonisi tietoja on nyt muokattu.'));
        } else {
            $kouluttajat = User::all();
            $lajit = Pokemon::all();
            View::make('suunnitelmat/poke/poke_edit.html', array('errors' => $errors, 'attributes' => $attributes, 'kouluttajat' => $kouluttajat, 'lajit' => $lajit));
        }
    }

    // Poistetaan oma Pokémon tietokannasta
    public static function destroy($id) {
        self::check_logged_in();
        $poke = new OmaPokemon(array('id' => $id));
        $poke->destroy();
        Redirect::to('/poke', array('message' => 'Olet onnistuneesti poistanut oman Pokémonisi tietokannasta.'));
    }

}
