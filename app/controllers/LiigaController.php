<?php

class LiigaController extends BaseController {

    // Näyttää kaikki liigat
    public static function index() {
        $kaikki = Liiga::all();
        $lkm = count($kaikki);
        View::make('suunnitelmat/liiga/liiga_list.html', array('kaikki' => $kaikki, 'lkm' => $lkm));
    }

    // Näyttää yksittäisen liigan tiedot
    public static function show($nimi) {
        self::check_logged_in();
        $liiga = Liiga::find($nimi);
        // Liigan kaikkien jäsenten lista ja lukumäärä
        $jasenet = Jasenyys::findByLiiga($nimi);
        $lkm = count($jasenet);
        // Sivustoa käyttävän käyttäjän tiedot
        $kayttaja = BaseController::get_user_logged_in();
        // Tarkistetaan onko käyttäjä jo jäsen
        $onjasen = Jasenyys::find($nimi, $kayttaja->nimi);
        // Liigan kaikki jäsenet
        View::make('suunnitelmat/liiga/liiga_show.html', 
                array('liiga' => $liiga, 'jasenet' => $jasenet, 'lkm' => $lkm, 'onjasen' => $onjasen));
    }

    // Uuden liigan luomislomakesivun generoiminen
    public static function newLiiga() {
        self::check_logged_in();
        View::make('suunnitelmat/liiga/liiga_new.html');
    }

    // Uuden liigan tallentaminen tietokantaan
    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'johtaja' => $params['johtaja']
        );
        $liiga = new Liiga($attributes);
        $errors = $liiga->errors();
        if (count($errors) == 0) {
            $liiga->save();
            Redirect::to('/liiga/' . $liiga->nimi, array('message' => 'Uusi liiga on lisätty tietokantaan!'));
        } else {
            View::make('suunnitelmat/liiga/liiga_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    // Liigan poistaminen tietokannasta
    public static function destroy($nimi){
        self::check_logged_in();
        $liiga = new Liiga(array('nimi' => $nimi));
        $liiga->destroy();
        Redirect::to('/liiga', array('message' => 'Olet onnistuneesti poistanut liigan tietokannasta!'));
    }
    
    // TODO: Liigan tietojen muuttamislomakkeen luominen
    public static function edit($nimi){
        
    }
    
    // TODO: Liigan tietojen päivitys
    public static function update($nimi){
        
    }

}
