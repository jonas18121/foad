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
require_once 'Controleur/EleveControleur.php';


class Router
{
    private $eleve_controleur;

    public function __construct()
    {
        $this->eleve_controleur = new EleveControleur;
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





