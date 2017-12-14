<?php

class Liiga extends BaseModel {

    public $nimi, $johtaja, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = ['tarkista_nimi', 'onko_samanniminen_olemassa'];
    }

    public function tarkista_nimi() {
        return BaseModel::validate_string_maxlength($this->nimi, 1, 20);
    }

    public function onko_samanniminen_olemassa() {
        return BaseModel::validate_same_name('Liiga', 'nimi', $this->nimi);
    }

    // Listaa kaikki liigat
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Liiga');
        $query->execute();
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new Liiga(array(
                'nimi' => $row['nimi'],
                'johtaja' => $row['johtaja'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $kaikki;
    }

    // Hakee yhden liigan tietokannasta
    public static function find($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Liiga WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if ($row) {
            $liiga = new Liiga(array(
                'nimi' => $row['nimi'],
                'johtaja' => $row['johtaja'],
                'kuvaus' => $row['kuvaus']
            ));
            return $liiga;
        }
        return null;
    }

    // Palauttaa liigat, joissa kouluttaja $nimi on johtajana
    public static function findByJohtaja($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Liiga WHERE johtaja = :nimi');
        $query->execute(array('nimi' => $nimi));
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new Liiga(array(
                'nimi' => $row['nimi'],
                'johtaja' => $row['johtaja']
            ));
        }
        return $kaikki;
    }

    // Palauttaa liigat, joissa kouluttaja $nimi on jäsenenä
    public static function findByTrainer($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Jasenyys WHERE jasen = :nimi');
        $query->execute(array('nimi' => $nimi));
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = Liiga::find($row['nimi']);
        }
        return $kaikki;
    }

    // Tallentaa liigan tietokantaan
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Liiga (nimi, johtaja, kuvaus) '
                . 'VALUES (:nimi, :johtaja, :kuvaus)');
        $query->execute(array(
            'nimi' => $this->nimi,
            'johtaja' => $this->johtaja,
            'kuvaus' => $this->kuvaus
        ));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Liiga SET '
                . 'kuvaus = :kuvaus, johtaja = :johtaja WHERE nimi = :nimi');
        $query->execute(array(
            'nimi' => $this->nimi,
            'kuvaus' => $this->kuvaus,
            'johtaja' => $this->johtaja
        ));
    }

    // Poistaa liigan tietokannasta
    // Kun liiga poistetaan, on kaikki siihen liittyvät jäsenyydet poistettava!
    public function destroy() {
        $query0 = DB::connection()->prepare('DELETE FROM Jasenyys WHERE nimi = :nimi');
        $query0->execute(array('nimi' => $this->nimi));
        $query = DB::connection()->prepare('DELETE FROM Liiga WHERE nimi = :nimi');
        $query->execute(array('nimi' => $this->nimi));
    }

}
