<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'config/Database.php';
require_once 'tools/tools.php';
require_once 'Model/Model.php';
require_once 'Model/EleveModel.php';
require_once 'Model/ClasseModel.php';
require_once 'Entity/Eleve.php';
require_once 'Entity/Classe.php';

require_once 'Fram/URL.php';


class Router
{

    public function router_run()
    {
        try {

            $fusion_param_url = new URL(array_merge($_GET, $_POST));
            
            // pre_var_dump('L 35 Router.php', $fusion_param_url,true);
            $controleur = $this->creerControleur($fusion_param_url);
            
            $action = $this->creerAction($fusion_param_url);
            
            $controleur->executerAction($action);
            
        }  
        catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            require_once 'www/templates/error_view.php';
        }
    }


    /**
     * récupère le paramètre controleur de l'url' reçue
     * et le concatène pour construire le nom du fichier contrôleur
     * et renvoyer une instance de la classe associée
     * 
     * En l'absence de ce paramètre, 
     * elle cherche à instancier la classe ControleurAccueil qui correspond au contrôleur par défaut
     */
    private function creerControleur(URL $fusion_param_url)
    {
        if ($fusion_param_url->existeParametre('controleur')) 
        {
            $nom_controleur = $fusion_param_url->getParametre('controleur');

            $nom_controleur = ucfirst(strtolower($nom_controleur));
        }
        else {
            $nom_controleur = 'Eleve'; // Contrôleur par défaut
        }

        $classe_controleur = $nom_controleur . 'Controleur' ; 

        $fichier_controleur = 'Controleur/' . $classe_controleur . '.php'; 

        if(file_exists($fichier_controleur))
        {
            require $fichier_controleur;
            
            $controleur = new $classe_controleur();

            $controleur->setUrl($fusion_param_url);

            return $controleur;
        }
        else{
            throw new Exception("Fichier '$fichier_controleur' introuvable");
        }
    }

    /**
     * récupère le paramètre action de l'url reçue et le renvoie
     * En l'absence de ce paramètre, elle renvoie la valeur « index » qui correspond à l'action par défaut.
     */
    private function creerAction(URL $fusion_param_url)
    {
        if ($fusion_param_url->existeParametre('action')) 
        {
            $nom_action = $fusion_param_url->getParametre('action');
            
        }
        else {
            $nom_action = 'index'; // Action par défaut
        }

        return $nom_action;
    }







    public function run()
    {
        try 
        {
            if($_GET){
                if(isset($_GET['action']) && !empty($_GET['action'])){
                    if (array_key_exists('action', $_GET) && ctype_alpha($_GET['action'])) 
                    {    
                        if ($_GET['action'] === 'tableauEleves') 
                        {
                            $this->eleve_controleur->controleur_get_all_eleve();
                        }
                    }
                    else{
                        $errorMessage = 'Mauvaise clé utilisé ou la valeur doit avoir que des lettre alphbetique';
                    }
                }
            }
            else
            {
                $this->eleve_controleur->controleur_get_all_eleve();
            }
            
        } 
        catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            require_once 'www/templates/error_view.php';
        }
        
        //a améliorér en faisant un controleur
        if (isset($errorMessage)) {
            require_once 'www/templates/error_view.php';
            require_once 'www/layout/layout_view.php'; 
        }
    }

}





