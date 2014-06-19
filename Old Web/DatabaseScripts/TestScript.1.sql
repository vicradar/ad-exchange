CREATE TABLE AdItem (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	identifier VARCHAR(32) NOT NULL,
	isActive BOOL DEFAULT 1,
	targetProtocol VARCHAR(255),
	rootFileIdentifier VARCHAR(32),
	platformIdentifier VARCHAR(32),

	UNIQUE (identifier),
	INDEX (identifier),
	INDEX (platformIdentifier, isActive)

);
----
CREATE TABLE AdPlatform (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	identifier VARCHAR(32) NOT NULL,
	value VARCHAR(32) NOT NULL,
	displayName VARCHAR(255),

	UNIQUE (identifier),
	UNIQUE (value),
	INDEX (identifier),
	INDEX (value)
);
----
CREATE TABLE AdFile (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	identifier VARCHAR(32) NOT NULL,
	adItemIdentifier VARCHAR(32) NOT NULL,
	
	sourceUrl VARCHAR(4096),
	usedAsPath VARCHAR(4096),
	originalName VARCHAR(255),
	fileHash VARCHAR(64),

	INDEX (identifier),
	INDEX (adItemIdentifier)
);