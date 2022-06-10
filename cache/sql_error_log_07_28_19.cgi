
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Sun, 28 Jul 2019 07:27:07 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 212.3.197.235 - /index.php?app=core&module=search&do=search&andor_type=&sid=3c1936d8c508515cfd58b984ada78b3d&search_app_filters[members][searchInKey]=members&search_app_filters[members][members][sortKey]=date&search_term=24854825&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT COUNT(*) as total_results FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%24854825%' OR p.signature LIKE '%24854825%' OR p.pp_about_me LIKE '%24854825%') AND g.g_hide_from_list = 0
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