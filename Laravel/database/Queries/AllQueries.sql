use db_aim;

-- 📌🐣⚡🌬️⭐🎗️🤍🎉🛑❤️🐅🦛🦞 Il a beaucoup des requêtes n'ont pAS encore été traitées

# Nomber Par Role, URL : /DAShboard (admin)
SELECT role,nom, count(*) AS count FROM users
WHERE role!='admin'
GROUP BY role;

# Les Listes des roles,URL : /tables/{tableName}
SELECT * FROM users
NATURAL JOIN etudiants ; # Name of table cames FROM URI example : /professeurs/ or /etudiants/ etc..

# Les listes des filiere et les Module, URL : /filiere
SELECT f.designation AS FiliereName, m.designation AS ModuleName FROM filieres f
NATURAL JOIN modules m ;

# Les listes des groupes, URL : /filiere/{filiere_id} (admin)
SELECT designation FROM groupes
WHERE filiere_id='';

# Les listes des groupes de une professeur, URL : /groupes (professeur)
SELECT * FROM groupe_details
WHERE professeur_id=''; -- prof id will come FROM auth

# apres professeur choisi groupe, URL : /groupes/{groupe_id} (professeur)
SELECT designation FROM groupe_details
WHERE professeur_id='' AND groupe_id=''; -- prof id will come FROM auth

# Les listes des notes par filiere, groupe et module URL : /filiere/{module_id}/{groupe_id}/notes (admin)
SELECT f.designation AS filiereName,
		g.designation AS groupeName,
        u.nom AS etudiantName,
        u.prenom AS etudiantPrenom, 
        n.controle_1 AS controle_1,
        n.controle_2 AS controle_2,
        n.exam AS exam FROM notes n
NATURAL JOIN etudiants e 
NATURAL JOIN groupes g 
NATURAL JOIN  filieres f 
NATURAL JOIN  users u 
WHERE n.module_id='' AND g.id='' -- module id AND groupe id will come FROM URL
GROUP BY e.id;

# Les listes des tps par filiere et par groupe, URL : /tps/{module_id}/{groupe_id} (professeur,etudiant)
SELECT sujet,description,dateFin FROM tps
WHERE groupe_id='' AND module_id='' AND professeur_id='';

# Les listes des devoirs par filiere et par groupe URL :  /devoirs/{module_id}/{groupe_id} (professeur)
SELECT u.nom, u.prenom, reponses ,d.created_at AS submited_at FROM devoirs d
NATURAL JOIN etudiants e 
NATURAL JOIN  users u 
WHERE groupe_id='' AND module_id=''; -- module id AND groupe id will come FROM URL
