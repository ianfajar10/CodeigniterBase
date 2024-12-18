# Host: localhost  (Version 8.0.30)
# Date: 2024-12-18 20:33:22
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "migrations"
#

CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES (1,'2024-01-29-134553','CodeigniterBase\\Database\\Migrations\\UserTable','default','CodeigniterBase',1706535996,1),(2,'2024-01-29-153732','CodeigniterBase\\Database\\Migrations\\DummyTable','default','CodeigniterBase',1706542712,2),(3,'2024-01-29-155819','CodeigniterBase\\Database\\Migrations\\FileTable','default','CodeigniterBase',1706543913,3),(7,'2024-03-18-131551','CodeigniterBase\\Database\\Migrations\\OrderDetailTable','default','CodeigniterBase',1710767903,5),(10,'2024-03-18-130938','CodeigniterBase\\Database\\Migrations\\OrderTable','default','CodeigniterBase',1710849075,6);

#
# Structure for table "tbl_dummy"
#

CREATE TABLE `tbl_dummy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `column1` varchar(255) NOT NULL,
  `column2` varchar(255) NOT NULL,
  `column3` varchar(255) NOT NULL,
  `column4` varchar(255) NOT NULL,
  `column5` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

#
# Data for table "tbl_dummy"
#

INSERT INTO `tbl_dummy` VALUES (1,'Value1-1','Value2-1','Value3-1','Value4-1','Value5-1'),(2,'Value1-2','Value2-2','Value3-2','Value4-2','Value5-2'),(3,'Value1-3','Value2-3','Value3-3','Value4-3','Value5-3'),(4,'Value1-4','Value2-4','Value3-4','Value4-4','Value5-4'),(5,'Value1-5','Value2-5','Value3-5','Value4-5','Value5-5'),(6,'Value1-6','Value2-6','Value3-6','Value4-6','Value5-6'),(7,'Value1-7','Value2-7','Value3-7','Value4-7','Value5-7'),(8,'Value1-8','Value2-8','Value3-8','Value4-8','Value5-8'),(9,'Value1-9','Value2-9','Value3-9','Value4-9','Value5-9'),(10,'Value1-10','Value2-10','Value3-10','Value4-10','Value5-10'),(11,'Value1-11','Value2-11','Value3-11','Value4-11','Value5-11'),(12,'Value1-12','Value2-12','Value3-12','Value4-12','Value5-12'),(13,'Value1-13','Value2-13','Value3-13','Value4-13','Value5-13'),(14,'Value1-14','Value2-14','Value3-14','Value4-14','Value5-14'),(15,'Value1-15','Value2-15','Value3-15','Value4-15','Value5-15'),(16,'Value1-16','Value2-16','Value3-16','Value4-16','Value5-16'),(17,'Value1-17','Value2-17','Value3-17','Value4-17','Value5-17'),(18,'Value1-18','Value2-18','Value3-18','Value4-18','Value5-18'),(19,'Value1-19','Value2-19','Value3-19','Value4-19','Value5-19'),(20,'Value1-20','Value2-20','Value3-20','Value4-20','Value5-20'),(21,'Value1-21','Value2-21','Value3-21','Value4-21','Value5-21'),(22,'Value1-22','Value2-22','Value3-22','Value4-22','Value5-22'),(23,'Value1-23','Value2-23','Value3-23','Value4-23','Value5-23'),(24,'Value1-24','Value2-24','Value3-24','Value4-24','Value5-24'),(25,'Value1-25','Value2-25','Value3-25','Value4-25','Value5-25'),(26,'Value1-26','Value2-26','Value3-26','Value4-26','Value5-26'),(27,'Value1-27','Value2-27','Value3-27','Value4-27','Value5-27'),(28,'Value1-28','Value2-28','Value3-28','Value4-28','Value5-28'),(29,'Value1-29','Value2-29','Value3-29','Value4-29','Value5-29'),(30,'Value1-30','Value2-30','Value3-30','Value4-30','Value5-30'),(31,'Value1-31','Value2-31','Value3-31','Value4-31','Value5-31'),(32,'Value1-32','Value2-32','Value3-32','Value4-32','Value5-32'),(33,'Value1-33','Value2-33','Value3-33','Value4-33','Value5-33'),(34,'Value1-34','Value2-34','Value3-34','Value4-34','Value5-34'),(35,'Value1-35','Value2-35','Value3-35','Value4-35','Value5-35'),(36,'Value1-36','Value2-36','Value3-36','Value4-36','Value5-36'),(37,'Value1-37','Value2-37','Value3-37','Value4-37','Value5-37'),(38,'Value1-38','Value2-38','Value3-38','Value4-38','Value5-38'),(39,'Value1-39','Value2-39','Value3-39','Value4-39','Value5-39'),(40,'Value1-40','Value2-40','Value3-40','Value4-40','Value5-40'),(41,'Value1-41','Value2-41','Value3-41','Value4-41','Value5-41'),(42,'Value1-42','Value2-42','Value3-42','Value4-42','Value5-42'),(43,'Value1-43','Value2-43','Value3-43','Value4-43','Value5-43'),(44,'Value1-44','Value2-44','Value3-44','Value4-44','Value5-44'),(45,'Value1-45','Value2-45','Value3-45','Value4-45','Value5-45'),(46,'Value1-46','Value2-46','Value3-46','Value4-46','Value5-46'),(47,'Value1-47','Value2-47','Value3-47','Value4-47','Value5-47'),(48,'Value1-48','Value2-48','Value3-48','Value4-48','Value5-48'),(49,'Value1-49','Value2-49','Value3-49','Value4-49','Value5-49'),(50,'Value1-50','Value2-50','Value3-50','Value4-50','Value5-50');

#
# Structure for table "tbl_files"
#

CREATE TABLE `tbl_files` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int DEFAULT NULL,
  `description` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `additional` varchar(1) DEFAULT 'O' COMMENT 'Keterangan untuk Food (F), Drink (D), dan Other (O)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

#
# Data for table "tbl_files"
#

INSERT INTO `tbl_files` VALUES (1,'Teh Manis',8000,'Teh manis adalah minuman yang menggoda dengan kombinasi sempurna antara rasa teh yang menyegarkan dan kelembutan gula yang manis. Dengan warna coklat keemasan yang menawan, teh manis memancarkan aroma menggoda yang memikat indra. Setiap tegukan membawa kesegaran dari daun teh yang dipetik dengan teliti, seimbang dengan sensasi kelembutan dari gula yang larut sempurna. Rasanya yang lezat dan menyegarkan membuatnya menjadi pilihan yang tak terbantahkan dalam menemani berbagai suasana, dari pagi yang sepi hingga sore yang ramai. Teh manis bukan hanya sekadar minuman, tapi juga peneman setia dalam setiap momen santai dan hangat.','produk_1578041377.jpg','image/jpeg',NULL,NULL,'D'),(2,'Kopi Latte',17000,'Kopi latte adalah harmoni yang sempurna antara kekuatan kopi yang khas dan kelembutan susu yang melimpah. Dalam gelas yang elegan, lapisan kopi yang pekat menyatu dengan susu yang dihangatkan dengan sempurna, menciptakan kontras yang menakjubkan. Aroma kopi yang khas dengan sentuhan karamel dan cokelat melayang di udara, mengundang lidah untuk mengeksplorasi setiap tegukan dengan penuh antusiasme. Setiap gigitan memberikan sensasi yang memanjakan, dengan cita rasa kopi yang kuat namun dilunakkan oleh kelembutan dan kelembutan susu yang mengalir halus di lidah. Dengan setiap tegukan, kopi latte tidak hanya menyegarkan, tetapi juga memenuhi jiwa dengan kehangatan dan kenikmatan yang tak tertandingi.','Latte.jpg','image/jpeg',NULL,NULL,'D'),(3,'Kentang Goreng',13000,'Kentang goreng adalah kelezatan yang tak tertandingi, menggoda indera dengan aroma gurih yang menguar dari balutan keemasan mereka. Dengan lapisan kulit yang renyah di luar dan kelembutan yang lembut di dalam, setiap gigitan adalah perpaduan sempurna antara rasa gurih dan tekstur yang memikat. Kentang yang dipotong tipis atau dadu kemudian digoreng hingga kecokelatan dan cemerlang, menciptakan krispiness yang memikat di setiap gigitannya. Ketika Anda mencicipi kentang goreng, sensasi menggigit yang renyah diikuti oleh kelembutan yang melumer di mulut akan membuat lidah Anda bergoyang dalam kebahagiaan. Baunya yang menggoda hanya menambah keseruan dalam menikmati makanan yang tak lekang oleh waktu ini. Kentang goreng adalah sajian yang tidak pernah gagal untuk memanjakan selera, menjadi teman setia dalam setiap hidangan dan acara santai.','Kentang-Goreng.jpg','image/jpeg',NULL,NULL,'F'),(4,'Cappucino Cincau',0,'Cincau cappuccino adalah perpaduan yang menarik antara kelezatan tradisional cincau dengan aroma dan cita rasa klasik cappuccino. Dalam gelas yang menggoda, terlihat lapisan gelap cincau yang menggoda berpadu dengan busa krim lembut di atasnya, menciptakan kontras yang menggiurkan. Aroma kopi yang harum dan menggoda menyatu dengan kelembutan susu yang melimpah, memberikan kesan yang menggoda sejak pandangan pertama. Setiap tegukan memperkenalkan Anda pada harmoni unik antara rasa manis dan gurih, dengan sensasi kenyal cincau yang meluncur di lidah, diimbangi dengan kehangatan dan kompleksitas rasa kopi cappuccino. Nikmati sensasi menyegarkan dan menggoda dari cincau cappuccino, di mana setiap tegukan adalah perpaduan sempurna antara tradisi dan inovasi, menyenangkan indera dengan setiap kesempatan.','IMG-20221003-WA0014.jpg','image/jpeg',NULL,NULL,'D'),(5,'Sandwich Club',20000,'Deskripsi: Sandwich Club adalah sajian sandwich yang terdiri dari lapisan roti, irisan daging seperti daging ayam panggang atau ham, daun selada segar, irisan tomat, keju, dan bacon yang renyah. Disajikan dengan lapisan mayones atau saus untuk menambahkan rasa yang kaya dan memuaskan.','sandwich.png','image/png',NULL,NULL,'F'),(6,'Croissant',18000,'Deskripsi: Croissant adalah roti berlapis yang lembut dan renyah, berbentuk bulan sabit, biasanya terbuat dari adonan berlapis mentega. Rasanya yang gurih dan teksturnya yang berlapis membuatnya menjadi sajian yang sempurna untuk disantap di pagi hari atau sebagai camilan siang.','51583962-c274-4244-85ae-9233072345c8.jpg','image/jpeg',NULL,NULL,'F'),(7,'Espresso',15000,'Deskripsi: Sebuah minuman klasik yang kuat dan beraroma, espresso diseduh dengan mencampurkan air panas dengan bubuk kopi yang tajam dan kental. Rasanya yang pekat dan konsentrat memberikan dorongan energi yang kuat dan menyegarkan.','Espresso.png','image/png',NULL,NULL,'D'),(8,'Salad Sayuran Mexico',25000,'Deskripsi: Salad sayuran adalah hidangan yang menyegarkan dan sehat, terdiri dari campuran daun salad segar seperti selada, tomat ceri, mentimun, paprika, dan topping lainnya seperti potongan daging ayam panggang atau keju parmesan. Disajikan dengan berbagai pilihan dressing untuk menambahkan cita rasa yang beragam.','Resep_salad_sayur_ala_Mesiko.jpg','image/jpeg',NULL,NULL,'F'),(9,'Strawberry Smooties',18000,'Deskripsi: Smoothie buah-buahan segar adalah minuman yang menyegarkan dan sehat, terbuat dari campuran buah-buahan segar seperti stroberi, pisang, mangga, atau blueberry, yang dicampur dengan yogurt atau jus buah untuk konsistensi yang lembut dan rasa yang segar.','Resep-Membuat-Smoothies-Stroberi-Dengan-Susu-Skim-Praktis.jpg','image/jpeg',NULL,NULL,'D'),(10,'Muffin Blueberry',15000,'Deskripsi: Muffin blueberry adalah kue lembut yang dipenuhi dengan blueberry segar, memberikan cita rasa manis dan asam yang lezat. Teksturnya yang berongga dan permukaan yang berkerut menambahkan kesan yang menggiurkan. Cocok dinikmati sebagai camilan atau pendamping minuman.','Muffin Blub.png','image/png',NULL,NULL,'F'),(11,'Quiche Lorraine',22000,'Deskripsi: Quiche Lorraine adalah hidangan berbentuk pai yang terbuat dari adonan panggang yang diisi dengan campuran telur, krim, keju, dan potongan bacon atau ham yang gurih. Rasanya yang lembut dan kaya, serta teksturnya yang renyah di luar dan lembut di dalam membuatnya menjadi pilihan yang populer untuk sarapan atau santapan ringan.','k_Photo_Recipes_2019-07-how-to-easy-classic-quiche-lorraine_How-to-make-easy-classic-quiche-lorraine_071.jpeg','image/jpeg',NULL,NULL,'F'),(12,'Matcha Latte',13000,'Deskripsi: Teh hijau matcha latte adalah minuman yang menyegarkan dan menyehatkan, terbuat dari bubuk teh hijau matcha yang diaduk dengan susu yang dihangatkan. Warna hijau yang menawan dan rasa yang khas memberikan sensasi yang unik dan memuaskan bagi pecinta teh.','iced-matcha-latte.jpg','image/jpeg',NULL,NULL,'D'),(13,'Bruschetta Tomat dan Basil',0,'Deskripsi: Bruschetta tomat dan basil adalah hidangan pembuka yang segar dan lezat, terdiri dari potongan roti panggang yang dihiasi dengan campuran tomat segar, daun basil, bawang putih, minyak zaitun, dan balsamic glaze. Kombinasi rasa yang meriah dan tekstur yang renyah membuatnya menjadi pilihan yang sempurna untuk menikmati di kafe.','b083f45d-bf8b-4c82-b3df-896b5c0b0113 (1).png','image/png',NULL,NULL,NULL),(14,'Smoothie Bowl Acai',23000,'Deskripsi: Smoothie bowl acai adalah hidangan yang menyegarkan dan bergizi, terdiri dari campuran smoothie acai yang lezat yang disajikan dalam mangkuk dan dihiasi dengan potongan buah-buahan segar seperti pisang, stroberi, blueberry, serta granola, biji chia, atau kelapa parut sebagai topping untuk menambahkan tekstur dan rasa.','3759442-fe1536e46aa44461bade70383cdb2dd6.jpg','image/jpeg',NULL,NULL,'F'),(15,'Nasi Goreng',22000,'Deskripsi: Hidangan nasi yang digoreng dengan berbagai bahan tambahan seperti potongan daging, udang, telur, sayuran, dan rempah-rempah. Rasa yang gurih dan kaya, cocok disajikan sebagai hidangan utama atau sarapan.','Untitled.png','image/png',NULL,NULL,NULL),(16,'Bagel Cream Cheese',16000,'Bagel panggang yang dipotong menjadi dua dan diolesi dengan krim keju. Rasanya gurih dan lembut, dengan tekstur yang kenyal dari bagel yang dipanggang.','bacon-cream-cheese-stuffed-bagels.jpg','image/jpeg',NULL,NULL,'F');

#
# Structure for table "tbl_order_details"
#

CREATE TABLE `tbl_order_details` (
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

#
# Data for table "tbl_order_details"
#

INSERT INTO `tbl_order_details` VALUES (1,1,1,8000,'2024-03-23 03:12:18',NULL),(1,3,1,13000,'2024-03-23 03:12:18',NULL),(1,5,1,20000,'2024-03-23 03:12:18',NULL),(1,7,1,15000,'2024-03-23 03:12:18',NULL);

#
# Structure for table "tbl_orders"
#

CREATE TABLE `tbl_orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `table` int NOT NULL,
  `total_amount` int NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

#
# Data for table "tbl_orders"
#

INSERT INTO `tbl_orders` VALUES (1,'ianfajar10',10,56000,'pesanan_diproses','2024-03-23 03:12:18','2024-03-23 03:13:18');

#
# Structure for table "tbl_users"
#

CREATE TABLE `tbl_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

#
# Data for table "tbl_users"
#

INSERT INTO `tbl_users` VALUES (1,'Super Admin','admin','9dd4e461268c8034f5c8564e155c67a6','admin@mail.com','1','2024-03-23 03:08:50','2024-03-23 03:08:50'),(3,'Alfian Fajar Ramadhan','ianfajar10','243084ff6b772f6a59d184da822f79f6','ian.fajar10@gmail.com','2','2024-03-23 03:10:16','2024-03-23 03:10:16');
