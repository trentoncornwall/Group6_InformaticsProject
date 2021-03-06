SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS Person_T;
DROP TABLE IF EXISTS Business_T;
DROP TABLE IF EXISTS Job_T;
DROP TABLE IF EXISTS Paystub_T;
DROP TABLE IF EXISTS Hours_T;
DROP TABLE IF EXISTS Report_T;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE Person_T (
  PID int unsigned NOT NULL AUTO_INCREMENT,
  Username varchar(128) NOT NULL,
  HashedPass varchar(128) NOT NULL,
  LName varchar(128) NOT NULL,
  FName varchar(128) NOT NULL,
  Email varchar(128) NOT NULL,
  Phonenumber varchar(12) NOT NULL,
  Address varchar(128) NOT NULL,
  Permission int(1) DEFAULT 0,
  PRIMARY KEY (PID)
) ENGINE=InnoDB;

CREATE TABLE Business_T (
  BID int unsigned NOT NULL AUTO_INCREMENT,
  Business_Name varchar(128) NOT NULL,
  Business_Address varchar(128) NOT NULL,
  Position varchar(128),  
  PRIMARY KEY (BID)
) ENGINE=InnoDB;

CREATE TABLE Job_T (
  JID int unsigned NOT NULL AUTO_INCREMENT,
  PID int unsigned NOT NULL,
  BID int unsigned NOT NULL,
  Wage float,
  PRIMARY KEY (JID),
  FOREIGN KEY (PID) REFERENCES Person_T(PID),
  FOREIGN KEY (BID) REFERENCES Business_T(BID)
) ENGINE=InnoDB;

CREATE TABLE Hours_T (
  HID int unsigned NOT NULL AUTO_INCREMENT,
  JID int unsigned NOT NULL,
  Hours int,
  Hours_Date DATE NOT NULL,
  PRIMARY KEY (HID),
  FOREIGN KEY (JID) REFERENCES Job_T(JID)
) ENGINE=InnoDB;

CREATE TABLE Paystub_T (
  PSID int unsigned NOT NULL AUTO_INCREMENT,
  JID int unsigned NOT NULL,
  Amount float,
  Stub_Hours int,
  S_Date DATE NOT NULL,
  E_Date DATE NOT NULL,
  PRIMARY KEY (PSID),
  FOREIGN KEY (JID) REFERENCES Job_T(JID)
) ENGINE=InnoDB;

CREATE TABLE Report_T (
  RID int unsigned NOT NULL AUTO_INCREMENT,
  PSID int unsigned NOT NULL,
  PID int unsigned NOT NULL,
  JID int unsigned NOT NULL,
  Pay_Difference float,
  Hour_Difference float,
  PRIMARY KEY (RID),
  FOREIGN KEY (PSID) REFERENCES Paystub_T(PSID),
  FOREIGN KEY (PID) REFERENCES Person_T(PID),
  FOREIGN KEY (JID) REFERENCES Job_T(JID)
  ) ENGINE=InnoDB;

INSERT INTO Person_T (Username, HashedPass, LName, FName, Email, Phonenumber, Address, Permission) VALUES ('admin', '$2a$12$brGB02UnBnvHtIj/OAyepuDG7okPlOhPy1YGeWu/9kZvjo6mTuy0u', 'seinfeld', 'jerry', 'admin@admin.com', '666-666-6666', '123 admin blvd', 1);