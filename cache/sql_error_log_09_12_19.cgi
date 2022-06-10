
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 12 Sep 2019 18:22:46 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 78.84.21.230 - /index.php?app=core&module=search&do=search&andor_type=&sid=5d566eec3f45c075809b64b8fddfc89a&search_app_filters[forums][sortKey]=date&search_app_filters[forums][sortKey]=date&search_app_filters[forums][searchInKey]=&search_term=25278038&search_app=forums&search_app_filters[forums][searchInKey]=&search_app_filters[forums][sortKey]=date&search_app_filters[forums][sortDir]=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: UPDATE sessions SET search_thread_id=0,search_thread_time=0 WHERE id='e09f83e06e1129db1c6fa145582cb9f7'
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