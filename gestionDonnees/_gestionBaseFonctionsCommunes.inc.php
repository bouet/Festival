<?

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirReqIdNomEtablissements()
{
   $req="select id, nom from Etablissement order by id";
   return $req;
}

function obtenirReqIdNomEtablissementsOffrantChambres()
{
   $req="select distinct id, nom from Etablissement, Offre where id = idEtab 
   order by id";
   return $req;
}

function obtenirReqNomEtablissementsOffrantChambres()
{
   $req="select distinct nom from Etablissement, Offre where id = idEtab 
   order by id";
   return $req;
}

function obtenirReqIdEtablissementsOffrantChambres()
{
   $req="select distinct id from Etablissement, Offre where id = idEtab 
   order by id";
   return $req;
}

function obtenirDetailEtablissement($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);
      $req="select * from Etablissement where id='$id'";
      $rsEtab=mysql_query($req,$connexion);
      return mysql_fetch_array($rsEtab);
   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function supprimerEtablissement($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);


      $req="delete from Etablissement where id='$id'";
      mysql_query($req,$connexion);

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}
 
function creerModifierEtablissement($mode, $id, $nom, $adresseRue, $codePostal, 
                                    $ville, $tel, $adresseElectronique, $type, 
                                    $civiliteResponsable, $nomResponsable, 
                                    $prenomResponsable)
{  
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $nom=str_replace("'", "''", $nom);
      $adresseRue=str_replace("'","''",$adresseRue);
      $ville=str_replace("'","''",$ville);
      $adresseElectronique=str_replace("'","''",$adresseElectronique);
      $nomResponsable=str_replace("'","''",$nomResponsable);
      $prenomResponsable=str_replace("'","''",$prenomResponsable);
      if ($mode=='C')
      {
         $req="insert into Etablissement values ('$id', '$nom', '$adresseRue',
               '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type',
               '$civiliteResponsable', '$nomResponsable', '$prenomResponsable')";
      }
      else
      {
         $req="update Etablissement set nom='$nom',adresseRue='$adresseRue',
              codePostal='$codePostal',ville='$ville',tel='$tel',
              adresseElectronique='$adresseElectronique',type='$type',
              civiliteResponsable='$civiliteResponsable',nomResponsable=
              '$nomResponsable',prenomResponsable='$prenomResponsable'
              where id='$id'";
      }
      mysql_query($req,$connexion);



   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function estUnIdEtablissement($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select * from Etablissement where id='$id'";
      $rsEtab=mysql_query($req,$connexion);
      return mysql_fetch_array($rsEtab);

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function estUnNomEtablissement($mode, $id, $nom)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $nom=str_replace("'", "''", $nom);
      // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
      // on vérifie la non existence d'un autre établissement (id!='$id') portant
      // le même nom
      if ($mode=='C')
      {
         $req="select * from Etablissement where nom='$nom'";
      }
      else
      {
         $req="select * from Etablissement where nom='$nom' and id!='$id'";
      }
      $rsEtab=mysql_query($req,$connexion);
      return mysql_fetch_array($rsEtab);
   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function obtenirNbEtab()
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);
      $req="select count(*) as nombreEtab from Etablissement";
      $rsEtab=mysql_query($req,$connexion);
      $lgEtab=mysql_fetch_array($rsEtab);
      return $lgEtab["nombreEtab"];

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function obtenirNbEtabOffrantChambres()
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select count(distinct idEtab) as nombreEtabOffrantChambres from Offre";
      $rsEtabOffrantChambres=mysql_query($req,$connexion);
      $lgEtabOffrantChambres=mysql_fetch_array($rsEtabOffrantChambres);
      return $lgEtabOffrantChambres["nombreEtabOffrantChambres"];

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// FONCTIONS DE GESTION DES TYPES DE CHAMBRES

function obtenirReqTypesChambres()
{
   $req="Select * from TypeChambre";
   return $req;
}

function obtenirReqIdTypesChambres()
{
   $req="select id from TypeChambre";
   return $req;
}

function obtenirReqLibelleTypesChambres()
{
   $req="select libelle from TypeChambre order by id";
   return $req;
}

function obtenirLibelleTypeChambre($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select libelle from TypeChambre where id = '$id'";
      $rsTypeChambre=mysql_query($req,$connexion);
      $lgTypeChambre=mysql_fetch_array($rsTypeChambre);
      return $lgTypeChambre["libelle"];

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function obtenirNbTypesChambres()
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select count(*) as nombreTypesChambres from TypeChambre";
      $rsNbTypesChambres=mysql_query($req,$connexion);
      $lgNbTypesChambres=mysql_fetch_array($rsNbTypesChambres);
      return $lgNbTypesChambres["nombreTypesChambres"];

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function supprimerTypeChambre($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="delete from TypeChambre where id='$id'";
      mysql_query($req,$connexion);
   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function obtenirDetailTypeChambre($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);
      $req="select * from TypeChambre where id='$id'";
      $rsTypeChambre=mysql_query($req,$connexion);
      $lgTypeChambre=mysql_fetch_array($rsTypeChambre);
      return $lgTypeChambre;

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function creerModifierTypeChambre($mode, $id, $libelle)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $libelle=str_replace("'","''",$libelle);
      if ($mode=='C')
      {
         $req="insert into TypeChambre values ('$id', '$libelle')";
      }
      else
      {
         $req="update TypeChambre set libelle='$libelle' where id='$id'";
      }
      mysql_query($req,$connexion);


   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());

   }

}

