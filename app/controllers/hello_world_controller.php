<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on kotisivu!';
        View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        View::make('helloworld.html');
        }
        
    public static function poke_list(){
        View::make('suunnitelmat/poke_list.html');
    }
    
    public static function poke_show(){
        View::make('suunnitelmat/poke_show.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function poke_edit(){
        View::make('suunnitelmat/poke_edit.html');
    }
    
    public static function kouluttaja_list(){
        View::make('suunnitelmat/kouluttaja_list.html');
    }
    
    public static function kouluttaja_show(){
        View::make('suunnitelmat/kouluttaja_show.html');
    }

    public static function kouluttaja_edit(){
        View::make('suunnitelmat/kouluttaja_edit.html');
    }

    public static function liiga_list(){
        View::make('suunnitelmat/liiga_list.html');
    }

    public static function liiga_show(){
        View::make('suunnitelmat/liiga_show.html');
    }

    public static function liiga_edit(){
        View::make('suunnitelmat/liiga_edit.html');
    }
    
    public static function laji_list(){
        View::make('suunnitelmat/laji_list.html');
    }

    public static function laji_show(){
        View::make('suunnitelmat/laji_show.html');
    }

    public static function laji_edit(){
        View::make('suunnitelmat/laji_edit.html');
    }

  }
