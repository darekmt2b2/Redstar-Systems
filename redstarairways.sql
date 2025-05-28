-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2025 a las 02:39:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `redstarairways`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aircraft`
--

CREATE TABLE `aircraft` (
  `ID` int(11) NOT NULL,
  `Registration` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `ownerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aircraft`
--

INSERT INTO `aircraft` (`ID`, `Registration`, `Type`, `ownerID`) VALUES
(3, 'EC-AAU', 'B350', 1),
(4, 'EC-AAC', 'Piper PA21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `airfield`
--

CREATE TABLE `airfield` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `airfield`
--

INSERT INTO `airfield` (`ID`, `name`, `availability`) VALUES
(1, '34L', 1),
(2, '34R', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventparticipants`
--

CREATE TABLE `eventparticipants` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventparticipants`
--

INSERT INTO `eventparticipants` (`ID`, `name`, `email`) VALUES
(1, 'Mathias', 'darek.perez.vallejos@gmail.com'),
(2, 'OMG hello', 'dpereenc@myuax.com'),
(3, 'carlos', 'carlos@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `Event_desc` text NOT NULL,
  `date` date NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`ID`, `Event_desc`, `date`, `name`) VALUES
(1, '21st anniversary of the airfield, 20th century aircraft will be flying on this special day', '2025-09-15', 'Aerial Exhibition'),
(2, 'Discover your path to the skies, your pilot career might start today!', '2025-05-01', 'Orientation Day');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_assistance`
--

