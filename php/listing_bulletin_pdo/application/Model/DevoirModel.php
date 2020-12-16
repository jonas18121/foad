<?php

class DevoirModel extends Model
{

    /**
     * voir tous les devoirs
     */
    public function get_all_devoir()
    {
        $sql = "SELECT * FROM devoir";
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Devoir::class);
        $stmt->execute();
        $all_devoirs = $stmt->fetchAll();
        return $all_devoirs;
    }

}