-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 14 2016 г., 21:50
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kursach`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `url`, `parent`, `sort`) VALUES
(1, 'Мышки', 'myishki', 0, 0),
(2, 'Мониторы', 'monitoryi', 0, 0),
(3, 'Модемы', 'modemyi', 0, 0),
(4, 'wi-fi', 'wi-fi', 3, 0),
(5, 'aDSL', 'aDSL', 3, 0),
(6, 'Ноутбуки', 'noutbuki', 0, 0),
(7, 'HP', 'HP', 6, 0),
(8, 'Asus', 'Asus', 6, 0),
(9, 'Lenova', 'Lenova', 6, 0),
(10, 'Планшет', 'planshet', 0, 0),
(11, 'Prestigio', 'Prestigio', 10, 0),
(12, 'Asus', 'Asus', 10, 0),
(13, 'Lenova', 'Lenova', 10, 0),
(14, 'Системный блок', 'sistemnyiy_blok', 0, 0),
(15, 'Evolution', 'Evolution', 14, 0),
(16, 'SkySystems', 'SkySystems', 14, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `summ` varchar(255) NOT NULL,
  `order_content` text NOT NULL,
  `delivery` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `paid` varchar(1) NOT NULL DEFAULT 'N',
  `close` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `date`, `name`, `email`, `phone`, `adres`, `summ`, `order_content`, `delivery`, `payment`, `paid`, `close`) VALUES
(1, 1352095965, 'Павел Фадеев', 'pupkiv@vasya.ru', '81010101011', 'г. Москва\r\nкрасная площадь\r\nдом 1', '7113', 'a:2:{i:2;a:4:{s:4:\\"name\\";s:14:\\"Монитор\\";s:4:\\"code\\";s:4:\\"123D\\";s:5:\\"price\\";s:4:\\"6990\\";s:5:\\"count\\";i:1;}i:99;a:4:{s:4:\\"name\\";s:12:\\"мышка 2\\";s:4:\\"code\\";s:3:\\"sad\\";s:5:\\"price\\";s:3:\\"123\\";s:5:\\"count\\";i:1;}}', 'kurier', 'webmoney', 'Y', 'Y'),
(2, 1481652913, 'Петя', 'petrov@mail.ru', '5868236', 'г. Минск, ул Гая, д.49', '59820', 'a:2:{i:8;a:4:{s:4:\\"name\\";s:9:\\"HP 255 G5\\";s:4:\\"code\\";s:7:\\"W4M80EA\\";s:5:\\"price\\";s:5:\\"59697\\";s:5:\\"count\\";i:1;}i:7;a:4:{s:4:\\"name\\";s:12:\\"мышка 2\\";s:4:\\"code\\";s:3:\\"sad\\";s:5:\\"price\\";s:3:\\"123\\";s:5:\\"count\\";i:1;}}', 'pochta', 'platezh', 'N', 'N'),
(3, 1481728560, 'Петя Алкин', 'petrov@mail.ru', '5868236', 'г. Минск, ул Гая, д.49', '7648', 'a:2:{i:1;a:4:{s:4:\\"name\\";s:10:\\"Мышка\\";s:4:\\"code\\";s:4:\\"833S\\";s:5:\\"price\\";s:4:\\"1250\\";s:5:\\"count\\";i:5;}i:9;a:4:{s:4:\\"name\\";s:13:\\"HP 15-ac159ur\\";s:4:\\"code\\";s:7:\\"T1G14EA\\";s:5:\\"price\\";s:3:\\"699\\";s:5:\\"count\\";i:2;}}', 'pochta', 'platezh', 'N', 'N'),
(4, 1481737763, 'JEUIf', 'fadeev_pavel181@mail.ru', '8484984', 'г. Минск, ул Гая, д.49', '1250', 'a:1:{i:1;a:4:{s:4:\\"name\\";s:10:\\"Мышка\\";s:4:\\"code\\";s:4:\\"833S\\";s:5:\\"price\\";s:4:\\"1250\\";s:5:\\"count\\";i:1;}}', 'pochta', 'webmoney', 'N', 'N');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `html_content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `url`, `html_content`) VALUES
(1, '', 'index.html', '<p>Если Вам необходимы качественная электротехника по приемлимым ценам, а идти куда-то нет времени, то этот сайт то, что тебе необходимо. Регистрируйтесь и получайте возможность находить необходимые вещи, сделав всего пару кликов.<br /><br /> Данный сайт уже не первый год на рынке товаров. У нас имеется разнообразная техника на любой вкус и Вы обязательно что-нибудь найдете для себя и своих родных. Мы работаем только с качественной техникой, поэтому Вы можете не беспокоиться о том, что через месяц придется покупать новое. Тем более на каждый товар имеется своя гарантия.<br /><br /> Так что регистрируйтесь на сайте и ни в чем себе не отказывайте.<br /><br /></p>'),
(2, '', 'dostavka.html', '<p style="text-align: center;"><strong>Доставка</strong></p>\n<p style="text-align: left;">Наш магазин предоставляет <span style="text-decoration: underline;">несколько</span> видов доставки:</p>\n<ul>\n<li style="text-align: left;">Курьером</li>\n<li style="text-align: left;">Почтой</li>\n</ul>');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `price` float NOT NULL,
  `url` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `cat_id`, `name`, `desc`, `price`, `url`, `image_url`, `code`) VALUES
