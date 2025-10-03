<?php
class Csrf {
  public static function token(){
    if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
  }
  public static function field(){
    return '<input type="hidden" name="csrf" value="'.self::token().'">';
  }
}