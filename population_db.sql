-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET NAMES utf8 */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

-- Dumping data for table population_db.cities: ~2 rows (approximately)
INSERT INTO
    `cities` (
        `id`,
        `city`,
        `country_id`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Kathmandu',
        1,
        '2024-01-02 03:33:12',
        '2024-01-02 03:33:12'
    ), (
        2,
        'Stockholm',
        2,
        '2024-01-02 03:56:56',
        '2024-01-02 03:56:56'
    );

-- Dumping data for table population_db.countries: ~2 rows (approximately)
INSERT INTO
    `countries` (
        `id`,
        `country`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Nepal',
        '2024-01-02 03:33:00',
        '2024-01-02 03:33:00'
    ), (
        2,
        'Sweden',
        '2024-01-02 03:56:45',
        '2024-01-02 03:56:45'
    );

-- Dumping data for table population_db.failed_jobs: ~0 rows (approximately)

-- Dumping data for table population_db.migrations: ~7 rows (approximately)
INSERT INTO
    `migrations` (`id`, `migration`, `batch`)
VALUES (
        1,
        '2014_10_12_000000_create_users_table',
        1
    ), (
        2,
        '2014_10_12_100000_create_password_reset_tokens_table',
        1
    ), (
        3,
        '2019_08_19_000000_create_failed_jobs_table',
        1
    ), (
        4,
        '2019_12_14_000001_create_personal_access_tokens_table',
        1
    ), (
        5,
        '2024_01_02_074748_create_countries_table',
        1
    ), (
        6,
        '2024_01_02_082248_create_cities_table',
        1
    ), (
        7,
        '2024_01_02_090037_create_populations_table',
        1
    );

-- Dumping data for table population_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table population_db.personal_access_tokens: ~0 rows (approximately)

-- Dumping data for table population_db.populations: ~7 rows (approximately)
INSERT INTO
    `populations` (
        `id`,
        `country_id`,
        `city_id`,
        `age_group`,
        `male_population`,
        `female_population`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        1,
        'Young',
        1000,
        200,
        '2024-01-02 04:09:02',
        '2024-01-02 04:09:02'
    ), (
        2,
        2,
        2,
        'Young',
        100,
        100,
        '2024-01-02 04:49:31',
        '2024-01-02 04:49:31'
    ), (
        3,
        1,
        1,
        'Old',
        2000,
        1000,
        '2024-01-02 05:36:33',
        '2024-01-02 05:36:33'
    ), (
        4,
        2,
        2,
        'Old',
        1000,
        500,
        '2024-01-02 05:36:51',
        '2024-01-02 05:36:51'
    ), (
        5,
        2,
        2,
        'Child',
        500,
        600,
        '2024-01-02 05:37:06',
        '2024-01-02 05:37:06'
    ), (
        6,
        1,
        1,
        'Old',
        500,
        600,
        '2024-01-02 05:37:17',
        '2024-01-02 05:37:17'
    ), (
        7,
        1,
        1,
        'Child',
        100,
        300,
        '2024-01-02 05:37:29',
        '2024-01-02 05:37:29'
    );

-- Dumping data for table population_db.users: ~1 rows (approximately)
INSERT INTO
    `users` (
        `id`,
        `name`,
        `email`,
        `username`,
        `email_verified_at`,
        `password`,
        `remember_token`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Sujan Timalsina',
        NULL,
        'sujan',
        NULL,
        '$2y$12$dE/Vo96IowIz1w8bDSzo2.xvKFtvSyFKJwxmQ4Q4X9u1ZrISzonjq',
        NULL,
        '2024-01-02 03:19:14',
        '2024-01-02 03:19:14'
    );

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */
;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;