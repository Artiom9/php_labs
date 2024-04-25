<?php
	session_start(); 
	require 'config.php';
	if ((isset($_POST["login"]))and(!empty($_POST['login']))and(isset($_POST["pass"]))and(!empty($_POST['pass']))) {
		$password=$_POST["pass"];
		$login=$_POST["login"];
		$exist=false;
		if (!file_exists($fileName)) {
			$txt=fopen("$fileName","a") or die("Fisier inaccesibil!");
			$log=$_POST["login"];
			fwrite($txt, $log);
			$spatiu=" ";
			fwrite($txt,$spatiu);
			$password=md5($_POST["pass"]);
			fwrite($txt,$password);
			$enter="\n";
			fwrite($txt,$enter);
			fclose($txt);
			$initial= true;
			$mesaj = "Contul a fost creat!";
		}
		$log=fopen($fileName, "r+")or die("Nu a fost gasit fisierul!");
		while(!feof($log))
		{
			//trim — sterge spatiile si alte simboluri de la inceputul si sfarsitul sirului
			$extras=trim(fgets($log));
			if($extras == $login.' '.md5($password)) {
				$exist=true;
			}
		}
		fclose($log);
		$mesaj = "";
		if ($exist==true){
			$mesaj = "<span class='error'>Un cont cu acest login si parola deja exista!!!<br />Introdu alte date pentru inregistrare!</span>";
		} elseif($initial==true){
			$mesaj = "<span class='error'>Este primul cont creat!</span>";
		} else {
			$txt=fopen("$fileName","a") or die("Fisier inaccesibil!");
			$log=$_POST["login"];
			fwrite($txt, $log);
			$spatiu=" ";
			fwrite($txt,$spatiu);
			$password=md5($_POST["pass"]);
			fwrite($txt,$password);
			$enter="\n";
			fwrite($txt,$enter);
			fclose($txt);
			$mesaj = "<span class='error'>Contul a fost creat!</span>";
		}
	}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rezervare</title>
    <link rel="icon" href="../images/icon.png" />
    <link rel="stylesheet" href="../css/styles.css" />
    <script src="https://kit.fontawesome.com/9c1aa2dd0d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="link">
            <a href="index.php" class="navbar"> Autentificare</a>
	</div>    
    <div class="myForm">
		<h1>Pentru a avea acces la date - înregistrați-va!</h1>
		<form method="POST" autocomplete="off" action="<?php $_SERVER['SCRIPT_NAME']?>">
            <div class="signIn">
                <input type="text" placeholder="Log-in" name="login" />
                <input type="text" placeholder="Parola" name="pass" size="12" maxlength="10" /><br />
                <input type="submit" value="Salveaza" />
                <input type="reset" value="Șterge" />
            </div>
		</form>
        <?php
			if(empty($_REQUEST['login'])||empty($_REQUEST['pass'])) {
			    echo "<br /><span class='error'>*Completați toate câmpurile!!!</span>"; 
			}
		    echo '<br />'.$mesaj;
		?>
	</div>
	</body>
</html>
