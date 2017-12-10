<?php

class JasenyysController extends BaseController {

    // Näyttää kaikki jäsenyydet
    public static function index() {
        $kaikki = Jasenyys::all();
        $lkm = count($kaikki);
        View::make('suunnitelmat/liiga/jasenyydet.html', array('kaikki' => $kaikki, 'lkm' => $lkm));
    }

    // Palauttaa kaikki tietyn liigan jäsenyydet
    public static function showByLiiga($nimi) {
        $kaikki = Jasenyys::findByLiiga($nimi);
        View::make('suunnitelmat/liiga/jasenyydet.html', array('kaikki' => $kaikki));
    }

    // Palauttaa kaikki tietyn käyttäjän jäsenyydet
    public static function showByJasen($jasen) {
        $kaikki = Jasenyys::findByJasen($jasen);
        View::make('suunnitelmat/liiga/jasenyydet.html', array('kaikki' => $kaikki));
    }

    // Tallentaa tietokantaan uuden jäsenyyden
    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'jasen' => $params['jasen']
        );
        $exjasenyys = Jasenyys::find($params['nimi'], $params['jasen']);
        $jasenyys = new Jasenyys($attributes);
        if ($exjasenyys) {
            Redirect::to('/liiga/' . $jasenyys->nimi, array('error' => 'Olet jo liigan jäsen! Et voi liittyä uudestaan.'));
        }
        $jasenyys->save();
        Redirect::to('/liiga/' . $jasenyys->nimi, array('message' => 'Olet liittynyt liigaan onnistuneesti!'));
    }

    // Jäsenyyden poistaminen tietokannasta
    public static function destroy() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'jasen' => $params['jasen']
        );
//        $jasenyys = new Jasenyys(array('nimi' => $nimi, 'jasen' => $jasen));
        $jasenyys = new Jasenyys($attributes);
        $jasenyys->destroy();
        Redirect::to('/liiga/' . $params['nimi'], array('message' => 'Olet poistanut jäsenyytesi liigasta.'));
    }

}
