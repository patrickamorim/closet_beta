-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 11-Fev-2020 às 01:05
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `closet_beta`
--
-- --------------------------------------------------------

ALTER DATABASE CLOSET_BETA CHARSET = UTF8 COLLATE = utf8_general_ci;

--
-- Estrutura da tabela `caixas`
--

DROP TABLE IF EXISTS `caixas`;
CREATE TABLE IF NOT EXISTS `caixas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `obs` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dinheiro` decimal(10,2) DEFAULT NULL,
  `cartao` decimal(10,2) DEFAULT NULL,
  `outros` decimal(10,2) DEFAULT NULL,
  `abertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamento` timestamp NULL DEFAULT NULL,
  `status` enum('aberto','fechado','fechado com ressalvas') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'aberto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `caixas`
--

INSERT INTO `caixas` (`id`, `obs`, `user`, `dinheiro`, `cartao`, `outros`, `abertura`, `fechamento`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin ', NULL, NULL, NULL, '2020-02-11 00:56:00', NULL, 'aberto', '2020-02-11 00:56:56', '2020-02-11 00:56:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `situacao` enum('cancelada','apto') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'apto',
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `observacao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `limite` decimal(10,2) NOT NULL DEFAULT '500.00',
  `rua` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_cpf_unique` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cpf`, `situacao`, `nome`, `observacao`, `rg`, `nascimento`, `limite`, `rua`, `cidade`, `bairro`, `numero`, `telefone`, `celular`, `email`, `created_at`, `updated_at`) VALUES
(1, '03736623518', 'apto', 'patrick teixeira de amorim santos', '', '1442424244', '1991-01-01', '500.00', 'rua antonio alves de azevedo, centro', 'planalto', 'centro', '489', '7999515415', '77999515415', 'patricktas.dev@gmail.com', '2020-02-11 00:57:17', '2020-02-11 00:57:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `data_ps`
--

DROP TABLE IF EXISTS `data_ps`;
CREATE TABLE IF NOT EXISTS `data_ps` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datasP` date NOT NULL,
  `situacao` enum('aberta','pago') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'aberta',
  `mesesAtrasado` int(11) NOT NULL DEFAULT '0',
  `valorParcela` decimal(5,2) NOT NULL,
  `id_promissoria` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_ps_id_promissoria_foreign` (`id_promissoria`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `data_ps`
--

INSERT INTO `data_ps` (`id`, `datasP`, `situacao`, `mesesAtrasado`, `valorParcela`, `id_promissoria`, `created_at`, `updated_at`) VALUES
(1, '2020-02-01', 'pago', 0, '11.17', 1, '2020-02-11 00:58:17', '2020-02-11 00:58:48'),
(2, '2020-03-01', 'pago', 0, '11.17', 1, '2020-02-11 00:58:17', '2020-02-11 00:58:48'),
(3, '2020-04-01', 'pago', 0, '11.18', 1, '2020-02-11 00:58:17', '2020-02-11 00:58:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `havers`
--

DROP TABLE IF EXISTS `havers`;
CREATE TABLE IF NOT EXISTS `havers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `status` enum('HAVER','QUITAÇÃO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'HAVER',
  `formaPag` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Dinheiro',
  `dataP` date NOT NULL,
  `dataRecebido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_promissoria` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `havers_id_promissoria_foreign` (`id_promissoria`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `havers`
--

INSERT INTO `havers` (`id`, `valor`, `status`, `formaPag`, `dataP`, `dataRecebido`, `id_promissoria`) VALUES
(1, '33.52', 'QUITAÇÃO', 'Dinheiro', '2020-02-10', '2020-02-11 00:58:48', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_caixas`
--

DROP TABLE IF EXISTS `item_caixas`;
CREATE TABLE IF NOT EXISTS `item_caixas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `tipoEpag` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Troco',
  `parcelas` int(10) UNSIGNED DEFAULT NULL,
  `numeroPecas` int(10) UNSIGNED DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendedora` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_caixa` int(10) UNSIGNED NOT NULL,
  `id_vendedora` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_caixas_id_caixa_foreign` (`id_caixa`),
  KEY `item_caixas_id_vendedora_foreign` (`id_vendedora`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `item_caixas`
--

INSERT INTO `item_caixas` (`id`, `valor`, `tipoEpag`, `parcelas`, `numeroPecas`, `time`, `vendedora`, `cliente`, `observacao`, `id_caixa`, `id_vendedora`, `created_at`, `updated_at`) VALUES
(1, '22.00', 'Troco', NULL, NULL, '2020-02-11 00:56:56', 'admin ', NULL, NULL, 1, NULL, '2020-02-11 00:56:56', '2020-02-11 00:56:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `juros`
--

DROP TABLE IF EXISTS `juros`;
CREATE TABLE IF NOT EXISTS `juros` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `situacao` enum('aberto','pago') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'aberto',
  `referencia` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_data_ps` int(10) UNSIGNED NOT NULL,
  `id_promissorias` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `juros_id_data_ps_foreign` (`id_data_ps`),
  KEY `juros_id_promissorias_foreign` (`id_promissorias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2014_10_12_000000_create_users_table', 1),
(50, '2014_10_12_100000_create_password_resets_table', 1),
(51, '2018_01_18_113547_create_vendedoras_table', 1),
(52, '2018_04_05_221344_create_clientes_table', 1),
(53, '2018_04_06_184410_create_promissorias_table', 1),
(54, '2018_04_12_175518_create_havers_table', 1),
(55, '2018_04_13_192736_create_data_ps_table', 1),
(56, '2018_04_13_195005_create_juros_table', 1),
(57, '2018_04_13_202102_create_logs_table', 1),
(58, '2018_04_13_203025_create_valoresfixos_table', 1),
(59, '2019_03_16_204314_create_caixas_table', 1),
(60, '2019_09_24_141143_create_item_caixas_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promissorias`
--

DROP TABLE IF EXISTS `promissorias`;
CREATE TABLE IF NOT EXISTS `promissorias` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendedora` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `promocao` int(11) DEFAULT NULL,
  `numeroPecas` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('aberta','fechada') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'aberta',
  `parcelas` smallint(6) NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_vendedora` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promissorias_id_cliente_foreign` (`id_cliente`),
  KEY `promissorias_id_vendedora_foreign` (`id_vendedora`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `promissorias`
--

INSERT INTO `promissorias` (`id`, `vendedora`, `data`, `valor`, `desconto`, `promocao`, `numeroPecas`, `status`, `parcelas`, `id_cliente`, `id_vendedora`, `created_at`, `updated_at`) VALUES
(1, 'aline silveira costa', '2020-01-01', '33.52', NULL, NULL, 2, 'fechada', 3, 1, 1, '2020-02-11 00:58:17', '2020-02-11 00:58:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `funcao` enum('administrador','caixa') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'caixa',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `funcao`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'administrador', 'admin@gmail.com', '$2y$10$EUuPm9RxDxQF72.jskJTb.QM/IO11/U0GgjmLknR3PCXBSSVw1wFK', NULL, '2020-02-11 00:56:35', '2020-02-11 00:56:35'),
(2, 'operador', 'caixa', 'operador@gmail.com', '$2y$10$MLB.VeZekhq7yjB8yZ7mnO670EQ553VHIIOCu9EhdYlP9FnKyqSFq', NULL, '2020-02-11 00:56:35', '2020-02-11 00:56:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `valoresfixos`
--

DROP TABLE IF EXISTS `valoresfixos`;
CREATE TABLE IF NOT EXISTS `valoresfixos` (
  `juros` decimal(5,2) NOT NULL DEFAULT '2.00',
  `mesesParaCobrar` smallint(6) NOT NULL DEFAULT '2',
  `fonte` smallint(6) NOT NULL DEFAULT '1',
  `comissao` decimal(5,2) NOT NULL DEFAULT '2.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedoras`
--

DROP TABLE IF EXISTS `vendedoras`;
CREATE TABLE IF NOT EXISTS `vendedoras` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `situacao` enum('cancelada','apto') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cancelada',
  `situacaoVendedora` enum('Ativo','Desativado') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Desativado',
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `observacao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `limite` decimal(10,2) NOT NULL DEFAULT '500.00',
  `rua` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendedoras_cpf_unique` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `vendedoras`
--

INSERT INTO `vendedoras` (`id`, `cpf`, `situacao`, `situacaoVendedora`, `nome`, `observacao`, `rg`, `nascimento`, `limite`, `rua`, `cidade`, `bairro`, `numero`, `telefone`, `celular`, `email`, `created_at`, `updated_at`) VALUES
(1, '11111111111', 'cancelada', 'Desativado', 'aline silveira costa', '', '1111111111', '1991-02-03', '500.00', 'ANTONIO ALVES AZEVEDO', 'PLANALTO', 'centro', '158', '7999831692', '77999515415', '', '2020-02-11 00:58:00', '2020-02-11 00:58:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
