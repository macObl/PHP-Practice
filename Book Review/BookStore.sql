-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2012 at 03:28 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: BookStore
--
CREATE DATABASE IF NOT EXISTS BookStore DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE BookStore;

-- --------------------------------------------------------

--
-- Table structure for table Book
--

CREATE TABLE IF NOT EXISTS Book (
  BookId int(11) NOT NULL AUTO_INCREMENT,
  Title varchar(127) NOT NULL,
  Description text,
  Price decimal(10,0) NOT NULL,
  PRIMARY KEY (BookId)
);

--
-- Dumping data for table Book
--

INSERT INTO Book (BookId, Title, Description, Price) VALUES
(1, 'Web Programming', 'Completely revised and updated, this popular book returns with coverage on a range of new technologies. Authored by a highly respected duo, this edition provides an in-depth examination of the core concepts and general principles of Web application development. Packed with examples featuring specific technologies, this book is divided into three sections: HTTP protocol as a foundation for Web applications, markup languages (HTML, XML, and CSS), and survey of emerging technologies. After a detailed introduction to the history of Web applications, coverage segues to core Internet protocols, Web browsers, Web application development, trends and directions, and more.', '50'),
(2, 'C# Programming', 'C# Programming in Easy Steps begins by explaining how to download and install a free C++ compiler so you can quickly begin to create your own executable programs by copying the book''s examples. It demonstrates all the C++ language basics before moving on to provide examples of Object Oriented Programming. The book concludes by demonstrating how you can use your acquired knowledge to create programs graphically in the free Microsoft Visual C++ Express Integrated Development Environment (IDE).', '45'),
(3, 'Java Programming', 'This highly anticipated new edition of the classic, Jolt Award-winning work has been thoroughly updated to cover Java SE 5 and Java SE 6 features introduced since the first edition. Bloch explores new design patterns and language idioms, showing you how to make the most of features ranging from generics to enums, annotations to autoboxing.', '65'),
(4, 'C++ Programming', 'C++ Primer Plus is a carefully crafted, complete tutorial on one of the most significant and widely used programming languages today. An accessible and easy-to-use self-study guide, this book is appropriate for both serious students of programming as well as developers already proficient in other languages.', '42'),
(5, 'PHP and MySQL Web Development', 'If you''re familiar with HTML, using the information in Learning PHP, MySQL, JavaScript and CSS, you will quickly learn how to build interactive, data-driven websites with the powerful combination of PHP, MySQL, JavaScript and CSS - the top technologies for creating modern sites. This hands-on guide explains each technology separately, shows you how to combine them, and introduces valuable web programming concepts such as objects, XHTML, cookies, and session management.', '65'),
(6, 'Effortless E-Commerce with PHP and MySQL', 'Carefully paced for non-programmers, this second edition of the top-selling guide to web development now also provides an extensive introduction to CSS, and benefits from reader questions and suggestions about the first edition, making the new edition even easier to follow and more information-packed than ever.', '27'),
(7, 'Essential Guide to Dreamweaver CS5 with CSS, Ajax, and PHP', 'Written by veteran Dreamweaver teacher and author David McFarland, Dreamweaver CS5: The Missing Manual takes you through site creation step-by-step, from building your very first page to launching a template-driven, fully interactive site. You''ll hone your skills with the help of hands-on, guided tutorials throughout the book.', '76'),
(8, 'Securing PHP Web Applications', 'Offers fifty practical and secure PHP applications that readers can immediately put to use. Explains the entire life cycle of each PHP application, including requirements, design, development, maintenance, and tuning. Reviews application development line-by-line and module-by-module to help readers understand specific coding practices and requirements', '53'),
(9, 'Advanced PHP Programming', 'The rapid maturation of PHP has created a skeptical population of users from more traditional "enterprise" languages who question the readiness and ability of PHP to scale, as well as a large population of PHP developers without formal computer science backgrounds who have learned through the hands-on experimentation while developing small and midsize applications in PHP.', '91'),
(10, 'Learning PHP, MySQL, and JavaScript', 'While there are many books on learning PHP and developing small applications with it, there is a serious lack of information on "scaling" PHP for large-scale, business-critical systems. Schlossnagle''s Advanced PHP Programming fills that void, demonstrating that PHP is ready for enterprise Web applications by showing the reader how to develop PHP-based applications for maximum performance, stability, and extensibility.', '59'),
(11, 'Foundation PHP 5 for Flash', 'The demand for rich Internet applications (RIAs) such as complete storefronts and interactive surveys is skyrocketing, as is the pressure to create these dynamic apps overnight and at low cost. This in-depth Bible provides the step-by-step instructions you need to quickly create RIAs in Flash using cost-effective, open-source PHP programming tools. You''ll learn how PHP works, when you should use it in Flash, and above all, vital security techniques for keeping your interactive sites secure.', '47'),
(12, 'Head First PHP & MySQL', 'Lynn Beighley is a fiction writer stuck in a technical book writer''s body. Upon discovering that technical book writing actually paid real money, she learned to accept and enjoy it. After going back to school to get a Masters in Computer Science, she worked for the acronyms NRL and LANL. Then she discovered Flash, and wrote her first bestseller. A victim of bad timing, she moved to Silicon Valley just before the great crash. She spent several years working for Yahoo! and writing other books and training courses. Finally giving in to her creative writing bent, she moved to the New York area to get an MFA in Creative Writing.', '36');

-- --------------------------------------------------------

--
-- Table structure for table Customer
--

CREATE TABLE IF NOT EXISTS Customer (
  UserId varchar(127) NOT NULL,
  Name varchar(127) NOT NULL,
  Password varchar(127) NOT NULL,
  PRIMARY KEY (UserId)
);

--
-- Dumping data for table Customer
--

INSERT INTO Customer (UserId, Name, Password) VALUES
('gongw', 'Wei Gong', '32ca9fc1a0f5b6330e3f4c8c1bbecde9bedb9573'),
('smithj', 'John Smith', '9b7f961de9991462da7eb496187fcf1e97ba5024');

-- --------------------------------------------------------

--
-- Table structure for table ShoppingCart
--

CREATE TABLE IF NOT EXISTS ShoppingCart (
  CustomerId varchar(127) NOT NULL,
  BookId int(11) NOT NULL,
  Copies int(11) NOT NULL,
  KEY CustomerId (CustomerId),
  KEY BookId (BookId)
);

--
-- Dumping data for table ShoppingCart
--

INSERT INTO ShoppingCart (CustomerId, BookId, Copies) VALUES
('gongw', 2, 2),
('gongw', 11, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table ShoppingCart
--
ALTER TABLE ShoppingCart
  ADD CONSTRAINT shoppingcart_ibfk_2 FOREIGN KEY (BookId) REFERENCES Book (BookId),
  ADD CONSTRAINT shoppingcart_ibfk_1 FOREIGN KEY (CustomerId) REFERENCES Customer (UserId);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
