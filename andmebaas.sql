CREATE TABLE Users (
    UserID int NOT NULL AUTO_INCREMENT,
    UserName varchar(30) NOT NULL,
    Password varchar(135) NOT NULL,
    Email varchar(100) NOT NULL,
    FirstName varchar(35) NOT NULL,
    LastName varchar(35) NOT NULL,
    PRIMARY KEY (UserID)
);

CREATE TABLE `Experiments` (
  `ExperimentID` int(11) NOT NULL AUTO_INCREMENT,
  `ExperimentCreator` int(11) NOT NULL,
  `ExperimentDate` timestamp NULL DEFAULT current_timestamp(),
  `ExperimentName` varchar(50) NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `Age` int(3) NOT NULL,
  PRIMARY KEY (`ExperimentID`),
  KEY `ExperimentCreator` (`ExperimentCreator`),
  CONSTRAINT `Experiments_ibfk_1` FOREIGN KEY (`ExperimentCreator`) REFERENCES `Users` (`UserID`)
)

CREATE TABLE Files (
  FileID int NOT NULL AUTO_INCREMENT,
  FileFolder varchar(255) NOT NULL,
  FileName varchar(255) NOT NULL,
  FileUploaded Date NOT NULL,
  ExperimentID int NOT NULL,
  PRIMARY KEY (FileID),
  FOREIGN KEY (ExperimentID) REFERENCES Experiments(ExperimentID)
);

CREATE TABLE Markers (
  MarkerID int NOT NULL AUTO_INCREMENT,
  ExperimentID int NOT NULL,
  Latitude varchar(10) NOT NULL,
  Longitude varchar(12) NOT NULL,
  MarkerTime datetime NOT NULL,
  PRIMARY KEY (MarkerID),
  FOREIGN KEY (ExperimentID) REFERENCES Experiments(ExperimentID)
);

CREATE TABLE Measurements (
  MeasurementID int NOT NULL AUTO_INCREMENT,
  MarkerID int NOT NULL,
  AlphaValue varchar(20) NOT NULL,
  BetaValue varchar(20) NOT NULL,
  GammaValue varchar(20) NOT NULL,
  ThetaValue varchar(20) NOT NULL,
  DeltaValue varchar(20) NOT NULL,
  PRIMARY KEY(MeasurementID),
  FOREIGN KEY(MarkerID) REFERENCES Markers(MarkerID)
);
