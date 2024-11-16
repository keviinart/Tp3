<?php
require_once('model.php');

class EquiposModel extends Model
{
    //Función que pide a la DB todos los equipos
    public function getEquipos()
    {
        $pdo = $this->createConnection();

        $sql = "select * from equipo";
        $query = $pdo->prepare($sql);
        $query->execute();

        $equipos = $query->fetchAll(PDO::FETCH_OBJ);
        return $equipos;
    }

    //Función que trae un equipo por id
    public function getEquipo($id_equipo)
    {
        $pdo = $this->createConnection();

        $sql = "SELECT * FROM equipo
        WHERE id_equipo = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_equipo]);

        $equipo = $query->fetch(PDO::FETCH_OBJ);

        return $equipo;
    }

    //Función para borrar un equipo de la DB
    public function deleteEquipo($id_equipo)
    {
        $pDO = $this->createConnection();

        $sql = 'DELETE FROM jugador
                WHERE nombre_equipo = (SELECT nombre_equipo FROM equipo WHERE id_equipo = ?)';

        $sql2 = 'DELETE FROM equipo
                WHERE id_equipo = ?';

        $query = $pDO->prepare($sql);
        $query2 = $pDO->prepare($sql2);
        try {
            $query->execute([$id_equipo]);
            $query2->execute([$id_equipo]);
        } catch (\Throwable $th) {
            return null;
        }

    }
    //Función para modificar un jugador de la DB
    public function updateEquipo($nombre_equipo, $ciudad, $year_fundado, $biografia, $imagen_url, $id)
    {
        $sql = 'UPDATE equipo
                    SET nombre_equipo = ?, ciudad = ?, year_fundado = ?, biografia = ?, imagen_url = ?
                    WHERE id_equipo = ?';

        $query = $this->createConnection()->prepare($sql);
        $query->execute([$nombre_equipo, $ciudad, $year_fundado, $biografia, $imagen_url, $id]);

    }

    public function createEquipo($nombre_equipo, $ciudad, $year_fundado, $biografia, $imagen_url)
    {
        $pDO = $this->createConnection();

        $sql = 'INSERT INTO equipo ( nombre_equipo, ciudad,year_fundado, biografia, imagen_url ) 
                VALUES (?, ?, ?, ?, ?)';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$nombre_equipo, $ciudad, $year_fundado, $biografia, $imagen_url]);
        } catch (\Throwable $th) {
            echo $th;
            die(__FILE__);
        }
    }

}