<?php
require_once('model.php');

class JugadorModel extends Model
{

    //Función que trae una player por id
    public function getPlayer($nombre_equipo, $id_jugador)
    {
        $pdo = $this->createConnection();

        $sql = 'SELECT * FROM jugador
        WHERE REPLACE(nombre_equipo, " ", "") = REPLACE(?, " ", "") AND id_jugador = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$nombre_equipo, $id_jugador]);

        $player = $query->fetch(PDO::FETCH_OBJ);

        return $player;
    }
    //Función que pide a la DB todos los jugadores
    public function getPlayers()
    {
        $pdo = $this->createConnection();

        $sql = "SELECT * FROM `jugador` ORDER BY `jugador`.`nombre_equipo` ASC";
        $query = $pdo->prepare($sql);
        $query->execute();

        $jugadores = $query->fetchAll(PDO::FETCH_OBJ);
        return $jugadores;
    }





    //Función para crear un nuevo jugador en la DB
    public function createPlayer($nombre_jugador, $nombre_equipo, $id_jugador, $edad, $posicion, $biografia, $imagen_url)
    {
        $pDO = $this->createConnection();

        $sql = 'INSERT INTO jugador (nombre_jugador, nombre_equipo, id_jugador, edad, posicion, biografia, imagen_url) 
        VALUES (?, ?, ?, ?, ?, ?, ?)';
        $query = $pDO->prepare($sql);
        try {
            $query->execute([$nombre_jugador, $nombre_equipo, $id_jugador, $edad, $posicion, $biografia, $imagen_url]);
        } catch (\Throwable $th) {
            echo $th;
            die(__FILE__);
        }
    }

    //Función para borrar un jugador de la DB
    public function deletePlayer($nombre_equipo, $id_jugador)
    {
        $pDO = $this->createConnection();
        $sql = 'DELETE FROM jugador
         WHERE REPLACE(nombre_equipo, " ", "") = REPLACE(?, " ", "") AND id_jugador = ?';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$nombre_equipo, $id_jugador]);
        } catch (\Throwable $th) {
            print $th;
            die(__FILE__);
        }
    }

    //Función para modificar un jugador de la DB
    public function updatePlayer($nombre_jugador, $nombre_equipo, $id_jugador, $edad, $posicion, $biografia, $imagen_url, $teamWhere, $idWhere)
    {
        $pDO = $this->createConnection();
        $sql = 'UPDATE jugador
            SET nombre_jugador = ?, nombre_equipo = ?, id_jugador = ?, edad = ?, posicion = ?, biografia = ?, imagen_url = ?
            WHERE REPLACE(nombre_equipo, " ", "") = REPLACE(?, " ", "") AND id_jugador = ?';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$nombre_jugador, $nombre_equipo, $id_jugador, $edad, $posicion, $biografia, $imagen_url, $teamWhere, $idWhere]);
        } catch (\Throwable $th) {
            print $th;
            die(__FILE__);
        }
    }
    public function getEquipos()
    {
        $pdo = $this->createConnection();

        $sql = "SELECT * FROM `equipo` ORDER BY `equipo`.`nombre_equipo` ASC ";
        $query = $pdo->prepare($sql);
        $query->execute();

        $equipos = $query->fetchAll(PDO::FETCH_OBJ);

        return $equipos;
    }
}