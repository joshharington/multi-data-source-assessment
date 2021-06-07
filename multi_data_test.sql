-- Database export via SQLPro (https://www.sqlprostudio.com/allapps.html)
-- Exported by josh at 07-06-2021 13:19.
-- WARNING: This file may contain descructive statements such as DROPs.
-- Please ensure that you are running the script at the proper location.


-- BEGIN TABLE migrations
DROP TABLE IF EXISTS migrations;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserting 8 rows into migrations
-- Insert batch #1
INSERT INTO migrations (id, migration, batch) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2021_06_06_100938_alter_users_table_1', 2);

-- END TABLE migrations

-- BEGIN TABLE oauth_access_tokens
DROP TABLE IF EXISTS oauth_access_tokens;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserting 9 rows into oauth_access_tokens
-- Insert batch #1
INSERT INTO oauth_access_tokens (id, user_id, client_id, name, scopes, revoked, created_at, updated_at, expires_at) VALUES
('0625654c75c65be38fc0d4aa980ed81c9a1dc07ae594bde4415f7397458730affd8511f969e761b9', 1, 2, NULL, '["*"]', 0, '2021-06-06 08:42:38', '2021-06-06 08:42:38', '2022-06-06 08:42:38'),
('0acd83d00f55ba9756145a08ac00800240e326664ebb41bc7f14c7b56c500e0c275602b3c8cb3c8a', 1, 2, NULL, '["*"]', 0, '2021-06-06 08:42:14', '2021-06-06 08:42:14', '2022-06-06 08:42:14'),
('3b55afe236e8f289e14e0610a1eec803e7bdff39bb9de7c28de5b991dcc7fc0dbc2566729bb8cf8e', 1, 2, NULL, '["*"]', 0, '2021-06-06 08:40:51', '2021-06-06 08:40:51', '2022-06-06 08:40:51'),
('461a8ac633fcf301e646268879f13c373e12195efa3e1bb1f74d198806b53af67a24104d1b9cacd0', 1, 2, NULL, '["*"]', 0, '2021-06-07 10:57:38', '2021-06-07 10:57:38', '2022-06-07 10:57:38'),
('5d6b696171932dab58d2706f97d58d1587f8e554bd822e0f6711f56647d77027e1722d52401d9230', 1, 2, NULL, '["*"]', 0, '2021-06-06 08:39:20', '2021-06-06 08:39:20', '2022-06-06 08:39:20'),
('8f14790c5b40ebb34b6e9543005a158c9ea4f8745a197dbfd2456125cc41a753fc9f53f7078a2ff9', 1, 2, NULL, '["*"]', 0, '2021-06-06 08:41:50', '2021-06-06 08:41:50', '2022-06-06 08:41:50'),
('985ae6b17aaabac40575291e3709d27067035a9e573d9cda1d6ee9feee9afadef303d4e286a41bb9', 1, 2, NULL, '["*"]', 0, '2021-06-06 08:42:51', '2021-06-06 08:42:51', '2022-06-06 08:42:51'),
('9f981c1ef1c09fc261ede97b4036380014b214375dd2e9657ba1dfda059b13e2c09b8d34e7cf0a5c', 1, 2, NULL, '["*"]', 0, '2021-06-06 21:36:38', '2021-06-06 21:36:38', '2022-06-06 21:36:38'),
('f4a580eebf18b0bc5bc3d2af1fdc2b6ff33e0af680a0137f9180250d3d764773351d2d98573dad0a', 1, 2, NULL, '["*"]', 0, '2021-06-06 15:13:15', '2021-06-06 15:13:15', '2022-06-06 15:13:15');

-- END TABLE oauth_access_tokens

-- BEGIN TABLE oauth_auth_codes
DROP TABLE IF EXISTS oauth_auth_codes;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table oauth_auth_codes contains no data. No inserts have been genrated.
-- Inserting 0 rows into oauth_auth_codes


-- END TABLE oauth_auth_codes

-- BEGIN TABLE oauth_clients
DROP TABLE IF EXISTS oauth_clients;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserting 2 rows into oauth_clients
-- Insert batch #1
INSERT INTO oauth_clients (id, user_id, name, secret, redirect, personal_access_client, password_client, revoked, created_at, updated_at) VALUES
(1, NULL, 'Laravel Personal Access Client', 'GNNCLgy6Bfo0sTgyZS1BxbsUjbIN4h3RDGEDGTSm', 'http://localhost', 1, 0, 0, '2021-06-06 08:10:46', '2021-06-06 08:10:46'),
(2, NULL, 'Laravel Password Grant Client', 'eQqTps21vZNgsvxflflIsW1gvVaFAXmxizEiCgvY', 'http://localhost', 0, 1, 0, '2021-06-06 08:10:46', '2021-06-06 08:10:46');

-- END TABLE oauth_clients

-- BEGIN TABLE oauth_personal_access_clients
DROP TABLE IF EXISTS oauth_personal_access_clients;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserting 1 row into oauth_personal_access_clients
-- Insert batch #1
INSERT INTO oauth_personal_access_clients (id, client_id, created_at, updated_at) VALUES
(1, 1, '2021-06-06 08:10:46', '2021-06-06 08:10:46');

-- END TABLE oauth_personal_access_clients

-- BEGIN TABLE oauth_refresh_tokens
DROP TABLE IF EXISTS oauth_refresh_tokens;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserting 9 rows into oauth_refresh_tokens
-- Insert batch #1
INSERT INTO oauth_refresh_tokens (id, access_token_id, revoked, expires_at) VALUES
('25ea6bdecfaafcbf42500eb84a02725d01ad4602f775fa21b2fce9612eb4da5603a877e577e75440', '0625654c75c65be38fc0d4aa980ed81c9a1dc07ae594bde4415f7397458730affd8511f969e761b9', 0, '2022-06-06 08:42:38'),
('26281ef373e1e06878c973b1ac448f0bf802c042c90f54a1fe36513243e8dd5c0c7afec581e7d547', '461a8ac633fcf301e646268879f13c373e12195efa3e1bb1f74d198806b53af67a24104d1b9cacd0', 0, '2022-06-07 10:57:38'),
('633bd7680e351d9a12cc74dcfeb622f951ea3c0c9543b6331fdafd718944d266c8a2027d5102014c', '5d6b696171932dab58d2706f97d58d1587f8e554bd822e0f6711f56647d77027e1722d52401d9230', 0, '2022-06-06 08:39:20'),
('6cc9474d1c04def5a666e85841881133cc3933e4223611edddb418adf38c59165d92714b3ea3702c', '9f981c1ef1c09fc261ede97b4036380014b214375dd2e9657ba1dfda059b13e2c09b8d34e7cf0a5c', 0, '2022-06-06 21:36:38'),
('717aadd8205c68374a694e0a97095073e890271b0b9cea036dfa02d15d39e5d2a10012cfb51057a9', 'f4a580eebf18b0bc5bc3d2af1fdc2b6ff33e0af680a0137f9180250d3d764773351d2d98573dad0a', 0, '2022-06-06 15:13:15'),
('73d6db38176833e3fef6ad4accd6819009520efbf2269349a86d24048904678278d919f19ae7d939', '0acd83d00f55ba9756145a08ac00800240e326664ebb41bc7f14c7b56c500e0c275602b3c8cb3c8a', 0, '2022-06-06 08:42:14'),
('75bb04d00c9b257b68cfbcf6c7dafd995a39c9a9b151720e417a8f0dfcbaaa654bebf30b9d10873b', '8f14790c5b40ebb34b6e9543005a158c9ea4f8745a197dbfd2456125cc41a753fc9f53f7078a2ff9', 0, '2022-06-06 08:41:50'),
('bf391d3367ad1a92831bd26b23291f5b9384d857646982b63094c445b2e641da06344ec8d262fa0e', '3b55afe236e8f289e14e0610a1eec803e7bdff39bb9de7c28de5b991dcc7fc0dbc2566729bb8cf8e', 0, '2022-06-06 08:40:51'),
('f6d712ae78d427c9a3060027e63acd44371f003c58f05663fd2931e917d275de21581f3a000ef415', '985ae6b17aaabac40575291e3709d27067035a9e573d9cda1d6ee9feee9afadef303d4e286a41bb9', 0, '2022-06-06 08:42:51');

-- END TABLE oauth_refresh_tokens

-- BEGIN TABLE password_resets
DROP TABLE IF EXISTS password_resets;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table password_resets contains no data. No inserts have been genrated.
-- Inserting 0 rows into password_resets


-- END TABLE password_resets

-- BEGIN TABLE users
DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserting 5 rows into users
-- Insert batch #1
INSERT INTO users (id, name, email, email_verified_at, password, api_token, remember_token, created_at, updated_at, date_of_birth) VALUES
(1, 'Josh Harington', 'josh1@live.co.za', NULL, '$2y$10$Apav.Z0/qXSvxYs8WV7efeS2d3rzEPMz67rD5s7H79hZfBo8ADFYq', NULL, NULL, '2021-06-06 16:26:37', '2021-06-06 16:26:37', '2021-04-01T15:54:00.000Z'),
(2, 'Jason Statham', 'jason@statham.com', NULL, '$2y$10$Apav.Z0/qXSvxYs8WV7efeS2d3rzEPMz67rD5s7H79hZfBo8ADFYq', NULL, NULL, '2021-06-06 16:26:37', '2021-06-06 16:26:37', '2021-06-10T15:56:00.000Z'),
(3, 'Terry Lappa', 'terry@lappa.com', NULL, '$2y$10$Apav.Z0/qXSvxYs8WV7efeS2d3rzEPMz67rD5s7H79hZfBo8ADFYq', NULL, NULL, '2021-06-06 16:26:37', '2021-06-06 16:26:37', '2021-06-24T16:12:00.000Z'),
(4, 'Steph Claassen', 'steph@classseen.com', NULL, '$2y$10$Apav.Z0/qXSvxYs8WV7efeS2d3rzEPMz67rD5s7H79hZfBo8ADFYq', NULL, NULL, '2021-06-06 16:26:37', '2021-06-06 16:26:37', '2021-06-14T16:25:00.000Z'),
(5, 'Vic Preston', 'vic@preston.com', NULL, '$2y$10$Apav.Z0/qXSvxYs8WV7efeS2d3rzEPMz67rD5s7H79hZfBo8ADFYq', NULL, NULL, '2021-06-06 16:26:37', '2021-06-06 16:26:37', '2021-06-10T16:26:00.000Z');

-- END TABLE users

