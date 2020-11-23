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
    public function get_all_eleve($res_id = null, $res_nom = null, $res_prenom = null, $res_date_naissance = null, $res_moyenne = null, $res_appreciation = null)
    {
        $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve";
        $all_eleve = $this->bdd->prepare($sql);
        $all_eleve->execute();
        $all_eleve->bind_result($res_id, $res_nom, $res_prenom, $res_date_naissance, $res_moyenne, $res_appreciation);
        while ($all_eleve->fetch() ) {
            $all_eleves[] = Eleve::construct_params($res_id, $res_nom, $res_prenom, $res_date_naissance, $res_moyenne, $res_appreciation);
        } 
        
        return $all_eleves;
    }

    /**
     * compter le nombre d'eleve dans une classe
     */
    public function count_nb_eleve()
    {
        $sql = "SELECT COUNT(id) AS nb_eleve FROM eleve";
        $count_eleve = $this->bdd->query($sql);
        return $count_eleve = $count_eleve->fetch_object('Eleve');
    }

    /**
     * calculer la moyenne de la classe
     */
    public function calc_classe_sum()
    {
        $sql = "SELECT ROUND(SUM(moyenne)/COUNT(id)) AS moyenne_classe FROM eleve";
        $moyenne_classe = $this->bdd->query($sql);
        return $moyenne_classe = $moyenne_classe->fetch_object('Eleve');
    }

    /**
     * Ajouter un eleve
     */
    public function add_eleve($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation)
    {
        $sql = "INSERT INTO eleve (id, nom, prenom, date_naissance, moyenne, appreciation) VALUES (?, ?, ?, ?, ?, ?)";
        $add_eleve = $this->bdd->prepare($sql);
        $add_eleve->bind_param('isssss', $id, $nom, $prenom, $date_naissance, $moyenne, $appreciation);
        $add_eleve->execute();
    }

    /**
     * modifier un eleve
     */
    public function update_eleve($nom, $prenom, $date_naissance, $moyenne, $appreciation, $id)
    {
        $sql = "UPDATE eleve SET nom = ?, prenom = ?, date_naissance = ?, moyenne = ?, appreciation = ? WHERE id = ?"; 
                            
        $update_eleve = $this->bdd->prepare($sql);
        $update_eleve->bind_param("sssssi", $nom, $prenom, $date_naissance, $moyenne, $appreciation, $id);
        $update_eleve->execute();
        $update_eleve->close();
    }

    /**
     * selectionner un eleve
     */
    public function get_one_eleve($id, $res_id = null, $res_nom = null, $res_prenom = null, $res_date_naissance = null, $res_moyenne = null, $res_appreciation = null)
    {
        $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve WHERE id = ?";
        $eleve = $this->bdd->prepare($sql);
        $eleve->bind_param("i", $id);
        $eleve->execute();
        $eleve->bind_result($res_id, $res_nom, $res_prenom, $res_date_naissance, $res_moyenne, $res_appreciation);
        $eleve->fetch();
        $one_eleve = Eleve::construct_params($res_id, $res_nom, $res_prenom, $res_date_naissance, $res_moyenne, $res_appreciation);  

        $eleve->close();

        return $one_eleve;
    }

    /**
     * supprime un eleve
     */
    public function delete_eleve($id)
    {
        $sql = "DELETE FROM eleve WHERE id= ?";
        $delete_eleve = $this->bdd->prepare($sql);
        $delete_eleve->bind_param('i', $id);
        $delete_eleve->execute();
    }
}