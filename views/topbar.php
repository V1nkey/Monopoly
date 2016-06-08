<?php

$sum = sizeof($tradesInProgressProposed) + sizeof($tradesInProgressJoined) + sizeof($tradesProposed) + sizeof($tradesEnded);

$propTradesProposed = ($sum <> 0) ? sizeof($tradesProposed) * 100 / $sum : 0;
$propTradesEnded = ($sum <> 0) ? sizeof($tradesEnded) * 100 / $sum : 0;
$propTradesInProgressJoined = ($sum <> 0) ? sizeof($tradesInProgressJoined) * 100 / $sum : 0;
$propTradesInProgressProposed = ($sum <> 0) ? sizeof($tradesInProgressProposed) * 100 / $sum : 0;
?>

<header class="header black-bg">
<div class="sidebar-toggle-box">
  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
  </div>

  <!--logo start-->
  <a href="index.php" class="logo"><b>MONOPOLY MC DONALDS</b></a>
  <!--logo end-->

  <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme"><?=$sum?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Vos tâches courantes</p>
                            </li>
                            <li>
                                <a href="">
                                    <div class="task-info">
                                        <div class="desc">Echange(s) proposé(s)</div>
                                        <div class="percent"><?=sizeof($tradesProposed)?></div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$propTradesProposed?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$propTradesProposed?>%">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Echange(s) entamé(s)</div>
                                        <div class="percent"><?=sizeof($tradesInProgressProposed)?></div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$propTradesInProgressProposed?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$propTradesInProgressProposed?>%">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Echange(s) rejoint(s)</div>
                                        <div class="percent"><?=sizeof($tradesInProgressJoined)?></div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$propTradesInProgressJoined?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$propTradesInProgressJoined?>%">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="task-info">
                                        <div class="desc">Echange(s) terminé(s)</div>
                                        <div class="percent"><?= sizeof($tradesEnded) ?></div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $propTradesEnded ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$propTradesEnded?>%">
                                            <span class="sr-only"><?= sizeof($tradesEnded) ?></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="mytrades.php">Voir les détails</a>
                            </li>

                        </ul>
                    </li><!-- settings end -->
                </ul>
                <!--  notification end -->
            </div>

  <div class="top-menu">
    <ul class="nav pull-right top-menu">
      <li><a class="logout" href="logout.php">Déconnexion</a></li>
    </ul>
  </div>
</header>