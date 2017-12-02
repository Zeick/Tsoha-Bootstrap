<?php

class User extends BaseModel {

    public $nimi, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kouluttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kouluttajat = array();
        foreach($rows as $row){
            $kouluttajat[] = new User(array(
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
        }
        return $kouluttajat;
    }
    
    public static function find($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kouluttaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if ($row) {
            $kouluttaja = new User(array('nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $kouluttaja;
        }
        return null;
    }
    
    public static function authenticate($nimi, $salasana){
        $query = DB::connection()->prepare('SELECT * FROM Kouluttaja '
                . 'WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if($row){
            $user = new User(array('nimi' => $row['nimi'],
                'salasana' => $row['salasana']));
            return $user;
        } else{
            return null;
        }
            
    }
}