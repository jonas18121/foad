<?php

class EleveModel
{
    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
    }

    /**
     * select tous les eleves
     */
    public function get_all_eleve()
    {
        $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve";
        $all_eleve = $this->bdd->prepare($sql);
        $all_eleve->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        $all_eleve->execute();
        $all_eleves = $all_eleve->fetchAll();
        return $all_eleves;
    }
    
    
    /**
     * compter le nombre d'eleve dans une classe
     */
    public function count_nb_eleve()
    {
        $sql = "SELECT COUNT(id) AS nb_eleve FROM eleve";
        $count_eleve = $this->bdd->prepare($sql);
        $count_eleve->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
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
        $moyenne_classe->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        $moyenne_classe->execute();
        $moyenne_classe = $moyenne_classe->fetch();
        return $moyenne_classe;
    }

    /**
     * Ajouter un eleve
     */
    public function add_eleve($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation)
    {
        $sql = "INSERT INTO eleve (id, nom, prenom, date_naissance, moyenne, appreciation) VALUES (:id, :nom, :prenom, :date_naissance, :moyenne, :appreciation)";
        $add_eleve = $this->bdd->prepare($sql);
        $add_eleve->execute([
            ':id'               => $id, 
            ':nom'              => $nom, 
            ':prenom'           => $prenom, 
            ':date_naissance'   => $date_naissance,
            ':moyenne'          => $moyenne, 
            ':appreciation'     => $appreciation
        ]);
    }

    /**
     * modifier un eleve
     */
    public function update_eleve($nom, $prenom, $date_naissance, $moyenne, $appreciation, $id)
    {
        $sql = "UPDATE eleve SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, moyenne = :moyenne, appreciation = :appreciation WHERE id = :id"; 
                            
        $update_eleve = $this->bdd->prepare($sql);
        $update_eleve->execute([
            ':id'               => $id, 
            ':nom'              => $nom, 
            ':prenom'           => $prenom, 
            ':date_naissance'   => $date_naissance,
            ':moyenne'          => $moyenne, 
            ':appreciation'     => $appreciation
        ]);
    }

    /**
     * selectionner un eleve
     */
    public function get_one_eleve($id)
    {
        $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve WHERE id = :id";
        $eleve = $this->bdd->prepare($sql);
        $eleve->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        $eleve->execute([':id' => $id]);
        $one_eleve = $eleve->fetch();

        return $one_eleve;
    }

    /**
     * supprime un eleve
     */
    public function delete_eleve($id)
    {
        $sql = "DELETE FROM eleve WHERE id = :id";
        $delete_eleve = $this->bdd->prepare($sql);
        $delete_eleve->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        $delete_eleve->execute([ 'id' => $id ]);
    }
}