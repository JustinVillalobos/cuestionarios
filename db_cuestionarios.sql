-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2022 a las 18:56:00
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cuestionarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionarios`
--

CREATE TABLE `cuestionarios` (
  `idCuestionario` int(11) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaCreacion` date NOT NULL,
  `disponible` tinyint(4) NOT NULL,
  `autor` int(11) NOT NULL,
  `antecedentesPersonales` text DEFAULT NULL,
  `antecedentesFamiliares` text DEFAULT NULL,
  `motivoConsulta` text DEFAULT NULL,
  `revision` text DEFAULT NULL,
  `edad` tinyint(4) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `genero` tinyint(4) DEFAULT NULL,
  `trabajo` varchar(50) DEFAULT NULL,
  `hijos` tinyint(4) DEFAULT NULL,
  `imagenSeccion` varchar(150) DEFAULT NULL,
  `seccion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuestionarios`
--

INSERT INTO `cuestionarios` (`idCuestionario`, `codigo`, `titulo`, `descripcion`, `fechaCreacion`, `disponible`, `autor`, `antecedentesPersonales`, `antecedentesFamiliares`, `motivoConsulta`, `revision`, `edad`, `imagen`, `genero`, `trabajo`, `hijos`, `imagenSeccion`, `seccion`) VALUES
(1, 'rycRhjWf5TEb4kpI2Zdlt87m', 'Caso de estudio Santa Fe', 'Caso ficticio', '2022-08-06', 2, 1, '<p>sdds</p><p>sdd</p><p>sdsd</p><p><img src=\"https://th.bing.com/th/id/R.26f00c854d444889c0d6c7888309caff?rik=IwJIG1i%2fYNYXEQ&amp;riu=http%3a%2f%2f3.bp.blogspot.com%2f_hKzMu64muJg%2fTOCUXycqIsI%2fAAAAAAAAAJQ%2fg3uldCkRSLg%2fs1600%2fnaruto_wallpaper_uzumaki_naruto-20114.jpeg&amp;ehk=rWjiFuvde9n%2fN5cb%2b2snG%2fVID%2fcFN6nW9GJo8sg1pko%3d&amp;risl=&amp;pid=ImgRaw&amp;r=0\" height=\"200\" width=\"200\">sdaas<br></p>', '<p><b>Hipertension familiar</b></p>', '<ul><li>Dolor de cabeza</li><li>Fiebre</li></ul><p class=\"sceditor-nlf\"><br></p>', '<p>Se toma la temperatura y prueba de sangre</p>', 22, '3', 0, 'Informatico', 0, NULL, NULL),
(15, 'xt0E4RngHmpPN97dvbeaTGMs', 'Caso de Estudio Santa Fe de Costa Rica', 'Es un caso de estudio', '2022-08-09', 1, 1, '<p>sdds</p><p>sdd</p><p>sdsd</p><p><img src=\"https://th.bing.com/th/id/R.26f00c854d444889c0d6c7888309caff?rik=IwJIG1i%2fYNYXEQ&amp;riu=http%3a%2f%2f3.bp.blogspot.com%2f_hKzMu64muJg%2fTOCUXycqIsI%2fAAAAAAAAAJQ%2fg3uldCkRSLg%2fs1600%2fnaruto_wallpaper_uzumaki_naruto-20114.jpeg&amp;ehk=rWjiFuvde9n%2fN5cb%2b2snG%2fVID%2fcFN6nW9GJo8sg1pko%3d&amp;risl=&amp;pid=ImgRaw&amp;r=0\" height=\"200\" width=\"200\">sdaas<br></p>', '<p><img src=\"http://localhost:8085/cuestionarios/public/assets/logo.png\" height=\"200\" width=\"200\">sdaas<br></p>', '<p>Motivo</p>', '<p>Revision</p>', 22, '3', 0, 'asdsd', 0, 'assets/cuestionarios/Img dKw6eBTaN8HWz0J.jpeg', 4),
(27, 'wqeqwewqewee', 'sdfdf', 'sdfsdfdf', '2022-08-13', 2, 1, 'ads', 'sad', 'sda', 'ads', 24, '1', 1, 'sdasd', 0, NULL, 0),
(28, 'SpgBaXeDQiJy7N92xznbwAI5', 'fsdfs', 'dsfdfs', '2022-08-14', 1, 1, '<p>sfdfds</p>', '<p>dfsdfs</p>', '<p>sdfdf</p>', '<p>fdsdsf</p>', 33, '1', 0, 'dfssdf', 0, 'assets/cuestionarios/Img SAiYKs6ywafMpCv.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `respuesta1` varchar(100) NOT NULL,
  `respuesta2` varchar(100) NOT NULL,
  `respuesta3` varchar(100) DEFAULT NULL,
  `respuesta4` varchar(100) DEFAULT NULL,
  `solucion` tinyint(4) NOT NULL,
  `detalles` text NOT NULL,
  `ayuda` text DEFAULT NULL,
  `definiciones` text DEFAULT NULL,
  `idCuestionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `solucion`, `detalles`, `ayuda`, `definiciones`, `idCuestionario`) VALUES
(9, '¿Es esto una pregunta?', 'Si', 'No', 'Talvez', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. \r\n</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget.Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetSuspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetSuspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetSuspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. Morbi laoreet, est eu vestibulum porttitor, metus metus pellentesque dolor, vel venenatis orci odio sit amet nunc. Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris eget .Cras quis dapibus massa. Suspendisse iaculis viverra lorem suscipit elementum. Etiam pretium mauris egetLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec erat justo, sodales vestibulum laoreet a, malesuada quis magna. \r\n\r\n</p>', '<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>', 15),
(10, 'sggf', 'fdsfd', 'fdfd', '', '', 0, '<p>\r\n</p>', '<p>\r\n\r\n</p>', '<p>dfdf</p>', 15),
(16, 'gffg', 'dfsfd', 'SASAD', 'dffd', '', 1, '<p>adssad</p>', '<p>adssda</p>', '<p>sadsd</p>', 28),
(17, 'fdgfd', 'dfgfg', 'dggfd', '', '', 0, '<p>sdasda</p>', '<p>fdgfd</p>', '<p>adssad</p>', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE `puntajes` (
  `idPuntaje` int(11) NOT NULL,
  `codigo` varchar(125) NOT NULL,
  `nombre` varchar(125) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `puntajeCorrecto` int(11) NOT NULL,
  `puntajeIncorrecto` int(11) NOT NULL,
  `idCuestionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puntajes`
--

INSERT INTO `puntajes` (`idPuntaje`, `codigo`, `nombre`, `fechaCreacion`, `puntajeCorrecto`, `puntajeIncorrecto`, `idCuestionario`) VALUES
(7, 'qTB7kCbf0tH3KIYuSAqF0OlIcmEYVQ26EnAfieyW2UUzMQycBsRrkPP8xJ5bRGsNhauvLXdHMgt', 'dsds', '2022-08-12 14:59:20', 1, 1, 15),
(8, 'VtBdjcF4SVCCkisILetp3bfFdwMvuEUrqOoxAJ24KyED5e85m91NYXU6Lql8TJnT01HN3R6HAax', 'Josefino', '2022-08-12 15:00:05', 2, 0, 15),
(9, 'h0ZSf6olCVwOdmlPkgFufWW2i9GqMckB9GbvEDUrabI6FMcNStjNR4EJvyzZRpan5H1esj8YoLT', 'PAdrino', '2022-08-12 15:01:16', 1, 1, 15),
(10, 'Clle4HKB5cYNvue6apcqPybNBrIyhjIVu2MhfU0W2knUTHJE13tXPOTizS8q6isFWwxdQRFt3Vx', 'Reboot', '2022-08-12 15:01:52', 2, 0, 15),
(11, 'i4pdJNlyvOqlW2MHK6Nfn37qMsCa5wFXLBRovGYuUobx4ZDntJzQRjm8AiSQZwIAc3Y8hCFh09X', 'Ele', '2022-08-12 15:02:26', 2, 0, 15),
(12, 'T2sY5Nom318fGnZIWi8LXh0itOeEBrQ45C6ubuTNxFZHtLpGegjy1VAQJwUaMwqDXRUKmB3Pzhl', 'sdds', '2022-08-12 15:10:41', 2, 0, 15),
(15, 'rODfJnQO2takoCq3uiMV62gb1GSj94AecZ8HPEuf461TyLKgBFCdzjt09KVhelwZzvn37m7iphc', 'dsds', '2022-08-12 16:23:33', 2, 0, 15),
(16, 'uLe7c0cgfIHMKtfokZb1UEwBm2hR8C5smbWAg6zjnxCXTrLod3NsQtvGJSavnhFjOIpP7uGZYA4', 'fsddsf', '2022-08-12 16:25:07', 2, 0, 15),
(17, 'CjMKEqyr1ZokgzUa1f4l75lwtTWNFvUsOmr0R6OZgfHS32bELLTQnKJ8RyiDI7Bv0JcxAqBh8Do', 'dddd', '2022-08-12 16:26:54', 2, 0, 15),
(19, 'cK1AlwfbuBaXVqmzEuzAW9xs2WTZYmXN5vFeIHgRa6PsQqyo78Mctkrpwd4PTNQdLGtZC2h3ChJ', 'dsds', '2022-08-12 16:41:52', 1, 1, 15),
(20, 'qEWJkXMufarKnpx8Y495zSPspHheyKjReHmR57GSGl1LC2q1VQW7aoitlvrwC3gEim8nBPZvIow', 'Josefino', '2022-08-12 16:48:13', 0, 0, 15),
(21, 'MVh6CNc4Bi1uqpS5E8hDH7dYqRabzW93ZtIcBgAPJkYTrCaMUkUi250FRZSeft8zolNOspdwxme', 'Josefino', '2022-08-12 16:51:07', 0, 0, 15),
(22, 'Yc4OnUAr05oOazGMPNoVuhFTaX397IZ78yWdfR1PYLjeeZEHKtjUvJEGbMrSfbhm6uBq3Qplkvm', 'Josefino', '2022-08-12 16:51:35', 0, 0, 15),
(23, 'S9l1yZd2FLugkgiQYecmO7nwFNKOa56Mx8lGAVp3H9qwbtkjJtrUY41BdvzEVQNWAs3jzyxP7I8', 'Josefino', '2022-08-12 16:54:31', 0, 0, 15),
(24, 'MuogHE2h5RLub79OSahTSN6ezdRvpTnmAz8IrQOvfKlPUtAH0NUJZl4k40eZGxJaFfLW3sQ1sGc', 'Josefinos', '2022-08-12 17:14:58', 1, 1, 15),
(26, 'QB4ifa98yqKAyE4GTjEpmRNaFqrsn3Y1gbUPlPxvlKLnwm5B2ICuAL6hgIcOoCHekdDijrXWN5F', 'dsdsdd', '2022-08-12 18:50:47', 1, 1, 15),
(27, 'TLRhTcKn3YUrWqiXoImb0Jga1dXDu5GNMnAPSJua3j6Wb4zjU4QEDGg19x7wpOezxdyfm2C8FZr', 'dfsfsdsdsd', '2022-08-12 19:22:26', 1, 1, 15),
(28, 'K2onfhy4Qc3TYyZAr6gUr1Sdz8R27xaLqVZK0acLlpGMPo0NHBbN8dIvb5Ekv6ten4uFfm9WXUS', 'Josefinodsd', '2022-08-12 19:22:39', 1, 1, 15),
(29, '7CgAgpkA6cObx9hvwQJVy1X5j4ruXUiVikqdTKLE0I1IDKBZlPPOnLU8w2SzEs3moHR4NZlepDT', 'dsdsddssdaa', '2022-08-12 19:26:22', 0, 2, 15),
(30, '4E6diYAhF3QVikjGJK1FetL5VJEpO07KuXxXU8Oyaa7DbNlsndbwN2vIzQI9MW35GCHmCRjvWy8', 'dsdsdgg', '2022-08-12 19:31:24', 2, 0, 15),
(31, '0PdeUM2yVyLrNBnfIYuhDv9KqbprRb34gEcx7Kdp3x5z7JtMqifue16XkOaQc0TL4osBCmHS2aw', 'dsdsdasds', '2022-08-12 19:32:51', 1, 1, 15),
(32, 'QcgZEhHmTooB7qzWhafJEkTPw0YjIR4S5iLMupeFMnKn3U6Vsg2Pkd6tXUvet7y9OA89lz4a8uc', 'Josefino', '2022-08-13 00:26:33', 1, 1, 15),
(33, '4Y7iQEavWyNIVMY98LHvlSpS4n66KCwf0y3UGGWVnsDqEJoXbbz1uTUMiXjmoPZgazgBxdeFkOe', 'Hhhh', '2022-08-13 00:28:02', 2, 0, 15),
(34, 'sF23JEeJOyA1R5ktdmQMbuxB6aXiLSlbToF5ZcMWqhawtQDq1vUzErPGGHI67o8OICNYgHlLhfV', 'Ti', '2022-08-13 00:31:48', 1, 1, 15),
(35, 'UNGAj67bXwsEJI38cdTMKuxGZOe2vnjOk84uSHqkH7bBhY9zgn2ygEiLFFyKpP9UMhQWBlom3Wo', 'Bianca', '2022-08-13 01:15:14', 1, 1, 15),
(36, 'IzP4ayvt2AybfBwSNCuGFGg7dOsW3o8ZUFrA52Kuj1Os6bYh1IoScJERJwQjTQVXe9HdfrZgkEl', 'dsdsds', '2022-08-13 14:47:24', 1, 1, 15),
(37, 'SFTGAsh7TcnQiBKw7HYmIMtX5quX8saedSCPpJUCb8aUy1rMneR5GkZfxgYxR3d44IzLo6Pbfto', 'sdds', '2022-08-13 14:53:57', 1, 1, 15),
(38, 'SFaqWN3EYQvRHIfsPm0f7UMLiKBEw2ugin8MYV5ovZ4bdSoUadt3lTzPwpOXtTk1QjXgG6l4kNF', 'dsdssd', '2022-08-13 14:54:45', 1, 1, 15),
(39, 'MlutCu8SGTa1HqEBsOZvXwhYg7Gj6mj2lfpMzVbL4s3QmdUhcknYg19AV0K4vofiQ5D2nwtWNJ8', 'ikkjgghf', '2022-08-13 14:57:19', 1, 1, 15),
(40, 'r1Bs2oil89yWmdCw50FPMMdvRHqosit3gjcS2VYPONzlpx07qhSXOcQJpuE1FGwLr8GEk34U97v', 'edde', '2022-08-13 14:58:29', 1, 1, 15),
(41, 'AmaWJfIDF4qMzY9QMRpEP6bghypPevwkERxOoVWd2U3Svsy5LrZjw9t6gH0xcKHrtu2ITmNCUK5', 'fsfdd', '2022-08-13 14:59:55', 1, 1, 15),
(42, '2K7mNAj49pe6yqYGPriwGpBQsvWEAkJfq3HtgMFtIVZSWxgYmlc0r1R2UXdkOwj5UnfnLKe8RFh', 'Josefino', '2022-08-13 15:06:19', 1, 1, 15),
(43, '4PBKX6VlwCQHAvIi13YOSe709G5FJusIVojtkW3GRf8ojHU0hbOvxnp5fQyNTaEbZNc7UePCMlD', 'gfgfd', '2022-08-13 15:07:54', 2, 0, 15),
(44, 'kdqwxh3pH72MBgpPYAmVWM9ZUJKlrECiHWBjo6w12D9m0tRjqFxUSs78GEauN8nbrYhCLgyc0XN', 'dfsdf', '2022-08-13 15:18:30', 0, 0, 15),
(45, 'kdqwxh3pH72MBgpPYAmVWM9ZUJKlrECiHWBjo6w12D9m0tRjqFxUSs78GEauN8nbrYhCLgyc0XN', 'dfsdfjh', '2022-08-13 15:18:31', 0, 0, 15),
(46, '9AZUIGeKFHw86LFJ1CJyRBpnb3d2p5uklD8De6RfrT7YhjSEXjcgayB4Vs50NQQzdPx2qU9whrL', 'sdds', '2022-08-13 15:25:04', 0, 0, 15),
(47, 'Z2pFtGLflzJqYL3D5d1RmVr0wIecZHlMFEyP9E6vs8KYPi9viWugxaHmgCXNAGnOahCVcD7kTjU', 'tertr', '2022-08-14 21:15:06', 2, 0, 15),
(48, 'YThSAHUxW1BfLG4P38RVc9CpniN2aEq2KjJMPryn6KF1FzUkQry0fwupbSt3AgolCodsvt7kqzW', 'dgg', '2022-08-14 21:26:23', 0, 2, 15),
(49, 'jNYRxRwF191MjYuvcNPGhdobmqZIKXTz7rQO5uUq0fEOk4foHhSxLnC06yy38ismLtzZMeeCiTD', 'Mario', '2022-08-15 14:37:49', 0, 0, 1),
(50, '7Nft3y6iGTaBzxY1CFj0dPWAekX2svIiXERw90ts8Sohq42M5D37HvflK8nkFuQ4EGIOAUearxg', 'Pedro', '2022-08-16 14:39:56', 1, 1, 15),
(51, 'bDKT7xhVWQI3Medq0Vy5FcrPuHnrfla8vO0MczuXFySstpJEZogd5ZPS1xHOEeLjkzqk9iWb2m9', 'Jose Maria', '2022-08-16 14:43:59', 2, 0, 15),
(52, '6dY2kjXtdRzZfqhcP8pBEOvxer287gF4IGLCnKlDJxrisVwVa4YuH30gayQo3AAe5PMpFXvCWLj', 'xt0E4RngHmpPN97dvbeaTGMs', '2022-08-17 16:07:00', 1, 1, 15),
(53, '6dY2pP1tulMlIEUo0gB94zA3ZWOCNPCgNe7RJpL1qTvjuF7Kfk9mGifSVZia6bSmnxhRxDsrAGD', 'vxcvc', '2022-08-17 16:09:36', 1, 1, 15),
(54, 'Kog03pYA4cief73ZL1jaQsx6QMg1HkGyqTBpuwuzFWHbd5ycMlVAev8LPtIDEhF5om9IXdnqtrN', 'sdds', '2022-08-17 16:54:39', 2, 0, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(55) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `autor` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasenia`, `autor`) VALUES
(1, 'admin', 'admin2022', 'Administrador'),
(2, 'admin2', 'admin2022', 'Colaborador'),
(4, 'dvsddfs', 'sdfdsdfdsfds', 'sdfdsds'),
(6, 'hghgfh', 'ghgh', 'hghg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  ADD PRIMARY KEY (`idCuestionario`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `usuario_cuestionario` (`autor`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `pregunta_cuestionario` (`idCuestionario`);

--
-- Indices de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD PRIMARY KEY (`idPuntaje`),
  ADD KEY `puntaje_cuestionario` (`idCuestionario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  MODIFY `idCuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  MODIFY `idPuntaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  ADD CONSTRAINT `usuario_cuestionario` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `pregunta_cuestionario` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionarios` (`idCuestionario`);

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `puntaje_cuestionario` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionarios` (`idCuestionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
