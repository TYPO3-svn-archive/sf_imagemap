#
# Table structure for table 'tx_sfimagemap_map'
#
CREATE TABLE tx_sfimagemap_map (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	
	name varchar(255) DEFAULT '0' NOT NULL,
	alt varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,

	image blob NOT NULL,
	width int(11) DEFAULT '0' NOT NULL,
	height int(11) DEFAULT '0' NOT NULL,

	areas blob NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_sfimagemap_area'
#
CREATE TABLE tx_sfimagemap_area (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '0' NOT NULL,
	alt varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,

	mid int(11) DEFAULT '0' NOT NULL,
	image blob NOT NULL,
	active tinyint(3) DEFAULT '0' NOT NULL,
    coordinates text NOT NULL,

    content blob NOT NULL,
	map int(11) DEFAULT '0' NOT NULL,
    page tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);