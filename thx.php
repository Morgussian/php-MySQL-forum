<?php 
    require 'action/users/securityAction.php';
    require 'action/answers/thxAction.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<?php
    require 'includes/head.php';
?>
<body>
<?php
    require 'includes/navbar.php';
?>
<div class="container">
    <h3>
        Merci pour votre commentaire
    </h3>
    
    <a href="single_question.php?id=<?=$questionId;?>" style="color: inherit; text-decoration: inherit;">Retour à la question <?=$questionId;?></a>
</div>



</body>
</html>