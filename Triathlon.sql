--
-- Table structure for table `concurrent`
--
CREATE DATABASE triathlon DEFAULT CHARSET=utf8;
use triathlon;

DROP TABLE IF EXISTS concurrent;

CREATE TABLE concurrent (
  dossardC varchar(6) NOT NULL,
  nomC varchar(50),
  genreC varchar(10),
  categorieC varchar(3),
  natationC float(3),
  cyclismeC float(3),
  courseC float(3),
  PRIMARY KEY  (dossardC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--  data for table concurrent
--
INSERT INTO concurrent
VALUES 
('100','Hugo', 'Garçon', 'U11',0,0,0),
('101','Ella', 'Fille', 'U13',0,0,0),
('102','Allan', 'Garçon', 'U13',0,0,0),
('103','Milan', 'Garçon', 'U11',0,0,0),
('104','Sarah', 'Fille', 'U15',0,0,0)
;

`concurrent`