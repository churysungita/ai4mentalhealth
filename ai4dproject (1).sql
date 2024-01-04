-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 03:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ai4dproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`, `created_at`, `updated_at`) VALUES
(1, '<p>hgffdcxsjhbgfv</p>', '2023-12-24 05:32:56', '2023-12-24 05:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ai4d', 'adminai4d@', '$2y$12$7oNFuUJTkXI3z3UI6EYqtegCWW/lha6Wb0bk7AxDuZJ8IDwMjzfm2', 'adminai4d@gmail.com', '2023-12-24 03:29:36', '2023-12-24 03:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image_path`, `content`, `created_at`, `updated_at`) VALUES
(1, 'mhuri wa senaaa', 'images/1703397108_vevacodestheme.jpg', '<p class=\"ql-align-center\"><img src=\"data:image/png;base64,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\"></p><p class=\"ql-align-center\">Hello wanna trying this</p>', '2023-12-24 03:50:50', '2023-12-24 04:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `conference_papers`
--

CREATE TABLE `conference_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `publication_date` date NOT NULL,
  `team_members` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`team_members`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conference_papers`
--

INSERT INTO `conference_papers` (`id`, `title`, `link`, `pdf_path`, `image_path`, `publication_date`, `team_members`, `created_at`, `updated_at`) VALUES
(1, 'Dr Matogoro', 'http://127.0.0.1:8000/admin/conference_papers', 'conference_papers/1703403515_mhuri_1.pdf', 'conference_papers/1703403515_mhuri_3-removebg-preview.png', '2023-12-24', NULL, '2023-12-24 05:34:24', '2023-12-24 05:38:35'),
(4, 'yui', 'https://laravel.com/docs/10.x', 'conference_papers/1703406681_AFDB-VACANCY-SEP.pdf', 'conference_papers/1703406681_mhuri_3-removebg-preview.png', '2023-12-24', NULL, '2023-12-24 06:31:21', '2023-12-24 06:31:21'),
(5, 'hhhhhhhh', 'http://127.0.0.1:8000/admin/conference_papers', 'conference_papers/1704377335_application letter and CV.pdf', 'conference_papers/1704377335_1.png', '2024-01-04', NULL, '2024-01-04 12:08:55', '2024-01-04 12:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `conference_paper_team_member`
--

CREATE TABLE `conference_paper_team_member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conference_paper_id` bigint(20) UNSIGNED NOT NULL,
  `team_member_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conference_paper_team_member`
--

INSERT INTO `conference_paper_team_member` (`id`, `conference_paper_id`, `team_member_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 3, NULL, NULL),
(6, 4, 2, NULL, NULL),
(7, 5, 2, NULL, NULL),
(8, 5, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documentations`
--

CREATE TABLE `documentations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_papers`
--

CREATE TABLE `journal_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `publication_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_papers`
--

INSERT INTO `journal_papers` (`id`, `title`, `link`, `pdf_path`, `image_path`, `publication_date`, `created_at`, `updated_at`) VALUES
(4, 'dfghj', 'http://127.0.0.1:8000/admin/journal_papers', 'journal_papers/1703406517_application letter and CV.pdf', 'journal_papers/1703406517_mhuri_3-removebg-preview.png', '2023-12-24', '2023-12-24 06:28:37', '2023-12-24 06:28:37'),
(5, 'Installation', 'https://laravel.com/docs/10.x', 'journal_papers/1703406609_application letter and CV.pdf', 'journal_papers/1703406609_mhuri_3-removebg-preview.png', '2023-12-24', '2023-12-24 06:30:09', '2023-12-24 06:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `journal_paper_team_member`
--

CREATE TABLE `journal_paper_team_member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_paper_id` bigint(20) UNSIGNED NOT NULL,
  `team_member_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_paper_team_member`
--

INSERT INTO `journal_paper_team_member` (`id`, `journal_paper_id`, `team_member_id`, `created_at`, `updated_at`) VALUES
(7, 4, 2, NULL, NULL),
(8, 4, 3, NULL, NULL),
(9, 5, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_09_160246_create_admins_table', 1),
(6, '2023_12_09_203349_create_teams_table', 1),
(7, '2023_12_09_210620_create_about_us_table', 1),
(8, '2023_12_09_212758_create_slideshows_table', 1),
(9, '2023_12_09_213654_create_testimonials_table', 1),
(10, '2023_12_09_220110_create_documentations_table', 1),
(11, '2023_12_10_184737_create_contact_us_table', 1),
(12, '2023_12_19_015543_create_conference_papers_table', 1),
(13, '2023_12_19_015602_create_journal_papers_table', 1),
(14, '2023_12_19_063729_add_team_members_to_journal_papers_table', 1),
(15, '2023_12_19_180457_create_conference_paper_team_member_table', 1),
(16, '2023_12_19_180819_create_journal_paper_team_member_table', 1),
(17, '2023_12_23_075641_create_blogs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `action_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slideshows`
--

INSERT INTO `slideshows` (`id`, `heading`, `content`, `image_path`, `action_link`, `created_at`, `updated_at`) VALUES
(2, 'fggggggggggggg', '<p>fffffffffffffffffffffffffffff</p>', 'slideshow_images/1703407506_2.png', 'http://127.0.0.1:8000/admin/slideshow', '2023-12-24 06:42:40', '2023-12-24 06:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_position` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `image_path`, `member_name`, `member_position`, `facebook`, `twitter`, `instagram`, `linkedin`, `created_at`, `updated_at`) VALUES
(2, 'images/1703402032_IL LOGO TV.png', 'CHURY SUNGITA', 'IT', NULL, NULL, NULL, NULL, '2023-12-24 05:13:52', '2023-12-24 05:13:52'),
(3, 'images/1703403069_2.png', 'Omben Tango', 'Developer', 'https://fontawesome.com/icons', 'https://fontawesome.com/icons', 'https://fontawesome.com/icons', 'https://fontawesome.com/icons', '2023-12-24 05:14:46', '2023-12-24 05:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `person_position` varchar(255) NOT NULL,
  `person_picture` varchar(255) DEFAULT NULL,
  `person_message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference_papers`
--
ALTER TABLE `conference_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference_paper_team_member`
--
ALTER TABLE `conference_paper_team_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_paper_team_member_conference_paper_id_foreign` (`conference_paper_id`),
  ADD KEY `conference_paper_team_member_team_member_id_foreign` (`team_member_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentations`
--
ALTER TABLE `documentations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `journal_papers`
--
ALTER TABLE `journal_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_paper_team_member`
--
ALTER TABLE `journal_paper_team_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_paper_team_member_journal_paper_id_foreign` (`journal_paper_id`),
  ADD KEY `journal_paper_team_member_team_member_id_foreign` (`team_member_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conference_papers`
--
ALTER TABLE `conference_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `conference_paper_team_member`
--
ALTER TABLE `conference_paper_team_member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documentations`
--
ALTER TABLE `documentations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_papers`
--
ALTER TABLE `journal_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `journal_paper_team_member`
--
ALTER TABLE `journal_paper_team_member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conference_paper_team_member`
--
ALTER TABLE `conference_paper_team_member`
  ADD CONSTRAINT `conference_paper_team_member_conference_paper_id_foreign` FOREIGN KEY (`conference_paper_id`) REFERENCES `conference_papers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conference_paper_team_member_team_member_id_foreign` FOREIGN KEY (`team_member_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `journal_paper_team_member`
--
ALTER TABLE `journal_paper_team_member`
  ADD CONSTRAINT `journal_paper_team_member_journal_paper_id_foreign` FOREIGN KEY (`journal_paper_id`) REFERENCES `journal_papers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `journal_paper_team_member_team_member_id_foreign` FOREIGN KEY (`team_member_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
