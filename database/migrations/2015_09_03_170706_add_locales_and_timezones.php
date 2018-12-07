<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocalesAndTimezones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
        });

        Schema::create('timezones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_iso');
            $table->string('code');
        });

        DB::statement("INSERT INTO locales (title,code) VALUES ('Arabic','ar')
,('Azerbaijan','az')
,('Bulgarian','bg')
,('Bengali','bn')
,('Catalan','ca')
,('Czech','cs')
,('Danish','da')
,('Dutch','nl')
,('English','en')
,('Esperanto','eo')
,('Finnish','fi')
,('French','fr')
,('Faroese','fo')
,('German','de')
,('Greek','el')
,('Hebrew','hr')
,('Hungarian','hu')
,('Indonesian','id')
,('Italian','it')
,('Japanese','ja')
,('Korean','ko')
,('Latvian','lv')
,('Lithuanian','lt')
,('Malay','ms')
,('Norwegian','no')
,('Polish','pl')
,('Portuguese','pt_BR')
,('Persian','fa')
,('Romanian','ro')
,('Russian','ru')
,('Serbian','sr')
,('Slovak','sk')
,('Slovenian','sl')
,('Spanish','es')
,('Swedish','sv')
,('Thai','th')
,('Turkish','tr')
,('Ukrainian','uk')
,('Uzbek','uz')
,('Vietnamese','vi')");

        DB::statement("INSERT INTO timezones VALUES (1,'AD','Europe/Andorra'),(2,'AE','Asia/Dubai'),(3,'AF','Asia/Kabul'),(4,'AG','America/Antigua'),(5,'AI','America/Anguilla'),(6,'AL','Europe/Tirane'),(7,'AM','Asia/Yerevan'),(8,'AO','Africa/Luanda'),(9,'AQ','Antarctica/McMurdo'),(10,'AQ','Antarctica/Rothera'),(11,'AQ','Antarctica/Palmer'),(12,'AQ','Antarctica/Mawson'),(13,'AQ','Antarctica/Davis'),(14,'AQ','Antarctica/Casey'),(15,'AQ','Antarctica/Vostok'),(16,'AQ','Antarctica/DumontDUrville'),(17,'AQ','Antarctica/Syowa'),(18,'AQ','Antarctica/Troll'),(19,'AR','America/Argentina/Buenos_Aires'),(20,'AR','America/Argentina/Cordoba'),(21,'AR','America/Argentina/Salta'),(22,'AR','America/Argentina/Jujuy'),(23,'AR','America/Argentina/Tucuman'),(24,'AR','America/Argentina/Catamarca'),(25,'AR','America/Argentina/La_Rioja'),(26,'AR','America/Argentina/San_Juan'),(27,'AR','America/Argentina/Mendoza'),(28,'AR','America/Argentina/San_Luis'),(29,'AR','America/Argentina/Rio_Gallegos'),(30,'AR','America/Argentina/Ushuaia'),(31,'AS','Pacific/Pago_Pago'),(32,'AT','Europe/Vienna'),(33,'AU','Australia/Lord_Howe'),(34,'AU','Antarctica/Macquarie'),(35,'AU','Australia/Hobart'),(36,'AU','Australia/Currie'),(37,'AU','Australia/Melbourne'),(38,'AU','Australia/Sydney'),(39,'AU','Australia/Broken_Hill'),(40,'AU','Australia/Brisbane'),(41,'AU','Australia/Lindeman'),(42,'AU','Australia/Adelaide'),(43,'AU','Australia/Darwin'),(44,'AU','Australia/Perth'),(45,'AU','Australia/Eucla'),(46,'AW','America/Aruba'),(47,'AX','Europe/Mariehamn'),(48,'AZ','Asia/Baku'),(49,'BA','Europe/Sarajevo'),(50,'BB','America/Barbados'),(51,'BD','Asia/Dhaka'),(52,'BE','Europe/Brussels'),(53,'BF','Africa/Ouagadougou'),(54,'BG','Europe/Sofia'),(55,'BH','Asia/Bahrain'),(56,'BI','Africa/Bujumbura'),(57,'BJ','Africa/Porto-Novo'),(58,'BL','America/St_Barthelemy'),(59,'BM','Atlantic/Bermuda'),(60,'BN','Asia/Brunei'),(61,'BO','America/La_Paz'),(62,'BQ','America/Kralendijk'),(63,'BR','America/Noronha'),(64,'BR','America/Belem'),(65,'BR','America/Fortaleza'),(66,'BR','America/Recife'),(67,'BR','America/Araguaina'),(68,'BR','America/Maceio'),(69,'BR','America/Bahia'),(70,'BR','America/Sao_Paulo'),(71,'BR','America/Campo_Grande'),(72,'BR','America/Cuiaba'),(73,'BR','America/Santarem'),(74,'BR','America/Porto_Velho'),(75,'BR','America/Boa_Vista'),(76,'BR','America/Manaus'),(77,'BR','America/Eirunepe'),(78,'BR','America/Rio_Branco'),(79,'BS','America/Nassau'),(80,'BT','Asia/Thimphu'),(81,'BW','Africa/Gaborone'),(82,'BY','Europe/Minsk'),(83,'BZ','America/Belize'),(84,'CA','America/St_Johns'),(85,'CA','America/Halifax'),(86,'CA','America/Glace_Bay'),(87,'CA','America/Moncton'),(88,'CA','America/Goose_Bay'),(89,'CA','America/Blanc-Sablon'),(90,'CA','America/Toronto'),(91,'CA','America/Nipigon'),(92,'CA','America/Thunder_Bay'),(93,'CA','America/Iqaluit'),(94,'CA','America/Pangnirtung'),(95,'CA','America/Resolute'),(96,'CA','America/Atikokan'),(97,'CA','America/Rankin_Inlet'),(98,'CA','America/Winnipeg'),(99,'CA','America/Rainy_River'),(100,'CA','America/Regina'),(101,'CA','America/Swift_Current'),(102,'CA','America/Edmonton'),(103,'CA','America/Cambridge_Bay'),(104,'CA','America/Yellowknife'),(105,'CA','America/Inuvik'),(106,'CA','America/Creston'),(107,'CA','America/Dawson_Creek'),(108,'CA','America/Vancouver'),(109,'CA','America/Whitehorse'),(110,'CA','America/Dawson'),(111,'CC','Indian/Cocos'),(112,'CD','Africa/Kinshasa'),(113,'CD','Africa/Lubumbashi'),(114,'CF','Africa/Bangui'),(115,'CG','Africa/Brazzaville'),(116,'CH','Europe/Zurich'),(117,'CI','Africa/Abidjan'),(118,'CK','Pacific/Rarotonga'),(119,'CL','America/Santiago'),(120,'CL','Pacific/Easter'),(121,'CM','Africa/Douala'),(122,'CN','Asia/Shanghai'),(123,'CN','Asia/Urumqi'),(124,'CO','America/Bogota'),(125,'CR','America/Costa_Rica'),(126,'CU','America/Havana'),(127,'CV','Atlantic/Cape_Verde'),(128,'CW','America/Curacao'),(129,'CX','Indian/Christmas'),(130,'CY','Asia/Nicosia'),(131,'CZ','Europe/Prague'),(132,'DE','Europe/Berlin'),(133,'DE','Europe/Busingen'),(134,'DJ','Africa/Djibouti'),(135,'DK','Europe/Copenhagen'),(136,'DM','America/Dominica'),(137,'DO','America/Santo_Domingo'),(138,'DZ','Africa/Algiers'),(139,'EC','America/Guayaquil'),(140,'EC','Pacific/Galapagos'),(141,'EE','Europe/Tallinn'),(142,'EG','Africa/Cairo'),(143,'EH','Africa/El_Aaiun'),(144,'ER','Africa/Asmara'),(145,'ES','Europe/Madrid'),(146,'ES','Africa/Ceuta'),(147,'ES','Atlantic/Canary'),(148,'ET','Africa/Addis_Ababa'),(149,'FI','Europe/Helsinki'),(150,'FJ','Pacific/Fiji'),(151,'FK','Atlantic/Stanley'),(152,'FM','Pacific/Chuuk'),(153,'FM','Pacific/Pohnpei'),(154,'FM','Pacific/Kosrae'),(155,'FO','Atlantic/Faroe'),(156,'FR','Europe/Paris'),(157,'GA','Africa/Libreville'),(158,'GB','Europe/London'),(159,'GD','America/Grenada'),(160,'GE','Asia/Tbilisi'),(161,'GF','America/Cayenne'),(162,'GG','Europe/Guernsey'),(163,'GH','Africa/Accra'),(164,'GI','Europe/Gibraltar'),(165,'GL','America/Godthab'),(166,'GL','America/Danmarkshavn'),(167,'GL','America/Scoresbysund'),(168,'GL','America/Thule'),(169,'GM','Africa/Banjul'),(170,'GN','Africa/Conakry'),(171,'GP','America/Guadeloupe'),(172,'GQ','Africa/Malabo'),(173,'GR','Europe/Athens'),(174,'GS','Atlantic/South_Georgia'),(175,'GT','America/Guatemala'),(176,'GU','Pacific/Guam'),(177,'GW','Africa/Bissau'),(178,'GY','America/Guyana'),(179,'HK','Asia/Hong_Kong'),(180,'HN','America/Tegucigalpa'),(181,'HR','Europe/Zagreb'),(182,'HT','America/Port-au-Prince'),(183,'HU','Europe/Budapest'),(184,'ID','Asia/Jakarta'),(185,'ID','Asia/Pontianak'),(186,'ID','Asia/Makassar'),(187,'ID','Asia/Jayapura'),(188,'IE','Europe/Dublin'),(189,'IL','Asia/Jerusalem'),(190,'IM','Europe/Isle_of_Man'),(191,'IN','Asia/Kolkata'),(192,'IO','Indian/Chagos'),(193,'IQ','Asia/Baghdad'),(194,'IR','Asia/Tehran'),(195,'IS','Atlantic/Reykjavik'),(196,'IT','Europe/Rome'),(197,'JE','Europe/Jersey'),(198,'JM','America/Jamaica'),(199,'JO','Asia/Amman'),(200,'JP','Asia/Tokyo'),(201,'KE','Africa/Nairobi'),(202,'KG','Asia/Bishkek'),(203,'KH','Asia/Phnom_Penh'),(204,'KI','Pacific/Tarawa'),(205,'KI','Pacific/Enderbury'),(206,'KI','Pacific/Kiritimati'),(207,'KM','Indian/Comoro'),(208,'KN','America/St_Kitts'),(209,'KP','Asia/Pyongyang'),(210,'KR','Asia/Seoul'),(211,'KW','Asia/Kuwait'),(212,'KY','America/Cayman'),(213,'KZ','Asia/Almaty'),(214,'KZ','Asia/Qyzylorda'),(215,'KZ','Asia/Aqtobe'),(216,'KZ','Asia/Aqtau'),(217,'KZ','Asia/Oral'),(218,'LA','Asia/Vientiane'),(219,'LB','Asia/Beirut'),(220,'LC','America/St_Lucia'),(221,'LI','Europe/Vaduz'),(222,'LK','Asia/Colombo'),(223,'LR','Africa/Monrovia'),(224,'LS','Africa/Maseru'),(225,'LT','Europe/Vilnius'),(226,'LU','Europe/Luxembourg'),(227,'LV','Europe/Riga'),(228,'LY','Africa/Tripoli'),(229,'MA','Africa/Casablanca'),(230,'MC','Europe/Monaco'),(231,'MD','Europe/Chisinau'),(232,'ME','Europe/Podgorica'),(233,'MF','America/Marigot'),(234,'MG','Indian/Antananarivo'),(235,'MH','Pacific/Majuro'),(236,'MH','Pacific/Kwajalein'),(237,'MK','Europe/Skopje'),(238,'ML','Africa/Bamako'),(239,'MM','Asia/Rangoon'),(240,'MN','Asia/Ulaanbaatar'),(241,'MN','Asia/Hovd'),(242,'MN','Asia/Choibalsan'),(243,'MO','Asia/Macau'),(244,'MP','Pacific/Saipan'),(245,'MQ','America/Martinique'),(246,'MR','Africa/Nouakchott'),(247,'MS','America/Montserrat'),(248,'MT','Europe/Malta'),(249,'MU','Indian/Mauritius'),(250,'MV','Indian/Maldives'),(251,'MW','Africa/Blantyre'),(252,'MX','America/Mexico_City'),(253,'MX','America/Cancun'),(254,'MX','America/Merida'),(255,'MX','America/Monterrey'),(256,'MX','America/Matamoros'),(257,'MX','America/Mazatlan'),(258,'MX','America/Chihuahua'),(259,'MX','America/Ojinaga'),(260,'MX','America/Hermosillo'),(261,'MX','America/Tijuana'),(262,'MX','America/Santa_Isabel'),(263,'MX','America/Bahia_Banderas'),(264,'MY','Asia/Kuala_Lumpur'),(265,'MY','Asia/Kuching'),(266,'MZ','Africa/Maputo'),(267,'NA','Africa/Windhoek'),(268,'NC','Pacific/Noumea'),(269,'NE','Africa/Niamey'),(270,'NF','Pacific/Norfolk'),(271,'NG','Africa/Lagos'),(272,'NI','America/Managua'),(273,'NL','Europe/Amsterdam'),(274,'NO','Europe/Oslo'),(275,'NP','Asia/Kathmandu'),(276,'NR','Pacific/Nauru'),(277,'NU','Pacific/Niue'),(278,'NZ','Pacific/Auckland'),(279,'NZ','Pacific/Chatham'),(280,'OM','Asia/Muscat'),(281,'PA','America/Panama'),(282,'PE','America/Lima'),(283,'PF','Pacific/Tahiti'),(284,'PF','Pacific/Marquesas'),(285,'PF','Pacific/Gambier'),(286,'PG','Pacific/Port_Moresby'),(287,'PG','Pacific/Bougainville'),(288,'PH','Asia/Manila'),(289,'PK','Asia/Karachi'),(290,'PL','Europe/Warsaw'),(291,'PM','America/Miquelon'),(292,'PN','Pacific/Pitcairn'),(293,'PR','America/Puerto_Rico'),(294,'PS','Asia/Gaza'),(295,'PS','Asia/Hebron'),(296,'PT','Europe/Lisbon'),(297,'PT','Atlantic/Madeira'),(298,'PT','Atlantic/Azores'),(299,'PW','Pacific/Palau'),(300,'PY','America/Asuncion'),(301,'QA','Asia/Qatar'),(302,'RE','Indian/Reunion'),(303,'RO','Europe/Bucharest'),(304,'RS','Europe/Belgrade'),(305,'RU','Europe/Kaliningrad'),(306,'RU','Europe/Moscow'),(307,'RU','Europe/Simferopol'),(308,'RU','Europe/Volgograd'),(309,'RU','Europe/Samara'),(310,'RU','Asia/Yekaterinburg'),(311,'RU','Asia/Omsk'),(312,'RU','Asia/Novosibirsk'),(313,'RU','Asia/Novokuznetsk'),(314,'RU','Asia/Krasnoyarsk'),(315,'RU','Asia/Irkutsk'),(316,'RU','Asia/Chita'),(317,'RU','Asia/Yakutsk'),(318,'RU','Asia/Khandyga'),(319,'RU','Asia/Vladivostok'),(320,'RU','Asia/Sakhalin'),(321,'RU','Asia/Ust-Nera'),(322,'RU','Asia/Magadan'),(323,'RU','Asia/Srednekolymsk'),(324,'RU','Asia/Kamchatka'),(325,'RU','Asia/Anadyr'),(326,'RW','Africa/Kigali'),(327,'SA','Asia/Riyadh'),(328,'SB','Pacific/Guadalcanal'),(329,'SC','Indian/Mahe'),(330,'SD','Africa/Khartoum'),(331,'SE','Europe/Stockholm'),(332,'SG','Asia/Singapore'),(333,'SH','Atlantic/St_Helena'),(334,'SI','Europe/Ljubljana'),(335,'SJ','Arctic/Longyearbyen'),(336,'SK','Europe/Bratislava'),(337,'SL','Africa/Freetown'),(338,'SM','Europe/San_Marino'),(339,'SN','Africa/Dakar'),(340,'SO','Africa/Mogadishu'),(341,'SR','America/Paramaribo'),(342,'SS','Africa/Juba'),(343,'ST','Africa/Sao_Tome'),(344,'SV','America/El_Salvador'),(345,'SX','America/Lower_Princes'),(346,'SY','Asia/Damascus'),(347,'SZ','Africa/Mbabane'),(348,'TC','America/Grand_Turk'),(349,'TD','Africa/Ndjamena'),(350,'TF','Indian/Kerguelen'),(351,'TG','Africa/Lome'),(352,'TH','Asia/Bangkok'),(353,'TJ','Asia/Dushanbe'),(354,'TK','Pacific/Fakaofo'),(355,'TL','Asia/Dili'),(356,'TM','Asia/Ashgabat'),(357,'TN','Africa/Tunis'),(358,'TO','Pacific/Tongatapu'),(359,'TR','Europe/Istanbul'),(360,'TT','America/Port_of_Spain'),(361,'TV','Pacific/Funafuti'),(362,'TW','Asia/Taipei'),(363,'TZ','Africa/Dar_es_Salaam'),(364,'UA','Europe/Kiev'),(365,'UA','Europe/Uzhgorod'),(366,'UA','Europe/Zaporozhye'),(367,'UG','Africa/Kampala'),(368,'UM','Pacific/Johnston'),(369,'UM','Pacific/Midway'),(370,'UM','Pacific/Wake'),(371,'US','America/New_York'),(372,'US','America/Detroit'),(373,'US','America/Kentucky/Louisville'),(374,'US','America/Kentucky/Monticello'),(375,'US','America/Indiana/Indianapolis'),(376,'US','America/Indiana/Vincennes'),(377,'US','America/Indiana/Winamac'),(378,'US','America/Indiana/Marengo'),(379,'US','America/Indiana/Petersburg'),(380,'US','America/Indiana/Vevay'),(381,'US','America/Chicago'),(382,'US','America/Indiana/Tell_City'),(383,'US','America/Indiana/Knox'),(384,'US','America/Menominee'),(385,'US','America/North_Dakota/Center'),(386,'US','America/North_Dakota/New_Salem'),(387,'US','America/North_Dakota/Beulah'),(388,'US','America/Denver'),(389,'US','America/Boise'),(390,'US','America/Phoenix'),(391,'US','America/Los_Angeles'),(392,'US','America/Metlakatla'),(393,'US','America/Anchorage'),(394,'US','America/Juneau'),(395,'US','America/Sitka'),(396,'US','America/Yakutat'),(397,'US','America/Nome'),(398,'US','America/Adak'),(399,'US','Pacific/Honolulu'),(400,'UY','America/Montevideo'),(401,'UZ','Asia/Samarkand'),(402,'UZ','Asia/Tashkent'),(403,'VA','Europe/Vatican'),(404,'VC','America/St_Vincent'),(405,'VE','America/Caracas'),(406,'VG','America/Tortola'),(407,'VI','America/St_Thomas'),(408,'VN','Asia/Ho_Chi_Minh'),(409,'VU','Pacific/Efate'),(410,'WF','Pacific/Wallis'),(411,'WS','Pacific/Apia'),(412,'YE','Asia/Aden'),(413,'YT','Indian/Mayotte'),(414,'ZA','Africa/Johannesburg'),(415,'ZM','Africa/Lusaka'),(416,'ZW','Africa/Harare');
");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locales');
        Schema::dropIfExists('timezones');
    }
}
