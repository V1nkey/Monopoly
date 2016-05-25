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