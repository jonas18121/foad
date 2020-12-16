<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* require_once '../config/Database.php';
require_once '../tools/tools.php';
require_once '../Model/Model.php';
require_once '../Model/EleveModel.php';
require_once '../Model/ClasseModel.php';
require_once '../Entity/Eleve.php';
require_once '../Entity/Classe.php'; */

class EleveControleur
{

    private $eleve_model;
    private $classe_model;

    public function __construct()
    {
        $this->eleve_model  = new EleveModel();
        $this->classe_model = new ClasseModel();
    }


    /**
     * select tous les eleves
     */
    public function controleur_get_all_eleve()
    {
        $all_eleves     = $this->eleve_model->get_all_eleve();
        $count_eleve    = $this->classe_model->count_nb_eleve();
        $moyenne_classe = $this->classe_model->calc_classe_sum();

        require_once 'www/templates/eleve/get_eleve.php';
    }
}