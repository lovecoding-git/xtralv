<?php
namespace IPS\Theme\Cache;
class class_core_front_streams extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function extraItem( $time, $image, $html, $view = 'expanded' ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsStreamItem ipsStreamItem_
CONTENT;
$return .= htmlspecialchars( $view, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsStreamItem_actionBlock' data-role="activityItem" data-timestamp='
CONTENT;
$return .= htmlspecialchars( $time->getTimestamp(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsStreamItem_container'>
		<div class='ipsStreamItem_action ipsType_blendLinks ipsType_light ipsType_break ipsFlex ipsFlex-ai:center'>
			
CONTENT;

if ( isset( $image ) ):
$return .= <<<CONTENT

				<div class='ipsFlex-flex:00 ipsMargin_right:half'>
					{$image}
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsFlex-flex:11'>
				<span class='ipsMargin_right'>{$html}</span> <span class='ipsType_light'>
CONTENT;

$val = ( $time instanceof \IPS\DateTime ) ? $time : \IPS\DateTime::ts( $time );$return .= $val->html();
$return .= <<<CONTENT
</span>
			</div>
		</div>
	</div>
</li>

CONTENT;

		return $return;
}

	function filterCreateForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.front.streams.form' data-formType='createStream'>
	<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
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

		<div class='ipsBox ipsResponsive_pull ipsSpacer_bottom' id='elStreamFilterForm'>
			<div class='ipsPadding'>
				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'create_new_stream', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<ul class='ipsList_inline ipsPos_right ipsResponsive_noFloat'>
					<li>
						<a href='#elStreamSortEdit_menu' class='ipsButton ipsButton_light ipsButton_verySmall' id='elStreamSortEdit' data-ipsMenu data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm' data-ipsMenu-closeOnClick='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_sorting', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
					</li>
				</ul>

				<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' id='elStreamSortEdit_menu'>
					<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_sort']->value == 'newest' ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<a href='#'>
							<input type="radio" name="stream_sort" value="newest" 
CONTENT;

if ( (string) $elements['']['stream_sort']->value == 'newest' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_stream_sort_newest">
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_sort_newest', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
					<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_sort']->value == 'oldest' ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<a href='#'>
							<input type="radio" name="stream_sort" value="oldest" 
CONTENT;

if ( (string) $elements['']['stream_sort']->value == 'oldest' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_stream_sort_oldest">
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_sort_oldest', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				</ul>
				<hr class='ipsHr'>
				
CONTENT;

if ( isset( $elements['']['stream_title'] ) ):
$return .= <<<CONTENT

					<div class="ipsSpacer_bottom ipsAreaBackground_light ipsPad">
						<input type='text' name='stream_title' value='
CONTENT;
$return .= htmlspecialchars( $elements['']['stream_title']->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_primary ipsField_fullWidth' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' autofocus>
						
CONTENT;

if ( $elements['']['stream_title']->error ):
$return .= <<<CONTENT

							<br>
							<span class="ipsType_warning">
CONTENT;

$val = "{$elements['']['stream_title']->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form );
$return .= <<<CONTENT

			</div>
			<div class='ipsPadding ipsBorder_top'>
				<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsMargin:none">
					<li class='ipsToolList_primaryAction ipsPos_right'><button type='submit' class='ipsButton ipsButton_primary ipsButton_medium ipsButton_fullWidth' data-action='createStream'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_button_save', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button></li>
				</ul>
			</div>
		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function filterForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsGrid ipsGrid_collapsePhone'>
	<div class='ipsGrid_span4'>
		<h3 class='ipsType_reset ipsType_large cStreamForm_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_include_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<ul class='ipsSideMenu_list ipsSideMenu_withRadios cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' data-ipsSideMenu data-ipsSideMenu-type='radio' data-ipsSideMenu-responsive='false'>
			
CONTENT;

foreach ( $elements['']['stream_include_comments']->options['options'] as $k => $v ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormRadio( $k, $v, 'stream_include_comments', $elements['']['stream_include_comments']->value, $elements['']['stream_include_comments']->required, $elements['']['stream_include_comments']->options['options'], $elements['']['stream_include_comments']->options['disabled'] );
$return .= <<<CONTENT

				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
		<hr class='ipsHr ipsSpacer_both ipsSpacer_double ipsResponsive_hidePhone'>
		<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormShowMe( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form );
$return .= <<<CONTENT

	</div>
	<div class='ipsGrid_span8'>
		
CONTENT;

if ( isset( $elements['']['stream_tags'] ) ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormTags( $elements['']['stream_tags'] );
$return .= <<<CONTENT

			<hr class='ipsHr ipsSpacer_bottom ipsSpacer_double ipsResponsive_hidePhone'>
			<hr class='ipsHr ipsSpacer_bottom ipsResponsive_showPhone ipsResponsive_block'>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone'>
			<div class='ipsGrid_span6'>
				<h3 class='ipsType_reset ipsType_large cStreamForm_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<ul class='ipsSideMenu_list ipsSideMenu_withRadios cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' data-ipsSideMenu data-ipsSideMenu-type='radio' data-ipsSideMenu-responsive='false' data-filterType='read'>
					
CONTENT;

foreach ( $elements['']['stream_read']->options['options'] as $k => $v ):
$return .= <<<CONTENT

						<li>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormRadio( $k, $v, 'stream_read', $elements['']['stream_read']->value, $elements['']['stream_read']->required, $elements['']['stream_read']->options['options'], $elements['']['stream_read']->options['disabled'] );
$return .= <<<CONTENT

						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
				<hr class='ipsHr ipsSpacer_both ipsSpacer_double ipsResponsive_hidePhone'>
				<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
				<h3 class='ipsType_reset ipsType_large cStreamForm_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_ownership', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				
CONTENT;

if ( isset( $elements['']['stream_ownership'] ) ):
$return .= <<<CONTENT

				<ul class='ipsSideMenu_list ipsSideMenu_withRadios cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type='radio' data-ipsSideMenu-responsive='false' data-filterType='ownership'>
					
CONTENT;

foreach ( $elements['']['stream_ownership']->options['options'] as $k => $v ):
$return .= <<<CONTENT

					<li>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormRadio( $k, $v, 'stream_ownership', $elements['']['stream_ownership']->value, $elements['']['stream_ownership']->required, $elements['']['stream_ownership']->options['options'], $elements['']['stream_ownership']->options['disabled'] );
$return .= <<<CONTENT

					</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormOwnership( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form );
$return .= <<<CONTENT

				</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<hr class='ipsHr ipsSpacer_both ipsSpacer_double ipsResponsive_hidePhone'>
				<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
				<h3 class='ipsType_reset ipsType_large cStreamForm_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_default_view', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				
CONTENT;

if ( isset( $elements['']['stream_default_view'] ) ):
$return .= <<<CONTENT

				<ul class='ipsSideMenu_list ipsSideMenu_withRadios cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type='radio' data-ipsSideMenu-responsive='false' data-filterType='defaultview'>
					
CONTENT;

foreach ( $elements['']['stream_default_view']->options['options'] as $k => $v ):
$return .= <<<CONTENT

					<li>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormRadio( $k, $v, 'stream_default_view', $elements['']['stream_default_view']->value, $elements['']['stream_default_view']->required, $elements['']['stream_default_view']->options['options'], $elements['']['stream_default_view']->options['disabled'] );
$return .= <<<CONTENT

					</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
			</div>
			<div class='ipsGrid_span6'>
				
CONTENT;

if ( isset( $elements['']['stream_follow'] ) ):
$return .= <<<CONTENT

					<h3 class='ipsType_reset ipsType_large cStreamForm_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
					<ul class='ipsSideMenu_list ipsSideMenu_withRadios cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' data-ipsSideMenu data-ipsSideMenu-type='radio' data-ipsSideMenu-responsive='false' data-filterType='follow'>
						
CONTENT;

foreach ( $elements['']['stream_follow']->options['options'] as $k => $v ):
$return .= <<<CONTENT

							<li>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormRadio( $k, $v, 'stream_follow', $elements['']['stream_follow']->value, $elements['']['stream_follow']->required, $elements['']['stream_follow']->options['options'], $elements['']['stream_follow']->options['disabled'], ( $k == 'followed' ) );
$return .= <<<CONTENT

								
CONTENT;

if ( $k == 'followed' ):
$return .= <<<CONTENT

									<a class='ipsType_noUnderline cStreamForm_menu' data-ipsTooltip title='' id='elMenu_followOptions' data-ipsMenu data-ipsMenu-activeClass='cStreamForm_menuActive' data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elStreamFilterForm'>
										<i class='fa fa-cog ipsType_large'></i>
										<i class='fa fa-caret-down'></i>
									</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormFollowStatus( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				<hr class='ipsHr ipsSpacer_both ipsSpacer_double ipsResponsive_hidePhone'>
				<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
				<h3 class='ipsType_reset ipsType_large cStreamForm_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_date_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				
CONTENT;

if ( isset( $elements['']['stream_date_type'] ) ):
$return .= <<<CONTENT

					<ul class='ipsSideMenu_list ipsSideMenu_withRadios cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' data-ipsSideMenu data-ipsSideMenu-type='radio' data-ipsSideMenu-responsive='false' data-filterType='date'>
						
CONTENT;

foreach ( $elements['']['stream_date_type']->options['options'] as $k => $v ):
$return .= <<<CONTENT

							<li>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormRadio( $k, $v, 'stream_date_type', $elements['']['stream_date_type']->value, $elements['']['stream_date_type']->required, $elements['']['stream_date_type']->options['options'], $elements['']['stream_date_type']->options['disabled'] );
$return .= <<<CONTENT

							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormTimePeriod( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form );
$return .= <<<CONTENT

					</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function filterFormClubs( $field ) {
		$return = '';
		$return .= <<<CONTENT

<div>
	
CONTENT;

if ( $field ):
$return .= <<<CONTENT

		<div class='ipsFieldRow ipsFieldRow_fullWidth'>
			<div class='ipsFieldRow_content'>
				<ul class='ipsList_inline'>{$field}</ul>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function filterFormContentType( $elements, $key, $type, $checked=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \in_array( $type, array_keys( $elements['']['stream_classes']->options['toggles'] ) ) ):
$return .= <<<CONTENT

	<div class='ipsMenu ipsMenu_wide ipsPad ipsHide' data-role="streamContainer" data-contentKey="
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-className="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elMenu_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function filterFormContentTypeContent( $field, $type, $key ) {
		$return = '';
		$return .= <<<CONTENT

<div data-contentType='
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $field ):
$return .= <<<CONTENT

		<div class='ipsFieldRow ipsFieldRow_fullWidth'>
			<div class='ipsFieldRow_content'>
				<ul class='ipsList_inline'>{$field}</ul>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function filterFormFollowStatus( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $showTitle=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $elements['']['stream_follow'] ) ):
$return .= <<<CONTENT

	<div id='elMenu_followOptions_menu' class='ipsMenu ipsMenu_wide ipsPad ipsHide'>
		<ul class='ipsSideMenu_list ipsSideMenu_withChecks cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' data-ipsSideMenu data-ipsSideMenu-type='check' data-ipsSideMenu-responsive='false' data-filterType='followed'>
		
CONTENT;

foreach ( $elements['']['stream_followed_types']->options['options'] as $type => $lang ):
$return .= <<<CONTENT

			<li>
				<a href='#' class='ipsSideMenu_item 
CONTENT;

if ( $elements['']['stream_followed_types']->value !== 0 && \in_array( $type, $elements['']['stream_followed_types']->value ) !== FALSE ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					<input type='checkbox' name='stream_followed_types[
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]' value='1' 
CONTENT;

if ( $elements['']['stream_followed_types']->value !== 0 && \in_array( $type, $elements['']['stream_followed_types']->value ) !== FALSE ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> 
					
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

		return $return;
}

	function filterFormOwnership( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $showTitle=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $elements['']['stream_ownership'] ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $elements['']['stream_custom_members'] ) ):
$return .= <<<CONTENT

		<li class='ipsPad ipsSpacer_top ipsSpacer_half cStreamForm_authors 
CONTENT;

if ( $elements['']['stream_ownership']->value !== 'custom' ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="ownershipMemberForm">
			<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_custom_members', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
			{$elements['']['stream_custom_members']->html()}
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

		return $return;
}

	function filterFormRadio( $k, $v, $name, $value, $required, $options, $disabled=FALSE, $hasOptions=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<a href='#' class='ipsSideMenu_item 
CONTENT;

if ( $hasOptions ):
$return .= <<<CONTENT
cStream_withOptions
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( (string) $value == (string) $k or ( isset( $userSuppliedInput ) and !\in_array( $value, array_keys( $options ) ) and $k == $userSuppliedInput ) ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $value == (string) $k or ( isset( $userSuppliedInput ) and !\in_array( $value, array_keys( $options ) ) and $k == $userSuppliedInput ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled === TRUE or ( \is_array( $disabled ) and \in_array( $k, $disabled ) ) ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<label for='elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
CONTENT;

$val = "{$v}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
</a>
CONTENT;

		return $return;
}

	function filterFormShowMe( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $showTitle=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


<h3 class='ipsType_reset ipsType_large cStreamForm_title ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_classes_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<ul class='ipsSideMenu_list ipsSideMenu_withChecks cStreamForm_list ipsType_normal ipsSpacer_top ipsSpacer_half' data-ipsSideMenu data-ipsSideMenu-type='check' data-ipsSideMenu-responsive='false' data-filterType='type'>
	<li>
		<a href='#' class='ipsSideMenu_item 
CONTENT;

if ( $elements['']['stream_classes_type']->value == 0 ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='__all'>
			<input type="hidden" name="stream_classes[__EMPTY]" value="__EMPTY">
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_all_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</a>
		
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'clubs' ) ) and isset( $elements['']['stream_club_select'] ) ):
$return .= <<<CONTENT
			
			<a href='#' class='ipsType_noUnderline cStreamForm_menu' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_filter_clubs', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='streamClubs'>
				<i class='fa fa-cog ipsType_large'></i>
				<i class='fa fa-caret-down'></i>
			</a>
			<div class='cStreamForm_nodes ipsHide' id="elStreamClubs">
				<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			<input type="hidden" name="stream_club_select" value="
CONTENT;
$return .= htmlspecialchars( $elements['']['stream_club_select']->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<input type="hidden" name="stream_club_filter" value="
CONTENT;

if ( \is_array( $elements['']['stream_club_filter']->value ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode(',',$elements['']['stream_club_filter']->value), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $elements['']['stream_club_filter']->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
		
CONTENT;

endif;
$return .= <<<CONTENT

		<input type='radio' class='ipsHide' name='stream_classes_type' value='0' 
CONTENT;

if ( $elements['']['stream_classes_type']->value == 0 ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
		<input type='radio' class='ipsHide' name='stream_classes_type' value='1' 
CONTENT;

if ( $elements['']['stream_classes_type']->value == 1 ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
	</li>
	
CONTENT;

if ( isset( $elements['']['stream_classes'] ) ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $elements['']['stream_classes']->options['options'] as $type => $lang ):
$return .= <<<CONTENT

			<li>
				<a class='ipsSideMenu_item 
CONTENT;

if ( isset( $elements['']['stream_containers_' . str_replace('_pl', '', $lang ) ] ) || isset( $elements['']['stream_classes_' . str_replace('_pl', '', $lang ) ] ) ):
$return .= <<<CONTENT
cStream_withOptions
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $elements['']['stream_classes_type']->value !== 0 && \in_array( $type, $elements['']['stream_classes']->value ) !== FALSE ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' data-class='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;

$return .= htmlspecialchars( str_replace( '_pl', '', $lang ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					<input type='checkbox' name='stream_classes[
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]' value='1' 
CONTENT;

if ( $elements['']['stream_classes_type']->value !== 0 && \in_array( $type, $elements['']['stream_classes']->value ) !== FALSE ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> 
					<span class='ipsSideMenu_noCheck'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</a>
				
CONTENT;

if ( \in_array( $type, array_keys( $elements['']['stream_classes']->options['toggles'] ) ) ):
$return .= <<<CONTENT

					<a href='#' class='ipsType_noUnderline cStreamForm_menu' data-ipsTooltip title='
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $lang )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_filter_options', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' data-role='streamContainer' data-class='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-contentKey='
CONTENT;

$return .= htmlspecialchars( str_replace( '_pl', '', $lang ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						<i class='fa fa-cog ipsType_large'></i>
						<i class='fa fa-caret-down'></i>
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='cStreamForm_nodes ipsHide'>
					<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( ! isset( \IPS\Request::i()->do ) or \IPS\Request::i()->do != 'create'  ):
$return .= <<<CONTENT

	<li>
		<p class='ipsCenter'><button data-action='applyFilters' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_apply_tip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" type='button' class='ipsButton ipsButton_light ipsButton_fullWidth ipsButton_small ipsButton_disabled'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_apply', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button></p>
	</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>
<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>

CONTENT;

foreach ( $elements['']['stream_classes']->options['options'] as $type => $lang ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->filterFormContentType( $elements, str_replace('_pl', '', $lang ), $type, ( $elements['']['stream_classes_type']->value !== 0 && $elements['']['stream_classes']->value == $type ), $elements );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

<div class='ipsMenu ipsMenu_wide ipsPad ipsHide' data-role="streamContainer" data-contentKey="clubs" data-className="clubs" id='elMenu_clubFilter_menu'>
</div>
CONTENT;

		return $return;
}

	function filterFormTags( $tags ) {
		$return = '';
		$return .= <<<CONTENT


<input type="hidden" name="stream_tags_type" value="custom">
<h3 class='ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_tags', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsFieldRow_fullWidth'>
	{$tags->html()}
	<p class='ipsType_reset ipsType_small ipsType_light ipsPadding_top:half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tags_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
</div>
CONTENT;

		return $return;
}

	function filterFormTimePeriod( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $showTitle=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $elements['']['stream_date_relative_days'] ) ):
$return .= <<<CONTENT

	<li class='ipsPad ipsSpacer_top ipsSpacer_half cStreamForm_dates 
CONTENT;

if ( $elements['']['stream_date_type']->value !== 'relative' ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="dateRelativeForm">
		<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_date_relative_days_prefix', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
		{$elements['']['stream_date_relative_days']->html()}
		
CONTENT;

if ( $elements['']['stream_date_relative_days']->error ):
$return .= <<<CONTENT

			<br>
			<span class="ipsType_warning ipsType_small">
CONTENT;

$val = "{$elements['']['stream_date_relative_days']->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( isset( $elements['']['stream_date_range'] ) ):
$return .= <<<CONTENT

	<li class='ipsPad ipsSpacer_top ipsSpacer_half cStreamForm_dates 
CONTENT;

if ( $elements['']['stream_date_type']->value !== 'custom' ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="dateForm">
		<div class="ipsGrid ipsGrid_collapsePhone">
			<div class='ipsGrid_span6'>
				<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				{$elements['']['stream_date_range']->start->html()}	
			</div>
			<div class='ipsGrid_span6'>
				<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				{$elements['']['stream_date_range']->end->html()}	
			</div>
		</div>
		
CONTENT;

if ( $elements['']['stream_date_range']->error ):
$return .= <<<CONTENT

			<span class="ipsType_warning ipsType_small">
CONTENT;

$val = "{$elements['']['stream_date_range']->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function filterInlineForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.front.streams.form'>
	<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm id='elFilterForm'>
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

		<div class='' id='elStreamFilterForm'>
			<ul class='cStreamFilter ipsClearfix ipsList_reset ipsJS_show' data-role="filterBar">
				<li data-filter='stream_include_comments'>
					<a href='#elStreamShowMe_menu' id='elStreamShowMe' data-ipsMenu data-ipsMenu-stopLinks data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm'>
						<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_include_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
						<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
					</a>
				</li>
				<li data-filter='stream_classes'>
					<a href='#elStreamContentTypes_menu' id='elStreamContentTypes' data-ipsMenu data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm' data-ipsMenu-closeOnClick='false'>
						<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_classes_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
						<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
					</a>
				</li>
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $elements['']['stream_read'] ) ):
$return .= <<<CONTENT

					<li data-filter='stream_read'>
						<a href='#elStreamReadStatus_menu' id='elStreamReadStatus' data-ipsMenu data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm'>
							<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
						</a>
					</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $elements['']['stream_ownership'] ) ):
$return .= <<<CONTENT

					<li data-filter='stream_ownership'>
						<a href='#elStreamOwnership_menu' id='elStreamOwnership' data-ipsMenu data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm' data-ipsMenu-closeOnClick='false'>
							<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_ownership', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
						</a>
					</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $elements['']['stream_follow'] ) ):
$return .= <<<CONTENT

					<li data-filter='stream_follow'>
						<a href='#elStreamFollowStatus_menu' id='elStreamFollowStatus' data-ipsMenu data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='checkbox' data-ipsMenu-appendTo='#elStreamFilterForm' data-ipsMenu-closeOnClick='false'>
							<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
						</a>
					</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $elements['']['stream_date_type'] ) ):
$return .= <<<CONTENT

				<li data-filter='stream_date_type'>
					<a href='#elStreamTimePeriod_menu' id='elStreamTimePeriod' data-ipsMenu data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm' data-ipsMenu-closeOnClick='false'>
						<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_date_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
						<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
					</a>
				</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li data-filter='stream_sort'>
					<a href='#elStreamSortEdit_menu' id='elStreamSortEdit' data-ipsMenu data-ipsMenu-activeClass='cStreamFilter_active' data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elStreamFilterForm'>
						<h3 class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_sorting', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
						<p class='cStreamFilter_blurb ipsType_reset ipsTruncate ipsTruncate_line' data-role='filterOverview'></p>
					</a>
				</li>
			</ul>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

				<ul data-role="saveButtonContainer" class='ipsList_inline ipsHide ipsType_right ipsType_small ipsPad_half ipsAreaBackground_light'>
					<li><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_save_changes', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
					<li><a href='#' class='ipsButton ipsButton_link ipsButton_verySmall' data-action='dismissSave'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_save_dismiss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li>
						<button type='button' class='ipsButton ipsButton_link ipsButton_verySmall'  data-ipsMenu data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elFilterForm' data-action='saveNewStream' id='elSaveNewStream'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_button_save_as_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					</li>
					
CONTENT;

if ( isset( $hiddenValues['__stream_owner'] ) and $hiddenValues['__stream_owner'] === \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

						<li>
							<button type='button' class='ipsButton ipsButton_primary ipsButton_verySmall' data-action='saveStream' id='elSaveStream'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_button_save', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<a href='#' class='ipsResponsive_showPhone ipsResponsive_block ipsJS_show ipsButton ipsButton_link ipsButton_fullWidth' data-action="toggleFilters"></a>

			<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' id='elStreamSortEdit_menu'>
				<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_sort']->value == 'newest' ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<a href='#'>
						<input type="radio" name="stream_sort" value="newest" 
CONTENT;

if ( (string) $elements['']['stream_sort']->value == 'newest' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_stream_sort_newest">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_sort_newest', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
				<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_sort']->value == 'oldest' ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<a href='#'>
						<input type="radio" name="stream_sort" value="oldest" 
CONTENT;

if ( (string) $elements['']['stream_sort']->value == 'oldest' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_stream_sort_oldest">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_sort_oldest', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			</ul>

			<!-- Show me menu -->
			<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role="streamMenuFilter" id='elStreamShowMe_menu'>
				
CONTENT;

foreach ( $elements['']['stream_include_comments']->options['options'] as $k => $v ):
$return .= <<<CONTENT

					<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_include_comments']->value == $k ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						<a href='#'>
							<input type="radio" name="stream_include_comments" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['']['stream_include_comments']->value == $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="stream_ownership_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							
CONTENT;

$val = "{$v}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $elements['']['stream_tags'] ) ):
$return .= <<<CONTENT

				<!-- Tags menu -->
				<li><hr class='ipsHr'></li>
				<li class='ipsPad ipsPadding_top:half'>
					<input type="hidden" name="stream_tags_type" value="custom">
					<h3 class='ipsType_reset ipsTruncate ipsTruncate_line ipsPadding_bottom'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_tagged_with', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
					<div class='ipsFieldRow_fullWidth'>
						{$elements['']['stream_tags']->html()}
						<p class='ipsType_reset ipsType_small ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tags_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</div>
				</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>

			<!-- Content types menu -->
			<div class='ipsMenu ipsMenu_selectable ipsMenu_wide ipsPad ipsHide' data-role="streamMenuFilter" id='elStreamContentTypes_menu'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormShowMe( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form, FALSE );
$return .= <<<CONTENT

			</div>

			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<!-- Read Status menu -->
				<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role="streamMenuFilter" id='elStreamReadStatus_menu'>
					
CONTENT;

foreach ( $elements['']['stream_read']->options['options'] as $k => $v ):
$return .= <<<CONTENT

						<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_read']->value == $k ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							<a href='#'>
								<input type="radio" name="stream_read" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['']['stream_read']->value == $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_stream_read_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
								
CONTENT;

$val = "{$v}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								
CONTENT;

if ( $k == 'unread' ):
$return .= <<<CONTENT

									<p class="ipsType_reset ipsType_small ipsType_light">
										
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_read_unread_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</p>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
				<!-- Ownership menu -->
				<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role="streamMenuFilter" id='elStreamOwnership_menu'>
					
CONTENT;

foreach ( $elements['']['stream_ownership']->options['options'] as $k => $v ):
$return .= <<<CONTENT

						<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_ownership']->value == $k ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							<a href='#'>
								<input type="radio" name="stream_ownership" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['']['stream_ownership']->value == $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="stream_ownership_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
								
CONTENT;

$val = "{$v}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormOwnership( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form, FALSE );
$return .= <<<CONTENT

				</ul>
				<!-- Follow status menu -->
				<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role="streamMenuFilter" id='elStreamFollowStatus_menu'>
					<input type='hidden' name='stream_follow' value='
CONTENT;
$return .= htmlspecialchars( $elements['']['stream_follow']->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>

					
CONTENT;

foreach ( $elements['']['stream_followed_types']->options['options'] as $type => $lang ):
$return .= <<<CONTENT

						<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_followed_types']->value !== 0 && \in_array( $type, $elements['']['stream_followed_types']->value ) !== FALSE && (string) $elements['']['stream_follow']->value !== 'all' ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							<a href='#'>
								<input type='checkbox' name='stream_followed_types[
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]' value='1' 
CONTENT;

if ( $elements['']['stream_followed_types']->value !== 0 && \in_array( $type, $elements['']['stream_followed_types']->value ) !== FALSE && (string) $elements['']['stream_follow']->value !== 'all' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
								
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<!-- Time Period menu -->
			<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role="streamMenuFilter" id='elStreamTimePeriod_menu'>
				
CONTENT;

foreach ( $elements['']['stream_date_type']->options['options'] as $k => $v ):
$return .= <<<CONTENT

					<li class='ipsMenu_item 
CONTENT;

if ( $elements['']['stream_date_type']->value == $k ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						<a href='#'>
							<input type="radio" name="stream_date_type" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['']['stream_date_type']->value == $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="stream_date_type_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							
CONTENT;

$val = "{$v}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", \IPS\Request::i()->app )->filterFormTimePeriod( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class, $attributes, $sidebar, $form, FALSE );
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='elSaveNewStream_menu' class='ipsMenu ipsMenu_wide ipsHide ipsPad'>
			<ul class='ipsForm ipsForm_horizontal'>
				<li class='ipsFieldRow'>
					<input type='text' name='stream_title' value='
CONTENT;

if ( isset( $elements['']['stream_title'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $elements['']['stream_title']->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsField_fullWidth ipsField_primary' 
CONTENT;

if ( !empty($elements['']['stream_title']->options['maxLength']) ):
$return .= <<<CONTENT
maxLength="
CONTENT;
$return .= htmlspecialchars( $elements['']['stream_title']->options['maxLength'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
				</li>
				<li class='ipsFieldRow'>
					<button type='submit' data-action='newStream' class='ipsButton ipsButton_primary ipsButton_medium ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_new_stream', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				</li>
			</ul>
		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function stream( $stream, $results, $autoUpdate, $showTimeline=FALSE, $sort='date', $view='expanded' ) {
		$return = '';
		$return .= <<<CONTENT

<div data-role='streamResults' data-controller='core.front.streams.results' data-streamReadType="
CONTENT;
$return .= htmlspecialchars( $stream->read, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( !$autoUpdate ):
$return .= <<<CONTENT
data-view='
CONTENT;
$return .= htmlspecialchars( $view, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $autoUpdate && \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-streamUrl="
CONTENT;
$return .= htmlspecialchars( $stream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( \IPS\Request::i()->id ) ):
$return .= <<<CONTENT
data-streamID='
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<div class='ipsBox_alt'>
		<div class='ipsFlex ipsFlex-ai:center ipsFlex-jc:end sm:ipsMargin_bottom:half'>
			<p id='elStreamUpdateMsg' class='ipsMargin_right 
CONTENT;

if ( !( $autoUpdate && \IPS\Settings::i()->auto_polling_enabled ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_light ipsType_small ipsType_reset ipsJS_show ipsResponsive_hidePhone' data-role='updateMessage'><i class='fa fa-refresh'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_auto_updates', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			<ul class="ipsButton_split ipsClearfix">
				<li>
					<a href="
CONTENT;
$return .= htmlspecialchars( $stream->baseUrl->setQueryString( 'view', 'condensed')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action='switchView' data-view='condensed' data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_condensed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall 
CONTENT;

if ( $view == 'condensed' ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT
" rel="nofollow"><i class="fa fa-list"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_results_as_condensed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
				<li>
					<a href="
CONTENT;
$return .= htmlspecialchars( $stream->baseUrl->setQueryString( 'view', 'expanded')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action='switchView' data-view='expanded' data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_expanded', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall 
CONTENT;

if ( $view == 'expanded' ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT
" rel="nofollow"><i class="fa fa-bars"></i>  &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_results_as_expanded', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>
		</div>
		<ol class='ipsStream 
CONTENT;

if ( $showTimeline !== FALSE && \count( $results ) ):
$return .= <<<CONTENT
ipsStream_withTimeline
CONTENT;

endif;
$return .= <<<CONTENT
 ipsList_reset' data-role='streamContent'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "streams", "core" )->streamItems( $results, $showTimeline, $sort, $view );
$return .= <<<CONTENT

		</ol>
		<ol class="ipsList_reset">
			<li class='ipsType_center ipsJS_show 
CONTENT;

if ( !\count( $results ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="loadMoreContainer">
				<a href='#' class='ipsButton ipsButton_veryLight ipsButton_small' data-action='loadMore'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'load_more_activity', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		</ol>
	</div>
</div>
CONTENT;

		return $return;
}

	function streamItems( $results, $showTimeSeparators=FALSE, $sort='date', $view='expanded' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$currentSeparator = NULL;
$return .= <<<CONTENT


CONTENT;

if ( \count( $results ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $results as $result ):
$return .= <<<CONTENT

		
CONTENT;

if ( $result !== NULL ):
$return .= <<<CONTENT

			
CONTENT;

if ( $showTimeSeparators ):
$return .= <<<CONTENT

				
CONTENT;

if ( $currentSeparator != 'earlier' ):
$return .= <<<CONTENT

					
CONTENT;

$separator = $result->streamSeparator( $sort == 'date' );
$return .= <<<CONTENT

					
CONTENT;

if ( $currentSeparator != $separator ):
$return .= <<<CONTENT

						<li class='ipsStreamItem_time' data-timeType='
CONTENT;
$return .= htmlspecialchars( $separator, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$separator}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
						
CONTENT;

$currentSeparator = $separator;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			{$result->html( $view, $sort != 'date', TRUE )}
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( ! ( \IPS\Request::i()->isAjax() and isset( \IPS\Request::i()->before ) ) ):
$return .= <<<CONTENT

	<li class='ipsBox_alt ipsType_center ipsPad' data-role="streamNoResultsMessage">
		<p class='ipsType_reset ipsType_light ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function streamWrapper( $stream, $html, $form, $rssLink=NULL, $canCopy=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<section data-controller='core.front.streams.main, core.front.core.ignoredComments' data-streamID='
CONTENT;

if ( isset( \IPS\Request::i()->id ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
all
CONTENT;

endif;
$return .= <<<CONTENT
'>	

	
CONTENT;

if ( \IPS\Content\Search\Query::isRebuildRunning() ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_info">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_rebuild_is_running', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class="ipsPageHeader ipsBox ipsResponsive_pull ipsClearfix ipsMargin_bottom md:ipsMargin_bottom:half">
		<div class='ipsPadding_top ipsPadding_horizontal'>
			<div class='ipsFlex sm:ipsFlex-fd:column ipsFlex-jc:between ipsFlex-ai:start ipsFlex-fw:wrap ipsGap:3 ipsPadding_bottom'>
				<div class='ipsFlex-flex:11 sm:ipsMargin_bottom:half'>
					<h1 class='ipsType_pageTitle'>
						<span data-role='streamTitle'>
CONTENT;
$return .= htmlspecialchars( $stream->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</h1>
					
CONTENT;

if ( $form ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsType_normal' data-role='streamOverview'>
							<span data-role='streamBlurb'>
CONTENT;
$return .= htmlspecialchars( $stream->blurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>

				
CONTENT;

if ( $rssLink || ( $stream->member && $stream->member == \IPS\Member::loggedIn()->member_id ) || \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<ul class="ipsList_reset sm:ipsFlex-as:stretch ipsFlex-flex:01 ipsFlex sm:ipsFlex-fd:column-reverse sm:ipsFlex-ai:stretch ipsFlex-ai:center ipsFlex-jc:center ipsType_blendLinks">
						
CONTENT;

if ( $stream->member && $stream->member == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;
$return .= htmlspecialchars( $stream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_share_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsTooltip id='elStreamShare' class='ipsButton ipsButton_link ipsButton_verySmall ipsButton_fullWidth'><i class='fa fa-share-alt'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								<div class='ipsMenu ipsMenu_wide ipsPad ipsHide' id='elStreamShare_menu'>
									<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_stream_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
									<hr class='ipsHr'>
									<p class='ipsType_medium'>
										
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_stream_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</p>
									<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $stream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>
								</div>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

							<li><a href='#' class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_fullWidth' id='elStreamOptions' data-ipsMenu data-ipsMenu-appendTo='[data-streamID="
CONTENT;

if ( isset( \IPS\Request::i()->id ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
all
CONTENT;

endif;
$return .= <<<CONTENT
"]'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

						<ul class='ipsMenu ipsMenu_auto ipsHide' id='elStreamOptions_menu'>
							
CONTENT;

if ( $rssLink ):
$return .= <<<CONTENT
	
								<li class='ipsMenu_item'><a href="
CONTENT;
$return .= htmlspecialchars( $rssLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><i class="fa fa-rss fa-fw"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_rss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

                            
CONTENT;

if ( $stream->canSubscribe() ):
$return .= <<<CONTENT

                            	<li class='ipsMenu_item'>
									<a href="
CONTENT;
$return .= htmlspecialchars( $stream->url()->setQueryString('do','subscribe'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action='subscribe' data-ipsDialog data-ipsDialog-flashMessage='subscribed' data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$sprintf = array($stream->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_subscribe_s', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
										<i class='fa fa-envelope fa-fw'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_subscribe', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</a>
								</li>
                            
CONTENT;

elseif ( $stream->canUnsubscribe() ):
$return .= <<<CONTENT

                            	<li class='ipsMenu_item'>
									<a href="
CONTENT;
$return .= htmlspecialchars( $stream->url()->setQueryString('do','unsubscribe')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-confirm data-confirmMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'confirm_stream_unsubscribe', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_unsubscribe_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
                            			<i class='fa fa-envelope fa-fw'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_unsubscribe', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</a>
								</li>
                            
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $rssLink || $stream->canSubscribe() || $stream->canUnsubscribe() ):
$return .= <<<CONTENT

								<li class='ipsMenu_sep'><hr></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<li class='ipsMenu_item 
CONTENT;

if ( \IPS\Member::loggedIn()->defaultStream === $stream->_id ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a data-action="toggleStreamDefault" data-change="1" href="
CONTENT;
$return .= htmlspecialchars( $stream->url()->csrf()->setQueryString('default', 1), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_this_isnt_default', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
							<li class='ipsMenu_item 
CONTENT;

if ( \IPS\Member::loggedIn()->defaultStream !== $stream->_id ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a data-action="toggleStreamDefault" data-change="0" href="
CONTENT;
$return .= htmlspecialchars( $stream->url()->csrf()->setQueryString('default', 0), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_this_is_default', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
							
CONTENT;

if ( $stream->member AND $stream->member === \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'>
									<a href='
CONTENT;
$return .= htmlspecialchars( $stream->url()->setQueryString( 'do', 'edit' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_edit_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='editStream'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_edit_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								</li>
								<li class='ipsMenu_item'>
									<a href='
CONTENT;
$return .= htmlspecialchars( $stream->url()->setQueryString( 'do', 'delete' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='removeStream'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>

			
CONTENT;

if ( $canCopy ):
$return .= <<<CONTENT

				
CONTENT;

$owner = \IPS\Member::load( $stream->member );
$return .= <<<CONTENT

				<div class='ipsAreaBackground ipsPad ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $owner, 'mini' );
$return .= <<<CONTENT

					<div>
						<a href='
CONTENT;
$return .= htmlspecialchars( $stream->url()->setQueryString('do', 'copy')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_large ipsPos_right ipsResponsive_noFloat'><i class='fa fa-plus'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_copy_feed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</i></a>
						<p class='ipsType_reset ipsType_normal'>
							<strong>
CONTENT;

$sprintf = array($owner->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_copy_title', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong><br>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_copy_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</p>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( $form ):
$return .= <<<CONTENT

			{$form}
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div data-role='streamBody'>
		{$html}
	</div>

	
CONTENT;

if ( $rssLink || ( $stream->member && $stream->member == \IPS\Member::loggedIn()->member_id ) ):
$return .= <<<CONTENT

		<ul class="ipsList_inline ipsType_blendLinks ipsSpacer_both ipsType_center ipsResponsive_showPhone ipsResponsive_block">
			
CONTENT;

if ( $rssLink ):
$return .= <<<CONTENT
	
				<li><a href="
CONTENT;
$return .= htmlspecialchars( $rssLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><i class="fa fa-rss"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $stream->member && $stream->member == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;
$return .= htmlspecialchars( $stream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_share_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsTooltip id='elStreamShare'><i class='fa fa-share-alt'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<div class='ipsMenu ipsMenu_wide ipsPad ipsHide' id='elStreamShare_menu'>
						<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_stream_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
						<hr class='ipsHr'>
						<p class='ipsType_medium'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_stream_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</p>
						<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $stream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

</section>
CONTENT;

		return $return;
}

	function unsubscribeStream( $title, $member, $form, $choice = FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox ipsPad'>
    <p class='ipsType_reset ipsType_center ipsType_huge'>
        <i class='fa fa-envelope'></i>
    </p>

    <h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>

    <div class='ipsType_large ipsType_center ipsType_richText'>
        
CONTENT;

if ( $choice == 'single' ):
$return .= <<<CONTENT

        <div class="ipsMessage ipsMessage_info">
CONTENT;

$sprintf = array($title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_guest_unfollowed_thing', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</div>
        
CONTENT;

elseif ( $choice == 'all' ):
$return .= <<<CONTENT

        <div class="ipsMessage ipsMessage_info">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_guest_unfollowed_all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
        
CONTENT;

endif;
$return .= <<<CONTENT

    </div>
    <div class='ipsPadding'>
        {$form}
    </div>
</div>
<p class='ipsType_center'>
    <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "/", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</p>



CONTENT;

		return $return;
}}