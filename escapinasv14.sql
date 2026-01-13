-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2026 at 04:39 PM
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
-- Database: `escapinas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_emails`
--

CREATE TABLE `admin_emails` (
  `id` int(11) NOT NULL,
  `mail_id` int(11) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `is_unread` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_emails`
--

INSERT INTO `admin_emails` (`id`, `mail_id`, `sender_name`, `subject`, `body`, `date_received`, `is_unread`, `created_at`) VALUES
(1, 14, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"2tf8h9_-OmiVGBSpyTOcDw\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"2tf8h9_-OmiVGBSpyTOcDw\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1768227748107?rfn%3D20%26rfnc%3D1%26eid%3D4315484118953071154%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">App password created to sign in to your account </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">If you didn\'t generate this password for imap2, someone might be using your account. Check and secure your account now.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1768227748107?rfn%3D20%26rfnc%3D1%26eid%3D4315484118953071154%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-12 15:22:28', 1, '2026-01-13 15:31:48'),
(2, 13, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"M4uLW273Mys4ucBvQzND3Q\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"M4uLW273Mys4ucBvQzND3Q\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1768227272101?rfn%3D20%26rfnc%3D1%26eid%3D-3101536938818137294%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">App password created to sign in to your account </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">If you didn\'t generate this password for imap, someone might be using your account. Check and secure your account now.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1768227272101?rfn%3D20%26rfnc%3D1%26eid%3D-3101536938818137294%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-12 15:14:32', 1, '2026-01-13 15:31:58'),
(3, 12, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"omK7UVxHAt-t0dd1GhyyNg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"omK7UVxHAt-t0dd1GhyyNg\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767928237284?rfn%3D20%26rfnc%3D1%26eid%3D5368367389749033992%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">App password created to sign in to your account </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">If you didn\'t generate this password for escapinas, someone might be using your account. Check and secure your account now.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767928237284?rfn%3D20%26rfnc%3D1%26eid%3D5368367389749033992%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-09 04:10:37', 1, '2026-01-13 15:32:09'),
(4, 11, 'Google', '2-Step Verification turned on', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"sdOmzs8vXg3kND6qcFFc8g\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"sdOmzs8vXg3kND6qcFFc8g\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/signinoptions/two-step-verification?rfn%3D17%26rfnc%3D1%26eid%3D327623952009563087%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">2-Step Verification turned on </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\"><p>Your Google Account escapinas26@gmail.com is now protected with 2-Step Verification. When you sign in on a new or untrusted device, you’ll need your second factor to verify your identity.</p><p><b>Don\'t get locked out!</b><br>You can add a backup phone or get backup codes to use when you don’t have your second factor with you.</p>You can <a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/signinoptions/two-step-verification?rfn%3D17%26rfnc%3D1%26eid%3D327623952009563087%26et%3D0\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">review your 2SV settings</a>  to make changes.</div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-08 18:02:46', 1, '2026-01-13 15:32:19'),
(6, 10, 'Google', '2-Step Verification turned off', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"gYrSoSdsE_HGBnqW4Bf8jg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"gYrSoSdsE_HGBnqW4Bf8jg\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767890118470?rfn%3D18%26rfnc%3D1%26eid%3D-3727744501360712156%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">2-Step Verification turned off </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">Your Google Account is no longer protected with 2-Step Verification. You don’t need your second factor to sign in.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767890118470?rfn%3D18%26rfnc%3D1%26eid%3D-3727744501360712156%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-08 17:35:18', 1, '2026-01-13 15:32:29'),
(8, 9, 'CONDES, ALTHEA JADE GOMEZ', 'Welcome to EscaPinas! Terms & Conditions', '<div dir=\"ltr\"><p>Dear Valued Customer,</p><p>Welcome to <b>EscaPinas</b>! We are thrilled to have you join our community of travelers<sup></sup>. Our mission is to provide you with the most seamless and memorable adventures while exploring the heart of the Philippines<sup></sup>.</p><div></div><p>Please find our official <b><a href=\"https://drive.google.com/file/d/1DaAu8gJzXEN5X0TixURZ4_PhilGBb00N/view?usp=sharing\" target=\"_blank\">Terms &amp; Conditions</a></b> outlined below for your reference<sup></sup>. By using our booking services, you acknowledge that you have read and agreed to these terms<sup></sup>.</p><div></div><p><b>Key Policies to Remember:</b></p><ul><li style=\"margin-left:15px\"><p></p><p><span id=\"m_2200749639079252311gmail-docs-internal-guid-01176a32-7fff-b7bf-412e-9cee30be5ddf\"><span style=\"font-size:9pt;font-family:Poppins,sans-serif;color:rgb(56,118,29);background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"> </span><span style=\"font-size:10pt;font-family:Poppins,sans-serif;color:rgb(56,118,29);background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\">Booking Agreement</span></span></p><div></div></li><li style=\"margin-left:15px\"><p><span style=\"font-size:10pt;font-family:Poppins,sans-serif;color:rgb(56,118,29);background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\">Payment Terms</span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-size:10pt;font-family:Poppins,sans-serif;color:rgb(56,118,29);background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\">Cancellation &amp; Refunds</span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-size:10pt;font-family:Poppins,sans-serif;color:rgb(56,118,29);background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"><span style=\"font-size:10pt;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;background-color:transparent;vertical-align:baseline\">Weather Disruptions</span><span style=\"font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;background-color:transparent;font-size:9pt;vertical-align:baseline\">  </span><span style=\"font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;background-color:transparent;font-size:9pt;color:rgb(255,0,0);vertical-align:baseline\">// di pa final</span></span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-family:Poppins,sans-serif;background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"><span id=\"m_2200749639079252311gmail-docs-internal-guid-ae869cbc-7fff-e262-2376-f361b17b3fbf\" style=\"color:rgb(56,118,29);font-size:10pt;font-weight:normal\"><span style=\"font-size:10pt;background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\">Conduct &amp; Safety</span></span></span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-family:Poppins,sans-serif;background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"><span style=\"color:rgb(56,118,29);font-size:13.3333px\">Environmental Policy</span></span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-family:Poppins,sans-serif;background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"><span id=\"m_2200749639079252311gmail-docs-internal-guid-fdef7b44-7fff-7208-aebe-0294b710abbd\" style=\"font-weight:normal\"><span style=\"font-size:10pt;color:rgb(56,118,29);background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\">Media Usage</span></span></span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-family:Poppins,sans-serif;background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"><span style=\"color:rgb(56,118,29);font-size:13.3333px\">Liability Limitation</span></span></p></li><li style=\"margin-left:15px\"><p><span style=\"font-family:Poppins,sans-serif;background-color:transparent;font-weight:700;font-variant-numeric:normal;font-variant-east-asian:normal;font-variant-alternates:normal;vertical-align:baseline\"><span style=\"color:rgb(56,118,29);font-size:13.3333px\">Policy Updates</span></span></p></li></ul><p>We can’t wait to see you on your next escape!</p><p>Warm regards,</p><p></p><p><b>The EscaPinas Team</b> </p><p><sup></sup><i>Sa Byahe, Kami ang Kasama</i></p></div>\r\n', '2026-01-08 09:20:25', 1, '2026-01-13 15:32:39'),
(10, 8, 'Margarette Marcelino', 'Re: Booking Confirmed - Ref: ESC-2026-9479BE', '<div dir=\"ltr\">helloooooooooo</div><br><div class=\"gmail_quote gmail_quote_container\"><div dir=\"ltr\" class=\"gmail_attr\">On Wed, Jan 7, 2026 at 10:55 PM EscaPinas Tours &lt;<a href=\"mailto:escapinas26@gmail.com\">escapinas26@gmail.com</a>&gt; wrote:<br></div><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\">\r\n            <div style=\"font-family:Arial,sans-serif;padding:20px;border:1px solid rgb(238,238,238)\">\r\n                <h2 style=\"color:rgb(25,135,84)\">Booking Confirmed!</h2>\r\n                <p>Hi Margarette,</p>\r\n                <p>Your booking for <b>Baguio-Sagada Tour</b> has been confirmed.</p>\r\n                <p><b>Reference No:</b> ESC-2026-9479BE</p>\r\n            </div>\r\n\r\n</blockquote></div>\r\n', '2026-01-07 15:56:10', 0, '2026-01-13 15:32:50'),
(12, 7, 'Mail Delivery Subsystem', 'Delivery Status Notification (Failure)', '\r\n<html>\r\n<head>\r\n<style>\r\n* {\r\nfont-family:Roboto, \"Helvetica Neue\", Helvetica, Arial, sans-serif;\r\n}\r\n</style>\r\n</head>\r\n<body>\r\n<table cellpadding=\"0\" cellspacing=\"0\" class=\"email-wrapper\" style=\"padding-top:32px;background-color:#ffffff;\"><tbody>\r\n<tr><td>\r\n<table cellpadding=0 cellspacing=0><tbody>\r\n<tr><td style=\"max-width:560px;padding:24px 24px 32px;background-color:#fafafa;border:1px solid #e0e0e0;border-radius:2px\">\r\n<img style=\"padding:0 24px 16px 0;float:left\" width=72 height=72 alt=\"Error Icon\" src=\"cid:icon.png\">\r\n<table style=\"min-width:272px;padding-top:8px\"><tbody>\r\n<tr><td><h2 style=\"font-size:20px;color:#212121;font-weight:bold;margin:0\">\r\nAddress not found\r\n</h2></td></tr>\r\n<tr><td style=\"padding-top:20px;color:#757575;font-size:16px;font-weight:normal;text-align:left\">\r\nYour message wasn\'t delivered to <a style=\'color:#212121;text-decoration:none\'><b>ellen@example.com</b></a> because the domain example.com couldn\'t be found. Check for typos or unnecessary spaces and try again.\r\n</td></tr>\r\n<tr><td style=\"padding-top:24px;color:#4285F4;font-size:14px;font-weight:bold;text-align:left\">\r\n<a style=\"text-decoration:none\" href=\"https://www.rfc-editor.org/info/rfc7505\">LEARN MORE</a>\r\n</td></tr>\r\n<tr><td style=\"margin-top:8px;font-style:italic;font-size:12px;color:#757575\">\r\n<img style=\"padding:0 4 0 0;float:left\" width=12 height=12 alt=\"Warning\" src=\"cid:warning_triangle.png\">\r\nThis link will take you to a third-party site\r\n</td></tr>\r\n</tbody></table>\r\n</td></tr>\r\n</tbody></table>\r\n</td></tr>\r\n<tr style=\"border:none;background-color:#fff;font-size:12.8px;width:90%\">\r\n<td align=\"left\" style=\"padding:48px 10px\">\r\nThe response was:<br/>\r\n<p style=\"font-family:monospace\">\r\nDNS Error: DNS type \'mx\' lookup of example.com responded with code NOERROR\r\nThe domain example.com doesn\'t receive email according to the administrator: returned Null MX. For more information, go to https://www.rfc-editor.org/info/rfc7505\r\n</p>\r\n</td>\r\n</tr>\r\n</tbody></table>\r\n</body>\r\n</html>\r\nDKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed;\r\n        d=gmail.com; s=20230601; t=1767753969; x=1768358769; darn=example.com;\r\n        h=content-transfer-encoding:mime-version:message-id:subject:reply-to\r\n         :to:date:from:from:to:cc:subject:date:message-id:reply-to;\r\n        bh=senViIMz3vLviEQ8R6rhzZ3CISEYIGDS8JX7SnP7b9Q=;\r\n        b=O/UltNLDHdIxO1ddS8K9UglWYV56Eai7eK5GkZASx+dUfw2vpCbl0RMzBGj+QbYyrr\r\n         CWkl75xX+Ddj2kvfkOyqpaZWaNelyAJ63mM5PbHtHQopR/KE4Mj5Ega7DqS0h56EaKJp\r\n         4ideoM6cW5FTdGyJ6d8Hwalzwo6zrcJvkNAGrmIi75bFOgnSu/5qltCPPfPy0Uxy2ANp\r\n         HXDtDbsHBYXi/oiaFZ4k+PSKmlAYyxeHPEbm5ew9Ikgwtg2P7BemVCeHbtaDd+qBb/vt\r\n         mumaYCwEeQlVEMBajaR1eFZKgkFCZVQjHJADucy1IerlsWQiqzTc6iOxjqXx4y92C9B/\r\n         /36g==\r\nX-Google-DKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed;\r\n        d=1e100.net; s=20230601; t=1767753969; x=1768358769;\r\n        h=content-transfer-encoding:mime-version:message-id:subject:reply-to\r\n         :to:date:from:x-gm-gg:x-gm-message-state:from:to:cc:subject:date\r\n         :message-id:reply-to;\r\n        bh=senViIMz3vLviEQ8R6rhzZ3CISEYIGDS8JX7SnP7b9Q=;\r\n        b=bkhKqOBowwBZvGothOm/B/0fJB0gvKMyFedmsV6S1FduHbEiOVIPL2DnxBqA9a+gmr\r\n         KCgsDm8c5XGW9CeuXlzy0uCVi2kCgOeZFHMrMl9ckX370JvpZ6eEsttp8WS+hCkABcWa\r\n         2E6fodmgztLxGjqXfV3m1JX0dNQQdjecgFlMiSueyJz4wa4UtyRvDVvo2+mfjUuF2ued\r\n         sqINmYwsikx1NDuMQDK84vMg8gATgbWHFkYsAP3kywNPEamiryMeAhZntsCm6LCTxEnx\r\n         R2Y5ab/oEjejRnD8Iimiy9Rx5XlX0+x6SrN8RGWalwEzvwK/OCsak1bZHCQjf1cc+DUA\r\n         Gn/w==\r\nX-Forwarded-Encrypted: i=1; AJvYcCXaWIl51hbzslCwB98tPN3EF05cEZshOhY6MylHZ8rmvHZJNnlZqqP/AUGlamKPGU+uiB1XkA==@example.com\r\nX-Gm-Message-State: AOJu0YxiUX+hC9vODiwjSmyWPLO2dzT9d4cjB6WBPEIG83o7A10IYnfl\r\n	2ffY/F8UJDUqlu9kdeGTVokzsHVM9+dlVk9Bb6d33Wqlwy14ZRed9QhL\r\nX-Gm-Gg: AY/fxX7MOAhNA0Mui/Y0d+z+a2CP+eomd0/U3VfHCC79OXQeI1jVZRimE9te2rkxI2X\r\n	/GHWx2HCMod5J6RE6VgmHuuw+r69vIVcpmkXB4jj1AbHO5jASOwjWpahUeHMBWkSYKejIx9nFv7\r\n	6bYCC7rda9e6te/mWNiAFsOnl4yK1cFZgkdV6OmRwZtIXLI4Ff8diqZWmUShaJH17V4cNf1f3kF\r\n	km+lIRmhVMCAJTf2ONjW+HFgOXSWMm6v+NYEjXpRCPZkeF8p9thBTmXcdQJ02XeE43i8ujpEKFY\r\n	/cyPtqkMQ2oZlyaeMcSstaqt23bHJWNUDtqQl4Y4sHrr79tqBJwG/jdXTESM8gicRay+jubPP8U\r\n	hg/EAjObisDpgnbEggLk+RID7ZZeIL4aJfEcFK/mVyTh8gzxZB6ENGi9cnkWtMZPUs0Fg3QtbCS\r\n	CWVc+Yio/S+aOWiA==\r\nX-Google-Smtp-Source: AGHT+IHlVR3kAhdrVMn9ttsCeS4jKSBWIxojDrFS1Gpkl80bUR0PWUlJgCqd2tUjPrbI6N2aJQgfzQ==\r\nX-Received: by 2002:a05:6a21:32a5:b0:334:8759:5016 with SMTP id adf61e73a8af0-3898f9518damr995064637.28.1767753968960;\r\n        Tue, 06 Jan 2026 18:46:08 -0800 (PST)\r\nReturn-Path: <escapinas26@gmail.com>\r\nReceived: from localhost ([136.158.65.117])\r\n        by smtp.gmail.com with ESMTPSA id 41be03b00d2f7-c4cc8d292fcsm3489395a12.20.2026.01.06.18.46.07\r\n        (version=TLS1_3 cipher=TLS_AES_256_GCM_SHA384 bits=256/256);\r\n        Tue, 06 Jan 2026 18:46:08 -0800 (PST)\r\nFrom: Test <escapinas26@gmail.com>\r\nX-Google-Original-From: Test <from@example.com>\r\nDate: Wed, 7 Jan 2026 03:46:04 +0100\r\nTo: Joe User <jhondrei062@gmail.com>, ellen@example.com\r\nReply-To: Information <info@example.com>\r\nSubject: Test\r\nMessage-ID: <Wh5RW01wAv4AxJ8xTjJVwwlMvVLKY2aRNWvAk3rGY@localhost>\r\nX-Mailer: PHPMailer 7.0.1 (https://github.com/PHPMailer/PHPMailer)\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative;\r\n boundary=\"b1=_Wh5RW01wAv4AxJ8xTjJVwwlMvVLKY2aRNWvAk3rGY\"\r\nContent-Transfer-Encoding: 8bit\r\n\r\n', '2026-01-07 03:46:09', 1, '2026-01-13 15:33:19'),
(14, 6, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"64_pHH7uFxp58DYq_VLEhQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"64_pHH7uFxp58DYq_VLEhQ\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767753911498?rfn%3D20%26rfnc%3D1%26eid%3D-5527432160088389979%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">App password created to sign in to your account </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">If you didn\'t generate this password for escapinas, someone might be using your account. Check and secure your account now.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767753911498?rfn%3D20%26rfnc%3D1%26eid%3D-5527432160088389979%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-07 03:45:11', 1, '2026-01-13 15:33:32'),
(17, 5, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"t0homiPCVsg5t_qV7RP0kQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"t0homiPCVsg5t_qV7RP0kQ\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767689678837?rfn%3D20%26rfnc%3D1%26eid%3D-5893459041666982467%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">App password created to sign in to your account </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">If you didn\'t generate this password for Escapinas, someone might be using your account. Check and secure your account now.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767689678837?rfn%3D20%26rfnc%3D1%26eid%3D-5893459041666982467%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2025 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-06 09:54:38', 1, '2026-01-13 15:33:42');
INSERT INTO `admin_emails` (`id`, `mail_id`, `sender_name`, `subject`, `body`, `date_received`, `is_unread`, `created_at`) VALUES
(18, 4, 'Google', '2-Step Verification turned on', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"9gDGYOASMNtp-fKvAX2USw\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"9gDGYOASMNtp-fKvAX2USw\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/signinoptions/two-step-verification?rfn%3D16%26rfnc%3D1%26eid%3D6804466105124898493%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">2-Step Verification turned on </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\"><p>Your Google Account escapinas26@gmail.com is now protected with 2-Step Verification. When you sign in on a new or untrusted device, you’ll need your second factor to verify your identity.</p><p><b>Don\'t get locked out!</b><br>You can add a backup phone or get backup codes to use when you don’t have your second factor with you.</p>You can <a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/signinoptions/two-step-verification?rfn%3D16%26rfnc%3D1%26eid%3D6804466105124898493%26et%3D0\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">review your 2SV settings</a>  to make changes.</div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-06 09:54:19', 1, '2026-01-13 15:33:53'),
(19, 3, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"jVcmCwnPPuAFhjtxLhVfFg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"jVcmCwnPPuAFhjtxLhVfFg\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767689600098?rfn%3D252%26rfnc%3D1%26eid%3D2064132684134718414%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Authenticator app added as sign-in step </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocJ856TmMTG8pLMvCWigTJ6mPBZoiJqgR2_1_0eRkyRF4diWzxk=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">If you didn\'t add the Authenticator app, someone might be using your account. Check and secure your account now.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767689600098?rfn%3D252%26rfnc%3D1%26eid%3D2064132684134718414%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-06 09:53:20', 1, '2026-01-13 15:34:04'),
(20, 2, 'Google', 'Security alert', '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"dKplOHUNXKCVw6AT8I_N9Q\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\" nonce=\"dKplOHUNXKCVw6AT8I_N9Q\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767669539000?rfn%3D127%26rfnc%3D1%26eid%3D7606504713697060504%26et%3D0\"/><meta itemprop=\"name\" content=\"Review Activity\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">You allowed Microsoft apps &amp; services access to some of your Google Account data </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://lh3.googleusercontent.com/a/ACg8ocIjbRf0IFkM0Fw7QuLGz2u6-DQTX5dQx4MGsc5IkDBDGRKecA=s96-c\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">escapinas26@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\"><br><p>If you didn’t allow Microsoft apps &amp; services access to some of your Google Account data, someone else may be trying to access your Google Account data.</p><p>Take a moment now to check your account activity and secure your account.</p><div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1767669539000?rfn%3D127%26rfnc%3D1%26eid%3D7606504713697060504%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans Flex&#39;,&#39;Google Sans Text&#39;,&#39;Google Sans&#39;,&#39;Noto Sans&#39;,Arial,Helvetica,sans-serif; line-height: 16px; color: #ffffff; font-weight: 500; text-decoration: none; font-size: 14px;display:inline-block;padding: 12px 24px;background-color: #0b57d0; border-radius: 9999px; min-width: 64px;\">Check activity</a></div><div style=\"padding-top: 40px;\"><div style=\"border-bottom: thin solid #dadce0; padding-bottom: 24px;\">To make changes at any time to the access that Microsoft apps &amp; services has to your data, go to your <a href=\"https://accounts.google.com/AccountChooser?Email=escapinas26@gmail.com&amp;continue=https://myaccount.google.com/connections/overview/ARxY5h8VXcCSMI7lh9ndhen-ouGVfvWlNW3Fa_DJOk3sza1UXO8xyVITqcmDOPUtS8gMm6aF6c25jHVjQiemxsT6gAg?utm_source%3Dsec_alert%26utm_medium%3Demail_notification%26force_all%3Dtrue\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">Google Account</a></div></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">You can also see security activity at<br><a href=\"https://myaccount.google.com/notifications\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>You received this email to let you know about important changes to your Google Account and services.</div><div style=\"direction: ltr;\">&copy; 2026 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '2026-01-06 04:18:59', 1, '2026-01-13 15:34:15'),
(22, 1, 'Google', '✅ Finish setting up your new Google Account on your Infinix SMART 5', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=http://www.w3.org/1999/xhtml xmlns:v=urn:schemas-microsoft-com:vml xmlns:o=urn:schemas-microsoft-com:office:office lang=en>\r\n<head>\r\n<title>Get started on your new device</title>\r\n<meta name=x-apple-disable-message-reformatting>\r\n<meta http-equiv=X-UA-Compatible>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=UTF-8\">\r\n<meta name=viewport content=\"initial-scale = 1.0,maximum-scale = 1.0\" />\r\n<meta name=viewport content=target-densitydpi=device-dpi />\r\n<link href=https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i rel=stylesheet>\r\n<link href=https://fonts.googleapis.com/css?family=Google+Sans+Text:400,500,700 rel=stylesheet />\r\n<style>\r\n.mobile_only{display:none; font-size:0px; line-height:0px; height:0px; max-height:0px; overflow:hidden;}\r\n</style>\r\n<style>\r\n@media screen and (max-width:900px){\r\n.desktop_only_new {\r\ndisplay:none !important;\r\nfont-size:0px !important;\r\nline-height:0 !important;\r\nheight:0px !important;\r\nmax-height:0px !important;\r\noverflow:hidden !important;\r\n}\r\n.mobile_only_new {\r\nheight: auto !important;\r\noverflow: visible !important;\r\ndisplay: block !important;\r\nmax-height: inherit !important;\r\nwidth: 100% !important;\r\nfont-size:inherit !important;\r\nline-height:inherit !important;\r\n}\r\n.headline{\r\n}\r\n.subheadline{\r\n}\r\n.footer_main{padding-bottom:0px !important;}\r\n.main_table{width:95% !important;}\r\n.desktop_cell{display:none !important;}\r\n.mobile_cell{display:table-cell !important; width:100% !important;}\r\n}\r\n</style>\r\n<style>\r\n@media screen and (max-width: 767px) {\r\n.body{margin:0px !important; padding:0px !important; background:#fff !important;}\r\n.desktop{display:none !important;}\r\n.mobile{display:inline-block !important; width:100% !important;}\r\nimg.mobile{display:inline-block !important; width:100% !important;}\r\n}\r\n</style>\r\n<style>\r\n@media screen and (max-width: 767px) {\r\ntable, tr, td{width:100% !important; min-width:100% !important; max-width:100% !important; border-spacing: 0px; padding: 0px; margin: 0px; background-size:100% !important;}\r\n.width_100{width:100% !important; min-width:100% !important; max-width:100% !important; border: 0px; padding: 0px; margin: 0px; line-height:0px; font-size:0px;}\r\n.footer_main{padding: 0 10px !important;}\r\n.subhead_cls{padding:0px 20px 10px 20px !important;}\r\n.pad_lr_10{padding:0 10px !important;}\r\n.micon{padding-left: 10px !important;}\r\n.headline{\r\npadding-top: 15px !important;\r\npadding-left: 10px !important;\r\npadding-bottom: 3px !important;\r\npadding-left: 15px !important;\r\n}\r\n.subheadline{\r\npadding-top: 0px !important;\r\npadding-left: 10px !important;\r\npadding-bottom: 7px !important;\r\npadding-left: 15px !important;\r\n}\r\n.rating{padding-left: 15px !important;}\r\n.rate{padding-left: 15px !important; padding-bottom: 15px !important;}\r\n.cta_button{padding-left: 15px !important; padding-right: 15px !important; padding-bottom: 15px !important;}\r\n}\r\n</style>\r\n<style>\r\n@media screen and (max-width: 767px) and (orientation: landscape){\r\n.table_container{width:360px !important; min-width:360px !important; max-width:360px !important;}\r\n.table_container, .main_table{min-width: 360px !important; width: 360px !important; max-width: 360px !important;}\r\n}\r\n</style>\r\n<style>\r\n@media screen and (min-width: 812px) and (max-width: 812px),\r\nscreen and (min-width: 736px) and (max-width: 736px),\r\nscreen and (min-width: 667px) and (max-width: 667px),\r\nscreen and (min-width: 568px) and (max-width: 568px),\r\nscreen and (min-width: 414px) and (max-width: 414px),\r\nscreen and (min-width: 375px) and (max-width: 375px),\r\nscreen and (min-width: 320px) and (max-width: 320px) {\r\n.body {\r\nmin-width: 100vw !important;\r\n}\r\n}\r\n</style>\r\n<style>\r\n.subhead_cls {padding: 0px 44px 10px 44px !important;}\r\n</style>\r\n<style>\r\n.footer_anchor a{\r\ncolor: #9AA0A6 !important;\r\n}\r\n</style>\r\n<style>\r\n:root {\r\ncolor-scheme: light dark;\r\nsupported-color-schemes: light dark;\r\n}\r\n@media (prefers-color-scheme: dark ) {\r\n/* Custom Dark Mode Font Colors */\r\ntd, span, h1, h2, h3, h4, h5, h6, h7, p, div {\r\ncolor: #ffffff !important;}\r\ndiv, table, td {}\r\nbody { background-color: #3C4043 !important; }\r\na {color: #1A73E8 !important;}\r\n.body_wrapper {background-color: #3C4043 !important; }\r\ntable.dark_mode_class, td.head_cls, td.subhead_cls{\r\nbackground-color: #3c4043 !important;\r\n}\r\nbody { background-color: #000 !important; }\r\ntd.dark_mode_class{\r\nbackground-color: #3c4043 !important;\r\n}\r\ntd.main_table{\r\nbackground-color: #000 !important;\r\n}\r\ntd.main_table > table {\r\nbackground: #000 !important;\r\n}\r\ntable.footer_dark_bg {\r\nbackground: #000 !important;\r\n}\r\ntable.footer_dark_bg .footer_main{\r\nbackground: #000 !important;\r\n}\r\ntable.footer_dark_bg .footer_main > table{\r\nbackground: #000 !important;\r\n}\r\ntd.footer_texts.footer_address {\r\nbackground: #000 !important;\r\n}\r\ntable.table_dark_bg {\r\nbackground: #000 !important;\r\n}\r\n.footer_anchor a{\r\ncolor: #fff !important;\r\n}\r\n}\r\n</style>\r\n<style>\r\n@media screen and (min-width:481px) and (max-width: 950px) and (orientation: landscape) {\r\n.table_container, .main_table {width:100% !important; max-width:100% !important;}\r\ntable, td {\r\nwidth:100% !important; max-width:100% !important;\r\n}\r\ntable{\r\nmin-width: 100% !important;\r\n}\r\n.main_table {padding: 0px 8px !important;}\r\n}\r\n/* Landscape for iPhone */\r\n@media only screen and (min-width: 480px)and (max-width: 948px) {\r\ntable, td {\r\nwidth:100% !important; max-width:100% !important;\r\n}\r\ntable{\r\nmin-width: 100% !important;\r\n}\r\n.main_table {padding: 0px 8px !important;}\r\n}\r\n</style>\r\n<!--[if mso]>\r\n<style>\r\nhtml, body, table, tr, td, div{\r\nfont-family: Arial, sans-serif !important;\r\n}\r\n</style>\r\n<![endif]-->\r\n<!--[if gte mso 9]>\r\n<xml>\r\n<o:OfficeDocumentSettings>\r\n<o:AllowPNG/>\r\n<o:PixelsPerInch>96</o:PixelsPerInch>\r\n</o:OfficeDocumentSettings>\r\n</xml>\r\n<![endif]-->\r\n</head>\r\n<body style=\"color:#444444; font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial; font-size:14px; font-weight:normal; margin:0; padding:0; \" class=\"body \">\r\n<div style=\"display:none; font-size:1px; color:#333333; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;\">Finish setting up your device with Google</div>\r\n<div style=\"font-size: 0px; line-height:0px; display: none; max-height: 0px; overflow: hidden;\">\r\n&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;\r\n</div><div style=\"font-size: 0px; line-height:0px; color: #ffffff; display: none;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>\r\n<section>\r\n<center class=wrapper_app style=\"width:100%; margin:4px auto 0 auto;\">\r\n<!--[if gte mso 9]> <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"width:600px; margin:0; padding:0; table-layout:fixed; \">\r\n<![endif]-->\r\n<!--[if !mso]><!-- --> <table role=presentation border=0 cellpadding=0 cellspacing=0 style=\"margin:0 auto; padding:0; table-layout:fixed; \">\r\n<![endif]--> <tr style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0;\">\r\n<td style=\"background:#ffffff;max-width:600px; padding: 0; margin: 0;width:600px;\" width=600 align=center bgcolor=#ffffff class=main_table>\r\n<table role=presentation class=table_container border=0 cellpadding=0 cellspacing=0 width=504 style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0; max-width:504px; width:504px; background-color:#ffffff;\">\r\n<tr border=0 style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0;\">\r\n<td align=\"\" valign=\"\" bgcolor=\"\" width=\"\" height=\"\" class=\"\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0; \">\r\n<table class=table_dark_bg role=presentation width=504 bgcolor=#ffffff border=0 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border-spacing: 0; padding:0; margin:0 auto; background:#ffffff; width:504px; min-width:504px;\" align=center>\r\n<tr>\r\n<td>\r\n<table class=dark_mode_class role=presentation cellspacing=0 cellpadding=0 width=502 style=\"width:502px; margin:0 auto; background: #F8FAFD; border-radius: 20px;\">\r\n<tr>\r\n<td width=100% style=\"width:100%; text-align:center; padding-top: 21px; padding-bottom: 10px; padding-left:44px; padding-right:44px;\" align=center valign=top>\r\n<img role=presentation src=https://www.gstatic.com/images/branding/googlelogo/1x/googlelogo_color_160x56dp.png width=88 style=\"width:88px; outline:0; border:0;\" />\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=head_cls style=\"padding-top:0px; padding-bottom:6px; width:100%; padding-left:15px; padding-right:15px; font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial; font-size: 22px; line-height: 28px; color: #202124; text-align:center; font-weight:500; background-color: #FFFFFF;direction:ltr; padding:10px 44px 0px 44px; font-size:26px; line-height:36px; font-weight:500;color:#1F1F1F;background-color: #F8FAFD;\" width=100% dir=ltr>Hi,</td>\r\n</tr>\r\n<tr>\r\n<td class=head_cls style=\"padding-top:0px; padding-bottom:6px; width:100%; padding-left:15px; padding-right:15px; font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial; font-size: 22px; line-height: 28px; color: #202124; text-align:center; font-weight:500; background-color: #FFFFFF;direction:ltr; padding:10px 44px 0px 44px; font-size:26px; line-height:36px; font-weight:500;color:#1F1F1F;background-color: #F8FAFD; padding:0px 44px 16px 44px;color:#1F1F1F;background-color: #F8FAFD;\" width=100% dir=ltr>A better Android experience<br class=desktop_only_new> is waiting</td>\r\n</tr>\r\n<tr>\r\n<td class=subhead_cls style=\"padding-top:0px; padding-bottom:20px; width:100%; font-weight:500; padding-left:35px; padding-right:35px; font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial; font-size: 18px; mso-line-height-rule: exactly; color:#202124; text-align:center; background-color: #FFFFFF; line-height:27px; direction:ltr; padding: 0px 44px 10px 44px; font-weight:normal;color:#444746;background-color: #F8FAFD;line-height:24px;font-size:16px;font-family: Google Sans Text, Google Sans, Roboto, San-Francisco, Helvetica, Arial;\" width=100% dir=ltr>Take one minute to set up your Infinix SMART 5<br class=desktop_only_new> with Google</td>\r\n</tr>\r\n<tr>\r\n<td style=\"-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;-ms-text-size-adjust: 100%;border-radius: 8px;direction:ltr;padding: 5px 0 30px 0; font-family: Google Sans Text, Google Sans, Roboto, San-Francisco, Helvetica, Arial;\" dir=ltr>\r\n<table role=presentation border=0 cellspacing=0 cellpadding=0 width=100%>\r\n<tr>\r\n<td>\r\n<table role=presentation border=0 cellspacing=0 cellpadding=0 align=center width=100%>\r\n<tr>\r\n<td style=\"text-align: center;padding: 0;\">\r\n<div>\r\n<!--[if mso]>\r\n<v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"https://c.gle/ANnMTcbnhleOBC40T_YKOEJ2dNHQ4YmMyWlRhtT8VIMdl_PgI2SWSBWKiA9Havd_YsPhIW-DwXj2vbezYxs5WHKR_uOTDwpKp-yt7CvKvWVFdGOOXJtHl6SZSp4PgY3AntEPmA_RTrUemy2AYV7aLQUx5Lnb7ll9zjQ7AhkUe7f3sllBwYY_E2mp0jSxmFnueGSx_eSOMR0f04Dziv-tGKQCUQDdAEq39LXPEeiG04gKvC_Vyz-rKGc0cR8xduGf02t2i-Qwy1P85plGqvZBP-HHR6aV0TBoWqBDoTNPVz3mWG-kYI96oGr0HIxW4VYezcgJAhGEAxsj9tAIQjYwpNMiE6Qbs1oFbBoXQjQq1OFRxcdPWRBZRoms-9UCWX6wGHwElwKJtRtr1wo-PoLfCmMCwNX55E-k9agsTDj7s9ri-bVjySAFUjL2-FpeOdrh38QlCkpBDlEPBSijA9VzxhQVzQtOagVPvPR4GKNjXJt59qzjZYUhCY27YS8D816P9ks9poDtfg9vkAmDfwWEKeNQcHTOW1tMVK1FZKwA6FDiJw2Mdd5FuuwTGeUph1ZTFVlgFpWlkKArM6oPLTHP-S5mLB3iVJXOJ03tSn9VfVZwF0JxBs_AeQos_abFuv9Bmmm0PfoRT0FJ0jKO1g\" style=\"height:50px; v-text-anchor:middle; width:120px;\" arcsize=\"50%\" strokecolor=\"#0B57D0\" fillcolor=\"#0B57D0\">\r\n<w:anchorlock/>\r\n<center style=\"color:#ffffff;font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial; font-size:16px; font-weight:normal; word-break:normal;direction:ltr;\" dir=\"ltr\">Get started</center>\r\n</v:roundrect>\r\n<a href=\"https://c.gle/ANnMTcbnhleOBC40T_YKOEJ2dNHQ4YmMyWlRhtT8VIMdl_PgI2SWSBWKiA9Havd_YsPhIW-DwXj2vbezYxs5WHKR_uOTDwpKp-yt7CvKvWVFdGOOXJtHl6SZSp4PgY3AntEPmA_RTrUemy2AYV7aLQUx5Lnb7ll9zjQ7AhkUe7f3sllBwYY_E2mp0jSxmFnueGSx_eSOMR0f04Dziv-tGKQCUQDdAEq39LXPEeiG04gKvC_Vyz-rKGc0cR8xduGf02t2i-Qwy1P85plGqvZBP-HHR6aV0TBoWqBDoTNPVz3mWG-kYI96oGr0HIxW4VYezcgJAhGEAxsj9tAIQjYwpNMiE6Qbs1oFbBoXQjQq1OFRxcdPWRBZRoms-9UCWX6wGHwElwKJtRtr1wo-PoLfCmMCwNX55E-k9agsTDj7s9ri-bVjySAFUjL2-FpeOdrh38QlCkpBDlEPBSijA9VzxhQVzQtOagVPvPR4GKNjXJt59qzjZYUhCY27YS8D816P9ks9poDtfg9vkAmDfwWEKeNQcHTOW1tMVK1FZKwA6FDiJw2Mdd5FuuwTGeUph1ZTFVlgFpWlkKArM6oPLTHP-S5mLB3iVJXOJ03tSn9VfVZwF0JxBs_AeQos_abFuv9Bmmm0PfoRT0FJ0jKO1g\" class=\"header_part btn_mod2_mobile2\" target=\"_blank\" style=\"background-color:#0B57D0; border-radius:100px;color:#ffffff;display:inline-block;font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial;font-size:14px;line-height:21px;text-decoration:none;padding: 7px 0px 7px 0px;-webkit-text-size-adjust:none;mso-hide:all;font-weight:500;text-align: center;word-break:normal;direction:ltr;width: 120px; font-family: Google Sans Text, Google Sans, Roboto, San-Francisco, Helvetica, Arial;\" dir=\"ltr\">Get started</a>\r\n<![endif]-->\r\n<!--[if !mso]><!-->\r\n<a href=https://c.gle/ANnMTcbnhleOBC40T_YKOEJ2dNHQ4YmMyWlRhtT8VIMdl_PgI2SWSBWKiA9Havd_YsPhIW-DwXj2vbezYxs5WHKR_uOTDwpKp-yt7CvKvWVFdGOOXJtHl6SZSp4PgY3AntEPmA_RTrUemy2AYV7aLQUx5Lnb7ll9zjQ7AhkUe7f3sllBwYY_E2mp0jSxmFnueGSx_eSOMR0f04Dziv-tGKQCUQDdAEq39LXPEeiG04gKvC_Vyz-rKGc0cR8xduGf02t2i-Qwy1P85plGqvZBP-HHR6aV0TBoWqBDoTNPVz3mWG-kYI96oGr0HIxW4VYezcgJAhGEAxsj9tAIQjYwpNMiE6Qbs1oFbBoXQjQq1OFRxcdPWRBZRoms-9UCWX6wGHwElwKJtRtr1wo-PoLfCmMCwNX55E-k9agsTDj7s9ri-bVjySAFUjL2-FpeOdrh38QlCkpBDlEPBSijA9VzxhQVzQtOagVPvPR4GKNjXJt59qzjZYUhCY27YS8D816P9ks9poDtfg9vkAmDfwWEKeNQcHTOW1tMVK1FZKwA6FDiJw2Mdd5FuuwTGeUph1ZTFVlgFpWlkKArM6oPLTHP-S5mLB3iVJXOJ03tSn9VfVZwF0JxBs_AeQos_abFuv9Bmmm0PfoRT0FJ0jKO1g target=_blank dir=ltr style=\"text-align: center; display: inline-block; text-decoration:none;\">\r\n<table role=presentation cellspacing=0 cellpadding=0 align=center>\r\n<tr style=\"padding: 0; margin: 0; font-size: 0; line-height: 0;\"><td style=\"border-top: 6px solid transparent; border-top-left-radius: 4px;border-top-right-radius: 4px;display:inline-block;-webkit-text-size-adjust:none;mso-hide:all;text-align: center;\"></td></tr>\r\n<tr><td style=\"background-color:#0B57D0;border-radius:100px;color:#ffffff;font-family:Google Sans, Roboto, San-Francisco, Helvetica, Arial; font-size:16px;line-height:24px;text-decoration:none;padding: 16px 24px 16px 24px;-webkit-text-size-adjust:none;mso-hide:all;font-weight:500;text-align: center;direction:ltr; font-family: Google Sans Text, Google Sans, Roboto, San-Francisco, Helvetica, Arial;\" class=\"header_part btn_mod2_mobile2\">Get started\r\n</td></tr>\r\n<tr style=\"padding: 0; margin: 0; font-size: 0; line-height: 0;\"><td style=\"border-top: 5px solid transparent; display:inline-block;border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;-webkit-text-size-adjust:none;mso-hide:all;text-align: center;\"></td></tr>\r\n</table></a>\r\n<!--<![endif]-->\r\n</div>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr border=0 style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0;\">\r\n<td align=\"\" valign=\"\" bgcolor=\"\" width=\"\" height=\"\" class=\"\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0; \">\r\n<table role=presentation border=0 cellspacing=0 cellpadding=0 width=100% height=20 style=\"width:100%; font-size:0; line-height:0; mso-line-height-rule:exactly; height:20px\">\r\n<tr>\r\n<td width=100% height=20 style=\"width:100%; font-size:0; line-height:0; mso-line-height-rule:exactly; height:20px\">&nbsp;</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr border=0 style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0;\">\r\n<td align=\"\" valign=\"\" bgcolor=\"\" width=\"\" height=\"\" class=\"\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0; \">\r\n<table role=presentation border=0 cellpadding=0 cellspacing=0 style=\"width:504px; background-color:#FFFFFF\" width=504 align=center>\r\n<tbody>\r\n<tr>\r\n<td align=center valign=\"\" bgcolor=FFFFFF width=\"\" height=\"\" class=footer_main style=\"border-collapse: collapse;border-spacing: 0;padding: 0;margin: 0;width: 504px; background-color: #FFFFFF;\">\r\n<table role=presentation border=0 cellpadding=0 cellspacing=0 style=\"width:504px; background-color:#FFFFFF\" width=504>\r\n<tbody>\r\n<tr>\r\n<td class=\"footer_texts footer_address footer_anchor\" style=\"word-break: normal;font-family:Roboto, San-Francisco, Helvetica, Arial; font-weight:normal; font-size:10px; line-height:16px; color:#9B9B9B; text-align:center; background-color:#FFFFFF; color:#5F6368; font-family: Roboto, San-Francisco, Helvetica, Arial; font-size:12px; line-height:18px;direction:ltr; padding:0px 5px 10px 5px; color: #9AA0A6;font-family:Google Sans Text, Google Sans, Roboto, San-Francisco, Helvetica, Arial;\" dir=ltr>This email was sent to <a href=mailto:escapinas26@gmail.com target=_blank style=\"color:#5F6368; text-decoration:none; font-weight:normal; border:0; ; white-space: nowrap;\"> escapinas26@gmail.com</a> because you created a Google Account on your <span style=\"white-space:nowrap; \" class=\"\">Infinix SMART 5</span> device. If you do not wish to receive emails to help you set up your device with Google when you sign into your account on the device for the first time, please <a href=https://c.gle/ANnMTcZaOX3cLNvCAoSxrFvKEnrBCEMFJJh2hriNGN2YsQyi5EkzvbtQTgHsgouEeiEtlfWP8cXmKofUNFGmyx8LhURBL7GwQjvB4Ra-J9Cnwecj1lXsNDPURsAlGUUpk0ytZhE_IuFezMSdKFJuXnUYHZFCyGdxigqKGGW876rdOUvnKdSumMi2dO5gPef1lSCOQUgbmVfzJBRqmYp92cafRQFqszJ68VhSqT0iYXrvIYru0X3MO0NkVPjZlhSm9pSrhgiqQIiaf4PCvCasfm5dYob_vFdBx8n8EbAJ7zYCgiq1d-7df88KkhNS3i_D1FtSi7CWW5U98DMmQ7mbyixbrUj69ZiWKN0-n2UgcZxPIEVJwjYfmx-DJZsIfC385xW3DMAwST879seQmF5A_H7xGSo_YYwzgb9VtTbhKSGBLz7WmVctOdSlfAQae1ABRuQvd6yefTkAsDyp6Roa-E8KghWww_LAJtwaI8MoGV4d-aEEvTPRyEXHy-6XV1CSqq-i-2ufyebwZ9WMsxrYyaxE4Mc2l10CaOr2KZdwgvNGdwHQLdcgNxK_zEzwbtCgaIRZUVG7 target=_blank style=\"color:#5F6368;text-decoration: underline; font-weight:normal; border:0; ; white-space: nowrap;\">unsubscribe</a>.</td>\r\n</tr>\r\n<tr>\r\n<td class=\"footer_texts footer_address\" style=\"font-family:Roboto, San-Francisco, Helvetica, Arial; font-weight:normal; font-size:10px; line-height:16px; color:#9B9B9B; text-align:center; padding: 0px 10px 32px 10px;background-color:#FFFFFF; font-size:12px; line-height:18px;color:#5F6368; color: #9AA0A6;font-family:Google Sans Text, Google Sans, Roboto, San-Francisco, Helvetica, Arial;\">\r\n<span style=\"font-size:inherit; color:inherit; font-weight:inherit; line-height:inherit; font-family:inherit;\">&copy; 2026 Google LLC 1600 Amphitheatre Parkway, Mountain View, CA 94043</span>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr border=0 style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0;\">\r\n<td align=\"\" valign=\"\" bgcolor=\"\" width=\"\" height=20 class=mobileRow style=\"border-collapse: collapse; border-spacing: 0; padding: 0; margin: 0; height:20px;\">\r\n&nbsp; </td>\r\n</tr>\r\n</table>\r\n</center>\r\n</section>\r\n</body>\r\n</html>', '2026-01-06 04:05:25', 1, '2026-01-13 15:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `number_of_persons` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled') DEFAULT NULL,
  `booking_reference` varchar(50) DEFAULT NULL,
  `tour_id` int(11) NOT NULL,
  `locpoints_id` int(11) DEFAULT NULL,
  `is_email_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `schedule_id`, `number_of_persons`, `total_amount`, `booking_status`, `booking_reference`, `tour_id`, `locpoints_id`, `is_email_sent`) VALUES
