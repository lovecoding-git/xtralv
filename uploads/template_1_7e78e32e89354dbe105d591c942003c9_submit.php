<?php
namespace IPS\Theme\Cache;
class class_forums_front_submit extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function createTopic( $form, $forum, $title ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $club = $forum->club() ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->clubs and \IPS\Settings::i()->clubs_header == 'full' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "clubs", "core" )->header( $club, $forum );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<div id='elClubContainer'>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( $title ) );
endif;
$return .= <<<CONTENT


{$form}


CONTENT;

if ( $club = $forum->club() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function createTopicForm( $forum, $hasModOptions, $topic, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $errorTabs=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$modOptions = array( 'topic_create_state', 'create_topic_locked', 'create_topic_pinned', 'create_topic_hidden', 'create_topic_featured', 'topic_open_time', 'topic_close_time');
$return .= <<<CONTENT


<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsForm data-ipsFormSubmit>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT

		<input type="hidden" name="MAX_FILE_SIZE" value="
CONTENT;
$return .= htmlspecialchars( $uploadField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<input type="hidden" name="plupload" value="
CONTENT;

$return .= htmlspecialchars( md5( mt_rand() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

if ( $form->error ):
$return .= <<<CONTENT

		<p class="ipsMessage ipsMessage_error">
CONTENT;
$return .= htmlspecialchars( $form->error, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsBox ipsResponsive_pull'>
		<h2 class='ipsType_sectionTitle ipsType_reset ipsHide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		
CONTENT;

if ( \count( $elements ) > 1 ):
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $errorTabs ) ):
$return .= <<<CONTENT

				<p class="ipsMessage ipsMessage_error ipsJS_show">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tab_error', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsTabs ipsClearfix ipsJS_show' id='tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<a href='#tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
				<ul role='tablist'>
					
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

						<li>
							<a href='#ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( \in_array( $name, $errorTabs ) ):
$return .= <<<CONTENT
ipsTabs_error
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $name == 'mainTab' ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
								
CONTENT;

if ( \in_array( $name, $errorTabs ) ):
$return .= <<<CONTENT
<i class="fa fa-exclamation-circle"></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</div>
			<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_panels'>
				
CONTENT;

foreach ( $elements as $name => $contents ):
$return .= <<<CONTENT

					<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel ipsPadding" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">

						
CONTENT;

if ( $hasModOptions && $name == 'topic_mainTab' ):
$return .= <<<CONTENT

							<div class='ipsColumns ipsColumns_collapsePhone'>
								<div class='ipsColumn ipsColumn_fluid'>
						
CONTENT;

endif;
$return .= <<<CONTENT

							<ul class='ipsForm ipsForm_vertical'>
								
CONTENT;

foreach ( $contents as $inputName => $input ):
$return .= <<<CONTENT

									
CONTENT;

if ( !\in_array( $inputName, $modOptions ) ):
$return .= <<<CONTENT

										{$input}
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						
CONTENT;

if ( $hasModOptions && $name == 'topic_mainTab' ):
$return .= <<<CONTENT

								</div>
								<div class='ipsColumn ipsColumn_wide'>
									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "submit", "forums" )->createTopicModOptions( $elements, $modOptions );
$return .= <<<CONTENT

								</div>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>		
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsPadding'>
				
CONTENT;

if ( $hasModOptions ):
$return .= <<<CONTENT

					<div class='ipsColumns ipsColumns_collapsePhone'>
						<div class='ipsColumn ipsColumn_fluid'>
				
CONTENT;

endif;
$return .= <<<CONTENT

					<ul class='ipsForm ipsForm_vertical'>
						
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $collection as $inputName => $input ):
$return .= <<<CONTENT

								
CONTENT;

if ( !\in_array( $inputName, $modOptions ) ):
$return .= <<<CONTENT

									{$input}
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				
CONTENT;

if ( $hasModOptions ):
$return .= <<<CONTENT

						</div>
						<div class='ipsColumn ipsColumn_wide'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "submit", "forums" )->createTopicModOptions( $elements, $modOptions );
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<div class='ipsAreaBackground_reset ipsPadding ipsType_center ipsBorder_top ipsRadius:bl ipsRadius:br'>
			
CONTENT;

if ( $topic ):
$return .= <<<CONTENT

			<button type='submit' class='ipsButton ipsButton_large ipsButton_primary' tabindex="1" accesskey="s" role="button">
CONTENT;

if ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_question_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_topic_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
			
CONTENT;

else:
$return .= <<<CONTENT

			<button type='submit' class='ipsButton ipsButton_large ipsButton_primary' tabindex="1" accesskey="s" role="button">
CONTENT;

if ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>	
</form>
CONTENT;

		return $return;
}

	function createTopicModOptions( $elements, $modOptions ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox ipsBox--child'>
	<h3 class='ipsType_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moderator_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<ul class='ipsPadding ipsForm ipsForm_vertical'>
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $inputName => $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( \in_array( $inputName, $modOptions ) ):
$return .= <<<CONTENT

					
CONTENT;

if ( $inputName == 'topic_open_time' or $inputName == 'topic_close_time' ):
$return .= <<<CONTENT

						<li class='ipsFieldRow ipsClearfix'>
							<label class="ipsFieldRow_label" for="elInput_
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							<ul class='ipsFieldRow_content ipsList_reset cCreateTopic_date'>
								<li>
									<i class='fa fa-calendar'></i>
									<input type="date" name="
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id="elInput_
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsField_short" data-control="date" placeholder='
CONTENT;

$return .= htmlspecialchars( str_replace( array( 'YYYY', 'MM', 'DD' ), array( \IPS\Member::loggedIn()->language()->addToStack('_date_format_yyyy'), \IPS\Member::loggedIn()->language()->addToStack('_date_format_mm'), \IPS\Member::loggedIn()->language()->addToStack('_date_format_dd') ), str_replace( 'Y', 'YY', \IPS\Member::loggedIn()->language()->preferredDateFormat() ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value="
CONTENT;

if ( $input->value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value->format('Y-m-d'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-preferredFormat="
CONTENT;

if ( $input->value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value->localeDate(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
								</li>
								<li>
									<i class='fa fa-clock-o'></i>
									<input name="
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_time" type="time" size="12" class="ipsField_short" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( '_time_format_hhmm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" step="60" min="00:00" value="
CONTENT;

if ( $input->value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value->format('H:i'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
								</li>
							</ul>
						</li>
					
CONTENT;

else:
$return .= <<<CONTENT

						{$input}
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}}