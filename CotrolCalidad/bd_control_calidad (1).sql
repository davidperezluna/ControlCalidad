-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2016 a las 23:17:38
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_control_calidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id` int(11) NOT NULL,
  `proceso_id` int(11) DEFAULT NULL,
  `procedimiento_id` int(11) DEFAULT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `urlDocumento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urlDocumentoPdf` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`id`, `proceso_id`, `procedimiento_id`, `version`, `descripcion`, `estado`, `urlDocumento`, `urlDocumentoPdf`) VALUES
(4, 10, NULL, '1.5', 'una descripcion', 0, '661edec89042b40c33422f2e10af48971.6.docx', '567f895cf25801092009e51131d077551.6.pdf'),
(10, NULL, 10, '1.5', 'una', 1, '24ebfec34c16c69343db6487939dd6a53.docx', '123825f44b98d96844ddfa198b9107e03.pdf'),
(14, 11, NULL, '55', '66', 0, '8208e8085def14d671965aceab99d5571.25.docx', '43ee3d43ced9facc42b24646a4f587571.25.pdf'),
(15, 11, NULL, '1.5', 'una descripciomn', 0, '3d894ef147df7b6e3501ec421550a4201.5.docx', '970538dc799cf095216d03f364eced0d1.5.pdf'),
(16, 11, NULL, '1.5', 'una descripciomn', 1, '5b8adca87923543646f8f7b4adb3a8791.6.docx', 'f2ac81168fc50ce7ae4dfbc1fb3e31a71.6.pdf'),
(17, 10, NULL, '9', 'una descioasjnckSANC', 1, '68e499d34c6744a2e3be3777f2a381fa9.docx', '7d5274cfcd9f5c98b755ee3f68fcf3519.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`) VALUES
(1, 'Gerente General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Categoria 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'Categoria2', 'lorem ipsum is dolor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `representante` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `empresa_id`, `nit`, `nombre`, `representante`) VALUES
(1, 1, 1085287129, 'Dependencia 1', 'Edgar David Perez Luna'),
(2, 2, 2222222, 'dependencia 2', 'david perez'),
(3, 1, 33, 'Dependencia 3', 'david perez'),
(18, 1, 333, '3', '3'),
(19, 1, 3, '3', '44'),
(20, 2, 555, '555', '55'),
(21, 3, 12, 'transito', 'david');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlDocumento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `tipo_documento_id`, `nombre`, `urlDocumento`) VALUES
(1, 1, 'Documento 1', 'https://www.google.com.co/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=url'),
(2, 1, 'documento 2', 'C:\\xampp\\tmp\\php3145.tmp'),
(3, 1, 'e', '5a169bf8f43a76ee71d91b5b3ff4c4ad.txt'),
(4, 1, 'david', '51334b75cf882e223ba2d3cafcb17a99david.txt'),
(5, 1, 'cm3564', '4ecc1492077f285ea13e96258235773fcm3564.jpeg'),
(6, 2, 'un nombre', 'C:\\xampp\\tmp\\phpCFDD.tmp'),
(7, 2, 'nombre valido', 'C:\\xampp\\tmp\\php95FD.tmp'),
(8, 2, 'un nombre', '196edbb1728c62afb23553969ff55308un nombre.docx'),
(9, 2, 'un nombre', '69b3e994aaf86898b6662b5675fb87d1un nombre.docx'),
(10, 2, 'un nombre', '92206fd86b54d637d20a7434fb62b949un nombre.docx'),
(11, 2, 'otro documento', '1521a480988e2927bd4fea607c867285otro documento.pdf'),
(12, 2, 'documento prueba', '40232f30ec9985345b642215f44d1c30documento prueba.docx'),
(13, 2, 'documento 6', 'c7c316824e40c394b12d6a2f989ca01fdocumento 6.pdf'),
(14, 2, 'g', '66af6671281b889a78802dd1dba1d822g.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_legal`
--

CREATE TABLE `documento_legal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `documento_legal`
--

INSERT INTO `documento_legal` (`id`, `nombre`, `url`) VALUES
(1, 'Constitucion politica', 'http://www.corteconstitucional.gov.co/inicio/Constitucion%20politica%20de%20Colombia%20-%202015.pdf'),
(2, 'Documento 2', 'http://localhost/GitHub/calidad/CotrolCalidad/web/app_dev.php/documentolegal/new?idProcedmiento=10'),
(3, 'Documento 3', 'http://localhost/GitHub/calidad/CotrolCalidad/web/app_dev.php/documentolegal/new?idProcedmiento=10'),
(4, 'Documento 3', 'http://localhost/GitHub/calidad/CotrolCalidad/web/app_dev.php/documentolegal/new?idProcedmiento=10'),
(5, 'Documento 3', 'http://localhost/GitHub/calidad/CotrolCalidad/web/app_dev.php/documentolegal/new?idProcedmiento=10'),
(6, 'doc 5', 'idProcedimiento'),
(7, 'Doc6', 'idProcedmiento'),
(8, 'un nombre', 'http://localhost/GitHub/calidad/CotrolCalidad/web/app_dev.php/documentolegal/new?idProcedmiento=10'),
(9, 'documento 6', 'http://localhost/GitHub/calidad/CotrolCalidad/web/app_dev.php/documentolegal/new?idProcedimiento=10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `representante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nit`, `nombre`, `representante`, `direccion`) VALUES
(1, 1085287129, 'Empresa 1 S.A.S', 'Edgar David Perez Luna', 'mz c casa # 6 villa de los rios'),
(2, 222222, 'empresa 2', 'david perez', 'm13 c 9 tamasagra'),
(3, 3, 'empresa 3', 'david perez', 'm3 c 6 ttt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `macro_proceso`
--

CREATE TABLE `macro_proceso` (
  `id` int(11) NOT NULL,
  `dependencia_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `macro_proceso`
--

INSERT INTO `macro_proceso` (`id`, `dependencia_id`, `categoria_id`, `nombre`, `sigla`) VALUES
(1, 1, 1, 'MacroProceso 1', 'A'),
(2, 2, 1, 'macroproceso 2', 'B'),
(3, 1, 1, 'macro pruebaa', 'M'),
(4, 1, 2, 'macro prueba 2', 'M'),
(5, 1, 2, 'M', 'M'),
(6, 21, 1, 'Macro 6', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `normograma`
--

CREATE TABLE `normograma` (
  `id` int(11) NOT NULL,
  `documento_legal_id` int(11) DEFAULT NULL,
  `procedimiento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `normograma`
--

INSERT INTO `normograma` (`id`, `documento_legal_id`, `procedimiento_id`) VALUES
(1, 1, 10),
(4, 1, 10),
(5, 3, 10),
(6, 8, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimiento`
--

CREATE TABLE `procedimiento` (
  `id` int(11) NOT NULL,
  `proceso_id` int(11) DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vigencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `procedimiento`
--

INSERT INTO `procedimiento` (`id`, `proceso_id`, `codigo`, `nombre`, `vigencia`, `version`) VALUES
(10, 10, 'A', 'Procedimiento prueba', '1991-03-15', '1.0'),
(11, 11, 'c085', 'Pago de nomina', '15/03/1991', '0.1'),
(12, 11, '03', 'Procedimiento prueba', '13/11/1991', '0.2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimiento_documento`
--

CREATE TABLE `procedimiento_documento` (
  `id` int(11) NOT NULL,
  `procedimiento_id` int(11) DEFAULT NULL,
  `documento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `procedimiento_documento`
--

INSERT INTO `procedimiento_documento` (`id`, `procedimiento_id`, `documento_id`) VALUES
(1, 10, 4),
(2, 10, 4),
(3, 10, 4),
(4, 10, 11),
(5, 10, 5),
(6, 10, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimiento_usuario`
--

CREATE TABLE `procedimiento_usuario` (
  `id` int(11) NOT NULL,
  `procedimiento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `procedimiento_usuario`
--

INSERT INTO `procedimiento_usuario` (`id`, `procedimiento_id`, `usuario_id`, `role_id`) VALUES
(1, 10, 2, 1),
(2, NULL, 3, 1),
(3, 10, 2, 1),
(4, 10, 2, 1),
(5, 10, 2, 1),
(6, 10, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id` int(11) NOT NULL,
  `macro_proceso_id` int(11) DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vigencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id`, `macro_proceso_id`, `codigo`, `nombre`, `version`, `vigencia`) VALUES
(10, 1, '6', 'dolore magnauip ex ea commodo consequat. Duis aute irure dolor', '1.5', '2010-01-01'),
(11, 3, '12', 'PROCESO PRUEBA', '1.5', '2011-01-01'),
(12, 1, '', 'prueba1000', '1.5', '15/03/1991');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_usuario`
--

CREATE TABLE `proceso_usuario` (
  `id` int(11) NOT NULL,
  `proceso_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proceso_usuario`
--

INSERT INTO `proceso_usuario` (`id`, `proceso_id`, `usuario_id`, `role_id`) VALUES
(10, 10, 2, 1),
(11, 10, 3, 1),
(12, 10, 5, 1),
(13, 11, 2, 1),
(14, 10, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `nombre`, `cargo`) VALUES
(1, 'Lider', 'Lide de proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`, `sigla`) VALUES
(1, 'Tipo de Documeto 1', ''),
(2, 'Tipo prueba', 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `identificacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cargo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `role`, `identificacion`, `password`, `cargo_id`) VALUES
(1, 'jhwebsas', 'jhweb sas', 'cc valle de atris local 1555', '3177060178', 'jhwebinfo@gmail.com', 'ROLE_ADMIN', '1085311410', '$2a$04$LSMQoXFGPJsmDc9s0.C9hOvasU7cd8.VgNVyGpzl07NADp6/LwrFS', 1),
(2, 'Edgar David', 'Perez Luna', 'mz c c 6 villa de los rios', '3178954373', 'david@david.com', 'ROLE_ADMIN', '1085287129', '$2a$04$YJpunMRBHLJKCCSVODx29.b0TTkSBhsi2ecGjDDTMc/mc81zIf3oy', 1),
(3, 'Daniela Stephania', 'Rodriges Luna', 'mc c 6', '3178954373', 'daniela@daniela.com', 'ROLE_USER', '1085311410', '$2y$04$/iOIW/KOFaRIfOjJvZVUaOdn7hQiPnCSdX4EGl9PvCY6Bh1Wvb13C', 1),
(4, 'martha cecilia', 'luna zamudio', 'm c c 6', '7365858', 'marta@gmail.com', 'ROLE_ADMIN', '30740139', '$2y$04$aPeNYpUTYQ7iVYirARX7EeWzj9LfArYAeOU3/loLdPzaM77WDd2Ie', 1),
(5, 'daniel fermando', 'perez luna', 'mc c6', '3156512168', 'daniel@daniel.com', 'ROLE_ADMIN', '108531140', '$2y$04$e9XSG1vA9EFQUkSlfxgjWO9KdAE.391BMpOqwb0CqFD7h0wsJg1Ii', 1),
(6, 'daniel fermando', 'perez luna', 'mc c6', '3156512168', 'daniel@daniel.com', 'ROLE_ADMIN', '108531140', '$2y$04$3tyqUFTAZJM6nVgo53QZAOTnTWABFvVYnLvOztVYTyQ1CduolDi7m', 1),
(7, 'qqqq', 'qqqq', 'qqqqq', '99999', '1@q.com', 'ROLE_ADMIN', '11111', '$2y$04$FxYzGOn6/0XvMRWRIgfcKuPXtCqNuk1seKVQZ82LCVUtYjW0GqI/W', 1),
(8, 'qqqq', 'qqqq', 'qqqqq', '99999', '1@q.com', 'ROLE_ADMIN', '11111', '$2y$04$m4cuIevnfe3Ye6Cjt7UEPuJGHOiMNkdBIHqahLXzM4m8Xfy7IIobi', 1),
(9, 'david', 'Perez Luna', 'mz 13 c9', '2222', 'david@david2.com', 'ROLE_ADMIN', '111', '$2y$04$AJKRzwh3J2X6cyrlprdTfekI3Pxey.Sjj.nSQtu1nMoNc38Kbe1u6', 1),
(10, 'dddº', 'dddd', 'dddd', '555', 'd@d.com', 'ROLE_ADMIN', '11111', '$2y$04$CXFpyjjVRGjxLbMmnTRUNurWzH4mq4fEMDFpAwFwlltlNcjcPJpTC', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3529B482640D1D53` (`proceso_id`),
  ADD KEY `IDX_3529B482F696A255` (`procedimiento_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D23000C8521E1991` (`empresa_id`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6B12EC7F6939175` (`tipo_documento_id`);

--
-- Indices de la tabla `documento_legal`
--
ALTER TABLE `documento_legal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B8D75A505E5F5AF3` (`nit`);

--
-- Indices de la tabla `macro_proceso`
--
ALTER TABLE `macro_proceso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CE7A4DE1DF2432B6` (`dependencia_id`),
  ADD KEY `IDX_CE7A4DE13397707A` (`categoria_id`);

--
-- Indices de la tabla `normograma`
--
ALTER TABLE `normograma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1B1F32FE36B0D3A0` (`documento_legal_id`),
  ADD KEY `IDX_1B1F32FEF696A255` (`procedimiento_id`);

--
-- Indices de la tabla `procedimiento`
--
ALTER TABLE `procedimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_20D1B3E4640D1D53` (`proceso_id`);

--
-- Indices de la tabla `procedimiento_documento`
--
ALTER TABLE `procedimiento_documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B1C79197F696A255` (`procedimiento_id`),
  ADD KEY `IDX_B1C7919745C0CF75` (`documento_id`);

--
-- Indices de la tabla `procedimiento_usuario`
--
ALTER TABLE `procedimiento_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5889CF08F696A255` (`procedimiento_id`),
  ADD KEY `IDX_5889CF08DB38439E` (`usuario_id`),
  ADD KEY `IDX_5889CF08D60322AC` (`role_id`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_921C44D93B66D603` (`macro_proceso_id`);

--
-- Indices de la tabla `proceso_usuario`
--
ALTER TABLE `proceso_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_20E9DBED640D1D53` (`proceso_id`),
  ADD KEY `IDX_20E9DBEDDB38439E` (`usuario_id`),
  ADD KEY `IDX_20E9DBEDD60322AC` (`role_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2265B05D813AC380` (`cargo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `documento_legal`
--
ALTER TABLE `documento_legal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `macro_proceso`
--
ALTER TABLE `macro_proceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `normograma`
--
ALTER TABLE `normograma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `procedimiento`
--
ALTER TABLE `procedimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `procedimiento_documento`
--
ALTER TABLE `procedimiento_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `procedimiento_usuario`
--
ALTER TABLE `procedimiento_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `proceso_usuario`
--
ALTER TABLE `proceso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `FK_3529B482640D1D53` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`),
  ADD CONSTRAINT `FK_3529B482F696A255` FOREIGN KEY (`procedimiento_id`) REFERENCES `procedimiento` (`id`);

--
-- Filtros para la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD CONSTRAINT `FK_D23000C8521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `FK_B6B12EC7F6939175` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

--
-- Filtros para la tabla `macro_proceso`
--
ALTER TABLE `macro_proceso`
  ADD CONSTRAINT `FK_CE7A4DE13397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_CE7A4DE1DF2432B6` FOREIGN KEY (`dependencia_id`) REFERENCES `dependencia` (`id`);

--
-- Filtros para la tabla `normograma`
--
ALTER TABLE `normograma`
  ADD CONSTRAINT `FK_1B1F32FE36B0D3A0` FOREIGN KEY (`documento_legal_id`) REFERENCES `documento_legal` (`id`),
  ADD CONSTRAINT `FK_1B1F32FEF696A255` FOREIGN KEY (`procedimiento_id`) REFERENCES `procedimiento` (`id`);

--
-- Filtros para la tabla `procedimiento`
--
ALTER TABLE `procedimiento`
  ADD CONSTRAINT `FK_20D1B3E4640D1D53` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`);

--
-- Filtros para la tabla `procedimiento_documento`
--
ALTER TABLE `procedimiento_documento`
  ADD CONSTRAINT `FK_B1C7919745C0CF75` FOREIGN KEY (`documento_id`) REFERENCES `documento` (`id`),
  ADD CONSTRAINT `FK_B1C79197F696A255` FOREIGN KEY (`procedimiento_id`) REFERENCES `procedimiento` (`id`);

--
-- Filtros para la tabla `procedimiento_usuario`
--
ALTER TABLE `procedimiento_usuario`
  ADD CONSTRAINT `FK_5889CF08D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `FK_5889CF08DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_5889CF08F696A255` FOREIGN KEY (`procedimiento_id`) REFERENCES `procedimiento` (`id`);

--
-- Filtros para la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD CONSTRAINT `FK_921C44D93B66D603` FOREIGN KEY (`macro_proceso_id`) REFERENCES `macro_proceso` (`id`);

--
-- Filtros para la tabla `proceso_usuario`
--
ALTER TABLE `proceso_usuario`
  ADD CONSTRAINT `FK_20E9DBED640D1D53` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`),
  ADD CONSTRAINT `FK_20E9DBEDD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `FK_20E9DBEDDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D813AC380` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
