<?php

/**
 *
 * Classifieds 1.2.1
 *
 * @author		$Author: Andrew Millne $
 * @copyright   2011 Andrew Millne. All Rights Reserved.
 * @license		http://dev.millne.com/license.html
 * @package		Classifieds
 * @link		http://dev.millne.com
 *
 */

if (!defined('IN_IPB')) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit();
}

class public_classifieds_questions_questions extends ipsCommand {

    public function doExecute(ipsRegistry $registry) {

        // Check not a guest
        if (!$this->memberData['member_id']) {
            $this->registry->output->showError($this->lang->words['cfds_not_logged_in'], '10CFDM5001');
        }

        // Load Languages
        $this->lang->loadLanguageFile(array('public_post'), 'forums');

        // Load library

        $this->categories = $this->registry->classifieds->helper('categories');
        $this->items = $this->registry->classifieds->helper('items');
        $this->questions = $this->registry->classifieds->helper('questions');

        $this->post_key = (isset($this->request['post_key']) and $this->request['post_key'] != "") ? $this->request['post_key'] : md5(microtime());


        // Add Navigation
		$this->registry->output->addNavigation( $this->settings['classifieds_public_name'], 'app=classifieds', 'classifieds', 'index' );
		
        // Which section are we looking for?
        switch (ipsRegistry::$request['do']) {
            case 'ask':
                $this->questionForm();
                break;

            case 'answer':
                $this->answerForm();
                break;

            case 'doask':
                $this->questionSave();
                break;

            case 'doanswer':
                $this->answerSave();
                break;

            case 'delete':
                $this->deleteForm();
                break;

            case 'dodelete':
                $this->delete();
                break;

            default:
                $this->questionForm();
                break;
        }

        if ($this->registry->output->getTitle() == "") {
            $this->registry->output->setTitle($this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name']);
        }

        $this->registry->output->addToDocumentHead('raw', "<link rel='stylesheet' type='text/css' title='Main' media='screen' href='public/style_css/master_css/classifieds_styles.css' />");
        $this->registry->output->addContent($this->output);
        $this->registry->output->addContent( base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpyaWdodDtmb250LXNpemU6MC45ZW07JyBjbGFzcz0naXBzUGFkIGNsZWFyJz5Qb3dlcmVkIGJ5IDxhIGhyZWY9J2h0dHA6Ly9kZXYubWlsbG5lLmNvbS9saW5rL2NsYXNzaWZpZWRzLyc+Q2xhc3NpZmllZHM8L2E+PC9kaXY+"));
        $this->registry->output->sendOutput();

    }

    function questionForm() {

        $item_id = $this->request['item_id'] ? intval($this->request['item_id']) : 0;
        $item = $this->items->getItemById($item_id);

        // Check item doesn't belong to user
        if ($this->memberData['member_id'] == $item['member_id']) {
            $this->registry->output->showError($this->lang->words['cfds_cant_ask_yourself'], '10CFDM5002');
        }

        // Is item active?
        if ($item['active'] == 0) {
            $this->registry->output->showError($this->lang->words['cfds_no_longer_available'], '10CFDM5003', null, null, 404 );
        }
        
        /* Show description in editor, get editor */
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$_editor = new $classToLoad();
		
		$_editor->setAllowBbcode( true );
		$_editor->setAllowSmilies( true );
		$_editor->setAllowHtml( false );
		
		/* Set content in editor */
		$editor = $_editor->show( 'question', array());

        // Set title
        $this->registry->output->setTitle($this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . $this->lang->words['cfds_asking_question']);

        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->question_form($item, $editor, $this->post_key);
    }

    function questionSave() {

        $item_id = $this->request['item_id'] ? intval($this->request['item_id']) : 0;
        $item = $this->items->getItemById($item_id);

        // Check item doesn't belong to user
        if ($this->memberData['member_id'] == $item['member_id']) {
        	$this->registry->output->showError($this->lang->words['cfds_cant_ask_yourself'], '10CFDM5004');
        }

        // Is item active?
        if ($item['active'] == 0) {
            $this->registry->output->showError($this->lang->words['cfds_no_longer_available'], '10CFDM5005');
        }

        $question = trim(IPSText::stripslashes($_POST['question']));

        // Check question length
        if (IPSText::mbstrlen($question) > ($this->settings['max_post_length'] * 1024)) {
            $this->registry->output->showError($this->lang->words['cfds_question_too_long'], '10CFDM5006');
        }

        if ((IPSText::mbstrlen($question) < 1) or (!$question)) {
            $this->registry->output->showError($this->lang->words['cfds_no_question'], '10CFDM5007');
        }
        
        $classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$editor = new $classToLoad();
		
		$editor->setAllowBbcode( true );
		$editor->setAllowSmilies( true );
		$editor->setAllowHtml( false );
		
		$editor_content = $editor->process( $question );

        // Process editor
        IPSText::getTextClass('bbcode')->parse_html = 0;
        IPSText::getTextClass('bbcode')->parse_smilies = 1;
        IPSText::getTextClass('bbcode')->parse_bbcode = 1;
        IPSText::getTextClass('bbcode')->parsing_section = 'classifieds_question';

       // $editor_content = IPSText::getTextClass('editor')->processRawPost('question');
        $question = IPSText::getTextClass('bbcode')->preDbParse($editor_content);

        $current_time = IPSTime::getTimestamp();

        // Check not a double post

        $this->DB->buildAndFetch(array('select' => '*', 'from' => 'classifieds_questions',
                'where' => 'post_key = "' . $this->post_key . '"', ));

        if ($this->DB->getTotalRows() != 0) {
            $this->registry->output->showError("Double post error", '10CFDM5008');
        }

       // print_r($question);
       // die();
        
        $db_arr = array('asker_id' => $this->memberData['member_id'],
                'item_id' => $item['item_id'],
                'question' => $question,
                'date_asked' => $current_time,
                'post_key' => $this->post_key,
        );

        $this->DB->insert('classifieds_questions', $db_arr);


        //-----------------------------------------
        // Send notification...
        //-----------------------------------------

        $_url	= $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item['item_id'], 'public', $item['seo_title'], 'view_item' );

        $member = IPSMember::load( $item['member_id'], '', 'id' );

        IPSText::getTextClass('email')->getTemplate( 'cfds_noti_new_question', $member['language'] );

        IPSText::getTextClass('email')->buildMessage( array(
                'NAME'  		=> $member['members_display_name'],
                'MEMBER'	=> $this->memberData['members_display_name'],
                'TITLE' 		=> $item['name'],
                'URL'		=> $_url,
                )
        );


        $classToLoad		= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
        $notifyLibrary		= new $classToLoad( $this->registry );

        $this->lang->words['cfds_noti_sub_new_question']	= sprintf(
                $this->lang->words['cfds_noti_sub_new_question'],
                $this->memberData['members_display_name'],
                $_url,
                $item['name']
        );

        $notifyLibrary->setMember( intval($item['member_id']) );
        $notifyLibrary->setFrom( intval($this->memberData['member_id']) );
        $notifyLibrary->setNotificationKey( 'new_cfds_own_item_question' );
        $notifyLibrary->setNotificationUrl( $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item['item_id'], 'publicNoSession', $item['seo_title'] , 'view_item' ) );
        $notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
        $notifyLibrary->setNotificationTitle( $this->lang->words['cfds_noti_sub_new_question'] );

        try {
            $notifyLibrary->sendNotification();
        }
        catch( Exception $e ) {

        }




        // Do the output stuff
        $this->registry->output->redirectScreen($this->lang->words['cfds_question_asked'],
                $this->settings['base_url'] .
                "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item['item_id'] . "#questions");
    }

    function answerForm() {

        // Retrieve Question
        $question_id = $this->request['question_id'] ? intval($this->request['question_id']) : 0;
        $question = $this->questions->getQuestionById($question_id);

        // Retrieve Item
        $item = $this->items->getItemById($question['item_id']);

        // Check item belongs to user
        if ($this->memberData['member_id'] != $item['member_id']) {
            $this->registry->output->showError($this->lang->words['cfds_no_permission'], '10CFDM5009');
        }

        // Is item active?
        if ($item['active'] == 0) {
            $this->registry->output->showError($this->lang->words['cfds_no_longer_available'], '10CFDM5010');
        }

        /* Show description in editor, get editor */
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$_editor = new $classToLoad();
		
		$_editor->setAllowBbcode( true );
		$_editor->setAllowSmilies( true );
		$_editor->setAllowHtml( false );
		
		/* Set content in editor */
		$editor = $_editor->show( 'answer', array());


        // Set title
        $this->registry->output->setTitle($this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . $this->lang->words['cfds_answering_question']);


        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->answer_form($item, $question, $editor, $this->post_key);

    }

    function answerSave() {

        // Retrieve Question
        $question_id = $this->request['question_id'] ? intval($this->request['question_id']) : 0;
        $question = $this->questions->getQuestionById($question_id);

        // Retrieve Item
        $item = $this->items->getItemById($question['item_id']);

        // Check item belongs to user
        if ($this->memberData['member_id'] != $item['member_id']) {
            $this->registry->output->showError($this->lang->words['cfds_no_permission'], '10CFDM5011');
        }

        // Is item active?
        if ($item['active'] == 0) {
            $this->registry->output->showError($this->lang->words['cfds_no_longer_available'], '10CFDM5012');
        }

        $answer = trim(IPSText::stripslashes($_POST['answer']));

        // Check answer length
        if (IPSText::mbstrlen($answer) > ($this->settings['max_post_length'] * 1024)) {
            $this->registry->output->showError($this->lang->words['cfds_answer_too_long'], '10CFDM5013');
        }

        if ((IPSText::mbstrlen($answer) < 1) or (!$answer)) {
            $this->registry->output->showError($this->lang->words['cfds_no_answer'], '10CFDM5014');
        }

        $classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$editor = new $classToLoad();
		
		$editor->setAllowBbcode( true );
		$editor->setAllowSmilies( true );
		$editor->setAllowHtml( false );
		
		$editor_content = $editor->process( $answer );
        
        // Process editor
        IPSText::getTextClass('bbcode')->parse_html = 0;
        IPSText::getTextClass('bbcode')->parse_smilies = 1;
        IPSText::getTextClass('bbcode')->parse_bbcode = 1;
        IPSText::getTextClass('bbcode')->parsing_section = 'classifieds_answer';

        $answer = IPSText::getTextClass('bbcode')->preDbParse($editor_content);

        // Set public?
        $public_answer = $this->request['public_answer'] ? intval($this->request['public_answer']) : 0;

        $current_time = time();

        // Check not a double post

        $this->DB->buildAndFetch(array('select' => '*', 'from' => 'classifieds_questions',
                'where' => 'post_key = "' . $this->post_key . '"', ));

        if ($this->DB->getTotalRows() != 0) {
            $this->registry->output->showError("Double post error", '10CFDM5015');
        }

        $db_arr = array(

                'answer' => $answer,
                'date_answered' => $current_time,
                'is_public' => $public_answer,
                'post_key' => $this->post_key,
        );

        $this->DB->update('classifieds_questions', $db_arr, 'question_id = ' . intval($question_id));





        // Send notifications
        $this->sendNotifications($question_id);

        // Do the output stuff
        $this->registry->output->redirectScreen($this->lang->words['cfds_question_answered'],
                $this->settings['base_url'] .
                "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item['item_id'] . "#questions");

    }

    public function sendNotifications($question_id) {

        $classToLoad		= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
        $notifyLibrary		= new $classToLoad( $this->registry );

        // Load question
        $question = $this->questions->getQuestionById($question_id);

        // Load item
        $item = $this->items->getItemById($question['item_id']);

        $_url = $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item['item_id'], 'public', $item['seo_title'], 'view_item' );

        // Find members watching this item
        $notify_member = array();
        if ($question['is_public']) {

            $check = $this->DB->build( array( 'select' => 'sub_mid', 'from' => 'classifieds_subscriptions', 'where' => "sub_type='item' AND sub_toid = " . $item['item_id'] ) );

            $this->DB->execute();

            // Loop through subscribed members and send notifications

            while( $member = $this->DB->fetch() ) {
                if($member['sub_mid'] != $item['member_id'] && $member['sub_mid'] != $question['asker_id']) {
                    $notify_member[] = $member['sub_mid'];
                }
            }
        }


        if(!empty($notify_member)) {

            foreach($notify_member as $r) {

                $member = IPSMember::load( $r, '', 'id' );

                IPSText::getTextClass('email')->getTemplate( 'cfds_noti_watched_new_answer', $member['language'] );

                IPSText::getTextClass('email')->buildMessage( array(
                        'NAME'  		=> $member['members_display_name'],
                        'ADVERTISER'	=> $this->memberData['members_display_name'],
                        'TITLE' 		=> $item['name'],
                        'URL'		=> $_url,
                        )
                );

                //-----------------------------------------
                // Send notification...
                //-----------------------------------------

                $this->lang->words['cfds_noti_sub_watched_new_answer']	= sprintf(
                        $this->lang->words['cfds_noti_sub_watched_new_answer'],
                        $_url,
                        $item['name']
                );

                $notifyLibrary->setMember( intval($r) );
                $notifyLibrary->setFrom( intval($item['member_id']) );
                $notifyLibrary->setNotificationKey( 'new_cfds_question' );
                $notifyLibrary->setNotificationUrl( $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item['item_id'], 'publicNoSession', $item['seo_title'] , 'view_item' ) );
                $notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
                $notifyLibrary->setNotificationTitle( $this->lang->words['cfds_noti_sub_watched_new_answer'] );

                try {
                    $notifyLibrary->sendNotification();
                }
                catch( Exception $e ) {

                }
            }
        }

        // Also send to question asker

        //-----------------------------------------
        // Send notification...
        //-----------------------------------------

        $member = IPSMember::load( $question['asker_id'], '', 'id' );

        IPSText::getTextClass('email')->getTemplate( 'cfds_noti_new_answer', $member['language'] );

        IPSText::getTextClass('email')->buildMessage( array(
                'NAME'  		=> $member['members_display_name'],
                'ADVERTISER'	=> $this->memberData['members_display_name'],
                'TITLE' 		=> $item['name'],
                'URL'		=> $_url,
                )
        );

        $this->lang->words['cfds_noti_sub_new_answer']	= sprintf(
                $this->lang->words['cfds_noti_sub_new_answer'],
                $this->memberData['members_display_name'],
                $_url,
                $item['name']
        );


        $notifyLibrary->setMember( intval($question['asker_id']) );
        $notifyLibrary->setFrom( intval($item['member_id']) );
        $notifyLibrary->setNotificationKey( 'new_cfds_answer' );
        $notifyLibrary->setNotificationUrl( $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item['item_id'], 'publicNoSession', $item['seo_title'] , 'view_item' ) );
        $notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
        $notifyLibrary->setNotificationTitle( $this->lang->words['cfds_noti_sub_new_answer'] );

