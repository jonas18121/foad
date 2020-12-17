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

    /**
     * Ajouter un devoir
     */
    public function add_devoir($id, $titre, $contenu)
    {
        $sql = "INSERT INTO devoir (id, titre, contenu) VALUES (:id, :titre, :contenu)";
        $stmt = $this->bdd->prepare($sql);
        return $stmt->execute([
            ':id'               => $id, 
            ':titre'            => $titre, 
            ':contenu'          => $contenu
        ]);
    }

    /**
     * selectionner un devoir
     */
    public function get_one_devoir($id)
    {
        // $sql = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve WHERE id = :id";
        $sql = 'SELECT * FROM devoir WHERE id = :id';

        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Devoir::class);
        $stmt->execute([':id' => $id]);
        $one_devoir = $stmt->fetch();

        return $one_devoir;
    }

    /**
     * modifier un devoir
     */
    public function update_devoir($titre, $contenu, $id)
    {
        $sql = "UPDATE devoir SET titre = :titre, contenu = :contenu WHERE id = :id"; 
                            
        $stmt = $this->bdd->prepare($sql);
        return $stmt->execute([
            ':id'               => $id, 
            ':titre'            => $titre, 
            ':contenu'          => $contenu
        ]);
    }

    /**
     * supprime un devoir
     */
    public function delete_devoir($id)
    {
        $sql = "DELETE FROM devoir WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Devoir::class);
        return $stmt->execute([ 'id' => $id ]);
    }
}