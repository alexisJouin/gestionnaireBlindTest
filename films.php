<html>
<head>
    <title>Blind Test</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <img src="Blind Test.png">
        <h1>Blind Test</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="films.php">Musiques de Films</a></li>
            <li><a href="emissions.php">Musiques d'émissions</a></li>
            <li><a href="80.php">Musiques des années 80</a></li>
            <li><a href="90.php">Musiques des années 90</a></li>
            <li><a href="2000.php">Musiques des années 2000</a></li>
        </ul>
    </nav>
    <div>
        <h2>Musiques de films</h2>
        <form method="post">


        <p>Question : Quel est le titre de ce film ?</p>
        

            <?php
        
        session_start();
        $dossier = 'music';
        
        // Tableau contenant les noms des dossiers à explorer
        $dossiers = array('films');
        
        // Tableau pour stocker les fichiers trouvés
        $fichiers = array();

        // Boucle sur les dossiers pour récupérer les fichiers
        foreach ($dossiers as $dossier_nom) {
            $dossier_complet = $dossier . '/' . $dossier_nom;
            // Si le dossier existe
            if (file_exists($dossier_complet)) {
                // Récupération de la liste des fichiers dans le dossier
                $fichiers_dossier = glob($dossier_complet . '/*.*');
                // Ajout des fichiers trouvés au tableau
                $fichiers = array_merge($fichiers, $fichiers_dossier);
            }
        }
        
        //Fonction qui découpe le nom du fichier pour séparer les info
        function découpe($fichier_aleatoire){
            $découpe = explode('_', $fichier_aleatoire);
            $_SESSION['annee'] = $découpe[1];
            $nomExtension = $découpe[2];
            $découpeNomExtension = explode('.',$nomExtension);
            $_SESSION['nom'] = $découpeNomExtension[0]; 
            $_SESSION['nom'] = str_replace("-"," ",$_SESSION['nom']);
            //Affichage des info
            echo "<p>nom du film: ".$_SESSION['nom']."<br>"; 
            echo "année: ".$_SESSION['annee']."</p>";
        }

        function aléatoire($fichiers){
            global $point;
            // Choix aléatoire d'un fichier dans le tableau
            $fichier_aleatoire = $fichiers[array_rand($fichiers)];
            
            // Affichage du nom du fichier choisi
            
            echo "<audio controls autoplay>";
            echo "<source src='",$fichier_aleatoire,"' type='audio/mpeg'>";
            echo "</audio>";
            découpe($fichier_aleatoire);
            echo "<p>le fichier de la musique est ".$fichier_aleatoire."</p>";
            echo "<p>nb de points ".$_SESSION['points']."<p>";
            
        }

        if (!isset($_SESSION['points'])) {
            $_SESSION['points'] = -1;
        }
        if (isset($_POST['boutonValider'])) {
            if ($_POST['answer']==$_SESSION['nom']){
                $_SESSION['points']++;
                if($_SESSION['points']>3){
                    echo "<h2>Vous avez gagne!</h2>";
                    session_destroy();
                }else{
                    echo aléatoire($fichiers);
                }
            }else{
                echo aléatoire($fichiers);
            }
            
        }

        if (isset($_POST["boutonReset"])){
            session_destroy();
            $_SESSION['points']=-1;
        }
        
        //programme pour fair un tableau avec les données json
        $json_data = file_get_contents('music/musique.json');
        $data = json_decode($json_data, true);

        // foreach ($data as $themes => $theme) {
        //     echo $themes . ":\n";
        //     echo "<br>";
        //     foreach ($theme as $nom => $tana) {
        //         echo " " . $nom . "\n";
        //         echo"<br>";
        //         foreach ($tana as $tana_key => $values) {
        //             echo "     " . $tana_key . ": " . $values . "\n";
        //             echo"<br>";
        //         }
        //     }
        // }

    ?>
            <input type="text" name="answer" placeholder="Votre réponse">
            <button type="submit" name="boutonValider">Valider</button>
            <input type="submit" name="boutonReset" value="reset">

        </form>
    </div>
    <footer>
        <p>© 2023 Blind Test. Tous droits réservés sinon le procès assuré.</p>
    </footer>
</body>
</html>