<?php

require_once('config/config.php');

class Model {

    protected $db;
    
    protected function crearConexion() {
        
        global $configuracion;
        
        $user = $configuracion['usuario'];
        $password = $configuracion['password'];
        $database = $configuracion['basenombre'];
        $host = $configuracion['host'];
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
            $this->deploy();
        } catch (\Throwable $th) {
            die($th);
            }
        return $pdo;
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $hashed_password = '$2y$10$fOmfNDoBopb2.lQpbRmFLOIY5wMR.zoWNl154xeCtZkue4s4es2sq';
            
            $sql = "
            
            -- phpMyAdmin SQL Dump
            -- version 5.2.1
            -- https://www.phpmyadmin.net/
            --
            -- Servidor: 127.0.0.1
            -- Tiempo de generación: 14-11-2024 a las 22:08:53
            -- Versión del servidor: 10.4.32-MariaDB
            -- Versión de PHP: 8.2.12

            SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
            START TRANSACTION;
            SET time_zone = '+00:00';


            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;

            --
            -- Base de datos: `db_mateviajes`
            --

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `usuarios`
            --

            CREATE TABLE `usuarios` (
            `id` int(11) NOT NULL,
            `usuario` varchar(20) NOT NULL,
            `password` varchar(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

            --
            -- Volcado de datos para la tabla `usuarios`
            --

            INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
            (1, 'webadmin', '$hashed_password');
            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `vehiculos`
            --

            CREATE TABLE `vehiculos` (
            `id` int(11) NOT NULL,
            `marca` varchar(50) NOT NULL,
            `modelo` varchar(50) NOT NULL,
            `patente` varchar(7) NOT NULL,
            `anio` int(4) NOT NULL,
            `asientos` int(2) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

            --
            -- Volcado de datos para la tabla `vehiculos`
            --

            INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `patente`, `anio`, `asientos`) VALUES
            (1, 'Ford', 'Transit', 'DUG111', 2001, 16),
            (2, 'Mercedes Benz', 'Sprinter', 'GTO243', 2008, 17),
            (3, 'Mercedes Benz', 'Sprinter', 'AA738AO', 2016, 20),
            (4, 'Fiat', 'Ducato', 'AB287AI', 2018, 20),
            (5, 'Mercedes Benz', 'Marcopolo', 'AC111AA', 2018, 37),
            (6, 'Scania', 'K280', 'AD876HS', 2021, 50),
            (7, 'Scania', 'k230', 'NDF234', 2015, 48),
            (13, 'Ford', 'Cargo', 'AA456SS', 2016, 50),
            (14, 'Mercedes-Benz', 'Sprinter 416', 'AC456DF', 2018, 20),
            (15, 'Volkswagen', 'Crafter', 'AB123GH', 2017, 18),
            (16, 'Renault', 'Master', 'AA789KL', 2016, 16),
            (17, 'Ford', 'Transit', 'AC123MN', 2018, 17),
            (18, 'Iveco', 'Daily', 'AB456OP', 2017, 19),
            (19, 'Peugeot', 'Boxer', 'AC789QR', 2018, 22),
            (20, 'Citroën', 'Jumper', 'AA123ST', 2016, 20),
            (21, 'Toyota', 'Hiace', 'AB456UV', 2017, 16),
            (22, 'Hyundai', 'H350', 'AA789WX', 2016, 18),
            (23, 'Nissan', 'NV350 Urvan', 'AB123YZ', 2017, 19),
            (24, 'Mercedes-Benz', 'Vario', 'AA456AA', 2016, 35),
            (25, 'Volkswagen', 'Transporter', 'AC789BB', 2018, 16),
            (26, 'Renault', 'Trafic', 'AB123CC', 2017, 18),
            (27, 'Ford', 'Econoline', 'AA456DD', 2016, 40),
            (28, 'Chevrolet', 'Express', 'AB789EE', 2017, 32),
            (29, 'Fiat', 'Ducato', 'AC123FF', 2018, 17),
            (30, 'Mercedes-Benz', 'Sprinter 519', 'AB456GG', 2017, 45),
            (31, 'Volkswagen', 'LT 35', 'AA789HH', 2016, 18),
            (32, 'Peugeot', 'Traveller', 'AB123II', 2017, 19),
            (33, 'Toyota', 'Coaster', 'AC456JJ', 2018, 30);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `viajes`
            --

            CREATE TABLE `viajes` (
            `id` int(11) NOT NULL,
            `destino` varchar(50) NOT NULL,
            `fecha` date NOT NULL,
            `horario` time NOT NULL,
            `pasajeros` int(2) NOT NULL,
            `fk_vehiculo` int(11) NOT NULL,
            `descripcion` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

            --
            -- Volcado de datos para la tabla `viajes`
            --

            INSERT INTO `viajes` (`id`, `destino`, `fecha`, `horario`, `pasajeros`, `fk_vehiculo`, `descripcion`) VALUES
            (3, 'Tigre', '2024-11-30', '07:00:00', 34, 5, 'Disfrutá de un día inolvidable en Tigre. Te llevamos a recorrer el Delta en una relajante navegación, con vistas increíbles y paradas en islas emblemáticas. Además, incluimos almuerzo y tiempo libre para explorar el famoso Puerto de Frutos. ¡Vení a vivir una experiencia única en Tigre, ideal para desconectar en un solo día!'),
            (4, 'Mar del Plata', '2025-01-11', '07:00:00', 48, 6, 'Pasá un día espectacular en Mar del Plata, disfrutando de sus playas, gastronomía y ambiente costero. Te ofrecemos un viaje con traslados cómodos, tiempo libre para recorrer el centro, el puerto y los principales puntos turísticos. Relajate bajo el sol o descubrí la magia de la ciudad junto al mar. ¡No te pierdas esta escapada ideal para desconectar y disfrutar al máximo en un solo día!'),
            (12, 'Glaciar Perito Moreno', '2024-11-30', '12:30:00', 18, 3, 'Explorá la majestuosidad del Glaciar Perito Moreno y sus alrededores en un viaje inolvidable de 8 días. Te ofrecemos un recorrido completo con visitas a los paisajes más impresionantes de la Patagonia, incluyendo el Parque Nacional Los Glaciares, el Lago Argentino y navegaciones por los canales. Disfrutá de la comodidad del alojamiento y las excursiones guiadas que te conectarán con la naturaleza en su máxima expresión. ¡Viví una aventura única en uno de los destinos más espectaculares del mundo!'),
            (13, 'Mar del Plata', '2025-01-17', '07:30:00', 50, 13, 'Disfrutá de una escapada de 3 días a Mar del Plata, la ciudad balnearia más famosa del país. Relajate en sus playas, disfrutá de su vibrante vida nocturna y recorré sus puntos turísticos como el Puerto, el Torreón y la Rambla. Incluimos alojamiento con desayuno y tiempo libre para que vivas la ciudad a tu ritmo. ¡No te pierdas esta oportunidad de desconectar y disfrutar de la costa en su máxima expresión!'),
            (14, 'Cataratas de Iguazú', '2025-07-07', '10:00:00', 20, 3, 'Descubrí la maravilla natural de las Cataratas del Iguazú en un viaje de 7 días lleno de aventura y paisajes impactantes. Te ofrecemos un paquete completo con alojamiento, traslados y visitas guiadas a ambos lados del Parque Nacional, argentino y brasileño. Además, disfrutá de excursiones a la Garganta del Diablo, paseos en lancha y caminatas por la selva. ¡Sumergite en la naturaleza y viví una experiencia inolvidable en las Cataratas!'),
            (15, 'La Plata', '2024-11-18', '05:30:00', 37, 5, 'Descubrí La Plata en un increíble viaje de 1 día, explorando sus principales atractivos históricos y culturales. Visitá la majestuosa Catedral, el fascinante Museo de Ciencias Naturales y el imponente Paseo del Bosque. Con traslados cómodos y tiempo libre para disfrutar de la ciudad, esta escapada es ideal para sumergirte en la arquitectura y cultura de la capital bonaerense. ¡No te lo pierdas y reservá tu lugar hoy!'),
            (16, 'Mendoza', '2025-05-15', '06:00:00', 50, 6, 'Descubrí Mendoza en un viaje de 7 días lleno de paisajes, vino y aventura. Visitá sus famosas bodegas con degustaciones exclusivas, recorriendo los viñedos que hacen de esta región un ícono mundial. Además, explorá la imponente Cordillera de los Andes, con excursiones a sitios como el Aconcagua y el Cañón del Atuel. ¡Sumate a esta experiencia única y disfrutá lo mejor de Mendoza con todo incluido!'),
            (17, 'El Chaltén', '2025-03-22', '13:00:00', 20, 4, 'Recibí el otoño en El Chaltén con un viaje de 5 días, rodeado de paisajes patagónicos que se visten de colores cálidos. Caminá entre montañas, glaciares y lagunas mientras disfrutás del cambio de estación en un entorno mágico. El paquete incluye alojamiento, excursiones guiadas y tiempo libre para conectar con la naturaleza. ¡No te pierdas esta oportunidad de vivir el otoño en la capital del trekking argentino!'),
            (18, 'El Chaltén', '2025-01-20', '06:30:00', 20, 15, 'Disfrutá del verano en El Chaltén, explorando paisajes de montaña y senderos únicos. Este viaje de 4 días incluye traslados y alojamiento en la capital nacional del trekking. ¡Vení a descubrir la Patagonia!'),
            (19, 'Córdoba', '2025-02-10', '08:00:00', 45, 16, 'Explorá las sierras de Córdoba en un viaje de 5 días. Caminá por sus montañas, disfrutá de la gastronomía local y visitá Alta Gracia y Villa Carlos Paz. ¡Viví una aventura única en el corazón del país!'),
            (20, 'Sierra de la Ventana', '2025-03-05', '07:15:00', 22, 17, 'Descubrí Sierra de la Ventana en un viaje de 3 días. Caminá entre sus cerros, recorré ríos y cascadas. Incluye traslados, alojamiento y excursiones guiadas. ¡No te pierdas este destino natural!'),
            (21, 'Tigre', '2025-04-01', '09:00:00', 32, 18, 'Disfrutá de una escapada a Tigre con un paseo en lancha por el Delta. Explorá las islas y el Puerto de Frutos en un viaje de un día. Ideal para desconectar en la naturaleza cerca de la ciudad.'),
            (22, 'Mendoza', '2025-04-15', '06:00:00', 48, 19, 'Sumate a un viaje de 5 días en Mendoza, recorriendo sus bodegas y viñedos, con vistas a la Cordillera de los Andes. Incluye traslados y degustaciones. ¡Viví el encanto del vino mendocino!'),
            (23, 'Rosario', '2025-05-10', '08:30:00', 34, 20, 'Pasá un día cultural en Rosario. Visitá el Monumento a la Bandera, la costanera y el centro histórico. Ideal para conocer esta ciudad a orillas del río Paraná.'),
            (24, 'Tilcara', '2025-05-25', '07:00:00', 30, 21, 'Explorá Tilcara y sus paisajes coloridos en un viaje de 4 días. Visitá la Quebrada de Humahuaca y la Pucará de Tilcara. Incluye traslados y excursiones guiadas. ¡Conectá con la cultura del norte!'),
            (25, 'La Plata', '2025-06-01', '05:30:00', 16, 22, 'Conocé La Plata en una escapada cultural. Visitá la Catedral, el Museo de Ciencias Naturales y el Paseo del Bosque. Ideal para un día lleno de historia y arquitectura.'),
            (26, 'Glaciar Perito Moreno', '2025-06-15', '09:00:00', 40, 23, 'Descubrí el Glaciar Perito Moreno en un viaje de 7 días. Explorá el Parque Nacional Los Glaciares y disfrutá de sus paisajes imponentes. ¡Una experiencia única en la Patagonia!'),
            (27, 'Mar del Plata', '2025-07-01', '07:30:00', 50, 24, 'Viví Mar del Plata en un viaje de 3 días. Disfrutá de sus playas, vida nocturna y gastronomía. Incluye alojamiento y tiempo libre para recorrer la ciudad balnearia.'),
            (28, 'Tandil', '2025-01-05', '06:00:00', 18, 25, 'Visitá Tandil y sus sierras en un viaje de 2 días. Explorá el Parque Independencia, la Piedra Movediza y disfrutá de su gastronomía local. ¡Descubrí la naturaleza de la provincia!'),
            (29, 'Puerto Madryn', '2025-02-18', '08:15:00', 24, 26, 'Disfrutá de Puerto Madryn y sus playas. Observá la fauna marina en el Golfo Nuevo y recorré la ciudad. Ideal para una escapada natural en la costa atlántica.'),
            (30, 'Ruinas de San Ignacio', '2025-03-30', '09:30:00', 18, 27, 'Explorá las Ruinas de San Ignacio en un viaje de 2 días. Descubrí la historia de las misiones jesuíticas en medio de la selva misionera. ¡Una experiencia cultural y educativa!'),
            (31, 'Esteros de Iberá', '2025-04-22', '07:00:00', 28, 28, 'Visitá los Esteros de Iberá en un viaje de 4 días. Observá su fauna y flora única en un entorno natural protegido. Ideal para los amantes de la naturaleza y la aventura.'),
            (32, 'El Bolsón', '2025-05-02', '06:45:00', 30, 29, 'Descubrí El Bolsón en este viaje de 5 días. Recorré sus montañas, visitá su feria artesanal y disfrutá de la vida en la naturaleza. ¡Un destino único en la Patagonia!'),
            (33, 'Teatro Colón', '2025-06-20', '08:00:00', 34, 30, 'Sumate a un tour cultural por el Teatro Colón y otros íconos porteños. Descubrí su historia y arquitectura en un recorrido guiado. Ideal para amantes del arte y la cultura.'),
            (34, 'Las Salinas', '2025-07-10', '07:30:00', 22, 31, 'Conocé Las Salinas Grandes en un viaje de un día. Explorá sus paisajes blancos y disfrutá de una experiencia única en el norte argentino. ¡Un paisaje como ningún otro!'),
            (35, 'La Boca', '2025-01-15', '10:00:00', 26, 32, 'Disfrutá de un día en La Boca, recorriendo Caminito, el estadio de Boca Juniors y sus pintorescas calles. Ideal para conocer la cultura porteña y su historia.'),
            (36, 'El Chaltén', '2025-02-28', '08:30:00', 20, 33, 'Viví El Chaltén en un viaje de 5 días. Explorá senderos, montañas y el glaciar Viedma en la capital nacional del trekking. ¡Conectá con la naturaleza en su máxima expresión!');

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`id`);

            --
            -- Indices de la tabla `vehiculos`
            --
            ALTER TABLE `vehiculos`
            ADD PRIMARY KEY (`id`);

            --
            -- Indices de la tabla `viajes`
            --
            ALTER TABLE `viajes`
            ADD PRIMARY KEY (`id`),
            ADD KEY `fk_vehiculos` (`fk_vehiculo`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

            --
            -- AUTO_INCREMENT de la tabla `vehiculos`
            --
            ALTER TABLE `vehiculos`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

            --
            -- AUTO_INCREMENT de la tabla `viajes`
            --
            ALTER TABLE `viajes`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `viajes`
            --
            ALTER TABLE `viajes`
            ADD CONSTRAINT `fk_vehiculos` FOREIGN KEY (`fk_vehiculo`) REFERENCES `vehiculos` (`id`);
            COMMIT;

            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                ";
        $this->db->query($sql);
        }
    }
}