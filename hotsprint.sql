-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2025 às 22:02
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hotsprint`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_acessos`
--

CREATE TABLE `adm_acessos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_acesso` datetime NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `adm_acessos`
--

INSERT INTO `adm_acessos` (`id`, `id_usuario`, `data_acesso`, `ip`) VALUES
(1, 1, '2025-10-01 17:03:03', '::1'),
(2, 1, '2025-10-02 17:55:56', '::1'),
(3, 1, '2025-10-03 15:10:25', '191.52.247.60'),
(4, 1, '2025-10-03 15:10:42', '191.52.247.60');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_config`
--

CREATE TABLE `adm_config` (
  `id` int(1) NOT NULL,
  `nome_empresa` varchar(60) NOT NULL,
  `email_contato` varchar(200) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `celular2` varchar(20) DEFAULT NULL,
  `texto_whatsapp` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `behance` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `google_analytics` varchar(25) DEFAULT NULL,
  `smtp_host` varchar(50) NOT NULL,
  `smtp_user` varchar(50) NOT NULL,
  `smtp_pass` varchar(30) NOT NULL,
  `email_reply` varchar(50) NOT NULL,
  `smtp_port` varchar(5) NOT NULL,
  `incorporar_head` text DEFAULT NULL,
  `incorporar_body` text DEFAULT NULL,
  `instagram_token` varchar(255) DEFAULT NULL,
  `escavacao` varchar(4) DEFAULT NULL,
  `fundacao` varchar(4) DEFAULT NULL,
  `estrutura` varchar(4) DEFAULT NULL,
  `alvenaria` varchar(4) DEFAULT NULL,
  `acabamento_externo` varchar(4) DEFAULT NULL,
  `acabamento_interno` varchar(4) DEFAULT NULL,
  `total` varchar(4) NOT NULL,
  `atualizacao_obras` varchar(30) NOT NULL,
  `atualizado` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `adm_config`
--

INSERT INTO `adm_config` (`id`, `nome_empresa`, `email_contato`, `telefone`, `celular`, `celular2`, `texto_whatsapp`, `facebook`, `instagram`, `twitter`, `linkedin`, `behance`, `youtube`, `google_analytics`, `smtp_host`, `smtp_user`, `smtp_pass`, `email_reply`, `smtp_port`, `incorporar_head`, `incorporar_body`, `instagram_token`, `escavacao`, `fundacao`, `estrutura`, `alvenaria`, `acabamento_externo`, `acabamento_interno`, `total`, `atualizacao_obras`, `atualizado`) VALUES
(1, 'Quax Web', 'contato@ventus.com.br', '.', '46 96414.0000', '', 'Olá! ( Site para construtora )', '', '', '', '', '', '', '', 'mail.quax.com.br', 'envio@quax.com.br', 'U)E07oU)YfkS', 'contato@quax.com.br', '587', '', '', '', '100%', '78%', '50%', '57%', '64%', '73%', '4%', '30 AGOSTO 2024', '2025-10-01 17:04:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_leads`
--

CREATE TABLE `adm_leads` (
  `id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `empresa` varchar(80) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `criado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `adm_leads`
--

INSERT INTO `adm_leads` (`id`, `titulo`, `telefone`, `email`, `empresa`, `mensagem`, `criado`) VALUES
(1, 'Teste offline', '(47) 98798-7979', 'teste@teste.com', 'Quax', 'testes testes', '2025-10-03 14:58:34'),
(2, 'Marlon', '(47) 99903-5542', 'marlon@quax.com.br', 'QUAX', 'LP QUAX teste', '2025-10-03 15:33:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_paginas`
--

CREATE TABLE `adm_paginas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  `conteudo` longtext NOT NULL,
  `description` varchar(160) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'pt',
  `autor` int(11) NOT NULL,
  `criado` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `adm_paginas`
--

INSERT INTO `adm_paginas` (`id`, `titulo`, `permalink`, `arquivo`, `conteudo`, `description`, `lang`, `autor`, `criado`, `atualizado`) VALUES
(1, 'Home', 'index', 'index.php', '', 'A quax é especialista em criar sites para construtoras, sites que geram resultado.', 'pt', 1, '2014-08-08 20:49:46', '2025-10-02 17:59:31'),
(86, 'Política de Privacidade', 'politica-de-privacidade', 'politica-de-privacidade.php', '', '', 'pt', 1, '2021-03-04 09:39:00', '2023-03-07 14:55:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_usuarios`
--

CREATE TABLE `adm_usuarios` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `acesso` varchar(100) NOT NULL,
  `categoria` varchar(20) NOT NULL DEFAULT 'cliente',
  `autor` int(11) NOT NULL,
  `criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `adm_usuarios`
--

INSERT INTO `adm_usuarios` (`id`, `nome_completo`, `usuario`, `senha`, `email`, `acesso`, `categoria`, `autor`, `criado`, `atualizado`) VALUES
(1, 'Admin', 'admin', '$2y$10$VSS09NVcKMkGIh5pgS/FSOw/9RlANSipmCbnax7qwWT7WZOIPNCtS', 'quax@quax.com.br', '4-1-3-2', 'master', 0, '0000-00-00 00:00:00', '2025-10-03 15:10:35');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm_acessos`
--
ALTER TABLE `adm_acessos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ID_USER` (`id_usuario`);

--
-- Índices para tabela `adm_config`
--
ALTER TABLE `adm_config`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_leads`
--
ALTER TABLE `adm_leads`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices para tabela `adm_paginas`
--
ALTER TABLE `adm_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_usuarios`
--
ALTER TABLE `adm_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm_acessos`
--
ALTER TABLE `adm_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `adm_config`
--
ALTER TABLE `adm_config`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `adm_leads`
--
ALTER TABLE `adm_leads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `adm_paginas`
--
ALTER TABLE `adm_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de tabela `adm_usuarios`
--
ALTER TABLE `adm_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `adm_acessos`
--
ALTER TABLE `adm_acessos`
  ADD CONSTRAINT `FK_ID_USER` FOREIGN KEY (`id_usuario`) REFERENCES `adm_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
