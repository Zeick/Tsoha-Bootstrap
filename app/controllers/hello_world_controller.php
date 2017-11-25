<?php

//require 'app/models/pokemon.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on kotisivu!';
        View::make('home.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        //View::make('helloworld.html');
//        $bulba = Pokemon::find(1);
  //      $kaikki = Pokemon::all();
    //    Kint::dump($kaikki);
      //  Kint::dump($bulba);
        $voltti = new Pokemon(array(
            'id' => 100,
            'nimi' => 'Voltorb',
            'pituus' => -5,
            'paino' => 10,
            'tunnusluku' => '10',
            'kuvaus' => 'Näyttää pallolta'
        ));
        $errors = $voltti->errors();
        
        Kint::dump($errors);
    }

    public static function poke_list() {
        View::make('suunnitelmat/poke/poke_list.html');
    }

    public static function poke_show() {
        View::make('suunnitelmat/poke/poke_show.html');
    }

    public static function login() {
        View::make('suunnitelmat/poke/login.html');
    }

    public static function poke_edit() {
        View::make('suunnitelmat/poke_edit.html');
    }

    public static function kouluttaja_list() {
        View::make('suunnitelmat/kouluttaja/kouluttaja_list.html');
    }

    public static function kouluttaja_show() {
        View::make('suunnitelmat/kouluttaja/kouluttaja_show.html');
    }

    public static function kouluttaja_edit() {
        View::make('suunnitelmat/kouluttaja/kouluttaja_edit.html');
    }

    public static function liiga_list() {
        View::make('suunnitelmat/liiga/liiga_list.html');
    }

    public static function liiga_show() {
        View::make('suunnitelmat/liiga/liiga_show.html');
    }

    public static function liiga_edit() {
        View::make('suunnitelmat/liiga/liiga_edit.html');
    }

    public static function laji_list() {
        View::make('suunnitelmat/laji/laji_list.html');
    }

    public static function laji_show() {
        View::make('suunnitelmat/laji/laji_show.html');
    }

    public static function laji_edit() {
        View::make('suunnitelmat/laji/laji_edit.html');
    }

}
