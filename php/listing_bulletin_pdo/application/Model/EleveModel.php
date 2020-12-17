<?php

class EleveModel extends Model
{
    /**
     * select tous les eleves
     */
    public function get_all_eleve()
    {
        $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve";
        // $sql = "SELECT eleve.id, eleve.nom, eleve.prenom, eleve.date_naissance, eleve.moyenne, eleve.appreciation, devoir_eleve.note FROM eleve INNER JOIN devoir_eleve ON devoir_eleve.id_eleve = eleve.id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Eleve::class);
        // $stmt->setFetchMode(PDO::FETCH_CLASS, DevoirEleve::class);
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
     * modifier la moyenne d'un eleve
     */
    public function update_moyenne_eleve($moyenne, $id)
    {
        $sql = "UPDATE eleve SET  moyenne = :moyenne WHERE id = :id"; 
                            
        $stmt = $this->bdd->prepare($sql);
        return $stmt->execute([
            ':id'               => $id, 
            ':moyenne'          => $moyenne
        ]);
    }

    /**
     * selectionner un eleve
     */
    public function get_one_eleve($id)
    {
        // $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve WHERE id = :id";
        $sql = 'SELECT eleve.id, nom, prenom, date_naissance, moyenne, appreciation, ROUND(SUM(note)/COUNT(id_devoir)) AS moyenne_eleve 
            FROM eleve 
            INNER JOIN devoir_eleve
            On devoir_eleve.id_eleve = eleve.id
            WHERE eleve.id = :id'
        ;

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