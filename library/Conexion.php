<?php
class Conexion {
  private static $instancia = null;
  public static function getConexion(){
    if(self::$instancia === null){
      $dsn = "mysql:host=".BD_HOST.";dbname=".BD_NAME.";charset=".BD_CHARSET;
      try{
        self::$instancia = new PDO($dsn, BD_USER, BD_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
      }catch(PDOException $e){
        die("Error de conexión: ".$e->getMessage());
      }
    }
    return self::$instancia;
  }
}