<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
        	  <h5 class="centered"><?=$user->firstname ?> <?=$user->lastname ?></h5>
        	  	
            <li>
                <a href="index.php">
                    <i class="fa fa-home"></i>
                    <span>Accueil</span>
                </a>
            </li>

            <li>
                <a href="account.php">
                    <i class="fa fa-user"></i>
                    <span>Mon Compte</span>
                </a>
            </li>

            <?php if( isset($tradesProposed) && isset($tradesInProgressProposed) && isset($tradesInProgressJoined) && isset($tradesEnded) ): ?>
                <?php $sum = sizeof($tradesProposed) + sizeof($tradesInProgressProposed) + sizeof($tradesInProgressJoined) + sizeof($tradesEnded); ?>
                <?php if( $sum > 0 ) : ?>
                <li>
                    <a href="mytrades.php">
                        <i class="fa fa-refresh"></i>
                        <span>Mes échanges (<?=$sum?>)</span>
                    </a>
                </li>
                <?php endif; ?>
            <?php endif; ?>

            <li>
                <a href="propose.php">
                    <i class="fa fa-plus"></i>
                    <span>Proposer</span>
                </a>
            </li>

            <li>
                <a href="search.php">
                    <i class="fa fa-search"></i>
                    <span>Rechercher</span>
                </a>
            </li>

            <?php if( isAdmin($user->id) ) : ?>
            <li>
                <a href="admin.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Panneau d'administration</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->