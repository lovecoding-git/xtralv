
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 06 Aug 2019 08:01:47 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 87.110.115.60 - /index.php?app=core&module=search&do=search&fromMainBar=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT p.pid as id, p.post_date, p.topic_id,t.title, t.posts, t.views FROM posts p  LEFT JOIN topics t ON ( t.tid=p.topic_id )   WHERE t.forum_id IN (14,24,41,43,7,25,26,35,53,54,55,63,64,65,66,60) AND t.tid=84491 AND  p.queued=0  AND  t.approved=1  AND  t.topic_archive_status IN (0,3)  AND MATCH( p.post ) AGAINST( 'samanta' IN BOOLEAN MODE ) AND t.state != 'link' ORDER BY post_date desc LIMIT 0,201
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/sources/classes/search/controller.php                       | [search_engine_forums].search                                                 | 544               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 06 Aug 2019 18:07:28 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 78.84.226.142 - /index.php?app=core&module=search&do=search&fromMainBar=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT author_id, topic_id FROM posts WHERE  queued=0  AND author_id=0 AND topic_id IN(98376,96080,95797,95795,95072,94934,91661,94222,13243,83434,91622,91277,43628,74693,87611,1451,75996,86369,84367,84309,82074,78830,70498,74846,2270)
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
 Date: Tue, 06 Aug 2019 19:48:26 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 85.234.175.121 - /index.php?app=core&module=search&do=search&andor_type=&sid=539ef7a40b9b544c978b7ff6dd4e6621&search_app_filters[forums][sortKey]=date&cType=topic&cId=67085&search_app_filters[forums][sortKey]=date&search_app_filters[forums][searchInKey]=&search_term=EVIJA&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT COUNT(*) as total_results FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%evija%' OR p.signature LIKE '%evija%' OR p.pp_about_me LIKE '%evija%') AND g.g_hide_from_list = 0
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/members/extensions/search/engines/sql.php      | [search_engine_members]._membersSearch                                        | 62                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/search/controller.php                       | [search_engine_members].search                                                | 544               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 06 Aug 2019 19:48:30 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 85.234.175.121 - /index.php?app=core&module=search&do=search&andor_type=&sid=539ef7a40b9b544c978b7ff6dd4e6621&search_app_filters[forums][sortKey]=date&cType=topic&cId=67085&search_app_filters[forums][sortKey]=date&search_app_filters[forums][searchInKey]=&search_term=EVIJA&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.* FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%evija%' OR p.signature LIKE '%evija%' OR p.pp_about_me LIKE '%evija%') AND g.g_hide_from_list = 0 ORDER BY member_id desc LIMIT 0,25
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/members/extensions/search/engines/sql.php      | [search_engine_members]._membersSearch                                        | 62                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/search/controller.php                       | [search_engine_members].search                                                | 544               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 06 Aug 2019 19:48:36 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 85.234.175.121 - /index.php?app=core&module=search&do=search&andor_type=&sid=539ef7a40b9b544c978b7ff6dd4e6621&search_app_filters[forums][sortKey]=date&cType=topic&cId=67085&search_app_filters[forums][sortKey]=date&search_app_filters[forums][searchInKey]=&search_term=EVIJA&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.* FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%evija%' OR p.signature LIKE '%evija%' OR p.pp_about_me LIKE '%evija%') AND g.g_hide_from_list = 0 ORDER BY member_id desc LIMIT 0,25
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/members/extensions/search/engines/sql.php      | [search_engine_members]._membersSearch                                        | 62                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/search/controller.php                       | [search_engine_members].search                                                | 544               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'