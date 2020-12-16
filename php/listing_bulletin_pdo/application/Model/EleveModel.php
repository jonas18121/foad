<?php

class EleveModel extends Model
{
    /**
     * select tous les eleves
     */
    public function get_all_eleve()
    {
        $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve";
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        $stmt->execute();
        $all_eleves = $stmt->fetchAll();
        return $all_eleves;
    }
    
    /**
     * Ajouter un eleve
     */
    public function add_eleve($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation)
    {
        $sql = "INSERT INTO eleve (id, nom, prenom, date_naissance, moyenne, appreciation) VALUES (:id, :nom, :prenom, :date_naissance, :moyenne, :appreciation)";
        $stmt = $this->bdd->prepare($sql);
        return $stmt->execute([
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
                            
        $stmt = $this->bdd->prepare($sql);
        return $stmt->execute([
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
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        $stmt->execute([':id' => $id]);
        $one_eleve = $stmt->fetch();

        return $one_eleve;
    }

    /**
     * supprime un eleve
     */
    public function delete_eleve($id)
    {
        $sql = "DELETE FROM eleve WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        return $stmt->execute([ 'id' => $id ]);
    }
}