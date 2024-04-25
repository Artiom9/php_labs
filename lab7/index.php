<?php
    $file_data = "admin/data/dateRezervari.txt";
    $name=$surname=$phone=$email=$int_date=$exit_date=$nmbr=$type=$obs="";
    if($_POST["ok"]){
        $err="";
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
            //echo $name." ".$surname.", aveti numarul de telefon: ".$phone.", iar emailul: ".$email.", veti veni la noi pe data de: ".$int_date." si veti pleca pe ".$exit_date."<br />De asemenea ati optat pentru ".$nmbr." locuri, iar tipul numarului este ".$type.".<br />Suplimentar ati mentionat: ".$obs;
            
            $mesaj="";
            $txt=fopen($file_data,"a") or die("Fisier inaccesibil!");
            fwrite($txt, $name."\t".$surname."\t".$phone."\t".$email."\t".$int_date."\t".$exit_date."\t".$nmbr."\t".$type."\t".$obs);
            fwrite($txt,"\n");
            fclose($txt);
            $mesaj = "<span class='error'>Datele au fost adăugate!</span>";
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rezervare</title>
    <link rel="icon" href="images/icon.png" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://kit.fontawesome.com/9c1aa2dd0d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="myForm">
        <h1>Rezervare locuri</h1>
        <form action="index.php" autocomplete="off" method="post">
            <div class="container">
                *<input type="text" placeholder="Numele" name="name" class="half" value="<?php if(!empty($_POST['name'])) { echo $name; } ?>" />
                *<input type="text" placeholder="Prenumele" name="surname" class="half" value="<?php if(!empty($_POST['surname'])) { echo $surname; } ?>" />
                *<input type="text" placeholder="Număr telefon" name="phone" class="half" value="<?php if(!empty($_POST['phone'])) { echo $phone; } ?>" />
                *<input type="email" placeholder="Adresa electronică" name="email" class="half" value="<?php if(!empty($_POST['email'])) { echo $email; } ?>" />
                <div class="group">
                    <label>Data venirii *<input type="date" name="int_date" value="<?php if(!empty($_POST['int_date'])) { echo $int_date; } ?>" /></label>
                </div>
                <div class="group">
                    <label>Data plecării *<input type="date" name="exit_date" value="<?php if(!empty($_POST['exit_date'])) { echo $exit_name; } ?>" /></label>
                </div>
                <div class="group">
                    <label>Număr persoane *<input type="number" value="1" min="1" max="5" name="nmbr" value="<?php if(!empty($_POST['nmbr'])) { echo $nmbr; } ?>" /></label>
                </div>
                <div class="group">
                    <label>Tip cameră
                        *<select name="type">
                            <option value="lux">Lux</option>
                            <option value="econom">Econom</option>
                            <option value="apartament">Apartament</option>
                        </select>
                    </label>
                </div>
            </div>
            <textarea placeholder="Observații și doleanțe" rows="5" name="obs"><?php if(!empty($_POST['obs'])) { echo $obs; } ?></textarea>
            <div class="btn_container">
                <input type="submit" value="Salvează" name="ok" />
            </div>
            <span class="error" style="color: coral; font-size: 0.7em;">
                <?php 
                    echo $err;
                    echo $mesaj;
                ?>
            </span>
        </form>
    </div>
</body>
</html>