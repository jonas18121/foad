<?php 

require_once 'Fram/Controleur.php';

/* require_once '../config/Database.php';
require_once '../tools/tools.php';
require_once '../Model/Model.php';
require_once '../Model/EleveModel.php';
require_once '../Model/ClasseModel.php';
require_once '../Entity/Eleve.php';
require_once '../Entity/Classe.php'; */

class EleveControleur extends Controleur
{

    private $eleve_model;
    private $classe_model;
    private $devoir_eleve_model;

    public function __construct()
    {
        $this->eleve_model  = new EleveModel();
        $this->classe_model = new ClasseModel();
        $this->devoir_eleve_model = new DevoirEleveModel();
    }

    public function index()
    {
        $this->controleur_get_all_eleve();
    }


    /**
     * select tous les eleves
     */
    public function controleur_get_all_eleve()
    {
        $all_eleves     = $this->eleve_model->get_all_eleve();
        $count_eleve    = $this->classe_model->count_nb_eleve();
        $moyenne_classe = $this->classe_model->calc_classe_sum();

        /* foreach ($all_eleves as $value) {
            pre_var_dump($this->devoir_eleve_model->get_note($value->getId()),null,true);
        } */
        
        //pre_var_dump('l 37 EleveControleur',$all_eleves, true);
        require_once 'www/templates/eleve/get_eleve.php';
    }

    /**
     * affiché le formulaire de création d'un élève
     * Si on envoie des requêtes en $_POST, on sera redirigé vers le tableau d'élève 
     * après l'opération
     */
    public function controleur_create_eleve()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            $id             = null;
            $nom            = clean_word_entrant($_POST['nom']);
            $prenom         = clean_word_entrant($_POST['prenom']);
            $date_naissance = clean_word_entrant($_POST['date_naissance']);
            $moyenne        = clean_word_entrant($_POST['moyenne']);
            $appreciation   = clean_word_entrant($_POST['appreciation']);
    
            $ok = $this->eleve_model->add_eleve($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation);

            if ($ok) 
            {    
                header_location('index.php?controleur=eleve&action=controleur_get_all_eleve');
            }else{
                throw new Exception("Il n'y a un champ mal rempli ");
            }
        }

        require_once 'www/templates/eleve/create_eleve.php';
    }

    /**
     * affiché le formulaire de modification d'un élève
     * Si on envoie des requêtes en $_POST, on sera redirigé vers le tableau d'élève 
     * après l'opération
     */
    public function controleur_update_eleve()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            if (isset($_POST['note']) && !empty($_POST['note'])) 
            {
                $id             = (int) clean_word_entrant($_POST['id']);
                $note            = clean_word_entrant($_POST['note']);

                $ok = $this->eleve_model->update_moyenne_eleve($note, $id);
            }
            else 
            {    
                $id             = (int) clean_word_entrant($_POST['id']);
                $nom            = clean_word_entrant($_POST['nom']);
                $prenom         = clean_word_entrant($_POST['prenom']);
                $date_naissance = clean_word_entrant($_POST['date_naissance']);
                $moyenne        = clean_word_entrant($_POST['moyenne']);
                $appreciation   = clean_word_entrant($_POST['appreciation']);
                
                $ok = $this->eleve_model->update_eleve($nom, $prenom, $date_naissance, $moyenne, $appreciation, $id);
            }
        
            if ($ok) 
            {    
                header_location('index.php?controleur=eleve&action=controleur_get_all_eleve');
            }else{
                throw new Exception("Il n'y a un champ mal rempli ");
            }
        }

        // pre_var_dump($this->url,null, true);
        $id = $this->url->getParametre("id_eleve");
        $one_eleve = $this->eleve_model->get_one_eleve($id);
        require_once 'www/templates/eleve/update_eleve.php';
    }

    /**
     * supprimé un élève
     */
    public function controleur_delete_eleve()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            //pre_var_dump($_POST,null, true);
            $id = (int) clean_word_entrant($_POST['delete']);
            $ok = $this->eleve_model->delete_eleve($id);

            if ($ok) 
            {    
                header_location('index.php?controleur=eleve&action=controleur_get_all_eleve');
            }else{
                throw new \Exception("Il n'y a un truc qui ne va pas ");
                echo "Il n'y a un truc qui ne va pas ";
            }
        }
    }
}