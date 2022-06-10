
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:22:59 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 185.65.163.25 - /topic/90868-20574225-anja/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT t.*,f.name as forum_name, f.forum_allow_rating, f.name_seo,ms.member_group_id as starter_group_id,mss.member_group_id as last_poster_group_id,pp.*,xxx.* FROM topics t  LEFT JOIN forums f ON ( f.id=t.forum_id ) 
 LEFT JOIN members ms ON ( ms.member_id=t.starter_id ) 
 LEFT JOIN members mss ON ( mss.member_id=t.last_poster_id ) 
 LEFT JOIN profile_portal pp ON ( pp.pp_member_id=mss.member_id ) 
 LEFT JOIN core_tags_cache xxx ON ( xxx.tag_cache_key=MD5(CONCAT('forums',';','topics',';',t.tid)) )   WHERE t.tid <> 90868 AND t.approved = 1 AND t.forum_id IN (3,14,24,41,43,7,25,26,35,33,34,38,31,37,53,54,55,63,64,65,66,60) AND (LOWER(t.title) LIKE '%20574225%' OR LOWER(t.description) LIKE '%20574225%') ORDER BY t.last_post DESC LIMIT 0,5
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | hooks/dp3similarTopicsBelow_40d8a08d3fe249d6df628f063ae787f0.php           | [dp3similarTopicsLib].showSimilarTopics                                       | 46                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/output/publicOutput.php                     | [dp3similarTopicsBelow].getOutput                                             | 3785              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/output/publicOutput.php                     | [output].templateHooks                                                        | 2972              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/modules_public/forums/topics.php        | [output].sendOutput                                                           | 412               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_topics].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 96.44.147.122 - /topic/87206-belinda-28922070/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT t.*,f.name as forum_name, f.forum_allow_rating, f.name_seo,ms.member_group_id as starter_group_id,mss.member_group_id as last_poster_group_id,pp.*,xxx.* FROM topics t  LEFT JOIN forums f ON ( f.id=t.forum_id ) 
 LEFT JOIN members ms ON ( ms.member_id=t.starter_id ) 
 LEFT JOIN members mss ON ( mss.member_id=t.last_poster_id ) 
 LEFT JOIN profile_portal pp ON ( pp.pp_member_id=mss.member_id ) 
 LEFT JOIN core_tags_cache xxx ON ( xxx.tag_cache_key=MD5(CONCAT('forums',';','topics',';',t.tid)) )   WHERE t.tid <> 87206 AND t.approved = 1 AND t.forum_id IN (14,24,41,43,7,25,26,35,53,54,55,63,64,65,66,60) AND (LOWER(t.title) LIKE '%belinda%' OR LOWER(t.description) LIKE '%belinda%' OR LOWER(t.title) LIKE '%28922070%' OR LOWER(t.description) LIKE '%28922070%') ORDER BY t.last_post DESC LIMIT 0,5
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | hooks/dp3similarTopicsBelow_40d8a08d3fe249d6df628f063ae787f0.php           | [dp3similarTopicsLib].showSimilarTopics                                       | 46                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/output/publicOutput.php                     | [dp3similarTopicsBelow].getOutput                                             | 3785              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/classes/output/publicOutput.php                     | [output].templateHooks                                                        | 2972              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/modules_public/forums/topics.php        | [output].sendOutput                                                           | 412               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_topics].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 212.3.198.219 - /forum/24-prostit%C5%ABtas-eskort-meitenes-r%C4%ABg%C4%81/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.*, m.member_id as my_member_id,p.*,pp.*,g.*,ccb.cache_content FROM members m  LEFT JOIN pfields_content p ON ( p.member_id=m.member_id ) 
 LEFT JOIN profile_portal pp ON ( pp.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id=m.member_group_id ) 
 LEFT JOIN content_cache_sigs ccb ON ( ccb.cache_content_id=m.member_id )   WHERE m.member_id IN (38452,7955,44099,1,27091,9609,32766,13098,45930,43464,14111,31869,48293,38440,11752,37362,9026,39056,32995,6480,16697,9854,46925,40218,17050,29378,9258,46551,44455,12052,6447,46532,46155,44826,30969,2977,38708,14199,28514,28889,11897,7282,7056,44487,44725)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/modules_public/forums/forums.php        | [IPSMember].load                                                              | 1057              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/modules_public/forums/forums.php        | [public_forums_forums_forums].renderForum                                     | 457               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/modules_public/forums/forums.php        | [public_forums_forums_forums].showForum                                       | 147               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_forums].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 46.109.51.242 - /
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT s.id, s.member_id, s.member_name, s.seo_name, s.login_type, s.running_time, s.member_group, s.uagent_type,m.member_banned FROM sessions s  LEFT JOIN members m ON ( m.member_id=s.member_id )   WHERE running_time > 1565002982
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/modules_public/forums/boards.php        | [public_forums_forums_boards].getActiveUserDetails                            | 56                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_boards].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 91.105.68.93 - /index.php?app=core&module=search&do=search&fromMainBar=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT p.*,t.*,m.member_id, m.members_display_name, m.members_seo_name,cca.*,ccb.cache_content as cache_content_sig, ccb.cache_updated as cache_updated_sig,xxx.* FROM posts p  LEFT JOIN topics t ON ( t.tid=p.topic_id ) 
 LEFT JOIN members m ON ( m.member_id=p.author_id ) 
 LEFT JOIN content_cache_posts cca ON ( cca.cache_content_id=p.pid ) 
 LEFT JOIN content_cache_sigs ccb ON ( ccb.cache_content_id=p.author_id ) 
 LEFT JOIN core_tags_cache xxx ON ( xxx.tag_cache_key=MD5(CONCAT('forums',';','topics',';',t.tid)) )   WHERE p.pid IN( 193514,190938)
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
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 46.109.51.242 - /
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT s.id, s.member_id, s.member_name, s.seo_name, s.login_type, s.running_time, s.member_group, s.uagent_type,m.member_banned FROM sessions s  LEFT JOIN members m ON ( m.member_id=s.member_id )   WHERE running_time > 1565002982
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/modules_public/forums/boards.php        | [public_forums_forums_boards].getActiveUserDetails                            | 56                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_boards].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 159.148.164.241 - /index.php?s=1537ba46f8184a38d2d11184ed970099&&app=forums&module=ajax&section=recentTopics
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT t.*,m1.members_display_name as nome1, m1.members_seo_name, m1.member_group_id as grupo1,xxx.* FROM topics t  LEFT JOIN members m1 ON ( m1.member_id=t.starter_id ) 
 LEFT JOIN core_tags_cache xxx ON ( xxx.tag_cache_key=MD5(CONCAT('forums',';','topics',';',t.tid)) )   WHERE t.last_post > 1565003246 AND t.approved = 1 AND t.forum_id in(14,24,41,43,7,25,26,35,62,53,54,55,63,64,65,66,60) ORDER BY t.last_post desc LIMIT 0,3
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/modules_public/ajax/recentTopics.php    | [public_forums_ajax_recentTopics].recentTopics                                | 25                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_ajax_recentTopics].doExecute                                   | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 5.45.207.47 - /user/36837-you/?tab=status&setlanguage=1&langurlbits=user/36837-you/&tab=status&langid=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.*, m.member_id as my_member_id,p.*,pp.*,g.*,s.*,ccb.cache_content FROM members m  LEFT JOIN pfields_content p ON ( p.member_id=m.member_id ) 
 LEFT JOIN profile_portal pp ON ( pp.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id=m.member_group_id ) 
 LEFT JOIN sessions s ON ( s.member_id=m.member_id ) 
 LEFT JOIN content_cache_sigs ccb ON ( ccb.cache_content_id=m.member_id )   WHERE m.member_id=36837
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/members/modules_public/profile/view.php        | [IPSMember].load                                                              | 224               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/members/modules_public/profile/view.php        | [public_members_profile_view]._viewModern                                     | 64                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_members_profile_view].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 80.89.78.63 - /topic/91201-eva-29751773/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT p.*,m.member_id as mid,m.name,m.member_group_id,m.email,m.joined,m.posts, m.last_visit, m.last_activity,m.login_anonymous,m.title as member_title, m.warn_level, m.warn_lastwarn, m.members_display_name, m.members_seo_name, m.member_banned, m.has_gallery, m.has_blog, m.members_bitoptions,m.mgroup_others,pp.*,pc.*,rep_index.rep_rating as has_given_rep,rep_cache.rep_points, rep_cache.rep_like_cache,cca.*,ccb.cache_content as cache_content_sig, ccb.cache_updated as cache_updated_sig FROM ( SELECT pid, post_date FROM posts WHERE topic_id=91201 AND  queued=0  ORDER BY pid asc LIMIT 0,20 ) z  LEFT JOIN posts p ON ( p.pid=z.pid ) 
 LEFT JOIN members m ON ( m.member_id=p.author_id ) 
 LEFT JOIN profile_portal pp ON ( m.member_id=pp.pp_member_id ) 
 LEFT JOIN pfields_content pc ON ( pc.member_id=p.author_id ) 
 LEFT JOIN reputation_index rep_index ON ( rep_index.app='forums' AND 
						             rep_index.type='pid' AND 
						             rep_index.type_id=p.pid AND 
						             rep_index.member_id=0 ) 
 LEFT JOIN reputation_cache rep_cache ON ( rep_cache.app='forums' AND rep_cache.type='pid' AND rep_cache.type_id=p.pid ) 
 LEFT JOIN content_cache_posts cca ON ( cca.cache_content_id=p.pid ) 
 LEFT JOIN content_cache_sigs ccb ON ( ccb.cache_content_id=m.member_id )   ORDER BY z.pid asc
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/modules_public/forums/topics.php        | [public_forums_forums_topics]._getPosts                                       | 208               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_topics].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 11:23:45 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 159.148.164.241 - /forum/25-erotisk%C4%81-mas%C4%81%C5%BEa/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT m.*, m.member_id as my_member_id,p.*,pp.*,g.*,ccb.cache_content FROM members m  LEFT JOIN pfields_content p ON ( p.member_id=m.member_id ) 
 LEFT JOIN profile_portal pp ON ( pp.pp_member_id=m.member_id ) 
 LEFT JOIN groups g ON ( g.g_id=m.member_group_id ) 
 LEFT JOIN content_cache_sigs ccb ON ( ccb.cache_content_id=m.member_id )   WHERE m.member_id IN (44099,47262,18071,12141,46731,13972,10220,28857,9017,45745,29965,45667,46773,32252,9390,7941,17051,12773,31990,47482,32508,31662,28060,10586,73,7282,14495,30199,9056,12730,1547,32766,6866,24627,23479,33340,6480,6816,36893,46444,9433,9550,16697,22276,46194,9258,45457)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | administracija/applications/forums/modules_public/forums/forums.php        | [IPSMember].load                                                              | 1057              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/modules_public/forums/forums.php        | [public_forums_forums_forums].renderForum                                     | 457               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/applications/forums/modules_public/forums/forums.php        | [public_forums_forums_forums].showForum                                       | 147               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | administracija/sources/base/ipsController.php                              | [public_forums_forums_forums].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 05 Aug 2019 19:23:32 +0000
 Error: 2013 - Lost connection to MySQL server during query
 IP Address: 80.89.79.109 - /index.php?app=core&module=search&do=search&fromMainBar=1
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT author_id, topic_id FROM posts WHERE  queued=0  AND author_id=0 AND topic_id IN(92029,91936,91661,82206,90501,76045,74679,74693,75338,86909,78276,4841,74846,12282,11490,2527,53865,2729,51827,48580,27735)
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