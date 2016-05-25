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
                <a href="profil.php">
                    <i class="fa fa-user"></i>
                    <span>Mon profil</span>
                </a>
            </li>

            <li>
                <a href="historiqueSoiree.php">
                    <i class="fa fa-bars"></i>
                    <span>Historique des soirées</span>
                </a>
            </li>

            <li>
                <a href="view/map.php">
                    <i class="fa fa-map-marker"></i>
                    <span>Map</span>
                </a>
            </li>

            <?php if( isAdmin($user->id) ) : ?>
            <li>
                <a href="panel.php">
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