CREATE TABLE `event_assistance` (
  `participant_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `event_assistance`
--

INSERT INTO `event_assistance` (`participant_id`, `event_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flightplan`
--

CREATE TABLE `flightplan` (
  `ID` int(11) NOT NULL,
  `Aircraft_ID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `Departure` varchar(50) DEFAULT NULL,
  `departureRunway` int(11) NOT NULL,
  `Arrival` varchar(50) DEFAULT NULL,
  `FLJSON` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`FLJSON`)),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flightplan`
--

INSERT INTO `flightplan` (`ID`, `Aircraft_ID`, `UserID`, `date`, `Departure`, `departureRunway`, `Arrival`, `FLJSON`, `status`) VALUES
(1, 3, 1, '2025-03-07', 'LEMD', 2, 'LFPG', '[{\"ident\":\"LEMD\",\"type\":\"DPT\",\"lat\":40.49259,\"lon\":-3.57462,\"alt\":0,\"heading\":360},{\"ident\":\"SSY\",\"type\":\"VOR\",\"lat\":40.54642,\"lon\":-3.57519,\"alt\":5000},{\"ident\":\"MD901\",\"type\":\"WPT\",\"lat\":40.63642,\"lon\":-3.54264,\"alt\":10100},{\"ident\":\"MD902\",\"type\":\"WPT\",\"lat\":40.7035,\"lon\":-3.53667,\"alt\":12200},{\"ident\":\"RBO\",\"type\":\"VOR\",\"lat\":40.85386,\"lon\":-3.24664,\"alt\":19300},{\"ident\":\"OSTIX\",\"type\":\"WPT\",\"lat\":41.5045,\"lon\":-3.10011,\"alt\":30400},{\"ident\":\"GASMO\",\"type\":\"WPT\",\"lat\":41.72947,\"lon\":-3.04875,\"alt\":32900},{\"ident\":\"DGO\",\"type\":\"VOR\",\"lat\":42.45331,\"lon\":-2.88069,\"alt\":39400},{\"ident\":\"T_O_C\",\"type\":\"FIX\",\"lat\":42.52808,\"lon\":-2.79079,\"alt\":40000},{\"ident\":\"CEGAM\",\"type\":\"WPT\",\"lat\":42.98372,\"lon\":-2.23636,\"alt\":40000},{\"ident\":\"BAGAS\",\"type\":\"WPT\",\"lat\":43.09844,\"lon\":-2.09472,\"alt\":40000},{\"ident\":\"SSN\",\"type\":\"VOR\",\"lat\":43.31119,\"lon\":-1.83039,\"alt\":40000},{\"ident\":\"LUSEM\",\"type\":\"WPT\",\"lat\":43.37472,\"lon\":-1.78056,\"alt\":40000},{\"ident\":\"LULUT\",\"type\":\"WPT\",\"lat\":44.39861,\"lon\":-0.83972,\"alt\":40000},{\"ident\":\"POI\",\"type\":\"VOR\",\"lat\":46.581,\"lon\":0.29819,\"alt\":40000},{\"ident\":\"PEPAX\",\"type\":\"WPT\",\"lat\":47.08139,\"lon\":0.4525,\"alt\":30000},{\"ident\":\"NIMER\",\"type\":\"WPT\",\"lat\":47.4725,\"lon\":0.35694,\"alt\":30000},{\"ident\":\"KEPER\",\"type\":\"WPT\",\"lat\":47.80611,\"lon\":0.27389,\"alt\":30000},{\"ident\":\"LUMAN\",\"type\":\"WPT\",\"lat\":47.93944,\"lon\":0.41333,\"alt\":30000},{\"ident\":\"T_O_D\",\"type\":\"FIX\",\"lat\":48.06207,\"lon\":0.54218,\"alt\":30000},{\"ident\":\"ROMGO\",\"type\":\"WPT\",\"lat\":48.34658,\"lon\":0.84411,\"alt\":23600},{\"ident\":\"FF501\",\"type\":\"WPT\",\"lat\":48.41194,\"lon\":1.0325,\"alt\":21200},{\"ident\":\"NERKI\",\"type\":\"WPT\",\"lat\":48.51306,\"lon\":1.32714,\"alt\":17300},{\"ident\":\"BANOX\",\"type\":\"WPT\",\"lat\":48.57419,\"lon\":1.5055,\"alt\":14800},{\"ident\":\"LFPG\",\"type\":\"DST\",\"lat\":49.02472,\"lon\":2.52489,\"alt\":0,\"heading\":85}]', 0),
(2, 4, 1, '2025-05-24', 'LEMD', 1, 'EGLL', '[{\"ident\":\"LEMD\",\"type\":\"DPT\",\"lat\":40.49259,\"lon\":-3.57462,\"alt\":0,\"heading\":360},{\"ident\":\"SSY\",\"type\":\"VOR\",\"lat\":40.54642,\"lon\":-3.57519,\"alt\":4100},{\"ident\":\"MD039\",\"type\":\"WPT\",\"lat\":40.64044,\"lon\":-3.67878,\"alt\":8400},{\"ident\":\"SIE\",\"type\":\"VOR\",\"lat\":41.15169,\"lon\":-3.60467,\"alt\":18500},{\"ident\":\"XERMA\",\"type\":\"WPT\",\"lat\":41.50372,\"lon\":-3.6135,\"alt\":23400},{\"ident\":\"ARLUN\",\"type\":\"WPT\",\"lat\":42.02156,\"lon\":-3.61358,\"alt\":28300},{\"ident\":\"BUGIX\",\"type\":\"WPT\",\"lat\":42.35814,\"lon\":-3.63539,\"alt\":30900},{\"ident\":\"UNGAS\",\"type\":\"WPT\",\"lat\":42.68228,\"lon\":-3.69983,\"alt\":33000},{\"ident\":\"T_O_C\",\"type\":\"FIX\",\"lat\":43.2111,\"lon\":-3.79051,\"alt\":36000},{\"ident\":\"DELOG\",\"type\":\"WPT\",\"lat\":44.32889,\"lon\":-3.9875,\"alt\":36000},{\"ident\":\"DEGEX\",\"type\":\"WPT\",\"lat\":47.74389,\"lon\":-3.15667,\"alt\":36000},{\"ident\":\"FIFUC\",\"type\":\"WPT\",\"lat\":48.45908,\"lon\":-2.52533,\"alt\":36000},{\"ident\":\"JSY\",\"type\":\"VOR\",\"lat\":49.2211,\"lon\":-2.04615,\"alt\":36000},{\"ident\":\"REVTU\",\"type\":\"WPT\",\"lat\":49.59722,\"lon\":-1.72556,\"alt\":34000},{\"ident\":\"BOLRO\",\"type\":\"WPT\",\"lat\":50,\"lon\":-1.69151,\"alt\":34000},{\"ident\":\"ROXOG\",\"type\":\"WPT\",\"lat\":50.26619,\"lon\":-1.56234,\"alt\":34000},{\"ident\":\"T_O_D\",\"type\":\"FIX\",\"lat\":50.26778,\"lon\":-1.56156,\"alt\":34000},{\"ident\":\"AMTOD\",\"type\":\"WPT\",\"lat\":50.53769,\"lon\":-1.42902,\"alt\":27300},{\"ident\":\"BEGTO\",\"type\":\"WPT\",\"lat\":50.76253,\"lon\":-1.23555,\"alt\":21300},{\"ident\":\"HAZEL\",\"type\":\"WPT\",\"lat\":51.00529,\"lon\":-0.98446,\"alt\":14600},{\"ident\":\"LLS01\",\"type\":\"WPT\",\"lat\":51.17278,\"lon\":-0.68568,\"alt\":8700},{\"ident\":\"OCK\",\"type\":\"VOR\",\"lat\":51.30505,\"lon\":-0.44718,\"alt\":4000},{\"ident\":\"EGLL\",\"type\":\"DST\",\"lat\":51.47768,\"lon\":-0.43328,\"alt\":0,\"heading\":270}]', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `scheduleDate` date NOT NULL,
  `issue` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maintenance`
