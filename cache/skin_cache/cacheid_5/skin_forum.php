<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 5               */
/* CACHE FILE: Generated: Mon, 28 Sep 2015 13:28:09 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_forum_5 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['forumIndexTemplate'] = array('hasUnread','forums','subforums','announcements','topics','usercanpost');


}

/* -- ajax__deleteTopic --*/
function ajax__deleteTopic() {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- forumAttachments --*/
function forumAttachments($title, $rows, $pages) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- forumIndexTemplate --*/
function forumIndexTemplate($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_forum', $this->_funcHooks['forumIndexTemplate'] ) )
{
$count_18d2fa8a326639339ea1fa4647397ce2 = is_array($this->functionData['forumIndexTemplate']) ? count($this->functionData['forumIndexTemplate']) : 0;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['forum_data'] = $forum_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['announce_data'] = $announce_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['topic_data'] = $topic_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['other_data'] = $other_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['multi_mod_data'] = $multi_mod_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['sub_forum_data'] = $sub_forum_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['footer_filter'] = $footer_filter;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['active_user_data'] = $active_user_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['mod_data'] = $mod_data;
$this->functionData['forumIndexTemplate'][$count_18d2fa8a326639339ea1fa4647397ce2]['inforum'] = $inforum;
}
$IPBHTML .= "<template>viewForum</template>
<permissions>
	<canPost>{$forum_data['_user_can_post']}</canPost>
	<canPostSoftDelete>{$forum_data['permissions']['PostSoftDelete']}</canPostSoftDelete>
	<canSoftDeleteRestore>{$forum_data['permissions']['PostSoftDeleteRestore']}</canSoftDeleteRestore>
	<canQueue>{$forum_data['permissions']['canQueue']}</canQueue>
</permissions>
<hasActionBar>1</hasActionBar>
<pagination>{$forum_data['SHOW_PAGES']}</pagination>
" . (($forum_data['_user_can_post']) ? ("
<AssessoryButtonURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "module=post&amp;section=post&amp;do=new_post&amp;f={$forum_data['id']}", "publicWithApp",'' ), "", "" ) . "]]></AssessoryButtonURL>
") : ("")) . "
<subforumSubtext>authorName|date</subforumSubtext><!--authorName|date|postTitle-->
<forum>
		
		<title><![CDATA[{$forum_data['name']}]]></title>
		<id>{$forum_data['id']}</id>
		<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showforum={$forum_data['id']}", "public",'' ), "{$forum_data['name_seo']}", "showforum" ) . "]]></url>
		
" . (($forum_data['show_rules'] == 2) ? ("
		<rules>
			<title><![CDATA[{$forum_data['rules_title']}]]></title>
			<text><![CDATA[{$forum_data['rules_text']}]]></text>
		</rules>
") : ("")) . "
" . (($forum_data['show_rules'] == 1) ? ("
		<rules>
			<title><![CDATA[{$forum_data['rules_title']}]]></title>
			<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showforum={$forum_data['id']}&amp;act=SR", "public",'' ), "", "" ) . "]]></url>
		</rules>
") : ("")) . "
" . ((is_array( $sub_forum_data ) AND count( $sub_forum_data )) ? ("
		<subforums>			
	".$this->__f__ba4d6984a2a0ccae8dad9111188023f4($forum_data,$announce_data,$topic_data,$other_data,$multi_mod_data,$sub_forum_data,$footer_filter,$active_user_data,$mod_data,$inforum)."		</subforums>
") : ("")) . "
" . ((is_array( $announce_data ) AND count( $announce_data )) ? ("
		<announcements>			
	".$this->__f__2d8dc128be20126cddcd6ba670ec334b($forum_data,$announce_data,$topic_data,$other_data,$multi_mod_data,$sub_forum_data,$footer_filter,$active_user_data,$mod_data,$inforum)."		</announcements>
") : ("")) . "
		<topics>
" . ((is_array( $topic_data ) AND count( $topic_data )) ? ("".$this->__f__919aa3ab0092eb1ee3ba9b3c20552786($forum_data,$announce_data,$topic_data,$other_data,$multi_mod_data,$sub_forum_data,$footer_filter,$active_user_data,$mod_data,$inforum)."") : ("")) . "
		</topics>
		
	</forum>";
return $IPBHTML;
}


function __f__6ea2586eca6d6b707eaef664d4e410d4($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1,$_data='')
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $_data['forum_data'] as $forum_id => $forum_data )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
			<forum>
				<id>{$forum_data['id']}</id>
				<title><![CDATA[{$forum_data['name']}]]></title>
				<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showforum={$forum_data['id']}", "public",'' ), "{$forum_data['name_seo']}", "showforum" ) . "]]></url>
				<description><![CDATA[{$forum_data['description']}]]></description>
					" . (($forum_data['redirect_on']) ? ("							
				<type>redirect</type>
					") : ("<type>{$forum_data['status']}</type>
				<topics>{$forum_data['topics']}</topics>
				<replies>{$forum_data['posts']}</replies>
						" . (($forum_data['_has_unread']) ? ("
							<isRead>0</isRead>
						") : ("
							<isRead>1</isRead>
						")) . "						
				<lastPost>
						" . (($forum_data['hide_last_info']) ? ("
					<name>{$this->lang->words['f_protected']}</name>
						") : ("<date>" . IPSText::htmlspecialchars($this->registry->getClass('class_localization')->getDate($forum_data['last_post'],"DATE", 0)) . "</date>
					<name><![CDATA[{$forum_data['last_title']}]]></name>
					<id>{$forum_data['last_id']}</id>
					<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showtopic={$forum_data['last_id']}&amp;view=getnewpost", "public",'' ), "{$forum_data['seo_last_title']}", "showtopic" ) . "]]></url>
					<user>
							" . (($forum_data['last_poster_id']) ? ("						
						<id>{$forum_data['last_poster_id']}</id>
						<name><![CDATA[{$forum_data['last_poster_name']}]]></name>
						<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showuser={$forum_data['last_poster_id']}", "public",'' ), "{$forum_data['seo_last_name']}", "showuser" ) . "]]></url>										
							") : ("
						<id>0</id>
						<name><![CDATA[{$this->settings['guest_name_pre']}{$forum_data['last_poster_name']}{$this->settings['guest_name_suf']}]]></name>
						<url></url>
							")) . "
					</user>")) . "
				</lastPost>")) . "
			</forum>
			
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

