-- Step : 01
-- **************************************************************
-- Doel : Maak een nieuwe database aan die heet `Achtbaan-2408b`
-- **************************************************************
-- Versie   Datum          Auteur               Omschrijving
-- ******   *****          ******               ************
-- 01       13-11-2024     Arjan de Ruijter     Datase Hoogste Achtbanen   
--                                              van Europa
-- ***************************************************************

-- Verwijder database `Achtbaan-2408b` als die bestaat
DROP DATABASE IF EXISTS `Achtbaan-2408b`;

-- Maak de database `Achtbaan-2408b` aan
CREATE DATABASE `Achtbaan-2408b`;

-- Gebruik de database `Achtbaan-2408b`
USE `Achtbaan-2408b`;

-- Step : 02
-- ********************************************************************
-- Doel : Maak een nieuwe tabel aan die heet HoogsteAchtbaanVanEuropa
-- ******************************************************************
-- Versie   Datum          Auteur               Omschrijving
-- ******   *****          ******               ************
-- 01       13-11-2024     Arjan de Ruijter     Tabel Hoogste Achtbanen   
--                                              van Europa
-- *********************************************************************

-- Maak een tabel HoogsteAchtbaanVanEuropa
CREATE TABLE HoogsteAchtbaanVanEuropa
(
     Id                  SMALLINT        UNSIGNED       NOT NULL    AUTO_INCREMENT
    ,NaamAchtbaan        VARCHAR(50)                    NOT NULL
    ,NaamPretPark        VARCHAR(50)                    NOT NULL
    ,Land                VARCHAR(50)                    NOT NULL
    ,Topsnelheid         TINYINT         UNSIGNED       NOT NULL
    ,Hoogte              TINYINT         UNSIGNED       NOT NULL
    ,IsActief            BIT                            NOT NULL    DEFAULT 1
    ,Opmerking           VARCHAR(255)                       NULL    DEFAULT NULL
    ,DatumAangemaakt     DATETIME(6)                    NOT NULL
    ,DatumGewijzigd      DATETIME(6)                    NOT NULL
    ,CONSTRAINT          PK_HoogsteAchtbaanVanEuropa    PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;