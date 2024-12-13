<?php
# Initialize the session
session_start();

#  guardiing
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}

include "../production/classe/activite.php";
$Activite = new Activite();
$listActivite = $Activite->listActivite();
include "../production/classe/abonnement.php";

if (isset($_POST['add_Abonnement'])) {
    $Abonnement = new Abonnement();
    $addAbonnement = $Abonnement->addAbonnement($_POST);
    header("location: listeAbon.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salle de sport | </title>
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<body onload="hideMessage()" class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="ajouterAbon.php" class="site_title"><i class="fa fa-paw"></i> <span>Salle de sport</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="images/bolbol.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome</span>
                            <h2> <?= htmlspecialchars($_SESSION["username"]); ?></h2>
                        </div>
                    </div>

                    <br />

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Admin</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Utilisateur <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="ajouterU.php">Ajouter utilisateur</a></li>
                                        <li><a href="listeU.php">Liste utilisateur</a></li>
                                    </ul>
                                </li>
                            
                                <li><a><i class="fa fa-desktop"></i> Activité <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="ajouterAct.php">Ajouter Activité</a></li>
                                        <li><a href="listeAct.php">Liste activité</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Entraineur <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="ajouterEn.php">Ajouter entraineur</a></li>
                                        <li><a href="listeEn.php">liste entraineur</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i> Emploi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="ajouterEmp.php">Ajouter emploi</a></li>
                                        <li><a href="listeEmp.php">Liste emploi</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-clone"></i>Abonnement <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="ajouterAbon.php">Ajouter abonnement</a></li>
                                        <li><a href="listeAbon.php">Liste abonnement</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-clone"></i>Salle<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="ajouterSalle.php">Ajouter salle</a></li>

                                        <li><a href="listeSalle.php">Liste salle</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>


                    </div>

                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="index.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/bolbol.jpg" alt=""> 
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                   
                                    <a class="dropdown-item" href="./logout.php"><i class="fa fa-sign-out pull-right"></i> Déconnecter</a>
                                </div>
                            </li>

                            
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Ajouter abonnement </h3>
                        </div>

                    
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                                      <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a class="dropdown-item" href="#">Settings 1</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form method="post" action="">
                                        <div class="row">

                                            <div class="form-group col-12">

                                                <label for="inputDuree">Sélectionner une activité</label>
                                                <select name="activite[]" class="form-control multiple-select" id="" multiple>
                                                    <?php
                                                    while ($c = $listActivite->fetch()) {
                                                        echo "<option value='{$c['id']}'>{$c['nom']}</option>";
                                                    }
                                                    ?>
                                                </select>



                                            </div>

                                            <div class="form-group col-4">
                                                <label for="inputMaxParticipants">Prix mois</label>
                                                <input name="mois" type="number" class="form-control" id="inputMaxParticipants" placeholder="Prix mois">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputMaxParticipants">Prix semester</label>
                                                <input name="semester" type="number" class="form-control" id="inputMaxParticipants" placeholder="Prix semester">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputMaxParticipants">Prix annuel</label>
                                                <input name="annuel" type="number" class="form-control" id="inputMaxParticipants" placeholder="Prix annuel">
                                            </div>



                                            <div class="form-group col-12 text-center">
                                                <button type="submit" name="add_Abonnement" class="btn btn-primary">Ajouter l'abonnement</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>
    <script>
        function hideMessage() {
            setTimeout(function() {
                document.getElementById('message').style.display = 'none';

            }, 2000);
        }
    </script>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".multiple-select").select2({
            //   maximumSelectionLength: 2
        });
    </script>
</body>

</html>