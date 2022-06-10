<?php
namespace IPS\Theme\Cache;
class class_core_front_search extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function filters( $baseUrl, $count, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $errorTabs=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$countFields = array( 'search_min_comments', 'search_min_replies', 'search_min_reviews', 'search_min_views');
$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" method='post' action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsForm id='elSearchFilters_content'>
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

if ( $form->error ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_error ipsSpacer_bottom">
			
CONTENT;
$return .= htmlspecialchars( $form->error, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsFlex ipsFlex-ai:start ipsGap cSearchMainBar'>
		<button type='submit' class='ipsFlex-flex:00 cSearchPretendButton' tabindex='-1'><i class='fa fa-search ipsType_huge'></i></button>
		<div class='ipsFlex-flex:11'>
			<div class='cSearchWrapper'>
				<input type='text' id='elMainSearchInput' name='q' value='
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->q, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'q', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' autofocus class='ipsField_primary ipsField_fullWidth'>
				<div class='cSearchWrapper__button'>
					<button type='submit' id='elSearchSubmit' class='ipsButton ipsButton_primary ipsButton_verySmall ipsPos_right ipsResponsive_hidePhone 
CONTENT;

if ( isset( $hiddenValues['__advanced'] ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-action='searchAgain'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_again', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				</div>
			</div>
			<div class='ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap'>
				<div class='ipsFlex-flex:11 ipsType_brandedLinks'>
					<div class='ipsMargin_top' data-role="hints">
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", \IPS\Request::i()->app, 'front' )->hints( $baseUrl, $count );
$return .= <<<CONTENT

				</div>
				</div>
				<div>
					<p class='ipsType_reset ipsMargin_top 
CONTENT;

if ( isset( $hiddenValues['__advanced'] ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-action='showFilters'>
						<a href='#' class='ipsButton ipsButton_light ipsButton_verySmall'><i class='fa fa-plus'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_more_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div data-role='searchFilters' class='ipsSpacer_top ipsBox ipsBox--child 
CONTENT;

if ( !isset( $hiddenValues['__advanced'] ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
		
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

		<div class='ipsTabs ipsTabs_stretch ipsClearfix' id='elTabs_search' data-ipsTabBar data-ipsTabBar-contentArea='#elTabs_search_content'>
			<a href="#elTabs_search" data-action="expandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role='tablist'>
				<li>
					<a href='#' id="elTab_searchContent" class="ipsTabs_item 
CONTENT;

if ( \IPS\Request::i()->type != 'core_members' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_center" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_content_search_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" 
CONTENT;

if ( \IPS\Request::i()->type != 'core_members' ):
$return .= <<<CONTENT
aria-selected="true"
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_content_search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
				<li>
					<a href='#' id="elTab_searchMembers" class="ipsTabs_item 
CONTENT;

if ( \IPS\Request::i()->type == 'core_members' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_center" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_member_search_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" 
CONTENT;

if ( \IPS\Request::i()->type == 'core_members' ):
$return .= <<<CONTENT
aria-selected="true"
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_member_search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			</ul>
		</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<section id='elTabs_search_content' class='ipsTabs_panels'>
			<div id='ipsTabs_elTabs_search_elTab_searchContent_panel' class='ipsTabs_panel' data-tabType='content'>
				<div class='ipsPad_double'>
					<div class=''>		
						<ul class='ipsList_reset'>
							
CONTENT;

if ( \IPS\Settings::i()->tags_enabled ):
$return .= <<<CONTENT

								
CONTENT;

if ( isset( $elements['search_tab_content']['tags'] ) ):
$return .= <<<CONTENT

									<li class='ipsSpacer_half 
CONTENT;

if ( !$elements['search_tab_content']['tags']->value ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 ipsFieldRow_fullWidth' data-role='searchTags'>
										<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_by_tags', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
										{$elements['search_tab_content']['tags']->html()}
										<span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tags_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
									</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset( $elements['search_tab_content']['eitherTermsOrTags'] ) ):
$return .= <<<CONTENT

									<li class='ipsSpacer_top ipsSpacer_half 
CONTENT;

if ( !$elements['search_tab_content']['tags']->value || !$elements['search_tab_all']['q']->value ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='searchTermsOrTags'>
										<ul class='ipsFieldRow_content ipsList_reset'>
											<li class='ipsFieldRow_inlineCheckbox'>
												<span class='ipsCustomInput'>
													<input type='radio' name="eitherTermsOrTags" value="or" id='elRadio_eitherTermsOrTags_or' 
CONTENT;

if ( $elements['search_tab_content']['eitherTermsOrTags']->value == 'or' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
													<span></span>
												</span> <label for='elRadio_eitherTermsOrTags_or'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'termsortags_or_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
											</li>
											<li class='ipsFieldRow_inlineCheckbox'>
												<span class='ipsCustomInput'>
													<input type='radio' name="eitherTermsOrTags" value="and" id='elRadio_eitherTermsOrTags_and' 
CONTENT;

if ( $elements['search_tab_content']['eitherTermsOrTags']->value == 'and' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
													<span></span>
												</span> <label for='elRadio_eitherTermsOrTags_and'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'termsortags_and_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
											</li>
										</ul>
									</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $elements['search_tab_content']['author'] ) ):
$return .= <<<CONTENT

								<li class='ipsSpacer_top 
CONTENT;

if ( !$elements['search_tab_content']['author']->value ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 ipsFieldRow_fullWidth' data-role='searchAuthors'>
									<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_by_author', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
									{$elements['search_tab_content']['author']->html()}
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
						
CONTENT;

if ( isset( $elements['search_tab_content']['tags'] ) || isset( $elements['search_tab_content']['author'] ) ):
$return .= <<<CONTENT

							<ul class="ipsList_inline ipsType_normal ipsJS_show">
								
CONTENT;

if ( \IPS\Settings::i()->tags_enabled and isset( $elements['search_tab_content']['tags'] ) && !$elements['search_tab_content']['tags']->value ):
$return .= <<<CONTENT

									<li><a href="#" data-action="searchByTags" data-opens='searchTags,searchTermsOrTags'><i class="fa fa-plus"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_by_tags', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset( $elements['search_tab_content']['author'] ) && !$elements['search_tab_content']['author']->value ):
$return .= <<<CONTENT

									<li><a href="#" data-action="searchByAuthors" data-opens='searchAuthors'><i class="fa fa-plus"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_by_author', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</ul>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>

					<div class='ipsGrid ipsGrid_collapsePhone ipsSpacer_top ipsSpacer_double'>
						
CONTENT;

if ( isset( $elements['search_tab_content']['type'] ) ):
$return .= <<<CONTENT

							
CONTENT;

$type = $elements['search_tab_content']['type'];
$return .= <<<CONTENT

							<div class='ipsGrid_span3'>
								<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'searchType', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
								<ul class="ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal" data-role='searchApp' data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false">
									
CONTENT;

foreach ( $type->options['options'] as $k => $lang ):
$return .= <<<CONTENT

										
CONTENT;

if ( $k == 'core_members' ):
$return .= <<<CONTENT

CONTENT;

continue;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

										<li>
											<span id='elSearchToggle_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsSideMenu_item 
CONTENT;

if ( (string) $type->value == (string) $k ):
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
												<input type="radio" name="type" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $type->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_type_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $type->options['toggles'][ $k ] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-toggle-visibleCheck='#elSearchToggle_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
												<label for='elRadio_type_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_type_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label' data-role='searchAppTitle'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
											</span>
										</li>
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
								
								
CONTENT;

if ( isset( $elements['search_tab_nodes'] ) ):
$return .= <<<CONTENT

									<br>
									
CONTENT;

foreach ( $elements['search_tab_nodes'] as $element ):
$return .= <<<CONTENT

										<div id="
CONTENT;
$return .= htmlspecialchars( $element->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
											<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$val = "{$element->label}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
											{$element->html()}
										</div>
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

								
								
CONTENT;

if ( isset( $elements['search_tab_content']['club'] ) ):
$return .= <<<CONTENT

									<div id="
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['club']->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsContained'>
										<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
										{$elements['search_tab_content']['club']->html()}
									</div>
								
CONTENT;

endif;
$return .= <<<CONTENT


								<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<div class='ipsGrid_span9'>
							<div class='ipsGrid_span9' data-role='searchFilters' id='elSearchFiltersMain'>
								<div class='ipsGrid ipsGrid_collapsePhone'>
									<div class='ipsGrid_span6'>
										<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'searchIn', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
										<ul class='ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half' role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='searchIn'>
											
CONTENT;

foreach ( $elements['search_tab_content']['search_in']->options['options'] as $k => $lang ):
$return .= <<<CONTENT

												<li>
													<span class='ipsSideMenu_item 
CONTENT;

if ( (string) $elements['search_tab_content']['search_in']->value == (string) $k ):
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
														<input type="radio" name="search_in" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['search_tab_content']['search_in']->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_searchIn_full_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
														<label for='elRadio_searchIn_full_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_searchIn_full_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
													</span>
												</li>
											
CONTENT;

endforeach;
$return .= <<<CONTENT

										</ul>
									</div>
									<div class='ipsGrid_span6'>
										<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'andOr', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
										<ul class='ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half' role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='andOr'>
											
CONTENT;

foreach ( $elements['search_tab_content']['search_and_or']->options['options'] as $k => $lang ):
$return .= <<<CONTENT

												<li>
													<span class='ipsSideMenu_item 
CONTENT;

if ( (string) $elements['search_tab_content']['search_and_or']->value == (string) $k ):
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
														<input type="radio" name="search_and_or" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['search_tab_content']['search_and_or']->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_andOr_full_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
														<label for='elRadio_andOr_full_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_andOr_full_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
													</span>
												</li>
											
CONTENT;

endforeach;
$return .= <<<CONTENT

										</ul>
									</div>
								</div>
								<br>
								<div class='ipsGrid ipsGrid_collapsePhone'>
									
CONTENT;

if ( isset( $elements['search_tab_content']['startDate'] ) ):
$return .= <<<CONTENT

										<div class='ipsGrid_span6'>
											<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'startDate', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
											<ul class="ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half" role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='dateCreated'>
												
CONTENT;

foreach ( $elements['search_tab_content']['startDate']->options['options'] as $k => $lang ):
$return .= <<<CONTENT

													<li>
														<span class='ipsSideMenu_item 
CONTENT;

if ( (string) $elements['search_tab_content']['startDate']->value == (string) $k ):
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
															<input type="radio" name="startDate" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['search_tab_content']['startDate']->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_startDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
															<label for='elRadio_startDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_startDate_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
														</span>
													</li>
												
CONTENT;

endforeach;
$return .= <<<CONTENT

												<li class='ipsGrid ipsGrid_collapsePhone cStreamForm_dates ipsAreaBackground_light ipsPad_half 
CONTENT;

if ( $elements['search_tab_content']['startDate']->value !== 'custom' ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="dateForm">
													<div class='ipsGrid_span6'>
														<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
														<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['startDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[start]' data-control='date' data-role='start' value='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['startDateCustom']->value['start'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>	
													</div>
													<div class='ipsGrid_span6'>
														<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
														<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['startDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[end]' data-control='date' data-role='end' value='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['startDateCustom']->value['end'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
													</div>
												</li>
											</ul>
											<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
										</div>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( isset( $elements['search_tab_content']['updatedDate'] ) ):
$return .= <<<CONTENT

										<div class='ipsGrid_span6'>
											<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'updatedDate', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
											<ul class="ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half" role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='dateUpdated'>
												
CONTENT;

foreach ( $elements['search_tab_content']['updatedDate']->options['options'] as $k => $lang ):
$return .= <<<CONTENT

													<li>
														<span class='ipsSideMenu_item 
CONTENT;

if ( (string) $elements['search_tab_content']['updatedDate']->value == (string) $k ):
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
															<input type="radio" name="updatedDate" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['search_tab_content']['updatedDate']->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_updatedDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
															<label for='elRadio_updatedDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_updatedDate_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
														</span>
													</li>
												
CONTENT;

endforeach;
$return .= <<<CONTENT

												<li class='ipsGrid ipsGrid_collapsePhone cStreamForm_dates ipsAreaBackground_light ipsPad_half 
CONTENT;

if ( $elements['search_tab_content']['updatedDate']->value !== 'custom' ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="dateForm">
													<div class='ipsGrid_span6'>
														<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
														<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['updatedDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[start]' data-control='date' data-role='start' value='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['updatedDateCustom']->value['start'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>	
													</div>
													<div class='ipsGrid_span6'>
														<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
														<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['updatedDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[end]' data-control='date' data-role='end' value='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_content']['updatedDateCustom']->value['end'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
													</div>
												</li>
											</ul>
										</div>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</div>

								<hr class='ipsHr'>

								<h3 class="ipsType_reset ipsType_large cStreamForm_title" id="elSearch_filter_by_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_filter_by_number', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
								<ul class="ipsList_inline ipsSpacer_top ipsSpacer_half ipsType_normal">
									
CONTENT;

foreach ( $elements['search_tab_content'] as $inputName => $input ):
$return .= <<<CONTENT

										
CONTENT;

if ( \in_array( $inputName, $countFields ) ):
$return .= <<<CONTENT

											<li id='
CONTENT;
$return .= htmlspecialchars( $inputName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
												<a href="#elSearch_
CONTENT;
$return .= htmlspecialchars( $inputName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-ipsMenu data-ipsMenu-appendTo='#elSearchFilters_content' data-ipsMenu-closeOnClick='false' id='elSearch_
CONTENT;
$return .= htmlspecialchars( $inputName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='
CONTENT;
$return .= htmlspecialchars( $inputName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_link'><span class='ipsBadge ipsBadge_small ipsBadge_style1 
CONTENT;

if ( $input->value <= 0 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='fieldCount'>
CONTENT;
$return .= htmlspecialchars( $input->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;

$val = "{$inputName}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
												<div class='ipsMenu ipsMenu_medium ipsFieldRow_fullWidth ipsPad ipsHide' id='elSearch_
CONTENT;
$return .= htmlspecialchars( $inputName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
													<h4 class="ipsType_reset ipsType_minorHeading ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$val = "{$inputName}_title"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
													<div class='ipsFieldRow_fullWidth'>
														{$input->html()}
													</div>
												</div>
											</li>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

				<div id='ipsTabs_elTabs_search_elTab_searchMembers_panel' class='ipsTabs_panel' data-tabType='members'>
					
CONTENT;

$exclude = array( 'joinedDate', 'joinedDateCustom', 'group');
$return .= <<<CONTENT

					
CONTENT;

$totalCustomFields = \count( $elements['search_tab_member'] ) - \count( $exclude ); // Don't count joined, joined custom or group
$return .= <<<CONTENT

					
CONTENT;

$perCol = ceil( $totalCustomFields / 2 );
$return .= <<<CONTENT

					<div class='ipsPad_double'>
						<span class='ipsJS_hide'>
							<input type="radio" name="type" value="core_members" 
CONTENT;

if ( (string) $elements['search_tab_content']['type']->value == (string) 'core_members' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_type_core_members">
							<label for='elRadio_type_core_members' id='elField_type_core_members_label' data-role='searchAppTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'core_members_pl', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
						</span>
						<div class='ipsGrid ipsGrid_collapsePhone'>
							<div class='ipsGrid_span4'>
								
CONTENT;

if ( isset( $elements['search_tab_member']['joinedDate'] ) ):
$return .= <<<CONTENT

									<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'joinedDate', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
									<ul class="ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half" role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='joinedDate'>
										
CONTENT;

foreach ( $elements['search_tab_member']['joinedDate']->options['options'] as $k => $lang ):
$return .= <<<CONTENT

											<li>
												<span class='ipsSideMenu_item 
CONTENT;

if ( (string) $elements['search_tab_member']['joinedDate']->value == (string) $k ):
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
													<input type="radio" name="joinedDate" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['search_tab_member']['joinedDate']->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_joinedDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
													<label for='elRadio_joinedDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_joinedDate_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
												</span>
											</li>
										
CONTENT;

endforeach;
$return .= <<<CONTENT

										<li class='ipsGrid ipsGrid_collapsePhone cStreamForm_dates ipsAreaBackground_light ipsPad_half 
CONTENT;

if ( $elements['search_tab_member']['joinedDate']->value !== 'custom' ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="dateForm">
											<div class='ipsGrid_span6'>
												<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
												<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_member']['joinedDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[start]' data-control='date' data-role='start' value='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_member']['joinedDateCustom']->value['start'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>	
											</div>
											<div class='ipsGrid_span6'>
												<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
												<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_member']['joinedDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[end]' data-control='date' data-role='end' value='
CONTENT;
$return .= htmlspecialchars( $elements['search_tab_member']['joinedDateCustom']->value['end'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
											</div>
										</li>
									</ul>
									<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
							<div class='ipsGrid_span8' data-role='searchFilters' id='elSearchFiltersMembers'>
								<div class='ipsGrid ipsGrid_collapsePhone'>
									<div class='ipsGrid_span6'>
										
CONTENT;

if ( isset( $elements['search_tab_member']['group'] ) ):
$return .= <<<CONTENT

											<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'group', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
											<ul class="ipsSideMenu_list ipsSideMenu_withChecks ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half" data-ipsSideMenu data-ipsSideMenu-type="check" data-ipsSideMenu-responsive="false" data-filterType='group'>
												
CONTENT;

foreach ( $elements['search_tab_member']['group']->options['options'] as $k => $group ):
$return .= <<<CONTENT

													<li>
														<span class='ipsSideMenu_item 
CONTENT;

if ( \is_array( $elements['search_tab_member']['group']->value ) AND \in_array( $k, $elements['search_tab_member']['group']->value ) ):
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
															<input type="checkbox" name="group" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( \is_array( $elements['search_tab_member']['group']->value ) AND \in_array( $k, $elements['search_tab_member']['group']->value ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheck_group_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
															<label for='elCheck_group_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_group_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$group}</label>
														</span>
													</li>
												
CONTENT;

endforeach;
$return .= <<<CONTENT

											</ul>
										
CONTENT;

endif;
$return .= <<<CONTENT

	
										
CONTENT;

$countOne = 0;
$return .= <<<CONTENT

										
CONTENT;

if ( $totalCustomFields > 1 ):
$return .= <<<CONTENT

											
CONTENT;

foreach ( $elements['search_tab_member'] as $id => $element ):
$return .= <<<CONTENT

												
CONTENT;

if ( \in_array( $id, $exclude ) ):
$return .= <<<CONTENT

													
CONTENT;

continue;
$return .= <<<CONTENT

												
CONTENT;

endif;
$return .= <<<CONTENT

												
CONTENT;

$countOne++;
$return .= <<<CONTENT

	
												<hr class='ipsHr'>
												<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$val = "{$id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
												<div class='ipsFieldRow_fullWidth'>
													{$element->html()}
												</div>
												
												
CONTENT;

if ( $countOne >= $perCol ):
$return .= <<<CONTENT

													
CONTENT;

break;
$return .= <<<CONTENT

												
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

endforeach;
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

										<hr class='ipsHr ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block'>
									</div>
									<div class='ipsGrid_span6'>
										
CONTENT;

$countTwo = 0;
$return .= <<<CONTENT

										
CONTENT;

$realCount = 0;
$return .= <<<CONTENT

										
CONTENT;

foreach ( $elements['search_tab_member'] as $id => $element ):
$return .= <<<CONTENT

											
CONTENT;

if ( \in_array( $id, $exclude ) ):
$return .= <<<CONTENT

												
CONTENT;

continue;
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

$countTwo++;
$return .= <<<CONTENT

	
											
CONTENT;

if ( $countTwo <= $countOne ):
$return .= <<<CONTENT

												
CONTENT;

continue;
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT


											
CONTENT;

if ( $countTwo !== ( $countOne + 1 ) ):
$return .= <<<CONTENT

												<!-- HR except for first item -->
												<hr class='ipsHr'>
											
CONTENT;

endif;
$return .= <<<CONTENT


											<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$val = "{$id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
											<div class='ipsFieldRow_fullWidth'>
												{$element->html()}
											</div>
											
CONTENT;

$realCount++;
$return .= <<<CONTENT

											
CONTENT;

if ( $realCount >= $perCol ):
$return .= <<<CONTENT

												
CONTENT;

break;
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

endforeach;
$return .= <<<CONTENT

									</div>			
								</div>			
							</div>
						</div>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</section>
		<div class='ipsBorder_top ipsPadding cSearchFiltersSubmit'>
			<ul class='ipsToolList ipsToolList_horizontal ipsClearfix'>
				<li class='ipsPos_right'>
					<button type="submit" class="ipsButton ipsButton_primary ipsButton_medium ipsButton_fullWidth" data-action="updateResults">
						
CONTENT;

if ( \IPS\Request::i()->type == 'core_members' ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_members', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</button>
				</li>
				<li class='ipsPos_right'>
					<button type="button" class="ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth 
CONTENT;

if ( isset( $hiddenValues['__advanced'] ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
" data-action="cancelFilters">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				</li>
			</ul>
		</div>
	</div>
</form>
CONTENT;

		return $return;
}

	function globalSearchMenuOptions( $exclude ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->globalSearchMenuOptions() as $type => $name ):
$return .= <<<CONTENT

	
CONTENT;

if ( !\in_array( $type, $exclude ) ):
$return .= <<<CONTENT

		<li>
			<span class='ipsSideMenu_item' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<input type="radio" name="type" value="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id="elQuickSearchRadio_type_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				<label for='elQuickSearchRadio_type_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elQuickSearchRadio_type_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
			</span>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function hints( $url, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( \IPS\Request::i()->q ) and \IPS\Request::i()->q AND ( !isset( \IPS\Request::i()->type ) OR \IPS\Request::i()->type != 'core_members' ) ):
$return .= <<<CONTENT


CONTENT;

$words = \IPS\Content\Search\Query::termAsWordsArray( \IPS\Request::i()->q, FALSE, 0 );
$return .= <<<CONTENT


CONTENT;

$noPhraseWords = \IPS\Content\Search\Query::termAsWordsArray( \IPS\Request::i()->q, TRUE );
$return .= <<<CONTENT

	<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_better_results_hint', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	<ul class='ipsList_inline ipsType_brandedLinks'>
		
CONTENT;

if ( ! \IPS\Content\Search\Query::termIsPhrase( \IPS\Request::i()->q ) and \count( $words ) > 1 ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString('q', '"' . \IPS\Request::i()->q . '"'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array(\IPS\Request::i()->q); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_hint_phrase', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

elseif ( \IPS\Content\Search\Query::termIsPhrase( \IPS\Request::i()->q ) and \count( $noPhraseWords ) > 1 ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'q' => implode( ' ', $noPhraseWords ), 'search_and_or' => 'or' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( implode( ' ' . \IPS\Member::loggedIn()->language()->addToStack('search_join_or') . ' ', $noPhraseWords ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \count( $words ) > 1 ):
$return .= <<<CONTENT

			
CONTENT;

if ( ( ( !isset( \IPS\Request::i()->search_and_or ) and \IPS\Settings::i()->search_default_operator === 'and' ) or \IPS\Request::i()->search_and_or == 'and' ) ):
$return .= <<<CONTENT

				<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'search_and_or', 'or'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( implode( ' ' . \IPS\Member::loggedIn()->language()->addToStack('search_join_or') . ' ', $words ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

elseif ( ( ( !isset( \IPS\Request::i()->search_and_or ) and \IPS\Settings::i()->search_default_operator === 'or' ) or \IPS\Request::i()->search_and_or == 'or' ) ):
$return .= <<<CONTENT

				<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'search_and_or', 'and'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( implode( ' ' . \IPS\Member::loggedIn()->language()->addToStack('search_join_and') . ' ', $words ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $count > 1 and ( ! isset( \IPS\Request::i()->sortby ) or \IPS\Request::i()->sortby != 'newest' ) ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString('sortby', 'newest'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_newer_first', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

elseif ( $count > 1 and ( isset( \IPS\Request::i()->sortby ) and \IPS\Request::i()->sortby == 'newest' ) ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString('sortby', 'relevancy'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_most_pertinent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( isset( \IPS\Request::i()->search_in ) and \IPS\Request::i()->search_in == 'titles' ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString('search_in', 'all'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array(\IPS\Request::i()->q); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_titles_and_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

elseif ( $count > 1 and ( ! isset( \IPS\Request::i()->search_in ) or \IPS\Request::i()->search_in != 'titles' ) ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString('search_in', 'titles'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array(\IPS\Request::i()->q); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_titles_only', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( isset( \IPS\Request::i()->updated_after ) and \IPS\Request::i()->updated_after != 'any' ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $url->stripQueryString( array('updated_after' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array(\IPS\Request::i()->q); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_all_dates', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

		return $return;
}

	function member( $member ) {
		$return = '';
		$return .= <<<CONTENT

<li class="ipsGrid_span4 ipsStreamItem ipsStreamItem_contentBlock ipsStreamItem_member ipsAreaBackground_reset ipsPad ipsType_center">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'medium' );
$return .= <<<CONTENT

	<div class='ipsStreamItem_container'>
		<div class='ipsStreamItem_header ipsSpacer_top ipsSpacer_half'>
			<h2 class='ipsType_reset ipsStreamItem_title ipsTruncate ipsTruncate_line' data-searchable>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $member );
$return .= <<<CONTENT

			</h2>
			<p class='ipsType_reset ipsType_medium'>{$member->groupName}</p>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $member );
$return .= <<<CONTENT

		</div>

		<ul class='ipsList_reset ipsGrid ipsBorder_vertical ipsMargin_vertical:half ipsPadding_vertical:half'>
			<li class='ipsGrid_span6 ipsList_reset ipsType_center'>
				<h3 class='ipsType_minorHeading ipsType_unbold'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<p class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$val = ( $member->joined instanceof \IPS\DateTime ) ? $member->joined : \IPS\DateTime::ts( $member->joined );$return .= $val->html();
$return .= <<<CONTENT
</p>
			</li>
			<li class='ipsGrid_span6 ipsList_reset ipsType_center'>
				<h3 class='ipsType_minorHeading ipsType_unbold'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<p class='ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->member_posts );
$return .= <<<CONTENT
</p>
			</li>
		</ul>

		<ul class='ipsList_reset ipsGap:1'>
			<li>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_fullWidth ipsButton_light ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id and ( !$member->members_bitoptions['pp_setting_moderate_followers'] or \IPS\Member::loggedIn()->following( 'core', 'member', $member->member_id ) ) ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $member->member_id, $member->followersCount(), TRUE );
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>
</li>
CONTENT;

		return $return;
}

	function memberFilters( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$exclude = array( 'q', 'joinedDate', 'joinedDateCustom', 'group');
$return .= <<<CONTENT


CONTENT;

$totalCustomFields = \count( $elements[''] ) - \count( $exclude ); // Don't count q, joined, joined custom or group
$return .= <<<CONTENT


CONTENT;

$perCol = ceil( $totalCustomFields / 2 );
$return .= <<<CONTENT



CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" method='post' action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsForm id='elSearchFilters_content'>

CONTENT;

endif;
$return .= <<<CONTENT

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


	<div class='ipsPad_double'>
		<!--<div class='ipsAreaBackground_light ipsPad ipsSpacer_both ipsPhotoPanel ipsPhotoPanel_mini'>
			<i class='fa fa-user ipsType_huge ipsPos_left'></i>
			<div>
				<ul class='ipsList_reset'>
					
CONTENT;

if ( isset( $elements['']['q'] ) ):
$return .= <<<CONTENT

						<li class='ipsSpacer_bottom ipsSpacer_half'>
							<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">Search By Member Name</h3>
							<input type='text' name='q' value='
CONTENT;

if ( \is_array( $elements['']['q']->value ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode( ',', $elements['']['q']->value ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $elements['']['q']->value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsField_primary ipsField_fullWidth'>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>
		</div>
		<hr class='ipsHr ipsSpacer_bottom ipsSpacer_double'>-->

		<div class='ipsGrid ipsGrid_collapsePhone'>
			<div class='ipsGrid_span4'>
				
CONTENT;

if ( isset( $elements['']['joinedDate'] ) ):
$return .= <<<CONTENT

					<h3 class="ipsType_reset ipsType_large cStreamForm_title">Joined</h3>
					<ul class="ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half" role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='joinedDate'>
						
CONTENT;

foreach ( $elements['']['joinedDate']->options['options'] as $k => $lang ):
$return .= <<<CONTENT

							<li>
								<a href='#' class='ipsSideMenu_item 
CONTENT;

if ( (string) $elements['']['joinedDate']->value == (string) $k ):
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
									<input type="radio" name="joinedDate" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $elements['']['joinedDate']->value == (string) $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_joinedDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
									<label for='elRadio_joinedDate_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_joinedDate_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
								</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

						<li class='ipsGrid ipsGrid_collapsePhone cStreamForm_dates ipsAreaBackground_light ipsPad_half 
CONTENT;

if ( $elements['']['joinedDate']->value !== 'custom' ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="dateForm">
							<div class='ipsGrid_span6'>
								<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
								<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['']['joinedDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[start]' data-control='date' data-role='start' value='
CONTENT;
$return .= htmlspecialchars( $elements['']['joinedDateCustom']->value['start'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>	
							</div>
							<div class='ipsGrid_span6'>
								<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
								<input type='date' name='
CONTENT;
$return .= htmlspecialchars( $elements['']['joinedDateCustom']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[end]' data-control='date' data-role='end' value='
CONTENT;
$return .= htmlspecialchars( $elements['']['joinedDateCustom']->value['end'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							</div>
						</li>
					</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsGrid_span8' data-role='searchFilters' id='elSearchFiltersMembers'>
				<div class='ipsGrid ipsGrid_collapsePhone'>
					<div class='ipsGrid_span6'>
						
CONTENT;

if ( isset( $elements['']['group'] ) ):
$return .= <<<CONTENT

							<h3 class="ipsType_reset ipsType_large cStreamForm_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'group', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<ul class="ipsSideMenu_list ipsSideMenu_withChecks ipsSideMenu_small ipsType_normal ipsSpacer_top ipsSpacer_half" data-ipsSideMenu data-ipsSideMenu-type="check" data-ipsSideMenu-responsive="false" data-filterType='group'>
								
CONTENT;

foreach ( $elements['']['group']->options['options'] as $k => $group ):
$return .= <<<CONTENT

									<li>
										<a href='#' class='ipsSideMenu_item 
CONTENT;

if ( \is_array( $elements['']['group']->value ) AND \in_array( $k, $elements['']['group']->value ) ):
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
											<input type="checkbox" name="group" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( \is_array( $elements['']['group']->value ) AND \in_array( $k, $elements['']['group']->value ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheck_group_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
											<label for='elCheck_group_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_group_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$group}</label>
										</a>
									</li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						
CONTENT;

endif;
$return .= <<<CONTENT


						
CONTENT;

$countOne = 0;
$return .= <<<CONTENT

						
CONTENT;

if ( $totalCustomFields > 1 ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $elements[''] as $id => $element ):
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( $id, $exclude ) ):
$return .= <<<CONTENT

									
CONTENT;

continue;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

$countOne++;
$return .= <<<CONTENT


								<hr class='ipsHr'>
								<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$val = "{$id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
								<div class='ipsFieldRow_fullWidth'>
									{$element->html()}
								</div>
								
								
CONTENT;

if ( $countOne >= $perCol ):
$return .= <<<CONTENT

									
CONTENT;

break;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
					<div class='ipsGrid_span6'>
						
CONTENT;

$countTwo = 0;
$return .= <<<CONTENT

						
CONTENT;

foreach ( $elements[''] as $id => $element ):
$return .= <<<CONTENT

							
CONTENT;

if ( \in_array( $id, $exclude ) ):
$return .= <<<CONTENT

								
CONTENT;

continue;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

$countTwo++;
$return .= <<<CONTENT


							
CONTENT;

if ( $countTwo <= $countOne ):
$return .= <<<CONTENT

								
CONTENT;

continue;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT


							
CONTENT;

if ( $countTwo !== ( $countOne + 1 ) ):
$return .= <<<CONTENT

								<!-- HR except for first item -->
								<hr class='ipsHr'>
							
CONTENT;

endif;
$return .= <<<CONTENT


							<h3 class="ipsType_reset ipsType_large cStreamForm_title ipsSpacer_bottom ipsSpacer_half">
CONTENT;

$val = "{$id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<div class='ipsFieldRow_fullWidth'>
								{$element->html()}
							</div>
							
							
CONTENT;

if ( $countTwo >= $perCol ):
$return .= <<<CONTENT

								
CONTENT;

break;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</div>			
				</div>			
			</div>
		</div>
	</div>
	<div class='ipsAreaBackground cSearchFiltersSubmit'>
		<ul class='ipsToolList ipsToolList_horizontal ipsClearfix'>
			<li class='ipsPos_right'>
				<button type="submit" class="ipsButton ipsButton_primary ipsButton_medium ipsButton_fullWidth" data-action="updateResults">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'update_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			</li>
			<li class='ipsPos_right'>
				<button type="button" class="ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth" data-action="cancelFilters">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			</li>
		</ul>
	</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
	
</form>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function resultStream( $results, $pagination, $baseUrl, $hideSort=FALSE, $count = 0 ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox ipsMargin_bottom'>
	<p class='ipsType_sectionTitle'>
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_found', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

if ( $pagination OR !$hideSort ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

			{$pagination}
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !$hideSort ):
$return .= <<<CONTENT

			<ul class="ipsButtonRow ipsPos_right ipsClearfix">
				<li>
					<a href="#elSortByMenu_menu" id="elSortByMenu_search_results" data-role="sortButton" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide" id="elSortByMenu_search_results_menu">
						
CONTENT;

if ( !isset( \IPS\Request::i()->type ) OR \IPS\Request::i()->type != 'core_members' ):
$return .= <<<CONTENT

							<li class="ipsMenu_item
CONTENT;

if ( \IPS\Request::i()->sortby == 'newest' ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-sortDirection='desc'><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortby' => 'newest' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class="ipsMenu_item
CONTENT;

if ( \IPS\Request::i()->sortby == 'relevancy' ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-sortDirection='desc'><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortby' => 'relevancy' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_relevancy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li class="ipsMenu_item
CONTENT;

if ( \IPS\Request::i()->sortby == 'joined' ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-sortDirection='desc'><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortby' => 'joined', 'sortdirection' => 'desc' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class="ipsMenu_item
CONTENT;

if ( \IPS\Request::i()->sortby == 'name' || !isset( \IPS\Request::i()->sortby ) ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-sortDirection='asc'><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortby' => 'name', 'sortdirection' => 'asc' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_mname', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class="ipsMenu_item
CONTENT;

if ( \IPS\Request::i()->sortby == 'member_posts' ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-sortDirection='desc'><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortby' => 'member_posts', 'sortdirection' => 'desc' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class="ipsMenu_item
CONTENT;

if ( \IPS\Request::i()->sortby == 'pp_reputation_points' ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-sortDirection='desc'><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortby' => 'pp_reputation_points', 'sortdirection' => 'desc' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_reputation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>	
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

if ( \count( $results )  ):
$return .= <<<CONTENT

	<ol class="ipsStream ipsList_reset 
CONTENT;

if ( \IPS\Request::i()->type == 'core_members' ):
$return .= <<<CONTENT
cStream_members ipsGrid ipsGrid_collapsePhone
CONTENT;

endif;
$return .= <<<CONTENT
" data-role='resultsContents' 
CONTENT;

if ( \IPS\Request::i()->type == 'core_members' ):
$return .= <<<CONTENT
data-ipsGrid data-ipsGrid-equalHeights='row' data-ipsGrid-minItemSize='250' data-ipsGrid-maxItemSize='400'
CONTENT;

endif;
$return .= <<<CONTENT
>
		
CONTENT;

foreach ( $results as $result ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Request::i()->type == 'core_members' ):
$return .= <<<CONTENT

				{$result->searchResultHtml()}
			
CONTENT;

elseif ( $result !== NULL ):
$return .= <<<CONTENT

				{$result->html()}
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ol>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsAreaBackground_light ipsType_center ipsPad' data-role='resultsContents'>
		<p class='ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_search_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		{$pagination}
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function results( $termJSON, $title, $results, $pagination, $baseUrl, $count=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.front.search.results' data-term='{$termJSON}' data-role="resultsArea" class='ipsResponsive_pull'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", \IPS\Request::i()->app )->resultStream( $results, $pagination, $baseUrl, NULL, $count );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function search( $termArray, $title, $results, $pagination, $baseUrl, $types, $filters, $count=NULL, $advanced=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.front.search.main' data-baseURL='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
	<div class='ipsResponsive_hidePhone ipsPageHeader'>
		<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_the_community', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<p class='ipsType_reset ipsType_large 
CONTENT;

if ( $advanced ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='searchBlurb'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
	</div>
	
	
CONTENT;

if ( \IPS\Content\Search\Query::isRebuildRunning() ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_info">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_rebuild_is_running', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsBox ipsPadding ipsResponsive_pull ipsMargin_top' data-controller='core.front.search.filters' id='elSearchFilters'>
		{$filters}
	</div>

	<div id="elSearch_main" class='ipsSpacer_top' data-role='filterContent'>
		
CONTENT;

if ( !$advanced ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", \IPS\Request::i()->app )->results( $termArray, $title, $results, $pagination, $baseUrl, $count );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

		return $return;
}

	function searchReaction( $reactions, $itemUrl, $repCount ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \IPS\Settings::i()->reaction_count_display == 'count' ):
$return .= <<<CONTENT

	<div class='ipsReact_reactCountOnly ipsReact_reactCountOnly_mini 
CONTENT;

if ( $repCount >= 1 ):
$return .= <<<CONTENT
ipsAreaBackground_positive
CONTENT;

elseif ( $repCount < 0 ):
$return .= <<<CONTENT
ipsAreaBackground_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsAreaBackground_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_blendLinks 
CONTENT;

if ( !\count( $reactions ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reactCount'>
		
CONTENT;
$return .= htmlspecialchars( $repCount, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsReactOverview ipsReactOverview_small ipsType_light'>
		<ul>
			<li class='ipsReactOverview_repCount'>
				
CONTENT;
$return .= htmlspecialchars( $repCount, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
			
CONTENT;

foreach ( $reactions AS $reactID => $count ):
$return .= <<<CONTENT

				
CONTENT;

$reaction = \IPS\Content\Reaction::load( $reactID );
$return .= <<<CONTENT

				<li>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl->setQueryString( 'reaction', $reaction->id ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( 'reaction_title_' . $reaction->id )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted_x', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'escape' => TRUE ) );
$return .= <<<CONTENT
">
					
CONTENT;

else:
$return .= <<<CONTENT

						<span data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
">
					
CONTENT;

endif;
$return .= <<<CONTENT

							<img src='
CONTENT;

$return .= \IPS\File::get( "core_Reaction", $reaction->_icon )->url;
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
">
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

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
}}