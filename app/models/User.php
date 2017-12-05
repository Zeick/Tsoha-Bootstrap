<?php

class User extends BaseModel {

    public $nimi, $salasana, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = ['tarkista_salasana', 'tarkista_nimi'];
    }

    public function tarkista_salasana() {
        return BaseModel::validate_string_maxlength($this->salasana, 1, 20);
    }

    public function tarkista_nimi() {
        return BaseModel::validate_string_maxlength($this->nimi, 1, 20);
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

    // Käyttäjän poistaminen tietokannasta (EI TOIMI VIELÄ!)
    // TODO: Kun käyttäjä poistetaan, on kaikki siihen liittyvät OmaPokemonit poistettava!
    public function destroy() {
        $query0 = DB::connection()->prepare('DELETE FROM OmaPokemon WHERE kid = :kid');
        $query0->execute(array('kid' => $this->nimi));
        $query = DB::connection()->prepare('DELETE FROM Kouluttaja WHERE nimi = :nimi');
        $query->execute(array('nimi' => $this->nimi));
    }

    // TODO: Salasanan vaihtaminen
    public function update() {
        $query = DB::connection()->prepare('UPDATE Kouluttaja SET '
                . 'salasana = :salasana, kuvaus = :kuvaus WHERE nimi = :nimi');
        $query->execute(array('salasana' => $this->salasana,
            'kuvaus' => $this->kuvaus,
            'nimi' => $this->nimi));
    }

}
