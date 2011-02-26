CREATE TABLE IF NOT EXISTS `DNJChat_log` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user` tinytext NOT NULL,
  `date` tinytext NOT NULL,
  `text` text NOT NULL,
  `role` tinytext NOT NULL,
  `time` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11403 ;

CREATE TABLE IF NOT EXISTS `DNJChat_online` (
  `user` tinytext NOT NULL,
  `date` tinytext NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `DNJChat_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `role` tinytext NOT NULL,
  `lastaction` tinytext NOT NULL,
  `mutet` tinytext NOT NULL,
  `scroll` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;