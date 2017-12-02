<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }
    
    public function validate_string_length($string, $length){
        $errors = array();
        if($string == "" || $string == null){
            $errors[] = "Tyhjä nimi on kielletty!";
        }
        if(strlen($string) < $length){
            $errors[] = "Nimen pitää olla vähintään "
                    . $length . " merkkiä pitkä!";
        }
        return $errors;
    }
    
    public function validate_positive_integer($luku){
        $errors = array();
        if(!ctype_digit($luku)){
            $errors[] = "Syötteesi ei ollut positiivinen kokonaisluku!";
        }
        if(ctype_digit($luku) && $luku <= 0){
            $errors[] = "Syötteesi ei ollut positiivinen!";
        }
        return $errors;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      $validator_errors = $this->{$validator}();
      $errors = array_merge($errors, $validator_errors);
      }
      return $errors;
    }

  }
