/*
** Insertion des données **
*/
-- Suppression
DELETE FROM ipOrdi;
DELETE FROM ipServeur;
DELETE FROM ipService;
DELETE FROM ipDisposer;
-- Insertion
-- ipOrdi
INSERT INTO ipOrdi VALUES 
('1','127.0.0.1','330','70'),
('2','172.16.56.1','40','50'),
('3','172.16.56.2','40','130'),
('4','172.16.56.3','40','510'),
('5','172.16.56.4','260','510'),
('6','172.16.56.5','260','410'),
('7','172.16.56.6','260','310'),
('8','172.16.56.7','260','210'),
('9','172.16.56.8','340','210'),
('10','172.16.56.9','340','310'),
('11','172.16.56.10','340','410'),
('12','172.16.56.11','330','510'),
('13','172.16.56.12','540','510'),
('14','172.16.56.13','540','410'),
('15','172.16.56.14','540','310'),
('16','172.16.56.15','540','150');
-- ipServeur
INSERT INTO ipServeur VALUES ('1','172.16.48.152','800','100');
-- ipService
INSERT INTO ipService VALUES
('20','FTP','940','100'),
('21','FTP','940','130'),
('22','SSH','940','160'),
('80','WEB','940','190');
-- ipDisposer
INSERT INTO ipDisposer VALUES
('1','1','20'),
('2','1','21'),
('3','1','22'),
('4','1','80');


