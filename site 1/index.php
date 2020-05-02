<?php
session_start();
?>
<html>
		<head>
   			 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
			<title>Trombinoscope-API</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body class='nocenter'>
			<div class="navbar">
			<?php
			if (isset($_SESSION['login'])) {
				echo' 
               	<h1>Trombinoscope-API</h1>
                <a href="deconnexion.php">Déconnexion</a>
                <a href="api.php">Cle API</a>
                <a href="acceuil.php">Profil</a>
                <a href="index.php">Documentation</a>';
			}
			else{
               echo' 
               <h1>Trombinoscope-API</h1>
                <a href="inscription.php">Inscription</a>
                <a href="connexion.php">Connexion</a>
                <a href="index.php">Documentation</a>
                ';
            }
            ?>
                
    </div>
   <div id='doc'>
   	<section>
   		<article>
   		<h2>Description de l'API </h2>
   		<p>
   			Vous pouvez appeler l'API par nom de filiere ou nom de groupe. L'API répond avec une liste d'élves ou d'information correspondent au filiere ou groupe recherché.
   		</p>
   		<h3>Appel API</h3>
   		<p>
   			Pour cette API il existe trois urls qui nous permettent de retourner 3 page JSON. Pour cela, voila les urls et leur descripion :
   		</p>

   			<h4>Information des filieres</h4>
   			<p class="url">
   				http://trombinoscope-api.alwaysdata.net/data.php?requete=filiere&key={Your Key}
   			</p>
   			<p>
   				Cette URL permet d'afficher les informations sur les filieres du département informatique. Cela va retourner toute les filieres et les groupes corespondant au département indormatique.
   			</p>
   			<h4> Eleves par filieres</h4>
   			<p class="url">http://trombinoscope-api.alwaysdata.net/data.php?filiere={Filiere}&key={Your Key}</p>
   			<p> 
   				Cette URL permet d'afficher tout les éléves de chaque filieres. Il existe 4 filiere dans le département informatique qui sont les suivante :
   			</p>
   				<table>
   					<thead> <!-- En-tête du tableau -->
       				<tr>
           				<th>Filiere</th>
           				<th colspan="3">Groupe</th>
       				</tr>
   					</thead>

   					<tbody> <!-- Corps du tableau -->
      					 <tr>
          					 <td>LPI</td>
          					 <td>L1</td>
          					 <td>L2</td>
          					 <td>L3</td>
      					 </tr>
      					 <tr>
           					<td>MIPI</td>
          					 <td>L1</td>
          					 <td>L2</td>
          					 <td>L3</td>
      					 </tr>
       					<tr>
           					<td>LPI-RIWS</td>
          					 <td>L1</td>
          					 <td>L2</td>
          					 <td>L3</td>
       					</tr>
       					<tr>
          				 <td>LPI-RS</td>
           				<td>L1</td>
          				<td>L2</td>
          				<td>L3</td>
       					</tr>
       				</tbody>
       			</table>
       		<h4> Eleves par filieres et groupe </h4>
   			<p class="url">http://trombinoscope-api.alwaysdata.net/data.php?filiere={Filiere}&groupe={Group}&key={Your Key}</p>
   			<p> 
   				Cette URL permet d'afficher les éléves du groupe de la filiere rechercher. 
   			</p>
   		</article>
   	</section>
   </div>
<footer>
   <p>Copyright © Wasef Alexandra</p> 
</footer>
</div>
</body>
</html>