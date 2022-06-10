
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Wed, 31 Jul 2019 19:06:28 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 77.219.5.205 - /index.php?app=core&module=search&do=search&andor_type=&sid=d22b77e73f0335e6538681fc30f0deee&search_app_filters[forums][sortKey]=date&cType=topic&cId=54781&search_app_filters[forums][sortKey]=date&search_app_filters[forums][searchInKey]=&search_term=Meitene91&search_app=members
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.* FROM members m  LEFT JOIN profile_portal p ON ( p.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id = m.member_group_id )   WHERE (m.members_l_display_name LIKE '%meitene91%' OR p.signature LIKE '%meitene91%' OR p.pp_about_me LIKE '%meitene91%') AND g.g_hide_from_list = 0 ORDER BY member_id desc LIMIT 0,25
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