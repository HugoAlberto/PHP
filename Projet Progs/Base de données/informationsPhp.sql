-- Script de création de la base de données. Boulouk Hugo 2013-02-05
-- Suppression des tables si elles existes.
drop table if exists Programmeur, Fonction, Script;

-- Création de la table programmeur.
create table Programmeur(
    proNum tinyint AUTO_INCREMENT,
    proNom varchar(20),
    proPrenom varchar(20),
    primary key(proNum));

-- Création de la table fonction.
create table Fonction(
    fonNum tinyint AUTO_INCREMENT,
    fonNom varchar(40),
    fonDate date,
    fonStatut varchar(40),
    fonRole varchar(40),
    proNum tinyint NOT NULL,
    primary key(fonNum));

-- Création de la table script.
create table Script(
    scrNum tinyint,
    scrNom varchar(40),
    scrEmplacement varchar(40),
    fonNum tinyint NOT NULL,
    primary key(scrNum));

-- Ajout des clés étrangères.
alter table Fonction
add foreign key (proNum) references Programmeur (proNum);
alter table Script
add foreign key (fonNum) references Fonction (fonNum);

-- Ajout de données dans la base.
insert into Programmeur values('0', 'Alberto', 'Hugo');
insert into Programmeur values('1', 'Pignoly', 'Frederic');
insert into Programmeur values('2', 'Rochas', 'Yoann');
insert into Programmeur values('3', 'Jean', 'Paul');
insert into Programmeur values('4', 'Johan', 'Jacques');
insert into Fonction values(NULL,'Hello World','2013-02-05','En cours de développement','Dit bonjour','01');
insert into Fonction values(NULL,'Pendu','2013-02-03','Fonctionnel','Jeu','02');
insert into Fonction values(NULL,'Calculatrice','2013-03-04','Fonctionnel','Calcule','03');
insert into Fonction values(NULL,'Ordinateur','2013-01-24','En cours de développement','Reflechi','01');
insert into Fonction values(NULL,'Mistigri','2013-02-16','Fonctionnel','Jeu','02');
insert into Fonction values(NULL,'Couleur','2013-12-13','Fonctionnel','Aide','03');
insert into Script values('01', 'HelloWorld.cpp', '~/', '01');
insert into Script values('02', 'LePendu.cpp', '~/Desktop/Le_pendu', '02');
insert into Script values('03', 'Calculatrice.cpp', '~/Desktop/Calculatrice', '03');
insert into Script values('04', 'Ordinateur.cpp', '~/Sys32/Windows', '04');
insert into Script values('05', 'Mistigri.cpp', '~/SLAM2/Mistigri', '05');
insert into Script values('06', 'Couleur.php', '~/Desktop', '06');
