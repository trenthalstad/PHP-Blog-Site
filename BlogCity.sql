
CREATE DATABASE IF NOT EXISTS BlogCity_db;

USE BlogCity_db;
--

-- --------------------------------------------------------
--
-- Table structure for table `blogarticles`
--

CREATE TABLE IF NOT EXISTS `articles_tbl` (
  `UserID` int(10) NOT NULL,
  `Article` text NOT NULL,
  `DateEntered` date NOT NULL,
  `DateEdited` date NOT NULL,
  `DateDeleted` date NOT NULL,
  `ArticleID` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(ArticleID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--
CREATE TABLE IF NOT EXISTS `userinfo_tbl` (
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Zip` varchar(25) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
