<?php

class Classe
{
    public $id;
    public $nb_eleve;
    public $moyenne_classe;

    public function __construct(){}
    
    /**
     * Get the value of moyenne_classe
     */ 
    public function get_moyenne_classe()
    {
        return $this->moyenne_classe;
    }

    /**
     * Set the value of moyenne_classe
     *
     * @return  self
     */ 
    public function set_moyenne_classe($moyenne_classe)
    {
        $this->moyenne_classe = $moyenne_classe;

        return $this;
    }

    /**
     * Get the value of nb_eleve
     */ 
    public function get_nb_eleve()
    {
        return $this->nb_eleve;
    }

    /**
     * Set the value of nb_eleve
     *
     * @return  self
     */ 
    public function set_nb_eleve($nb_eleve)
    {
        $this->nb_eleve = $nb_eleve;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function set_id($id)
    {
        $this->id = $id;

        return $this;
    }
}