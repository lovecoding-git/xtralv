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

class cp_skin_classifieds extends output {

    /**
     * Prevent our main destructor being called by this class
     *
     * @access	public
     * @return	void
     */
    public function __destruct() {
    }


    /**
     * Classifieds overview
     */
    public function classifiedsOverview( $upgrades ) {

        $IPBHTML = "";
//--starthtml--//

        $IPBHTML .= <<<HTML
<script type='text/javascript' id='progressbarScript' src='{$this->settings['public_dir']}js/3rd_party/progressbar/progressbar.js'></script>
<script type='text/javascript' src='{$this->settings['js_app_url']}acp.classifieds.js'></script>
<script type="text/javascript">
ACPClassifieds.section = 'overview';
</script>
<link rel='stylesheet' type='text/css' media='screen' href='{$this->settings['skin_app_url']}/classifieds.css' />
<div class='section_title'>
<h2>{$this->lang->words['cfds_overview']}</h2>
</div>
<div class='ipsActionBar clearfix'>
		<ul>

			<li class='ipsActionButton'>
				<a href='#' class='ipbmenu' id='cfdsTools'><img src='{$this->settings['skin_acp_url']}/images/icons/cog.png' /> {$this->lang->words['cfds_tools_button']} <img src='{$this->settings['skin_acp_url']}/images/useropts_arrow.png' /></a>
				<ul class='ipbmenu_content' id='cfdsTools_menucontent' style='display: none'>
					<li><img src='{$this->settings['skin_acp_url']}/images/icons/cog.png' alt='' /> <a href='#' category-id="all" progress="rebuildnodes">{$this->lang->words['cfds_cats_tool_nodes']}</a></li>
					<li><img src='{$this->settings['skin_acp_url']}/images/icons/cog.png' alt='' /> <a href='#' advert-id="all" progress="rebuildimages">{$this->lang->words['cfds_tool_rebuild_images']}</a></li>
				</ul>
			</li>
		</ul>
	</div>
<div class='acp-box'>
<h3>{$this->lang->words['cfds_upgrade_history']}</h3>
<table class='ipsTable'>
HTML;
 if ($upgrades) {
        foreach( $upgrades as $r ) {
            $IPBHTML .= <<<HTML
					<tr>
						<td width='40%'>{$r['upgrade_version_human']} ( {$r['upgrade_version_id']} )</td>
						<td width='60%'>{$r['upgrade_date']}</td>
					</tr>
HTML;
        }
    }
        $IPBHTML .= <<<HTML
				</table>
			</div>
HTML;
//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Categories
     *
     * @access	public
     * @param	string	Categories HTML
     * @return	string	HTML
     */
    function manageCategory( $categories ) {

        $IPBHTML = "";
//--starthtml--//

        $IPBHTML .= <<<HTML
<script type='text/javascript' id='progressbarScript' src='{$this->settings['public_dir']}js/3rd_party/progressbar/progressbar.js'></script>
<script type='text/javascript' src='{$this->settings['js_app_url']}acp.classifieds.js'></script>
<script type="text/javascript">
ACPClassifieds.section = 'managecats';
</script>
<link rel='stylesheet' type='text/css' media='screen' href='{$this->settings['skin_app_url']}/classifieds.css' />       
<div class='section_title'>
  <h2>{$this->lang->words['cfds_category_management']}</h2>
  <div class='ipsActionBar clearfix'> 
  <ul>
    <li class='ipsActionButton'><a href='{$this->settings['base_url']}&amp;{$this->form_code}do=addcat&amp;parent={$this->request['parent']}'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' /> {$this->lang->words['cfds_add_cat']}</a></li>
  	<li class='ipsActionButton'>
		<a href='#' class='ipbmenu' id='cfdsTools'><img src='{$this->settings['skin_acp_url']}/images/icons/cog.png' /> {$this->lang->words['cfds_tools_button']} <img src='{$this->settings['skin_acp_url']}/images/useropts_arrow.png' /></a>
		<ul class='ipbmenu_content' id='cfdsTools_menucontent' style='display: none'>
			<li><img src='{$this->settings['skin_acp_url']}/images/icons/cog.png' alt='' /> <a href='#' category-id="all" progress="rebuildnodes">{$this->lang->words['cfds_cats_tool_nodes']}</a></li>
		</ul>
	</li>
 </ul>
  </div>
</div>

<div class="acp-box">
<h3>{$this->lang->words['cfds_category_management']}</h3>
<table class='ipsTable' id='classifieds_categories'>
  <tr>
    <th class='col_drag'>&nbsp;</th>
    <th>Name</th>
    <th class='col_buttons'>&nbsp;</th>
  </tr>

HTML;

        if( !empty($categories) ) {


            foreach( $categories as $row ) {
                $IPBHTML .= <<<HTML

    <tr class='ipsControlRow isDraggable' id='category_{$row['category_id']}'>
      <td class='col_drag'><span class='draghandle'>&nbsp;</span></td>
      <td><strong><a href='{$this->settings['base_url']}&amp;{$this->form_code}parent={$row['category_id']}'>{$row['name']}</a></strong>
        <div class='desctext'>{$row['description']}</div></td>
      <td>
      <ul class='ipsControlStrip'>
      <li class='i_edit'><a href='{$this->settings['base_url']}{$this->form_code}do=editcat&amp;id={$row['category_id']}'>{$this->lang->words['cfds_edit_cat']}</a></li>
      <li class='i_delete'><a href='{$this->settings['base_url']}{$this->form_code}do=deletecat&amp;cat={$row['category_id']}' onclick='return acp.confirmDelete("{$this->settings['base_url']}{$this->form_code}do=deletecat&amp;cat={$row['category_id']}");'>{$this->lang->words['cfds_delete_cat']}</a></li>
      <li class='ipsControlStrip_more ipbmenu' id='menu_{$row['category_id']}'><a href='#'>More</a></li>
      </ul>
        <ul class='acp-menu' id='menu_{$row['category_id']}_menucontent' style='display: none'>
          <li class='icon add'><a href='{$this->settings['base_url']}{$this->form_code}do=addcat&amp;parent={$row['category_id']}'>{$this->lang->words['cfds_add_subcat']}</a></li>
          <li class='icon edit'><a href='{$this->settings['base_url']}{$this->form_code}do=editcat&amp;id={$row['category_id']}'>{$this->lang->words['cfds_edit_cat']}</a></li>
          <li class='icon delete'><a href='#' onclick='ACPClassifieds.confirmEmpty({$row['category_id']})'>{$this->lang->words['cfds_empty_cat']}</a></li>
          <li class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code}do=deletecat&amp;cat={$row['category_id']}' onclick='return acp.confirmDelete("{$this->settings['base_url']}{$this->form_code}do=deletecat&amp;cat={$row['category_id']}");'>{$this->lang->words['cfds_delete_cat']}</a></li>
        </ul></td>
    </tr>

HTML;
            }

          
        } else {
            $IPBHTML .= <<<HTML

            <tr>
            <td colspan='3' class='no_messages'>{$this->lang->words['cfds_no_subcats']}</td>
            </tr>
HTML;
        }
        $IPBHTML .= <<<HTML
        </table>
</div>
HTML;
//--endhtml--//

if ( $categories )
{
	$IPBHTML .= <<<EOF
<script type='text/javascript'>
	jQ("#classifieds_categories").ipsSortable('table', { 
		url: "{$this->settings['base_url']}{$this->form_code_js}&do=reorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' ),
		serializeOptions: { key: 'categories[]' }
	} );
</script>
EOF;
}

        return $IPBHTML;
    }

