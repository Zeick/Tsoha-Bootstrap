<?php

class OmaPokemon extends BaseModel {

    public $atk, $def, $speed, $spatk, $spdef, $hp, $lvl, $sukupuoli, $lempinimi, $esine, $pid, $kid;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    // Listaa kaikki OmaPokémonit, eli yksilöt
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM OmaPokemon');
        $query->execute();
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach ($rows as $row) {
            $kaikki[] = new OmaPokemon(array(
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
                'pid' => $row['pid'],
                'kid' => $row['kid']
            ));
        }
        return $kaikki;
    }

}
