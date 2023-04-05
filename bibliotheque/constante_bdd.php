<?php

    //requete inscription
define("INSERTION_INSCRIPTION","INSERT INTO users(nom_user, prenom_user, mail_user,adresse_user, password_user, role) VALUES(?,?,?,?,?,?)");

// requete connexion

define("INSERTION_CONNEXION","SELECT * FROM users WHERE mail_user = ?");

// requete affichage des produits par catégorie

define("AFFICHAGE_CATEGORIE", "SELECT * FROM produits p
                               INNER JOIN categories c ON p.id_categorie = c.id_categorie ORDER BY c.id_categorie");

define("AFFICHAGE_CATEGORIE_ACCUEIL", "SELECT * FROM produits p
                                       INNER JOIN categories c ON p.id_categorie = c.id_categorie GROUP BY c.id_categorie");

// requete utilisateur

define("SHOW_USER", "SELECT * FROM users");
define("SELECT_USER","SELECT * FROM users WHERE id_user = ?");

// requete gestion des roles

define("SELECT_ROLE_USER","SELECT role FROM users WHERE id_user = ?");

define("UPDATE_ROLE_USER","UPDATE users SET role = ? WHERE id_user = ?");

// requete gestion produits page admin

define("INSERTION_PRODUIT","INSERT INTO produits(nom_prod, desc_prod, prix_prod, photo_prod, id_categorie) VALUES (?,?,?,?,?)");

define("SHOW_PROD","SELECT * FROM produits");

define("SELECT_PROD","SELECT * FROM produits WHERE id_prod = ?");

define("AFFICHAGE_PRODUIT_DETAIL", "SELECT * FROM produits p
INNER JOIN categories c ON p.id_categorie = c.id_categorie WHERE p.id_prod = ?");

define("SELECT_CAT","SELECT * FROM categories");

define("MODIF_PRODUIT","UPDATE produits SET nom_prod = ?, desc_prod = ?, prix_prod = ?, photo_prod = ?, id_categorie = ? WHERE id_prod = ? ");

define("MODIF_PROFIL","UPDATE users SET nom_user = ?, prenom_user = ?, mail_user = ?, adresse_user = ?,
                                        ville_user = ?, postal_user = ? WHERE id_user = ?");
// requete panier

define("INSERTION_PANIER", "INSERT INTO panier(id_user, id_prod, id_session) VALUES(?,?,?)");

define("VERIFICATION_PANIER","SELECT id_panier FROM panier WHERE id_user = ? AND id_session = ? AND id_prod = ?");

define("UPDATE_PRODUIT_PANIER","UPDATE panier SET quantite = quantite + 1 WHERE id_panier = ?");

define("UPDATE_PRODUIT_PANIER_MOINS","UPDATE panier SET quantite = quantite - 1 WHERE id_panier = ?");

define("RECUPERATION_PANIER","SELECT * FROM panier p
                              INNER JOIN produits pr ON p.id_prod = pr.id_prod WHERE p.id_session = ?");

// requete session

define("RECUPERATION_USER_SESSION"," SELECT * FROM user_session WHERE id_session = ?");

define("UPDATE_SESSION_PANIER", "UPDATE panier SET id_session = ? WHERE id_user = ?");

define("INSERTION_ROLE_SESSION", "INSERT INTO user_session( id_session, id_user) VALUES (?,?)");

define("GET_SESSION", "SELECT u.id_user as id_user , u.role as role FROM user_session s
                       INNER JOIN users u ON s.id_user = u.id_user WHERE s.id_session = ?");