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

if( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit;
}

class classifieds_questions {
    public function __construct( $registry ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
        $this->settings   = $this->registry->settings();
        $this->request    = $this->registry->request();
        $this->lang       = $this->registry->getClass('class_localization');
    }

    /**
     * Retrieve question based on its ID
     *
     * @access	public
     * @param   int     Question ID
     * @return	array
     */
    public function getQuestionById($question_id) {

        $question = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => array('classifieds_questions' => 'q'),
            'add_join' => array(
                            0 => array( 'select' => 'i.member_id as advertiser',
                                    'from'   => array( 'classifieds_items' => 'i' ),
                                    'where'  => 'i.item_id = q.item_id',
                                    'type'   => 'left' ),
                    ),
                'where' => 'question_id = ' . intval($question_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_question_noid'], '10CFDL6001', false );
        }

        IPSText::getTextClass('bbcode')->parse_html 		= 0;
        IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
        IPSText::getTextClass('bbcode')->parse_smilies		= 1;
        IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_questions';

            $question['question'] = IPSText::getTextClass('bbcode')->preDisplayParse( $question['question'] );

            $question['answer'] = IPSText::getTextClass('bbcode')->preDisplayParse( $question['answer'] );
            

        return $question;
    }

    /**
     * Retrieve questions based on item ID
     *
     * @access	public
     * @param   int     Question ID
     * @return	array
     */
    public function getQuestionsByItemID($item_id) {

        $where = "item_id = " . intval($item_id);

        $questions = $this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_questions' => 'q' ),
                'where' => $where,
                'order' => 'date_asked ASC',
                )		);

        $this->DB->execute();

        IPSText::getTextClass('bbcode')->parse_html 		= 0;
        IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
        IPSText::getTextClass('bbcode')->parse_smilies		= 1;
        IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_questions';

        while( $row = $this->DB->fetch() ) {

            $questions[] = $row;

        }
        if($questions) {
            foreach ($questions as $question) {

                $question['askerdata'] = IPSMember::load( $question['asker_id'], 'all', 'id' );

                //-----------------------------------------
                // Format question for output
                //-----------------------------------------

                IPSText::getTextClass('bbcode')->parse_html 		= 0;
                IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
                IPSText::getTextClass('bbcode')->parse_smilies		= 1;
                IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_question';

                $question['question'] = IPSText::getTextClass('bbcode')->preDisplayParse( $question['question'] );
                

                if ($question['answer']) {
                    //-----------------------------------------
                    // Format answer for output
                    //-----------------------------------------

                    IPSText::getTextClass('bbcode')->parse_html 		= 0;
                    IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
                    IPSText::getTextClass('bbcode')->parse_smilies		= 1;
                    IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_answer';

                    $question['answer'] = IPSText::getTextClass('bbcode')->preDisplayParse( $question['answer'] );
                    
                }
                $question_out[] = $question;
            }
        }

        return $question_out;
    }

}
?>