<?php

class DevoirEleveModel extends Model
{

    public function get_note($id_eleve)
    {
        $sql = "SELECT ROUND(SUM(note)/COUNT(id_devoir)) AS moyenne_eleve 
            FROM devoir_eleve 
            WHERE id_eleve = :id_eleve"
        ;
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, DevoirEleve::class);
        $stmt->execute([':id_eleve' => $id_eleve]);
        $note = $stmt->fetch();

        return $note;
    }

    // SELECT ROUND(SUM(note)/COUNT(id_eleve)) AS moyenne_classe FROM devoir_eleve WHERE id_eleve= 1
    //SELECT ROUND(SUM(note)/COUNT(id_devoir)) AS moyenne_eleve FROM devoir_eleve WHERE id_eleve = 3

    /**
     * voir tous les notes des élève par devoir
     */
    public function get_all_devoir_eleve()
    {
        $sql = "SELECT devoir_eleve.note, devoir.titre, devoir.contenu, eleve.nom, eleve.prenom 
            FROM devoir_eleve 
            INNER JOIN devoir ON devoir.id = devoir_eleve.id_devoir 
            INNER JOIN eleve ON eleve.id = devoir_eleve.id_eleve"
        ;
        
        $stmt = $this->bdd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, DevoirEleve::class);
        $stmt->execute();
        $all_devoirs_eleve = $stmt->fetchAll();
        return $all_devoirs_eleve;
    }
}