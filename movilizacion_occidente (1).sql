-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Sep 07, 2020 at 04:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movilizacion_occidente`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `solicitud_id` bigint(20) UNSIGNED DEFAULT NULL,
  `movil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `usuario_asignador_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estado_movil`
--

CREATE TABLE `estado_movil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tx_descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estado_movil`
--

INSERT INTO `estado_movil` (`id`, `tx_descripcion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'cancelado por usuario', NULL, NULL, NULL),
(2, 'agendado y vigente', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_19_200802_create_viajes_table', 1),
(5, '2020_05_20_145222_add_estado_to_viajes', 1),
(6, '2020_05_20_194900_add_sentido_to_solicitud', 1),
(7, '2020_05_24_220030_create_movil_table', 1),
(8, '2020_05_24_220031_create_asignacion_table', 1),
(9, '2020_08_12_142811_add_to_users_user_type', 1),
(10, '2020_08_14_000218_create_solicitud_movil_table', 1),
(11, '2020_08_18_131341_create_estado_solicitud_table', 1),
(12, '2020_08_18_132717_add_foreign_solicitud', 1),
(13, '2020_08_19_130954_add_nombre_conductor_to_moviles', 2),
(14, '2020_08_21_162814_create_user_type_table', 3),
(15, '2020_08_25_172940_create_estado_movil_table', 4),
(16, '2020_08_25_172941_add_estado_to_solicitud_movil', 5),
(17, '2020_08_28_143748_add_sentido_to_solicitud_movil', 6);

-- --------------------------------------------------------

--
-- Table structure for table `moviles`
--

CREATE TABLE `moviles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conductor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre_conductor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo_vehiculo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `patente` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moviles`
--

INSERT INTO `moviles` (`id`, `conductor_id`, `nombre_conductor`, `modelo_vehiculo`, `marca`, `capacidad`, `patente`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'marcela', '233421', 'asdfa', 2, 'weqc', NULL, '2020-08-19 21:04:23', '2020-08-19 21:04:23'),
(2, NULL, 'claudio', 'taxi', 'dfasd', 1, 'asdfasd', NULL, '2020-08-19 21:04:45', '2020-08-19 21:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `origen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destino` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pasajeros` int(11) DEFAULT NULL,
  `sentido` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_agendada` date DEFAULT NULL,
  `hora_salida` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_llegada` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_agendador_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `origen`, `destino`, `pasajeros`, `sentido`, `fecha_agendada`, `hora_salida`, `hora_llegada`, `usuario_agendador_id`, `estado`, `deleted_at`, `created_at`, `updated_at`) VALUES
