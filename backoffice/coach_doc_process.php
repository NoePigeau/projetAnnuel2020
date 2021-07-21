<?php  echo $_POST['id_sub'];

require('../config.php');


if($_POST['action'] == 'yes'){

  $q='UPDATE subscribers SET coach = 1,active = 1 WHERE id = ?';
  $req = $bdd->prepare($q);
  $req->execute([$_POST['id_sub']]);

}
else if($_POST['action'] == 'no'){

  $q='DELETE FROM subscribers WHERE coach = 2 AND id = ?';
  $req = $bdd->prepare($q);
  $req->execute([$_POST['id_sub']]);


}




?>
