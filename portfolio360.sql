-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 03-Jun-2016 às 15:17
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portfolio360`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `access_log`
--

CREATE TABLE IF NOT EXISTS `access_log` (
  `id_access_log` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip_usuario` varchar(20) NOT NULL,
  `data_acesso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite`
--

CREATE TABLE IF NOT EXISTS `convite` (
  `id_convite` int(11) NOT NULL,
  `fk_id_pessoa` int(11) NOT NULL COMMENT 'Pessoa que envio o convite',
  `email` varchar(100) NOT NULL COMMENT 'Email de quem vai ser convidado',
  `token` varchar(255) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `falso` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_uso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL COMMENT '	',
  `nome_cur` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome_cur`) VALUES
(1, 'Administração'),
(2, 'Agronomia'),
(3, 'Biomedicina'),
(6, 'Ciência da Computação'),
(4, 'Ciências Biológicas'),
(5, 'Ciências Contábeis'),
(23, 'Ciências Sociais'),
(7, 'Comunicação Social'),
(8, 'Direito'),
(9, 'Economia'),
(24, 'Educação Física'),
(10, 'Enfermagem'),
(11, 'Engenharia Civil'),
(12, 'Engenharia de Produção'),
(13, 'Engenharia Elétrica'),
(14, 'Engenharia Mecânica'),
(15, 'Engenharia Química'),
(25, 'Filosofia'),
(16, 'Física'),
(17, 'Geografia'),
(26, 'História'),
(27, 'Letras'),
(18, 'Línguas Estrangeiras Aplicadas - LEA'),
(21, 'Matemática'),
(19, 'Medicina'),
(20, 'Medicina Veterinária'),
(29, 'Outro'),
(28, 'Pedagogia'),
(22, 'Química');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nome_dpt` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nome_dpt`) VALUES
(2, 'DCAA - Departamento de Ciências Agrárias e Ambientais'),
(3, 'DCAC - Departamento de Administração e Ciências Contábeis'),
(4, 'DCB - Departamento de Ciências Biológicas'),
(5, 'DCEC - Departamento de Ciências Econômicas'),
(6, 'DCET - Departamento de Ciências Exatas e Tecnológicas'),
(7, 'DCIE - Departamento de Ciências da Educação'),
(9, 'DCIJUR - Departamento de Ciências Jurídicas'),
(8, 'DCS - Departamento de Ciências da Saúde'),
(10, 'DFCH - Departamento de Filosofia e Ciências Humanas'),
(11, 'DLA - Departamento de Letras e Artes'),
(1, 'Outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE IF NOT EXISTS `equipamento` (
  `id_equipamento` int(11) NOT NULL,
  `nome_eqp` varchar(100) NOT NULL,
  `fabricante_eqp` varchar(100) NOT NULL,
  `quantidade_eqp` int(11) NOT NULL,
  `especificacao_eqp` text NOT NULL,
  `descricao_eqp` text NOT NULL,
  `ativo_eqp` int(11) NOT NULL DEFAULT '1',
  `last_modified_eqp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=692 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento_has_img`
--

CREATE TABLE IF NOT EXISTS `equipamento_has_img` (
  `id_equipamento_img` int(11) NOT NULL,
  `fk_id_img_equipamento` int(11) NOT NULL,
  `fk_id_equipamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `img_equipamento`
--

CREATE TABLE IF NOT EXISTS `img_equipamento` (
  `id_img_equipamento` int(11) NOT NULL,
  `nome_ime` varchar(60) NOT NULL,
  `nome_antigo_ime` varchar(60) NOT NULL,
  `tamanho_ime` float NOT NULL,
  `extensao_ime` varchar(5) NOT NULL,
  `ativo_ime` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=803 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `img_laboratorio`
--

CREATE TABLE IF NOT EXISTS `img_laboratorio` (
  `id_img_laboratorio` int(11) NOT NULL,
  `nome_iml` varchar(60) NOT NULL,
  `nome_antigo_iml` varchar(60) NOT NULL,
  `tamanho_iml` float NOT NULL,
  `extensao_iml` varchar(5) NOT NULL,
  `ativo_iml` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio`
--

CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `nome_lab` varchar(200) NOT NULL,
  `ramal_lab` varchar(15) DEFAULT NULL,
  `website_lab` varchar(100) DEFAULT NULL,
  `descricao_lab` text NOT NULL,
  `atividades_lab` text NOT NULL,
  `areas_atendidas_lab` text NOT NULL,
  `multiusuario_lab` varchar(3) NOT NULL,
  `usa_ensino_lab` varchar(3) NOT NULL,
  `usa_pesquisa_lab` varchar(3) NOT NULL,
  `usa_extensao_lab` varchar(3) NOT NULL,
  `last_modified_lab` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_id_pavilhao` int(11) NOT NULL,
  `ativo_lab` int(11) NOT NULL DEFAULT '1',
  `palavras_chave` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio_has_curso`
--

CREATE TABLE IF NOT EXISTS `laboratorio_has_curso` (
  `id_laboratorio_curso` int(11) NOT NULL,
  `fk_id_laboratorio` int(11) NOT NULL,
  `fk_id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio_has_departamento`
--

CREATE TABLE IF NOT EXISTS `laboratorio_has_departamento` (
  `id_laboratorio_departamento` int(11) NOT NULL,
  `fk_id_laboratorio` int(11) NOT NULL,
  `fk_id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio_has_equipamento`
--

CREATE TABLE IF NOT EXISTS `laboratorio_has_equipamento` (
  `id_laboratorio_equipamento` int(11) NOT NULL,
  `fk_id_equipamento` int(11) NOT NULL,
  `fk_id_laboratorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio_has_img`
--

CREATE TABLE IF NOT EXISTS `laboratorio_has_img` (
  `id_laboratorio_img` int(11) NOT NULL,
  `fk_id_laboratorio` int(11) NOT NULL,
  `fk_id_img_laboratorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio_has_pessoa`
--

CREATE TABLE IF NOT EXISTS `laboratorio_has_pessoa` (
  `id_laboratorio_pessoa` int(11) NOT NULL,
  `fk_id_laboratorio` int(11) NOT NULL,
  `fk_id_pessoa` int(11) NOT NULL,
  `permissao_lhp` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pavilhao`
--

CREATE TABLE IF NOT EXISTS `pavilhao` (
  `id_pavilhao` int(11) NOT NULL,
  `nome_pav` varchar(90) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pavilhao`
--

INSERT INTO `pavilhao` (`id_pavilhao`, `nome_pav`) VALUES
(15, 'Base Ambiental'),
(1, 'CBG - Centro de Biotecnologia e Genética'),
(2, 'CME - Centro de Microscopia Eletrônica'),
(3, 'CPqCTR - Centro de Pesquisas em Ciências e Tecnologias das Radiações'),
(4, 'Hospital Veterinário'),
(5, 'NBCGIB - Núcleo de Biologia Computacional e Gestão de Informações Biotecnológicas'),
(8, 'Pavilhão Adonias Filho'),
(11, 'Pavilhão Agroindústria'),
(13, 'Pavilhão de Ciências Exatas e Tecnológicas'),
(10, 'Pavilhão Jorge Amado'),
(6, 'Pavilhão Juizado Modelo'),
(12, 'Pavilhão Manoel Fontes Nabuco'),
(7, 'Pavilhão Pedro Calmon'),
(9, 'Pavilhão Professor Max de Menezes'),
(14, 'Torre Administrativa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_cadastro`
--

CREATE TABLE IF NOT EXISTS `pedido_cadastro` (
  `id_pedido_cadastro` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `falso` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_uso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `id_permissao` int(11) NOT NULL,
  `descricao_per` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id_permissao`, `descricao_per`) VALUES
(1, 'Administrador'),
(2, 'Coordenador'),
(3, 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome_pes` varchar(50) NOT NULL,
  `email_pes` varchar(45) NOT NULL,
  `cpf_pes` varchar(14) NOT NULL,
  `ramal_pes` varchar(15) DEFAULT NULL,
  `lattes_pes` varchar(70) DEFAULT NULL,
  `website_pes` varchar(50) DEFAULT NULL,
  `fk_id_tipo_pessoa` int(11) NOT NULL,
  `fk_id_departamento` int(11) NOT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL,
  `birthday_pes` date NOT NULL,
  `sexo_pes` char(1) NOT NULL,
  `ativo_pes` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome_pes`, `email_pes`, `cpf_pes`, `ramal_pes`, `lattes_pes`, `website_pes`, `fk_id_tipo_pessoa`, `fk_id_departamento`, `fk_id_usuario`, `birthday_pes`, `sexo_pes`, `ativo_pes`) VALUES
(1, 'Admin 360', 'uesc360@uesc.br', '', '(73) 3680-5392', '', 'http://nit.uesc.br/uesc360/sobre', 5, 6, 1, '2016-04-01', 'M', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `id_recuperar_senha` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `falso` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_uso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pessoa`
--

CREATE TABLE IF NOT EXISTS `tipo_pessoa` (
  `id_tipo_pessoa` int(11) NOT NULL,
  `tipo_tip` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_pessoa`
--

INSERT INTO `tipo_pessoa` (`id_tipo_pessoa`, `tipo_tip`) VALUES
(1, 'ALUNO'),
(2, 'COORDENADOR'),
(3, 'PROFESSOR'),
(4, 'SETOR'),
(5, 'TÉCNICO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL,
  `login_usu` varchar(50) NOT NULL,
  `senha_usu` varchar(50) NOT NULL,
  `ativo_usu` int(11) NOT NULL DEFAULT '1',
  `permissao_usu` int(11) NOT NULL DEFAULT '3',
  `first_access_usu` int(11) NOT NULL DEFAULT '1',
  `data_cadastro_usu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login_usu`, `senha_usu`, `ativo_usu`, `permissao_usu`, `first_access_usu`, `data_cadastro_usu`) VALUES
(1, 'uesc360@uesc.br', '792cb6752e0ffb1b80413655eaa3b63e9d9b0a74', 1, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_has_permissao`
--

CREATE TABLE IF NOT EXISTS `usuario_has_permissao` (
  `id_usuario_has_permissao` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_permissao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_has_permissao`
--

INSERT INTO `usuario_has_permissao` (`id_usuario_has_permissao`, `fk_id_usuario`, `fk_id_permissao`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_log`
--
ALTER TABLE `access_log`
  ADD PRIMARY KEY (`id_access_log`);

--
-- Indexes for table `convite`
--
ALTER TABLE `convite`
  ADD PRIMARY KEY (`id_convite`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome_cur`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome_dpt`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id_equipamento`);

--
-- Indexes for table `equipamento_has_img`
--
ALTER TABLE `equipamento_has_img`
  ADD PRIMARY KEY (`id_equipamento_img`),
  ADD KEY `fk_id_img_equipamento_idx` (`fk_id_img_equipamento`),
  ADD KEY `fk_id_equipamento_idx` (`fk_id_equipamento`);

--
-- Indexes for table `img_equipamento`
--
ALTER TABLE `img_equipamento`
  ADD PRIMARY KEY (`id_img_equipamento`);

--
-- Indexes for table `img_laboratorio`
--
ALTER TABLE `img_laboratorio`
  ADD PRIMARY KEY (`id_img_laboratorio`);

--
-- Indexes for table `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome_lab`),
  ADD KEY `fk_id_pavilhao_idx` (`fk_id_pavilhao`);

--
-- Indexes for table `laboratorio_has_curso`
--
ALTER TABLE `laboratorio_has_curso`
  ADD PRIMARY KEY (`id_laboratorio_curso`),
  ADD KEY `fk_id_laboratorio_idx` (`fk_id_laboratorio`),
  ADD KEY `fk_curso_idx` (`fk_id_curso`);

--
-- Indexes for table `laboratorio_has_departamento`
--
ALTER TABLE `laboratorio_has_departamento`
  ADD PRIMARY KEY (`id_laboratorio_departamento`),
  ADD KEY `fk_id_laboratorio_idx` (`fk_id_laboratorio`),
  ADD KEY `fk_id_departamento_idx` (`fk_id_departamento`);

--
-- Indexes for table `laboratorio_has_equipamento`
--
ALTER TABLE `laboratorio_has_equipamento`
  ADD PRIMARY KEY (`id_laboratorio_equipamento`),
  ADD KEY `fk_id_equipamento_idx` (`fk_id_equipamento`),
  ADD KEY `fk_id_laboratorio_idx` (`fk_id_laboratorio`);

--
-- Indexes for table `laboratorio_has_img`
--
ALTER TABLE `laboratorio_has_img`
  ADD PRIMARY KEY (`id_laboratorio_img`),
  ADD KEY `fk_id_laboratorio_idx` (`fk_id_laboratorio`),
  ADD KEY `fk_id_img_laboratorio_idx` (`fk_id_img_laboratorio`);

--
-- Indexes for table `laboratorio_has_pessoa`
--
ALTER TABLE `laboratorio_has_pessoa`
  ADD PRIMARY KEY (`id_laboratorio_pessoa`),
  ADD KEY `fk_id_laboratorio_idx` (`fk_id_laboratorio`),
  ADD KEY `fk_id_pessoa_idx` (`fk_id_pessoa`);

--
-- Indexes for table `pavilhao`
--
ALTER TABLE `pavilhao`
  ADD PRIMARY KEY (`id_pavilhao`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome_pav`);

--
-- Indexes for table `pedido_cadastro`
--
ALTER TABLE `pedido_cadastro`
  ADD PRIMARY KEY (`id_pedido_cadastro`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id_permissao`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD KEY `fk_id_usuario_idx` (`fk_id_usuario`),
  ADD KEY `fk_id_tipo_pessoa_idx` (`fk_id_tipo_pessoa`),
  ADD KEY `fk_id_departamento_idx` (`fk_id_departamento`);

--
-- Indexes for table `recuperar_senha`
--
ALTER TABLE `recuperar_senha`
  ADD PRIMARY KEY (`id_recuperar_senha`);

--
-- Indexes for table `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  ADD PRIMARY KEY (`id_tipo_pessoa`),
  ADD UNIQUE KEY `tipo_UNIQUE` (`tipo_tip`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login_usu`);

--
-- Indexes for table `usuario_has_permissao`
--
ALTER TABLE `usuario_has_permissao`
  ADD PRIMARY KEY (`id_usuario_has_permissao`),
  ADD KEY `fk_usuario` (`fk_id_usuario`),
  ADD KEY `fk_permissao` (`fk_id_permissao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_log`
--
ALTER TABLE `access_log`
  MODIFY `id_access_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `convite`
--
ALTER TABLE `convite`
  MODIFY `id_convite` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id_equipamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=692;
--
-- AUTO_INCREMENT for table `equipamento_has_img`
--
ALTER TABLE `equipamento_has_img`
  MODIFY `id_equipamento_img` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `img_equipamento`
--
ALTER TABLE `img_equipamento`
  MODIFY `id_img_equipamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=803;
--
-- AUTO_INCREMENT for table `img_laboratorio`
--
ALTER TABLE `img_laboratorio`
  MODIFY `id_img_laboratorio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `laboratorio_has_curso`
--
ALTER TABLE `laboratorio_has_curso`
  MODIFY `id_laboratorio_curso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratorio_has_departamento`
--
ALTER TABLE `laboratorio_has_departamento`
  MODIFY `id_laboratorio_departamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratorio_has_equipamento`
--
ALTER TABLE `laboratorio_has_equipamento`
  MODIFY `id_laboratorio_equipamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratorio_has_img`
--
ALTER TABLE `laboratorio_has_img`
  MODIFY `id_laboratorio_img` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratorio_has_pessoa`
--
ALTER TABLE `laboratorio_has_pessoa`
  MODIFY `id_laboratorio_pessoa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pavilhao`
--
ALTER TABLE `pavilhao`
  MODIFY `id_pavilhao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pedido_cadastro`
--
ALTER TABLE `pedido_cadastro`
  MODIFY `id_pedido_cadastro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id_permissao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `recuperar_senha`
--
ALTER TABLE `recuperar_senha`
  MODIFY `id_recuperar_senha` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  MODIFY `id_tipo_pessoa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `usuario_has_permissao`
--
ALTER TABLE `usuario_has_permissao`
  MODIFY `id_usuario_has_permissao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=137;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `equipamento_has_img`
--
ALTER TABLE `equipamento_has_img`
  ADD CONSTRAINT `fk_ei_id_equipamento` FOREIGN KEY (`fk_id_equipamento`) REFERENCES `equipamento` (`id_equipamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ei_id_img_equipamento` FOREIGN KEY (`fk_id_img_equipamento`) REFERENCES `img_equipamento` (`id_img_equipamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD CONSTRAINT `fk_lab_id_pavilhao` FOREIGN KEY (`fk_id_pavilhao`) REFERENCES `pavilhao` (`id_pavilhao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `laboratorio_has_curso`
--
ALTER TABLE `laboratorio_has_curso`
  ADD CONSTRAINT `fk_lc_curso` FOREIGN KEY (`fk_id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lc_id_laboratorio` FOREIGN KEY (`fk_id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `laboratorio_has_departamento`
--
ALTER TABLE `laboratorio_has_departamento`
  ADD CONSTRAINT `fk_ld_id_departamento` FOREIGN KEY (`fk_id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ld_id_laboratorio` FOREIGN KEY (`fk_id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `laboratorio_has_equipamento`
--
ALTER TABLE `laboratorio_has_equipamento`
  ADD CONSTRAINT `fk_le_id_equipamento` FOREIGN KEY (`fk_id_equipamento`) REFERENCES `equipamento` (`id_equipamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_le_id_laboratorio` FOREIGN KEY (`fk_id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `laboratorio_has_img`
--
ALTER TABLE `laboratorio_has_img`
  ADD CONSTRAINT `fk_li_id_img_laboratorio` FOREIGN KEY (`fk_id_img_laboratorio`) REFERENCES `img_laboratorio` (`id_img_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_li_id_laboratorio` FOREIGN KEY (`fk_id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `laboratorio_has_pessoa`
--
ALTER TABLE `laboratorio_has_pessoa`
  ADD CONSTRAINT `fk_lp_id_laboratorio` FOREIGN KEY (`fk_id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lp_id_pessoa` FOREIGN KEY (`fk_id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `fk_pes_id_departamento` FOREIGN KEY (`fk_id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pes_id_tipo_pessoa` FOREIGN KEY (`fk_id_tipo_pessoa`) REFERENCES `tipo_pessoa` (`id_tipo_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pes_id_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_has_permissao`
--
ALTER TABLE `usuario_has_permissao`
  ADD CONSTRAINT `fk_permissao_uhp` FOREIGN KEY (`fk_id_permissao`) REFERENCES `permissao` (`id_permissao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_uhp` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
