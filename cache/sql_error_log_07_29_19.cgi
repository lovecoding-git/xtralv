
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 29 Jul 2019 05:37:30 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 87.110.87.108 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.* FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%rnadom%' OR p.signature LIKE '%rnadom%' OR p.pp_about_me LIKE '%rnadom%') AND g.g_hide_from_list = 0 ORDER BY member_id desc LIMIT 0,25
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
 Date: Mon, 29 Jul 2019 05:37:32 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 87.110.87.108 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.* FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%random%' OR p.signature LIKE '%random%' OR p.pp_about_me LIKE '%random%') AND g.g_hide_from_list = 0 ORDER BY member_id desc LIMIT 0,25
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
 Date: Mon, 29 Jul 2019 11:08:08 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 80.89.79.213 - /index.php?app=core&module=search&do=search&andor_type=&sid=38e31b7e840bbf90966bab6acee85b70&cType=topic&cId=44556&search_app_filters[members][searchInKey]=members&search_app_filters[members][members][sortKey]=date&search_term=domenika&search_app=members&search_app_filters[members][searchInKey]=members&search_app_filters[members][members][sortKey]=title&search_app_filters[members][members][sortDir]=
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT COUNT(*) as total_results FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%domenika%' OR p.signature LIKE '%domenika%' OR p.pp_about_me LIKE '%domenika%') AND g.g_hide_from_list = 0
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