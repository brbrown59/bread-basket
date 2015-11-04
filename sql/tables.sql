DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS listing;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS volunteer;
DROP TABLE IF EXISTS organization;

CREATE TABLE organization(
	orgId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgName VARCHAR(32) NOT NULL,
	orgPhone VARCHAR(32) NOT NULL,
	orgType VARCHAR(16) NOT NULL,
	orgDescription VARCHAR(256),
	orgAddress1 VARCHAR(32) NOT NULL,
	orgAddress2 VARCHAR(32),
	orgCity VARCHAR(16) NOT NULL,
	orgState CHAR(2) NOT NULL,
	orgZip VARCHAR (10) NOT NULL,
	orgHours VARCHAR(16),

	UNIQUE(orgName),
	INDEX(orgType),
	INDEX(orgCity),
	INDEX(orgState),
	INDEX(orgZip),
	PRIMARY KEY (orgId)
);

CREATE TABLE volunteer(
	volId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	volFirstName VARCHAR(16) NOT NULL,
	volLastName VARCHAR(16) NOT NULL,
	volEmail VARCHAR(128) NOT NULL,
	volEmailActivation VARCHAR(16),
	volPhone VARCHAR(32),

	UNIQUE(volEmail),
	INDEX(orgId),
	FOREIGN KEY(orgId) REFERENCES organization(orgId),
	PRIMARY KEY(volId)
);

CREATE TABLE administrator(

);

CREATE TABLE listing(

);

CREATE TABLE message(

);