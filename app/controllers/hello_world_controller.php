<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on kotisivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        View::make('helloworld.html');
        }
        
    public static function game_list(){
        View::make('suunnitelmat/game_list.html');
    }
    
    public static function game_show(){
        View::make('suunnitelmat/game_show.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function edit(){
        View::make('suunnitelmat/edit.html');
    }
  }