    /**
     * Add/edit category form
     *
     * @access	public
     * @param	array 	Category
     * @param	array 	Form elements
     * @param	string	Action type
     * @return	string	HTML
     */
    public function categoryForm( $cat, $form, $type ) {
        $IPBHTML = "";
//--starthtml--//

        if( $type == 'edit' ) {
            $title	= sprintf( $this->lang->words['cfds_edit_cat_title'], $cat['name'] );
        }
        else {
            $title	= $this->lang->words['cfds_add_cat_title'];
        }

        $IPBHTML .= <<<EOF
<div class='section_title'>
  <h2>{$title}</h2>
</div>


<form id='adminform' action='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do={$form['formcode']}' method='post'>
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <input type='hidden' name='id' value='{$cat['category_id']}' />
<div class='acp-box'>
	<h3>{$title}</h3>
	
	<div id='tabstrip_categoryForm' class='ipsTabBar with_left with_right'>
		<span class='tab_left'>&laquo;</span>
		<span class='tab_right'>&raquo;</span>
		<ul>
			<li id='tab_Basic'>Basic</li>
		</ul>
	</div>
	
	<div id='tabstrip_categoryForm_content' class='ipsTabBar_content'>
		
		<!-- BASIC -->
		<div id='tab_Basic_content'>
			<table class='ipsTable double_pad'>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_cats_form_name']}</strong>
					</td>
					<td class='field_field'>
						{$form['name']}
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_cats_form_parent']}</strong>
					</td>
					<td class='field_field'>
						{$form['parent']}
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_cats_form_description']}</strong>
					</td>
					<td class='field_field'>
						{$form['description']}
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_cats_form_fieldset']}</strong>
					</td>
					<td class='field_field'>
						{$form['fieldset_id']}
					</td>
				</tr>	
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_advert_types']}</strong>
					</td>
					<td class='field_field'>
						{$form['advert_types']}<br />
					<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_cat_type_desc']}</span>
					</td>
				</tr>								
	 		</table>
		</div>
		
		
		<script type='text/javascript'>
			jQ("#tabstrip_categoryForm").ipsTabBar({ tabWrap: "#tabstrip_categoryForm_content", defaultTab: "tab_Basic" });
		</script>
	</div>
		
	<div class='acp-actionbar'>
		<input type='submit' value='{$form['button']}' class='button primary' />
	</div>
</div>
</form>
EOF;

//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Delete category form
     *
     * @access	public
     * @param	array 	Category
     * @param	string	Move to cat dropdown
     * @return	string	HTML
     */
    public function categoryDeleteForm( $cat, $move_cat ) {
        $IPBHTML = "";
//--starthtml--//

        $title	= sprintf( $this->lang->words['cfds_delete_cat_title'], $cat['name'] );

        $IPBHTML .= <<<HTML
<div class='acp-box'>
<div class='section_title'>
  <h3>{$title}</h3>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm' id='theAdminForm'>
  <input type='hidden' name='do' value='dodeletecat' />
  <input type='hidden' name='cat' value='{$cat['category_id']}' />
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <table class='ipsTable double_pad'>
	<tr>
	<td class='field_title'>
        <strong>{$this->lang->words['cfds_move_cat_q']}</strong>
    </td>
    <td class='field_field'>
       {$move_cat}
    </td>
    </tr>
  </table>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' value='{$this->lang->words['cfds_delete_cat']}' class='button primary' accesskey='s'>
      </div>
    </div>
</form>
</div>
HTML;

//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Packages
     *
     * @access	public
     * @param	string	Packages HTML
     * @return	string	HTML
     */
    function managePackages( $packages ) {

        $IPBHTML = "";
//--starthtml--//

        $IPBHTML .= <<<HTML
<div class='section_title'>
  <h2>{$this->lang->words['cfds_package_management']}</h2>
  <div class='ipsActionBar clearfix'> 
  <ul>
    <li class='ipsActionButton'><a href='{$this->settings['base_url']}&amp;{$this->form_code}do=addpackage'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' /> {$this->lang->words['cfds_add_package']}</a></li>
  </ul>
  </div>
</div>
<div class='information-box'>
	<p>{$this->lang->words['cfds_info_manage_packages']}</p>
</div>
<br />
<div class="acp-box">
<h3>{$this->lang->words['cfds_package_management']}</h3>
<table class='ipsTable' id='classifieds_packages'>
  <tr>
    <th class='col_drag'>&nbsp;</th>
    <th>Name</th>
    <th class='col_buttons'>&nbsp;</th>
  </tr>
HTML;

        if( !empty($packages) ) {
            $IPBHTML .= <<<HTML
<ul id='sortable_handle' class='alternate_rows'>
HTML;

            foreach( $packages as $row ) {
                $IPBHTML .= <<<HTML
    <tr class='ipsControlRow isDraggable' id='package_{$row['package_id']}'>
      <td class='col_drag'><span class='draghandle'>&nbsp;</span></td>
      <td><strong>{$row['name']}</strong>
        <div class='desctext'>{$row['description']}</div></td>

      <td class='col_buttons'>
        <ul class='ipsControlStrip'>
          <li class='i_edit'><a href='{$this->settings['base_url']}{$this->form_code}do=editpackage&amp;id={$row['package_id']}'>{$this->lang->words['cfds_edit_package']}</a></li>
          <li class='i_delete'><a href='{$this->settings['base_url']}{$this->form_code}do=deletepackage&amp;package={$row['package_id']}' onclick='return acp.confirmDelete("{$this->settings['base_url']}{$this->form_code}do=deletepackage&amp;package={$row['package_id']}");'>{$this->lang->words['cfds_delete_package']}</a></li>
        </ul></td>
    </tr>
HTML;
            }

            $IPBHTML .= <<<HTML
</ul>
HTML;
        } else {
            $IPBHTML .= <<<HTML
            <tr>
            <td colspan='3' class='no_messages'>{$this->lang->words['cfds_no_packages']}</td>
            </tr>
HTML;
        }
        $IPBHTML .= <<<HTML
  </table>
        </div>
HTML;
//--endhtml--//

    if ( $packages )
{
	$IPBHTML .= <<<EOF
<script type='text/javascript'>
	jQ("#classifieds_packages").ipsSortable('table', { 
		url: "{$this->settings['base_url']}{$this->form_code_js}&do=reorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' ),
		serializeOptions: { key: 'packages[]' }
	} );
</script>
EOF;
}        
        
        return $IPBHTML;
    }

    /**
     * Add/edit package form
     *
     * @access	public
     * @param	array 	Package
     * @param	array 	Form elements
     * @param	string	Action type
     * @return	string	HTML
     */
    public function packageForm( $package, $form, $type, $rates ) {
        $IPBHTML = "";
//--starthtml--//

        if( $type == 'edit' ) {
            $title	= sprintf( $this->lang->words['cfds_edit_package_title'], $package['name'] );
        }
        else {
            $title	= $this->lang->words['cfds_add_package_title'];
        }

        $IPBHTML .= <<<HTML
<script type="text/javascript">
function change()
{
   switch (document.getElementById("pricing_format").value)
   {
      case "flat":
          document.getElementById('value_row').style.display = 'none';
          document.getElementById('flat_row').style.display = 'table-row';
      break;
      case "value":
          document.getElementById('value_row').style.display = 'table-row';
          document.getElementById('flat_row').style.display = 'none';
      break;
   }
}
</script>        
<div class='section_title'>
  <h2>{$title}</h2>
</div>

<form action='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do={$form['formcode']}' id='mainform' method='post'>
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <input type='hidden' name='id' value='{$package['package_id']}' />
  
  <div class='acp-box'>
	<h3>{$title}</h3>
  <div id='tabstrip_packageForm' class='ipsTabBar with_left with_right'>
		<span class='tab_left'>&laquo;</span>
		<span class='tab_right'>&raquo;</span>
		<ul>
			<li id='tab_Basic'>{$this->lang->words['cfds_basic']}</li>
			<li id='tab_Options'>{$this->lang->words['cfds_options']}</li>
HTML;

        if (IPSLib::appIsInstalled('nexus')) {

        	$IPBHTML .= <<<HTML
			<li id='tab_Pricing'>{$this->lang->words['cfds_pricing']}</li>
HTML;
        }
        $IPBHTML .= <<<HTML
		</ul>
	</div>

<div id='tabstrip_packageForm_content' class='ipsTabBar_content'>

<!-- BASIC -->
		<div id='tab_Basic_content'>
			<table class='ipsTable double_pad'>
			<tr>
				<th colspan='2'>{$this->lang->words['cfds_basic']}</th>
			</tr>                
			<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_name']}</strong>
					</td>
					<td class='field_field'>
						{$form['name']}
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_description']}</strong>
					</td>
					<td class='field_field'>
						{$form['description']}
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_duration']}</strong>
					</td>
					<td class='field_field'>
						{$form['duration']}<br />
						<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_package_duration_desc']}</span>
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_max_renewals']}</strong>
					</td>
					<td class='field_field'>
						{$form['max_renewals']}<br />
						<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_package_renewals_desc']}</span>
					</td>
				</tr>				
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_active']}</strong>
					</td>
					<td class='field_field'>
						{$form['active']}
					</td>
				</tr>				
			<tr>
				<th colspan='2'>{$this->lang->words['cfds_permissions']}</th>
			</tr>  	
			<tr>
				<td class='field_title'><strong class='title'>{$this->registry->getClass('class_localization')->words['cfds_package_group']}</strong></td>
				<td class='field_field'>
					{$form['member_groups']}<br />
					<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_package_group_desc']}</span>
				</td>
			</tr>						
	 		</table>
		</div>

  
  		<!-- OPTIONS -->
		<div id='tab_Options_content'>
		<table class='ipsTable double_pad'>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_feature']}</strong>
					</td>
					<td class='field_field'>
						{$form['feature']}<br />
						<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_package_feature_desc']}</span>
					</td>
				</tr>			

		</table>			
		</div>
		
HTML;
        if (IPSLib::appIsInstalled('nexus')) {

        	$IPBHTML .= <<<HTML
  		<!-- PRICING -->
		<div id='tab_Pricing_content'>
		<table class='ipsTable double_pad'>
				<tr>
					<td class='field_title'>
						<strong class='title'>Pricing Format</strong>
					</td>
					<td class='field_field'>
						{$form['pricing_format']}<br />
						<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_package_price_format_desc']}</span>
					</td>
				</tr>		
				<tr id='flat_row'>
				<td class='field_title'><strong class='title'>Rates</strong>
				<td class='field_field'>
					<table>
					<tr>
						<th class='subhead'>{$this->lang->words['cfds_packages_form_price']}</th>
						<th class='subhead'>{$this->lang->words['cfds_packages_form_renewal_price']}</th>
					</tr>
					<tr>
					<td>
						{$form['price']}
					</td>

					<td>
						{$form['renewal_price']}
					</td>
					
					</tr>
				</table>
				</td>
				</tr>
				<tr id='value_row'>
				<td class='field_title'><strong class='title'>Rates</strong>			
				<td class='field_field'>
					<table id="rates">
					<tr>
						<th class='subhead'>Value</th>
						<th class='subhead'>{$this->lang->words['cfds_packages_form_price']}</th>
						<th class='subhead'>{$this->lang->words['cfds_packages_form_renewal_price']}</th>
					</tr>
				</table>
				</td>
				</tr>				
				
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['cfds_packages_form_tax_class']}</strong>
					</td>
					<td class='field_field'>
						{$form['tax_class']}<br />
						<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_package_tax_desc']}</span>
					</td>
				</tr>
		</table>				
</div>	

<script type='text/javascript'>
	var rates = -1;
	
	function rateChange( id )
	{
		if( id == rates && $( 'rate-to-' + id ).value )
		{
			rates++;
			addRate( rates, '', '', '' );
		}
	}
	
	function addRate( id, value, base, renewal )
	{
		var row = $('rates').insertRow( $('rates').rows.length );
		
		var cell_to = row.insertCell(0);
		cell_to.innerHTML = "<input name='rate-to-"+ id +"' id='rate-to-"+ id +"' value='"+ value +"' onchange='rateChange("+ id +")' />";
		
		var cell_base = row.insertCell(1);
		cell_base.innerHTML = "<input name='rate-base-"+ id +"' value='"+ base +"' />";
		
		var cell_renewal = row.insertCell(2);
		cell_renewal.innerHTML = "<input name='rate-renewal-"+ id +"' value='"+ renewal +"' />";		
	}
	

	

	
HTML;

	foreach ( $rates as $id => $data )
	{
		$IPBHTML .= <<<HTML
		addRate( {$id}, '{$data['value']}', '{$data['base']}', '{$data['renewal']}' );
		rates++; 
HTML;
	}

$IPBHTML .= <<<HTML
	
</script>

HTML;

        }
$IPBHTML .= <<<HTML

			
<script type="text/javascript">
change();
</script>
		
		<script type='text/javascript'>
			jQ("#tabstrip_packageForm").ipsTabBar({ tabWrap: "#tabstrip_packageForm_content", defaultTab: "tab_Basic" });
		</script>
	</div>
  
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' name='submit' value='{$form['button']}' class='button primary' />
      </div>
    </div>  
</form>
HTML;

//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Delete package form
     *
     * @access	public
     * @param	array 	Package
     * @return	string	HTML
     */
    public function packageDeleteForm( $package ) {
        $IPBHTML = "";
//--starthtml--//

        $title	= sprintf( $this->lang->words['cfds_delete_package_title'], $package['name'] );

        $IPBHTML .= <<<HTML
<div class='section_title'>
  <h2>{$title}</h2>
</div>
<form action='{$this->settings['base_url']}{$this->
                form_code}' method='post' name='theAdminForm' id='theAdminForm'>
  <input type='hidden' name='do' value='dodeletepackage' />
  <input type='hidden' name='package' value='{$package['package_id']}' />
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <div class='acp-box'>
    <h3>{$title}</h3>
    <p>{$this->lang->words['cfds_delete_package_q']}</p>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' value='{$this->lang->words['cfds_delete_package']}' class='button primary' accesskey='s'>
      </div>
    </div>
  </div>
</form>
HTML;

//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Types
     *
     * @access	public
     * @param	string	Types HTML
     * @return	string	HTML
     */
    function manageType( $types ) {

        $IPBHTML = "";
//--starthtml--//

        $IPBHTML .= <<<HTML
<div class='section_title'>
  <h2>{$this->lang->words['cfds_type_management']}</h2>
  <div class='ipsActionBar clearfix'> 
  <ul>
    <li class='ipsActionButton'><a href='{$this->settings['base_url']}&amp;{$this->form_code}do=addtype'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' /> {$this->lang->words['cfds_add_type']}</a></li>
  </ul>
  </div>
</div>
<div class="acp-box">
<h3>{$this->lang->words['cfds_type_management']}</h3>
  <table class='ipsTable' id='classifieds_types'>
  <tr>
    <th class='col_drag'>&nbsp;</th>
    <th>Type</th>
    <th class='col_buttons'>&nbsp;</th>
  </tr>
HTML;

        if( !empty($types) ) {
       

            foreach( $types as $row ) {
                $IPBHTML .= <<<HTML

    <tr class='ipsControlRow isDraggable' id='type_{$row['type_id']}'>
      <td class='col_drag'><span class='draghandle'>&nbsp;</span></td>
      <td><strong>{$row['name']}</strong></td>
      <td class='col_buttons'>
      <ul class='ipsControlStrip'>
      <li class='i_edit'><a href='{$this->settings['base_url']}{$this->form_code}do=edittype&amp;id={$row['type_id']}'>{$this->lang->words['cfds_edit_type']}</a></li>
      <li class='i_delete'><a href='{$this->settings['base_url']}{$this->form_code}do=deletetype&amp;type={$row['type_id']}' onclick='return acp.confirmDelete("{$this->settings['base_url']}{$this->form_code}do=deletetype&amp;type={$row['type_id']}");'>{$this->lang->words['cfds_delete_type']}</a></li>
      </ul>  
</td>
    </tr>


HTML;
            }

          
        } else {
            $IPBHTML .= <<<HTML
            <tr>
            <td colspan='3' class='no_messages'>{$this->lang->words['cfds_no_types']}</td>
            </tr>
HTML;
        }
        $IPBHTML .= <<<HTML
        </table>
</div>
HTML;
//--endhtml--//

if ( $types )
{
	$IPBHTML .= <<<EOF
<script type='text/javascript'>
	jQ("#classifieds_types").ipsSortable('table', { 
		url: "{$this->settings['base_url']}{$this->form_code_js}&do=reorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' ),
		serializeOptions: { key: 'types[]' }
	} );
</script>
EOF;
}
        
        return $IPBHTML;
    }

    /**
     * Add/edit type form
     *
     * @access	public
     * @param	array 	Type
     * @param	array 	Form elements
     * @param	string	Action type
     * @return	string	HTML
     */
    public function typeForm( $type, $form, $type ) {
        $IPBHTML = "";
//--starthtml--//

        if( $type == 'edit' ) {
            $title	= sprintf( $this->lang->words['cfds_edit_type_title'], $type['name'] );
        }
        else {
            $title	= $this->lang->words['cfds_add_type_title'];
        }

        $IPBHTML .= <<<HTML
<div class='acp-box'>        
<div class='section_title'>
  <h3>{$title}</h3>
</div>
<form action='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do={$form['formcode']}' id='mainform' method='post'>
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <input type='hidden' name='id' value='{$type['type_id']}' />
    <table class='ipsTable double_pad'>
	<tr>
	  <td class='field_title'>
        <strong>{$this->lang->words['cfds_types_form_name']}</strong>
      </td>
      <td class='field_field'>
                {$form['name']}
      </td>
    </tr> 
    <tr>
	  <td class='field_title'>
        <strong>{$this->lang->words['cfds_types_show_badge']}</strong>
      </td>
      <td class='field_field'>
                {$form['show_badge']}<br />
				<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_type_badge_desc']}</span>
      </td>
    </tr>
    <tr>
	  <td class='field_title'>
        <strong>{$this->lang->words['cfds_types_badge_color']}</strong>
      </td>
      <td class='field_field'>
                {$form['badge_color']}
      </td>
    </tr>    
    <tr>
	  <td class='field_title'>
        <strong>{$this->lang->words['cfds_types_zero_text']}</strong>
      </td>
      <td class='field_field'>
                {$form['zero_text']}<br />
				<span class='desctext'>{$this->registry->getClass('class_localization')->words['cfds_type_zero_text_desc']}</span>
      </td>
    </tr>       
  </table>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' name='submit' value='{$form['button']}' class='button primary' />
      </div>
    </div>  
</form>
</div>
HTML;

//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Delete type form
     *
     * @access	public
     * @param	array 	Type
     * @param   string  Change to new type dropdown
     * @return	string	HTML
     */
    public function typeDeleteForm( $type, $change_type ) {
        $IPBHTML = "";
//--starthtml--//

        $title	= sprintf( $this->lang->words['cfds_delete_type_title'], $type['name'] );

        $IPBHTML .= <<<HTML
<div class='acp-box'>        
<div class='section_title'>
  <h3>{$title}</h3>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm' id='theAdminForm'>
  <input type='hidden' name='do' value='dodeletetype' />
  <input type='hidden' name='type' value='{$type['type_id']}' />
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <table class='ipsTable double_pad'>
	<tr>
	<td class='field_title'>
        <strong>{$this->lang->words['cfds_change_type_q']}</strong>
    </td>
    <td class='field_field'>
                {$change_type}
    </td>
    </tr>
  </table>                 
  <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' value='{$this->lang->words['cfds_delete_type']}' class='button primary' accesskey='s'>
      </div>
    </div>
</form>
</div>
HTML;

//--endhtml--//
        return $IPBHTML;
    }

    

}