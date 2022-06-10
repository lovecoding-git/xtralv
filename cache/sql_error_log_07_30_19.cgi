
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 30 Jul 2019 13:15:37 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 92.49.26.76 - /index.php?app=core&module=search&do=search&fromMainBar=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: UPDATE search_sessions SET session_updated=1564492537,session_data='a:1:{s:18:\"search_app_filters\";N;}' WHERE session_id='3e64fe33435e6e5c6671eec3f9adaabf'
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/core/modules_public/search/search.php          | [db_main_mysql].update                                                        | 817               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search]._endSession                                       | 191               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 30 Jul 2019 15:04:20 +0000
 Error: 2006 - MySQL server has gone away
 IP Address: 77.219.2.236 - /index.php?app=core&module=search&section=search&do=search&fromsearch=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.*, m.member_id as my_member_id,p.*,pp.*,g.*,ccb.cache_content FROM members m  LEFT JOIN pfields_content p ON ( p.member_id=m.member_id ) 
 LEFT JOIN profile_portal pp ON ( pp.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id=m.member_group_id ) 
 LEFT JOIN content_cache_sigs ccb ON ( ccb.cache_content_id=m.member_id )   WHERE m.member_id=13835
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/sources/base/ipsMember.php                                  | [IPSMember].load                                                              | 2949              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/extensions/search/format.php            | [IPSMember].buildDisplayData                                                  | 192               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/search/controller.php                       | [search_format_forums].parseAndFetchHtmlBlocks                                | 556               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [IPSSearch].search                                                            | 671               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/core/modules_public/search/search.php          | [public_core_search_search].searchResults                                     | 173               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_core_search_search].doExecute                                         | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Tue, 30 Jul 2019 17:50:09 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 188.112.136.77 - /index.php?app=core&module=search&do=search&andor_type=&sid=833c6ca9ec64578d8dc32cfa8b4ef754&search_app_filters[forums][sortKey]=date&search_app_filters[forums][sortKey]=date&search_app_filters[forums][sortDir]=0&search_app_filters[forums][searchInKey]=&search_term=27304610&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT COUNT(*) as total_results FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%27304610%' OR p.signature LIKE '%27304610%' OR p.pp_about_me LIKE '%27304610%') AND g.g_hide_from_list = 0
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
 Date: Tue, 30 Jul 2019 17:50:20 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 188.112.136.77 - /index.php?app=core&module=search&do=search&andor_type=&sid=833c6ca9ec64578d8dc32cfa8b4ef754&search_app_filters[classifieds][sortKey]=price&search_app_filters[classifieds][sortKey]=price&search_app_filters[classifieds][searchInKey]=&search_term=27304610&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.* FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%27304610%' OR p.signature LIKE '%27304610%' OR p.pp_about_me LIKE '%27304610%') AND g.g_hide_from_list = 0 ORDER BY member_id desc LIMIT 0,25
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