--

INSERT INTO `maintenance` (`id`, `user_id`, `plane_id`, `scheduleDate`, `issue`, `status`) VALUES
(1, 1, 3, '2025-05-21', 'hola', 1),
(2, 1, 4, '2025-05-29', 'FMC stopped working, landing gear half rotten', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metar`
--

CREATE TABLE `metar` (
  `ID` int(11) NOT NULL,
  `METARDATA` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metar`
--

INSERT INTO `metar` (`ID`, `METARDATA`) VALUES
(1, 'METAR EGLL 261250Z 22012KT 9999 SCT025 BKN040 18/10 Q1013\r\n\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `EASA` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `userType` int(11) DEFAULT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`ID`, `name`, `EASA`, `password`, `userType`, `mail`) VALUES
(1, 'Darek Admin', '18540330F', '$2y$10$ZOcdDbwhxO8txpeHyJnRk.5BnChF5fHgdTTj34pV/pLE3RG4vSkbm', 1, 'darek.perez.vallejos@gmail.com'),
(2, 'SuperUSER', '12345A', '$2y$10$kb9ZYNdMqO/xYiD04y6el.Upli54teleEchB0MnMj6Xp1t8b72svS', 2, 'darekpervall@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertype`
--

CREATE TABLE `usertype` (
  `ID` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usertype`
--

INSERT INTO `usertype` (`ID`, `type`) VALUES
(1, 'user'),
(2, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Registration` (`Registration`),
  ADD KEY `ownerID` (`ownerID`);

--
-- Indices de la tabla `airfield`
--
ALTER TABLE `airfield`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `eventparticipants`
--
ALTER TABLE `eventparticipants`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `event_assistance`
--
ALTER TABLE `event_assistance`
  ADD PRIMARY KEY (`participant_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indices de la tabla `flightplan`
--
ALTER TABLE `flightplan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Aircraft_ID` (`Aircraft_ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `departureRunway` (`departureRunway`);

--
-- Indices de la tabla `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plane_id` (`plane_id`);

--
-- Indices de la tabla `metar`
--
ALTER TABLE `metar`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userType` (`userType`);

--
-- Indices de la tabla `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `airfield`
--
ALTER TABLE `airfield`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `eventparticipants`
--
ALTER TABLE `eventparticipants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `flightplan`
--
ALTER TABLE `flightplan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `metar`
--
ALTER TABLE `metar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aircraft`
--
ALTER TABLE `aircraft`
  ADD CONSTRAINT `aircraft_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `user` (`ID`);

--
-- Filtros para la tabla `event_assistance`
--
ALTER TABLE `event_assistance`
  ADD CONSTRAINT `event_assistance_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `eventparticipants` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_assistance_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`ID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `flightplan`
--
ALTER TABLE `flightplan`
  ADD CONSTRAINT `flightplan_ibfk_1` FOREIGN KEY (`Aircraft_ID`) REFERENCES `aircraft` (`ID`),
  ADD CONSTRAINT `flightplan_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `flightplan_ibfk_3` FOREIGN KEY (`departureRunway`) REFERENCES `airfield` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `aircraft` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userType`) REFERENCES `usertype` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
