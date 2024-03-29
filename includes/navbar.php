<?php
  include 'action/database.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Toutes les questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="publish_question.php">Ajouter une question</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="single_user_questions.php">Mes questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="single_user.php?id=<?=$_SESSION['id'];?>">Mon profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="action/users/logoutAction.php">Déconnexion</a>
        </li>
      </ul>
    </div>
    <?php

      //to display user pseudo
      echo '<p style="color : white">Bienvenue '. $_SESSION['pseudo'] . '</p>';
    ?>
  </div>
</nav>