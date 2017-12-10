<?php

class HelloWorldController extends BaseController {

    // Etusivun generointi
    public static function index() {
        View::make('home.html');
    }

    // Koodin testausta varten
    public static function sandbox() {
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

}
