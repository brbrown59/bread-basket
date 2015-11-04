DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS listing;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS volunteer;
DROP TABLE IF EXISTS organization;

CREATE TABLE organization (
	orgId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgAddress1 VARCHAR(64) NOT NULL,
	orgAddress2 VARCHAR(64),
	orgCity VARCHAR(24) NOT NULL,
	orgDescription VARCHAR(255),
	orgHours VARCHAR(64),
	orgName VARCHAR(128) NOT NULL,
	orgPhone VARCHAR(32) NOT NULL,
	orgState CHAR(2) NOT NULL,
	orgType CHAR(1) NOT NULL,
	orgZip VARCHAR(10) NOT NULL,
	UNIQUE(orgName),
	INDEX(orgCity),
	INDEX(orgState),
	INDEX(orgType),
	INDEX(orgZip),
	PRIMARY KEY(orgId)
);

CREATE TABLE volunteer (
	volId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	volEmail VARCHAR(128) NOT NULL,
	volEmailActivation CHAR(16),
	volFirstName VARCHAR(32) NOT NULL,
	volLastName VARCHAR(32) NOT NULL,
	volPhone VARCHAR(32) NOT NULL,
	UNIQUE(volEmail),
	INDEX(orgId),
	FOREIGN KEY(orgId) REFERENCES organization(orgId),
	PRIMARY KEY(volId)
);

CREATE TABLE administrator (
	adminId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	volId INT UNSIGNED NOT NULL,
	adminEmail VARCHAR(128) NOT NULL,
	adminEmailActivation CHAR(16),
	adminFirstName VARCHAR(32) NOT NULL,
	adminHash CHAR(128) NOT NULL,
	adminLastName VARCHAR(32) NOT NULL,
	adminPhone VARCHAR(32),
	adminSalt CHAR(64) NOT NULL,
	UNIQUE (adminEmail),
	INDEX (orgId),
	INDEX (volId),
	FOREIGN KEY (orgId) REFERENCES organization (orgId),
	FOREIGN KEY (volId) REFERENCES volunteer (volId),
	PRIMARY KEY (adminId)
);

CREATE TABLE listingType (
	listingTypeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	listingType VARCHAR(32) NOT NULL,
	PRIMARY KEY(listingTypeId)
);

CREATE TABLE listing (
	listingId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	listingClaimedBy INT UNSIGNED,
	listingClosed TINYINT UNSIGNED NOT NULL,
	listingCost DOUBLE NOT NULL,
	listingMemo VARCHAR(255) NOT NULL,
	listingParentId INT UNSIGNED,
	listingPostTime DATETIME NOT NULL,
	listingTypeId INT UNSIGNED,
	INDEX (orgId),
	INDEX (listingParentId),
	INDEX (listingPostTime),
	INDEX (listingTypeId),
	FOREIGN KEY (orgId) REFERENCES organization(orgId),
	FOREIGN KEY (listingTypeId) REFERENCES listingType(listingTypeId),
	PRIMARY KEY (listingId)
);

CREATE TABLE message (
	messageId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	listingId INT UNSIGNED NOT NULL,
	orgId INT UNSIGNED NOT NULL,
	messageText VARCHAR(255) NOT NULL,
	INDEX (listingId),
	INDEX (orgId),
	FOREIGN KEY (listingId) REFERENCES listing(listingId),
	FOREIGN KEY (orgId) REFERENCES organization(orgId),
	PRIMARY KEY (messageID)
);