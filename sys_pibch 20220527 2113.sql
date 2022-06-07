--
-- Script was generated by Devart dbForge Studio 2019 for MySQL, Version 8.1.45.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 27/5/2022 9:13:54 p.m.
-- Server version: 5.7.24
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

--
-- Set default database
--
USE sys_pibch;

--
-- Drop table `ciclo`
--
DROP TABLE IF EXISTS ciclo;

--
-- Drop table `materia`
--
DROP TABLE IF EXISTS materia;

--
-- Drop table `periodo`
--
DROP TABLE IF EXISTS periodo;

--
-- Set default database
--
USE sys_pibch;

--
-- Create table `periodo`
--
CREATE TABLE periodo (
  id INT(11) NOT NULL AUTO_INCREMENT,
  anio INT(11) DEFAULT NULL,
  createdat TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  createdby VARCHAR(255) DEFAULT NULL,
  updatedat TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updatedby VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_general_ci;

--
-- Create table `materia`
--
CREATE TABLE materia (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) DEFAULT NULL,
  descripcion VARCHAR(255) DEFAULT NULL,
  uv INT(11) DEFAULT NULL,
  createdat TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  createdby VARCHAR(255) DEFAULT NULL,
  updatedat TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updatedby VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_general_ci;

--
-- Create table `ciclo`
--
CREATE TABLE ciclo (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50) DEFAULT NULL,
  orden INT(11) DEFAULT NULL,
  createddat TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  createdby VARCHAR(255) DEFAULT NULL,
  updatedat TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updatedby VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_general_ci;

-- 
-- Dumping data for table periodo
--
-- Table sys_pibch.periodo does not contain any data (it is empty)

-- 
-- Dumping data for table materia
--
-- Table sys_pibch.materia does not contain any data (it is empty)

-- 
-- Dumping data for table ciclo
--
-- Table sys_pibch.ciclo does not contain any data (it is empty)

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;