<?php

class Jasenyys extends BaseModel {

    public $jasen, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    // Listaa kaikki jäsenyydet
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Jasenyys');
        $query->execute();
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new Jasenyys(array(
                'nimi' => $row['nimi'],
                'jasen' => $row['jasen']
            ));
        }
        return $kaikki;
    }

    // Tarkistetaan onko jäsenyys jo olemassa, ja jos on, palautetaan se
    public static function find($nimi, $jasen) {
        $query = DB::connection()->prepare('SELECT * FROM Jasenyys '
                . 'WHERE nimi = :nimi AND jasen = :jasen LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'jasen' => $jasen));
        $row = $query->fetch();
        if ($row) {
            return $row;
        }
        return null;
    }

    // Palauttaa kaikki tietyn liigan jäsenyydet
    public static function findByLiiga($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Jasenyys WHERE nimi = :nimi');
        $query->execute(array('nimi' => $nimi));
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new Jasenyys(array(
                'nimi' => $row['nimi'],
                'jasen' => $row['jasen']
            ));
        }
        return $kaikki;
    }

    // Palauttaa kaikki tietyn käyttäjän jäsenyydet
    public static function findByJasen($jasen) {
        $query = DB::connection()->prepare('SELECT * FROM Jasenyys WHERE jasen = :jasen');
        $query->execute(array('jasen' => $jasen));
        $rows = $query->fetchAll();
        $kaikki = array();
        if ($rows and $row) {
            $kaikki[] = new Jasenyys(array(
                'nimi' => $row['nimi'],
                'jasen' => $row['jasen']
            ));
        }
        return $kaikki;
    }

    // Lisää yhden jäsenyyden tietokantaan
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Jasenyys (nimi, jasen) '
                . 'VALUES (:nimi, :jasen)');
        $query->execute(array(
            'nimi' => $this->nimi,
            'jasen' => $this->jasen
        ));
    }

    // Poistaa jäsenyyden tietokannasta
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Jasenyys WHERE nimi = :nimi AND jasen = :jasen');
        $query->execute(array('nimi' => $this->nimi, 'jasen' => $this->jasen));
    }

}
