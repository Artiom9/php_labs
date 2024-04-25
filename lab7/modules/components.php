<?php
    //initializare variabile
    $file_data = "admin/data/dateRezervari.txt";
    
    //declarare functie validare date si adaugare date in fisier
    function insertData($file_name){
        $name=$surname=$phone=$email=$int_date=$exit_date=$nmbr=$type=$obs="";
        $err="";
        if($_POST["ok"]){
            if (isset($_POST["name"])&&(!empty($_POST["name"]))){
                $name=$_POST["name"];
            } else {
                $err.="Eroare - nume!";
            }
            if (isset($_POST["surname"])&&(!empty($_POST["surname"]))){
                $surname=$_POST["surname"];
            } else {
                $err.="Eroare - prenume!";
            }
            if (isset($_POST["phone"])&&(!empty($_POST["phone"]))){
                $phone=$_POST["phone"];
            } else {
                $err.="Eroare - nr. telefon!";
            }
            if (isset($_POST["email"])&&(!empty($_POST["email"]))){
                $email=$_POST["email"];
            } else {
                $err.="Eroare - email!";
            }
            if (isset($_POST["int_date"])&&(!empty($_POST["int_date"]))){
                $int_date=$_POST["int_date"];
            } else {
                $err.="Eroare - data de intrare!";
            }
            if (isset($_POST["exit_date"])&&(!empty($_POST["exit_date"]))){
                $exit_date=$_POST["exit_date"];
            } else {
                $err.="Eroare - data de iesire!";
            }
            if (isset($_POST["nmbr"])&&(!empty($_POST["nmbr"]))){
                $nmbr=$_POST["nmbr"];
            } else {
                $err.="Eroare - nr. persoane!";
            }   
            if (isset($_POST["type"])&&(!empty($_POST["type"]))){
                $type=$_POST["type"];
                switch ($type){
                    case "lux": $type="Lux"; break;
                    case "econom": $type="Econom"; break;
                    case "apartament": $type="Apartament"; break;
                }
            } else {
                $err.="Eroare - tip camera!";
            }
            $obs = (empty($_POST["obs"])) ? "-" : $_POST["obs"];

            if($err=="") {
                $txt=fopen($file_name,"a") or die("Fisier inaccesibil!");
                fwrite($txt, $name."\t".$surname."\t".$phone."\t".$email."\t".$int_date."\t".$exit_date."\t".$nmbr."\t".$type."\t".$obs);
                fwrite($txt,"\n");
                fclose($txt);
                $err=  "<span class='error'>Datele au fost adăugate!</span>";
            }
            return $err;
        }
    }

?>