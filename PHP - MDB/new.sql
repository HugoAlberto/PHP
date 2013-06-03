-- CREATE TABLE
DROP TABLE IF EXISTS MEDICAMENT;
CREATE TABLE MEDICAMENT
 (
	MED_DEPOTLEGAL			VARCHAR (20) PRIMARY KEY, 
	MED_NOMCOMMERCIAL		VARCHAR (50),
	FAM_CODE			VARCHAR (6),
	MED_COMPOSITION			VARCHAR (255),
	MED_EFFETS			VARCHAR (255),
	MED_CONTREINDIC			VARCHAR (255),
	MED_PRIXECHANTILLON		FLOAT
) ENGINE=INNODB;

-- CREATE TABLE
DROP TABLE IF EXISTS PRATICIEN;
CREATE TABLE PRATICIEN
 (
	PRA_CODE			INTEGER, 
	PRA_NOM				VARCHAR (50),
	PRA_PRENOM			VARCHAR (60),
	PRA_LOGIN			VARCHAR (30),
	PRA_MDP				VARCHAR (30),  
	PRA_ADRESSE			VARCHAR (100),
	PRA_CP				VARCHAR (10),
	PRA_VILLE			VARCHAR (50)
) ENGINE=INNODB;

-- CREATE TABLE
DROP TABLE IF EXISTS COMMENTAIRE;
CREATE TABLE COMMENTAIRE
 (
	COM_CODE			INTEGER, 
	COM_NOTE			TINYINT(20), 
	COM_AVIS			VARCHAR (300)
) ENGINE=INNODB;

INSERT INTO MEDICAMENT VALUES ('3MYC7','TRIMYCINE','CRT','Triamcinolone (acétonide) + Néomycine + Nystatine','Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.','Ce médicament est contre-indiqué en cas dallergie à  lun des constituants, dinfections de la peau ou de parasitisme non traités, dacné. Ne pas appliquer sur une plaie, ni sous un pansement occlusif.','10');

INSERT INTO MEDICAMENT VALUES ('ADIMOL9','ADIMOL','ABP','Amoxicilline + Acide clavulanique','Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas dallergie aux pénicillines ou aux céphalosporines.','15');

INSERT INTO MEDICAMENT VALUES ('AMOPIL7','AMOPIL','ABP','Amoxicilline','Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas dallergie aux pénicillines. Il doit être administré avec prudence en cas dallergie aux céphalosporines.','16');

INSERT INTO PRATICIEN VALUES('1','Jean','Jaques','jean','aze','7 rue des tulipes','05000','Gap');

