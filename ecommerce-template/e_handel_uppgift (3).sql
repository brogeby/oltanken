-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 24 jun 2020 kl 21:57
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `e_handel_uppgift`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(10) NOT NULL,
  `billing_full_name` varchar(150) NOT NULL,
  `billing_street` varchar(150) NOT NULL,
  `billing_postal_code` int(10) NOT NULL,
  `billing_city` varchar(90) NOT NULL,
  `billing_country` varchar(90) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `product_title`, `created_at`) VALUES
(1, 1, 3, 1, 89, 'Pimp Dust', '2020-06-18 00:12:24'),
(2, 1, 2, 1, 80, 'Chimay Grande Reserve 2018', '2020-06-18 00:12:24'),
(3, 1, 8, 1, 149, 'Bourbon Barrel Quad', '2020-06-18 00:12:24'),
(4, 1, 12, 1, 39, 'House of Pale', '2020-06-18 00:12:24'),
(5, 2, 7, 3, 250, 'Westvleteren 12 XII', '2020-06-21 21:36:41'),
(6, 2, 5, 1, 39, 'IPA', '2020-06-21 21:36:41'),
(7, 2, 2, 1, 80, 'Chimay Grande Reserve 2018', '2020-06-21 21:36:41'),
(8, 2, 1, 1, 150, 'Bianca', '2020-06-21 21:36:41'),
(9, 2, 3, 1, 89, 'Pimp Dust', '2020-06-21 21:36:41'),
(10, 2, 4, 1, 49, 'The Hazy IPA', '2020-06-21 21:36:41'),
(11, 3, 2, 1, 80, 'Chimay Grande Reserve 2018', '2020-06-22 16:48:43'),
(12, 3, 3, 1, 89, 'Pimp Dust', '2020-06-22 16:48:43');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(9) NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `brewery` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `price` int(9) NOT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `brewery`, `type`, `description`, `price`, `img_url`) VALUES
(1, 'Bianca', 'Omnipollo', 'Fruktöl', 'Omnipollo Bianca Blueberry Blackberry Raspberry Strawberry Maple Pancake Lassi Gose.\r\n\r\n50cl\r\n\r\n7% ABV', 150, 'omnipollobianca.png'),
(2, 'Chimay Grande Reserve 2018', 'Abbaye de Chimay', 'Belgisk', 'Chimay Grande Reserve 2018 is a barrel-aged Chimay Blue, that has been slowly matured since March 2016 to give it a different profile from the classic blue thanks to a second fermentation in the keg.\r\n\r\nPouring deep brown with a fine, light tan head, the nose is a mix of black tea and jasmine, with a balanced woody quality. The palate is also woody, with fresh bread, roasted malt, coffee, and cognac traits. This well-rounded, characterful, powerful brew is best tasted between six months and one year after bottling.\r\n\r\n75cl \r\n\r\n9% ABV', 80, 'chimaygrandereserve2018.png'),
(3, 'Pimp Dust', 'Amundsen Bryggeri', 'Pastry Sour', 'Blueberry Muffin Pastry Sour\r\n440 ml\r\n6.5%', 89, 'pimpdust.jpg'),
(4, 'The Hazy IPA', 'Ska Brewing', 'Hazy IPA', 'This full-bodied, luscious IPA is rich with citrus and tropical notes obtained through a variety of proprietary hopping techniques.\r\nSOUL MATES\r\nThe Hazy IPA pairs wonderfully with fresh greens and garden vegetables, grilled fish finished with a squeeze of lemon.\r\n\r\nBecause it takes characters to brew beer with character. The Hazy IPA is brewed with Citra, Idaho 7, El Dorado, Galaxy and Bravo hops.\r\n\r\n335ml\r\n6.5%', 49, 'skabrewinghazyipa.jpg'),
(5, 'IPA', 'Oskar Blues Brewery', 'IPA', 'Trailblazers don’t torch a new passageway and then stop; they keep finding new ways in and new ways back out. That’s exactly what we did with our metamodern IPA conceived of hand-selected hops from down under. Malt barley and red wheat combine to create a clean malt backbone with a foolproof flavor and mouthfeel to support America’s sneak peek at Enigma, Vic Secret, Ella and Galaxy hops. The hops strum juicy and sweet aromas with headline notes of passion fruit, raspberries, pineapple and citrus. This intense, straight-up strain is Oskar Blues IPA (6.43% ABV). Smash a Blue Ferrigno… and it’ll smash back.\r\n\r\n33cl\r\n6.4%\r\n', 39, 'oskarbluesipa.jpg'),
(6, 'Galactic Cowboy Nitro', 'Left Hand Brewing', 'Imperial Stout', 'Blast off into the stratosphere and grab a fistful of stars! Smoother than Solo and darker than the Dark Side, Galactic Cowboy is brewed for cosmic adventure. With notes of bittersweet chocolate and black coffee, this high-octane stout is the fuel you need to wrangle the universe.\r\n\r\n50cl\r\n9.0%', 130, 'lefthandgalacticcowboynitro.png'),
(7, 'Westvleteren 12 XII', 'Abdij St. Sixtus Westvleteren', 'Quadrupel / Abt', 'Tidigare i våras inträffade något unikt som ölfantaster i Sverige dessförinnan endast hade kunnat fantisera om. En öl som av många klassas som världens bästa öl och ett mästerverk (se webbplatserna Beeradvocate och Ratebeer) såldes för första gången på Systembolaget. Men underbart är kort, bara några sekunder senare var det över.\r\n\r\nDen sjunde mars klockan tio fanns det 1 400 flaskor. Sju sekunder senare var alla bokade. Tilldelningen var fyra per kund till ett pris av 125 kronor flaskan.\r\n\r\nRariteten det handlar om är Westvleteren XII. Det är ett trappistöl, vilket innebär att det produceras på ett bryggeri inuti ett kloster av munkar inom trappistorden. Det finns åtta ölproducerande trappistkloster i världen, varav sex ligger i Belgien, ett i Frankrike och ett i Nederländerna.\r\n\r\nDessa kloster ska vara självförsörjande och bryggerierna är ett sätt att ge klostret en inkomst. Något överskott av verksamheten får det dock inte bli, ett sådant måste skänkas till välgörande ändamål.\r\n\r\nUnik export\r\nKlostret Sankt Sixtus av Westvleteren i Belgien producerar tre sorters öl; Westvleteren Blonde, Westvleteren VIII och Westvleteren XII. Att den sistnämnda nu nådde ända till Systembolaget beror på att klostret måste genomföra en större renovering och för att bekosta den har de fått tillstånd att öka och exportera en del av sin produktion.\r\n\r\nI normala fall går det endast att köpa dessa åtråvärda flaskor på plats i klostret i Flandern efter att först ha gjort en reservation per telefon under speciella telefontider. Utan reservation, inget köp.\r\n\r\nProduktionen är liten och intresset är stort så munkarna förordar själva på sin hemsida att man bör utrusta sig med tålamod och hoppas på tur om man är intresserad av att köpa deras öl. Den som lyckas en gång får vänta 60 dagar innan det går att lägga en ny beställning. Kontrollen är omfattande; telefon- och bilregistreringsnummer skrivs upp. Allt för att så många som möjligt ska få chansen. Det krävs även att man lovar att inte sälja ölen vidare.\r\n\r\nTrappistöl har ofta en hög alkoholhalt, Westvleteren XII håller drygt tio volymprocent. Den höga alkoholhalten beror på att ölen i princip jäser i tre omgångar. Först i öppna jäskar, därefter med jästrester i tankar och slutligen på flaskan då färsk jäst och socker tillsätts vid buteljeringen. Detta är alltså en öl som både klarar och sannolikt ökar i komplexitet vid lagring.\r\n\r\nMognar och håller i åratal\r\nMunkarna själva hävdar att ölen håller i åratal och att mognadsprocessen fortsätter. Lagra flaskorna stående i en temperatur mellan 12 och 16 grader C. Kyl inte vid servering, alla dofter och smaker framträder bättre när ölen är knappt rumstempererad.\r\n\r\nDen här gången hade jag tur i ”lotteriet” och fick möjlighet att köpa fyra flaskor. På baksidan av flaskan står det ”Ad aedificandam abbatiam adiuvi”. Det är latin och betyder ”jag hjälpte till att bygga klostret.” Jag blir nästan rörd på kuppen.\r\n\r\nWestvleteren XII\r\nÖlen är mörkt brun, som mörk sirap, med bärnstenstoner. Doft av sirap, malt, choklad och jäst. Rund och komplex smak av vörtbröd, choklad och torkad frukt. Lång eftersmak. Ingenting i smaken skvallrar om den höga alkoholhalten. Världens bästa öl? Mycket svårt att avgöra, men en stor dryckesupplevelse är det sannerligen. Drick till chokladtårta eller ost. Eller till en god bok.\r\n33cl\r\n10.2%', 250, 'westvleteren12.jpg'),
(8, 'Bourbon Barrel Quad', 'Boulevard Brewing Co', 'Barrel-Aged Ale', 'Based loosely on the Smokestack Series’ The Sixth Glass, this abbey-style quadrupel is separated into a number of oak bourbon barrels where it ages for varying lengths of time, some for up to three years. Cherries are added to make up for the “angel\'s share” of beer lost during barrel aging. Selected barrels are then blended for optimum flavor. The resulting beer retains only very subtle cherry characteristics, with toffee and vanilla notes coming to the fore.\r\n\r\n355ml\r\n11.2%', 149, 'bourbonbarrelquad.jpg'),
(9, 'Gravitational Moonbeam', 'Amundsen Bryggeri', 'New-England IPA', 'MALT\r\nPilsner, Flaked Oats, Wheat Malt, Carapils\r\nHOPS\r\nMagnum, Chinook, Simcoe, El Dorado, Mosaic BBC, Enigma\r\nYEAST\r\nEdnglish ale\r\nALLERGINS\r\nGluten, Lactose\r\n\r\nABV 7.2%', 45, 'amundsengravitationalmoonbeam.jpg'),
(10, 'Aon', 'Omnipollo', 'Imperial Stout', 'When I was 12 I dreamed of becoming a pastry chef. Call this a creative outlet. \r\n\r\nThick, rich and excessively decadent, this beer aims to bring back childhood memories. Brewed with aromas.\r\n\r\nHenok\r\n\r\nImperial Stout, 11 % by vol.\r\n\r\nBrewed at Brouwerij de Molen in the Netherlands.\r\n\r\nArtwork by Karl Grandin.', 49, 'omnipolloaon.jpg'),
(11, 'Lille lørdag', 'Haandbryggeriet', 'Session IPA', 'Onsdag eller \"lille lørdag\" var dagen då arbetarna kunde gå ut som kompensation för helgarbetet. Detta är Haandbryggeriets och humlens hyllning till alla vardagshjältar som jobbar natt och helg för att sammhället skall fortsätta rulla.', 33, 'lillelordag.jpg'),
(12, 'House of Pale', 'To Øl', 'New England Pale Ale', 'House Of Pale is one of the recipes we’ve taken from our beloved mad laboratory in Copenhagen, BRUS. A New England Pale ale with Equanot hops. It’s seen many changes and tweaks over this year, experimenting with hop doses and overall ‘crispiness’ - and now we’re pretty sure we’ve got exactly what we’ve been looking for.', 39, 'houseofpale.jpg'),
(13, 'Party Like It\'s 1475', 'Mikkeller', 'Pilsner', 'Mikkeller X Olaf Brewing Collab\r\n\r\nPilsner\r\n\r\nBack in the day beer was better than tap water. Together with @olafbrewing we\'re bringing back the old traditions with Party Like It\'s 1475 🛡️⚔️🛡️ Olaf Brewing is based in the Lakeland of Finland in the city of Savonlinna, which is home to the Castle of St. Olaf, the oldest medieval castle in Scandinavia 🏰\r\n\r\nThe construction of the castle started in 1475 - by Danish castle builders. A long day of building would probably be followed by a long night of drinking. So we brewed a crisp and clean German pilsner, that will make castle-builders and beer drinkers all around the world very happy!\r\n\r\nThis was the second Finnish-Danish collaboration in Savonlinna - the first one being the castle, now it\'s the beer.\r\nKippis! (That’s Finnish for cheers!) \r\n\r\nBrewed by Olaf Brewing in collaboration with Mikkeller \r\n\r\nBrewed by Mustan Virran Panimo Oy, Finland\r\n\r\n 4.9% 330 FI', 69, 'partylikeits1475.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `register_date`) VALUES
(2, 'Olof', 'Brogeby', 'olof.brogeby@cmeducations.se', '', '012-355-5303', 'Vendelsömalmsvägen 195', '13666', 'Vendelsö', 'Sverige', '2020-06-05 15:19:34'),
(3, 'Stoffe', 'Andersson', 'christoffer.andersson@cmeducations.se', 'hej123', '0768888888', 'Hornsgatan 3', '11823', 'Stockholm', 'Sverige', '2020-06-24 17:49:14'),
(4, 'Axel', 'Svärdh', 'axel.svardh@cmeducations.se', 'hej123', '0768919865', '', '', '', '', '2020-06-24 17:52:08');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
