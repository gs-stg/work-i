-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2018 at 12:22 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.32

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sampablo001`
--
CREATE DATABASE IF NOT EXISTS `sampablo001` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sampablo001`;

-- --------------------------------------------------------

--
-- Table structure for table `t_clientes`
--

CREATE TABLE `t_clientes` (
  `idt_clientes` int(11) NOT NULL,
  `t_clientesNombre` varchar(45) DEFAULT NULL,
  `t_clientesApellido` varchar(45) DEFAULT NULL,
  `t_clientesTelefono` varchar(45) DEFAULT NULL,
  `t_clientesEmail` varchar(100) DEFAULT NULL,
  `t_clientesNif` varchar(45) DEFAULT NULL,
  `t_clientesEmpresa` varchar(100) DEFAULT NULL,
  `t_clientesEstatus` varchar(45) DEFAULT NULL,
  `t_usuarios_idt_usuarios_CreadoPor` int(11) DEFAULT NULL,
  `t_clientesDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_clientes`
--

INSERT INTO `t_clientes` (`idt_clientes`, `t_clientesNombre`, `t_clientesApellido`, `t_clientesTelefono`, `t_clientesEmail`, `t_clientesNif`, `t_clientesEmpresa`, `t_clientesEstatus`, `t_usuarios_idt_usuarios_CreadoPor`, `t_clientesDate`) VALUES
(9, 'taylor@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', NULL, 1, '2018-04-17'),
(10, 'taylor@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', NULL, 1, '2018-04-17'),
(11, 'taylor@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', NULL, 1, '2018-04-17'),
(12, 'taylor@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', NULL, 1, '2018-04-17'),
(13, 'taylor@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', NULL, 1, '2018-04-17'),
(14, 'dsdsd', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', 'dayle@example.com', NULL, 1, '2018-04-17'),
(15, 'dsdsd', 'dsdsds', 'dsdsds', 'dsdsds', NULL, 'dsdsds', NULL, 1, '2018-04-17'),
(16, 'nombre', 'apellido', '2345678', 'c.h@gmail.com', '6778889', 'zeta zeta', NULL, 1, '2018-04-17'),
(17, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(18, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(19, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(20, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(21, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(22, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(23, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(24, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(25, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(26, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(27, 'ndsds', 'dsdsd', 'dsdds', 'dsdsds', 'dsdsd', 'dsdsds', NULL, 1, '2018-04-17'),
(28, 'dsds', 'dsdsd', 'dsdsds', 'dsdsd', 'dsdsdsds', 'dsdd', NULL, 1, '2018-04-17'),
(29, 'dsds', 'dsdsd', 'dsdsds', 'dsdsd', 'dsdsdsds', 'dsdd', NULL, 1, '2018-04-17'),
(30, 'dsds', 'dsdsd', 'dsdsds', 'dsdsd', 'dsdsdsds', 'dsdd', NULL, 1, '2018-04-17'),
(31, 'aaaa', '22aaaaaaa', 'aaa', 'aaaaaa', 'a', 'aaaaa', NULL, 1, '2018-04-17'),
(32, 'dsds', 'dsdsd', 'dsdsds', 'dsdsd', 'dsdsdsds', 'dsdd', NULL, 1, '2018-04-17'),
(33, 'dsdsds', 'dsdsdsds', 'dsdsdsds', 'sdsdsd', 'dsdsdsds', 'sdsds', NULL, 1, '2018-04-18'),
(34, 'dsdsds', 'dsdsdsds', 'dsdsdsds', 'sdsdsd', 'dsdsdsds', 'sdsds', NULL, 1, '2018-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `t_oficinas`
--

CREATE TABLE `t_oficinas` (
  `idt_oficinas` int(11) NOT NULL,
  `t_oficinasNombre` varchar(45) DEFAULT NULL,
  `t_oficinasUrlLogo` text,
  `t_oficinasUrlPiePresupuesto` text,
  `t_oficinasUrlPieContrato` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_oficinas`
--

INSERT INTO `t_oficinas` (`idt_oficinas`, `t_oficinasNombre`, `t_oficinasUrlLogo`, `t_oficinasUrlPiePresupuesto`, `t_oficinasUrlPieContrato`) VALUES
(1, 'Officina 001', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_preguntas`
--

CREATE TABLE `t_preguntas` (
  `idt_preguntas` int(11) NOT NULL,
  `t_preguntasTitle` text,
  `t_preguntasOpcion` text,
  `t_preguntasPrecio` float(12,2) DEFAULT NULL,
  `t_preguntasGrupo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_preguntas`
--

INSERT INTO `t_preguntas` (`idt_preguntas`, `t_preguntasTitle`, `t_preguntasOpcion`, `t_preguntasPrecio`, `t_preguntasGrupo`) VALUES
(1, 'Tipo de Cliente', 'Autónomo', 1.00, 'Paso2'),
(2, 'Tipo de Cliente', 'Sociedad', 2.00, 'Paso2'),
(3, 'Tipo de Cliente', 'CB/SC', 3.00, 'Paso2'),
(4, 'Tipo de Cliente', 'Arrendador', 4.00, 'Paso2'),
(5, 'Tipo de Cliente', 'Empleador de Hogar', 5.00, 'Paso2'),
(6, 'Antigüedad', 'Nuevo', 6.00, 'Autónomo'),
(7, 'Antigüedad', '+ de 1 año.', 7.00, 'Autónomo'),
(8, 'Actividad', 'Vender Coches', 8.00, 'Autónomo'),
(9, 'Actividad', 'Construcción', 9.00, 'Autónomo'),
(10, 'Actividad', 'Comercio Minorista', 10.00, 'Autónomo'),
(11, 'Actividad', 'TRADE', 11.00, 'Autónomo'),
(12, 'Nro trabajadores', '', 12.00, 'Autónomo'),
(13, 'Al corriente en la Seguridad Social', 'Si', 13.00, 'Autónomo'),
(14, 'Al corriente en la Seguridad Social', 'No', 14.00, 'Autónomo'),
(15, 'Tiene procedimientos tributarios en vigor', 'Si', 15.00, 'Autónomo'),
(16, 'Tiene procedimientos tributarios en vigor', 'No', 17.00, 'Autónomo'),
(17, 'Antigüedad', 'Nuevo', 6.00, 'Sociedad'),
(18, 'Antigüedad', '+ de 1 año.', 7.00, 'Sociedad'),
(19, 'Actividad', 'Vender Coches', 8.00, 'Sociedad'),
(20, 'Actividad', 'Construcción', 9.00, 'Sociedad'),
(21, 'Actividad', 'Comercio Minorista', 10.00, 'Sociedad'),
(22, 'Actividad', 'TRADE', 11.00, 'Sociedad'),
(23, 'Nro trabajadores', '', 12.00, 'Sociedad'),
(24, 'Al corriente en la Seguridad Social', 'Si', 13.00, 'Sociedad'),
(25, 'Al corriente en la Seguridad Social', 'No', 14.00, 'Sociedad'),
(26, 'Tiene procedimientos tributarios en vigor', 'Si', 15.00, 'Sociedad'),
(27, 'Tiene procedimientos tributarios en vigor', 'No', 17.00, 'Sociedad'),
(32, 'Antigüedad', 'Nuevo', 6.00, 'CB/SC'),
(33, 'Antigüedad', '+ de 1 año.', 7.00, 'CB/SC'),
(34, 'Actividad', 'Vender Coches', 8.00, 'CB/SC'),
(35, 'Actividad', 'Construcción', 9.00, 'CB/SC'),
(36, 'Actividad', 'Comercio Minorista', 10.00, 'CB/SC'),
(37, 'Actividad', 'TRADE', 11.00, 'CB/SC'),
(38, 'Nro trabajadores', '', 12.00, 'CB/SC'),
(39, 'Al corriente en la Seguridad Social', 'Si', 13.00, 'CB/SC'),
(40, 'Al corriente en la Seguridad Social', 'No', 14.00, 'CB/SC'),
(41, 'Tiene procedimientos tributarios en vigor', 'Si', 15.00, 'CB/SC'),
(42, 'Tiene procedimientos tributarios en vigor', 'No', 17.00, 'CB/SC'),
(43, 'Facturación Anual', 'Hasta 60,000 Euros', 1.00, 'Sociedad'),
(44, 'Facturación Anual', 'Entre 60,001 y 200,000 Euros', 1.00, 'Sociedad'),
(45, 'Facturación Anual', 'Entre 200,001 y 500,000 Euros', 1.00, 'Sociedad'),
(46, 'Facturación Anual', 'Entre 500,001 y 1,000,000 Euros', 1.00, 'Sociedad'),
(47, 'Facturación Anual', 'Mas de 1,000,000 Euros', 1.00, 'Sociedad'),
(48, 'Facturación Anual', 'Hasta 60,000 Euros', 1.00, 'CB/SC'),
(49, 'Facturación Anual', 'Entre 60,001 y 200,000 Euros', 1.00, 'CB/SC'),
(50, 'Facturación Anual', 'Entre 200,001 y 500,000 Euros', 1.00, 'CB/SC'),
(51, 'Facturación Anual', 'Entre 500,001 y 1,000,000 Euros', 1.00, 'CB/SC'),
(52, 'Facturación Anual', 'Mas de 1,000,000 Euros', 1.00, 'CB/SC'),
(53, 'Cantidad de Locales', NULL, 1.00, 'Arrendador'),
(54, 'Cantidad de Empleados del Hogar', NULL, 1.00, 'Empleador de Hogar');

-- --------------------------------------------------------

--
-- Table structure for table `t_presupuestoRepuesta`
--

CREATE TABLE `t_presupuestoRepuesta` (
  `idt_presupuestoRepuesta` int(11) NOT NULL,
  `t_presupuestos_idt_presupuestos` int(11) NOT NULL,
  `t_presupuestoRepuestaValor` text,
  `t_preguntas_idt_preguntas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_presupuestoRepuesta`
--

INSERT INTO `t_presupuestoRepuesta` (`idt_presupuestoRepuesta`, `t_presupuestos_idt_presupuestos`, `t_presupuestoRepuestaValor`, `t_preguntas_idt_preguntas`) VALUES
(1, 6, '', 1),
(2, 6, '', 6),
(3, 6, '', 9),
(4, 6, '', 13),
(5, 6, '', 15),
(6, 6, '0', 12),
(7, 7, '', 1),
(8, 7, '', 6),
(9, 7, '', 9),
(10, 7, '', 13),
(11, 7, '', 15),
(12, 7, '0', 12),
(13, 11, '', 1),
(14, 11, '', 7),
(15, 11, '', 9),
(16, 11, '', 14),
(17, 11, '', 16),
(18, 11, '1000', 12),
(19, 12, '', 1),
(20, 12, '', 7),
(21, 12, '', 9),
(22, 12, '', 14),
(23, 12, '', 16),
(24, 12, '1000', 12),
(25, 13, '', 1),
(26, 13, '', 7),
(27, 13, '', 9),
(28, 13, '', 14),
(29, 13, '', 16),
(30, 13, '1000', 12),
(31, 14, '', 1),
(32, 14, '', 7),
(33, 14, '', 10),
(34, 14, '', 14),
(35, 14, '', 16),
(36, 14, '100', 12),
(37, 15, '', 1),
(38, 15, '', 7),
(39, 15, '', 9),
(40, 15, '', 14),
(41, 15, '', 16),
(42, 15, '1000', 12),
(43, 17, '', 2),
(44, 17, '', 17),
(45, 17, '', 19),
(46, 17, '', 24),
(47, 17, '', 26),
(48, 17, '0', 23),
(49, 17, '', 43);

-- --------------------------------------------------------

--
-- Table structure for table `t_presupuestos`
--

CREATE TABLE `t_presupuestos` (
  `idt_presupuestos` int(11) NOT NULL,
  `t_clientes_idt_clientes` int(11) NOT NULL,
  `t_presupuestosObservacion` text,
  `t_presupuestosValor` float(12,2) DEFAULT NULL,
  `t_presupuestosEstatus` varchar(45) DEFAULT 'Espera Aprobacion',
  `t_oficinas_idt_oficinas` int(11) NOT NULL,
  `t_presupuestosNumero` varchar(45) DEFAULT NULL,
  `t_usuarios_idt_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_presupuestos`
--

INSERT INTO `t_presupuestos` (`idt_presupuestos`, `t_clientes_idt_clientes`, `t_presupuestosObservacion`, `t_presupuestosValor`, `t_presupuestosEstatus`, `t_oficinas_idt_oficinas`, `t_presupuestosNumero`, `t_usuarios_idt_usuarios`) VALUES
(1, 18, 'observation', NULL, 'Espera Aprobacion', 1, '2018041645', 0),
(2, 19, 'observation', NULL, 'Espera Aprobacion', 1, '2018041646', 0),
(3, 20, 'observation', NULL, 'Espera Aprobacion', 1, '2018041801', 0),
(4, 21, 'observation', NULL, 'Espera Aprobacion', 1, '2018041803', 0),
(5, 22, 'observation', NULL, 'Espera Aprobacion', 1, '2018041805', 0),
(6, 23, 'observation', NULL, 'Espera Aprobacion', 1, '2018041806', 0),
(7, 24, 'observation', NULL, 'Espera Aprobacion', 1, '2018041810', 1),
(8, 25, 'observation', NULL, 'Espera Aprobacion', 1, '2018041824', 1),
(9, 26, 'observation', NULL, 'Espera Aprobacion', 1, '2018041827', 1),
(10, 27, 'observation', NULL, 'Espera Aprobacion', 1, '2018041827', 1),
(11, 28, 'o', NULL, 'Espera Aprobacion', 1, '2018041855', 1),
(12, 29, 'o', NULL, 'Espera Aprobacion', 1, '2018041855', 1),
(13, 30, 'o', NULL, 'Espera Aprobacion', 1, '2018041856', 1),
(14, 31, NULL, NULL, 'Espera Aprobacion', 1, '2018041859', 1),
(15, 32, 'o', NULL, 'Espera Aprobacion', 1, '2018041859', 1),
(16, 33, 'wwwwww', NULL, 'Espera Aprobacion', 1, '2018040815', 1),
(17, 34, 'wwwwww', NULL, 'Espera Aprobacion', 1, '2018040816', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_presupuestosConceptos`
--

CREATE TABLE `t_presupuestosConceptos` (
  `idt_presupuestosConceptos` int(11) NOT NULL,
  `t_presupuestos_idt_presupuestos` int(11) NOT NULL,
  `t_presupuestosConceptosNombres` text,
  `t_presupuestosConceptosDescripcion` text,
  `t_presupuestosConceptoCuota` text,
  `t_presupuestosConceptosOrden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_presupuestosConceptos`
--

INSERT INTO `t_presupuestosConceptos` (`idt_presupuestosConceptos`, `t_presupuestos_idt_presupuestos`, `t_presupuestosConceptosNombres`, `t_presupuestosConceptosDescripcion`, `t_presupuestosConceptoCuota`, `t_presupuestosConceptosOrden`) VALUES
(1, 13, 'Asesoramiento Fiscal, Contable y Jurídico.', 'Dentro de este Apartado nos encargamos en primer lugar de proceder a la Contabilización Completa de todas las operaciones económicas de su entidad, con el fin de elaborar los Estados Contables Oficiales, para que una vez validados con usted, podamos realizar la presentación y el cumplimiento en plazo de todas las Obligaciones Fiscales y Mercantiles de carácter periódico.\r\n                                                La realización de este trabajo contable requiere de la prestación de un servicio completo de Asesoramiento Fiscal que le permita a usted resolver todas las dudas que tenga y a nosotros garantizarle que el trabajo que se está haciendo es conforme a los criterios jurídicos que la normativa establece.\r\n                                                Igualmente y para su tranquilidad, nos encargamos de la vigilancia diaria durante los 365 días del año, de las Notificaciones Electrónicas que se puedan emitir hacia su empresa desde de la Agencia Tributaria o desde la Seguridad Social. Nosotros recogemos estas notificaciones EN PLAZO, y aquellas que directamente entren dentro de nuestros servicios procedemos a tramitarlas de inmediato, y por supuesto siempre teniéndole informado puntualmente de todo lo que se reciba y en particular de aquellas notificaciones sobre las que usted deba tomar alguna acción o deba indicarnos como debemos proceder.', '12047 euros + IVA / Mes (Estimado sobre un volumen de 2.000 apuntes anuales)', NULL),
(2, 13, 'Conciliación Bancaria.', 'Cuando nos referimos a que dentro de nuestro trabajo está el realizar una contabilidad completa, nos referimos a que TODO lo que tenga contenido económico va a ser registrado contablemente de forma individual. Nosotros no hacemos ni agrupamos información en un solo registro y por ello consideramos muy necesario ponerle de manifiesto la importancia de que en la empresa exista una Conciliación Bancaria Completa, de manera que TODOS los movimientos que existan en el Banco de su empresa tengan su correspondiente asiento individual en la Contabilidad.\r\n                                                Le aseguro por experiencia que esto que parece obvio, no lo es y muchísimas empresas no lo tienen o lo hacen de una forma muy genérica e incompleta, porque hacerlo bien es un trabajo muy complejo que requiere de mucho esfuerzo para poder cuadrar todo lo que viene en el banco y que indudablemente muchas veces necesita de su ayuda.\r\n                                                Nosotros le proporcionamos este servicio de Conciliación Bancaria de forma completa porque además de ser obligatorio legalmente en Contabilidad, es una garantía que permite detectar muchos errores y que puede ahorrar mucho dinero al cliente como puede ser el descubrir pagos duplicados o ingresos no cobrados.', 'Incluido en la Cuota Mensual', NULL),
(3, 13, 'Espacio en la Nube para Cliente.', 'Le ofrecemos la posibilidad de disponer de forma GRATUITA de un espacio de 1 Gb para almacenamiento en la nube de información. Este espacio nos permite tener a disposición del Cliente todos los datos escaneados de su empresa para que los pueda consultar, enviar y recibir a través de cualquier dispositivo, en cualquier lugar del mundo y a cualquier hora, y todo esto de forma segura.', 'Incluido en la Cuota Mensual', NULL),
(4, 13, 'Asesoramiento Laboral.', 'Una parte esencial de cualquier empresa es la Gestión de Personal, y este apartado es particularmente complejo, pues no sólo la normativa es muy variada sino que su aplicación Judicial lo es más todavía, es decir, los contratos, las bonificaciones, los despidos, en general cualquier acción que se lleve a efecto en relación con el personal si no está correctamente aplicada puede ser un problema en el futuro y puede costar mucho dinero a la empresa.\r\n                                                Nuestra obligación es hacer que el cliente conozca tanto las obligaciones que marca la ley, como las interpretaciones judiciales que cada día se conocen y asi de esta manera tratar de minimizar el riesgo futuro de problemas.\r\n                                                Nosotros ponemos a su disposición el equipo humano, técnico y jurídico necesario para que la Gestión de Personal sea completa, segura y eficaz desde la entrada en la empresa de cualquier trabajador, hasta su posible salida por cualquier motivo.', 'Cuota Fija de 15 euros/ mes y Cuota Variable de 15 euros + IVA / Trabajador / Mes', NULL),
(5, 13, 'Asesoramiento Jurídico.', 'Como parte de nuestro servicio y dentro la cuota fijada para su empresa, dispondrá de Asesoramiento Jurídico Ilimitado para la resolución de cuantas consultas pueda necesitar dentro del ámbito de actividad de su negocio. Por nuestra experiencia en el Área Jurídica, solemos distinguir dos grupos habituales de problemas en los que intervenimos, por un lado la existencia de actuaciones que tratan de evitar un conflicto (que puede ser laboral, de impago, etc) y por otro lado, la existencia de procedimientos judiciales (laborales, civiles, mercantiles, penales, etc). La primera parte anterior estaría cubierta dentro de nuestra cuota ofertada y sólo se cobraría al cliente aquellos Gastos Suplidos (burofax, correo, etc) en los que se haya incurrido.', 'Incluido en la Cuota Mensual', NULL),
(6, 13, 'Procedimientos Judiciales.', 'Además del Asesoramiento Jurídico para consultas de todo tipo, en la empresa nos podemos encontrar con asuntos que inevitablemente tengan que resolverse en los Juzgados y para este fin disponemos de un Departamento Jurídico propio para llevar la dirección letrada de cualquier procedimiento con arreglo a un presupuesto específico en función de la complejidad de cada caso.', 'Desde 300 euros / Procedimiento', NULL),
(7, 13, 'Gestión de Cobro de Clientes.', 'Nos encargaremos de la Gestión de cobro de sus clientes, tratando preferentemente de que dichos cobros se realicen de forma domiciliada de manera que el control sobre los ingresos individuales sea más efectivo. Si alguno de los clientes no satisface las cantidades a las que se ha comprometido trataremos de cobrar amistosamente, en caso contrario y si así recibimos el encargo trataremos de que lo haga por la vía judicial', 'Incluido en la Cuota Mensual', NULL),
(8, 13, 'Asesoramiento Mercantil', 'Cualquier Entidad está obligada a formular sus Estados Contables y a Depositarlos en el Registro correspondiente. Nosotros nos encargamos de todos los trámites dentro de los plazos marcados para dar la publicidad que la norma exige a cualquier Entidad', 'Legalización de Libros Anuales: 95  euros + IVA y Depósito de Cuentas Anuales: 180 euros + IVA', NULL),
(9, 15, 'Asesoramiento Fiscal, Contable y Jurídico.', 'Dentro de este Apartado nos encargamos en primer lugar de proceder a la Contabilización Completa de todas las operaciones económicas de su entidad, con el fin de elaborar los Estados Contables Oficiales, para que una vez validados con usted, podamos realizar la presentación y el cumplimiento en plazo de todas las Obligaciones Fiscales y Mercantiles de carácter periódico.\r\n                                                La realización de este trabajo contable requiere de la prestación de un servicio completo de Asesoramiento Fiscal que le permita a usted resolver todas las dudas que tenga y a nosotros garantizarle que el trabajo que se está haciendo es conforme a los criterios jurídicos que la normativa establece.\r\n                                                Igualmente y para su tranquilidad, nos encargamos de la vigilancia diaria durante los 365 días del año, de las Notificaciones Electrónicas que se puedan emitir hacia su empresa desde de la Agencia Tributaria o desde la Seguridad Social. Nosotros recogemos estas notificaciones EN PLAZO, y aquellas que directamente entren dentro de nuestros servicios procedemos a tramitarlas de inmediato, y por supuesto siempre teniéndole informado puntualmente de todo lo que se reciba y en particular de aquellas notificaciones sobre las que usted deba tomar alguna acción o deba indicarnos como debemos proceder.', '12047 euros + IVA / Mes (Estimado sobre un volumen de 2.000 apuntes anuales)', 1),
(10, 15, 'Conciliación Bancaria.', 'Cuando nos referimos a que dentro de nuestro trabajo está el realizar una contabilidad completa, nos referimos a que TODO lo que tenga contenido económico va a ser registrado contablemente de forma individual. Nosotros no hacemos ni agrupamos información en un solo registro y por ello consideramos muy necesario ponerle de manifiesto la importancia de que en la empresa exista una Conciliación Bancaria Completa, de manera que TODOS los movimientos que existan en el Banco de su empresa tengan su correspondiente asiento individual en la Contabilidad.\r\n                                                Le aseguro por experiencia que esto que parece obvio, no lo es y muchísimas empresas no lo tienen o lo hacen de una forma muy genérica e incompleta, porque hacerlo bien es un trabajo muy complejo que requiere de mucho esfuerzo para poder cuadrar todo lo que viene en el banco y que indudablemente muchas veces necesita de su ayuda.\r\n                                                Nosotros le proporcionamos este servicio de Conciliación Bancaria de forma completa porque además de ser obligatorio legalmente en Contabilidad, es una garantía que permite detectar muchos errores y que puede ahorrar mucho dinero al cliente como puede ser el descubrir pagos duplicados o ingresos no cobrados.', 'Incluido en la Cuota Mensual', 2),
(11, 15, 'Espacio en la Nube para Cliente.', 'Le ofrecemos la posibilidad de disponer de forma GRATUITA de un espacio de 1 Gb para almacenamiento en la nube de información. Este espacio nos permite tener a disposición del Cliente todos los datos escaneados de su empresa para que los pueda consultar, enviar y recibir a través de cualquier dispositivo, en cualquier lugar del mundo y a cualquier hora, y todo esto de forma segura.', 'Incluido en la Cuota Mensual', 3),
(12, 15, 'Asesoramiento Laboral.', 'Una parte esencial de cualquier empresa es la Gestión de Personal, y este apartado es particularmente complejo, pues no sólo la normativa es muy variada sino que su aplicación Judicial lo es más todavía, es decir, los contratos, las bonificaciones, los despidos, en general cualquier acción que se lleve a efecto en relación con el personal si no está correctamente aplicada puede ser un problema en el futuro y puede costar mucho dinero a la empresa.\r\n                                                Nuestra obligación es hacer que el cliente conozca tanto las obligaciones que marca la ley, como las interpretaciones judiciales que cada día se conocen y asi de esta manera tratar de minimizar el riesgo futuro de problemas.\r\n                                                Nosotros ponemos a su disposición el equipo humano, técnico y jurídico necesario para que la Gestión de Personal sea completa, segura y eficaz desde la entrada en la empresa de cualquier trabajador, hasta su posible salida por cualquier motivo.', 'Cuota Fija de 15 euros/ mes y Cuota Variable de 15 euros + IVA / Trabajador / Mes', 4),
(13, 15, 'Asesoramiento Jurídico.', 'Como parte de nuestro servicio y dentro la cuota fijada para su empresa, dispondrá de Asesoramiento Jurídico Ilimitado para la resolución de cuantas consultas pueda necesitar dentro del ámbito de actividad de su negocio. Por nuestra experiencia en el Área Jurídica, solemos distinguir dos grupos habituales de problemas en los que intervenimos, por un lado la existencia de actuaciones que tratan de evitar un conflicto (que puede ser laboral, de impago, etc) y por otro lado, la existencia de procedimientos judiciales (laborales, civiles, mercantiles, penales, etc). La primera parte anterior estaría cubierta dentro de nuestra cuota ofertada y sólo se cobraría al cliente aquellos Gastos Suplidos (burofax, correo, etc) en los que se haya incurrido.', 'Incluido en la Cuota Mensual', 5),
(14, 15, 'Procedimientos Judiciales.', 'Además del Asesoramiento Jurídico para consultas de todo tipo, en la empresa nos podemos encontrar con asuntos que inevitablemente tengan que resolverse en los Juzgados y para este fin disponemos de un Departamento Jurídico propio para llevar la dirección letrada de cualquier procedimiento con arreglo a un presupuesto específico en función de la complejidad de cada caso.', 'Desde 300 euros / Procedimiento', 6),
(15, 15, 'Gestión de Cobro de Clientes.', 'Nos encargaremos de la Gestión de cobro de sus clientes, tratando preferentemente de que dichos cobros se realicen de forma domiciliada de manera que el control sobre los ingresos individuales sea más efectivo. Si alguno de los clientes no satisface las cantidades a las que se ha comprometido trataremos de cobrar amistosamente, en caso contrario y si así recibimos el encargo trataremos de que lo haga por la vía judicial', 'Incluido en la Cuota Mensual', 7),
(16, 15, 'Asesoramiento Mercantil', 'Cualquier Entidad está obligada a formular sus Estados Contables y a Depositarlos en el Registro correspondiente. Nosotros nos encargamos de todos los trámites dentro de los plazos marcados para dar la publicidad que la norma exige a cualquier Entidad', 'Legalización de Libros Anuales: 95  euros + IVA y Depósito de Cuentas Anuales: 180 euros + IVA', 8),
(17, 16, 'Asesoramiento Fiscal, Contable y Jurídico.', 'Dentro de este Apartado nos encargamos en primer lugar de proceder a la Contabilización Completa de todas las operaciones económicas de su entidad, con el fin de elaborar los Estados Contables Oficiales, para que una vez validados con usted, podamos realizar la presentación y el cumplimiento en plazo de todas las Obligaciones Fiscales y Mercantiles de carácter periódico.\r\n                                                La realización de este trabajo contable requiere de la prestación de un servicio completo de Asesoramiento Fiscal que le permita a usted resolver todas las dudas que tenga y a nosotros garantizarle que el trabajo que se está haciendo es conforme a los criterios jurídicos que la normativa establece.\r\n                                                Igualmente y para su tranquilidad, nos encargamos de la vigilancia diaria durante los 365 días del año, de las Notificaciones Electrónicas que se puedan emitir hacia su empresa desde de la Agencia Tributaria o desde la Seguridad Social. Nosotros recogemos estas notificaciones EN PLAZO, y aquellas que directamente entren dentro de nuestros servicios procedemos a tramitarlas de inmediato, y por supuesto siempre teniéndole informado puntualmente de todo lo que se reciba y en particular de aquellas notificaciones sobre las que usted deba tomar alguna acción o deba indicarnos como debemos proceder.', '43 euros + IVA / Mes (Estimado sobre un volumen de 2.000 apuntes anuales)', 1),
(18, 16, 'Conciliación Bancaria.', 'Cuando nos referimos a que dentro de nuestro trabajo está el realizar una contabilidad completa, nos referimos a que TODO lo que tenga contenido económico va a ser registrado contablemente de forma individual. Nosotros no hacemos ni agrupamos información en un solo registro y por ello consideramos muy necesario ponerle de manifiesto la importancia de que en la empresa exista una Conciliación Bancaria Completa, de manera que TODOS los movimientos que existan en el Banco de su empresa tengan su correspondiente asiento individual en la Contabilidad.\r\n                                                Le aseguro por experiencia que esto que parece obvio, no lo es y muchísimas empresas no lo tienen o lo hacen de una forma muy genérica e incompleta, porque hacerlo bien es un trabajo muy complejo que requiere de mucho esfuerzo para poder cuadrar todo lo que viene en el banco y que indudablemente muchas veces necesita de su ayuda.\r\n                                                Nosotros le proporcionamos este servicio de Conciliación Bancaria de forma completa porque además de ser obligatorio legalmente en Contabilidad, es una garantía que permite detectar muchos errores y que puede ahorrar mucho dinero al cliente como puede ser el descubrir pagos duplicados o ingresos no cobrados.', 'Incluido en la Cuota Mensual', 2),
(19, 16, 'Espacio en la Nube para Cliente.', 'Le ofrecemos la posibilidad de disponer de forma GRATUITA de un espacio de 1 Gb para almacenamiento en la nube de información. Este espacio nos permite tener a disposición del Cliente todos los datos escaneados de su empresa para que los pueda consultar, enviar y recibir a través de cualquier dispositivo, en cualquier lugar del mundo y a cualquier hora, y todo esto de forma segura.', 'Incluido en la Cuota Mensual', 3),
(20, 16, 'Asesoramiento Laboral.', 'Una parte esencial de cualquier empresa es la Gestión de Personal, y este apartado es particularmente complejo, pues no sólo la normativa es muy variada sino que su aplicación Judicial lo es más todavía, es decir, los contratos, las bonificaciones, los despidos, en general cualquier acción que se lleve a efecto en relación con el personal si no está correctamente aplicada puede ser un problema en el futuro y puede costar mucho dinero a la empresa.\r\n                                                Nuestra obligación es hacer que el cliente conozca tanto las obligaciones que marca la ley, como las interpretaciones judiciales que cada día se conocen y asi de esta manera tratar de minimizar el riesgo futuro de problemas.\r\n                                                Nosotros ponemos a su disposición el equipo humano, técnico y jurídico necesario para que la Gestión de Personal sea completa, segura y eficaz desde la entrada en la empresa de cualquier trabajador, hasta su posible salida por cualquier motivo.', 'Cuota Fija de 15 euros/ mes y Cuota Variable de 15 euros + IVA / Trabajador / Mes', 4),
(21, 16, 'Asesoramiento Jurídico.', 'Como parte de nuestro servicio y dentro la cuota fijada para su empresa, dispondrá de Asesoramiento Jurídico Ilimitado para la resolución de cuantas consultas pueda necesitar dentro del ámbito de actividad de su negocio. Por nuestra experiencia en el Área Jurídica, solemos distinguir dos grupos habituales de problemas en los que intervenimos, por un lado la existencia de actuaciones que tratan de evitar un conflicto (que puede ser laboral, de impago, etc) y por otro lado, la existencia de procedimientos judiciales (laborales, civiles, mercantiles, penales, etc). La primera parte anterior estaría cubierta dentro de nuestra cuota ofertada y sólo se cobraría al cliente aquellos Gastos Suplidos (burofax, correo, etc) en los que se haya incurrido.', 'Incluido en la Cuota Mensual', 5),
(22, 16, 'Procedimientos Judiciales.', 'Además del Asesoramiento Jurídico para consultas de todo tipo, en la empresa nos podemos encontrar con asuntos que inevitablemente tengan que resolverse en los Juzgados y para este fin disponemos de un Departamento Jurídico propio para llevar la dirección letrada de cualquier procedimiento con arreglo a un presupuesto específico en función de la complejidad de cada caso.', 'Desde 300 euros / Procedimiento', 6),
(23, 16, 'Gestión de Cobro de Clientes.', 'Nos encargaremos de la Gestión de cobro de sus clientes, tratando preferentemente de que dichos cobros se realicen de forma domiciliada de manera que el control sobre los ingresos individuales sea más efectivo. Si alguno de los clientes no satisface las cantidades a las que se ha comprometido trataremos de cobrar amistosamente, en caso contrario y si así recibimos el encargo trataremos de que lo haga por la vía judicial', 'Incluido en la Cuota Mensual', 7),
(24, 16, 'Asesoramiento Mercantil', 'Cualquier Entidad está obligada a formular sus Estados Contables y a Depositarlos en el Registro correspondiente. Nosotros nos encargamos de todos los trámites dentro de los plazos marcados para dar la publicidad que la norma exige a cualquier Entidad', 'Legalización de Libros Anuales: 95  euros + IVA y Depósito de Cuentas Anuales: 180 euros + IVA', 8),
(25, 17, 'Asesoramiento Fiscal, Contable y Jurídico.', 'Dentro de este Apartado nos encargamos en primer lugar de proceder a la Contabilización Completa de todas las operaciones económicas de su entidad, con el fin de elaborar los Estados Contables Oficiales, para que una vez validados con usted, podamos realizar la presentación y el cumplimiento en plazo de todas las Obligaciones Fiscales y Mercantiles de carácter periódico.\r\n                                                La realización de este trabajo contable requiere de la prestación de un servicio completo de Asesoramiento Fiscal que le permita a usted resolver todas las dudas que tenga y a nosotros garantizarle que el trabajo que se está haciendo es conforme a los criterios jurídicos que la normativa establece.\r\n                                                Igualmente y para su tranquilidad, nos encargamos de la vigilancia diaria durante los 365 días del año, de las Notificaciones Electrónicas que se puedan emitir hacia su empresa desde de la Agencia Tributaria o desde la Seguridad Social. Nosotros recogemos estas notificaciones EN PLAZO, y aquellas que directamente entren dentro de nuestros servicios procedemos a tramitarlas de inmediato, y por supuesto siempre teniéndole informado puntualmente de todo lo que se reciba y en particular de aquellas notificaciones sobre las que usted deba tomar alguna acción o deba indicarnos como debemos proceder.', '43 euros + IVA / Mes (Estimado sobre un volumen de 2.000 apuntes anuales)', 1),
(26, 17, 'Conciliación Bancaria.', 'Cuando nos referimos a que dentro de nuestro trabajo está el realizar una contabilidad completa, nos referimos a que TODO lo que tenga contenido económico va a ser registrado contablemente de forma individual. Nosotros no hacemos ni agrupamos información en un solo registro y por ello consideramos muy necesario ponerle de manifiesto la importancia de que en la empresa exista una Conciliación Bancaria Completa, de manera que TODOS los movimientos que existan en el Banco de su empresa tengan su correspondiente asiento individual en la Contabilidad.\r\n                                                Le aseguro por experiencia que esto que parece obvio, no lo es y muchísimas empresas no lo tienen o lo hacen de una forma muy genérica e incompleta, porque hacerlo bien es un trabajo muy complejo que requiere de mucho esfuerzo para poder cuadrar todo lo que viene en el banco y que indudablemente muchas veces necesita de su ayuda.\r\n                                                Nosotros le proporcionamos este servicio de Conciliación Bancaria de forma completa porque además de ser obligatorio legalmente en Contabilidad, es una garantía que permite detectar muchos errores y que puede ahorrar mucho dinero al cliente como puede ser el descubrir pagos duplicados o ingresos no cobrados.', 'Incluido en la Cuota Mensual', 2),
(27, 17, 'Espacio en la Nube para Cliente.', 'Le ofrecemos la posibilidad de disponer de forma GRATUITA de un espacio de 1 Gb para almacenamiento en la nube de información. Este espacio nos permite tener a disposición del Cliente todos los datos escaneados de su empresa para que los pueda consultar, enviar y recibir a través de cualquier dispositivo, en cualquier lugar del mundo y a cualquier hora, y todo esto de forma segura.', 'Incluido en la Cuota Mensual', 3),
(28, 17, 'Asesoramiento Laboral.', 'Una parte esencial de cualquier empresa es la Gestión de Personal, y este apartado es particularmente complejo, pues no sólo la normativa es muy variada sino que su aplicación Judicial lo es más todavía, es decir, los contratos, las bonificaciones, los despidos, en general cualquier acción que se lleve a efecto en relación con el personal si no está correctamente aplicada puede ser un problema en el futuro y puede costar mucho dinero a la empresa.\r\n                                                Nuestra obligación es hacer que el cliente conozca tanto las obligaciones que marca la ley, como las interpretaciones judiciales que cada día se conocen y asi de esta manera tratar de minimizar el riesgo futuro de problemas.\r\n                                                Nosotros ponemos a su disposición el equipo humano, técnico y jurídico necesario para que la Gestión de Personal sea completa, segura y eficaz desde la entrada en la empresa de cualquier trabajador, hasta su posible salida por cualquier motivo.', 'Cuota Fija de 15 euros/ mes y Cuota Variable de 15 euros + IVA / Trabajador / Mes', 4),
(29, 17, 'Asesoramiento Jurídico.', 'Como parte de nuestro servicio y dentro la cuota fijada para su empresa, dispondrá de Asesoramiento Jurídico Ilimitado para la resolución de cuantas consultas pueda necesitar dentro del ámbito de actividad de su negocio. Por nuestra experiencia en el Área Jurídica, solemos distinguir dos grupos habituales de problemas en los que intervenimos, por un lado la existencia de actuaciones que tratan de evitar un conflicto (que puede ser laboral, de impago, etc) y por otro lado, la existencia de procedimientos judiciales (laborales, civiles, mercantiles, penales, etc). La primera parte anterior estaría cubierta dentro de nuestra cuota ofertada y sólo se cobraría al cliente aquellos Gastos Suplidos (burofax, correo, etc) en los que se haya incurrido.', 'Incluido en la Cuota Mensual', 5),
(30, 17, 'Procedimientos Judiciales.', 'Además del Asesoramiento Jurídico para consultas de todo tipo, en la empresa nos podemos encontrar con asuntos que inevitablemente tengan que resolverse en los Juzgados y para este fin disponemos de un Departamento Jurídico propio para llevar la dirección letrada de cualquier procedimiento con arreglo a un presupuesto específico en función de la complejidad de cada caso.', 'Desde 300 euros / Procedimiento', 6),
(31, 17, 'Gestión de Cobro de Clientes.', 'Nos encargaremos de la Gestión de cobro de sus clientes, tratando preferentemente de que dichos cobros se realicen de forma domiciliada de manera que el control sobre los ingresos individuales sea más efectivo. Si alguno de los clientes no satisface las cantidades a las que se ha comprometido trataremos de cobrar amistosamente, en caso contrario y si así recibimos el encargo trataremos de que lo haga por la vía judicial', 'Incluido en la Cuota Mensual', 7),
(32, 17, 'Asesoramiento Mercantil', 'Cualquier Entidad está obligada a formular sus Estados Contables y a Depositarlos en el Registro correspondiente. Nosotros nos encargamos de todos los trámites dentro de los plazos marcados para dar la publicidad que la norma exige a cualquier Entidad', 'Legalización de Libros Anuales: 95  euros + IVA y Depósito de Cuentas Anuales: 180 euros + IVA', 8);

-- --------------------------------------------------------

--
-- Table structure for table `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `idt_usuarios` int(11) NOT NULL,
  `t_usuariosReferencia` varchar(45) NOT NULL,
  `t_usuariosNombre` varchar(45) DEFAULT NULL,
  `t_usuariosApellido` varchar(45) DEFAULT NULL,
  `t_oficinas_idt_oficinas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_usuarios`
--

INSERT INTO `t_usuarios` (`idt_usuarios`, `t_usuariosReferencia`, `t_usuariosNombre`, `t_usuariosApellido`, `t_oficinas_idt_oficinas`) VALUES
(1, 'c.j', 'carlos', 'Hernandez', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_clientes`
--
ALTER TABLE `t_clientes`
  ADD PRIMARY KEY (`idt_clientes`),
  ADD KEY `fk_t_clientes_t_usuarios_idx` (`t_usuarios_idt_usuarios_CreadoPor`);

--
-- Indexes for table `t_oficinas`
--
ALTER TABLE `t_oficinas`
  ADD PRIMARY KEY (`idt_oficinas`);

--
-- Indexes for table `t_preguntas`
--
ALTER TABLE `t_preguntas`
  ADD PRIMARY KEY (`idt_preguntas`);

--
-- Indexes for table `t_presupuestoRepuesta`
--
ALTER TABLE `t_presupuestoRepuesta`
  ADD PRIMARY KEY (`idt_presupuestoRepuesta`),
  ADD KEY `fk_t_presupuestoRepuesta_t_presupestos1_idx` (`t_presupuestos_idt_presupuestos`),
  ADD KEY `fk_t_presupuestoRepuesta_t_preguntas1_idx` (`t_preguntas_idt_preguntas`);

--
-- Indexes for table `t_presupuestos`
--
ALTER TABLE `t_presupuestos`
  ADD PRIMARY KEY (`idt_presupuestos`),
  ADD KEY `fk_t_presupestos_t_clientes1_idx` (`t_clientes_idt_clientes`),
  ADD KEY `fk_t_presupuestos_t_oficinas1_idx` (`t_oficinas_idt_oficinas`),
  ADD KEY `fk_t_presupuestos_t_usuarios1_idx` (`t_usuarios_idt_usuarios`);

--
-- Indexes for table `t_presupuestosConceptos`
--
ALTER TABLE `t_presupuestosConceptos`
  ADD PRIMARY KEY (`idt_presupuestosConceptos`),
  ADD KEY `fk_t_presupuestosConceptos_t_presupuestos1_idx` (`t_presupuestos_idt_presupuestos`);

--
-- Indexes for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`idt_usuarios`),
  ADD KEY `fk_t_usuarios_t_oficinas_idx` (`t_oficinas_idt_oficinas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_clientes`
--
ALTER TABLE `t_clientes`
  MODIFY `idt_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `t_oficinas`
--
ALTER TABLE `t_oficinas`
  MODIFY `idt_oficinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_preguntas`
--
ALTER TABLE `t_preguntas`
  MODIFY `idt_preguntas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `t_presupuestoRepuesta`
--
ALTER TABLE `t_presupuestoRepuesta`
  MODIFY `idt_presupuestoRepuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `t_presupuestos`
--
ALTER TABLE `t_presupuestos`
  MODIFY `idt_presupuestos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_presupuestosConceptos`
--
ALTER TABLE `t_presupuestosConceptos`
  MODIFY `idt_presupuestosConceptos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `idt_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_clientes`
--
ALTER TABLE `t_clientes`
  ADD CONSTRAINT `fk_t_clientes_t_usuarios` FOREIGN KEY (`t_usuarios_idt_usuarios_CreadoPor`) REFERENCES `t_usuarios` (`idt_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_presupuestoRepuesta`
--
ALTER TABLE `t_presupuestoRepuesta`
  ADD CONSTRAINT `fk_t_presupuestoRepuesta_t_preguntas1` FOREIGN KEY (`t_preguntas_idt_preguntas`) REFERENCES `t_preguntas` (`idt_preguntas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_presupuestoRepuesta_t_presupestos1` FOREIGN KEY (`t_presupuestos_idt_presupuestos`) REFERENCES `t_presupuestos` (`idt_presupuestos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_presupuestos`
--
ALTER TABLE `t_presupuestos`
  ADD CONSTRAINT `fk_t_presupestos_t_clientes1` FOREIGN KEY (`t_clientes_idt_clientes`) REFERENCES `t_clientes` (`idt_clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_presupuestos_t_oficinas1` FOREIGN KEY (`t_oficinas_idt_oficinas`) REFERENCES `t_oficinas` (`idt_oficinas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_presupuestos_t_usuarios1` FOREIGN KEY (`t_usuarios_idt_usuarios`) REFERENCES `t_usuarios` (`idt_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_presupuestosConceptos`
--
ALTER TABLE `t_presupuestosConceptos`
  ADD CONSTRAINT `fk_t_presupuestosConceptos_t_presupuestos1` FOREIGN KEY (`t_presupuestos_idt_presupuestos`) REFERENCES `t_presupuestos` (`idt_presupuestos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `fk_t_usuarios_t_oficinas` FOREIGN KEY (`t_oficinas_idt_oficinas`) REFERENCES `t_oficinas` (`idt_oficinas`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
