DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS listing;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS volunteer;
DROP TABLE IF EXISTS organization;

CREATE TABLE organization(
	orgId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgAddress1 VARCHAR(32) NOT NULL,
	orgAddress2 VARCHAR(32),
	orgCity VARCHAR(16) NOT NULL,
	orgDescription VARCHAR(256),
	orgHours VARCHAR(16),
	orgName VARCHAR(32) NOT NULL,
	orgPhone VARCHAR(32) NOT NULL,
	orgState CHAR(2) NOT NULL,
	orgType VARCHAR(16) NOT NULL,
	orgZip VARCHAR (10) NOT NULL,


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
	volEmail VARCHAR(128) NOT NULL,
	volEmailActivation VARCHAR(16),
	volFirstName VARCHAR(16) NOT NULL,
	volLastName VARCHAR(16) NOT NULL,
	volPhone VARCHAR(32),

	UNIQUE(volEmail),
	INDEX(orgId),
	FOREIGN KEY(orgId) REFERENCES organization(orgId),
	PRIMARY KEY(volId)
);

CREATE TABLE administrator(
	adminId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	volId INT UNSIGNED NOT NULL,
	adminEmail VARCHAR(128) NOT NULL,
	adminEmailActivation VARCHAR(16),
	adminFirstName VARCHAR(16) NOT NULL,
	adminHash CHAR(64) NOT NULL,
	adminLastName VARCHAR(16) NOT NULL,
	adminPhone VARCHAR(32),
	adminSalt CHAR(32) NOT NULL,

	INDEX(orgId),
	INDEX(volId),
	FOREIGN KEY(orgId) REFERENCES organization(orgId),
	FOREIGN KEY(volId) REFERENCES volunteer(volId),
	PRIMARY KEY(adminId)
);

CREATE TABLE listing(
	listingId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	listingClaimedBy INT UNSIGNED,
	listingClosed BOOL,
	listingCost DOUBLE NOT NULL,
	listingMemo VARCHAR(256) NOT NULL,
	listingParentId INT UNSIGNED,
	listingPostTime DATETIME NOT NULL,
	listingType VARCHAR(14) NOT NULL,


	INDEX (orgId),
	INDEX (listingParentId),
	INDEX (listingType),
	FOREIGN KEY(orgID) REFERENCES organization(orgId),
	PRIMARY KEY(listingId)
);

CREATE TABLE message(

);