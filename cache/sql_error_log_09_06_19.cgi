
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Fri, 06 Sep 2019 07:03:25 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 78.84.177.197 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT author_id, topic_id FROM posts WHERE  queued=0  AND author_id=0 AND topic_id IN(74846,34713,44481,41571,39773,37004,8259,2282)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/sources/classes/search/controller.php                       | [search_format_forums].processResults                                         | 553               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Fri, 06 Sep 2019 07:03:24 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 78.84.177.197 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT author_id, topic_id FROM posts WHERE  queued=0  AND author_id=0 AND topic_id IN(74846,34713,44481,41571,39773,37004,8259,2282)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/sources/classes/search/controller.php                       | [search_format_forums].processResults                                         | 553               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Fri, 06 Sep 2019 20:24:52 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 81.198.231.221 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT p.pid, p.queued,t.approved, t.forum_id FROM posts p  LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE t.forum_id IN (14,24,41,43,7,25,26,35,53,54,55,63,64,65,66,60) AND  p.queued=0  AND  t.approved=1  AND  t.topic_archive_status IN (0,3)  AND MATCH( p.post ) AGAINST( 'jana' IN BOOLEAN MODE ) AND t.state != 'link' ORDER BY post_date desc LIMIT 0,200
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/extensions/search/engines/sql.php       | [search_engine_forums]._buildWhereStatement                                   | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/search/controller.php                       | [search_engine_forums].search                                                 | 544               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'