<?php

class DevoirEleve
{
    private $id;
    private $note; 
    private $id_eleve;
    private $id_devoir;

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
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of id_eleve
     */ 
    public function getId_eleve()
    {
        return $this->id_eleve;
    }

    /**
     * Set the value of id_eleve
     *
     * @return  self
     */ 
    public function setId_eleve($id_eleve)
    {
        $this->id_eleve = $id_eleve;

        return $this;
    }

    /**
     * Get the value of id_devoir
     */ 
    public function getId_devoir()
    {
        return $this->id_devoir;
    }

    /**
     * Set the value of id_devoir
     *
     * @return  self
     */ 
    public function setId_devoir($id_devoir)
    {
        $this->id_devoir = $id_devoir;

        return $this;
    }
}