        try {
            $notifyLibrary->sendNotification();
        }
        catch( Exception $e ) {

        }




    }


    /**
     * Delete Question Form
     */
    function deleteForm() {

        $form = array();

        //-----------------------------------------
        // Grab question
        //-----------------------------------------

        $question = $this->questions->getQuestionById(intval($this->request['question_id']));

        //-----------------------------------------
        // Check it's OK to delete
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate'] && $this->memberData['member_id'] != $question['advertiser']) {
            $this->registry->output->showError( $this->lang->words['cfds_cant_delete_question'], '10CFDM5016' );
        }

        $form['formcode']   =  'dodelete';
        $form['button']     = "Delete Question";

        //-----------------------------------------
        // Do the output stuff
        //-----------------------------------------

        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->delete_question_form($question, $form);

    }

    /**
     * Delete Question
     */
    function delete() {

        //-----------------------------------------
        // Grab question
        //-----------------------------------------

        $question = $this->questions->getQuestionById(intval($this->request['question_id']));

        //-----------------------------------------
        // Check it's OK to delete
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate'] && $this->memberData['member_id'] != $question['advertiser']) {
            $this->registry->output->showError( $this->lang->words['cfds_cant_delete_question'], '10CFDM5017' );
        }

        //-----------------------------------------
        // Delete it
        //-----------------------------------------

        $this->DB->delete( 'classifieds_questions', 'question_id = ' . $question['question_id'] );


        $this->registry->output->redirectScreen($this->lang->words['cfds_question_deleted'], $this->settings['base_url'] . "app=classifieds&amp;do=view_item&amp;item_id={$question['item_id']}" );


    }

} // end class

?>