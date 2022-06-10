<?php

/*******************************************************
NOTE: This is a cache file generated by IP.Board on Fri, 27 Jan 2012 09:00:04 +0000 by deniss
Do not translate this file as you will lose your translations next time you edit via the ACP
Please translate via the ACP
*******************************************************/



$lang = array( 
'acronyms' => "Acronym Expansion",
'acronyms_add' => "Add Acronym",
'acronyms_edit' => "Edit Acronym",
'acronyms_long' => "Long Version",
'acronyms_none' => "No acronyms have been set up.",
'acronyms_none_add' => "Click here to add an acronym",
'acronyms_semantic' => "Uses acronym tag?",
'acronyms_semantic_desc' => "If yes, rather than replacing the acronym entirely, a HTML acronym tag will be used.",
'acronyms_short' => "Acronym",
'acronyms_short_desc' => "When the user uses this acronym in a post, it will be replaced with the long version you enter below.",
'acronym_deleted' => "Acronym Deleted",
'acronym_delete_confirm' => "Are you sure you want to delete this acronym?",
'acronym_saved' => "Acronym Saved",
'atn_htaccess_mod_rewrite_desc' => "You are currently not using .htaccess style FURLs.",
'atn_htaccess_mod_rewrite_title' => ".htaccess mod_rewrite FURLs disabled",
'atn_ipseo_no_meta_desc' => "You have not defined any custom meta tags in IP.SEO.",
'atn_ipseo_no_meta_title' => "No Meta Tags Defined",
'atn_seo_bad_url_desc' => "You are not currently redirecting bad permalinks, the recommended setting is to \"Redirect to the correct link with a 301 header\".",
'atn_seo_bad_url_title' => "Bad Links Not Redirected",
'atn_seo_index_md_desc' => "You have not defined a meta description for your Board Index.",
'atn_seo_index_md_title' => "No Board Index Description",
'atn_seo_index_title_desc' => "You have not defined a title tag for your Board Index.",
'atn_seo_index_title_title' => "No Board Index Title",
'atn_seo_r_on_desc' => "You have not enabled redirects from old style URLs to new FURLs.",
'atn_seo_r_on_title' => "FURL Redirect Not Enabled",
'atn_sitemap_not_run_desc' => "The sitemap generator has not yet been run.",
'atn_sitemap_not_run_title' => "Sitemap Not Generated Yet",
'atn_sitemap_path_desc' => "IP.SEO was unable to locate a sitemap.xml file in your specified sitemap location. Click the fix button to download a blank sitemap.xml file and upload it to your forum root (or the custom path specified in the sitemap settings) and ensure it can be written to (CHMOD 0777).",
'atn_sitemap_path_title' => "Sitemap Not Writeable",
'atn_sitemap_ping_desc' => "You have set the sitemap generator to not ping the search engines when updated, this is not advisable.",
'atn_sitemap_ping_title' => "Sitemap Ping Disabled",
'atn_sitemap_success_desc' => "The sitemap generator did not finish the last run, this may be because you tried to run it manually from the Admin CP.",
'atn_sitemap_success_title' => "Sitemap Generation Failed",
'atn_spider_group_desc' => "You are treating spiders as a member of a different group than your guest group - This will lead to search engines seeing the board differently than guests, also known as cloaking.",
'atn_spider_group_title' => "Spiders Not Treated as Guests",
'atn_spider_visit_desc' => "IP.SEO cannot generate spider visit charts and statistics without this enabled.",
'atn_spider_visit_title' => "Not Logging Spider Visits",
'atn_url_type_desc' => "You are currently using query string based FURLs. The advised setting is Path Info.",
'atn_url_type_title' => "Query String FURLs",
'attention_clear_warnings' => "Restore Ignored Warnings",
'attention_fix' => "Fix this problem",
'attention_ignore' => "Ignore this problem",
'attention_none' => "There are no items to display.",
'attention_title' => "Items Requiring Attention",
'dashboard_all' => "View All &rarr;",
'dashboard_graphs_date' => "Graph Range",
'dashboard_graphs_day' => "Last 24 Hours",
'dashboard_graphs_month' => "Last 28 Days",
'dashboard_graphs_week' => "Last 7 Days",
'dashboard_keywords' => "Top Search Keywords",
'dashboard_spiders' => "Latest Spider Hits",
'dashboard_title' => "Dashboard",
'dashboard_visitors' => "Latest Search Visitors",
'err_acronym_details' => "You did not fill in the entire form. You must specify an acronym and the long version.",
'err_acronym_toolong' => "Both the acronym and the long version cannot be longer than 255 characters.",
'err_no_acronym' => "Could not find the acronym you are trying to edit.",
'err_no_page' => "You did not specify a page URI",
'keywords_blurb' => "This page shows you the most popular keywords that users search for to find your community.",
'keywords_count' => "Hits",
'keywords_keyword' => "Keyword",
'keywords_none' => "There are no results to display.",
'keywords_title' => "Search Keywords",
'meta_add' => "Add Meta Tags",
'meta_blurb' => "This page allows you to set up meta tags to display on certain areas of your community.",
'meta_magic' => "Launch Live Meta Tag Editor",
'meta_none' => "You do not have any meta tags set up yet.",
'meta_none_add' => "Click here to set up meta tags.",
'meta_page' => "Page URI",
'meta_page_desc' => "Enter the URI (without your domain) which the meta tags you will specify should be displayed on. For example, entering '/members/' allows you to specify meta tags to show on the member list.<br /><br />You may use * as a wildcard, for example entering '/user/*' will allow you to specify meta tags to show on all user profiles.",
'meta_save' => "Save",
'meta_tags' => "Meta Tags",
'meta_tag_add' => "Add Tag",
'meta_tag_content' => "Content",
'meta_tag_edit' => "Edit Tag",
'meta_tag_title' => "Title",
'meta_tag_title_desc' => "e.g. 'description', 'keywords', 'robots', etc.",
'meta_title' => "Meta Tags",
'sitemap' => "IP.SEO Sitemap",
'sitemaplog_action' => "Action",
'sitemaplog_lastran' => "Last Run: %s",
'sitemaplog_log' => "Log",
'sitemaplog_time' => "Time",
'sitemaplog_title' => "Sitemap: Last Run",
'sitemap_cron_1' => "<ol style='margin: 10px 30px; line-height: 150%; list-style-type: square;'><li>Go to the 'System' tab</li><li>Find 'System Scheduler' in the menu</li><li>Go to the 'IP.SEO' tab in the System Scheduler</li><li>Find 'Sitemap Generator', and click the little down arrow on the end of the row - Go to 'Edit Task'</li><li>Find the 'Enable Task?' option and set this to 'No'</li><li>Save the task by clicking the 'Edit Task' button.</li></ol>",
'sitemap_cron_2' => "<ol style='margin: 10px 30px; line-height: 150%; list-style-type: square;'><li>Log into your server via SSH</li><li>Type 'crontab -e' (without quotes)</li><li>Add to the bottom of the file, the following line:</li></ol><pre>0 * * * * {path}</pre><ol style='margin: 10px 30px; line-height: 150%; list-style-type: square;'><li>Save the file and close the command-line text editor.</li><li>Cron will now run the sitemap generator once per hour.</li></ol>",
'sitemap_cron_3' => "<strong>Important!</strong> If you intend to generate a large sitemap (10,000 URLs or more), then you should probably run this task less often, as it can be quite resource intensive. You may also need to change the path to PHP if this is not correct for your server.",
'sitemap_cron_header1' => "Step One",
'sitemap_cron_header2' => "Step Two",
'sitemap_cron_title' => "How to run IP.SEO sitemap generator via Cron",
'sitemap_forum_priority' => "Sitemap Priority",
'sitemap_forum_priority_desc' => "This will set the priority given in the site map for the forum itself. If you have set to calculate topic scores automatically, this will also influence the topic priority for topics inside this forum.",
'sitemap_priority_ignore' => "Do not include",
'sitemap_priority_inherit' => "Use default",
'spiders_date' => "Date",
'spiders_none' => "There are no results to display.",
'spiders_page' => "Page",
'spiders_spider' => "Spider",
'visitors_blurb' => "This page shows you the users the users that found your community by a search engine",
'visitors_date' => "Date",
'visitors_engine' => "Search Engine",
'visitors_keywords' => "Search Keywords",
'visitors_member' => "Member",
'visitors_none' => "There are no results to display.",
'visitors_page' => "Page Found",
'visitors_title' => "Search Visitors",
 ); 