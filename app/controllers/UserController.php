<?php

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $user = User::authenticate($params['username'], $params['password']);
        if (!$user) {
            View::make('suunnitelmat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->nimi;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->nimi));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet nyt kirjautunut ulos PokéKannasta.'));
    }

    // Näyttää kaikki käyttäjät
    public static function index() {
        $kaikki = User::all();
        $lkm = count($kaikki);
        View::make('suunnitelmat/kouluttaja/kouluttaja_list.html', array('kaikki' => $kaikki, 'lkm' => $lkm));
    }

    // Näyttää yksittäisen käyttäjän Pokémonit ja liigat
    public static function show($nimi) {
        $kouluttaja = User::find($nimi);
        $poket = OmaPokemon::findByTrainer($nimi);
        // Tähän käyttäjän liigojen haku!
        View::make('suunnitelmat/kouluttaja/kouluttaja_show.html', array('poket' => $poket, 'kouluttaja' => $kouluttaja));
    }

    // Käyttäjän rerkisteröitymissivun generoiminen
    public static function newKouluttaja() {
        View::make('suunnitelmat/kouluttaja/kouluttaja_new.html');
    }

    // Uuden käyttäjän tallentaminen tietokantaan
    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'salasana' => $params['salasana']
        );
        $kouluttaja = new User($attributes);
        $errors = $kouluttaja->errors();
        if (count($errors) == 0) {
            $kouluttaja->save();
            Redirect::to('/login', array('message' => 'Olet rekisteröitynyt onnistuneesti PokéKantaan. Voit nyt kirjautua sisään!'));
        } else {
            View::make('suunnitelmat/kouluttaja/kouluttaja_new.html');
        }
    }

    // Käyttäjän poistaminen tietokannasta
    public static function destroy($nimi){
        self::check_logged_in();
        $kouluttaja = new User(array('nimi' => $nimi));
        $kouluttaja->destroy();
        Redirect::to('/kouluttaja', array('message' => 'Tunnus poistettu PokéKannasta.'));
    }
    
    // Käyttäjän salasanan vaihtamislomakkeen luominen.
    // TODO: Ehkä voi myös vaihtaa lempipokemoniaan
    public static function edit($nimi){
        self::check_logged_in();
        $kouluttaja = User::find($nimi);
        View::make('suunnitelmat/kouluttaja/kouluttaja_edit.html', array('attributes' => $kouluttaja));
    }
    
    // TODO: Käyttäjän tietojen päivittäminen
    public static function update($nimi){
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $nimi,
            'salasana' => $params['salasana'],
            'kuvaus' => $params['kuvaus']
        );
        $kouluttaja = new User($attributes);
        $errors = $kouluttaja->errors();
        if(count($errors) == 0){
            $kouluttaja->update();
            Redirect::to('/kouluttaja/' . $kouluttaja->nimi, array('message' => 'Olet päivittänyt tietosi onnistuneesti.'));
        } else {
            View::make('suunnitelmat/kouluttaja/kouluttaja_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
}
