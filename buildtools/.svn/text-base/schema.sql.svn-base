-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 04, 2008 at 02:14 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `trunk`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `address`
-- 

CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `adr_streetaddress` varchar(128) NOT NULL,
  `adr_city` varchar(64) NOT NULL,
  `adr_postalcode` varchar(16) default NULL,
  `s_id` int(11) default NULL,
  `c_id` int(11) default NULL,
  `adr_geocode` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Generic Address Table' AUTO_INCREMENT=514 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `auth`
-- 

CREATE TABLE `auth` (
  `aut_id` int(11) unsigned NOT NULL auto_increment,
  `aut_username` varchar(32) NOT NULL,
  `aut_password` varchar(32) NOT NULL,
  `aut_salt` varchar(32) NOT NULL,
  `aut_agp_id` int(11) NOT NULL,
  `aut_last_touched` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `aut_name` varchar(255) NOT NULL,
  `aut_email` varchar(255) NOT NULL,
  `aut_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`aut_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
INSERT INTO `auth` VALUES (1, 'norex', 'c68e8e578955211af6dd5e2b8dc722b0', 'norexcms4815c0ca531070.82883754', 1, '2008-07-21 10:56:56', 'Norex Development', 'chris@norex.ca', 1);
-- --------------------------------------------------------

-- 
-- Table structure for table `auth_groups`
-- 

CREATE TABLE `auth_groups` (
  `agp_id` int(11) unsigned NOT NULL auto_increment,
  `agp_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`agp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
INSERT INTO `auth_groups` VALUES (1, 'Administrator');

-- --------------------------------------------------------

-- 
-- Table structure for table `countries`
-- 

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL default '0',
  `codetwo` char(2) NOT NULL default '',
  `codethree` char(3) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  `currency` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `countries` VALUES (1, 'AF', 'AFG', 'Afghanistan', 'AFN');
INSERT INTO `countries` VALUES (2, 'AL', 'ALB', 'Albania', 'ALL');
INSERT INTO `countries` VALUES (3, 'DZ', 'DZA', 'Algeria', 'DZD');
INSERT INTO `countries` VALUES (4, 'AD', 'AND', 'Andorra', 'EUR');
INSERT INTO `countries` VALUES (5, 'AO', 'AGO', 'Angola', 'AOA');
INSERT INTO `countries` VALUES (6, 'AG', 'ATG', 'Antigua and Barbuda', 'XCD');
INSERT INTO `countries` VALUES (7, 'AR', 'ARG', 'Argentina', 'ARS');
INSERT INTO `countries` VALUES (8, 'AM', 'ARM', 'Armenia', 'AMD');
INSERT INTO `countries` VALUES (9, 'AU', 'AUS', 'Australia', 'AUD');
INSERT INTO `countries` VALUES (10, 'AT', 'AUT', 'Austria', 'EUR');
INSERT INTO `countries` VALUES (11, 'AZ', 'AZE', 'Azerbaijan', 'AZM');
INSERT INTO `countries` VALUES (12, 'BS', 'BHS', 'Bahamas, The', 'BSD');
INSERT INTO `countries` VALUES (13, 'BH', 'BHR', 'Bahrain', 'BHD');
INSERT INTO `countries` VALUES (14, 'BD', 'BGD', 'Bangladesh', 'BDT');
INSERT INTO `countries` VALUES (15, 'BB', 'BRB', 'Barbados', 'BBD');
INSERT INTO `countries` VALUES (16, 'BY', 'BLR', 'Belarus', 'BYR');
INSERT INTO `countries` VALUES (17, 'BE', 'BEL', 'Belgium', 'EUR');
INSERT INTO `countries` VALUES (18, 'BZ', 'BLZ', 'Belize', 'BZD');
INSERT INTO `countries` VALUES (19, 'BJ', 'BEN', 'Benin', 'XOF');
INSERT INTO `countries` VALUES (20, 'BT', 'BTN', 'Bhutan', 'BTN');
INSERT INTO `countries` VALUES (21, 'BO', 'BOL', 'Bolivia', 'BOB');
INSERT INTO `countries` VALUES (22, 'BA', 'BIH', 'Bosnia and Herzegovina', 'BAM');
INSERT INTO `countries` VALUES (23, 'BW', 'BWA', 'Botswana', 'BWP');
INSERT INTO `countries` VALUES (24, 'BR', 'BRA', 'Brazil', 'BRL');
INSERT INTO `countries` VALUES (25, 'BN', 'BRN', 'Brunei', 'BND');
INSERT INTO `countries` VALUES (26, 'BG', 'BGR', 'Bulgaria', 'BGN');
INSERT INTO `countries` VALUES (27, 'BF', 'BFA', 'Burkina Faso', 'XOF');
INSERT INTO `countries` VALUES (28, 'BI', 'BDI', 'Burundi', 'BIF');
INSERT INTO `countries` VALUES (29, 'KH', 'KHM', 'Cambodia', 'KHR');
INSERT INTO `countries` VALUES (30, 'CM', 'CMR', 'Cameroon', 'XAF');
INSERT INTO `countries` VALUES (31, 'CA', 'CAN', 'Canada', 'CAD');
INSERT INTO `countries` VALUES (32, 'CV', 'CPV', 'Cape Verde', 'CVE');
INSERT INTO `countries` VALUES (33, 'CF', 'CAF', 'Central African Republic', 'XAF');
INSERT INTO `countries` VALUES (34, 'TD', 'TCD', 'Chad', 'XAF');
INSERT INTO `countries` VALUES (35, 'CL', 'CHL', 'Chile', 'CLP');
INSERT INTO `countries` VALUES (36, 'CN', 'CHN', 'China, People''s Republic of', 'CNY');
INSERT INTO `countries` VALUES (37, 'CO', 'COL', 'Colombia', 'COP');
INSERT INTO `countries` VALUES (38, 'KM', 'COM', 'Comoros', 'KMF');
INSERT INTO `countries` VALUES (39, 'CD', 'COD', 'Congo, Democratic Republic of the (Congo / Kinshasa)', 'CDF');
INSERT INTO `countries` VALUES (40, 'CG', 'COG', 'Congo, Republic of the (Congo / Brazzaville)', 'XAF');
INSERT INTO `countries` VALUES (41, 'CR', 'CRI', 'Costa Rica', 'CRC');
INSERT INTO `countries` VALUES (42, 'CI', 'CIV', 'Cote d''Ivoire (Ivory Coast)', 'XOF');
INSERT INTO `countries` VALUES (43, 'HR', 'HRV', 'Croatia', 'HRK');
INSERT INTO `countries` VALUES (44, 'CU', 'CUB', 'Cuba', 'CUP');
INSERT INTO `countries` VALUES (45, 'CY', 'CYP', 'Cyprus', 'CYP');
INSERT INTO `countries` VALUES (46, 'CZ', 'CZE', 'Czech Republic', 'CZK');
INSERT INTO `countries` VALUES (47, 'DK', 'DNK', 'Denmark', 'DKK');
INSERT INTO `countries` VALUES (48, 'DJ', 'DJI', 'Djibouti', 'DJF');
INSERT INTO `countries` VALUES (49, 'DM', 'DMA', 'Dominica', 'XCD');
INSERT INTO `countries` VALUES (50, 'DO', 'DOM', 'Dominican Republic', 'DOP');
INSERT INTO `countries` VALUES (51, 'EC', 'ECU', 'Ecuador', 'USD');
INSERT INTO `countries` VALUES (52, 'EG', 'EGY', 'Egypt', 'EGP');
INSERT INTO `countries` VALUES (53, 'SV', 'SLV', 'El Salvador', 'USD');
INSERT INTO `countries` VALUES (54, 'GQ', 'GNQ', 'Equatorial Guinea', 'XAF');
INSERT INTO `countries` VALUES (55, 'ER', 'ERI', 'Eritrea', 'ERN');
INSERT INTO `countries` VALUES (56, 'EE', 'EST', 'Estonia', 'EEK');
INSERT INTO `countries` VALUES (57, 'ET', 'ETH', 'Ethiopia', 'ETB');
INSERT INTO `countries` VALUES (58, 'FJ', 'FJI', 'Fiji', 'FJD');
INSERT INTO `countries` VALUES (59, 'FI', 'FIN', 'Finland', 'EUR');
INSERT INTO `countries` VALUES (60, 'FR', 'FRA', 'France', 'EUR');
INSERT INTO `countries` VALUES (61, 'GA', 'GAB', 'Gabon', 'XAF');
INSERT INTO `countries` VALUES (62, 'GM', 'GMB', 'Gambia, The', 'GMD');
INSERT INTO `countries` VALUES (63, 'GE', 'GEO', 'Georgia', 'GEL');
INSERT INTO `countries` VALUES (64, 'DE', 'DEU', 'Germany', 'EUR');
INSERT INTO `countries` VALUES (65, 'GH', 'GHA', 'Ghana', 'GHC');
INSERT INTO `countries` VALUES (66, 'GR', 'GRC', 'Greece', 'EUR');
INSERT INTO `countries` VALUES (67, 'GD', 'GRD', 'Grenada', 'XCD');
INSERT INTO `countries` VALUES (68, 'GT', 'GTM', 'Guatemala', 'GTQ');
INSERT INTO `countries` VALUES (69, 'GN', 'GIN', 'Guinea', 'GNF');
INSERT INTO `countries` VALUES (70, 'GW', 'GNB', 'Guinea-Bissau', 'XOF');
INSERT INTO `countries` VALUES (71, 'GY', 'GUY', 'Guyana', 'GYD');
INSERT INTO `countries` VALUES (72, 'HT', 'HTI', 'Haiti', 'HTG');
INSERT INTO `countries` VALUES (73, 'HN', 'HND', 'Honduras', 'HNL');
INSERT INTO `countries` VALUES (74, 'HU', 'HUN', 'Hungary', 'HUF');
INSERT INTO `countries` VALUES (75, 'IS', 'ISL', 'Iceland', 'ISK');
INSERT INTO `countries` VALUES (76, 'IN', 'IND', 'India', 'INR');
INSERT INTO `countries` VALUES (77, 'ID', 'IDN', 'Indonesia', 'IDR');
INSERT INTO `countries` VALUES (78, 'IR', 'IRN', 'Iran', 'IRR');
INSERT INTO `countries` VALUES (79, 'IQ', 'IRQ', 'Iraq', 'IQD');
INSERT INTO `countries` VALUES (80, 'IE', 'IRL', 'Ireland', 'EUR');
INSERT INTO `countries` VALUES (81, 'IL', 'ISR', 'Israel', 'ILS');
INSERT INTO `countries` VALUES (82, 'IT', 'ITA', 'Italy', 'EUR');
INSERT INTO `countries` VALUES (83, 'JM', 'JAM', 'Jamaica', 'JMD');
INSERT INTO `countries` VALUES (84, 'JP', 'JPN', 'Japan', 'JPY');
INSERT INTO `countries` VALUES (85, 'JO', 'JOR', 'Jordan', 'JOD');
INSERT INTO `countries` VALUES (86, 'KZ', 'KAZ', 'Kazakhstan', 'KZT');
INSERT INTO `countries` VALUES (87, 'KE', 'KEN', 'Kenya', 'KES');
INSERT INTO `countries` VALUES (88, 'KI', 'KIR', 'Kiribati', 'AUD');
INSERT INTO `countries` VALUES (89, 'KP', 'PRK', 'Korea, Democratic People''s Republic of (North Korea)', 'KPW');
INSERT INTO `countries` VALUES (90, 'KR', 'KOR', 'Korea, Republic of  (South Korea)', 'KRW');
INSERT INTO `countries` VALUES (91, 'KW', 'KWT', 'Kuwait', 'KWD');
INSERT INTO `countries` VALUES (92, 'KG', 'KGZ', 'Kyrgyzstan', 'KGS');
INSERT INTO `countries` VALUES (93, 'LA', 'LAO', 'Laos', 'LAK');
INSERT INTO `countries` VALUES (94, 'LV', 'LVA', 'Latvia', 'LVL');
INSERT INTO `countries` VALUES (95, 'LB', 'LBN', 'Lebanon', 'LBP');
INSERT INTO `countries` VALUES (96, 'LS', 'LSO', 'Lesotho', 'LSL');
INSERT INTO `countries` VALUES (97, 'LR', 'LBR', 'Liberia', 'LRD');
INSERT INTO `countries` VALUES (98, 'LY', 'LBY', 'Libya', 'LYD');
INSERT INTO `countries` VALUES (99, 'LI', 'LIE', 'Liechtenstein', 'CHF');
INSERT INTO `countries` VALUES (100, 'LT', 'LTU', 'Lithuania', 'LTL');
INSERT INTO `countries` VALUES (101, 'LU', 'LUX', 'Luxembourg', 'EUR');
INSERT INTO `countries` VALUES (102, 'MK', 'MKD', 'Macedonia', 'MKD');
INSERT INTO `countries` VALUES (103, 'MG', 'MDG', 'Madagascar', 'MGA');
INSERT INTO `countries` VALUES (104, 'MW', 'MWI', 'Malawi', 'MWK');
INSERT INTO `countries` VALUES (105, 'MY', 'MYS', 'Malaysia', 'MYR');
INSERT INTO `countries` VALUES (106, 'MV', 'MDV', 'Maldives', 'MVR');
INSERT INTO `countries` VALUES (107, 'ML', 'MLI', 'Mali', 'XOF');
INSERT INTO `countries` VALUES (108, 'MT', 'MLT', 'Malta', 'MTL');
INSERT INTO `countries` VALUES (109, 'MH', 'MHL', 'Marshall Islands', 'USD');
INSERT INTO `countries` VALUES (110, 'MR', 'MRT', 'Mauritania', 'MRO');
INSERT INTO `countries` VALUES (111, 'MU', 'MUS', 'Mauritius', 'MUR');
INSERT INTO `countries` VALUES (112, 'MX', 'MEX', 'Mexico', 'MXN');
INSERT INTO `countries` VALUES (113, 'FM', 'FSM', 'Micronesia', 'USD');
INSERT INTO `countries` VALUES (114, 'MD', 'MDA', 'Moldova', 'MDL');
INSERT INTO `countries` VALUES (115, 'MC', 'MCO', 'Monaco', 'EUR');
INSERT INTO `countries` VALUES (116, 'MN', 'MNG', 'Mongolia', 'MNT');
INSERT INTO `countries` VALUES (117, 'CS', 'SCG', 'Montenegro', 'EUR');
INSERT INTO `countries` VALUES (118, 'MA', 'MAR', 'Morocco', 'MAD');
INSERT INTO `countries` VALUES (119, 'MZ', 'MOZ', 'Mozambique', 'MZM');
INSERT INTO `countries` VALUES (120, 'MM', 'MMR', 'Myanmar (Burma)', 'MMK');
INSERT INTO `countries` VALUES (121, 'NA', 'NAM', 'Namibia', 'NAD');
INSERT INTO `countries` VALUES (122, 'NR', 'NRU', 'Nauru', 'AUD');
INSERT INTO `countries` VALUES (123, 'NP', 'NPL', 'Nepal', 'NPR');
INSERT INTO `countries` VALUES (124, 'NL', 'NLD', 'Netherlands', 'EUR');
INSERT INTO `countries` VALUES (125, 'NZ', 'NZL', 'New Zealand', 'NZD');
INSERT INTO `countries` VALUES (126, 'NI', 'NIC', 'Nicaragua', 'NIO');
INSERT INTO `countries` VALUES (127, 'NE', 'NER', 'Niger', 'XOF');
INSERT INTO `countries` VALUES (128, 'NG', 'NGA', 'Nigeria', 'NGN');
INSERT INTO `countries` VALUES (129, 'NO', 'NOR', 'Norway', 'NOK');
INSERT INTO `countries` VALUES (130, 'OM', 'OMN', 'Oman', 'OMR');
INSERT INTO `countries` VALUES (131, 'PK', 'PAK', 'Pakistan', 'PKR');
INSERT INTO `countries` VALUES (132, 'PW', 'PLW', 'Palau', 'USD');
INSERT INTO `countries` VALUES (133, 'PA', 'PAN', 'Panama', 'PAB');
INSERT INTO `countries` VALUES (134, 'PG', 'PNG', 'Papua New Guinea', 'PGK');
INSERT INTO `countries` VALUES (135, 'PY', 'PRY', 'Paraguay', 'PYG');
INSERT INTO `countries` VALUES (136, 'PE', 'PER', 'Peru', 'PEN');
INSERT INTO `countries` VALUES (137, 'PH', 'PHL', 'Philippines', 'PHP');
INSERT INTO `countries` VALUES (138, 'PL', 'POL', 'Poland', 'PLN');
INSERT INTO `countries` VALUES (139, 'PT', 'PRT', 'Portugal', 'EUR');
INSERT INTO `countries` VALUES (140, 'QA', 'QAT', 'Qatar', 'QAR');
INSERT INTO `countries` VALUES (141, 'RO', 'ROU', 'Romania', 'RON');
INSERT INTO `countries` VALUES (142, 'RU', 'RUS', 'Russia', 'RUB');
INSERT INTO `countries` VALUES (143, 'RW', 'RWA', 'Rwanda', 'RWF');
INSERT INTO `countries` VALUES (144, 'KN', 'KNA', 'Saint Kitts and Nevis', 'XCD');
INSERT INTO `countries` VALUES (145, 'LC', 'LCA', 'Saint Lucia', 'XCD');
INSERT INTO `countries` VALUES (146, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'XCD');
INSERT INTO `countries` VALUES (147, 'WS', 'WSM', 'Samoa', 'WST');
INSERT INTO `countries` VALUES (148, 'SM', 'SMR', 'San Marino', 'EUR');
INSERT INTO `countries` VALUES (149, 'ST', 'STP', 'Sao Tome and Principe', 'STD');
INSERT INTO `countries` VALUES (150, 'SA', 'SAU', 'Saudi Arabia', 'SAR');
INSERT INTO `countries` VALUES (151, 'SN', 'SEN', 'Senegal', 'XOF');
INSERT INTO `countries` VALUES (153, 'SC', 'SYC', 'Seychelles', 'SCR');
INSERT INTO `countries` VALUES (154, 'SL', 'SLE', 'Sierra Leone', 'SLL');
INSERT INTO `countries` VALUES (155, 'SG', 'SGP', 'Singapore', 'SGD');
INSERT INTO `countries` VALUES (156, 'SK', 'SVK', 'Slovakia', 'SKK');
INSERT INTO `countries` VALUES (157, 'SI', 'SVN', 'Slovenia', 'SIT');
INSERT INTO `countries` VALUES (158, 'SB', 'SLB', 'Solomon Islands', 'SBD');
INSERT INTO `countries` VALUES (159, 'SO', 'SOM', 'Somalia', 'SOS');
INSERT INTO `countries` VALUES (160, 'ZA', 'ZAF', 'South Africa', 'ZAR');
INSERT INTO `countries` VALUES (161, 'ES', 'ESP', 'Spain', 'EUR');
INSERT INTO `countries` VALUES (162, 'LK', 'LKA', 'Sri Lanka', 'LKR');
INSERT INTO `countries` VALUES (163, 'SD', 'SDN', 'Sudan', 'SDD');
INSERT INTO `countries` VALUES (164, 'SR', 'SUR', 'Suriname', 'SRD');
INSERT INTO `countries` VALUES (165, 'SZ', 'SWZ', 'Swaziland', 'SZL');
INSERT INTO `countries` VALUES (166, 'SE', 'SWE', 'Sweden', 'SEK');
INSERT INTO `countries` VALUES (167, 'CH', 'CHE', 'Switzerland', 'CHF');
INSERT INTO `countries` VALUES (168, 'SY', 'SYR', 'Syria', 'SYP');
INSERT INTO `countries` VALUES (169, 'TJ', 'TJK', 'Tajikistan', 'TJS');
INSERT INTO `countries` VALUES (170, 'TZ', 'TZA', 'Tanzania', 'TZS');
INSERT INTO `countries` VALUES (171, 'TH', 'THA', 'Thailand', 'THB');
INSERT INTO `countries` VALUES (172, 'TL', 'TLS', 'Timor-Leste (East Timor)', 'USD');
INSERT INTO `countries` VALUES (173, 'TG', 'TGO', 'Togo', 'XOF');
INSERT INTO `countries` VALUES (174, 'TO', 'TON', 'Tonga', 'TOP');
INSERT INTO `countries` VALUES (175, 'TT', 'TTO', 'Trinidad and Tobago', 'TTD');
INSERT INTO `countries` VALUES (176, 'TN', 'TUN', 'Tunisia', 'TND');
INSERT INTO `countries` VALUES (177, 'TR', 'TUR', 'Turkey', 'TRY');
INSERT INTO `countries` VALUES (178, 'TM', 'TKM', 'Turkmenistan', 'TMM');
INSERT INTO `countries` VALUES (179, 'TV', 'TUV', 'Tuvalu', 'AUD');
INSERT INTO `countries` VALUES (180, 'UG', 'UGA', 'Uganda', 'UGX');
INSERT INTO `countries` VALUES (181, 'UA', 'UKR', 'Ukraine', 'UAH');
INSERT INTO `countries` VALUES (182, 'AE', 'ARE', 'United Arab Emirates', 'AED');
INSERT INTO `countries` VALUES (183, 'GB', 'GBR', 'United Kingdom', 'GBP');
INSERT INTO `countries` VALUES (184, 'US', 'USA', 'United States', 'USD');
INSERT INTO `countries` VALUES (185, 'UY', 'URY', 'Uruguay', 'UYU');
INSERT INTO `countries` VALUES (186, 'UZ', 'UZB', 'Uzbekistan', 'UZS');
INSERT INTO `countries` VALUES (187, 'VU', 'VUT', 'Vanuatu', 'VUV');
INSERT INTO `countries` VALUES (188, 'VA', 'VAT', 'Vatican City', 'EUR');
INSERT INTO `countries` VALUES (189, 'VE', 'VEN', 'Venezuela', 'VEB');
INSERT INTO `countries` VALUES (190, 'VN', 'VNM', 'Viet Nam', 'VND');
INSERT INTO `countries` VALUES (191, 'YE', 'YEM', 'Yemen', 'YER');
INSERT INTO `countries` VALUES (192, 'ZM', 'ZMB', 'Zambia', 'ZMK');
INSERT INTO `countries` VALUES (193, 'ZW', 'ZWE', 'Zimbabwe', 'ZWD');
INSERT INTO `countries` VALUES (195, 'TW', 'TWN', 'China, Republic of (Taiwan)', 'TWD');
INSERT INTO `countries` VALUES (202, 'CX', 'CXR', 'Christmas Island', 'AUD');
INSERT INTO `countries` VALUES (203, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'AUD');
INSERT INTO `countries` VALUES (205, 'HM', 'HMD', 'Heard Island and McDonald Islands', '');
INSERT INTO `countries` VALUES (206, 'NF', 'NFK', 'Norfolk Island', 'AUD');
INSERT INTO `countries` VALUES (207, 'NC', 'NCL', 'New Caledonia', 'XPF');
INSERT INTO `countries` VALUES (208, 'PF', 'PYF', 'French Polynesia', 'XPF');
INSERT INTO `countries` VALUES (209, 'YT', 'MYT', 'Mayotte', 'EUR');
INSERT INTO `countries` VALUES (210, 'PM', 'SPM', 'Saint Pierre and Miquelon', 'EUR');
INSERT INTO `countries` VALUES (211, 'WF', 'WLF', 'Wallis and Futuna', 'XPF');
INSERT INTO `countries` VALUES (212, 'TF', 'ATF', 'French Southern and Antarctic Lands', '');
INSERT INTO `countries` VALUES (214, 'BV', 'BVT', 'Bouvet Island', '');
INSERT INTO `countries` VALUES (215, 'CK', 'COK', 'Cook Islands', 'NZD');
INSERT INTO `countries` VALUES (216, 'NU', 'NIU', 'Niue', 'NZD');
INSERT INTO `countries` VALUES (217, 'TK', 'TKL', 'Tokelau', 'NZD');
INSERT INTO `countries` VALUES (218, 'GG', 'GGY', 'Guernsey', 'GGP');
INSERT INTO `countries` VALUES (219, 'IM', 'IMN', 'Isle of Man', 'IMP');
INSERT INTO `countries` VALUES (220, 'JE', 'JEY', 'Jersey', 'JEP');
INSERT INTO `countries` VALUES (221, 'AI', 'AIA', 'Anguilla', 'XCD');
INSERT INTO `countries` VALUES (222, 'BM', 'BMU', 'Bermuda', 'BMD');
INSERT INTO `countries` VALUES (223, 'IO', 'IOT', 'British Indian Ocean Territory', '');
INSERT INTO `countries` VALUES (224, 'VG', 'VGB', 'British Virgin Islands', 'USD');
INSERT INTO `countries` VALUES (225, 'KY', 'CYM', 'Cayman Islands', 'KYD');
INSERT INTO `countries` VALUES (226, 'FK', 'FLK', 'Falkland Islands (Islas Malvinas)', 'FKP');
INSERT INTO `countries` VALUES (227, 'GI', 'GIB', 'Gibraltar', 'GIP');
INSERT INTO `countries` VALUES (228, 'MS', 'MSR', 'Montserrat', 'XCD');
INSERT INTO `countries` VALUES (229, 'PN', 'PCN', 'Pitcairn Islands', 'NZD');
INSERT INTO `countries` VALUES (230, 'SH', 'SHN', 'Saint Helena', 'SHP');
INSERT INTO `countries` VALUES (231, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', '');
INSERT INTO `countries` VALUES (232, 'TC', 'TCA', 'Turks and Caicos Islands', 'USD');
INSERT INTO `countries` VALUES (233, 'MP', 'MNP', 'Northern Mariana Islands', 'USD');
INSERT INTO `countries` VALUES (234, 'PR', 'PRI', 'Puerto Rico', 'USD');
INSERT INTO `countries` VALUES (235, 'AS', 'ASM', 'American Samoa', 'USD');
INSERT INTO `countries` VALUES (236, 'UM', 'UMI', 'Baker Island', '');
INSERT INTO `countries` VALUES (237, 'GU', 'GUM', 'Guam', 'USD');
INSERT INTO `countries` VALUES (245, 'VI', 'VIR', 'U.S. Virgin Islands', 'USD');
INSERT INTO `countries` VALUES (247, 'HK', 'HKG', 'Hong Kong', 'HKD');
INSERT INTO `countries` VALUES (248, 'MO', 'MAC', 'Macau', 'MOP');
INSERT INTO `countries` VALUES (249, 'FO', 'FRO', 'Faroe Islands', 'DKK');
INSERT INTO `countries` VALUES (250, 'GL', 'GRL', 'Greenland', 'DKK');
INSERT INTO `countries` VALUES (251, 'GF', 'GUF', 'French Guiana', 'EUR');
INSERT INTO `countries` VALUES (252, 'GP', 'GLP', 'Guadeloupe', 'EUR');
INSERT INTO `countries` VALUES (253, 'MQ', 'MTQ', 'Martinique', 'EUR');
INSERT INTO `countries` VALUES (254, 'RE', 'REU', 'Reunion', 'EUR');
INSERT INTO `countries` VALUES (255, 'AX', 'ALA', 'Aland', 'EUR');
INSERT INTO `countries` VALUES (256, 'AW', 'ABW', 'Aruba', 'AWG');
INSERT INTO `countries` VALUES (257, 'AN', 'ANT', 'Netherlands Antilles', 'ANG');
INSERT INTO `countries` VALUES (258, 'SJ', 'SJM', 'Svalbard', 'NOK');
INSERT INTO `countries` VALUES (259, 'AC', 'ASC', 'Ascension', 'SHP');
INSERT INTO `countries` VALUES (260, 'TA', 'TAA', 'Tristan da Cunha', 'SHP');
INSERT INTO `countries` VALUES (261, 'AQ', 'ATA', 'Antarctica', '');
INSERT INTO `countries` VALUES (263, 'PS', 'PSE', 'Palestinian Territories (Gaza Strip and West Bank)', 'ILS');
INSERT INTO `countries` VALUES (264, 'EH', 'ESH', 'Western Sahara', 'MAD');

-- --------------------------------------------------------

-- 
-- Table structure for table `datastorage`
-- 

CREATE TABLE `datastorage` (
  `id` int(11) NOT NULL auto_increment,
  `data` longblob NOT NULL,
  `content_type` varchar(128) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `filesize` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `datastorage_search`
-- 

CREATE TABLE `datastorage_search` (
  `id` int(11) NOT NULL auto_increment,
  `file_id` int(11) NOT NULL,
  `tags` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `groups_permissions`
-- 

CREATE TABLE `groups_permissions` (
  `group_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  UNIQUE KEY `group_id_2` (`group_id`,`perm_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `help`
-- 

CREATE TABLE `help` (
  `helpid` varchar(32) NOT NULL,
  `title` tinytext,
  `body` text,
  PRIMARY KEY  (`helpid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `help` VALUES ('addmenuitem', 'Add Menu Item', '"Add Menu Item" will guide you through the process of adding links to your site''s menu structure');


-- --------------------------------------------------------

-- 
-- Table structure for table `locale`
-- 

CREATE TABLE `locale` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(16) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

INSERT INTO `locale` VALUES (1, 'en_CA', 'English (Canada)');
INSERT INTO `locale` VALUES (2, 'fr_CA', 'Fran&ccedil;ais (Canada)');
INSERT INTO `locale` VALUES (3, 'ja_JP', 'Japanese (&#x65e5;&#x672c;&#x8a9e;)');
INSERT INTO `locale` VALUES (4, 'ar_OM', 'Arabic (Oman)\r\n(&#x0627;&#x0644;&#x0639;&#x0631;&#x0628;&#x064a;&#x0629;)');
INSERT INTO `locale` VALUES (5, 'el_GR', 'Greek\r\n(&#x0395;&#x03bb;&#x03bb;&#x03b7;&#x03bd;&#x03b9;&#x03ba;&#x03ac;)');
INSERT INTO `locale` VALUES (6, 'ar_SY', 'Arabic (Syria)\r\n(&#x0627;&#x0644;&#x0639;&#x0631;&#x0628;&#x064a;&#x0629;)');
INSERT INTO `locale` VALUES (7, 'id_ID', 'Bahasa Indonesia');
INSERT INTO `locale` VALUES (8, 'bs_BA', 'Bosanski');
INSERT INTO `locale` VALUES (9, 'bg_BG', 'Bulgarian\r\n(&#x0411;&#x044a;&#x043b;&#x0433;&#x0430;&#x0440;&#x0441;&#x043a;&#x0438;)');
INSERT INTO `locale` VALUES (10, 'ca_ES', 'Catal&agrave;');
INSERT INTO `locale` VALUES (11, 'zh_CN', 'Chinese (Simplified)\r\n(&#x7b80;&#x4f53;&#x4e2d;&#x6587;)');
INSERT INTO `locale` VALUES (12, 'zh_TW', 'Chinese (Traditional)\r\n(&#x6b63;&#x9ad4;&#x4e2d;&#x6587;)');
INSERT INTO `locale` VALUES (13, 'cs_CZ', 'Czech (&#x010c;esky)');
INSERT INTO `locale` VALUES (14, 'da_DK', 'Dansk');
INSERT INTO `locale` VALUES (15, 'de_DE', 'Deutsch');
INSERT INTO `locale` VALUES (16, 'en_US', 'English (American)');
INSERT INTO `locale` VALUES (17, 'en_GB', 'English (British)');
INSERT INTO `locale` VALUES (18, 'es_ES', 'Espa&ntilde;ol');
INSERT INTO `locale` VALUES (19, 'et_EE', 'Eesti');
INSERT INTO `locale` VALUES (20, 'gl_ES', 'Galego');
INSERT INTO `locale` VALUES (21, 'he_IL', 'Hebrew (&#x05E2;&#x05D1;&#x05E8;&#x05D9;&#x05EA;)');
INSERT INTO `locale` VALUES (22, 'is_IS', '&Iacute;slenska');
INSERT INTO `locale` VALUES (23, 'it_IT', 'Italiano');
INSERT INTO `locale` VALUES (24, 'km_KH', 'Khmer (&#x1781;&#x17d2;&#x1798;&#x17c2;&#x179a;)');
INSERT INTO `locale` VALUES (25, 'ko_KR', 'Korean (&#xd55c;&#xad6d;&#xc5b4;)');
INSERT INTO `locale` VALUES (26, 'lv_LV', 'Latvie&#x0161;u');
INSERT INTO `locale` VALUES (27, 'lt_LT', 'Lietuvi&#x0173;');
INSERT INTO `locale` VALUES (28, 'mk_MK', 'Macedonian\r\n(&#x041c;&#x0430;&#x043a;&#x0435;&#x0434;&#x043e;&#x043d;&#x0441;&#x043a;&#x0438;)');
INSERT INTO `locale` VALUES (29, 'hu_HU', 'Magyar');
INSERT INTO `locale` VALUES (30, 'nl_NL', 'Nederlands');
INSERT INTO `locale` VALUES (31, 'nb_NO', 'Norsk bokm&aring;l');
INSERT INTO `locale` VALUES (32, 'nn_NO', 'Norsk nynorsk');
INSERT INTO `locale` VALUES (33, 'fa_IR', 'Persian (&#x0641;&#x0627;&#x0631;&#x0633;&#x0649;)');
INSERT INTO `locale` VALUES (34, 'pl_PL', 'Polski');
INSERT INTO `locale` VALUES (35, 'pt_PT', 'Portugu&ecirc;s');
INSERT INTO `locale` VALUES (36, 'pt_BR', 'Portugu&ecirc;s Brasileiro');
INSERT INTO `locale` VALUES (37, 'ro_RO', 'Rom&acirc;n&auml;');
INSERT INTO `locale` VALUES (38, 'ru_RU', 'Russian\r\n(&#x0420;&#x0443;&#x0441;&#x0441;&#x043a;&#x0438;&#x0439;)');
INSERT INTO `locale` VALUES (39, 'sk_SK', 'Slovak (Sloven&#x010d;ina)');
INSERT INTO `locale` VALUES (40, 'sl_SI', 'Slovenian (Sloven&#x0161;&#x010d;ina)');
INSERT INTO `locale` VALUES (41, 'fi_FI', 'Suomi');
INSERT INTO `locale` VALUES (42, 'sv_SE', 'Svenska');
INSERT INTO `locale` VALUES (43, 'th_TH', 'Thai (&#x0e44;&#x0e17;&#x0e22;)');
INSERT INTO `locale` VALUES (44, 'tr_TR', 'T&uuml;rk&ccedil;e');
INSERT INTO `locale` VALUES (45, 'uk_UA', 'Ukrainian\r\n(&#x0423;&#x043a;&#x0440;&#x0430;&#x0457;&#x043d;&#x0441;&#x044c;&#x043a;&#x0430;)');

-- --------------------------------------------------------

-- 
-- Table structure for table `modules`
-- 


-- 
-- Table structure for table `modules`
-- 

CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `module` varchar(32) NOT NULL,
  `display_name` varchar(64) NOT NULL,
  `status` enum('active','disabled') NOT NULL,
  `sort_order` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `module` (`module`),
  UNIQUE KEY `sort_order` (`sort_order`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `modules`
-- 

INSERT INTO `modules` VALUES (1, 'Content', 'Site Content', 'active', 1);
INSERT INTO `modules` VALUES (2, 'Skeleton', 'Skeleton', 'disabled', 2);
INSERT INTO `modules` VALUES (5, 'Menu', 'Menu Management', 'active', 4);
INSERT INTO `modules` VALUES (7, 'Support', 'Support', 'active', 5);
INSERT INTO `modules` VALUES (8, 'User', 'User', 'active', 6);
INSERT INTO `modules` VALUES (17, 'Blocks', 'Blocks Management', 'active', 15);
INSERT INTO `modules` VALUES (21, 'Gallery', 'Photo Gallery', 'disabled', 45);


-- --------------------------------------------------------

-- 
-- Table structure for table `module_options`
-- 

CREATE TABLE `module_options` (
  `module` varchar(64) NOT NULL,
  `options` longtext,
  PRIMARY KEY  (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `module_options` VALUES ('CMS', 'a:3:{s:4:"name";s:26:"Norex Core Web Development";s:11:"defaultPage";s:4:"Home";s:16:"defaultPageTitle";s:13:"Kitchen Party";}');
INSERT INTO `module_options` VALUES ('Content', 'a:1:{s:11:"funtestitem";s:23:"Config Options are Fun!";s:15:"restrictedpages";s:4:"true";}');
INSERT INTO `module_options` VALUES ('Support', 'a:1:{i:45;i:45;}');


-- --------------------------------------------------------

-- 
-- Table structure for table `permissions`
-- 

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL auto_increment,
  `key` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


INSERT INTO `permissions` VALUES (1, 'viewcontentadmin', 'View Content Module', 'Allow viewing of the admin interface for the Content module');
INSERT INTO `permissions` VALUES (2, 'addcontentpages', 'Add Pages', 'Allow user to add Content Pages to site');
INSERT INTO `permissions` VALUES (3, 'deletecontentpages', 'Delete Pages', 'Allow user to delete Content Pages from site');
INSERT INTO `permissions` VALUES (4, 'viewcontentlayers', 'View Content Layers', 'Allow user to view Content Page layers');
INSERT INTO `permissions` VALUES (5, 'admin', 'Admin', 'Allows user to use the admin interface');
INSERT INTO `permissions` VALUES (6, 'editcontent', 'Edit Content Page', 'Allow user to edit a content page');
INSERT INTO `permissions` VALUES (7, 'assigngroups', 'Assign User to a group', 'Whether or not to allow the user to assign a group to another user');
INSERT INTO `permissions` VALUES (8, 'viewusermodule', 'View User Module', 'Allow viewing of the admin interface for the User Module');
INSERT INTO `permissions` VALUES (9, 'membersaccess', 'Member Page Access', 'Allows users to view restricted areas of the site');
INSERT INTO `permissions` VALUES (10, 'addcampaign', 'Add and Edit Campaigns', 'Allows user to add and edit campaigns under their current company');
INSERT INTO `permissions` VALUES (11, 'viewcampaign', 'View Campaigns', 'Allows user to have read access to campaigns');
INSERT INTO `permissions` VALUES (12, 'addcampaignrecips', 'Add and edit campaign recipients', 'Allows user to add and edit campaign recipients in their group');


-- --------------------------------------------------------

-- 
-- Table structure for table `states`
-- 

CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL default '0',
  `country` int(10) unsigned NOT NULL default '0',
  `code` varchar(5) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `states` VALUES (72, 31, 'NU', 'Nunavut');
INSERT INTO `states` VALUES (1, 31, 'AB', 'Alberta');
INSERT INTO `states` VALUES (2, 31, 'BC', 'British Columbia');
INSERT INTO `states` VALUES (3, 31, 'MB', 'Manitoba');
INSERT INTO `states` VALUES (4, 31, 'NB', 'New Brunswick');
INSERT INTO `states` VALUES (5, 31, 'NF', 'Newfoundland');
INSERT INTO `states` VALUES (6, 31, 'NT', 'Northwest Territories');
INSERT INTO `states` VALUES (7, 31, 'NS', 'Nova Scotia');
INSERT INTO `states` VALUES (8, 31, 'ON', 'Ontario');
INSERT INTO `states` VALUES (9, 31, 'PE', 'Prince Edward Island');
INSERT INTO `states` VALUES (10, 31, 'QC', 'Quebec');
INSERT INTO `states` VALUES (11, 31, 'SK', 'Saskatchewan');
INSERT INTO `states` VALUES (12, 31, 'YT', 'Yukon');
INSERT INTO `states` VALUES (13, 184, 'AL', 'Alabama');
INSERT INTO `states` VALUES (14, 184, 'AK', 'Alaska');
INSERT INTO `states` VALUES (15, 184, 'AS', 'American Samoa');
INSERT INTO `states` VALUES (16, 184, 'AZ', 'Arizona');
INSERT INTO `states` VALUES (17, 184, 'AR', 'Arkansas');
INSERT INTO `states` VALUES (18, 184, 'CA', 'California');
INSERT INTO `states` VALUES (19, 184, 'CO', 'Colorado');
INSERT INTO `states` VALUES (20, 184, 'CT', 'Connecticut');
INSERT INTO `states` VALUES (21, 184, 'DE', 'Delaware');
INSERT INTO `states` VALUES (22, 184, 'DC', 'District of Columbia');
INSERT INTO `states` VALUES (23, 184, 'FM', 'Fed. States of Micronesia');
INSERT INTO `states` VALUES (24, 184, 'FL', 'Florida');
INSERT INTO `states` VALUES (25, 184, 'GA', 'Georgia');
INSERT INTO `states` VALUES (26, 184, 'GU', 'Guam');
INSERT INTO `states` VALUES (27, 184, 'HI', 'Hawaii');
INSERT INTO `states` VALUES (28, 184, 'ID', 'Idaho');
INSERT INTO `states` VALUES (29, 184, 'IL', 'Illinois');
INSERT INTO `states` VALUES (30, 184, 'IN', 'Indiana');
INSERT INTO `states` VALUES (31, 184, 'IA', 'Iowa');
INSERT INTO `states` VALUES (32, 184, 'KS', 'Kansas');
INSERT INTO `states` VALUES (33, 184, 'KY', 'Kentucky');
INSERT INTO `states` VALUES (34, 184, 'LA', 'Louisiana');
INSERT INTO `states` VALUES (35, 184, 'ME', 'Maine');
INSERT INTO `states` VALUES (36, 184, 'MH', 'Marshall Islands');
INSERT INTO `states` VALUES (37, 184, 'MD', 'Maryland');
INSERT INTO `states` VALUES (38, 184, 'MA', 'Massachusetts');
INSERT INTO `states` VALUES (39, 184, 'MI', 'Michigan');
INSERT INTO `states` VALUES (40, 184, 'MN', 'Minnesota');
INSERT INTO `states` VALUES (41, 184, 'MS', 'Mississippi');
INSERT INTO `states` VALUES (42, 184, 'MO', 'Missouri');
INSERT INTO `states` VALUES (43, 184, 'MT', 'Montana');
INSERT INTO `states` VALUES (44, 184, 'NE', 'Nebraska');
INSERT INTO `states` VALUES (45, 184, 'NV', 'Nevada');
INSERT INTO `states` VALUES (46, 184, 'NH', 'New Hampshire');
INSERT INTO `states` VALUES (47, 184, 'NJ', 'New Jersey');
INSERT INTO `states` VALUES (48, 184, 'NM', 'New Mexico');
INSERT INTO `states` VALUES (49, 184, 'NY', 'New York');
INSERT INTO `states` VALUES (50, 184, 'NC', 'North Carolina');
INSERT INTO `states` VALUES (51, 184, 'ND', 'North Dakota');
INSERT INTO `states` VALUES (52, 184, 'MP', 'Northern Mariana Is.');
INSERT INTO `states` VALUES (53, 184, 'OH', 'Ohio');
INSERT INTO `states` VALUES (54, 184, 'OK', 'Oklahoma');
INSERT INTO `states` VALUES (55, 184, 'OR', 'Oregon');
INSERT INTO `states` VALUES (56, 184, 'PW', 'Palau');
INSERT INTO `states` VALUES (57, 184, 'PA', 'Pennsylvania');
INSERT INTO `states` VALUES (58, 184, 'PR', 'Puerto Rico');
INSERT INTO `states` VALUES (59, 184, 'RI', 'Rhode Island');
INSERT INTO `states` VALUES (60, 184, 'SC', 'South Carolina');
INSERT INTO `states` VALUES (61, 184, 'SD', 'South Dakota');
INSERT INTO `states` VALUES (62, 184, 'TN', 'Tennessee');
INSERT INTO `states` VALUES (63, 184, 'TX', 'Texas');
INSERT INTO `states` VALUES (64, 184, 'UT', 'Utah');
INSERT INTO `states` VALUES (65, 184, 'VT', 'Vermont');
INSERT INTO `states` VALUES (66, 184, 'VA', 'Virginia');
INSERT INTO `states` VALUES (67, 184, 'VI', 'Virgin Islands');
INSERT INTO `states` VALUES (68, 184, 'WA', 'Washington');
INSERT INTO `states` VALUES (69, 184, 'WV', 'West Virginia');
INSERT INTO `states` VALUES (70, 184, 'WI', 'Wisconsin');
INSERT INTO `states` VALUES (71, 184, 'WY', 'Wyoming');

-- 
-- Table structure for table `templates`
-- 

CREATE TABLE `templates` (
  `module` varchar(32) NOT NULL default '',
  `path` varchar(64) NOT NULL,
  `data` longtext NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `id` int(11) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `path` (`path`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- 
-- Dumping data for table `templates`
-- 

INSERT INTO `templates` VALUES ('Module_Content', 'content.tpl', '<script type="text/javascript">genFlash(''/flash/leftCol.swf?pagetitle={$content->getPageTitle()}'', 615, 35, '''', ''transparent'');</script>\r\n{$content->getContent()}', '2008-07-28 20:26:32', 33);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>{$title}</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n\r\n\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n<h1>{$title}</h1>\r\n\r\n{module class="Menu"}\r\n	\r\n{if $user}<a href="/user/logout">Logout</a>{else}<a href="/user/login">Login</a>{/if}\r\n\r\n{module class=$module}\r\n\r\n</body>\r\n</html>', '2008-08-05 11:35:40', 37);
INSERT INTO `templates` VALUES ('CMS', 'css/cssMenus.css', '', '2008-07-29 00:42:33', 53);
INSERT INTO `templates` VALUES ('CMS', 'css/style.css', 'ol {\r\n	list-style-type: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\nfieldset {\r\n	border: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n', '2008-07-29 00:44:53', 55);
INSERT INTO `templates` VALUES ('Module_Menu', 'menu_rendertop.tpl', '<div id="nav">\r\n	<ul id="navUl">\r\n	{assign var=menuCount value=0}\r\n	{foreach from=$menu item=item}\r\n		{assign var=menuCount value=$menuCount+1}\r\n		{strip}<li><a href="{$item->link}"{if $item->target == "new"} target="_blank"{/if}>{$item->display}</a>\r\n		{if $item->children}{assign var="children" value=true}<ul>{else}{assign var="children" value=false}{/if}\r\n		{foreach from=$item->children item=item}\r\n		{assign var="depth" value=1}\r\n		{include file=db:menu_renderitems.tpl menu=item}\r\n		{/foreach}\r\n		{if $children}</ul>{/if}\r\n		</li>\r\n		{if $menuCount < $menu|@count}\r\n			<li class="menuDivider">?</li>\r\n		{/if}{/strip}\r\n		{/foreach}\r\n	</ul>\r\n</div>', '2008-07-29 01:43:02', 57);

-- 
-- Table structure for table `images`
-- 

CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `data` mediumblob NOT NULL,
  `content_type` varchar(32) NOT NULL,
  `filename` varchar(64) NOT NULL,
  `filesize` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `images_cache`
-- 

CREATE TABLE `images_cache` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `image_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `data` blob NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `hash_2` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

