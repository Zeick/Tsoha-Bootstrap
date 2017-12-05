<?php

class Liiga extends BaseModel {
    public $nimi, $johtaja;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    // Listaa kaikki liigat
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Liiga');
        $query->execute();
        $rows = $query->fetchAll();
        $kaikki = array();
        foreach($rows as $row){
            $kaikki[] = new Liiga(array(
                'nimi' => $row['nimi'],
                'johtaja' => $row['johtaja']
            ));
        }
        return $kaikki;
    }
    
    // Hakee yhden liigan tietokannasta
    public static function find($nimi){
        $query = DB::connection()->prepare('SELECT * FROM Liiga WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if($row){
            $liiga = new Liiga(array(
                'nimi' => $row['nimi'],
                'johtaja' => $row['johtaja']
            ));
            return $liiga;
        }
        return null;
    }
    
    // Tallentaa liigan tietokantaan
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Liiga (nimi, johtaja) '
                . 'VALUES (:nimi, :johtaja)');
        $query->execute(array(
            'nimi' => $this->nimi,
            'johtaja' => $this->johtaja
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    // Poistaa liigan tietokannasta
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Liiga WHERE nimi = :nimi');
        $query->execute(array('nimi' => $this->nimi));
    }
}
