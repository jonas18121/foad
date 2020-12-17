<?php 

require_once 'Fram/Controleur.php';


class DevoirControleur extends Controleur
{
    private $devoir_model;

    public function __construct()
    {
        $this->devoir_model = new DevoirModel();
    }

    public function index()
    {
        $this->controleur_get_all_devoir();
    }

    /**
     * afficher tous les devoirs
     */
    public function controleur_get_all_devoir()
    {
        $all_devoirs     = $this->devoir_model->get_all_devoir();
        require_once 'www/templates/devoir/get_all_devoir.php';
    }

    /**
     * affiché le formulaire de création d'un devoir
     * Si on envoie des requêtes en $_POST, on sera redirigé vers le tableau de devoir 
     * après l'opération
     */
    public function controleur_create_devoir()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            $id             = null;
            $titre          = clean_word_entrant($_POST['titre']);
            $contenu        = clean_word_entrant($_POST['contenu']);

            $ok = $this->devoir_model->add_devoir($id, $titre, $contenu);

            if ($ok) 
            {    
                header_location('index.php?controleur=devoir&action=controleur_get_all_devoir');
            }else{
                throw new Exception("Il n'y a un champ mal rempli ");
            }
        }

        require_once 'www/templates/devoir/create_devoir.php';
    }

    /**
     * affiché le formulaire de modification d'un devoir
     * Si on envoie des requêtes en $_POST, on sera redirigé vers le tableau de devoir 
     * après l'opération
     */
    public function controleur_update_devoir()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            $id             = (int) clean_word_entrant($_POST['id']);
            $titre          = clean_word_entrant($_POST['titre']);
            $contenu        = clean_word_entrant($_POST['contenu']);
            
            // pre_var_dump($id ,null, true);
            $ok = $this->devoir_model->update_devoir($titre, $contenu, $id);
        
    
            if ($ok) 
            {    
                header_location('index.php?controleur=devoir&action=controleur_get_all_devoir');
            }else{
                throw new Exception("Il n'y a un champ mal rempli ");
            }
        }

        // pre_var_dump($this->url,null, true);
        $id = $this->url->getParametre("id_devoir");
        $one_devoir = $this->devoir_model->get_one_devoir($id);
        require_once 'www/templates/devoir/update_devoir.php';
    }

    /**
     * supprimé un devoir
     */
    public function controleur_delete_devoir()
    {
        if (isset($_POST) && !empty($_POST)) 
        {
            // pre_var_dump($_POST,null, true);
            $id = (int) clean_word_entrant($_POST['delete']);
            $ok = $this->devoir_model->delete_devoir($id);

            if ($ok) 
            {    
                header_location('index.php?controleur=devoir&action=controleur_get_all_devoir');
            }else{
                throw new \Exception("Il n'y a un truc qui ne va pas ");
                echo "Il n'y a un truc qui ne va pas ";
            }
        }
    }
}
