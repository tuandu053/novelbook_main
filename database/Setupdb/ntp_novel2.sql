-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 22, 2024 lúc 04:58 AM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ntp_novel2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblauthor`
--

DROP TABLE IF EXISTS `tblauthor`;
CREATE TABLE IF NOT EXISTS `tblauthor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sNickName` int NOT NULL,
  `sDes` int NOT NULL,
  `iStatus` int NOT NULL,
  `sCommit` int NOT NULL,
  `dCreateDay` int NOT NULL,
  `dUpdateDay` int NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `sBankAccountNumber` varchar(30) NOT NULL,
  `sBank` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblAuthor_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblbill`
--

DROP TABLE IF EXISTS `tblbill`;
CREATE TABLE IF NOT EXISTS `tblbill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iMoney` int NOT NULL,
  `iCoint` int NOT NULL,
  `dCreateDay` datetime NOT NULL,
  `dUpdateDay` datetime NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblBill_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblbookmarks`
--

DROP TABLE IF EXISTS `tblbookmarks`;
CREATE TABLE IF NOT EXISTS `tblbookmarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dCreateDay` datetime NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `idNovel` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblBookmarks_tblUser` (`idUser`),
  KEY `FK_tblBookmarks_tblNovel` (`idNovel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcategories`
--

DROP TABLE IF EXISTS `tblcategories`;
CREATE TABLE IF NOT EXISTS `tblcategories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sCategories` text NOT NULL,
  `sDes` text NOT NULL,
  `iStatus` int NOT NULL,
  `dCreateDay` timestamp NULL DEFAULT NULL,
  `dUpdateDay` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcategories`
--

INSERT INTO `tblcategories` (`id`, `sCategories`, `sDes`, `iStatus`, `dCreateDay`, `dUpdateDay`) VALUES
(1, 'Kinh dị', 'Phim kinh dị thường khám phá chủ đề đen tối và có thể liên quan đến các đề tài xúc phạm. Những yếu tố rộng bao gồm quái vật, sự kiện khải huyền và tín ngưỡnaaaag tôn giáo hoặc dân gian. Những kádasdaỹ thuật làm phim 111', 1, NULL, '2024-06-22 04:47:45'),
(2, 'phong', 'có j đâu', 1, '2024-06-19 22:33:49', '2024-06-21 20:47:53'),
(3, 'Kinh dịa3', 'You may occasionally wish to not validate a given field if another field has a given value. You may accomplish this using the exclude_if validation rule. In this example, the appointment_date and doctor_name fields will not be validated if the has_appointment field has a value of false:', 1, '2024-06-19 22:36:45', '2024-06-21 20:37:51'),
(5, 'phong ád', 'ádasdas', 0, '2024-06-19 22:39:42', '2024-06-19 22:39:42'),
(6, 'Trinh thám', 'trinh thám', 1, '2024-06-19 22:44:20', '2024-06-19 22:44:20'),
(7, 'Truyện 18+ 123', 'truyện 18+ 123', 1, '2024-06-19 22:47:29', '2024-06-19 23:42:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblchapter`
--

DROP TABLE IF EXISTS `tblchapter`;
CREATE TABLE IF NOT EXISTS `tblchapter` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sChapter` varchar(255) NOT NULL,
  `iChapterNumber` int NOT NULL,
  `sContent` longtext NOT NULL,
  `dCreateDay` datetime DEFAULT NULL,
  `dUpdateDay` datetime DEFAULT NULL,
  `iPublishingStatus` int NOT NULL,
  `iStatus` int NOT NULL,
  `idNovel` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblChapter_tblNovel` (`idNovel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblclassify`
--

DROP TABLE IF EXISTS `tblclassify`;
CREATE TABLE IF NOT EXISTS `tblclassify` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idNovel` int UNSIGNED NOT NULL,
  `idCategories` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblClassify_tblCategories` (`idCategories`),
  KEY `FK_tblClassify_tblNovel` (`idNovel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcomment`
--

DROP TABLE IF EXISTS `tblcomment`;
CREATE TABLE IF NOT EXISTS `tblcomment` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sContent` varchar(500) NOT NULL,
  `sPoint` int NOT NULL,
  `dCreateDay` datetime DEFAULT NULL,
  `dUpdateDay` datetime DEFAULT NULL,
  `iDisplay` int NOT NULL,
  `iPosition` int NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `idChapter` int UNSIGNED NOT NULL,
  `id_Comment_parent` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblComment_tblUser` (`idUser`),
  KEY `FK_tblComment_tblComment` (`id_Comment_parent`),
  KEY `FK_tblComment_tblChapter` (`idChapter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnovel`
--

DROP TABLE IF EXISTS `tblnovel`;
CREATE TABLE IF NOT EXISTS `tblnovel` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sNovel` varchar(255) NOT NULL,
  `sCover` varchar(1000) DEFAULT NULL,
  `sDes` text,
  `dCreateDay` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `dUpdateDay` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sProgress` int NOT NULL,
  `iStatus` int NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblNovel_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpurchase_history`
--

DROP TABLE IF EXISTS `tblpurchase_history`;
CREATE TABLE IF NOT EXISTS `tblpurchase_history` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idChapter` int UNSIGNED NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `dCreateDay` datetime NOT NULL,
  `dUpdateDay` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblPurchase_History_tblChapter` (`idChapter`),
  KEY `FK_tblPurchase_History_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblreading_history`
--

DROP TABLE IF EXISTS `tblreading_history`;
CREATE TABLE IF NOT EXISTS `tblreading_history` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idChapter` int UNSIGNED NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `dCreateDay` datetime DEFAULT NULL,
  `dUpdateDay` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblReading_History_tblChapter` (`idChapter`),
  KEY `FK_tblReading_History_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblreport`
--

DROP TABLE IF EXISTS `tblreport`;
CREATE TABLE IF NOT EXISTS `tblreport` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sContent` varchar(3000) NOT NULL,
  `sReply` varchar(3000) DEFAULT NULL,
  `iStatus` int NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `dCreateDay` datetime DEFAULT NULL,
  `dUpdateDay` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblReport_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblwithdraw`
--

DROP TABLE IF EXISTS `tblwithdraw`;
CREATE TABLE IF NOT EXISTS `tblwithdraw` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `iCoint` int UNSIGNED NOT NULL,
  `idUser` int UNSIGNED NOT NULL,
  `dCreateDay` datetime DEFAULT NULL,
  `dUpdateDay` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblWithdraw_tblUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sRole` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sAdress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dBirthday` date DEFAULT NULL,
  `sGender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sAvatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sSetup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iCoint` int DEFAULT NULL,
  `iStatus` int DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `sRole`, `remember_token`, `created_at`, `updated_at`, `sAdress`, `dBirthday`, `sGender`, `sAvatar`, `sSetup`, `iCoint`, `iStatus`) VALUES
(1, 'Phạm Tuấn Phong', 'phamtuanphong170902@gmail.com', NULL, '$2y$10$YkTEkRAvWTxzPy4y14FYy.mouhXobVy90OIF0mwliG4FymczthYmK', 'admin', 'S3d7pQbDNUqmYhy0PYaToPB73cRPvmrIVq721UONofdxtvJ0wpvB4vSnPYGb', '2024-06-06 02:27:45', '2024-06-22 04:49:46', '603 ngọc hồi, Thanh Trì hà Nội', '2002-09-17', 'Nam', NULL, NULL, NULL, 1),
(2, 'Mochi Mochi', 'mochimochipo1122@gmail.com', NULL, '$2y$10$8UxpJuUJm3.vSevG3trF8O/XUyd1jIJI7wT1MpCzSjd.WQbTuDTH6', 'user', '824xTsTnZ7wYIq3iwn8dWqfiERsLDPXqM1KxWSNiqbyXFJ6NwPbEI97590Uj', '2024-06-06 02:40:12', '2024-06-19 07:19:59', NULL, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tblauthor`
--
ALTER TABLE `tblauthor`
  ADD CONSTRAINT `FK_tblAuthor_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblbill`
--
ALTER TABLE `tblbill`
  ADD CONSTRAINT `FK_tblBill_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblbookmarks`
--
ALTER TABLE `tblbookmarks`
  ADD CONSTRAINT `FK_tblBookmarks_tblNovel` FOREIGN KEY (`idNovel`) REFERENCES `tblnovel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_tblBookmarks_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblchapter`
--
ALTER TABLE `tblchapter`
  ADD CONSTRAINT `FK_tblChapter_tblNovel` FOREIGN KEY (`idNovel`) REFERENCES `tblnovel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblclassify`
--
ALTER TABLE `tblclassify`
  ADD CONSTRAINT `FK_tblClassify_tblCategories` FOREIGN KEY (`idCategories`) REFERENCES `tblcategories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_tblClassify_tblNovel` FOREIGN KEY (`idNovel`) REFERENCES `tblnovel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblcomment`
--
ALTER TABLE `tblcomment`
  ADD CONSTRAINT `FK_tblComment_tblChapter` FOREIGN KEY (`idChapter`) REFERENCES `tblchapter` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_tblComment_tblComment` FOREIGN KEY (`id_Comment_parent`) REFERENCES `tblcomment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_tblComment_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblnovel`
--
ALTER TABLE `tblnovel`
  ADD CONSTRAINT `FK_tblNovel_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblpurchase_history`
--
ALTER TABLE `tblpurchase_history`
  ADD CONSTRAINT `FK_tblPurchase_History_tblChapter` FOREIGN KEY (`idChapter`) REFERENCES `tblchapter` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_tblPurchase_History_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblreading_history`
--
ALTER TABLE `tblreading_history`
  ADD CONSTRAINT `FK_tblReading_History_tblChapter` FOREIGN KEY (`idChapter`) REFERENCES `tblchapter` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_tblReading_History_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblreport`
--
ALTER TABLE `tblreport`
  ADD CONSTRAINT `FK_tblReport_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tblwithdraw`
--
ALTER TABLE `tblwithdraw`
  ADD CONSTRAINT `FK_tblWithdraw_tblUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
