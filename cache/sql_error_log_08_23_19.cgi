
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Fri, 23 Aug 2019 17:56:51 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 78.84.193.110 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT pid FROM posts WHERE topic_id IN (0,33724,19512,27576,24620,21317,20965,7540,5972,2745,4607,2666,2446,1848,1845,1726,1748,19,1255) AND new_topic=1
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