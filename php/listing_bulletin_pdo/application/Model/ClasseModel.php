<?php

class ClasseModel extends Model
{

    /**
     * compter le nombre d'eleve dans une classe
     */
    public function count_nb_eleve()
    {
        $sql = "SELECT COUNT(id) AS nb_eleve FROM eleve";
        $count_eleve = $this->bdd->prepare($sql);
        $count_eleve->setFetchMode(PDO::FETCH_CLASS, Classe::class);
        $count_eleve->execute();
        $count_eleve = $count_eleve->fetch();
        return $count_eleve;
    }

    /**
     * calculer la moyenne de la classe
     */
    public function calc_classe_sum()
    {
        $sql = "SELECT ROUND(SUM(moyenne)/COUNT(id)) AS moyenne_classe FROM eleve";
        $moyenne_classe = $this->bdd->query($sql);
        $moyenne_classe->setFetchMode(PDO::FETCH_CLASS, Classe::class);
        $moyenne_classe->execute();
        $moyenne_classe = $moyenne_classe->fetch();
        return $moyenne_classe;
    }
}