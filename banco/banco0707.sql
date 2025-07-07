-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para parque
CREATE DATABASE IF NOT EXISTS `parque` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `parque`;

-- Copiando estrutura para tabela parque.criancas
CREATE TABLE IF NOT EXISTS `criancas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datanasc` date DEFAULT NULL,
  `nome_crianca` varchar(150) DEFAULT NULL,
  `nome_responsavel` varchar(150) DEFAULT NULL,
  `cpf_responsavel` varchar(11) DEFAULT NULL,
  `cpf_crianca` varchar(11) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `turno` char(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela parque.criancas: ~2 rows (aproximadamente)
INSERT INTO `criancas` (`id`, `datanasc`, `nome_crianca`, `nome_responsavel`, `cpf_responsavel`, `cpf_crianca`, `telefone`, `turno`, `data`) VALUES
	(2, '2020-07-01', 'Enzo', 'Mãe do Enzo', '69551022653', '19387179028', '(31) 9886-6666', '1', '2025-07-30'),
	(4, '2016-02-04', 'Enzo3', 'Mae do enzo3', '77715001023', '05615038004', '(31) 98433-6655', '2', '2025-07-28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
