<?php

class Eleve
{
    public $id;
    public $nom;
    public $prenom;
    public $date_naissance;
    public $moyenne;
    public $appreciation;
    public $bdd;

    public function __construct(){}

    public static function construct_params($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation)
    {
        $eleve = new Eleve();

        $eleve->id               = $id;
        $eleve->nom              = $nom;
        $eleve->prenom           = $prenom;
        $eleve->date_naissance   = new DateTime($date_naissance);
        $eleve->moyenne          = $moyenne;
        $eleve->appreciation     = $appreciation;

        return $eleve;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of date_naiss
     */ 
    public function getDate_naissance()
    {
        return new DateTime($this->date_naissance);
    }

    /**
     * Set the value of date_naiss
     *
     * @return  self
     */ 
    public function setDate_naissance($date_naissance)
    {
        $this->date_naissance = new DateTime($date_naissance);

        return $this;
    }

    /**
     * Get the value of moyenne
     */ 
    public function getMoyenne()
    {
        return $this->moyenne;
    }

    /**
     * Set the value of moyenne
     *
     * @return  self
     */ 
    public function setMoyenne($moyenne)
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    /**
     * Get the value of appreciation
     */ 
    public function getAppreciation()
    {
        return $this->appreciation;
    }

    /**
     * Set the value of appreciation
     *
     * @return  self
     */ 
    public function setAppreciation($appreciation)
    {
        $this->appreciation = $appreciation;

        return $this;
    }



    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}