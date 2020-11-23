<?php 

require_once 'tools/tools.php';

// Upload and Rename File

if (isset($_POST['submit']))
{
    if (isset($_FILES["upload_file"])) {
        
        $filename = $_FILES["upload_file"]["name"];
        
        $file_basename = substr($filename, 0, strripos($filename, '.')); // on récupère que le nom du fichier sans l'extention
        
        $file_ext = substr($filename, strripos($filename, '.')); // on récupère l'extention sans le nom du fichier

        $filesize = $_FILES["upload_file"]["size"];

        $rand = rand(0, 100000000);

        $allowed_file_types = array('.doc','.docx','.rtf','.pdf', '.gif', '.jpg', '.png', '.jpeg');	
    
        if (in_array($file_ext, $allowed_file_types) && ($filesize < 200000))
        {	
            $first_filename = $file_basename . $file_ext;

            $date = new DateTime('now');
            $date = $date->format('Y_m_d_H_i_s');

            if (file_exists("uploads/" . $first_filename))
            {
                // si le fichier existe déjà, on renomme le fichier
                $new_filename = md5($date . $file_basename) . $file_ext;
                
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], "uploads/" . $rand . '_' . $date . $new_filename);
                echo "success le fichier a été renomé et ajouter car il existe déjà dans ce dossier.";
            }
            else
            {		
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], "uploads/" . $first_filename);
                echo "success le fichier est bien ajouter.";		
            }
        }
        elseif (empty($file_basename))
        {	
            echo "selectionne un fichier";
        } 
        elseif ($filesize > 200000)
        {	
            echo "Le fichier est trop large";
        }
        else
        {
            echo "Le fichier doit avoir l'un de ces extentions : " . implode(', ',$allowed_file_types);
            unlink($_FILES["upload_file"]["tmp_name"]);
        }
    }
}
?>



<form action="" method="post" enctype="multipart/form-data">

    <div>
        <label for="">Envoyer un fichier</label>
        <input type="file" name="upload_file">
    </div>

    <div>
        <input type="submit" name="submit">
    </div>
</form>