<?php

class Pokemon extends BaseModel {

    public $id, $nimi, $pituus, $paino, $kuvaus, $tunnusluku;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pokemon');
        $query->execute();
        $rows = $query->fetchAll();
        $pokemonit = array();
        foreach ($rows as $row) {
            $pokemonit[] = new Pokemon(array(
                'id' => $row['id'],
                'tunnusluku' => $row['tunnusluku'],
                'nimi' => $row['nimi'],
                'pituus' => $row['pituus'],
                'paino' => $row['paino'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $pokemonit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Pokemon WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $poke = new Pokemon(array('id' => $row['id'],
                'nimi' => $row['nimi'],
                'pituus' => $row['pituus'],
                'paino' => $row['paino'],
                'kuvaus' => $row['kuvaus'],
                'tunnusluku' => $row['tunnusluku']
            ));
            return $poke;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Pokemon (tunnusluku, nimi, pituus, paino, kuvaus) VALUES (:tunnusluku, :nimi, :pituus, :paino, :kuvaus) RETURNING id');
        $query->execute(array(
            'nimi' => $this->nimi,
            'tunnusluku' => $this->tunnusluku,
            'pituus' => $this->pituus,
            'paino' => $this->paino,
            'kuvaus' => $this->kuvaus
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
        
    }

}