
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Sat, 14 Sep 2019 16:18:20 +0000
 Error: 2006 - MySQL server has gone away
 IP Address: 95.68.37.234 - /index.php?app=core&module=search&do=search&fromMainBar=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: UPDATE sessions SET search_thread_id=0,search_thread_time=0 WHERE id='3a8bea65e207b02437aac5c18e3c0964'
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/sources/classes/search/controller.php                       | [db_main_mysql].update                                                        | 700               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/search/controller.php                       | [IPSSearch]._endSession                                                       | 560               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Sat, 14 Sep 2019 23:06:18 +0000
 Error: 2006 - MySQL server has gone away
 IP Address: 212.3.199.240 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT p.pid, p.queued,t.approved, t.forum_id FROM posts p  LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE t.forum_id IN (14,24,41,43,7,25,26,35,53,54,55,63,64,65,66,60) AND  p.queued=0  AND  t.approved=1  AND  t.topic_archive_status IN (0,3)  AND MATCH( p.post ) AGAINST( 'dobele' IN BOOLEAN MODE ) AND t.state != 'link' ORDER BY post_date desc LIMIT 0,200
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
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Sat, 14 Sep 2019 23:06:18 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 212.3.199.240 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT author_id, topic_id FROM posts WHERE  queued=0  AND author_id=0 AND topic_id IN(93021,47720,32086,2282,5780)
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