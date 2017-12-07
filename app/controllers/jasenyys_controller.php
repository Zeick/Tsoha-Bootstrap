<?php

class JasenyysController extends BaseController{
    // Näyttää kaikki jäsenyydet
    public static function index(){
        $kaikki = Jasenyys::all();
        $lkm = count($kaikki);
        View::make('suunnitelmat/liiga/jasenyydet.html', array('kaikki' => $kaikki, 'lkm' => $lkm));
    }
    
    // Palauttaa kaikki tietyn liigan jäsenyydet
    public static function showByLiiga($nimi){
        $kaikki = Jasenyys::findByLiiga($nimi);
        View::make('suunnitelmat/liiga/jasenyydet.html', array('kaikki' => $kaikki));
    }
    
        // Palauttaa kaikki tietyn käyttäjän jäsenyydet
    public static function showByJasen($jasen){
        $kaikki = Jasenyys::findByJasen($jasen);
        View::make('suunnitelmat/liiga/jasenyydet.html', array('kaikki' => $kaikki));
    }
    
    // Tallentaa tietokantaan uuden jäsenyyden
    public static function store($nimi, $jasen){
        self::check_logged_in();
/*        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'jasen' => $params['jasen']
        ); */
        $attributes = array(
            'nimi' => $nimi,
            'jasen' => $jasen
        );
        $jasenyys = new Jasenyys($attributes);
        $jasenyys->save();
        Redirect::to('/liiga/' . $jasenyys->nimi, array('message' => 'Olet liittynyt liigaan onnistuneesti!'));
    }
    
    // Jäsenyyden poistaminen tietokannasta
    public static function destroy($nimi, $jasen){
        self::check_logged_in();
        $jasenyys = new Jasenyys(array('nimi' => $nimi, 'jasen' => $jasen));
        $jasenyys->destroy();
        Redirect::to('/liiga/' . $nimi, array('message' => 'Olet poistanut jäsenyytesi liigasta.'));
    }
}