function estUnIdTypeChambre($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select * from TypeChambre where id='$id'";
      $rsTypeChambre=mysql_query($req,$connexion);
      return mysql_fetch_array($rsTypeChambre);
   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

function estUnLibelleTypeChambre($mode, $id, $libelle)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $libelle=str_replace("'","''",$libelle);
      // S'il s'agit d'une création, on vérifie juste la non existence du libellé
      // sinon on vérifie la non existence d'un autre type chambre (id!='$id')
      // ayant le même libelle
      if ($mode=='C')
      {
         $req="select * from TypeChambre where libelle='$libelle'";
      }
      else
      {
         $req="select * from TypeChambre where libelle='$libelle' and id!='$id'";
      }
      $rsTypeChambre=mysql_query($req,$connexion);
      return mysql_fetch_array($rsTypeChambre);

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $req="select id, nom from Groupe where hebergement='O' order by id";
   return $req;
}

function obtenirNomGroupe($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select nom from Groupe where id='$id'";
      $rsGroupe=mysql_query($req,$connexion);
      $lgGroupe=mysql_fetch_array($rsGroupe);
      return $lgGroupe["nom"];

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// FONCTIONS RELATIVES AUX OFFRES

// Met à jour (suppression, modification ou ajout) l'offre correspondant à l'id
// étab et à l'id type chambre transmis
function modifierOffreHebergement($idEtab,$idTypeChambre,$nbChambresDemandees)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select nombreChambres from Offre where idEtab='$idEtab' and
           idTypeChambre='$idTypeChambre'";
      $rsOffre=mysql_query($req,$connexion);
      $lgOffre=mysql_fetch_array($rsOffre);
      if($nbChambresDemandees==0)
         $req="delete from Offre where idEtab='$idEtab' and idTypeChambre=
              '$idTypeChambre'";
      else
      {
         if($lgOffre["nombreChambres"]!=0)
            $req="update Offre set nombreChambres=$nbChambresDemandees where
                 idEtab='$idEtab' and idTypeChambre='$idTypeChambre'";
         else
            $req="insert into Offre values('$idEtab','$idTypeChambre',
                 $nbChambresDemandees)";
      }
      mysql_query($req,$connexion);

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// Retourne le nombre de chambres offertes pour l'id étab et l'id type chambre 
// transmis
function obtenirNbOffre($idEtab, $idTypeChambre)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select nombreChambres from Offre where idEtab='$idEtab' and
           idTypeChambre='$idTypeChambre'";
      $rsOffre=mysql_query($req, $connexion);
      if ($lgOffre=mysql_fetch_array($rsOffre))
         return $lgOffre["nombreChambres"];
      else
         return 0;

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement et le type de chambre transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($idEtab,$idTypeChambre,$nombreChambres)
{
   $nbOccup=obtenirNbOccup($idEtab,$idTypeChambre);
   return ($nombreChambres>=$nbOccup);
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select * From Attribution where idEtab='$id'";
      $rsAttrib=mysql_query($req, $connexion);
      return mysql_fetch_array($rsAttrib);
   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// Teste la présence d'attributions pour le type de chambre transmis 
function existeAttributionsTypeChambre($id)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select * From Attribution where idTypeChambre='$id'";
      $rsAttrib=mysql_query($req, $connexion);
      return mysql_fetch_array($rsAttrib);
   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

// Retourne le nombre de chambres occupées pour l'id étab et l'id type chambre
// transmis
function obtenirNbOccup($idEtab, $idTypeChambre)
{
   $hote="localhost";
   $login="festival";
   $mdp="J'aimeraisbeaucoupunmotdepassepourletpsi7";
   $bd="festival";
   $connexion=mysql_connect($hote,$login,$mdp);
   if ($connexion)
   {
      $query="SET CHARACTER SET utf8";
      // modification du jeu de caractères de la connexion
      $res=mysql_query($query, $connexion);
      mysql_select_db($bd, $connexion);

      $req="select IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
           Attribution where idEtab='$idEtab' and idTypeChambre='$idTypeChambre'";
      $rsOccup=mysql_query($req,$connexion);
      $lgOccup=mysql_fetch_array($rsOccup);
      return $lgOccup["totalChambresOccup"];

   }
   else
   {
      ajouterErreur("Echec de la connexion au serveur MySQL");
      ajouterErreur(" => " . mysql_error());
   }

}

?>
