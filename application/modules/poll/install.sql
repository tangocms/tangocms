DROP TABLE IF EXISTS {SQL_PREFIX}mod_poll;
CREATE TABLE {SQL_PREFIX}mod_poll (
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  start_date datetime NOT NULL,
  duration smallint(2) NOT NULL DEFAULT '0' COMMENT 'number of weeks',  
  UNIQUE KEY id (id),
  KEY start_date (start_date)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

INSERT INTO {SQL_PREFIX}mod_poll (id, title, duration, status, start_date) VALUES
(1, 'Which music service/radio do you use?', 0, 'active', NOW());

DROP TABLE IF EXISTS {SQL_PREFIX}mod_poll_options;
CREATE TABLE {SQL_PREFIX}mod_poll_options (
  id smallint(5) NOT NULL AUTO_INCREMENT,
  poll_id smallint(4) NOT NULL,
  title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY id (id),
  KEY poll_id (poll_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

INSERT INTO {SQL_PREFIX}mod_poll_options (id, poll_id, title) VALUES
(1, 1, 'Ampache'),
(2, 1, 'Jamendo'),
(3, 1, 'Last.fm');

DROP TABLE IF EXISTS {SQL_PREFIX}mod_poll_votes;
CREATE TABLE {SQL_PREFIX}mod_poll_votes (
  id mediumint(6) NOT NULL AUTO_INCREMENT,
  option_id smallint(5) NOT NULL,
  ip varchar(38) NOT NULL DEFAULT '',
  uid mediumint(6) NOT NULL DEFAULT '0',
  UNIQUE KEY id (id),
  KEY option_id (option_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;