(1, 1, 'Мышка', 'Создатели умудрились объединить в беспроводной модели эргономичные размеры и достойный функционал за небольшие деньги. В первую очередь этот девайс понравится людям, которые постоянно пользуются компьютером вне дома. Достаточно только вставить наноприемник в USB-порт ноутбука, чтобы приступить к работе. Одного заряда пользователю хватит аж на восемь месяцев, если не забывать отключать питание при помощи специального переключателя. Технология HowKnow Super Plus позволяет мыши работать на любой поверхности – хоть на каменной плите, хоть на ворсистом подлокотнике. Мышь снабжена традиционными клавишами управления и колесом прокрутки, а конструкция отлично подходит под правую и левую руки.', 1250, 'myishka', '1.jpg', '833S'),
(2, 2, 'Монитор', 'Монитор не просто оснащен прекрасной жидкристаллической панелью с разрешением 1920 х 1080 точек (то есть, Full HD). Он еще и поддерживает технологию, суть которой состоит в том, что встроенный в монитор процессор анализирует изображение и меняет контрастность, насыщенность и резкость автоматически, чтобы изображение всегда было на верхней ступеньки пьедестала качества. У модели превосходные углы обзора, так что вы сможете наслаждаться любимыми фильмами и играми не только в одиночестве, но и пригласить друзей или семью - и все смогут расположиться, как им удобно. А матовое покрытие станет настоящим подарком для любителе подолгу работать во всяких "фотошопах".', 6990, 'monitor', '2.jpg', '123D'),
(3, 3, 'Модем', 'Модель соединяет в себе функционал ADSL-модема, позволяющего подключаться по протоколу ADSL2+ на скорости до 24 Мбит/сек, и возможности точки доступа WiFi. Таким образом, устройство работает на перспективу: даже если пока у вас только ADSL-канал, в будущем модель может пригодиться как роутер, тем более, что у него есть несколько LAN-портов. Все настройки можно произвести через онлайн-интерфейс.', 6000, 'modem', '6.jpg', '993G'),
(4, 5, 'Можем adsl 1', 'является универсальным решением с двумя интерфейсами:USB и Ethernet. AAM6010EV полностью отвечает стандартам ANSI T1.413 2, ITU-T G.992.1 (G.dmt), G.992.2 (G.lite) ADSL. AAM6020EV обладает большой функциональностью и высокой скоростью передачи данных с протоколами ADSL2, ADSL2+.', 1238, 'mojem_adsl_1', '00eb81e8150fefe6a1a3ca860abc2b2f.jpg', 'adsl 1'),
(5, 2, 'Монитор 2', 'Док-станция c интерфейсами 4x USB, HDMI, LAN, VGA, Audio встроена в подставку монитора. Через нее вы можете подключить все необходимые устройства. Сам же монитор соединяется с ноутбуком посредством USB 3.0 кабеля. Освободите свое рабочее пространство от беспорядка проводов и соединений.', 4000, 'monitor_2', '33095335.jpg', 'monic2'),
(6, 2, 'Монитор 3', 'Монитор не просто оснащен прекрасной жидкристаллической панелью с разрешением 1920 х 1080 точек (то есть, Full HD). Он еще и поддерживает технологию, суть которой состоит в том, что встроенный в монитор процессор анализирует изображение и меняет контрастность, насыщенность и резкость автоматически, чтобы изображение всегда было на верхней ступеньки пьедестала качества. У модели превосходные углы обзора, так что вы сможете наслаждаться любимыми фильмами и играми не только в одиночестве, но и пригласить друзей или семью - и все смогут расположиться, как им удобно. А матовое покрытие станет настоящим подарком для любителе подолгу работать во всяких "фотошопах".', 2000, 'monitor_3', '33095335.jpg', 'Монитор 3'),
(7, 1, 'мышка 2', 'беспроводная мышь (Bluetooth)\nдля ноутбука\nсветодиодная, 7 клавиш\nразрешение сенсора мыши 1600 dpi\nинтерфейс Bluetooth', 123, 'myishka_2', 'i.jpg', 'sad'),
(8, 7, 'HP 255 G5', '15.6" 1366 x 768 матовый, AMD E2 7110 1800 МГц, 4 ГБ, 500 Гб (HDD), AMD Radeon R2, DOS, цвет крышки темно-серый, цвет корпуса темно-серый', 59697, 'HP_255_G5', 'ad0d6557bd1c3c3076f10ae436b7d99c.png', 'W4M80EA'),
(9, 7, 'HP 15-ac159ur', 'Тип	универсальный\nДиагональ экрана	15.6 '''' (TN+Film)\nРазрешение экрана	1366x768 (HD)\nПроцессор	Intel Pentium \nМодель процессора	3825U\nТип жесткого диска (дисков)	HDD\nГрафический адаптер	AMD Radeon R5 M330, Intel HD Graphics', 699, 'HP_15-ac159ur', '15ac159urt1g14ea_hp_567293afef76d.jpg', 'T1G14EA'),
(10, 7, 'HP 255 G4', 'Тип	рабочий (офисный)\nДиагональ экрана	15.6 ''''\nРазрешение экрана	1366x768 (HD)\nПроцессор	AMD A6\nМодель процессора	6310\nТип жесткого диска (дисков)	HDD\nГрафический адаптер	AMD Radeon R4\nVGA (RGB)	есть', 587, 'noutbuk_HP_255_G4', '255g4n0y87es_hp_562e270f58b8f.jpg', 'N0Y87ES'),
(11, 8, 'Asus X540SA', 'Тип	универсальный\nДиагональ экрана	15.6 '''' (TN+Film)\nРазрешение экрана	1366x768 (HD)\nПроцессор	Intel Celeron\nМодель процессора	N3050\nТип жесткого диска (дисков)	HDD\nГрафический адаптер	Intel HD Graphics \nVGA (RGB)	есть', 585, 'Asus_X540SA', 'x540saxx002d_asus_56caec6bded54.jpg', 'XX002D'),
(12, 0, 'Lenovo B51-30', 'Тип	универсальный\nДиагональ экрана	15.6 ''''\nРазрешение экрана	1366x768 (HD)\nПроцессор	Intel Pentium \nМодель процессора	N3710\nТип жесткого диска (дисков)	HDD\nГрафический адаптер	NVIDIA GeForce 920M\nVGA (RGB)	есть', 834, 'Lenovo_B51-30', 'b513080lk01fhua_lenovo_5832b74f1254d.jpg', '80LK01FHUA'),
(13, 0, 'Prestigio Multipad 10.1"', 'Диагональ экрана	10.1"\nРазрешение	1024x600\nСоотношение сторон	16:9\nКоличество ядер	4\nТактовая частота	1200 МГц\nОперативная память	1 Гб\nИнтернет	WiFi', 179, 'Prestigio_Multipad_101"', 'multipad101pmt3111wic_prestigio_56bb1e090872a.jpg', 'PMT3111_WI_C'),
(14, 12, 'Asus ZenPad 10 Z300CNL', 'Диагональ экрана	10.1"\nРазрешение	1280x800\nКоличество ядер	4\nТактовая частота	1830 МГц\nОперативная память	2 Гб\nИнтернет	WiFi, 4G, 3G\nТип сенсорного экрана	емкостный', 483, 'Asus_ZenPad_10_Z300CNL', 'zenpad10z300cnl6a043a_asus_57fcc12200463.jpg', '6A043A'),
(15, 13, 'Lenovo Yoga Tab 3 X50M 16GB LTE', 'Диагональ экрана	10.1"\nРазрешение	1280x800\nКоличество ядер	4\nТактовая частота	1100 МГц\nОперативная память	2 Гб\nИнтернет	WiFi, 4G, 3G\nТип сенсорного экрана	емкостный', 582, 'Lenovo_Yoga_Tab_3_X50M_16GB_LTE', 'yogatab3x50m16gblteza0k0025ua_lenovo_574d7becdcd40.jpg', 'ZA0K0025UA'),
(16, 15, 'Evolution Office 18273', 'Тип устройства	системный блок\nПроцессор	AMD\nОбъем памяти	2 Гб\nЕмкость диска HDD	500 Гб\nКол-во ядер	2\nВидеокарта	AMD Radeon HD 7290\nМышь и клавиатура в комплекте	нет', 337, 'Evolution_Office_18273', 'office18273_evolution_576019f8e22dd.jpg', '18273'),
(17, 15, 'Evolution Office 18274', 'Тип устройства	системный блок\nПроцессор	AMD\nОбъем памяти	4 Гб\nЕмкость диска HDD	500 Гб\nКол-во ядер	2\nВидеокарта	AMD Radeon HD 7290\nМышь и клавиатура в комплекте	нет', 361, 'Evolution_Office_18274', 'office18274_evolution_57601abe1aec9.jpg', '18274'),
(18, 16, 'SkySystems A530450V050', 'Тип устройства	системный блок\nПроцессор	AMD A4\nОбъем памяти	4 Гб (CT51264BA160BJ)\nЕмкость диска HDD	500 Гб (Toshiba DT01ACA 500GB (DT01ACA050))\nКол-во ядер	2\nВидеокарта	AMD Radeon HD 7480D\nМышь и клавиатура в комплекте	нет', 429, 'SkySystems_A530450V050', 'a530450v050_sky_systems_57da9927ad668.jpg', 'A530450V050');

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'N',
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`id`, `option`, `value`, `active`, `name`, `desc`) VALUES
(1, 'sitename', 'kurs', 'Y', 'Название сайта', 'Название сайта отображается в title страниц.'),
(2, 'adminEmail', 'black-300@mail.ru', 'Y', 'E-mail администратора', 'На указанный email будут уходить все письма от посетителей сайта.\nМожно указать несколько адресов через запятую: admin@domen.ru,manager@domen.ru'),
(3, 'templateName', '.default', 'Y', 'Тема', 'Тема определяет внешний вид сайта'),
(4, 'countСatalogProduct', '9', 'Y', 'Количество выводимых продуктов на странице каталога', 'Количество выводимых продуктов на странице \r\n'),
(5, 'webmoneyPurse', 'R45687521', 'Y', 'Номер Webmoney кошелька', 'Номер Webmoney '),
(6, 'yandexPurse', '12548965', 'Y', 'Номер Yandex кошелька', 'Номер Yandex кошелька');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date_add` date NOT NULL,
  `blocked` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `role`, `name`, `sname`, `address`, `phone`, `date_add`, `blocked`) VALUES
(1, 'admin', 'mg5fZQPz21VQk', 1, 'admin', '', '', '', '0000-00-00', 0),
(2, 'black-300@mai.ru', 'mg4JLGVIEkL1E', 1, 'Павел', 'Фадеев', 'пацак3ц4а34', '548945', '2016-12-09', 0),
(3, 'petrov@mail.ru', 'k$i7y8.vBQx36', 2, 'Петя', 'Алкин', 'г. Минск, ул Гая, д.49', '5868236', '2016-12-13', 0),
(4, 'fadeev_pavel181@mail.ru', 'k$aijNbIdchhc', 2, 'JEUIf', 'wejfwei', 'г. минск', '8484984', '2016-12-14', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
