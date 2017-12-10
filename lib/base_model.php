<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    // Tietokannassa dbname ei saa olla dbcol-sarakkeessa kahta samannimistä solua
    public function validate_same_name($dbname, $dbcol, $objectname) {
        $queryString = 'SELECT * FROM ' . $dbname . ' WHERE ' . $dbcol . ' = :objectname' . ' LIMIT 1';
        $errors = array();
        $query = DB::connection()->prepare($queryString);
        $query->execute(array(
            'objectname' => $objectname
        ));
        $row = $query->fetch();
        if ($row) {
            $errors[] = "Tietokannassa on jo käytössä tunnus " . $objectname . "! Keksi uusi tunnus. Jo käytössä olevat tunnukset näet listaussivulta.";
        }
        return $errors;
    }

/*    public function validate_username($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM User WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        $errors = array();
        if ($row) {
            $errors[] = "Käyttäjätunnus " . $objectname . " on jo käytössä! Keksi uusi tunnus. Jo käytössä olevat tunnukset näet listaussivulta.";
        }
        return $errors;
    } */

    public function validate_string_length($string, $length) {
        $errors = array();
        if ($string == "" || $string == null) {
            $errors[] = "Tyhjä syöte on kielletty!";
        }
        if (strlen($string) < $length) {
            $errors[] = "Syötteen pitää olla vähintään "
                    . $length . " merkkiä pitkä!";
        }
        return $errors;
    }

    public function validate_string_maxlength($string, $minlen, $maxlen) {
        $errors = array();
        if ($string == "" || $string == null) {
            $errors[] = "Tyhjä syöte on kielletty!";
        }
        if (strlen($string) < $minlen) {
            $errors[] = "Syötteen pitää olla vähintään "
                    . $minlen . " merkkiä pitkä!";
        }
        if (strlen($string) > $maxlen) {
            $errors[] = "Syötteen pitää olla korkeintaan "
                    . $maxlen . " merkkiä pitkä!";
        }
        return $errors;
    }

    public function validate_positive_integer($luku) {
        $errors = array();
        if (!ctype_digit($luku)) {
            $errors[] = "Syötteesi ei ollut positiivinen kokonaisluku!";
        }
        if (ctype_digit($luku) && $luku <= 0) {
            $errors[] = "Syötteesi ei ollut positiivinen!";
        }
        return $errors;
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }
        return $errors;
    }

}
