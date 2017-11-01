<?php
session_start();
include 'bdd/connexion.php';
if (isset($_POST['submit'])) {
    $TabErreur = array();
    $ColorErreur = array();
    if (isset($_POST['sexe']) && (($_POST['sexe'] == 'h') || ($_POST['sexe'] == 'f'))) {
        $sexe = $_POST['sexe'];
    } else {
        $sexe = '';
    }
    if (isset($_POST['login'])) {
        $LogTri = trim($_POST['login']);
        $LongLogTri = strlen($LogTri);
        $res = $objPDO->prepare("SELECT count(*) From inscription where login='" . $LogTri . "'");
        $res->execute();
        $result = $res->fetch();
        $existe = array_shift($result);
        if ($existe == 0) {
            if ($LongLogTri < 4) {
                $TabErreur[] = 'Login trop court (inférieur à 4 caractères)';
                $ColorErreur[] = 'login';
            } else {
                $login = $LogTri;
            }
        } else {
            $TabErreur[] = 'Login existant';
            $ColorErreur[] = 'login';
        }
    }
    if (isset($_POST['mdp'])) {
        $MdpTri = trim($_POST['mdp']);
        $LongMdpTri = strlen($MdpTri);
        if ($LongMdpTri < 6) {
            $TabErreur[] = 'Mot de passe trop court (inférieur à 6 caractères)';
            $ColorErreur[] = 'mdp';
        } else {
            $mdp = $MdpTri;
        }
    }
    if (isset($_POST['mail'])) {
        $MailTri = trim($_POST['mail']);
        $LongMail = strlen($MailTri);
        if ($LongMail > 0) {
            if (!filter_var($MailTri, FILTER_VALIDATE_EMAIL)) {
                $TabErreur[] = 'Mail non valide';
                $ColorErreur[] = 'mail';
            } else {
                $mail = $_POST['mail'];
            }
        } else {
            $mail = '';
        }
    }
    if (isset($_POST['adresse'])) {
        $AdresseTri = trim($_POST['adresse']);
        $LongAdresse = strlen($AdresseTri);
        if ($LongAdresse > 0) {
            if ($LongAdresse < 6) {
                $TabErreur[] = 'Adresse trop courte (inférieur à 6 caractères)';
                $ColorErreur[] = 'adresse';
            } else {
                $adresse = $AdresseTri;
            }
        } else {
            $adresse = '';
        }
    }
    if (isset($_POST['code_postal'])) {
        $CPTri = trim($_POST['code_postal']);
        $LongCP = strlen($CPTri);
        if ($LongCP > 0) {
            if ((!ctype_digit($_POST['code_postal'])) || ($LongCP != 5)) {
                $TabErreur[] = 'Code Postal non valide';
                $ColorErreur[] = 'code_postal';
            } else {
                $cp = $CPTri;
            }
        } else {
            $cp = '';
        }
    }
    if (isset($_POST['ville'])) {
        $VilleTri = trim($_POST['ville']);
        $LongVille = strlen($VilleTri);
        if ($LongVille > 0) {
            if (!ctype_alpha($_POST['ville'])) {
                $TabErreur[] = 'La ville contient des chiffres';
                $ColorErreur[] = 'ville';
            } else if($LongVille < 3){
                $TabErreur[] = 'Nom de ville trop courte';
                $ColorErreur[] = 'ville';
            }else{
                $ville = $VilleTri;
            }
        } else {
            $ville = '';
        }
    }
    if (isset($_POST['num_tel'])) {
        $NumTelTri = trim($_POST['num_tel']);
        $LongNumTel = strlen($NumTelTri);
        if ($LongNumTel > 0) {
            if (!ctype_digit($_POST['num_tel'])) {
                $TabErreur[] = 'Numéro de téléphone non valide';
                $ColorErreur[] = 'num_tel';
            } else {
                $numTel = $NumTelTri;
            }
        } else {
            $numTel = '';
        }
    }
    if (isset($_POST['nom'])) {
        $NomTri = trim($_POST['nom']);
        $LongNomTri = strlen($NomTri);
        if ($LongNomTri > 0) {
            if ($LongNomTri <= 2) {
                $TabErreur[] = 'Nom trop court (inférieur à 2 caractères)';
                $ColorErreur[] = 'nom';
            } else if(!ctype_alpha($_POST['nom'])){
                $TabErreur[] = 'Le nom contient contient des chiffres';
                $ColorErreur[] = 'nom';
            }else{
                $nom = $_POST['nom'];
            }
        } else {
            $nom = '';
        }
    }
    if (isset($_POST['prenom'])) {
        $PrenomTri = trim($_POST['prenom']);
        $LongPreTri = strlen($PrenomTri);
        if ($LongPreTri > 0) {
            if ($LongPreTri <= 2) {
                $TabErreur[] = 'Prenom trop court (inférieur à 2 caractères)';
                $ColorErreur[] = 'prenom';
            } else if(!ctype_alpha($_POST['prenom'])){
                $TabErreur[] = 'Le prénom contient des chiffres';
                $ColorErreur[] = 'prenom';
            }else{
                $prenom = $PrenomTri;
            }
        } else {
            $prenom = '';
        }
    }
    $TabDate = explode('-', $_POST['naissance']);
    if (trim($_POST['naissance'] != '')) {
        if (!checkdate($TabDate[1], $TabDate[2], $TabDate[0])) {
            $TabErreur[] = 'Date non valide';
            $ColorErreur[] = 'naissance';
        } else {
            $datenaiss = $_POST['naissance'];
        }
    } else {
        $datenaiss = '';
    }
    if (count($TabErreur) != 0) {
        foreach ($TabErreur as $value) {
            echo "<script type='text/javascript'>
                        alert('".$value."');
                        </script>";
        }
        foreach ($ColorErreur as $value2) {
            echo '<style type="text/css"> 
					.' . $value2 . '
					    {  background-color: #ff6666;
						}
						  </style>';
        }
    } else {
        echo 'Login : ' . $login . ', Mot de passe : ' . $mdp . ', Sexe : ' . $sexe . ', Nom : ' . $nom . ', Prenom : ' . $prenom . ', Date de naissance : ' . $datenaiss . ', Mail : ' . $mail . ', adresse : ' . $adresse . ', code postal : ' . $cp . ', ville : ' . $ville . ', Numero de telephone : ' . $numTel;
        if ($cp == '') {
            $objPDO->query("INSERT INTO inscription (login, mdp, nom, prenom, datenaissance, mail, adresse, codepostal, ville, numerotel, sexe) VALUES ('" . $login . "', '" . $mdp . "', '" . $nom . "', '" . $prenom . "', '" . $datenaiss . "', '" . $mail . "', '" . $adresse . "',0, '" . $ville . "', '" . $numTel . "','" . $sexe . "')");
            $_SESSION["username"] = $_POST['login'];
            header("Location: index.php");
        } else {
            $objPDO->query("INSERT INTO inscription (login, mdp, nom, prenom, datenaissance, mail, adresse, codepostal, ville, numerotel, sexe) VALUES ('" . $login . "', '" . $mdp . "', '" . $nom . "', '" . $prenom . "', '" . $datenaiss . "', '" . $mail . "', '" . $adresse . "'," . $cp . ", '" . $ville . "', '" . $numTel . "','" . $sexe . "')");
            $_SESSION["username"] = $_POST['login'];
            header("Location: index.php");
        }
    }
}
try
{
    if(isset($_POST["login"]))
    {
        if(empty($_POST["username"]) || empty($_POST["password"]))
        {
            $message = '<label> </label>';
        }
        else
        {
            $query = "SELECT id, login, mdp FROM inscription WHERE login = :username AND mdp = :password";
            $statement = $objPDO->prepare($query);
            $statement->execute(
                array(
                    'username'     =>     $_POST["username"],
                    'password'     =>     $_POST["password"]
                )
            );
            $count = $statement->rowCount();
            if($count > 0)
            {
                $_SESSION["username"] = $_POST["username"];
                header("location:index.php");
            }
            else
            {
                $message = 'Utilisateur inconnu';
            }
        }
    }
}
catch(PDOException $error)
{
    $message = $error->getMessage();
}
?>