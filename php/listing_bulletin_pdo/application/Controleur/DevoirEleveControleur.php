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

    /**
     * supprimé une note
     */
    public function controleur_delete_note()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            //pre_var_dump($_POST,null, true);
            $id = (int) clean_word_entrant($_POST['delete']);
            $ok = $this->devoir_eleve_model->delete_note($id);

            if ($ok) 
            {    
                header_location('controleur_get_all_devoir_eleve');
            }else{
                throw new \Exception("Il n'y a un truc qui ne va pas ");
                echo "Il n'y a un truc qui ne va pas ";
            }
        }
    }
}