(14, 2, 1, 1, 11757.76, 'Confirmed', 'ESC-2026-5320CF', 1, 7, 0),
(15, 2, 1, 1, 12093.76, 'Confirmed', 'ESC-2026-495D62', 1, 7, 0),
(16, 2, 1, 1, 12877.76, 'Confirmed', 'ESC-2026-4138CD', 1, 7, 0),
(17, 2, 1, 1, 12877.76, 'Confirmed', 'ESC-2026-2CDA22', 1, 7, 0),
(18, 2, 1, 1, 12093.76, 'Confirmed', 'ESC-2026-069B39', 1, 7, 0),
(19, 2, 13, 1, 10077.76, 'Confirmed', 'ESC-2026-3E671E', 4, 1, 0),
(25, 15, 1, 1, 8957.76, 'Confirmed', 'ESC-2026-66DC76', 1, 2, 1),
(31, 15, 1, 1, 8957.76, 'Confirmed', 'ESC-2026-9479BE', 1, 1, 1),
(32, 33, 31, 1, 10973.76, 'Confirmed', 'ESC-2026-2D6027', 7, 7, 1),
(33, 1, 35, 1, 11993.76, 'Confirmed', 'ESC-2026-434C9C', 8, 7, 1),
(34, 1, 1, 1, 8947.76, 'Confirmed', 'ESC-2026-77157E', 1, 1, 1),
(36, 34, 1, 1, 7957.76, 'Confirmed', 'ESC-2026-E696E9', 1, 1, 1),
(37, 34, 2, 1, 7757.76, 'Confirmed', 'ESC-2026-D323D4', 1, 1, 1),
(38, 1, 1, 1, 5957.76, 'Confirmed', 'ESC-2026-E98B19', 1, 1, 1),
(39, 1, 38, 1, 10757.76, 'Confirmed', 'ESC-2026-1D716B', 9, 7, 1),
(40, 1, 28, 1, 10093.76, 'Confirmed', 'ESC-2026-0C9FAA', 6, 7, 1),
(41, 1, 20, 1, 6157.76, 'Confirmed', 'ESC-2026-53F55B', 5, 1, 1),
(42, 1, 28, 1, 12093.76, 'Confirmed', 'ESC-2026-49DB4E', 6, 7, 1),
(43, 1, 2, 1, 8957.76, 'Confirmed', 'ESC-2026-CBA723', 1, 1, 1),
(44, 1, 2, 1, 7957.76, 'Confirmed', 'ESC-2026-B25AFD', 1, 1, 1),
(45, 1, 35, 1, 12093.76, 'Confirmed', 'ESC-2026-3417C7', 8, 7, 1),
(46, 1, 44, 1, 11757.76, 'Confirmed', 'ESC-2026-FA6934', 11, 7, 1),
(47, 1, 36, 1, 12093.76, 'Confirmed', 'ESC-2026-C338ED', 8, 7, 1),
(48, 1, 29, 1, 12093.76, 'Confirmed', 'ESC-2026-C5EF84', 6, 7, 1),
(49, 1, 45, 1, 11757.76, 'Confirmed', 'ESC-2026-96D059', 11, 7, 1),
(50, 1, 17, 1, 6157.76, 'Confirmed', 'ESC-2026-5593B8', 5, 1, 0),
(51, 1, 2, 1, 8957.76, 'Confirmed', 'ESC-2026-9C9D76', 1, 1, 0),
(52, 1, 38, 1, 7837.76, 'Confirmed', 'ESC-2026-FC0BFA', 9, 5, 0),
(53, 1, 33, 1, 10973.76, 'Confirmed', 'ESC-2026-EE5F3C', 7, 7, 0),
(54, 1, 14, 1, 10077.76, 'Confirmed', 'ESC-2026-28FD3C', 4, 1, 0),
(55, 1, 18, 1, 6157.76, 'Confirmed', 'ESC-2026-7D2D4E', 5, 1, 0),
(56, 1, 44, 1, 11757.76, 'Confirmed', 'ESC-2026-2A5C45', 11, 7, 0),
(57, 1, 31, 1, 7837.76, 'Confirmed', 'ESC-2026-08952F', 7, 3, 0),
(58, 1, 45, 1, 11757.76, 'Confirmed', 'ESC-2026-4F1406', 11, 7, 1),
(59, 33, 28, 1, 8957.76, 'Confirmed', 'ESC-2026-81A316', 6, 3, 1),
(60, 47, 1, 1, 8957.76, 'Confirmed', 'ESC-2026-5AEF4C', 1, 1, 1),
(61, 47, 2, 1, 12093.76, 'Confirmed', 'ESC-2026-DBB24A', 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `island_id` int(11) DEFAULT NULL,
  `destination_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `island_id`, `destination_name`, `description`, `status`) VALUES
(1, 1, 'Baguio-Sagada', 'Cool mountains, culture, scenic views', 'Active'),
(2, 1, 'Ilocos', 'Spanish-era heritage and northern coast', 'Active'),
(3, 1, 'La Union', 'Surfing and relaxation', 'Active'),
(4, 1, 'Bicol', 'Volcanoes, island hopping', 'Active'),
(5, 1, 'Batangas-Tagaytay', 'Scenic lake and cool weather', 'Active'),
(6, 2, 'Cebu', 'History, waterfalls, marine adventures', 'Active'),
(7, 2, 'Bohol', 'Countryside tour highlighting natural wonders', 'Active'),
(8, 2, 'Boracay', 'World-famous beach destination with powdery sand', 'Active'),
(9, 3, 'Davao', 'City tour with parks, wildlife, and nature', 'Active'),
(10, 3, 'Siargao', 'Surfing paradise with lagoons and island hopping', 'Active'),
(11, 3, 'Cagayan de Oro', 'Adventure and thrill-seeker activities', 'Active'),
(12, 1, 'Palawan', 'Enjoy cold breeze and view of beaches', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_points`
--

CREATE TABLE `location_points` (
  `locpoints_id` int(11) NOT NULL,
  `origin_island` enum('Luzon','Visayas','Mindanao','Tours Requiring AirTravel') NOT NULL,
  `pickup_points` varchar(255) NOT NULL,
  `dropoff_points` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_points`
--

INSERT INTO `location_points` (`locpoints_id`, `origin_island`, `pickup_points`, `dropoff_points`) VALUES
(1, 'Luzon', 'Cubao', 'Cubao'),
(2, 'Luzon', 'Makati', 'Makati'),
(3, 'Visayas', 'Cebu City', 'Cebu City'),
(4, 'Visayas', 'Iloilo City', 'Iloilo City'),
(5, 'Mindanao', 'Davao City', 'Davao City'),
(6, 'Mindanao', 'Cagayan de Oro', 'Cagayan de Oro'),
(7, 'Tours Requiring AirTravel', 'NAIA (Manila)', 'NAIA (Manila)'),
(8, 'Tours Requiring AirTravel', 'Mactan–Cebu International Airport', 'Mactan–Cebu International Airport'),
(9, 'Tours Requiring AirTravel', 'Davao International Airport', 'Davao International Airport');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paypal_order_id` varchar(100) DEFAULT NULL,
  `paypal_capture_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) DEFAULT 'PHP',
  `payment_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `user_id`, `paypal_order_id`, `paypal_capture_id`, `amount`, `currency`, `payment_status`, `created_at`) VALUES
(1, 15, 2, '570938822N054872N', '67445019GT426520M', 12093.76, 'PHP', 'COMPLETED', '2026-01-03 17:56:36'),
(2, 16, 2, '6Y015898EE628501L', '8LS31742H2964741Y', 12877.76, 'PHP', 'COMPLETED', '2026-01-03 18:00:04'),
(3, 17, 2, '75C13504EW488981W', '0ES39912US562402T', 12877.76, 'PHP', 'COMPLETED', '2026-01-04 06:41:54'),
(4, 18, 2, '54X17031WM031863U', '21788592GX377091A', 12093.76, 'PHP', 'COMPLETED', '2026-01-04 13:41:20'),
(5, 19, 2, '19F07445YP624725V', '6WC93084JG702653U', 10077.76, 'PHP', 'COMPLETED', '2026-01-04 13:51:15'),
(11, 25, 15, '94299430H90201059', '1DA6960394736214K', 8957.76, 'PHP', 'COMPLETED', '2026-01-07 14:04:38'),
(17, 31, 15, '3E833286EE400774E', '04124545PP716503E', 8957.76, 'PHP', 'COMPLETED', '2026-01-07 14:55:21'),
(18, 32, 33, '2MK410639U299410L', '4NK407983C025891G', 10973.76, 'PHP', 'COMPLETED', '2026-01-07 19:49:06'),
(19, 33, 1, '3NA86753NU822631P', '1155051298888062P', 11993.76, 'PHP', 'COMPLETED', '2026-01-08 01:10:44'),
(20, 34, 1, '0CD763022S231792X', '6DB35557AH080664V', 8947.76, 'PHP', 'COMPLETED', '2026-01-08 11:19:35'),
(22, 36, 34, '2AA3253993105772K', '3EC462591P301241D', 7957.76, 'PHP', 'COMPLETED', '2026-01-08 12:32:30'),
(23, 37, 34, '90K76442XW022332R', '3KM45796PA5184159', 7757.76, 'PHP', 'COMPLETED', '2026-01-08 12:38:21'),
(24, 38, 1, '7M985831BU019432M', '52K550698W408711B', 5957.76, 'PHP', 'COMPLETED', '2026-01-08 15:30:38'),
(25, 39, 1, '93J67613HU310091L', '6U011968PX815710J', 10757.76, 'PHP', 'COMPLETED', '2026-01-08 15:37:37'),
(26, 40, 1, '5TG338777Y293393J', '8SB014175A386562F', 10093.76, 'PHP', 'COMPLETED', '2026-01-08 15:58:40'),
(27, 41, 1, '0M429888YB696761R', '96A61449X2186772E', 6157.76, 'PHP', 'COMPLETED', '2026-01-08 16:05:25'),
(28, 42, 1, '61828403H5647563G', '7N6194061D526091S', 12093.76, 'PHP', 'COMPLETED', '2026-01-08 16:11:32'),
(29, 43, 1, '4MA65926LG961760B', '7D684306H40729903', 8957.76, 'PHP', 'COMPLETED', '2026-01-08 16:15:08'),
(30, 44, 1, '43636005418783049', '03R598006K2662749', 7957.76, 'PHP', 'COMPLETED', '2026-01-08 16:59:07'),
(31, 45, 1, '4EV571869A775204P', '1PJ56195LP872501P', 12093.76, 'PHP', 'COMPLETED', '2026-01-08 17:03:47'),
(32, 46, 1, '22D788641A1876349', '3E0761276D610062B', 11757.76, 'PHP', 'COMPLETED', '2026-01-08 17:06:23'),
(33, 47, 1, '5FB32562AS172333J', '9NC37179WS157661A', 12093.76, 'PHP', 'COMPLETED', '2026-01-08 17:12:12'),
(34, 48, 1, '33832668C6773534P', '4UU64677NT4712041', 12093.76, 'PHP', 'COMPLETED', '2026-01-08 17:14:36'),
(35, 49, 1, '2AK068469R341653R', '99V064445A8481905', 11757.76, 'PHP', 'COMPLETED', '2026-01-09 02:14:33'),
(36, 50, 1, '5R669928N5834692E', '6CC30605YR7076304', 6157.76, 'PHP', 'COMPLETED', '2026-01-09 02:51:33'),
(37, 51, 1, '23419621T7537791R', '9T1495692X577572N', 8957.76, 'PHP', 'COMPLETED', '2026-01-09 03:03:05'),
(38, 52, 1, '6XB51837NU8791157', '76017425X2625611F', 7837.76, 'PHP', 'COMPLETED', '2026-01-09 03:04:15'),
(39, 53, 1, '3XB93404VD793430Y', '43B12126FM635163V', 10973.76, 'PHP', 'COMPLETED', '2026-01-09 03:12:14'),
(40, 54, 1, '84Y15209R89860839', '75354279TW746572A', 10077.76, 'PHP', 'COMPLETED', '2026-01-09 03:18:26'),
(41, 55, 1, '35N81828KN910104T', '9C3377259H285835V', 6157.76, 'PHP', 'COMPLETED', '2026-01-09 03:20:23'),
(42, 56, 1, '3YU74963ET777112M', '393612073X0038737', 11757.76, 'PHP', 'COMPLETED', '2026-01-09 03:22:42'),
(43, 57, 1, '2RR86722HN301372E', '6M463727LT993510F', 7837.76, 'PHP', 'COMPLETED', '2026-01-09 03:29:52'),
(44, 58, 1, '7J427565263665524', '47S9563212129260Y', 11757.76, 'PHP', 'COMPLETED', '2026-01-09 03:37:08'),
(45, 59, 33, '9DT10610V22053012', '9LB66479E32915357', 8957.76, 'PHP', 'COMPLETED', '2026-01-12 09:39:20'),
(46, 60, 47, '3PY52551SP8810420', '9XJ08100L5236000F', 8957.76, 'PHP', 'COMPLETED', '2026-01-13 13:40:37'),
(47, 61, 47, '09Y90363CJ785433D', '82C22034N6220642G', 12093.76, 'PHP', 'COMPLETED', '2026-01-13 13:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_dropoff`
--

CREATE TABLE `pickup_dropoff` (
  `location_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `location_name` varchar(150) DEFAULT NULL,
  `location_address` text DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `dropoff_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `review_text` varchar(255) DEFAULT NULL,
  `rating_score` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`review_id`, `user_id`, `tour_id`, `review_text`, `rating_score`) VALUES
(12, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 5),
(13, 1, 1, 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 4),
(14, 1, 2, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 5),
(15, 1, 2, 'Laboris nisi ut aliquip ex ea commodo consequat.', 5),
(16, 1, 3, 'Duis aute irure dolor in reprehenderit in voluptate velit.', 3),
(17, 1, 3, 'Esse cillum dolore eu fugiat nulla pariatur.', 4),
(18, 1, 4, 'Excepteur sint occaecat cupidatat non proident.', 4),
(19, 1, 10, 'Sunt in culpa qui officia deserunt mollit anim id est laborum.', 5),
(20, 1, 10, 'Lorem ipsum fresh surf vibes!', 5),
(21, 1, 10, 'Bit rainy but still good.', 4),
(23, 33, 7, '', 3),
(24, 1, 11, 'It was fun', 5);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `island_id` int(11) NOT NULL,
  `island_name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`island_id`, `island_name`, `description`) VALUES
(1, 'Luzon', 'Northern and central islands of the Philippines'),
(2, 'Visayas', 'Central islands of the Philippines'),
(3, 'Mindanao', 'Southern islands of the Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `region_fees`
--

CREATE TABLE `region_fees` (
  `fee_id` int(11) NOT NULL,
  `origin_island` enum('Luzon','Visayas','Mindanao') DEFAULT NULL,
  `destination_island` enum('Luzon','Visayas','Mindanao') DEFAULT NULL,
  `additional_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region_fees`
--

INSERT INTO `region_fees` (`fee_id`, `origin_island`, `destination_island`, `additional_fee`) VALUES
(1, 'Luzon', 'Luzon', 0.00),
(2, 'Luzon', 'Visayas', 2800.00),
(3, 'Luzon', 'Mindanao', 3500.00),
(4, 'Visayas', 'Visayas', 0.00),
(5, 'Visayas', 'Luzon', 2800.00),
(6, 'Visayas', 'Mindanao', 2200.00),
(7, 'Mindanao', 'Mindanao', 0.00),
(8, 'Mindanao', 'Luzon', 3500.00),
(9, 'Mindanao', 'Visayas', 2200.00);

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `sms_type` enum('OTP','Review') NOT NULL,
  `message_content` text NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `message_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_logs`
--

INSERT INTO `sms_logs` (`id`, `user_id`, `contact_num`, `sms_type`, `message_content`, `status`, `message_id`, `created_at`) VALUES
(6, 44, '09912676928', 'OTP', 'EscaPinas: Ang iyong code ay 682806. Valid ito sa loob ng 1 minuto.', 'sent', 'Q5yyKTGG10Ud1rCzypo1B', '2026-01-12 15:38:45'),
(7, 44, '09912676928', 'OTP', 'EscaPinas: Ang iyong bagong code ay 625879. Valid ito sa loob ng 1 minuto.', 'sent', '23gmY5uULZ6z-CTQdRDbW', '2026-01-12 15:39:50'),
(8, 44, '09912676928', 'OTP', 'EscaPinas: Ang iyong bagong code ay 883564. Valid ito sa loob ng 1 minuto.', 'sent', 'gwX1HflJYdcynTNQJGXXb', '2026-01-12 15:42:12'),
(9, 44, '09912676928', 'OTP', 'User successfully verified their account using OTP.', 'delivered', NULL, '2026-01-12 15:42:43'),
(14, 47, '09666935239', 'OTP', 'EscaPinas: Ang iyong code ay 179907. Valid ito sa loob ng 1 minuto.', 'sent', 'VT7JRbLvsRrnEfV81Zndu', '2026-01-13 04:12:42'),
(15, 47, '09666935239', 'OTP', 'User successfully verified their account using OTP.', 'delivered', NULL, '2026-01-13 04:13:10'),
(16, 49, '09666935239', 'OTP', 'EscaPinas: Ang iyong code ay 437600. Valid ito sa loob ng 1 minuto.', 'sent', 'UK7YZKLPu66qOdg8pBJ55', '2026-01-13 05:51:01'),
(17, 49, '09666935239', 'OTP', 'User successfully verified their account using OTP.', 'delivered', NULL, '2026-01-13 05:51:26'),
(20, 51, '09940551720', 'OTP', 'EscaPinas: Ang iyong code ay 719539. Valid ito sa loob ng 1 minuto.', 'sent', 'tv5JgHH2hx3rfMirmPFv6', '2026-01-13 07:30:08'),
(21, 51, '09940551720', 'OTP', 'User successfully verified their account using OTP.', 'delivered', NULL, '2026-01-13 07:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `tour_about`
--

CREATE TABLE `tour_about` (
  `about_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_about`
--

INSERT INTO `tour_about` (`about_id`, `tour_id`, `description`) VALUES
(1, 1, 'Experience the cool climate and rich culture of Baguio and Sagada. Explore scenic mountain views, historical landmarks, and local traditions. Enjoy adventure activities such as cave exploration and hanging coffins visits, combined with relaxing moments in Burnham Park. Perfect for nature lovers and culture enthusiasts.'),
(2, 2, 'Discover the Spanish-era heritage of Ilocos, including Vigan and Laoag. Walk along cobblestone streets, visit historic churches, and marvel at coastal landscapes. Taste local delicacies and experience traditional crafts. A mix of history, culture, and scenic views awaits every traveler.'),
(3, 3, 'Relax and unwind at the beautiful beaches of La Union. Learn surfing techniques or simply enjoy the laid-back atmosphere. Explore local temples, waterfalls, and hidden spots for a complete escape. This tour blends adventure and serenity for an unforgettable experience.'),
(4, 4, 'Embark on an adventure in Bicol, famous for its volcanoes and islands. Trek Mayon Volcano, visit Cagsawa Ruins, and swim with whale sharks in Donsol. Experience island hopping and local culture along the way. Perfect for thrill-seekers and nature lovers alike.'),
(5, 5, 'Enjoy the cool weather and scenic views of Batangas and Tagaytay. Visit Taal Volcano, explore Sky Ranch, and have a picnic at local gardens. Savor local cuisine and take in panoramic landscapes. Ideal for a short and refreshing getaway.'),
(6, 6, 'Explore Cebu’s rich history and natural wonders. Visit Magellan’s Cross, Basilica del Santo Niño, and stunning waterfalls. Enjoy marine adventures and discover local culture along the way. A perfect combination of sightseeing and relaxation.'),
(7, 7, 'Discover the scenic countryside of Bohol, including the Chocolate Hills and Tarsier Sanctuary. Cruise the Loboc River and visit historic churches. Enjoy local food and cultural experiences. This tour is perfect for nature and culture enthusiasts.'),
(8, 8, 'Experience the world-famous beaches of Boracay. Relax on white sands, try water activities, and explore Puka Beach and Bulabog. Enjoy sunset sailing and vibrant nightlife. Perfect for beach lovers and adventure seekers alike.'),
(9, 9, 'Explore the natural beauty of Davao. Visit the Philippine Eagle Center, Eden Nature Park, and Samal Island. Enjoy city attractions and experience local culture and cuisine. Ideal for families and nature lovers.'),
(10, 10, 'Dive into the surfing paradise of Siargao. Ride the waves at Cloud 9, explore Magpupungko Rock Pools, and discover Sugba Lagoon. Visit Naked Island and enjoy the serene beaches. This tour is perfect for adventure enthusiasts and water lovers.'),
(11, 11, 'Embark on an action-packed adventure in Cagayan de Oro. Experience white water rafting, explore Mapawa Nature Park, and have fun at Seven Seas Waterpark. Enjoy local culture and cuisine. Perfect for thrill-seekers and families.'),
(12, 12, 'Explore the breathtaking beauty of Palawan. Visit Puerto Princesa Underground River, Honda Bay, and the stunning beaches of El Nido. Snorkel at Coron Reef, relax at Palawan resorts, and take in the scenic lagoons and lakes. A complete tropical adventure for nature lovers and explorers.');

-- --------------------------------------------------------

--
-- Table structure for table `tour_exclusions`
--

CREATE TABLE `tour_exclusions` (
  `exclusion_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `exclusion_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_exclusions`
--

INSERT INTO `tour_exclusions` (`exclusion_id`, `tour_id`, `exclusion_detail`) VALUES
(1, 1, 'Personal expenses'),
(2, 1, 'Entrance fees not mentioned'),
(3, 1, 'Travel insurance'),
(4, 1, 'Dinner unless specified'),
(5, 2, 'Personal expenses'),
(6, 2, 'Entrance fees not included'),
(7, 2, 'Travel insurance'),
(8, 3, 'Equipment damage fees'),
(9, 3, 'Meals not mentioned'),
(10, 3, 'Travel insurance'),
(11, 4, 'Extra snacks and drinks'),
(12, 4, 'Travel insurance'),
(13, 4, 'Personal expenses'),
(14, 5, 'Meals not included'),
(15, 5, 'Souvenirs'),
(16, 5, 'Travel insurance'),
(17, 6, 'Personal expenses'),
(18, 6, 'Entrance fees not mentioned'),
(19, 6, 'Travel insurance'),
(20, 7, 'Meals not included'),
(21, 7, 'Souvenirs'),
(22, 7, 'Travel insurance'),
(23, 8, 'Equipment rental fees'),
(24, 8, 'Alcoholic beverages'),
(25, 8, 'Travel insurance'),
(26, 9, 'Meals not mentioned'),
(27, 9, 'Souvenirs'),
(28, 9, 'Travel insurance'),
(29, 10, 'Personal expenses'),
(30, 10, 'Meals not included'),
(31, 10, 'Travel insurance'),
(32, 11, 'Meals and drinks'),
(33, 11, 'Souvenirs'),
(34, 11, 'Travel insurance'),
(35, 12, 'Alcoholic beverages'),
(36, 12, 'Personal expenses'),
(37, 12, 'Travel insurance'),
(38, 12, 'Equipment damage fees');

-- --------------------------------------------------------

--
-- Table structure for table `tour_inclusions`
--

CREATE TABLE `tour_inclusions` (
  `inclusion_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `inclusion_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_inclusions`
--

INSERT INTO `tour_inclusions` (`inclusion_id`, `tour_id`, `inclusion_detail`) VALUES
(1, 1, 'Baguio city tour'),
(2, 1, 'Sagada cultural visit'),
(3, 1, 'Transportation between Baguio and Sagada'),
(4, 1, 'Breakfast and lunch included'),
(5, 1, 'Tour guide'),
(6, 2, 'Ilocos heritage site visits'),
(7, 2, 'Coastal sightseeing'),
(8, 2, 'Transportation'),
(9, 2, 'Meals included'),
(10, 2, 'Local guide'),
(11, 3, 'Surfing lessons'),
(12, 3, 'Beach relaxation'),
(13, 3, 'Equipment provided'),
(14, 3, 'Local guide'),
(15, 4, 'Volcano trekking'),
(16, 4, 'Island hopping tour'),
(17, 4, 'Boat transfers included'),
(18, 4, 'Meals and snacks'),
(19, 4, 'Guide services'),
(20, 5, 'Lake sightseeing'),
(21, 5, 'Tagaytay city tour'),
(22, 5, 'Breakfast included'),
(23, 5, 'Tour guide'),
(24, 5, 'Transportation'),
(25, 6, 'City tour of Cebu'),
(26, 6, 'Waterfall visits'),
(27, 6, 'Marine adventure activities'),
(28, 6, 'Transportation'),
(29, 6, 'Meals included'),
(30, 7, 'Bohol countryside tour'),
(31, 7, 'Chocolate Hills visit'),
(32, 7, 'River cruise'),
(33, 7, 'Transportation'),
(34, 7, 'Tour guide'),
(35, 8, 'Boracay island tour'),
(36, 8, 'Beach access'),
(37, 8, 'Water activities'),
(38, 8, 'Meals and refreshments'),
(39, 8, 'Local guide'),
(40, 9, 'City tour of Davao'),
(41, 9, 'Wildlife park visit'),
(42, 9, 'Nature exploration'),
(43, 9, 'Transportation'),
(44, 9, 'Guide included'),
(45, 10, 'Surfing lessons'),
(46, 10, 'Island hopping'),
(47, 10, 'Lagoon visit'),
(48, 10, 'Equipment provided'),
(49, 10, 'Tour guide'),
(50, 11, 'Adventure activities'),
(51, 11, 'City tour of Cagayan de Oro'),
(52, 11, 'Transportation included'),
(53, 11, 'Guide services'),
(54, 12, 'Beach hopping in Palawan'),
(55, 12, 'Snorkeling activities'),
(56, 12, 'Local transportation included'),
(57, 12, 'Breakfast and lunch'),
(58, 12, 'Tour guide services');

-- --------------------------------------------------------

--
-- Table structure for table `tour_itinerary`
--

CREATE TABLE `tour_itinerary` (
  `itinerary_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `short_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_itinerary`
--

INSERT INTO `tour_itinerary` (`itinerary_id`, `tour_id`, `day_number`, `short_desc`) VALUES
(1, 1, 1, 'Arrival at Baguio City and check-in at the hotel. (Breakfast included)'),
(2, 1, 1, 'Visit Burnham Park and take a boat ride on the lake.'),
(3, 1, 1, 'Explore the Baguio Mines View Park for panoramic views.'),
(4, 1, 1, 'Enjoy lunch at the famous Good Taste Restaurant. (Lunch at your own account)'),
(5, 1, 1, 'Tour The Mansion, the official summer residence of the Philippine President.'),
(6, 1, 1, 'Take a stroll through the vibrant The Wright Park.'),
(7, 1, 1, 'Stroll in the Baguio Session Road for shopping and local treats.'),
(8, 1, 1, 'Enjoy and Shop at the Baguio Public Night Market.'),
(9, 1, 2, 'Travel to Sagada and visit the Hanging Coffins.'),
(10, 1, 2, 'Explore the Sumaguing Cave with a guided spelunking tour.'),
(11, 1, 2, 'Lunch at a local Sagada restaurant. (Lunch at your own account)'),
(12, 1, 2, 'Hike to Echo Valley and enjoy the scenic views.'),
(13, 1, 2, 'Travel back to Manila'),
(14, 2, 1, 'Arrival at Ilocos and visit the Bangui Windmills.'),
(15, 2, 1, 'Explore the historic Cape Bojeador Lighthouse.'),
(16, 2, 1, 'Visit the beautiful Patapat Viaduct along the coast.'),
(17, 2, 1, 'Enjoy local Ilocano cuisine for lunch. (Lunch included)'),
(18, 2, 1, 'Walk along historic cobblestone streets of Vigan.'),
(19, 2, 1, 'Shop for local crafts and souvenirs at Vigan Market.'),
(20, 2, 1, 'Enjoy free dinner in hotel.'),
(21, 2, 2, 'Breakfast at the hotel. (Breakfast included)'),
(22, 2, 2, 'Visit the beautiful Bantay Church and Bell Tower.'),
(23, 2, 2, 'Tour the impressive Sand Dunes of Laoag.'),
(24, 2, 2, 'Enjoy local delicacies for lunch. (Lunch at your own account)'),
(25, 2, 2, 'Experience thrilling 4x4 rides in the sand dunes.'),
(26, 2, 2, 'Visit the iconic UNESCO World Heritage Paoay Church.'),
(27, 2, 3, 'Breakfast at the hotel. (Breakfast included)'),
(28, 2, 3, 'See stunning white rock formations along the coast.'),
(29, 2, 3, 'Lunch at a local restaurant. (Lunch at your own account)'),
(30, 2, 3, 'Explore the historic Malacañang of the North.'),
(31, 2, 3, 'Enjoy shopping for souvenirs at the Ilocos Norte Capitol.'),
(32, 2, 4, 'Breakfast at the hotel. (Breakfast included)'),
(33, 2, 4, 'Relax at the pristine beaches of Pagudpud.'),
(34, 2, 4, 'Departure to Manila'),
(35, 3, 1, 'Arrive in La Union and check-in at the hotel. (Breakfast included)'),
(36, 3, 1, 'Relax and unwind at the San Juan Surf Beach.'),
(37, 3, 2, 'Breakfast at the hotel. (Breakfast included)'),
(38, 3, 2, 'Visit Ma-Cho Temple, a Taoist temple with ocean views.'),
(39, 3, 2, 'Enjoy lunch at a seaside restaurant. (Lunch at your own account)'),
(40, 3, 2, 'Explore Tangadan Falls and enjoy the cold water.'),
(41, 3, 2, 'Check in the Thunderbird Resort for a luxurious stay.'),
(42, 3, 3, 'Breakfast at the resort. (Breakfast included)'),
(43, 3, 3, 'Relax and unwind at the resort or explore nearby cafes.'),
(44, 3, 3, 'Enjoy the luxurious amenities and ocean views.'),
(45, 3, 3, 'Departure to Manila'),
(46, 4, 1, 'Arrival at Legazpi City and check-in at the hotel.'),
(47, 4, 1, 'Enjoy free lunch at a local restaurant. (Lunch included)'),
(48, 4, 1, 'Visit the Mayon Volcano View and Photo Stop.'),
(49, 4, 2, 'Breakfast at the hotel. (Breakfast included)'),
(50, 4, 2, 'Discover the Cagsawa Ruins and learn about its history.'),
(51, 4, 2, 'Take a scenic ATV ride around the base of Mayon Volcano.'),
(52, 4, 2, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(53, 4, 2, 'Explore local markets.'),
(54, 4, 3, 'Breakfast at the hotel. (Breakfast included)'),
(55, 4, 3, 'Travel to Donsol for whale shark watching.'),
(56, 4, 3, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(57, 4, 3, 'Swim with the gentle giants of the sea.'),
(58, 4, 4, 'Breakfast at the hotel. (Breakfast included)'),
(59, 4, 4, 'Island hopping tour in Caramoan Islands.'),
(60, 4, 4, 'Enjoy lunch on one of the islands. (Lunch at your own account)'),
(61, 4, 4, 'Departure to Manila'),
(62, 5, 1, 'Arrival at Tagaytay and visit the Taal Volcano Viewpoint.'),
(63, 5, 1, 'Breakfast at the buffet restaurant with a view. (Breakfast included)'),
(64, 5, 1, 'Enjoy rides and leisure activities at Sky Ranch.'),
(65, 5, 2, 'Relax and have a picnic in scenic surroundings.'),
(66, 5, 2, 'Explore different gardens and cafes in Tagaytay.'),
(67, 5, 2, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(68, 5, 2, 'Visit Tagaytay Public Market for local products.'),
(69, 5, 3, 'Travel to Batangas and check-in at the beach resort.'),
(70, 5, 3, 'Enjoy a relaxing morning by the beach.'),
(71, 5, 3, 'Have lunch at the resort. (Lunch included)'),
(72, 5, 3, 'Dive or snorkel in Anilao with clear waters.'),
(73, 5, 3, 'Departure to Manila'),
(74, 6, 1, 'Arrival at Cebu City and check-in at the hotel. (Breakfast included)'),
(75, 6, 1, 'See the historical cross planted by Magellan.'),
(76, 6, 1, 'Enjoy local Cebuano cuisine for lunch. (Lunch at your own account)'),
(77, 6, 1, 'Visit the Magellan Basilica Minore del Santo Niño.'),
(78, 6, 1, 'Visit the vibrant Carbon Market for local goods.'),
(79, 6, 2, 'Breakfast at the hotel. (Breakfast included)'),
(80, 6, 2, 'Explore the stunning beaches of Mactan Island.'),
(81, 6, 2, 'Visit Kawasan and swim in with the waterfalls.'),
(82, 6, 2, 'Have lunch at a Kawasan. (Lunch included)'),
(83, 6, 2, 'Relax and unwind at the falls.'),
(84, 6, 3, 'Breakfast at the hotel. (Breakfast included)'),
(85, 6, 3, 'Enjoy the Oslob Whale Shark Watching experience.'),
(86, 6, 3, 'Have lunch at a local restaurant. (Lunch at your own account)'),
(87, 6, 3, 'Shop for souvenirs at local markets.'),
(88, 6, 3, 'Departure to Manila'),
(89, 7, 1, 'Arrival at Bohol and check-in at the hotel. (Breakfast included)'),
(90, 7, 1, 'See the iconic Chocolate Hills and take photos.'),
(91, 7, 1, 'Visit the Tarsier Sanctuary to see the tiny primates.'),
(92, 7, 1, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(93, 7, 1, 'Find unique souvenirs at the Bohol Bee Farm.'),
(94, 7, 2, 'Breakfast at the hotel. (Breakfast included)'),
(95, 7, 2, 'Cruise along the Loboc River and enjoy a buffet lunch on a floating restaurant.'),
(96, 7, 2, 'Enjoy free time at Panglao Beach.'),
(97, 7, 3, 'Breakfast at the hotel. (Breakfast included)'),
(98, 7, 3, 'Enjoy amenities at the hotel or explore nearby cafes.'),
(99, 7, 3, 'Visit the Baclayon Church, one of the oldest churches in the Philippines.'),
(100, 7, 3, 'Have lunch at a local restaurant. (Lunch at your own account)'),
(101, 7, 3, 'Departure to Manila'),
(102, 8, 1, 'Arrival at Boracay and check-in at the hotel. (Lunch included)'),
(103, 8, 1, 'Relax and sunbathe on Boracay that is famous for White Beach.'),
(104, 8, 1, 'Enjoy amenities of the hotel (pool, spa, beach).'),
(105, 8, 2, 'Breakfast at the hotel. (Breakfast included)'),
(106, 8, 2, 'Go island hopping in Puka Shell Beach, Crocodile Island, and Crystal Cove.'),
(107, 8, 2, 'Have lunch on one of the islands. (Lunch included)'),
(108, 8, 2, 'Relax and unwind at the beach.'),
(109, 8, 3, 'Check in at the Bulabog Beach Resort. (Breakfast included)'),
(110, 8, 3, 'Explore Boracay with vibrant underwater world with scuba diving.'),
(111, 8, 3, 'Engage in water sports like kiteboarding and windsurfing.'),
(112, 8, 3, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(113, 8, 4, 'Breakfast at the hotel. (Breakfast included)'),
(114, 8, 4, 'Relax and enjoy the beautiful beach scenery.'),
(115, 8, 4, 'Shop for souvenirs at D Mall Boracay.'),
(116, 8, 4, 'Sail along the coast and watch a breathtaking sunset.'),
(117, 8, 4, 'Departure to Manila'),
(118, 9, 1, 'Arrival at Davao City and check-in at the hotel. (Breakfast included)'),
(119, 9, 1, 'Visit the Philippine Eagle Center to see the national bird.'),
(120, 9, 1, 'Enjoy local Davao cuisine for lunch. (Lunch at your own account)'),
(121, 9, 1, 'See the majestic Philippine eagle up close.'),
(122, 9, 2, 'Breakfast at the hotel. (Breakfast included)'),
(123, 9, 2, 'Explore the vibrant Davao City Market for local products.'),
(124, 9, 2, 'Visit the Davao Crocodile Park and learn about crocodile conservation.'),
(125, 9, 2, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(126, 9, 2, 'Relax at the Eden Nature Park and experience nature trails.'),
(127, 9, 3, 'Breakfast at the hotel. (Breakfast included)'),
(128, 9, 3, 'Visit different shops at the Aldevinco Shopping Center.'),
(129, 9, 3, 'Have lunch at a local restaurant. (Lunch at your own account)'),
(130, 9, 3, 'Explore the Peoples Park.'),
(131, 9, 4, 'Breakfast at the hotel. (Breakfast included)'),
(132, 9, 4, 'Take a boat tour to Samal Island and visit Hagimit Falls.'),
(133, 9, 4, 'Enjoy lunch on Samal Island. (Lunch at your own account)'),
(134, 9, 4, 'Relax on the pristine beaches of Samal Island.'),
(135, 9, 4, 'Departure to Manila'),
(136, 10, 1, 'Arrival in Siargao, transfer to hotel, check-in, and settle in.'),
(137, 10, 1, 'Breakfast at the hotel.'),
(138, 10, 1, 'Surfing session at Cloud 9 for beginners and enthusiasts.'),
(139, 10, 1, 'Lunch at a local seaside restaurant.'),
(140, 10, 1, 'Explore General Luna town, souvenir and local handicraft shopping.'),
(141, 10, 1, 'Dinner at a beachfront restaurant.'),
(142, 10, 2, 'Breakfast at the hotel.'),
(143, 10, 2, 'Visit Magpupungko Rock Pools during low tide, swimming and relaxing.'),
(144, 10, 2, 'Lunch picnic at Magpupungko beach.'),
(145, 10, 2, 'Optional snorkeling or cliff diving.'),
(146, 10, 2, 'Return to hotel and free time for shopping.'),
(147, 10, 2, 'Dinner at local restaurant.'),
(148, 10, 3, 'Breakfast at the hotel.'),
(149, 10, 3, 'Island hopping to Sugba Lagoon with kayaking, swimming, and paddleboarding.'),
(150, 10, 3, 'Lunch on the boat or at nearby island.'),
(151, 10, 3, 'Return to hotel for rest and optional shopping.'),
(152, 10, 3, 'Dinner at hotel or beachfront café.'),
(153, 10, 4, 'Breakfast at hotel.'),
(154, 10, 4, 'Relax and unwind at Naked Island, swimming and sunbathing.'),
(155, 10, 4, 'Lunch on the island.'),
(156, 10, 4, 'Check-out and transfer to airport for departure.'),
(157, 11, 1, 'Arrival in Cagayan de Oro, hotel check-in and settle in.'),
(158, 11, 1, 'Breakfast at hotel.'),
(159, 11, 1, 'Exciting White Water Rafting adventure in Cagayan River.'),
(160, 11, 1, 'Lunch by the riverside after rafting.'),
(161, 11, 1, 'Free time for souvenir shopping at local market.'),
(162, 11, 1, 'Dinner at local restaurant.'),
(163, 11, 2, 'Breakfast at hotel.'),
(164, 11, 2, 'Hiking and nature exploration at Mapawa Nature Park.'),
(165, 11, 2, 'Lunch picnic at the park.'),
(166, 11, 2, 'Zipline or other adventure activities.'),
(167, 11, 2, 'Return to hotel for rest and shopping.'),
(168, 11, 2, 'Dinner at hotel or local dining spot.'),
(169, 11, 3, 'Breakfast at hotel.'),
(170, 11, 3, 'Fun-filled day at Seven Seas Waterpark, swimming and slides.'),
(171, 11, 3, 'Lunch at the park.'),
(172, 11, 3, 'Relax at hotel and optional local shopping.'),
(173, 11, 3, 'Check-out and transfer to airport for departure.'),
(174, 12, 1, 'Arrival in Puerto Princesa, check-in at hotel and settle in.'),
(175, 12, 1, 'Breakfast at hotel.'),
(176, 12, 1, 'Visit Puerto Princesa Underground River.'),
(177, 12, 1, 'Lunch at local restaurant.'),
(178, 12, 1, 'Explore local market for souvenirs and handicrafts.'),
(179, 12, 1, 'Dinner at beachfront restaurant.'),
(180, 12, 2, 'Breakfast at hotel.'),
(181, 12, 2, 'Honda Bay Island Hopping including snorkeling and beach visits.'),
(182, 12, 2, 'Lunch on one of the islands.'),
(183, 12, 2, 'Relax and enjoy beach activities, optional shopping.'),
(184, 12, 2, 'Dinner at hotel or nearby restaurant.'),
(185, 12, 3, 'Breakfast at hotel.'),
(186, 12, 3, 'El Nido Beaches and Lagoons tour with kayaking and swimming.'),
(187, 12, 3, 'Lunch at El Nido island restaurant.'),
(188, 12, 3, 'Free time for sightseeing and shopping in El Nido.'),
(189, 12, 3, 'Dinner and overnight stay.'),
(190, 12, 4, 'Breakfast at hotel.'),
(191, 12, 4, 'Visit Kayangan Lake, Coron for swimming and photo opportunities.'),
(192, 12, 4, 'Lunch at local eatery.'),
(193, 12, 4, 'Optional shopping for local products.'),
(194, 12, 4, 'Return to hotel and dinner.'),
(195, 12, 5, 'Breakfast at hotel.'),
(196, 12, 5, 'Snorkeling adventure at Coron Reef.'),
(197, 12, 5, 'Lunch on the boat or at nearby beach.'),
(198, 12, 5, 'Relax and enjoy island activities.'),
(199, 12, 5, 'Dinner at hotel or beachside restaurant.'),
(200, 12, 6, 'Breakfast at hotel.'),
(201, 12, 6, 'Free time and relaxation at Palawan Beach Resort.'),
(202, 12, 6, 'Check-out and transfer to airport for departure.');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `tour_id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `tour_name` varchar(150) DEFAULT NULL,
  `duration_days` int(11) DEFAULT NULL,
  `duration_nights` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('Available','Unavailable') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`tour_id`, `destination_id`, `tour_name`, `duration_days`, `duration_nights`, `description`, `price`, `status`, `image`, `banner_image`) VALUES
(1, 1, 'Baguio-Sagada Tour', 4, 3, 'A cool-climate adventure combining Baguio city charm and Sagada culture.', 7998.00, 'Available', 'assets/images/baguio_sagada.jpg', 'assets/images/banners/baguio_sagada_bg.jpg'),
(2, 2, 'Ilocos-Laoag Tour', 4, 3, 'A heritage and coastal tour showcasing Spanish-era landmarks.', 8998.00, 'Available', 'assets/images/ilocos_laoag.jpg', 'assets/images/banners/ilocos_laoag_bg.jpg'),
(3, 3, 'La Union Tour', 3, 2, 'A laid-back beach and nature escape.', 6998.00, 'Available', 'assets/images/la_union.jpg', 'assets/images/banners/la_union_bg.jpg'),
(4, 4, 'Bicol Tour', 5, 4, 'An adventure-filled tour featuring volcano views and island hopping.', 8998.00, 'Available', 'assets/images/bicol.jpg', 'assets/images/banners/bicol_bg.jpg'),
(5, 5, 'Batangas-Tagaytay Tour', 2, 1, 'A relaxing getaway with cool weather and scenic views.', 5498.00, 'Available', 'assets/images/batangas_tagaytay.jpg', 'assets/images/banners/batangas_tagaytay_bg.jpg'),
(6, 6, 'Cebu City Tour', 4, 3, 'A mix of history, waterfalls, and marine adventures.', 7998.00, 'Available', 'assets/images/cebu.jpg', 'assets/images/banners/cebu_bg.jpg'),
(7, 7, 'Bohol Countryside Tour', 3, 2, 'A scenic countryside tour highlighting natural wonders.', 6998.00, 'Available', 'assets/images/bohol.jpg', 'assets/images/banners/bohol_bg.jpg'),
(8, 8, 'Boracay Island Tour', 4, 3, 'A world-famous beach destination with powdery sand and stunning sunsets.', 7998.00, 'Available', 'assets/images/boracay.jpg', 'assets/images/banners/boracay_bg.jpg'),
(9, 9, 'Davao City Tour', 3, 2, 'A nature-filled city tour featuring wildlife, parks, and island escapes.', 6998.00, 'Available', 'assets/images/davao.jpg', 'assets/images/banners/davao_bg.jpg'),
(10, 10, 'Siargao Island Tour', 4, 3, 'A tropical paradise famous for surfing, lagoons, and island hopping.', 7998.00, 'Available', 'assets/images/siargao.jpg', 'assets/images/banners/siargao_bg.jpg'),
(11, 11, 'Cagayan de Oro Tour', 3, 2, 'An action-packed adventure tour perfect for thrill-seekers.', 6998.00, 'Available', 'assets/images/cagayan.jpg', 'assets/images/banners/cagayan_bg.jpg'),
(12, 5, 'Palawan Island Adventure', 5, 3, 'A breathtaking tour of Palawan including Puerto Princesa, El Nido, and Coron. Explore beaches, lagoons, and vibrant culture.', 12000.00, 'Available', 'assets/images/palawan_tour.jpg', 'assets/images/banners/palawan_bg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tour_place`
--

CREATE TABLE `tour_place` (
  `place_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `place_name` varchar(150) DEFAULT NULL,
  `day_number` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_place`
--

INSERT INTO `tour_place` (`place_id`, `tour_id`, `place_name`, `day_number`, `image`) VALUES
(1, 1, 'Burnham Park', 1, 'assets/images/burnham_park.jpg'),
(2, 1, 'Mines View Park', 1, 'assets/images/mines_view.jpg'),
(3, 1, 'The Mansion', 1, 'assets/images/the_mansion.jpg'),
(4, 1, 'Hanging Coffins', 2, 'assets/images/hanging_coffins.jpg'),
(5, 1, 'Sumaguing Cave', 2, 'assets/images/sumaguing_cave.jpg'),
(6, 1, 'Echo Valley', 2, 'assets/images/echo_valley.jpg'),
(7, 2, 'Vigan Calle Crisologo', 1, 'assets/images/vigan_calle.jpg'),
(8, 2, 'Laoag Sand Dunes', 2, 'assets/images/laoag_dunes.jpg'),
(9, 2, 'Paoay Church', 2, 'assets/images/paoay_church.jpg'),
(10, 2, 'Kapurpurawan Rock Formation', 3, 'assets/images/kapurpurawan_rock.jpg'),
(11, 2, 'Pagudpud Beach', 4, 'assets/images/pagudpud_beach.jpg'),
(12, 3, 'San Juan Surf Beach', 1, 'assets/images/san_juan.jpg'),
(13, 3, 'Ma-Cho Temple', 2, 'assets/images/macho_temple.jpg'),
(14, 3, 'Tangadan Falls', 2, 'assets/images/tangadan_falls.jpg'),
(15, 3, 'Thunderbird Resort', 3, 'assets/images/thunderbird_resort.jpg'),
(16, 4, 'Mayon Volcano', 1, 'assets/images/mayon_volcano.jpg'),
(17, 4, 'Cagsawa Ruins', 2, 'assets/images/cagsawa_ruins.jpg'),
(18, 4, 'Donsol Whale Shark Interaction', 3, 'assets/images/donsol_whale.jpg'),
(19, 4, 'Caramoan Islands', 4, 'assets/images/caramoan_islands.jpg'),
(20, 5, 'Taal Volcano View Deck', 1, 'assets/images/taal_volcano.jpg'),
(21, 5, 'Sky Ranch', 1, 'assets/images/sky_ranch.jpg'),
(22, 5, 'Picnic Grove', 2, 'assets/images/picnic_grove.jpg'),
(23, 5, 'Anilao Diving Sites', 3, 'assets/images/anilao_diving.jpg'),
(24, 6, 'Magellan\'s Cross', 1, 'assets/images/magellans_cross.jpg'),
(25, 6, 'Basilica del Santo Niño', 1, 'assets/images/santo_nino.jpg'),
(26, 6, 'Kawasan Falls', 2, 'assets/images/kawasan_falls.jpg'),
(27, 6, 'Oslob Whale Sharks', 3, 'assets/images/oslob_whale.jpg'),
(28, 7, 'Chocolate Hills', 1, 'assets/images/chocolate_hills.jpg'),
(29, 7, 'Tarsier Sanctuary', 1, 'assets/images/tarsier_sanctuary.jpg'),
(30, 7, 'Loboc River Cruise', 2, 'assets/images/loboc_river.jpg'),
(31, 7, 'Baclayon Church', 3, 'assets/images/baclayon_church.jpg'),
(32, 8, 'White Beach', 1, 'assets/images/white_beach.jpg'),
(33, 8, 'Puka Shell Beach', 2, 'assets/images/puka_shell.jpg'),
(34, 8, 'Bulabog Beach', 3, 'assets/images/bulabog_beach.jpg'),
(35, 8, 'Sunset Sailing', 4, 'assets/images/sunset_sailing.jpg'),
(36, 9, 'Philippine Eagle Center', 1, 'assets/images/eagle_center.jpg'),
(37, 9, 'Eden Nature Park', 2, 'assets/images/eden_park.jpg'),
(38, 9, 'People\'s Park', 3, 'assets/images/peoples_park.jpg'),
(39, 9, 'Samal Island', 4, 'assets/images/samal_island.jpg'),
(40, 10, 'Cloud 9', 1, 'assets/images/cloud_nine.jpg'),
(41, 10, 'Magpupungko Rock Pools', 2, 'assets/images/magpupungko_pools.jpg'),
(42, 10, 'Sugba Lagoon', 3, 'assets/images/sugba_lagoon.jpg'),
(43, 10, 'Naked Island', 4, 'assets/images/naked_island.jpg'),
(44, 11, 'White Water Rafting', 1, 'assets/images/white_rafting.jpg'),
(45, 11, 'Mapawa Nature Park', 2, 'assets/images/mapawa_park.jpg'),
(46, 11, 'Seven Seas Waterpark', 3, 'assets/images/seven_seas.jpg'),
(47, 12, 'Puerto Princesa Underground River', 1, 'frontend/assets/images/puerto_princesa.jpg'),
(48, 12, 'Honda Bay Island Hopping', 2, 'frontend/assets/images/honda_bay.jpg'),
(49, 12, 'El Nido Beaches and Lagoons', 3, 'frontend/assets/images/el_nido.jpg'),
(50, 12, 'Kayangan Lake, Coron', 4, 'frontend/assets/images/kayangan_lake.jpg'),
(51, 12, 'Snorkeling at Coron Reef', 5, 'frontend/assets/images/coron_reef.jpg'),
(52, 12, 'Relax at Palawan Beach Resort', 6, 'frontend/assets/images/palawan_resort.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tour_schedules`
--

CREATE TABLE `tour_schedules` (
  `schedule_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_schedules`
--

INSERT INTO `tour_schedules` (`schedule_id`, `tour_id`, `start_date`, `end_date`, `available_slots`) VALUES
(1, 1, '2026-01-15', '2026-01-18', 29),
(2, 1, '2026-03-12', '2026-03-15', 29),
(3, 1, '2026-06-10', '2026-06-13', 30),
(4, 1, '2026-10-07', '2026-10-10', 30),
(5, 2, '2026-02-05', '2026-02-08', 30),
(6, 2, '2026-04-16', '2026-04-19', 30),
(7, 2, '2026-07-22', '2026-07-25', 30),
(8, 2, '2026-11-11', '2026-11-14', 30),
(9, 3, '2026-01-23', '2026-01-25', 30),
(10, 3, '2026-05-08', '2026-05-10', 30),
(11, 3, '2026-08-14', '2026-08-16', 30),
(12, 3, '2026-12-04', '2026-12-06', 30),
(13, 4, '2026-02-18', '2026-02-22', 30),
(14, 4, '2026-04-22', '2026-04-26', 30),
(15, 4, '2026-09-09', '2026-09-13', 30),
(16, 5, '2026-01-03', '2026-01-04', 30),
(17, 5, '2026-02-07', '2026-02-08', 30),
(18, 5, '2026-03-07', '2026-03-08', 30),
(19, 5, '2026-04-04', '2026-04-05', 30),
(20, 5, '2026-05-02', '2026-05-03', 30),
(21, 5, '2026-06-06', '2026-06-07', 30),
(22, 5, '2026-07-04', '2026-07-05', 30),
(23, 5, '2026-08-01', '2026-08-02', 30),
(24, 5, '2026-09-05', '2026-09-06', 30),
(25, 5, '2026-10-03', '2026-10-04', 30),
(26, 5, '2026-11-07', '2026-11-08', 30),
(27, 5, '2026-12-05', '2026-12-06', 30),
(28, 6, '2026-03-04', '2026-03-07', 29),
(29, 6, '2026-06-17', '2026-06-20', 30),
(30, 6, '2026-09-23', '2026-09-26', 30),
(31, 7, '2026-02-11', '2026-02-13', 30),
(32, 7, '2026-05-20', '2026-05-22', 30),
(33, 7, '2026-10-21', '2026-10-23', 30),
(34, 8, '2026-01-28', '2026-01-31', 30),
(35, 8, '2026-04-08', '2026-04-11', 30),
(36, 8, '2026-07-01', '2026-07-04', 30),
(37, 8, '2026-12-09', '2026-12-12', 30),
(38, 9, '2026-03-18', '2026-03-20', 30),
(39, 9, '2026-08-19', '2026-08-21', 30),
(40, 9, '2026-11-25', '2026-11-27', 30),
(41, 10, '2026-02-25', '2026-02-28', 30),
(42, 10, '2026-06-03', '2026-06-06', 30),
(43, 10, '2026-09-30', '2026-10-03', 30),
(44, 11, '2026-01-07', '2026-01-09', 30),
(45, 11, '2026-05-27', '2026-05-29', 30),
(46, 11, '2026-10-14', '2026-10-16', 30),
(47, 12, '2026-01-10', '2026-01-15', 20),
(48, 12, '2026-02-05', '2026-02-10', 20),
(49, 12, '2026-03-12', '2026-03-17', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `contact_num` varchar(15) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT NULL,
  `is_verified` int(11) DEFAULT 0,
  `verification_code` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `middle_initial`, `contact_num`, `region`, `province`, `city`, `email`, `password`, `role`, `is_verified`, `verification_code`, `otp_expiry`) VALUES
(1, '', NULL, NULL, 'S', '09995635443', NULL, NULL, 'Tanauan CIty', 'mackayjhondrei632@gmail.com', '$2y$10$ig78VJKaY6kVmJlvP9iG3ep3zHQbq3eOxedqWOUqBrASURIMQloFS', 'user', 1, NULL, NULL),
(2, '', 'Joyce Anne', 'Remo', 'P', '09912676928', NULL, 'Batangas', 'City', 'joyceanneremo05@gmail.com', '$2y$10$NNArr6zfvMjbHIlTQ5b9F.i7aQAQGFJ6VuJtE2rEK4upDlqknFFdG', 'user', 1, '881049', '2026-01-12 22:41:46'),
(13, 'Jet2', NULL, NULL, NULL, '639939535233', NULL, NULL, NULL, 'hirosetsuya@gmail.com', '$2y$10$tDyFBO3oZnTKpI9v7FRTPexi0M9qrgQRPELsiz4ByaDYQbWemMzki', 'user', 1, NULL, NULL),
(15, '', 'Margarette', 'Marcelino', 'M', '09941792281', NULL, 'Batangas', 'Sto. Tomas City', 'marcelinomargarette04@gmail.com', '$2y$10$l009ujvqqDan5QqiuA1a7Ox7DmcdAKrN15We3etwpSQnP3NUGc0/G', 'user', 1, NULL, NULL),
(33, '', 'Lee Seokmin', 'Salvador', 'S', '09912676928', NULL, 'Batangas', 'City', 'amucasconstruction3@gmail.com', '$2y$10$6oHqQJejclxtLiz8jX0kE.vvteEZHsb2reS/EQ24hb/Luabd6c5Sq', 'user', 1, '881049', '2026-01-12 22:41:46'),
(34, '', 'Jhon Drei', 'Mackay', 'S', '09995635443', 'Luzon', 'Batangas', 'Tanauan CIty', 'jhondrei062@gmail.com', '$2y$10$VNG5qpJCpO7CBIe4V7cqdeJwPL7gcXUIiAWJfwvPO0GUjrAThDN7i', 'user', 1, '848300', '2026-01-08 19:34:54'),
(35, 'akari', 'Jhon Drei', 'Mackay', 'S', '09914074694', NULL, 'Batangas', 'Tanauan CIty', 'chaetzuu13@gmail.com', '$2y$10$T17WtnQkmtueQLCIj1LS.uIKQptNBoGi6.htg8uUkxGtVZq8rGVc.', 'user', 1, NULL, NULL),
(44, 'dhydhy', 'Dhy', 'Martin', 'D', '09912676928', NULL, 'Surigao', 'City', 'dhyroncacaoumali@gmail.com', '$2y$10$Qe1qU/p4MUulJPBUJGy8..ASB9f7PM.flN.sbnQPkOBTym6VmQTXa', 'user', 1, NULL, NULL),
(47, 'test', 'Ralph', 'Alcantara', 'M', '09666935239', NULL, 'Batangas', 'Tanauan', 'alcantarajohnralph@gmail.com', '$2y$10$K3OuXIE5but1smYldw0ZCewkWqQhUttl/kspZVSPo745M/Abofsv.', 'user', 1, NULL, NULL),
(48, 'Hiro Setsuya', NULL, NULL, NULL, '', NULL, NULL, NULL, 'adrianvincentjavillo17@gmail.com', '$2y$10$26NP.wZeiG56AmHqXeoruOy0/u4jnuX2RqiTs3cTIXoGMCjkRB1Pq', 'admin', 1, NULL, NULL),
(49, 'test', 'Hiro', 'setsuya', 'M', '09666935239', NULL, 'Batangas', 'Tanauan', 'hiroY@gmail.com', '$2y$10$sHKEXRuSphZgORCLhEx.ge0TGSveG3Bo9Qs5fq8mgEMw8CHaD3Syi', 'user', 1, NULL, NULL),
(51, 'Hiro17', 'HI', 'Javi', 'H', '09940551720', NULL, 'Batangas', 'Tanauan', 'adri@gmail.com', '$2y$10$czTykoImDvRYwDlk.X2bwuHsjr7qb36O3b8d/Gs6Bl/iD2BVlqRq.', 'user', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_vouchers`
--

CREATE TABLE `user_vouchers` (
  `claim_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `is_redeemed` tinyint(1) DEFAULT 0,
  `claimed_at` datetime DEFAULT current_timestamp(),
  `redeemed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_vouchers`
--

INSERT INTO `user_vouchers` (`claim_id`, `user_id`, `voucher_id`, `is_redeemed`, `claimed_at`, `redeemed_at`) VALUES
(3, 34, 4, 0, '2026-01-08 21:09:18', NULL),
(5, 1, 7, 1, '2026-01-08 23:29:50', '2026-01-08 23:37:37'),
(6, 1, 4, 1, '2026-01-08 23:29:52', '2026-01-08 23:58:40'),
(7, 1, 5, 1, '2026-01-08 23:29:53', '2026-01-08 23:30:38'),
(8, 1, 8, 1, '2026-01-09 00:56:15', '2026-01-09 00:59:07'),
(9, 1, 9, 0, '2026-01-11 12:14:24', NULL),
(10, 49, 9, 0, '2026-01-13 13:55:35', NULL),
(11, 49, 8, 0, '2026-01-13 14:12:20', NULL),
(12, 49, 4, 0, '2026-01-13 14:12:27', NULL),
(13, 51, 5, 0, '2026-01-13 15:32:02', NULL),
(14, 51, 8, 0, '2026-01-13 15:32:05', NULL),
(15, 51, 10, 0, '2026-01-13 15:34:53', NULL),
(16, 51, 4, 0, '2026-01-13 15:34:56', NULL),
(17, 47, 12, 0, '2026-01-13 19:05:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_templates`
--

CREATE TABLE `voucher_templates` (
  `voucher_id` int(11) NOT NULL,
  `System_type` enum('travel_agency','ebook_store') NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `discount_type` enum('percentage','fixed') DEFAULT 'fixed',
  `discount_amount` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT 0.00,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `times_used` int(11) DEFAULT 0,
  `max_uses` int(11) DEFAULT 1,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher_templates`
--

INSERT INTO `voucher_templates` (`voucher_id`, `System_type`, `code`, `title`, `discount_type`, `discount_amount`, `min_order_amount`, `expires_at`, `created_at`, `times_used`, `max_uses`, `updated_at`) VALUES
(3, 'ebook_store', 'TEST3', 'test 3 of voucher', 'fixed', 2000.00, 0.00, '2026-01-08 13:46:41', '2026-01-08 20:47:02', 0, 1, '2026-01-13 14:30:28'),
(4, 'ebook_store', 'TEST4', 'this is test 4', 'fixed', 2000.00, 0.00, '2026-01-16 20:56:29', '2026-01-08 20:56:56', 0, 1, '2026-01-13 14:30:28'),
(5, 'travel_agency', 'TEST5', 'This is test 5', 'fixed', 3000.00, 0.00, '2026-01-15 14:14:47', '2026-01-08 21:15:13', 0, 1, '2026-01-13 14:30:28'),
(7, 'travel_agency', 'test12', 'TEST 6', 'fixed', 1000.00, 0.00, '2026-01-15 00:00:00', '2026-01-08 22:50:29', 0, 1, '2026-01-13 14:30:28'),
(8, 'travel_agency', 'pqqpqpq', 'acaevaevev', 'fixed', 1000.00, 0.00, '2026-01-15 17:46:23', '2026-01-09 00:46:37', 0, 1, '2026-01-13 14:30:28'),
(9, 'travel_agency', 'Summer1', 'Test112', 'fixed', 1000.00, 0.00, '2026-01-22 00:00:00', '2026-01-11 12:08:33', 0, 1, '2026-01-13 14:30:28'),
(10, 'ebook_store', 'ljbqwljdbqw', 'ebook discount', 'fixed', 200.00, 0.00, '2026-01-16 00:00:00', '2026-01-13 15:34:30', 0, 1, '2026-01-13 15:34:30'),
(11, 'ebook_store', 'nsojfueh', 'bookstacl', 'fixed', 500.00, 0.00, '2026-01-17 00:00:00', '2026-01-13 15:58:45', 0, 1, '2026-01-13 15:58:45'),
(12, 'travel_agency', 'jnsUWHA', 'escapinas1', 'fixed', 2000.00, 0.00, '2026-01-15 00:00:00', '2026-01-13 16:04:37', 0, 1, '2026-01-13 16:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('Refund','Payment','Adjustment') NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`transaction_id`, `user_id`, `amount`, `type`, `description`, `created_at`) VALUES
(1, 36, 1500.00, 'Refund', 'Refund for Canceled Bohol Tour #BK-102', '2026-01-12 15:57:27'),
(2, 36, -500.00, 'Payment', 'Booking Payment for Cebu Day Tour', '2026-01-12 15:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `tour_id`, `added_at`) VALUES
(32, 1, 5, '2026-01-08 07:23:31'),
(40, 1, 8, '2026-01-08 15:33:22'),
(43, 47, 1, '2026-01-13 13:35:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_emails`
--
ALTER TABLE `admin_emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_id` (`mail_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `fk_booking_tour` (`tour_id`),
  ADD KEY `fk_booking_location` (`locpoints_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `island_id` (`island_id`);

--
-- Indexes for table `location_points`
--
ALTER TABLE `location_points`
  ADD PRIMARY KEY (`locpoints_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`island_id`);

--
-- Indexes for table `region_fees`
--
ALTER TABLE `region_fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tour_about`
--
ALTER TABLE `tour_about`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_exclusions`
--
ALTER TABLE `tour_exclusions`
  ADD PRIMARY KEY (`exclusion_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_inclusions`
--
ALTER TABLE `tour_inclusions`
  ADD PRIMARY KEY (`inclusion_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  ADD PRIMARY KEY (`itinerary_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `tour_place`
--
ALTER TABLE `tour_place`
  ADD PRIMARY KEY (`place_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_vouchers`
--
ALTER TABLE `user_vouchers`
  ADD PRIMARY KEY (`claim_id`),
  ADD UNIQUE KEY `unique_user_voucher` (`user_id`,`voucher_id`),
  ADD KEY `fk_template_id` (`voucher_id`) USING BTREE;

--
-- Indexes for table `voucher_templates`
--
ALTER TABLE `voucher_templates`
  ADD PRIMARY KEY (`voucher_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_emails`
--
ALTER TABLE `admin_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `location_points`
--
ALTER TABLE `location_points`
  MODIFY `locpoints_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `island_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `region_fees`
--
ALTER TABLE `region_fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tour_about`
--
ALTER TABLE `tour_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tour_exclusions`
--
ALTER TABLE `tour_exclusions`
  MODIFY `exclusion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tour_inclusions`
--
ALTER TABLE `tour_inclusions`
  MODIFY `inclusion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tour_place`
--
ALTER TABLE `tour_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_vouchers`
--
ALTER TABLE `user_vouchers`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `voucher_templates`
--
ALTER TABLE `voucher_templates`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `tour_schedules` (`schedule_id`),
  ADD CONSTRAINT `fk_booking_location` FOREIGN KEY (`locpoints_id`) REFERENCES `location_points` (`locpoints_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_tour` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`island_id`) REFERENCES `regions` (`island_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE;

--
-- Constraints for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  ADD CONSTRAINT `pickup_dropoff_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`),
  ADD CONSTRAINT `pickup_dropoff_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_ratings_tour` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD CONSTRAINT `sms_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_about`
--
ALTER TABLE `tour_about`
  ADD CONSTRAINT `tour_about_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_exclusions`
--
ALTER TABLE `tour_exclusions`
  ADD CONSTRAINT `tour_exclusions_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_inclusions`
--
ALTER TABLE `tour_inclusions`
  ADD CONSTRAINT `tour_inclusions_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  ADD CONSTRAINT `tour_itinerary_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD CONSTRAINT `tour_packages_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`);

--
-- Constraints for table `tour_place`
--
ALTER TABLE `tour_place`
  ADD CONSTRAINT `tour_place_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD CONSTRAINT `tour_schedules_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `user_vouchers`
--
ALTER TABLE `user_vouchers`
  ADD CONSTRAINT `fk_template_id` FOREIGN KEY (`voucher_id`) REFERENCES `voucher_templates` (`voucher_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
