<!DOCTYPE html>
<?php
if(isset($_POST['email']))
  $email = $_POST['email'];
else
  $email = "";
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="./accedi.css">
    <script language="javascript" type="text/javascript">
      function validatePassword() {
        password = document.getElementById("psw").value;
        // Almeno 8 caratteri, una lettera maiuscola, un numero e un simbolo speciale tra . , ; ! ?
        const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()\-_=\+{};:,<\.>]).{8,}$/;
        if(passwordRegex.test(password) == false){
          alert("La password deve contenere almeno 8 caratteri, una lettera maiuscola, un numero e un carattere speciale.");
          return false;
        }
        return true;
      }
    </script>

  </head>
  <body>
  <?php require "./navSimple.php" ; ?>
  <div class="fullbody">
    <div class="container">
      <div class="panel">
        <div class="leftpanel">
          <div class="content">
            <h3>Accedi e vola con FlyingSauce!</h3>
              <p>Entra nel cielo della pasta da asporto di FlyingSauce
                per gustare la comodità della consegna tramite droni,
                portando la freschezza dei nostri piatti direttamente sulla tua tavola!
              </p>
          </div>
        <img src="accedi_img.jpg" alt="accedi_img">
        </div>
        <form action=<?php echo $_SERVER["PHP_SELF"] ; ?> onSubmit="return validatePassword();" method="post">
          <h2>Member Login</h2>
          <div class="input-field">
            <span><img src="./email_icon.png" width="20px" height="20px"></span>
            <input type="email" name="email" placeholder="Email" required value="<?php echo $email; ?>"><br/>
          </div>
          <div class="input-field">
            <span><img src="./pass_icon.png" width="20px" height="20px"></span>
            <input type="password" id ="psw" name="password" placeholder="Password"><br/>
          </div>
          <input type="submit" id="login" name="login" value="Login"><br/>
          <p id="iscriviti">Non sei ancora iscritto? <a href="./registrati.php">Iscriviti ora</a></p>
          <?php
            if(!empty($_POST) && $_POST["login"]=="Login") {
              $dominio=mb_substr($_POST['email'], mb_strpos($_POST['email'], "@")+1);
              if(checkdnsrr($dominio, "MX")){
                $password = $_POST['password'];
                $hash = get_pwd($email);
          			if(!$hash){
          				$alert = "<span class='alert'>"."<strong><br/>L'utente associato all'email $email non esiste.</strong>"."</span>";
                  echo "$alert";
          			}
          			else{
          				if(password_verify($password, $hash)){
          					session_start();
                    $_SESSION["loggato"] = True;
                    $_SESSION["email"] = $email;
                    header("refresh:0.01;URL=./area_riservata.php");
          				}
          				else{
                    $alert = "<span class='alert'>"."<strong><br/>L'indirizzo email o la password che hai inserito non sono corretti. </strong>"."</span>";
                    echo "$alert";
          				}
          			}
              }
              else{
                  $alert = "<span class='alert'>"."<strong><br/>Dominio inesistente.</strong>"."</span>";
                  echo "$alert";
              }
            }

            function get_pwd($email){
            		require ".\logindb.php";
            		//CONNESSIONE AL DB
             		$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
             		$sql = "SELECT password FROM utenti WHERE email=$1;";
             		$prep = pg_prepare($db, "sqlPassword", $sql);
             		$ret = pg_execute($db, "sqlPassword", array($email));
             		if(!$ret) {
             			echo "ERRORE QUERY: " . pg_last_error($db);
             			return false;
             		}else{
             			if ($row = pg_fetch_assoc($ret)){
             				$pass = $row['password'];
             				return $pass;
             			}else{
             				return false;
             			}
                }
            }
          ?>
      </form>
      </div>
    </div>
  </div>
  </body>
