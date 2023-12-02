CREATE DATABASE IF NOT EXISTS itatbalstadienests;
USE itatbalstadienests;

CREATE TABLE IF NOT EXISTS lietotaji(
	Lietotajs_id INT NOT NULL AUTO_INCREMENT,
    Lietotajvards VARCHAR(60) NOT NULL,
    Parole VARCHAR(250) NOT NULL,
    Epasts VARCHAR(80) NOT NULL,
    Tips ENUM("Administrātors", "Lietotājs", "Viesis") NOT NULL,
    PRIMARY KEY (Lietotajs_id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS darbinieki(
	Darbinieks_id INT NOT NULL AUTO_INCREMENT,
    Vards VARCHAR(60) NOT NULL,
    Uzvards VARCHAR(60) NOT NULL,
    Talrunis BIGINT(11) NOT NULL,
    Epasts VARCHAR(80) NOT NULL,
    Dzimsanas_datums DATE NOT NULL,
    Maksa_stunda FLOAT NOT NULL,
    Darba_uzsaksanas_datums DATE NOT NULL,
    Darba_aiziesanas_datums DATE DEFAULT NULL,
    PRIMARY KEY(Darbinieks_id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS statusi(
	Statuss_id INT NOT NULL AUTO_INCREMENT,
    Statusa_nosaukums VARCHAR(50) NOT NULL,
    PRIMARY KEY(Statuss_id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS pieteikuma_temati(
	Pieteikuma_temata_id INT NOT NULL AUTO_INCREMENT,
    Pieteikuma_temats VARCHAR(60) NOT NULL,
    PRIMARY KEY (Pieteikuma_temata_id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS klienti(
	Klients_id INT NOT NULL AUTO_INCREMENT,
    Vards VARCHAR(60) NULL DEFAULT NULL,
    Uzvards VARCHAR(60) NOT NULL,
    Talrunis BIGINT(11) NOT NULL,
    Epasts VARCHAR(80),
    Adrese VARCHAR(100) NOT NULL,
    Pirmais_pieteikums DATE NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (Klients_id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS piezimes(
	Piezime_id INT NOT NULL AUTO_INCREMENT,
    Piezime VARCHAR(1000),
    PRIMARY KEY (Piezime_id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS problempieteikumi(
	Pieteikums_id INT NOT NULL AUTO_INCREMENT,
    Id_lietotajs INT NULL,
    Id_darbinieks INT NOT NULL,
    Id_klients INT NOT NULL,
    Id_statuss INT NULL DEFAULT 1,
    Id_pieteikuma_temats INT NOT NULL,
    Id_piezime INT DEFAULT NULL,
    Problema VARCHAR(1000) NOT NULL,
    Iesniegsanas_datums TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Apskatisanas_datums DATETIME NULL DEFAULT NULL,
    Pabeigsanas_datums DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (Pieteikums_id),
    INDEX (Id_lietotajs),
    INDEX (Id_darbinieks),
    INDEX (Id_klients),
    INDEX (Id_statuss),
    INDEX (Id_pieteikuma_temats), 
    INDEX (Id_piezime),
    CONSTRAINT parvalda
    FOREIGN KEY (Id_lietotajs)
    REFERENCES lietotaji (Lietotajs_id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT pienem
    FOREIGN KEY (Id_darbinieks)
    REFERENCES darbinieki (Darbinieks_id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT apraksta
    FOREIGN KEY (Id_piezime)
    REFERENCES piezimes (Piezime_id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT ir
    FOREIGN KEY (Id_statuss)
    REFERENCES statusi (Statuss_id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT ir_par
    FOREIGN KEY (Id_pieteikuma_temats)
    REFERENCES pieteikuma_temati (Pieteikuma_temata_id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT piesaka
    FOREIGN KEY (Id_klients)
    REFERENCES klienti (Klients_id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO lietotaji (Lietotajvards, Parole, Epasts, Tips)
VALUES ("admin", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "admin@epasts.lv", "Administrātors"),
("matiss", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "matiss@epasts.lv", "Administrātors"),
("janis", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "janis@epasts.lv", "Lietotājs"),
("liene", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "liene@epasts.lv", "Lietotājs"),
("peteris123", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "peteris@epasts.lv", "Lietotājs"),
("berzins", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "berzins@epasts.lv", "Lietotājs"),
("viesis", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "viesis@epasts.lv", "Viesis"),
("maris", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "maris@epasts.lv", "Viesis"),
("anna", "$2y$10$Y9DMOd4sXh09mMVjlbIuU.Is0FUZg6Xd2ZwZ1bQo4.ldZz3KpE/7S", "anna@epasts.lv", "Viesis");

INSERT INTO darbinieki (Vards, Uzvards, Talrunis, Epasts, Dzimsanas_datums, Maksa_stunda, Darba_uzsaksanas_datums, Darba_aiziesanas_datums)
VALUES ("Jānis", "Berziņš", 28111111, "berzins@epasts.lv", "1992-11-05", 6.50, "2021-02-04", NULL),
("Ieva", "Liepa", 28222222, "ieva.liepa@epasts.lv", "1996-03-23", 6.50, "2021-06-12", NULL),
("Pēteris", "Ozols", 28333333, "ozols21@epasts.lv", "1993-12-12", 6.70, "2021-10-24", NULL),
("Laura", "Zīle", 28444444, "l.zile@epasts.lv", "1999-08-21", 7.00, "2020-01-24", "2021-06-12"),
("Juris", "Klaips", 28555555, "klaips01@epasts.lv", "2001-12-21", 6.40, "2021-12-04", NULL),
("Linda", "Austre", 28666666, "austre@epasts.lv", "1994-05-01", 6.70, "2021-10-24", NULL),
("Agris", "Malks", 28777777, "agris@epasts.lv", "1992-12-12", 6.70, "2020-10-22", "2021-01-01"),
("Olga", "Bize", 28777742, "olga.bize@epasts.lv", "1990-12-12", 6.70, "2020-09-12", "2020-12-23"),
("Madara", "Cīrule", 28740277, "madara@epasts.lv", "1994-12-12", 6.70, "2020-05-16", "2020-10-12");

INSERT INTO statusi (Statusa_nosaukums)
VALUES ("Iesniegts"),
("Apskatīts"),
("Procesā"),
("Atcelts"),
("Atrisināts"),
("Neizpildīts"),
("Nepieņemts");

INSERT INTO pieteikuma_temati (Pieteikuma_temats)
VALUES ("Iekārtas problēma"),
("Programmatūras problēma"),
("Nezināms"),
("Cits"),
("Ražojuma defekts"),
("Tīš bojājums"),
("Jauns temats");

INSERT INTO klienti (Vards, Uzvards, Talrunis, Epasts, Adrese, Pirmais_pieteikums)
VALUES ("Kārlis", "Krūze", 28121212, "kruze.karlis@epasts.lv", "Priekules iela 4, Liepāja", "2021-12-04"),
(NULL, "Sīle", 29111111, "eva.sile@epasts.lv", "Rīgas iela 1, Rīga", "2021-08-23"),
("Zane", "Zemgale", 26112222, "zane@epasts.lv", "Grobiņas iela, Priekule", "2021-12-02"),
(NULL, "Pauls", 28999999, "r.pauls@epasts.lv", "Zāļu iela 3, Rīga", "2020-09-12"),
(NULL, "Zālīte", 29127643, "zalite@epasts.lv", "Zaru iela 1, Liepāja", "2021-05-02"),
("Egils", "Gricmanis", 26893401, "egils.gricmanis@epasts.lv", "Kuldīgas iela 65, Ventspils", "2020-04-22"),
("Sigita", "Kūma", 29129043, "kuma89@epasts.lv", "Smilšu iela 3, Daugavpils", "2021-02-19"),
("Matīss", "Ozols", 26821401, "ozols@epasts.lv", "Kuldīgas iela 2, Jūrmala", "2021-06-22"),
("Paula", "Āboliņa", 28123143, "paula21@epasts.lv", "Saules iela 3, Daugavpils", "2021-03-02");

INSERT INTO piezimes (Piezime)
VALUES (NULL),
("Ierīcei ir mitruma bojājumi."),
(NULL),
("Iespējams bojāta telefona atmiņas karte."),
("Nepieciešams instalēt jaunu OS (operētāj sistēmu)."),
("Nepieciešams programmatūras atjauninājums."),
(NULL);

INSERT INTO problempieteikumi (Id_lietotajs, Id_darbinieks, Id_klients, Id_statuss, Id_pieteikuma_temats, Id_piezime, Problema, Iesniegsanas_datums, Apskatisanas_datums, Pabeigsanas_datums)
VALUES 	(1, 6, 1, 1, 1, 1, "Nav iespējasm ieslēgt portatīvo datoru, pēc jaudas pogas nospiešanas ekrāns joprojām ir melns.", "2021-12-04 12:15:23", NULL, NULL),
		(1, 1, 2, 2, 1, 2, "Zem telefona ekrāna ir redzams sārmojums, ekrāns nav responsīvs.", 									"2021-08-23 10:03:25", "2021-08-25 11:45:31", NULL),
		(2, 5, 3, 1, 2, 3, "Digitālā rokaspulksteņa ekrāns nereaģē uz pieskārieniem, nav pieejamas papildiespējas.", 		"2021-12-02 13:09:11", NULL, NULL),
		(3, 2, 4, 7, 3, 4, "Problēmas ar telefonu, nevar piekļūt saglabātajiem attēliem.", 										"2020-09-12 08:45:53", "2020-09-15 13:23:05", "2020-09-15 13:23:05"),
		(5, 3, 5, 5, 4, 5, "Datoram ir novecojusi operetājsistēma, nav pieejami sistēmas atjauninājumi.", 						"2021-05-02 14:10:26", "2021-05-12 16:03:26", "2021-05-12 16:03:26"),
		(4, 4, 6, 5, 2, 6, "Nevar palaist programmu, uzrāda kļūdu 'neatbilstoša programmas versija'.", 							"2020-04-22 15:49:10", "2020-04-26 09:58:30", "2020-04-26 09:58:30"),
		(3, 1, 7, 4, 1, 7, "Datoram nevaru pieslēgt virtuālās brilles (VR).", 													"2021-02-19 11:01:30", "2021-03-02 12:00:00", "2021-03-02 12:00:00");
        
/*------------------------------------------------------------------------------------------------------skati------------------------------------------------------------------------------------------------------*/

CREATE OR REPLACE VIEW pieteikumu_informacija AS
SELECT p.Pieteikums_id, l.Lietotajvards AS "Pēdējais administrētājs", d.Darbinieks_id, CONCAT(d.Vards," ",d.Uzvards) AS "Atbildīgais darbinieks", k.Klients_id, CONCAT(COALESCE(k.Vards,"")," ",k.Uzvards) AS Klients, 
s.Statuss_id, s.Statusa_nosaukums AS "Pieteikuma statuss", pt.Pieteikuma_temata_id, pt.Pieteikuma_temats AS "Pieteikuma temats", pie.Piezime_id, pie.Piezime AS "Darbinieka piezīme", 
p.Problema AS "Problēmas apraksts", p.Iesniegsanas_datums AS "Problēmas iesniegšanas datums", p.Apskatisanas_datums AS "Pēdējās pieteikuma izmaiņas veiktas", p.Pabeigsanas_datums AS "Problēmas atrisināšanas datums"
FROM problempieteikumi AS p
JOIN lietotaji AS l
ON Id_lietotajs = Lietotajs_id
JOIN darbinieki AS d
ON Id_darbinieks = Darbinieks_id
JOIN klienti AS k
ON Id_klients = Klients_id
JOIN statusi AS s
ON Id_statuss = Statuss_id
JOIN pieteikuma_temati AS pt
ON Id_pieteikuma_temats = Pieteikuma_temata_id
LEFT JOIN piezimes AS pie
ON Id_piezime = pie.Piezime_id
ORDER BY p.Iesniegsanas_datums DESC;

CREATE OR REPLACE VIEW pieteikumu_informacija_vecakie AS
SELECT p.Pieteikums_id, l.Lietotajvards AS "Pēdējais administrētājs", d.Darbinieks_id, CONCAT(d.Vards," ",d.Uzvards) AS "Atbildīgais darbinieks", k.Klients_id, CONCAT(COALESCE(k.Vards,"")," ",k.Uzvards) AS Klients, 
s.Statuss_id, s.Statusa_nosaukums AS "Pieteikuma statuss", pt.Pieteikuma_temata_id, pt.Pieteikuma_temats AS "Pieteikuma temats", pie.Piezime_id, pie.Piezime AS "Darbinieka piezīme", 
p.Problema AS "Problēmas apraksts", p.Iesniegsanas_datums AS "Problēmas iesniegšanas datums", p.Apskatisanas_datums AS "Pēdējās pieteikuma izmaiņas veiktas", p.Pabeigsanas_datums AS "Problēmas atrisināšanas datums"
FROM problempieteikumi AS p
JOIN lietotaji AS l
ON Id_lietotajs = Lietotajs_id
JOIN darbinieki AS d
ON Id_darbinieks = Darbinieks_id
JOIN klienti AS k
ON Id_klients = Klients_id
JOIN statusi AS s
ON Id_statuss = Statuss_id
JOIN pieteikuma_temati AS pt
ON Id_pieteikuma_temats = Pieteikuma_temata_id
LEFT JOIN piezimes AS pie
ON Id_piezime = pie.Piezime_id
ORDER BY p.Iesniegsanas_datums ASC;

CREATE OR REPLACE VIEW noslegti_problempieteikumi AS
SELECT p.Pieteikums_id, l.Lietotajvards AS "Pēdējais administrētājs", d.Darbinieks_id, CONCAT(d.Vards," ",d.Uzvards) AS "Atbildīgais darbinieks", k.Klients_id, CONCAT(COALESCE(k.Vards,"")," ",k.Uzvards) AS Klients, 
s.Statuss_id, s.Statusa_nosaukums AS "Pieteikuma statuss", pt.Pieteikuma_temata_id, pt.Pieteikuma_temats AS "Pieteikuma temats", pie.Piezime_id, pie.Piezime AS "Darbinieka piezīme", 
p.Problema AS "Problēmas apraksts", p.Iesniegsanas_datums AS "Problēmas iesniegšanas datums", p.Apskatisanas_datums AS "Pēdējās pieteikuma izmaiņas veiktas", p.Pabeigsanas_datums AS "Problēmas atrisināšanas datums"
FROM problempieteikumi AS p
JOIN lietotaji AS l
ON Id_lietotajs = Lietotajs_id
JOIN darbinieki AS d
ON Id_darbinieks = Darbinieks_id
JOIN klienti AS k
ON Id_klients = Klients_id
JOIN statusi AS s
ON Id_statuss = Statuss_id
JOIN pieteikuma_temati AS pt
ON Id_pieteikuma_temats = Pieteikuma_temata_id
LEFT JOIN piezimes AS pie
ON Id_piezime = pie.Piezime_id
WHERE p.Pabeigsanas_datums IS NOT NULL AND s.Statuss_id BETWEEN 4 AND 7
ORDER BY p.Iesniegsanas_datums DESC;

CREATE OR REPLACE VIEW atrisinati_problempieteikumi AS
SELECT p.Pieteikums_id, l.Lietotajvards AS "Pēdējais administrētājs", d.Darbinieks_id, CONCAT(d.Vards," ",d.Uzvards) AS "Atbildīgais darbinieks", k.Klients_id, CONCAT(COALESCE(k.Vards,"")," ",k.Uzvards) AS Klients, 
s.Statuss_id, s.Statusa_nosaukums AS "Pieteikuma statuss", pt.Pieteikuma_temata_id, pt.Pieteikuma_temats AS "Pieteikuma temats", pie.Piezime_id, pie.Piezime AS "Darbinieka piezīme", 
p.Problema AS "Problēmas apraksts", p.Iesniegsanas_datums AS "Problēmas iesniegšanas datums", p.Apskatisanas_datums AS "Pēdējās pieteikuma izmaiņas veiktas", p.Pabeigsanas_datums AS "Problēmas atrisināšanas datums"
FROM problempieteikumi AS p
JOIN lietotaji AS l
ON Id_lietotajs = Lietotajs_id
JOIN darbinieki AS d
ON Id_darbinieks = Darbinieks_id
JOIN klienti AS k
ON Id_klients = Klients_id
JOIN statusi AS s
ON Id_statuss = Statuss_id
JOIN pieteikuma_temati AS pt
ON Id_pieteikuma_temats = Pieteikuma_temata_id
LEFT JOIN piezimes AS pie
ON Id_piezime = pie.Piezime_id
WHERE s.Statusa_nosaukums = "Atrisināts"
ORDER BY p.Iesniegsanas_datums DESC;

CREATE OR REPLACE VIEW neatrisinati_problempieteikumi AS
SELECT p.Pieteikums_id, l.Lietotajvards AS "Pēdējais administrētājs", d.Darbinieks_id, CONCAT(d.Vards," ",d.Uzvards) AS "Atbildīgais darbinieks", k.Klients_id, CONCAT(COALESCE(k.Vards,"")," ",k.Uzvards) AS Klients, 
s.Statuss_id, s.Statusa_nosaukums AS "Pieteikuma statuss", pt.Pieteikuma_temata_id, pt.Pieteikuma_temats AS "Pieteikuma temats", pie.Piezime_id, pie.Piezime AS "Darbinieka piezīme", 
p.Problema AS "Problēmas apraksts", p.Iesniegsanas_datums AS "Problēmas iesniegšanas datums", p.Apskatisanas_datums AS "Pēdējās pieteikuma izmaiņas veiktas", p.Pabeigsanas_datums AS "Problēmas atrisināšanas datums"
FROM problempieteikumi AS p
JOIN lietotaji AS l
ON Id_lietotajs = Lietotajs_id
JOIN darbinieki AS d
ON Id_darbinieks = Darbinieks_id
JOIN klienti AS k
ON Id_klients = Klients_id
JOIN statusi AS s
ON Id_statuss = Statuss_id
JOIN pieteikuma_temati AS pt
ON Id_pieteikuma_temats = Pieteikuma_temata_id
LEFT JOIN piezimes AS pie
ON Id_piezime = pie.Piezime_id
WHERE Id_statuss BETWEEN 1 AND 3
ORDER BY Iesniegsanas_datums ASC;

CREATE OR REPLACE VIEW neatjaunoti_problempieteikumi AS
SELECT p.Pieteikums_id, l.Lietotajvards AS "Pēdējais administrētājs", d.Darbinieks_id, CONCAT(d.Vards," ",d.Uzvards) AS "Atbildīgais darbinieks", k.Klients_id, CONCAT(COALESCE(k.Vards,"")," ",k.Uzvards) AS Klients, 
s.Statuss_id, s.Statusa_nosaukums AS "Pieteikuma statuss", pt.Pieteikuma_temata_id, pt.Pieteikuma_temats AS "Pieteikuma temats", pie.Piezime_id, pie.Piezime AS "Darbinieka piezīme", 
p.Problema AS "Problēmas apraksts", p.Iesniegsanas_datums AS "Problēmas iesniegšanas datums", p.Apskatisanas_datums AS "Pēdējās pieteikuma izmaiņas veiktas", p.Pabeigsanas_datums AS "Problēmas atrisināšanas datums"
FROM problempieteikumi AS p
JOIN lietotaji AS l
ON Id_lietotajs = Lietotajs_id
JOIN darbinieki AS d
ON Id_darbinieks = Darbinieks_id
JOIN klienti AS k
ON Id_klients = Klients_id
JOIN statusi AS s
ON Id_statuss = Statuss_id
JOIN pieteikuma_temati AS pt
ON Id_pieteikuma_temats = Pieteikuma_temata_id
LEFT JOIN piezimes AS pie
ON Id_piezime = pie.Piezime_id
WHERE p.Apskatisanas_datums IS NULL
ORDER BY p.Iesniegsanas_datums DESC;

CREATE OR REPLACE VIEW jaunakie_klienti AS
SELECT * 
FROM klienti 
ORDER BY Pirmais_pieteikums DESC, Klients_id DESC;

CREATE OR REPLACE VIEW vecakie_klienti AS
SELECT * 
FROM klienti 
ORDER BY Pirmais_pieteikums ASC, Klients_id ASC;

CREATE OR REPLACE VIEW kartot_klienti_vards AS
SELECT * 
FROM klienti 
ORDER BY Vards;

CREATE OR REPLACE VIEW kartot_klienti_uzvards AS
SELECT * 
FROM klienti 
ORDER BY Uzvards;

CREATE OR REPLACE VIEW stradajosie_darbinieki AS
SELECT *
FROM darbinieki
WHERE Darba_aiziesanas_datums IS NULL OR Darba_aiziesanas_datums = "0000-00-00"
ORDER BY Darba_uzsaksanas_datums DESC;


CREATE OR REPLACE VIEW atlaistie_darbinieki AS
SELECT *
FROM darbinieki
WHERE Darba_aiziesanas_datums > "0000-00-00"
ORDER BY Darba_aiziesanas_datums DESC;

/*-----------------------------------------------------saglabātās procedūras-----------------------------------------------------*/

DELIMITER $$
CREATE PROCEDURE atrast_klientu (vertiba VARCHAR(60))
BEGIN
	SELECT *
	FROM klienti
	WHERE Vards = vertiba OR Uzvards = vertiba
    ORDER BY Pirmais_pieteikums DESC, Klients_id DESC;
END $$

#CALL atrast_klientu ('');

DELIMITER $$
CREATE PROCEDURE dzest_klientu (id INT)
BEGIN
	DELETE
	FROM klienti
	WHERE Klients_id = id;
END $$

DELIMITER $$
CREATE PROCEDURE dzest_piezimi (id INT)
BEGIN
	DELETE
	FROM piezimes
	WHERE Piezime_id = id;
END $$

DELIMITER $$
CREATE PROCEDURE dzest_pieteikumu (id INT)
BEGIN
	DELETE
	FROM problempieteikumi
	WHERE Pieteikums_id = id;
END $$

DELIMITER $$
CREATE PROCEDURE pievienot_lietotaju (username VARCHAR(60), pass VARCHAR(250), email VARCHAR(80), lTips VARCHAR(20))
BEGIN
	INSERT INTO lietotaji (Lietotajvards, Parole, Epasts, Tips) 
    VALUES (username, pass, email, lTips);
END $$

/*-----------------------------------------------------DB lietotājs-----------------------------------------------------*/

CREATE USER 'mndienests'@localhost IDENTIFIED BY 'Parole1';
GRANT ALL PRIVILEGES ON itatbalstadienests.* TO 'mndienests'@localhost;
FLUSH PRIVILEGES;






