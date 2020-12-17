<?php 

require_once 'Fram/Controleur.php';


class DevoirEleveControleur extends Controleur
{
    private $devoir_eleve_model;

    public function __construct()
    {
        $this->devoir_eleve_model = new DevoirEleveModel();
    }

    public function index()
    {
        $this->controleur_get_all_devoir_eleve();
    }

    public function controleur_get_all_devoir_eleve()
    {
        $all_devoir_eleves     = $this->devoir_eleve_model->get_all_devoir_eleve();
        require_once 'www/templates/devoir_eleve/get_all_devoir_eleve.php';
    }
}