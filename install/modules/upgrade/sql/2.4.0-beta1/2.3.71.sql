ALTER TABLE {SQL_PREFIX}mod_poll_votes
	CHANGE ip ip VARCHAR( 38 ) NOT NULL;

ALTER TABLE {SQL_PREFIX}mod_session
	CHANGE ip ip VARCHAR( 38 ) NOT NULL;