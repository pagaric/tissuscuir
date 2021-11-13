-- Suppression des tables

-- Création des tables
CREATE TABLE users(
   id_user INT AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   tel VARCHAR(50),
   inscrit_le DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   password VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_user),
   UNIQUE(email)
);

CREATE TABLE roles(
   id_role INT,
   role VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_role)
);

CREATE TABLE adresses(
   id_adresse INT,
   adresse_1 VARCHAR(255) NOT NULL,
   adresse_2 VARCHAR(255),
   code_postal VARCHAR(5) NOT NULL,
   ville VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_adresse)
);

CREATE TABLE users_roles(
   id_user INT,
   id_role INT,
   PRIMARY KEY(id_user, id_role),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_role) REFERENCES roles(id_role)
);

CREATE TABLE users_adresses(
   id_user INT,
   id_adresse INT,
   PRIMARY KEY(id_user, id_adresse),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_adresse) REFERENCES adresses(id_adresse)
);



