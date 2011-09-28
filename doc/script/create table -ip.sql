CREATE TABLE ipligence (
	ip_from INT UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000',
	ip_to INT UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000',
	country_code VARCHAR(10) NOT NULL,
	country_name VARCHAR(255) NOT NULL,
	continent_code VARCHAR(10) NOT NULL,
	continent_name VARCHAR(255) NOT NULL,
	PRIMARY KEY( ip_to)
);


SELECT country_name , country_code FROM ipligence
WHERE ip_from <= '3515134258' AND ip_to >= '3515134258' LIMIT 1;

ipligence