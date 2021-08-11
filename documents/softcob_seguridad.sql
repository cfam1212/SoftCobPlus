-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2021 a las 03:35:26
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `softcob`
--

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menu_id`, `empr_id`, `mepa_id`, `menu_descripcion`, `menu_nivel`, `menu_estado`, `menu_orden`, `menu_icono`, `menu_auxv1`, `menu_auxv2`, `menu_auxv3`, `menu_auxi1`, `menu_auxi2`, `menu_auxi3`, `menu_fechacreacion`, `menu_usuariocreacion`, `menu_terminalcreacion`, `menu_fum`, `menu_uum`, `menu_tum`) VALUES
(200001, 1, -1, 'Seguridad', 0, 'A', 1, 'fa fa-lock', '', '', '', 0, 0, 0, '2020-12-20 22:40:22', 1, 'Sistemas', '2021-05-15 21:40:11', 1, 'Sistemas');


--
-- Volcado de datos para la tabla `menu_padre`
--

INSERT INTO `menu_padre` (`mepa_id`, `empr_id`, `mepa_descripcion`, `mepa_icono`) VALUES
(1, 1, ' ', ' '),
(2, 1, '--Nuevo Menú Padre --', NULL);

--
-- Volcado de datos para la tabla `menu_tarea`
--

INSERT INTO `menu_tarea` (`meta_id`, `menu_id`, `tare_id`, `empr_id`, `meta_estado`, `meta_orden`, `meta_auxv1`, `meta_auxv2`, `meta_auxv3`, `meta_auxi1`, `meta_auxi2`, `meta_auxi3`, `meta_fechacreacion`, `meta_usuariocreacion`, `meta_terminalcreacion`, `meta_fum`, `meta_uum`, `meta_tum`) VALUES
(300001, 200001, 100001, 1, 'A', 0, '', '', '', 0, 0, 0, '2020-12-20 22:44:27', 1, 'Sistemas', '2020-12-20 22:44:27', 1, 'Sistemas'),
(300002, 200001, 100002, 1, 'A', 1, '', '', '', 0, 0, 0, '2020-12-20 22:44:27', 1, 'Sistemas', '2020-12-20 22:44:27', 1, 'Sistemas'),
(300003, 200001, 100003, 1, 'A', 2, '', '', '', 0, 0, 0, '2020-12-20 22:44:27', 1, 'Sistemas', '2020-12-20 22:44:27', 1, 'Sistemas'),
(300004, 200001, 100004, 1, 'A', 3, '', '', '', 0, 0, 0, '2020-12-20 22:44:27', 1, 'Sistemas', '2020-12-20 22:44:27', 1, 'Sistemas');

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perf_id`, `empr_id`, `perf_descripcion`, `perf_observacion`, `perf_estado`, `perf_crearparametro`, `perf_modificarparametro`, `perf_eliminarparametro`, `perf_auxb1`, `perf_auxb2`, `perf_auxb3`, `perf_auxv1`, `perf_auxv2`, `perf_auxv3`, `perf_auxi1`, `perf_auxi2`, `perf_auxi3`, `perf_fechacreacion`, `perf_usuariocreacion`, `perf_terminalcreacion`, `perf_fum`, `perf_uum`, `perf_tum`) VALUES
(1, 1, 'Administrador', 'Perfil para Administrador', 'A', 1, 1, 1, 0, 0, 0, '', '', '', 0, 0, 0, '2020-12-20 15:48:50', 1, 'Sistemas', '2021-05-15 19:55:16', 1, 'ALVEAR');

--
-- Volcado de datos para la tabla `perfil_menu_tarea`
--

INSERT INTO `perfil_menu_tarea` (`pemt_id`, `perf_id`, `meta_id`, `empr_id`, `pemt_estado`, `pemt_auxv1`, `pemt_auxv2`, `pemt_auxv3`, `pemt_auxi1`, `pemt_auxi2`, `pemt_auxi3`) VALUES
(1, 1, 300001, 1, 'A', '', '', '', 0, 0, 0),
(2, 1, 300002, 1, 'A', '', '', '', 0, 0, 0),
(3, 1, 300003, 1, 'A', '', '', '', 0, 0, 0),
(4, 1, 300004, 1, 'A', '', '', '', 0, 0, 0);


--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`tare_id`, `empr_id`, `tare_descripcion`, `tare_accioncontroller`, `tare_estado`, `tare_orden`, `tare_icono`, `tare_auxv1`, `tare_auxv2`, `tare_auxv3`, `tare_auxi1`, `tare_auxi2`, `tare_auxi3`, `tare_fechacreacion`, `tare_usuariocreacion`, `tare_terminalcreacion`, `tare_fum`, `tare_uum`, `tare_tum`) VALUES
(100001, 1, 'Tareas', '../seguridad/tareas.php', 'A', 0, 'fas fa-tasks', '', '', '', 0, 0, 0, '2020-12-20 22:30:33', 1, 'Sistemas', '2021-01-08 19:18:48', 1, 'ALVEAR'),
(100002, 1, 'Menu', '../seguridad/menu.php', 'A', 1, 'fab fa-stack-exchange', '', '', '', 0, 0, 0, '2020-12-20 22:36:01', 1, 'Sistemas', '2021-01-08 20:22:50', 1, 'ALVEAR'),
(100003, 1, 'Perfil', '../seguridad/perfil.php', 'A', 2, 'fas fa-address-book', '', '', '', 0, 0, 0, '2020-12-20 22:36:02', 1, 'Sistemas', '2020-12-20 22:36:02', 1, 'Sistemas'),
(100004, 1, 'Usuarios', '../seguridad/usuarios.php', 'A', 3, 'fas fa-user', '', '', '', 0, 0, 0, '2020-12-20 22:36:02', 1, 'Sistemas', '2021-04-13 19:13:18', 1, 'ALVEAR');


--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usua_id`, `perf_id`, `empr_id`, `usua_tipousuario`, `usua_cedula`, `usua_nombres`, `usua_apellidos`, `usua_email`, `usua_login`, `usua_password`, `usua_estado`, `usua_contador`, `usua_caducapass`, `usua_fechacaduca`, `usua_cambiarpass`, `usua_statuslogin`, `usua_terminallogin`, `usua_logobienvenida`, `usua_logomenu`, `usua_celular`, `usua_imagepath`, `usua_auxv1`, `usua_auxv2`, `usua_auxv3`, `usua_auxv4`, `usua_auxv5`, `usua_auxv6`, `usua_auxi1`, `usua_auxi2`, `usua_auxi3`, `usua_auxi4`, `usua_auxi5`, `usua_auxi6`, `usua_fechacreacion`, `usua_usuariocreacion`, `usua_terminalcreacion`, `usua_fum`, `usua_uum`, `usua_tum`) VALUES
(1, 1, 1, 'ADM', '', 'Administrador', 'Sistemas', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'A', 0, '0', '2020-12-20', '0', '0', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '2020-12-20 16:12:43', 1, 'Sistemas', '2021-04-18 19:19:16', 1, 'Sistemas');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
