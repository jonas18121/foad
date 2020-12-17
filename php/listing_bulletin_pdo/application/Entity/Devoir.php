<?php

class Devoir 
{
    public $id;
    public $titre;
    public $contenu;
    public $date_publication;

    public function __construct(){}

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of contenu
     */ 
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */ 
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of date_publication
     */ 
    public function getDate_publication()
    {
        return new DateTime($this->date_publication);
    }

    /**
     * Set the value of date_publication
     *
     * @return  self
     */ 
    public function setDate_publication($date_publication)
    {
        $this->date_publication = new DateTime($date_publication);

        return $this;
    }
}