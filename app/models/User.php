<?php

class User extends BaseModel {

    public $nimi, $salasana, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = ['tarkista_salasana', 'tarkista_nimi', 'onko_samanniminen_olemassa'];
    }

    public function tarkista_salasana() {
        return BaseModel::validate_string_maxlength($this->salasana, 1, 20);
    }

    public function tarkista_nimi() {
        return BaseModel::validate_string_maxlength($this->nimi, 1, 20);
    }

    public function onko_samanniminen_olemassa() {
        return BaseModel::validate_same_name('Kouluttaja', 'nimi', $this->nimi);
//        return BaseModel::validate_username($this->nimi);
    }

    // Palauttaa kaikki käyttäjät
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kouluttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kouluttajat = array();
        foreach ($rows as $row) {
            $kouluttajat[] = new User(array(
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $kouluttajat;
    }

    // Etsii käyttäjän käyttäjätunnuksen perusteella
    public static function find($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kouluttaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if ($row) {
            $kouluttaja = new User(array('nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                'kuvaus' => $row['kuvaus']
            ));
            return $kouluttaja;
        }
        return null;
    }

    // Sisäänkirjautuminen
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kouluttaja '
                . 'WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array('nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                'kuvaus' => $row['kuvaus']));
            return $user;
        } else {
            return null;
        }
    }

    // Uuden tunnuksen rekisteröityminen
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kouluttaja (nimi, salasana) '
                . 'VALUES (:nimi, :salasana)');
        $query->execute(array(
            'nimi' => $this->nimi,
            'salasana' => $this->salasana
        ));
    }

    // Käyttäjän poistaminen tietokannasta
    // Kun käyttäjä poistetaan, on kaikki siihen liittyvät OmaPokemonit poistettava!
    // Lisäksi liigat, joissa käyttäjä on johtajana, sekä niihin liittyvät jäsenyydet.
    public function destroy() {
        // Poistetaan aluksi kaikki käyttäjän OmaPokemonit
        $query0 = DB::connection()->prepare('DELETE FROM OmaPokemon WHERE kid = :kid');
        $query0->execute(array('kid' => $this->nimi));
        // Etsitään sitten kaikkien sellaisten liigojen jäsenyydet, joissa käyttäjä on johtajana
        $query1 = DB::connection()->prepare('DELETE FROM Jasenyys WHERE EXISTS( SELECT * FROM Liiga WHERE Liiga.nimi = Jasenyys.nimi AND Liiga.johtaja = :nimi)');
        $query1->execute(array('nimi' => $this->nimi));
        // Poistetaan sitten käyttäjän omat jäsenyydet
        $query2 = DB::connection()->prepare('DELETE FROM Jasenyys WHERE jasen = :nimi');
        $query2->execute(array('nimi' => $this->nimi));
        // Poistetaan sitten kaikki liigat, joissa käyttäjä on johtajana
        $query3 = DB::connection()->prepare('DELETE FROM Liiga WHERE johtaja = :nimi');
        $query3->execute(array('nimi' => $this->nimi));
        // Lopuksi poistetaan itse käyttäjä
        $query = DB::connection()->prepare('DELETE FROM Kouluttaja WHERE nimi = :nimi');
        $query->execute(array('nimi' => $this->nimi));
    }

    // Käyttäjän tietojen päivittäminen: salasana ja kuvaus
    public function update() {
        $query = DB::connection()->prepare('UPDATE Kouluttaja SET '
                . 'salasana = :salasana, kuvaus = :kuvaus WHERE nimi = :nimi');
        $query->execute(array('salasana' => $this->salasana,
            'kuvaus' => $this->kuvaus,
            'nimi' => $this->nimi));
    }

}