function __f__ba4d6984a2a0ccae8dad9111188023f4($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $sub_forum_data as $_data )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		" . ((is_array( $_data['forum_data'] ) AND count( $_data['forum_data'] )) ? ("					
			".$this->__f__6ea2586eca6d6b707eaef664d4e410d4($forum_data,$announce_data,$topic_data,$other_data,$multi_mod_data,$sub_forum_data,$footer_filter,$active_user_data,$mod_data,$inforum,$_data)."		") : ("")) . "
	
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

function __f__2d8dc128be20126cddcd6ba670ec334b($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $announce_data as $aid => $adata )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
			<announcement>
				<id>{$adata['announce_id']}</id>
				<title><![CDATA[{$adata['announce_title']}]]></title>
				<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showannouncement={$adata['announce_id']}&amp;f={$forum_data['id']}", "public",'' ), "%%{$adata['announce_title']}%%", "showannouncement" ) . "]]></url>
				<user>
					<id>{$adata['member_id']}</id>
					<name><![CDATA[{$adata['member_name']}]]></name>
					<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showuser={$adata['member_id']}", "public",'' ), "{$adata['members_seo_name']}", "showuser" ) . "]]></url>
				</user>
			</announcement>
	
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

function __f__9fb17e045c11927f72bea708ed51d13d($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1,$tid='',$data='')
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $data['pages'] as $page )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
				<page>					
					<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showtopic={$data['tid']}&amp;st={$page['st']}", "public",'' ), "{$data['title_seo']}", "showtopic" ) . "]]></url>
					<number>{$page['page']}</number>
				</page>
			
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

function __f__919aa3ab0092eb1ee3ba9b3c20552786($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $topic_data as $tid => $data )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
			<topic>
				<id>{$data['tid']}</id>
				<pinned>{$data['pinned']}</pinned>
				<icon>{$data['folder_img']}</icon>
				<title><![CDATA[{$data['title']}]]></title>
				<description><![CDATA[{$data['description']}]]></description>
				<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showtopic={$data['tid']}", "public",'' ), "{$data['title_seo']}", "showtopic" ) . "]]></url>
				<isRead>{$data['folder_img']['is_read']}</isRead>
	
				
				<user>
					<id>{$data['starter_id']}</id>
					<name><![CDATA[{$data['starter_name']}]]></name>
					<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showuser={$data['starter_id']}", "public",'' ), "{$data['seo_first_name']}", "showuser" ) . "]]></url>
				</user>
				<replies>{$data['_posts']}</replies>
				<views>{$data['views']}</views>
				<lastPost>
					<date>{$data['last_post']}</date>
					<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showtopic={$data['tid']}&amp;view=getnewpost", "public",'' ), "{$data['title_seo']}", "showtopic" ) . "]]></url>
					<user>
						<id>{$data['last_poster_id']}</id>
						<name><![CDATA[{$data['last_poster_name']}]]></name>
						<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showuser={$data['last_poster_id']}", "public",'' ), "{$data['seo_last_name']}", "showuser" ) . "]]></url>
					</user>
				</lastPost>
		" . (($data['topic_hasattach']) ? ("
				<attachments>
					<url><![CDATA[{$this->settings['base_url']}app=forums&amp;module=forums&amp;section=attach&amp;tid={$data['tid']}]]></url>
					<count>" . intval($data['topic_hasattach']) . "</count>
				</attachments>
		") : ("")) . "
		" . ((is_array( $data['pages'] ) AND count( $data['pages'] )) ? ("
			<pagination>
			".$this->__f__9fb17e045c11927f72bea708ed51d13d($forum_data,$announce_data,$topic_data,$other_data,$multi_mod_data,$sub_forum_data,$footer_filter,$active_user_data,$mod_data,$inforum,$tid,$data)."		</pagination>
		") : ("")) . "		
			</topic>
	
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- forumPasswordLogIn --*/
function forumPasswordLogIn($fid="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- likeSummary --*/
function likeSummary($data, $relId, $opts) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- likeSummaryContents --*/
function likeSummaryContents($data, $relId, $opts=array()) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- show_rules --*/
function show_rules($rules="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- topic --*/
function topic($data, $forum_data, $other_data, $inforum) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- topic_rating_image --*/
function topic_rating_image($rating_id=1) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- topicPrefixWrap --*/
function topicPrefixWrap($text) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>