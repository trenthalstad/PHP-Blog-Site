
CREATE DATABASE IF NOT EXISTS BlogCity_db;

USE BlogCity_db;
--

-- --------------------------------------------------------
--
-- Table structure for table  blog articles 
--

CREATE TABLE IF NOT EXISTS `articles_tbl` (
  `UserID` int(10) NOT NULL,
  `Title` varchar(255),
  `Article` text,
  `DateAdded` date,
  `DateEdited` date,
  `DateDeleted` date,
  `Deleted` boolean,
  `ArticleID` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(ArticleID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table  user info 
--
CREATE TABLE IF NOT EXISTS `userinfo_tbl` (
  `UserName` varchar(50) NOT NULL,
  `FirstName` varchar(50),
  `LastName` varchar(50),
  `Address` varchar(255),
  `City` varchar(50),
  `State` varchar(50),
  `Zip` varchar(25),
  `Email` varchar(50),
  `Password` varchar(255) NOT NULL,
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
