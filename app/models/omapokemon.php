<?php

class OmaPokemon extends BaseModel {

    public $id, $atk, $def, $speed, $spatk, $spdef, $hp, $lvl, $sukupuoli, $lempinimi, $esine, $kuvaus, $pid, $kid;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = ['tarkista_lempinimen_pituus', 'tarkista_sukupuoli', 'tarkista_atk', 'tarkista_def',
            'tarkista_speed', 'tarkista_spatk', 'tarkista_spdef', 'tarkista_hp', 'tarkista_lvl'];
    }

    public function tarkista_lempinimen_pituus() {
        return BaseModel::validate_string_length($this->lempinimi, 1);
    }

    public function tarkista_sukupuoli() {
        $errors = array();
        if ($this->sukupuoli == 'U' || $this->sukupuoli == 'N' || $this->sukupuoli == 'E') {
            return $errors;
        } else {
            $errors[] = "Sukupuoli on joko U (uros), N (naaras) tai E (ei tiedossa)!";
        }
        return $errors;
    }

    public function tarkista_atk() {
        return BaseModel::validate_positive_integer($this->atk);
    }

    public function tarkista_def() {
        return BaseModel::validate_positive_integer($this->def);
    }

    public function tarkista_speed() {
        return BaseModel::validate_positive_integer($this->speed);
    }

    public function tarkista_spatk() {
        return BaseModel::validate_positive_integer($this->spatk);
    }

    public function tarkista_spdef() {
        return BaseModel::validate_positive_integer($this->spdef);
    }

    public function tarkista_hp() {
        return BaseModel::validate_positive_integer($this->hp);
    }

    public function tarkista_lvl() {
        return BaseModel::validate_positive_integer($this->lvl);
    }

    // Listaa kaikki OmaPokémonit, eli yksilöt
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM OmaPokemon');
        $query->execute();
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new OmaPokemon(array(
                'id' => $row['id'],
                'atk' => $row['atk'],
                'def' => $row['def'],
                'speed' => $row['speed'],
                'spatk' => $row['spatk'],
                'spdef' => $row['spdef'],
                'hp' => $row['hp'],
                'lvl' => $row['lvl'],
                'sukupuoli' => $row['sukupuoli'],
                'lempinimi' => $row['lempinimi'],
                'esine' => $row['esine'],
                'kuvaus' => $row['kuvaus'],
                'pid' => $row['pid'],
                'kid' => $row['kid']
            ));
        }
        return $kaikki;
    }

    // Listaa kaikki tietyn kouluttajan OmaPokemonit
    public static function findByTrainer($kid) {
        $query = DB::connection()->prepare('SELECT * FROM OmaPokemon WHERE kid = :kid');
        $query->execute(array('kid' => $kid));
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new OmaPokemon(array(
                'id' => $row['id'],
                'atk' => $row['atk'],
                'def' => $row['def'],
                'speed' => $row['speed'],
                'spatk' => $row['spatk'],
                'spdef' => $row['spdef'],
                'hp' => $row['hp'],
                'lvl' => $row['lvl'],
                'sukupuoli' => $row['sukupuoli'],
                'lempinimi' => $row['lempinimi'],
                'esine' => $row['esine'],
                'kuvaus' => $row['kuvaus'],
                'pid' => $row['pid'],
                'kid' => $row['kid']
            ));
        }
        return $kaikki;
    }

    // Listaa kaikki tietyn lajin OmaPokemonit
    public static function findByPokemon($pid) {
        $query = DB::connection()->prepare('SELECT * FROM OmaPokemon WHERE pid = :pid');
        $query->execute(array('pid' => $pid));
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new OmaPokemon(array(
                'id' => $row['id'],
                'atk' => $row['atk'],
                'def' => $row['def'],
                'speed' => $row['speed'],
                'spatk' => $row['spatk'],
                'spdef' => $row['spdef'],
                'hp' => $row['hp'],
                'lvl' => $row['lvl'],
                'sukupuoli' => $row['sukupuoli'],
                'lempinimi' => $row['lempinimi'],
                'esine' => $row['esine'],
                'kuvaus' => $row['kuvaus'],
                'pid' => $row['pid'],
                'kid' => $row['kid']
            ));
        }
        return $kaikki;
    }

    // Hakee yhden OmaPokemonin tietokannasta
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM OmaPokemon WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $poke = new OmaPokemon(array(
                'id' => $row['id'],
                'atk' => $row['atk'],
                'def' => $row['def'],
                'speed' => $row['speed'],
                'spatk' => $row['spatk'],
                'spdef' => $row['spdef'],
                'hp' => $row['hp'],
                'lvl' => $row['lvl'],
                'sukupuoli' => $row['sukupuoli'],
                'lempinimi' => $row['lempinimi'],
                'esine' => $row['esine'],
                'kuvaus' => $row['kuvaus'],
                'pid' => $row['pid'],
                'kid' => $row['kid']
            ));
            return $poke;
        }
        return null;
    }

    // Tallentaa OmaPokemonin tietokantaan
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO OmaPokemon (atk, def, speed, spatk, spdef, hp, lvl, sukupuoli, lempinimi, esine, kuvaus, kid, pid) '
                . 'VALUES (:atk, :def, :speed, :spatk, :spdef, :hp, :lvl, :sukupuoli, :lempinimi, :esine, :kuvaus, :kid, :pid) RETURNING id');
        $query->execute(array(
            'atk' => $this->atk,
            'def' => $this->def,
            'speed' => $this->speed,
            'spatk' => $this->spatk,
            'spdef' => $this->spdef,
            'hp' => $this->hp,
            'lvl' => $this->lvl,
            'sukupuoli' => $this->sukupuoli,
            'lempinimi' => $this->lempinimi,
            'esine' => $this->esine,
            'kuvaus' => $this->kuvaus,
            'pid' => $this->pid,
            'kid' => $this->kid
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    // Päivittää olemassaolevan OmaPokemonin tietokantaan
    public function update() {
        $query = DB::connection()->prepare('UPDATE OmaPokemon SET '
                . 'atk = :atk, def = :def, speed = :speed, spatk = :spatk, spdef = :spdef, hp = :hp, lvl = :lvl, '
                . 'sukupuoli = :sukupuoli, lempinimi = :lempinimi, esine = :esine, kuvaus = :kuvaus, kid = :kid, pid = :pid '
                . 'WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'atk' => $this->atk,
            'def' => $this->def,
            'speed' => $this->speed,
            'spatk' => $this->spatk,
            'spdef' => $this->spdef,
            'hp' => $this->hp,
            'lvl' => $this->lvl,
            'sukupuoli' => $this->sukupuoli,
            'lempinimi' => $this->lempinimi,
            'esine' => $this->esine,
            'kuvaus' => $this->kuvaus,
            'pid' => $this->pid,
            'kid' => $this->kid
        ));
    }

    // Poistaa olemassaolevan OmaPokemonin tietokannasta
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM OmaPokemon '
                . 'WHERE id = :id');
        $query->execute(array(
            'id' => $this->id
        ));
    }

}
