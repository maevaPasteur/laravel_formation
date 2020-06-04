-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2020 at 12:10 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_formation`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Javascript', '2020-06-03 18:52:18', '2020-06-03 18:52:18'),
(2, 'développement front', '2020-06-03 18:53:32', '2020-06-03 18:53:32'),
(3, 'Développement Back', '2020-06-03 18:53:42', '2020-06-03 18:53:42'),
(5, 'Marketing', '2020-06-03 18:53:49', '2020-06-03 18:53:49'),
(6, 'Communication', '2020-06-03 18:53:53', '2020-06-03 18:53:53'),
(7, 'Gestion de projet', '2020-06-03 18:53:59', '2020-06-03 18:53:59'),
(8, 'Design', '2020-06-03 18:54:03', '2020-06-03 18:54:03'),
(9, 'Vidéo', '2020-06-03 18:54:07', '2020-06-03 18:54:07'),
(10, 'Photo', '2020-06-03 18:54:11', '2020-06-03 18:54:11'),
(11, 'Application mobile', '2020-06-03 18:54:18', '2020-06-03 18:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `category_formation`
--

CREATE TABLE `category_formation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formation_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_formation`
--

INSERT INTO `category_formation` (`id`, `formation_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, NULL),
(3, 1, 1, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 4, 5, NULL, NULL),
(7, 5, 3, NULL, NULL),
(8, 5, 7, NULL, NULL),
(9, 6, 8, NULL, NULL),
(10, 7, 2, NULL, NULL),
(11, 7, 3, NULL, NULL),
(12, 8, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `places` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `places`, `created_at`, `updated_at`) VALUES
(1, 'Salle 1', 20, '2020-06-03 18:47:07', '2020-06-03 18:47:07'),
(2, 'Salle 3', 16, '2020-06-03 18:47:20', '2020-06-03 18:47:20'),
(3, 'Salle 2', 10, '2020-06-03 18:47:28', '2020-06-03 18:47:28'),
(4, 'Salle 4', 14, '2020-06-03 18:47:41', '2020-06-03 18:47:41'),
(5, 'Salle 5', 15, '2020-06-03 18:47:48', '2020-06-03 18:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formations`
--

INSERT INTO `formations` (`id`, `title`, `description`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Javascript', 'Apprendre à coder des applications web en JavaScript', 'Pendant cette formation développeur web et mobile, vous apprendrez à coder efficacement un produit Tech à la fois côté Front-end, la partie visible de l’appli, mais aussi côté Back-end, le “cerveau” de votre appli. Le tout en Full Stack JavaScript, un langage très robuste et particulièrement apprécié des startups.Vous apprendrez à utiliser HTML et CSS, qui vous serviront pour coder vos pages Web mais aussi les bases de la programmation Javascript côté Front-end. Vous verrez la notion d\'évènements, le DOM et l\'utilisation de la librairie Jquery.Vous verrez comment apprendre à coder côté Back-end et comment fonctionne le cerveau de votre application ! Maîtrisez l\'environnement Node.js, comprenez la mécanique du framework Express et dynamisez vos pages avec le moteur de template EJS.', 2, '2020-06-03 18:36:49', '2020-06-03 18:36:49'),
(2, 'Laravel', 'A travers cette formation, je vous propose de découvrir le framework Laravel. Comme tous les frameworks PHP, Laravel vous permettra d\'écrire une application web plus rapidement et surtout plus proprement.', 'Vous apprendrez à développer des applications Web PHP avec le framework Laravel 5.x. Sa structure se veut élégante et légère dans le cadre d\'un développement MVC et dans le respect des Design Patterns. Laravel vous permettra d\'écrire une application Web plus rapidement et plus facilement maintenable.\r\n\r\nObjectifs pédagogiques :\r\nInstaller et configurer Laravel 5.x\r\nMaîtriser les composants de Laravel\r\nManipuler des données via l\'ORM Eloquent\r\nConcevoir des formulaires et contrôler la validation des données\r\nCréer des applications Web sécurisées', 2, '2020-06-03 19:45:15', '2020-06-03 19:45:15'),
(3, 'SEO', 'Apprenez à travailler le SEO de votre site web en suivant cette formation sur 1 jour. Formez-vous sur le SEO et découvrez comment optimiser les pages d\'un site web.', 'Un support et les exercices du cours pour chaque stagiaire\r\nUn formateur expert ayant suivi une formation à la pédagogie\r\nBoissons offertes pendant les pauses en inter-entreprises\r\nSalles lumineuses et locaux facilement accessibles\r\nMéthodologie basée sur l\'Active Learning : 75% de pratique minimum\r\nMatériel pour les formations présentielles informatiques : un PC par participant\r\nEvaluation de fin de formation : Certification CPF ou mise en situation notée par le formateur\r\nformations accessibles aux personnes en situation de handicap, nous contacter pour savoir si adaptation possible.', 2, '2020-06-04 08:05:06', '2020-06-04 08:05:15'),
(4, 'SEA', 'Vous souhaitez vous lancer dans le Webmarketing mais vous ne savez pas par ou commencer ?', 'Vous voulez comprendre le fonctionnement de la publicité sur les moteurs de recherche, et principalement sur Google ? Vous voulez vous former, et former vos équipes, à la gestion de vos campagnes de publicité sur le web pour être pleinement autonomes ? Vous voulez être capables d’analyser les performances de vos campagnes et comprendre quelles actions mettre en place à partir de vos analyses ?\r\n\r\nPour vous donner les moyens de créer des campagnes de publicité sur les moteurs de recherche performantes, l’équipe de Referencement.com a conçu une formation en poursuivant les objectifs suivants :\r\n\r\n• Vous apprendre à créer et piloter une campagne Google ads en fonction de KPI précis\r\n• Maîtriser les bonnes pratiques de Google Ads\r\n• Maîtriser les outils mis à disposition par Google pour analyser, et donc optimiser vos campagnes.', 63, '2020-06-04 08:13:49', '2020-06-04 08:13:49'),
(5, 'UML', 'Vous êtes développeur ou novice en informatique, et vous souhaitez préparer votre projet logiciel avec UML ? Vous souhaitez proposer une version visuelle de votre projet et compréh', 'Je vous présenterai le langage UML et réaliserai, avec vous, les premières analyses de besoin d’un projet logiciel à partir d\'un exemple concret. À la fin de ce cours, vous serez capable de réaliser vos premiers diagrammes définissant les éléments de base de votre projet : le contexte, les utilisateurs, les actions et leur déroulement.', 57, '2020-06-04 08:16:02', '2020-06-04 08:16:02'),
(6, 'UX Design', 'UX Designer est un métier très recherché. Ces professionnels sont demandés dans des start-up comme des grandes entreprises, ainsi qu\'en agence web et de communication. Il est aussi', 'Ce que vous saurez faire - entre autres ! - à l\'issue de cette formation :\r\n\r\nAppliquer la démarche UX\r\nÉlaborer une stratégie UX\r\nMener une étude utilisateurs\r\nAlimenter une conception d\'interface web / mobile / métier\r\nRéaliser une interface web / mobile / métier\r\nMettre en œuvre la démarche UX dans une équipe projet\r\nPromouvoir son travail au sein de la communauté UX', 57, '2020-06-04 08:38:07', '2020-06-04 08:38:07'),
(7, 'Développeur d\'application - Python', 'Grâce à la spécialisation Python / Django, vous saurez construire des scripts et des applications web robustes. Vous découvrirez les sujets centraux du développement web et serez c', 'Pourquoi apprendre Python ?  Avant tout car il s\'agit d\'un langage très utilisé dans la sphère scientifique et qu\'il vous ouvrira de nombreuses portes ! C\'est également un des langages de prédilection des startups car il est clair, concis et permet de créer rapidement des prototypes fonctionnels. \r\n\r\nPython est le 5e langage le plus populaire selon l’index TIOBE et son usage est resté stable depuis une dizaine d’années. Vous avez la garantie d’utiliser longtemps ce que vous apprendrez dans ce parcours !\r\n\r\nSuivez cette formation en ligne pour obtenir le diplôme \"Développeur d’application\"* enregistré au RNCP, de niveau II reconnu par l’État (', 57, '2020-06-04 08:42:29', '2020-06-04 08:42:29'),
(8, 'Développeur Salesforce', 'Salesforce est un éditeur de logiciels, principalement connu pour ses solutions en gestion de la relation client (CRM).', 'En tant que développeur Salesforce, vous pourrez travailler dans plus de 150 000 entreprises qui utilisent les logiciels Salesforce dans le monde, ou vous pourrez être embauché directement par Salesforce. Ce parcours de formation vous offrira également les compétences pour travailler en tant que développeur freelance.\r\n\r\nLe métier de développeur Salesforce est d\'ailleurs en forte demande sur le marché de l\'emploi.', 57, '2020-06-04 08:43:58', '2020-06-04 08:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_30_172402_create_formations_table', 1),
(5, '2020_05_30_213116_create_classrooms_table', 1),
(6, '2020_05_30_220237_create_sessions_table', 1),
(7, '2020_05_31_175932_create_session_user_table', 1),
(8, '2020_05_31_202611_create_categories_table', 1),
(9, '2020_05_31_202933_create_category_formation_table', 1),
(10, '2020_05_31_231724_add_column_role_to_users', 1),
(11, '2020_06_01_153145_add_column_note_to_session_user', 2),
(12, '2020_06_01_170146_create_reports_table', 2),
(13, '2020_06_01_172415_add_report_to_session', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `open` tinyint(1) NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `start`, `open`, `formation_id`, `classroom_id`, `created_at`, `updated_at`) VALUES
(1, '2020-06-05', 1, 1, 3, '2020-06-03 19:11:40', '2020-06-03 19:11:40'),
(2, '2020-06-06', 1, 2, 3, '2020-06-03 19:45:20', '2020-06-03 19:45:20'),
(3, '2020-06-09', 1, 2, 2, '2020-06-03 19:45:23', '2020-06-03 19:45:23'),
(4, '2020-06-12', 1, 2, 3, '2020-06-03 19:45:26', '2020-06-03 19:45:26'),
(5, '2020-06-02', 1, 1, 2, '2020-06-02 21:46:26', NULL),
(6, '2020-06-07', 1, 4, 3, '2020-06-04 08:14:26', '2020-06-04 08:14:26'),
(7, '2020-06-10', 1, 4, 2, '2020-06-04 08:14:31', '2020-06-04 08:14:31'),
(8, '2020-06-12', 1, 4, 3, '2020-06-04 08:14:34', '2020-06-04 08:14:34'),
(9, '2020-06-16', 1, 4, 3, '2020-06-04 08:14:36', '2020-06-04 08:14:36'),
(10, '2020-06-26', 1, 4, 2, '2020-06-04 08:14:39', '2020-06-04 08:14:39'),
(11, '2020-06-30', 1, 4, 2, '2020-06-04 08:14:42', '2020-06-04 08:14:42'),
(12, '2020-06-06', 1, 4, 5, '2020-06-04 08:14:57', '2020-06-04 08:14:57'),
(13, '2020-06-05', 1, 5, 2, '2020-06-04 08:31:05', '2020-06-04 08:31:05'),
(14, '2020-06-11', 1, 6, 2, '2020-06-04 08:38:18', '2020-06-04 08:38:18'),
(15, '2020-06-09', 1, 6, 3, '2020-06-04 08:38:21', '2020-06-04 08:38:21'),
(16, '2020-06-06', 1, 6, 2, '2020-06-04 08:38:26', '2020-06-04 08:38:26'),
(17, '2020-06-07', 1, 6, 4, '2020-06-04 08:38:29', '2020-06-04 08:38:29'),
(18, '2020-06-08', 1, 6, 1, '2020-06-04 08:38:33', '2020-06-04 08:38:33'),
(19, '2020-06-25', 1, 6, 3, '2020-06-04 08:38:36', '2020-06-04 08:38:36'),
(20, '2020-06-18', 1, 6, 3, '2020-06-04 08:38:40', '2020-06-04 08:38:40'),
(21, '2020-06-20', 1, 6, 4, '2020-06-04 08:38:44', '2020-06-04 08:38:44'),
(22, '2020-06-21', 1, 6, 5, '2020-06-04 08:38:46', '2020-06-04 08:38:46'),
(23, '2020-06-23', 1, 6, 3, '2020-06-04 08:38:49', '2020-06-04 08:38:49'),
(24, '2020-07-02', 1, 6, 4, '2020-06-04 08:38:54', '2020-06-04 08:38:54'),
(25, '2020-07-09', 1, 6, 3, '2020-06-04 08:39:02', '2020-06-04 08:39:02'),
(26, '2020-06-27', 1, 6, 3, '2020-06-04 08:39:05', '2020-06-04 08:39:05'),
(27, '2020-06-16', 1, 7, 5, '2020-06-04 08:42:33', '2020-06-04 08:42:33'),
(28, '2020-06-26', 1, 7, 5, '2020-06-04 08:42:36', '2020-06-04 08:42:36'),
(29, '2020-06-12', 1, 7, 5, '2020-06-04 08:42:42', '2020-06-04 08:42:42'),
(30, '2020-06-19', 1, 7, 4, '2020-06-04 08:42:47', '2020-06-04 08:42:47'),
(31, '2020-06-24', 1, 8, 5, '2020-06-04 08:44:00', '2020-06-04 08:44:00'),
(32, '2020-06-10', 1, 8, 5, '2020-06-04 08:44:05', '2020-06-04 08:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `session_user`
--

CREATE TABLE `session_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `note` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session_user`
--

INSERT INTO `session_user` (`id`, `user_id`, `session_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, '2020-06-03 19:20:58', '2020-06-03 19:20:58'),
(2, 3, 5, 18, NULL, NULL),
(3, 72, 8, NULL, '2020-06-04 08:47:28', '2020-06-04 08:47:28'),
(4, 72, 10, NULL, '2020-06-04 08:47:36', '2020-06-04 08:47:36'),
(5, 72, 13, NULL, '2020-06-04 08:47:49', '2020-06-04 08:47:49'),
(6, 72, 1, NULL, '2020-06-04 08:47:59', '2020-06-04 08:47:59'),
(7, 72, 5, 12, '2020-06-04 08:48:05', '2020-06-04 08:48:05'),
(8, 72, 12, NULL, '2020-06-04 08:48:16', '2020-06-04 08:48:16'),
(9, 72, 6, NULL, '2020-06-04 08:48:22', '2020-06-04 08:48:22'),
(10, 72, 9, NULL, '2020-06-04 08:48:28', '2020-06-04 08:48:28'),
(11, 72, 14, NULL, '2020-06-04 08:48:45', '2020-06-04 08:48:45'),
(12, 72, 16, NULL, '2020-06-04 08:48:51', '2020-06-04 08:48:51'),
(13, 72, 15, NULL, '2020-06-04 08:48:59', '2020-06-04 08:48:59'),
(14, 72, 26, NULL, '2020-06-04 08:49:03', '2020-06-04 08:49:03'),
(15, 72, 25, NULL, '2020-06-04 08:49:08', '2020-06-04 08:49:08'),
(16, 75, 32, NULL, '2020-06-04 08:49:49', '2020-06-04 08:49:49'),
(17, 75, 31, NULL, '2020-06-04 08:49:53', '2020-06-04 08:49:53'),
(18, 75, 29, NULL, '2020-06-04 08:50:01', '2020-06-04 08:50:01'),
(19, 75, 27, NULL, '2020-06-04 08:50:05', '2020-06-04 08:50:05'),
(20, 75, 30, NULL, '2020-06-04 08:50:09', '2020-06-04 08:50:09'),
(21, 75, 28, NULL, '2020-06-04 08:50:13', '2020-06-04 08:50:13'),
(22, 75, 16, NULL, '2020-06-04 08:50:23', '2020-06-04 08:50:23'),
(23, 75, 14, NULL, '2020-06-04 08:50:27', '2020-06-04 08:50:27'),
(24, 75, 23, NULL, '2020-06-04 08:50:32', '2020-06-04 08:50:32'),
(25, 75, 22, NULL, '2020-06-04 08:50:36', '2020-06-04 08:50:36'),
(26, 75, 26, NULL, '2020-06-04 08:50:41', '2020-06-04 08:50:41'),
(27, 75, 24, NULL, '2020-06-04 08:50:45', '2020-06-04 08:50:45'),
(28, 75, 25, NULL, '2020-06-04 08:50:50', '2020-06-04 08:50:50'),
(29, 75, 1, NULL, '2020-06-04 08:50:59', '2020-06-04 08:50:59'),
(30, 80, 32, NULL, '2020-06-04 08:51:16', '2020-06-04 08:51:16'),
(31, 80, 31, NULL, '2020-06-04 08:51:20', '2020-06-04 08:51:20'),
(32, 80, 28, NULL, '2020-06-04 08:51:29', '2020-06-04 08:51:29'),
(33, 80, 14, NULL, '2020-06-04 08:51:37', '2020-06-04 08:51:37'),
(34, 80, 26, NULL, '2020-06-04 08:51:42', '2020-06-04 08:51:42'),
(35, 80, 25, NULL, '2020-06-04 08:51:47', '2020-06-04 08:51:47'),
(36, 80, 13, NULL, '2020-06-04 08:51:55', '2020-06-04 08:51:55'),
(37, 80, 6, NULL, '2020-06-04 08:52:03', '2020-06-04 08:52:03'),
(38, 80, 8, NULL, '2020-06-04 08:52:07', '2020-06-04 08:52:07'),
(39, 80, 10, NULL, '2020-06-04 08:52:11', '2020-06-04 08:52:11'),
(40, 80, 2, NULL, '2020-06-04 08:55:02', '2020-06-04 08:55:02'),
(41, 80, 1, NULL, '2020-06-04 08:55:14', '2020-06-04 08:55:14'),
(42, 80, 5, 16, '2020-06-04 08:55:20', '2020-06-04 08:55:20'),
(43, 81, 32, NULL, '2020-06-04 09:49:48', '2020-06-04 09:49:48'),
(44, 81, 28, NULL, '2020-06-04 09:49:59', '2020-06-04 09:49:59'),
(45, 81, 16, NULL, '2020-06-04 09:50:09', '2020-06-04 09:50:09'),
(46, 81, 14, NULL, '2020-06-04 09:50:13', '2020-06-04 09:50:13'),
(47, 81, 26, NULL, '2020-06-04 09:50:19', '2020-06-04 09:50:19'),
(48, 81, 25, NULL, '2020-06-04 09:50:26', '2020-06-04 09:50:26'),
(49, 83, 32, NULL, '2020-06-04 09:51:26', '2020-06-04 09:51:26'),
(50, 83, 27, NULL, '2020-06-04 09:51:35', '2020-06-04 09:51:35'),
(51, 83, 16, NULL, '2020-06-04 09:51:45', '2020-06-04 09:51:45'),
(52, 83, 13, NULL, '2020-06-04 09:51:54', '2020-06-04 09:51:54'),
(53, 83, 6, NULL, '2020-06-04 09:52:03', '2020-06-04 09:52:03'),
(54, 83, 8, NULL, '2020-06-04 09:52:08', '2020-06-04 09:52:08'),
(55, 83, 1, NULL, '2020-06-04 09:52:21', '2020-06-04 09:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `verified`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Thérèse Behem', 'admin@gmail.com', 'admin', 1, NULL, '$2y$10$O5Fxi1SdJB9sEbgHrbIjHe4nDl2ZZxSg1yBEu6LQHFBweJuaYbO9S', NULL, '2020-06-03 18:00:06', '2020-06-03 18:00:06'),
(2, 'Maëva Pasteur', 'maeva.pasteur.pro@gmail.com', 'teacher', 1, NULL, '$2y$10$tCOAwqP7xhtqI98SgnboWO6gdIn0UDsDkdjZ8zlFUOeCpA1V5RE6q', NULL, '2020-06-03 18:35:58', '2020-06-03 18:35:58'),
(3, 'Julie Bravole', 'julie@gmail.com', 'student', 1, NULL, '$2y$10$L3umly5H5qCJ8k4n4G0H3O.TugE3XHj4cN3C/fSoP.GR/zC0ygt3q', NULL, '2020-06-03 19:20:36', '2020-06-03 19:20:36'),
(44, 'Misael Wunsch', 'mohamed.gulgowski@example.com', 'teacher', 0, '2020-06-04 08:10:44', '$2y$10$sexaLwFRDMAViQi.rmRK4OKn03w6RxQKyUoDRaQwGN3WBayRvBM0K', 'Al2mBQKlR1', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(45, 'Mr. Abner Hickle PhD', 'fahey.felipe@example.com', 'teacher', 0, '2020-06-04 08:10:44', '$2y$10$Yy4Vxvz/DDQ79n8c3CNNPeqWsHax00sqVAYr6PAMuACGUzr4BjZ62', 'KuWyqaYhfw', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(46, 'Darrick Krajcik', 'marty.muller@example.org', 'teacher', 0, '2020-06-04 08:10:44', '$2y$10$MZPu4sl2068xDxFNThfbjewZXMZXj3Df4AffuPJbU0O2MkE.orozy', 'jzED2PeUhowQsdzG8FN11B6mtIukh2BSONCtjh1JG31BnzEZIEbZWZ26dffc', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(47, 'Reilly Dietrich', 'jevon74@example.net', 'teacher', 0, '2020-06-04 08:10:44', '$2y$10$/bjafXzZ/3uWg7BwCyyWvOenhfQ1hlmwaLpoGkV68NKLHEIRm1iUa', 'qUlCLcQ29B', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(48, 'Naomi Huel', 'wunsch.myles@example.com', 'teacher', 0, '2020-06-04 08:10:44', '$2y$10$GzfAW27BoXXpxF5RXxhdr.W8CN54fimTeGyhICLxOkhbGzxzKhahu', 'RXlU5cBbn4', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(49, 'Cordell Beatty', 'elwin11@example.org', 'teacher', 0, '2020-06-04 08:10:45', '$2y$10$9hLdlOrmX9rd9wute83IkuFQt.e1gDcZwUmH/5H00600wBS32HFVm', 'Pj4Ir44Efc', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(50, 'Gilberto Larkin', 'ebednar@example.net', 'teacher', 0, '2020-06-04 08:10:45', '$2y$10$VENua8uaJNZmPNnn3hA1JONOXP.Drgq7P0thP5KZBtAyILNNdcvx6', '5kKX1r0J3j', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(51, 'Barton Purdy', 'ava49@example.net', 'teacher', 0, '2020-06-04 08:10:45', '$2y$10$KdesLlB0Rzm6kStRH50CtOlVyMWPwhBLuP17D396UV6CakO0xehuK', 'DanDPLVx2b', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(52, 'Howard Beier', 'lavern14@example.net', 'teacher', 0, '2020-06-04 08:10:45', '$2y$10$1RuZnVsA3EQVRXDZIZw.au28p9v0lDr3BzRwjlD/LloIw/QtymBmm', 'JAXYfOZuBz', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(53, 'Janice Dooley', 'spencer.norbert@example.net', 'teacher', 0, '2020-06-04 08:10:45', '$2y$10$JQ9NKhlJV1nToezLfOG08Ogz3xOiWbjLpBRwCQm7DBlo.iDRgQ3..', '8Q4GqNUW1y', '2020-06-04 08:10:45', '2020-06-04 08:10:45'),
(54, 'Jermaine Murray', 'hayley17@example.net', 'teacher', 1, '2020-06-04 08:11:49', '$2y$10$1KZdLSA8jF1AXuJZgN697.JIOm1ghRxkE7nX6NqQmjmAcv2Q3g/wW', 'kYBKeg5SXi', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(55, 'Mr. Tremaine Kutch', 'rbailey@example.org', 'teacher', 1, '2020-06-04 08:11:49', '$2y$10$CplFw3PwRU8UtxBIGv5BZevdTEZqN1wOCnAsDNRHU9380kv/tEbNC', 'OdbG2vlHQn', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(56, 'Connor Kovacek', 'alycia.hand@example.org', 'teacher', 1, '2020-06-04 08:11:50', '$2y$10$OeuTx6mieVnBU/RCTvmN/OFMzvaEHPKAGKKM3GCfU2lR0zzy9VQN2', '1nRYLCWjhU', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(57, 'Stephanie Bartoletti', 'rutherford.nicklaus@example.org', 'teacher', 1, '2020-06-04 08:11:50', '$2y$10$wgTrqMEPmA0kxbXmjlhjE.FtWLMiuo0vjMXrln40I0zfDqRbLaNom', 'jRiDnWEiGZUJInfDNiYSX0oW7k6t8LM9c9W5G26p2X0YfszCjyVDFusJn5P0', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(58, 'Malika Johnson', 'brook.schaefer@example.com', 'teacher', 1, '2020-06-04 08:11:50', '$2y$10$2dWXbcir.r2q9LgglCtIWu6yh6sVwrN87nI9Om07ZRuHhc7yJkzcC', '269UMp2gTl', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(59, 'Annamarie Pagac', 'nikolaus.edyth@example.com', 'teacher', 1, '2020-06-04 08:11:50', '$2y$10$jRlAy7qqg9hou98Pa8iDvObdohBFsn6TgbdvguX3aPwCqcmK7k1Ai', '0uuBViDxQZ', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(60, 'Bettye Eichmann', 'haleigh.walsh@example.com', 'teacher', 1, '2020-06-04 08:11:50', '$2y$10$46d48Jr8QDaEFpQy9eN64O4amcMPOUEQTsoDHuYCov0nKBkbod6DC', 'kCCFwaC612', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(61, 'Prof. Abraham Hayes', 'alexane65@example.com', 'teacher', 1, '2020-06-04 08:11:51', '$2y$10$r81CnrPXtZuCd7uGRqRqWuTDem2s6tqj0YKZHg/jU3UTfJVQ9jruO', '5taFju3i5o', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(62, 'Antone Monahan Jr.', 'lonnie.eichmann@example.org', 'teacher', 1, '2020-06-04 08:11:51', '$2y$10$RNmxiZzJwsFdEKuS1weAQ.H1J0tI0U4BzI2rpLCwYzC37SJlGc4Q6', '6IfSEWqGxL', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(63, 'Madaline Larkin', 'inolan@example.com', 'teacher', 1, '2020-06-04 08:11:51', '$2y$10$O8UA.kgM9N28SW5Kp0gWE.7JxPMrOvNB8vaEgf4mfjorLOF0rwlPK', '88j5FumZ7sqlrIeBBl4TGhakqu04ladn752QS6SBMPZmLbwJSqG64SCD5YiZ', '2020-06-04 08:11:51', '2020-06-04 08:11:51'),
(64, 'Dr. Jayme Hyatt IV', 'hilton10@example.net', 'student', 1, '2020-06-04 08:44:25', '$2y$10$b3JJ3IyPFmDFScV.jEnKGu0bA1muE3ezy/a.gzSagFG7s7givKvXy', '6FcEcKhvFz', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(65, 'Seth Rice', 'corbin.homenick@example.net', 'student', 1, '2020-06-04 08:44:25', '$2y$10$txgNlERnG/6GFKarUGjTnebKAyNVZ43vSYRxHHXNSdlQS.dCWPt7.', 'WwZCRNIgYe', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(66, 'Prof. Alford Sauer II', 'maximus31@example.com', 'student', 1, '2020-06-04 08:44:25', '$2y$10$RYEmucv6YTBJWYkTBF8L7.Ei3Bij8j3e59FACPg2A7YQGoaSnS1be', 'fEHhpHb5A2', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(67, 'Emmie Kunze', 'edythe13@example.org', 'student', 1, '2020-06-04 08:44:25', '$2y$10$znHCcAUXK2ZvuOLGwBZDu.UezbKNj9myodm4wDPNQ9ayrymsNECMu', 'MXyQQHvyDS', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(68, 'Eden Purdy', 'keyon.braun@example.net', 'student', 1, '2020-06-04 08:44:25', '$2y$10$RxGZZpkkgpm66tNHgqohD.ITInkEhO1gSKyctSWv.DthSd.DZZQQK', 'DwswSZuNmr', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(69, 'Dr. Ian Koss Sr.', 'kilback.iva@example.org', 'student', 1, '2020-06-04 08:44:26', '$2y$10$OJA4581NI4NrIAidShVPl.9UYnB.t1PhqIOJ4U9h4ttRD52MiHYl6', 'gc1RPhjTKj', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(70, 'Nick Eichmann Sr.', 'heidi.wolff@example.com', 'student', 1, '2020-06-04 08:44:26', '$2y$10$Jx4vpMZGxiPL0V9SjjD81OxpFCzZknQ7Atu9EuHxLZbMCcWcWCKjS', 'z8jeEDZpa0', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(71, 'Prof. Jacklyn Lind DVM', 'wolff.dawn@example.com', 'student', 1, '2020-06-04 08:44:26', '$2y$10$gCE7ei2FyM98wWPgDcg8neAllLzrliuzbpSIiG7AKVQzGIB4ZINt.', 'UZkDfRZn2C', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(72, 'Prof. Trycia Lemke', 'marcellus20@example.com', 'student', 1, '2020-06-04 08:44:26', '$2y$10$PBMJeJvS6e1Jq9qq.AZxyOptYlPZTgA.IO8POi1NjNZFC84UhR206', '9hXjKKft2Bf18yzz6HkiMWOgDPiZcPzOM7LtS3b5UpmYbVdUKOcFgYWrBhG6', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(73, 'Fletcher Lakin', 'mallory.kohler@example.com', 'student', 1, '2020-06-04 08:44:26', '$2y$10$viwYCfLd1s/JFZ5uVEm3FeMBceSXlxKDDr/.Rt8VzYnjPIbxcnCxy', 'Nx6fNQQ37o', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(74, 'Ms. Deanna Hickle V', 'yromaguera@example.net', 'student', 1, '2020-06-04 08:44:26', '$2y$10$xsCwYWSLS8fpOK55L912KempPPS8zTJ89g.C7N72grsVZi0dkqWH.', 'gYCINkr2W3', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(75, 'Buford Wuckert', 'ohamill@example.org', 'student', 1, '2020-06-04 08:44:27', '$2y$10$ob2Uy2ejzKTAerM4s..KpOjjyAiaB/pom1FyemFtda0ParojrLEuO', 'uz1DS4lu5N0C9DWGU82ZuXWn2XQEk6zpyiJWRyjEE6k3hmklPhBm29Ht69ht', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(76, 'Albert McLaughlin', 'beatty.vito@example.com', 'student', 1, '2020-06-04 08:44:27', '$2y$10$Y6qi8HB3fGTeHDZ5dCjFF.bzTpBhnobZ4iCPf0tvEgHR1K2XKSVSm', 'yrmoew4hFn', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(77, 'Jena Kuhn PhD', 'dare.dominique@example.net', 'student', 1, '2020-06-04 08:44:27', '$2y$10$Me8i.1wyfaBSueAO7eDTPeH2mCiK5/HP1Kr14.Yb0t0GYTlr0xLZe', 'Udas2i1CME', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(78, 'John Brown', 'francesca.bogan@example.org', 'student', 1, '2020-06-04 08:44:27', '$2y$10$baRiz5vRqlHh9bWechEHy.dgNI4S4Vf1NFnN7PsZNM6sgbvK7THtu', 'MuYyERq6XZ', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(79, 'Mertie Bins', 'rhiannon23@example.org', 'student', 1, '2020-06-04 08:44:27', '$2y$10$QzBbyYXpDxwykDvejKQPx.NW7HRo8xV7BKkyrXfIMCJ585zLahFiC', 'xXCGNCq8GE', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(80, 'Marge Farrell', 'jmarks@example.net', 'student', 1, '2020-06-04 08:44:28', '$2y$10$MqG2FEiAzjzFEhiemfykNusnW7oCbw5WQNj0iOVBMbq7kVpbPF2ga', 'DBbqM1oh5ZCVAHDRjECZEhGfNLIeTeLeDJgs9EQLnLMm2xsWTtC1Wfwz2OMx', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(81, 'Prof. Nicolas Koch DDS', 'donnell.botsford@example.net', 'student', 1, '2020-06-04 08:44:28', '$2y$10$vch18sGPgGFx6VnhBOaE6.FdpiPdx0fWC7Y93Cf8I6qAqG3N6/Uhe', 'f0HVw57puJk6aHyntQaCjJPYrIgYOzX4NJgMbLM6OF9gU6Uu3tnCfN2GuxfW', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(82, 'Dr. Braeden Orn III', 'janelle16@example.net', 'student', 1, '2020-06-04 08:44:28', '$2y$10$toLsjIlZI/3V5JFu/1VRZOWaDDh7QexNDnI/Gp.omlagrCGjTGGCS', '3Y99xaFzQS', '2020-06-04 08:44:28', '2020-06-04 08:44:28'),
(83, 'Mrs. Romaine Corkery III', 'richard71@example.com', 'student', 1, '2020-06-04 08:44:28', '$2y$10$u7aax4bicn4GxEnZ4l38eeaIXoytbfQ55ShBGbZdoBVHjm694/jwO', 'Rkp9YiAGhryWlK2qjacWHLDmm3BgfSZVGdzWaqFgS3QoNGrpiqauTqtHWPPd', '2020-06-04 08:44:28', '2020-06-04 08:44:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_formation`
--
ALTER TABLE `category_formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formations_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_formation_id_foreign` (`formation_id`),
  ADD KEY `sessions_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `session_user`
--
ALTER TABLE `session_user`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category_formation`
--
ALTER TABLE `category_formation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `session_user`
--
ALTER TABLE `session_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `sessions_formation_id_foreign` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