(19, 'servicio_occidente', 'viaje 1', 1, '1', '2020-08-27', '08:00', '17:00', 1, 24, NULL, '2020-08-28 06:39:14', '2020-08-28 06:39:14'),
(20, 'servicio_occidente', 'viaje 2', 1, '1', '2020-08-27', '12:00', '14:00', 1, 25, NULL, '2020-08-28 06:39:38', '2020-08-28 06:39:38'),
(21, 'servicio_occidente', 'viaje 3', 1, '1', '2020-08-27', '12:00', '16:00', 1, 26, NULL, '2020-08-28 06:40:21', '2020-08-28 20:07:28'),
(22, 'servicio_occidente', 'viaje 4', 1, '0', '2020-08-28', '08:00', '08:00', 1, 28, NULL, '2020-08-29 04:37:12', '2020-08-29 04:37:12'),
(23, 'servicio_occidente', 'viaje 1', 1, '1', '2020-08-31', '08:00', '08:00', 1, 29, NULL, '2020-08-31 21:57:55', '2020-08-31 21:57:55'),
(24, 'servicio_occidente', 'viaje 2', 1, '1', '2020-08-31', '09:00', '13:00', 1, 30, NULL, '2020-08-31 21:58:17', '2020-08-31 21:58:17'),
(25, 'servicio_occidente', 'viaje 3', 1, '1', '2020-08-31', '09:00', '13:00', 1, 31, NULL, '2020-08-31 22:04:03', '2020-08-31 22:04:03'),
(26, 'servicio_occidente', 'viaje 4', 1, '1', '2020-08-31', '12:00', '13:00', 1, 32, NULL, '2020-08-31 22:04:32', '2020-08-31 22:04:32'),
(27, 'servicio_occidente', 'viaje 6', 1, '1', '2020-08-31', '14:00', '16:00', 1, 33, NULL, '2020-08-31 22:05:17', '2020-08-31 22:05:17'),
(28, 'servicio_occidente', 'viaje 6', 3, '1', '2020-09-01', '12:00', '13:00', 1, 34, NULL, '2020-08-31 22:19:29', '2020-08-31 22:19:29'),
(29, 'servicio_occidente', 'viaje 1', 1, '1', '2020-09-02', '08:00', '11:00', 1, 35, NULL, '2020-09-03 07:43:09', '2020-09-03 07:43:09'),
(30, 'servicio_occidente', 'viaje 2', 1, '1', '2020-09-02', '11:00', '14:00', 1, 36, NULL, '2020-09-03 07:43:31', '2020-09-03 07:43:31'),
(31, 'servicio_occidente', 'viaje 3', 1, '0', '2020-09-02', '15:00', '17:00', 1, 37, NULL, '2020-09-03 07:44:02', '2020-09-03 07:44:02'),
(32, 'servicio_occidente', 'viaje 3', 1, '0', '2020-09-02', '15:00', '17:00', 1, 38, NULL, '2020-09-03 07:44:02', '2020-09-03 07:44:02'),
(33, 'servicio_occidente', 'hollaa', 5, '1', '2020-09-05', '08:00', '15:00', 1, 39, NULL, '2020-09-06 05:45:37', '2020-09-06 05:45:37'),
(34, 'servicio_occidente', 'dfasdfa', 1, '1', '2020-09-07', '11:00', '14:00', 1, 40, NULL, '2020-09-06 05:46:06', '2020-09-06 05:46:06'),
(35, 'servicio_occidente', 'asdfasd', 1, '0', '2020-09-07', '08:00', '12:00', 1, 41, NULL, '2020-09-06 05:46:23', '2020-09-06 05:46:23'),
(36, 'Servicio occidente', 'viaje 1', 1, '1', '2020-09-08', '08:00', '12:00', 1, 42, NULL, '2020-09-06 10:06:34', '2020-09-06 10:06:34'),
(38, 'Servicio occidente', 'viaje 2', 1, '1', '2020-09-08', '10:00', '16:00', 1, 44, NULL, '2020-09-06 10:07:28', '2020-09-06 10:07:28'),
(39, 'Servicio occidente', 'viaje 3', 1, '0', '2020-09-08', '12:00', '13:00', 1, 45, NULL, '2020-09-06 10:08:00', '2020-09-06 10:08:00'),
(40, 'Servicio occidente', 'viaje 4', 1, '1', '2020-09-08', '11:00', '15:00', 1, 46, NULL, '2020-09-06 10:09:49', '2020-09-06 10:09:49'),
(41, 'Servicio occidente', 'viaje 5', 1, '1', '2020-09-08', '12:00', '14:00', 1, 47, NULL, '2020-09-06 11:47:59', '2020-09-06 11:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `solicitud_estado`
--

CREATE TABLE `solicitud_estado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solicitud_estado`
--

INSERT INTO `solicitud_estado` (`id`, `estado`, `observacion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, 'gestionado', NULL, NULL, '2020-08-28 06:39:14', '2020-08-28 20:17:32'),
(25, 'gestionado', NULL, NULL, '2020-08-28 06:39:38', '2020-08-28 21:49:36'),
(26, 'gestionado', NULL, NULL, '2020-08-28 06:40:21', '2020-08-28 20:16:19'),
(28, 'gestionado', NULL, NULL, '2020-08-29 04:37:12', '2020-09-04 05:13:32'),
(29, 'gestionado', NULL, NULL, '2020-08-31 21:57:55', '2020-09-03 07:12:35'),
(30, 'gestionado', NULL, NULL, '2020-08-31 21:58:17', '2020-08-31 22:03:23'),
(31, 'pendiente', '', NULL, '2020-08-31 22:04:03', '2020-08-31 22:04:03'),
(32, 'gestionado', NULL, NULL, '2020-08-31 22:04:32', '2020-09-03 07:12:16'),
(33, 'gestionado', NULL, NULL, '2020-08-31 22:05:17', '2020-09-03 07:12:46'),
(34, 'rechazado', 'sdfasdfasdf', NULL, '2020-08-31 22:19:29', '2020-08-31 22:23:39'),
(35, 'gestionado', NULL, NULL, '2020-09-03 07:43:09', '2020-09-03 07:48:44'),
(36, 'gestionado', NULL, NULL, '2020-09-03 07:43:31', '2020-09-03 07:51:52'),
(37, 'gestionado', NULL, NULL, '2020-09-03 07:44:02', '2020-09-03 07:51:22'),
(38, 'gestionado', NULL, NULL, '2020-09-03 07:44:02', '2020-09-03 07:51:31'),
(39, 'pendiente', '', NULL, '2020-09-06 05:45:37', '2020-09-06 05:45:37'),
(40, 'gestionado', NULL, NULL, '2020-09-06 05:46:06', '2020-09-06 05:47:51'),
(41, 'cancelado', 'afawdfas', NULL, '2020-09-06 05:46:23', '2020-09-06 06:39:41'),
(42, 'pendiente', '', NULL, '2020-09-06 10:06:34', '2020-09-06 10:06:34'),
(43, 'pendiente', '', NULL, '2020-09-06 10:06:35', '2020-09-06 10:06:35'),
(44, 'gestionado', NULL, NULL, '2020-09-06 10:07:28', '2020-09-06 11:41:14'),
(45, 'gestionado', NULL, NULL, '2020-09-06 10:08:00', '2020-09-06 11:46:09'),
(46, 'gestionado', NULL, NULL, '2020-09-06 10:09:49', '2020-09-06 11:21:04'),
(47, 'pendiente', '', NULL, '2020-09-06 11:47:59', '2020-09-06 11:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `solicitud_movil`
--

CREATE TABLE `solicitud_movil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `solicitud_id` bigint(20) UNSIGNED DEFAULT NULL,
  `movil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_movil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sentido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administrador_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solicitud_movil`
--

INSERT INTO `solicitud_movil` (`id`, `solicitud_id`, `movil_id`, `estado_movil_id`, `sentido`, `administrador_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9, 21, 1, NULL, 'ida', NULL, NULL, '2020-08-28 20:16:19', '2020-08-28 20:16:19'),
(10, 19, 3, NULL, 'ida', NULL, NULL, '2020-08-28 20:17:32', '2020-08-28 20:17:32'),
(11, 20, 5, NULL, 'ida', NULL, NULL, '2020-08-28 21:49:36', '2020-08-28 21:49:36'),
(12, 20, 5, NULL, 'regreso', NULL, NULL, '2020-08-28 21:49:36', '2020-08-28 21:49:36'),
(13, 24, 1, NULL, 'ida', NULL, NULL, '2020-08-31 22:03:23', '2020-08-31 22:03:23'),
(14, 24, 1, NULL, 'regreso', NULL, NULL, '2020-08-31 22:03:23', '2020-08-31 22:03:23'),
(15, 26, 4, NULL, 'ida', NULL, NULL, '2020-09-03 07:12:16', '2020-09-03 07:12:16'),
(23, 29, 1, NULL, 'ida', NULL, NULL, '2020-09-03 07:48:44', '2020-09-03 07:48:44'),
(24, 29, 1, NULL, 'regreso', NULL, NULL, '2020-09-03 07:48:44', '2020-09-03 07:48:44'),
(25, 31, 1, NULL, 'ida', NULL, NULL, '2020-09-03 07:51:22', '2020-09-03 07:51:22'),
(26, 32, 2, NULL, 'ida', NULL, NULL, '2020-09-03 07:51:31', '2020-09-03 07:51:31'),
(27, 30, 3, NULL, 'ida', NULL, NULL, '2020-09-03 07:51:52', '2020-09-03 07:51:52'),
(28, 30, 3, NULL, 'regreso', NULL, NULL, '2020-09-03 07:51:52', '2020-09-03 07:51:52'),
(29, 22, 1, NULL, 'ida', NULL, NULL, '2020-09-04 05:13:32', '2020-09-04 05:13:32'),
(30, 35, 1, 1, 'ida', NULL, NULL, '2020-09-06 05:47:47', '2020-09-06 06:39:41'),
(31, 34, 2, NULL, 'ida', NULL, NULL, '2020-09-06 05:47:51', '2020-09-06 07:02:49'),
(32, 34, 2, NULL, 'regreso', NULL, NULL, '2020-09-06 05:47:51', '2020-09-06 07:02:49'),
(38, 40, 2, NULL, 'ida', NULL, NULL, '2020-09-06 11:21:04', '2020-09-06 11:21:04'),
(39, 40, 2, NULL, 'regreso', NULL, NULL, '2020-09-06 11:21:04', '2020-09-06 11:21:04'),
(40, 38, 1, NULL, 'ida', NULL, NULL, '2020-09-06 11:41:14', '2020-09-06 11:41:14'),
(41, 38, 1, NULL, 'regreso', NULL, NULL, '2020-09-06 11:41:14', '2020-09-06 11:41:14'),
(43, 39, 1, NULL, 'ida', NULL, NULL, '2020-09-06 11:46:09', '2020-09-06 11:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `es_admin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `habilitado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nacimiento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ultimo_ingreso` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `apellidos`, `es_admin`, `habilitado`, `telefono`, `direccion`, `titulo`, `nacimiento`, `ultimo_ingreso`, `email`, `user_type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jose', 'joseinformatico2015@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'joseinformatico2015@gmail.com', 1, NULL, '$2y$10$B9S1vYCOcSl.OA1hUIadFu.YA5CBs4YbCNV6J3I2zWtH/IcAzAMT6', NULL, '2020-08-19 10:26:53', '2020-08-19 10:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tx_descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `tx_descripcion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'God', NULL, NULL, NULL),
(2, 'Administrador', NULL, NULL, NULL),
(3, 'Trabajador', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignaciones_usuario_asignador_id_foreign` (`usuario_asignador_id`),
  ADD KEY `asignaciones_movil_id_foreign` (`movil_id`),
  ADD KEY `asignaciones_solicitud_id_foreign` (`solicitud_id`);

--
-- Indexes for table `estado_movil`
--
ALTER TABLE `estado_movil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moviles`
--
ALTER TABLE `moviles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moviles_conductor_id_foreign` (`conductor_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitudes_usuario_agendador_id_foreign` (`usuario_agendador_id`),
  ADD KEY `solicitudes_estado_foreign` (`estado`);

--
-- Indexes for table `solicitud_estado`
--
ALTER TABLE `solicitud_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solicitud_movil`
--
ALTER TABLE `solicitud_movil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_movil_solicitud_id_foreign` (`solicitud_id`),
  ADD KEY `solicitud_movil_movil_id_foreign` (`movil_id`),
  ADD KEY `solicitud_movil_administrador_id_foreign` (`administrador_id`),
  ADD KEY `solicitud_movil_estado_movil_id_foreign` (`estado_movil_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estado_movil`
--
ALTER TABLE `estado_movil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `moviles`
--
ALTER TABLE `moviles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `solicitud_estado`
--
ALTER TABLE `solicitud_estado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `solicitud_movil`
--
ALTER TABLE `solicitud_movil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_movil_id_foreign` FOREIGN KEY (`movil_id`) REFERENCES `moviles` (`id`),
  ADD CONSTRAINT `asignaciones_solicitud_id_foreign` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`),
  ADD CONSTRAINT `asignaciones_usuario_asignador_id_foreign` FOREIGN KEY (`usuario_asignador_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `moviles`
--
ALTER TABLE `moviles`
  ADD CONSTRAINT `moviles_conductor_id_foreign` FOREIGN KEY (`conductor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_estado_foreign` FOREIGN KEY (`estado`) REFERENCES `solicitud_estado` (`id`),
  ADD CONSTRAINT `solicitudes_usuario_agendador_id_foreign` FOREIGN KEY (`usuario_agendador_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `solicitud_movil`
--
ALTER TABLE `solicitud_movil`
  ADD CONSTRAINT `solicitud_movil_administrador_id_foreign` FOREIGN KEY (`administrador_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitud_movil_estado_movil_id_foreign` FOREIGN KEY (`estado_movil_id`) REFERENCES `estado_movil` (`id`),
  ADD CONSTRAINT `solicitud_movil_movil_id_foreign` FOREIGN KEY (`movil_id`) REFERENCES `moviles` (`id`),
  ADD CONSTRAINT `solicitud_movil_solicitud_id_foreign` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
