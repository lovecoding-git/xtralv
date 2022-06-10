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

class cp_skin_fields extends output {

    /**
     * Prevent our main destructor being called by this class
     *
     * @access	public
     * @return	void
     */
    public function __destruct() {
    }

    
   /**
     * Packages
     *
     * @access	public
     * @param	string	Packages HTML
     * @return	string	HTML
     */
    function manageSets( $globalfields, $sets ) {

        $IPBHTML = "";
//--starthtml--//

        $IPBHTML .= <<<HTML
<div class='section_title'>
  <h2>{$this->lang->words['cfds_fieldset_management']}</h2>
  <div class='ipsActionBar clearfix'> 
  <ul>
    <li class='ipsActionButton'><a href='{$this->settings['base_url']}&amp;{$this->form_code}do=addfield&amp;global=1'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' /> {$this->lang->words['cfds_add_globalfield']}</a></li>
    <li class='ipsActionButton'><a href='{$this->settings['base_url']}&amp;{$this->form_code}do=addset'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' /> {$this->lang->words['cfds_add_fieldset']}</a></li>
  </ul>
  </div>
</div>
<div class='information-box'>
	<p>{$this->lang->words['cfds_info_fields']}</p>
</div>
<br />
<div class="acp-box">
<h3>{$this->lang->words['cfds_globalfield_management']}</h3>

		<table class='ipsTable' id='classifieds_globalfields'>
			<tr>
				<th class='col_drag'>&nbsp;</th>
				<th width='32%'>{$this->lang->words['cfds_field_title']}</th>
				<th style='text-align:center;' width='20%'>{$this->lang->words['cfds_field_type']}</th>
				<th style='text-align:center;' width='18%'>{$this->lang->words['cfds_field_required_q']}</th>
				<th style='text-align:center;' width='18%'>{$this->lang->words['cfds_field_active_q']}</th>
				<th class='col_buttons'>&nbsp;</th>
			</tr>

HTML;

        if( !empty($globalfields) ) {
            $IPBHTML .= <<<HTML
<ul id='sortable_handle' class='alternate_rows'>
HTML;

            foreach( $globalfields as $field ) {
                $IPBHTML .= <<<HTML
<tr class='ipsControlRow isDraggable' id='field_{$field['field_id']}'>
						<td width='4%' class='subhead col_drag'><span class='draghandle'>&nbsp;</span></td>
						<td width='32%' class='subhead'><span class='larger_text'><a style='margin-left: 25px' href='{$this->settings['base_url']}{$this->form_code}do=editfield&amp;id={$field['field_id']}'>{$field['title']}</a></span></td>
						<td width='20%' style='text-align:center;'>{$field['type']}</td>
						<td width='18%' style='text-align:center;'>
HTML;

                        if( $field['required'] == 1 ) {
                            $IPBHTML .= <<<HTML
                               <img src='{$this->settings['skin_acp_url']}/images/icons/tick.png' />
HTML;
                        }
                        else {

                            $IPBHTML .= <<<HTML
                              <img src='{$this->settings['skin_acp_url']}/images/icons/cross.png' />
HTML;
                        }

$IPBHTML .= <<<HTML
						</td>
						<td width='18%' style='text-align:center;'>
HTML;

                        if( $field['active'] == 1 ) {
                            $IPBHTML .= <<<HTML
                               <img src='{$this->settings['skin_acp_url']}/images/icons/tick.png' />
HTML;
                        }
                        else {

                            $IPBHTML .= <<<HTML
                              <img src='{$this->settings['skin_acp_url']}/images/icons/cross.png' />
HTML;
                        }

$IPBHTML .= <<<HTML
</td>
						<td width='8%' class='col_buttons'>

						<ul class='ipsControlStrip'>
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code}do=editfield&amp;id={$field['field_id']}&amp;global=1">{$this->lang->words['cfds_field_edit']}</a></li>
							<li class='i_delete'><a href="{$this->settings['base_url']}{$this->form_code}do=deletefield&amp;id={$field['field_id']}">{$this->lang->words['cfds_field_delete']}</a></li>
						</ul>
						</td>
					</tr>
HTML;
            }

            $IPBHTML .= <<<HTML
</ul>
HTML;
        } else {
            $IPBHTML .= <<<HTML
            <tr>
            <td colspan='3' class='no_messages'>{$this->lang->words['cfds_no_globalfields']}</td>
            </tr>
HTML;
        }
        $IPBHTML .= <<<HTML
  </table>
<br />
<h3>{$this->lang->words['cfds_fieldset_management']}</h3>
<table class='ipsTable' id='classifieds_fieldsets'>
  <tr>
    <th class='col_drag'>&nbsp;</th>
    <th>Name</th>
    <th class='col_buttons'>&nbsp;</th>
  </tr>
HTML;

        if( !empty($sets) ) {
            $IPBHTML .= <<<HTML
<ul id='sortable_handle' class='alternate_rows'>
HTML;

            foreach( $sets as $row ) {
                $IPBHTML .= <<<HTML
    <tr class='ipsControlRow isDraggable' id='set_{$row['set_id']}'>
      <td class='col_drag'><span class='draghandle'>&nbsp;</span></td>
      <td><strong><a href='{$this->settings['base_url']}{$this->form_code}do=managefields&amp;set={$row['set_id']}'>{$row['name']}</a></strong>
       </td>

      <td class='col_buttons'>
        <ul class='ipsControlStrip'>
          <li class='i_edit'><a href='{$this->settings['base_url']}{$this->form_code}do=editset&amp;id={$row['set_id']}'>{$this->lang->words['cfds_edit_fieldset']}</a></li>
          <li class='i_delete'><a href='{$this->settings['base_url']}{$this->form_code}do=deleteset&amp;id={$row['set_id']}' onclick='return acp.confirmDelete("{$this->settings['base_url']}{$this->form_code}do=deleteset&amp;id={$row['set_id']}");'>{$this->lang->words['cfds_delete_fieldset']}</a></li>
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
            <td colspan='3' class='no_messages'>{$this->lang->words['cfds_no_fieldsets']}</td>
            </tr>
HTML;
        }
        $IPBHTML .= <<<HTML
  </table>
        </div>
HTML;
//--endhtml--//

    if ( $sets )
{
	$IPBHTML .= <<<EOF
<script type='text/javascript'>
	jQ("#classifieds_fieldsets").ipsSortable('table', { 
		url: "{$this->settings['base_url']}{$this->form_code_js}&do=reorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' ),
		serializeOptions: { key: 'sets[]' }
	} );
</script>
<script type='text/javascript'>
	jQ("#classifieds_globalfields").ipsSortable('table', { 
		url: "{$this->settings['base_url']}{$this->form_code_js}&do=reorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' ),
		serializeOptions: { key: 'fields[]' }
	} );
</script>
EOF;
}        
        
        return $IPBHTML;
    }    
    

    
   /**
     * Add/edit field form
     *
     * @access	public
     * @param	array 	Field
     * @param	array 	Form elements
     * @param	string	Action type
     * @return	string	HTML
     */
    public function setForm( $set, $form, $type ) {
        $IPBHTML = "";
//--starthtml--//

        if( $type == 'edit' ) {
            $title	= sprintf($this->lang->words['cfds_editing_set'], $field['title']);
        }
        else {
            $title	= $this->lang->words['cfds_adding_set'];
        }

        $IPBHTML .= <<<HTML


<div class='section_title'>
  <h2>{$title}</h2>
</div>
<div class='information-box'>
	<p>{$this->lang->words['cfds_info_add_field_set']}</p>
</div>
<br />
<form action='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do={$form['formcode']}' id='mainform' method='post'>
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <input type='hidden' name='set_id' value='{$set['set_id']}' />

  <div class='acp-box'>
    <h3>{$title}</h3>
	<table class='ipsTable double_pad'>
  <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_set_name']}</strong></td>
        <td class='field_field'>{$form['name']} </td>
      </tr>
</table>


     
<script type="text/javascript">
change();
</script>

    </ul>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' name='submit' value='{$form['button']}' class='button primary' />
      </div>
    </div>
  </div>
</form>
HTML;

//--endhtml--//
        return $IPBHTML;
    }
    
    
    
    /**
     * Delete field set form
     *
     * @access	public
     * @param	array 	Field
     * @return	string	HTML
     */
    public function setDeleteForm( $set ) {
        $IPBHTML = "";
//--starthtml--//

        $title	= sprintf( $this->lang->words['cfds_delete_fieldset_title'], $set['name'] );

        $IPBHTML .= <<<HTML
<div class='section_title'>
  <h2>{$title}</h2>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm' id='theAdminForm'>
  <input type='hidden' name='do' value='dodeleteset' />
  <input type='hidden' name='set_id' value='{$set['set_id']}' />
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <div class='acp-box'>
    <h3>{$title}</h3>
    <p>{$this->lang->words['cfds_delete_fieldset_q']}</p>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' value='{$this->lang->words['cfds_fieldset_delete']}' class='button primary' accesskey='s'>
      </div>
    </div>
  </div>
</form>
HTML;

//--endhtml--//
        return $IPBHTML;
    }    

    
//===========================================================================
// Manage Fields
//===========================================================================
function manageFields( $fields, $set ) {

$menuKey = 0;



$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['cfds_manage_fields']}</h2>
	<ul class='context_menu'>
        <li><a href='{$this->settings['base_url']}{$this->form_code}do=addfieldgroup&amp;set={$set['set_id']}'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' /> {$this->lang->words['cfds_add_group']}</a></li>
HTML;

if(!empty($fields)) {
	
$IPBHTML .= <<<HTML
		<li><a href='{$this->settings['base_url']}{$this->form_code}do=addfield&amp;set={$set['set_id']}'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' /> {$this->lang->words['cfds_add_field']}</a></li>
HTML;
	
}

$IPBHTML .= <<<HTML
	</ul>
</div>

<div class='acp-box ipsTreeTable'>
 	<h3>Fields in {$set['name']}</h3>
	<div>
		<table class='ipsTable'>
			<tr>
				<th width='4%'>&nbsp;</th>
				<th width='32%'>{$this->lang->words['cfds_field_title']}</th>
				<th style='text-align:center;' width='20%'>{$this->lang->words['cfds_field_type']}</th>
				<th style='text-align:center;' width='18%'>{$this->lang->words['cfds_field_required_q']}</th>
				<th style='text-align:center;' width='18%'>{$this->lang->words['cfds_field_active_q']}</th>
				<th width='8%'>&nbsp;</th>
			</tr>
		</table>
		<div class='sortable_handle' id='groups_list'>
HTML;

if(!empty($fields)) {
	foreach ( $fields as $group )
	{		
						
		$IPBHTML .= <<<HTML
			<div class='ipsControlRow isDraggable group' style='position: relative' id='groups_{$group['group_id']}' >
			<div class='draghandle' title='Drag to reorder' style="position:absolute; left:-400px;"></div>
	
				<table class='ipsTable'>
					<tr class='ipsControlRow isDraggable'>
						<th class='subhead col_drag'><span class='draghandle'>&nbsp;</span></th>
						<th class='subhead'>
							<span class='larger_text'><a href='{$this->settings['base_url']}{$this->form_code}do=editfieldgroup&amp;id={$group['group_id']}'><strong>{$group['name']}</strong></a></span>{$testMode}
						</th>
						<th class='col_buttons subhead'>
						
						<ul class='ipsControlStrip'>
      								<li class='i_add'><a href='{$this->settings['base_url']}{$this->form_code}do=addfield&amp;set={$group['set_id']}&amp;group={$group['group_id']}'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' /> {$this->lang->words['cfds_add_field']}</a></li>
	
      <li class='ipsControlStrip_more ipbmenu' id='menu_{$row['category_id']}'><a href='#'>More</a></li>
      </ul>
        <ul class='acp-menu' id='menu_{$row['category_id']}_menucontent' style='display: none'>
           <li class='icon edit'><a href="{$this->settings['base_url']}{$this->form_code}do=editfieldgroup&amp;id={$group['group_id']}">{$this->lang->words['cfds_field_edit']}</a></li>
                                <li class='icon delete'><a href="{$this->settings['base_url']}{$this->form_code}do=deletefieldgroup&amp;id={$group['group_id']}">{$this->lang->words['cfds_field_delete']}</a></li>
                       </ul>
						
						
						</th>
					</tr>
				</table>
				<table class='ipsTable' id='fields_list_{$group['group_id']}'>
HTML;
if ($group['fields']) {
		foreach ( $group['fields'] as $field )
		{

			$IPBHTML .= <<<HTML
					<tr class='ipsControlRow isDraggable' id='fields_{$field['field_id']}'>
						<td width='4%' class='subhead col_drag'><span class='draghandle'>&nbsp;</span></td>
						<td width='32%' class='subhead'><span class='larger_text'><a style='margin-left: 25px' href='{$this->settings['base_url']}{$this->form_code}do=editfield&amp;id={$field['field_id']}'>{$field['title']}</a></span></td>
						<td width='20%' style='text-align:center;'>{$field['type']}</td>
						<td width='18%' style='text-align:center;'>
HTML;

                        if( $field['required'] == 1 ) {
                            $IPBHTML .= <<<HTML
                               <img src='{$this->settings['skin_acp_url']}/images/icons/tick.png' />
HTML;
                        }
                        else {

                            $IPBHTML .= <<<HTML
                              <img src='{$this->settings['skin_acp_url']}/images/icons/cross.png' />
HTML;
                        }

$IPBHTML .= <<<HTML
						</td>
						<td width='18%' style='text-align:center;'>
HTML;

                        if( $field['active'] == 1 ) {
                            $IPBHTML .= <<<HTML
                               <img src='{$this->settings['skin_acp_url']}/images/icons/tick.png' />
HTML;
                        }
                        else {

                            $IPBHTML .= <<<HTML
                              <img src='{$this->settings['skin_acp_url']}/images/icons/cross.png' />
HTML;
                        }

$IPBHTML .= <<<HTML
</td>
						<td width='8%' class='col_buttons'>

						<ul class='ipsControlStrip'>
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code}do=editfield&amp;id={$field['field_id']}">{$this->lang->words['cfds_field_edit']}</a></li>
							<li class='i_delete'><a href="{$this->settings['base_url']}{$this->form_code}do=deletefield&amp;id={$field['field_id']}">{$this->lang->words['cfds_field_delete']}</a></li>
						</ul>
						</td>
					</tr>
HTML;
		}
} else {

$IPBHTML .= <<<HTML
            
            <div class='no_messages'>{$this->lang->words['cfds_no_fields']}</div>

HTML;
	
}

			$IPBHTML .= <<<HTML
				</table>
				<script type='text/javascript'>
					jQ("#fields_list_{$group['group_id']}").ipsSortable( 'table', { 
						url: "{$this->settings['base_url']}&{$this->form_code_js}&do=reorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' )
					});
				</script>
			</div>
HTML;

	}
	
} else {
	
$IPBHTML .= <<<HTML

            <div class='no_messages'>{$this->lang->words['cfds_no_field_groups']}</div>

HTML;
	
}
	
	$IPBHTML .= <<<HTML
		</div>
	</div>
</div>

<script type='text/javascript'>
	jQ("#groups_list").ipsSortable( 'multidimensional', { 
		url: "{$this->settings['base_url']}&{$this->form_code_js}&do=reorderfieldgroups&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' )
});
</script>

<br /><br />

HTML;


//--endhtml--//
return $IPBHTML;
}


    /**
     * Add/edit field form
     *
     * @access	public
     * @param	array 	Field
     * @param	array 	Form elements
     * @param	string	Action type
     * @return	string	HTML
     */
    public function fieldForm( $field, $form, $type ) {
        $IPBHTML = "";
//--starthtml--//

        if( $type == 'edit' ) {
            $title	= sprintf($this->lang->words['cfds_editing_field'], $field['title']);
        }
        else {
            $title	= $this->lang->words['cfds_adding_field'];
        }

        $IPBHTML .= <<<HTML
<script type="text/javascript">
function change()
{
   switch (document.getElementById("field_type").value)
   {
      case "input":
          document.getElementById('options').style.display = 'none';
      break;
      case "dropdown":
          document.getElementById('options').style.display = 'table-row';
      break;
      case "radio":
          document.getElementById('options').style.display = 'table-row';
      break;
      case "checkbox":
          document.getElementById('options').style.display = 'none';
      break;
      case "textarea":
          document.getElementById('options').style.display = 'none';
      break;
   }
}
</script>

<div class='section_title'>
  <h2>{$title}</h2>
</div>
<form action='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do={$form['formcode']}' id='mainform' method='post'>
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <input type='hidden' name='id' value='{$field['field_id']}' />
  <input type='hidden' name='set_id' value='{$field['set_id']}' />

  <div class='acp-box'>
    <h3>{$title}</h3>
	<table class='ipsTable double_pad'>
  <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_field_title']}</strong></td>
        <td class='field_field'>{$form['title']} </td>
      </tr>
      <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_field_description']}</strong></td>
        <td class='field_field'>{$form['description']}</td>
      </tr>
HTML;
        if ($this->request['global'] != 1) {
$IPBHTML .= <<<HTML
      <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_field_group']}</strong></td>
        <td class='field_field'>{$form['group']}</td>
      </tr>
HTML;
        }
$IPBHTML .= <<<HTML
      <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_field_required_q']}</strong></td>
        <td class='field_field'>{$form['required']}</td>
      </tr>
      <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_field_active_q']}</strong></td>
        <td class='field_field'>{$form['active']}</td>
      </tr>
      <tr>
        <td class='field_title'><strong>{$this->lang->words['cfds_field_type']}</strong></td>
        <td class='field_field'>{$form['field_type']}</td>
      </tr>
      <tr id="options">
        <td class='field_title'><strong>{$this->lang->words['cfds_field_options']}</strong>
        <br /><span class="desctext">{$this->lang->words['cfds_field_options_desc']}</span></td>
        <td class='field_field'>{$form['options']}</td>
      </tr>
</table>


     
<script type="text/javascript">
change();
</script>

    </ul>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' name='submit' value='{$form['button']}' class='button primary' />
      </div>
    </div>
  </div>
</form>
HTML;

//--endhtml--//
        return $IPBHTML;
    }

    /**
     * Add/edit field group form
     *
     * @access	public
     * @param	array 	Group
     * @param	array 	Form elements
     * @param	string	Action type
     * @return	string	HTML
     */
    public function fieldGroupForm( $group, $form, $type ) {
        $IPBHTML = "";
//--starthtml--//

        if( $type == 'edit' ) {
            $title	= sprintf( $this->lang->words['cfds_edit_fieldgroup_title'], $group['name'] );
        }
        else {
            $title	= $this->lang->words['cfds_add_fieldgroup_title'];
        }

        $IPBHTML .= <<<HTML
<div class='acp-box'>
<div class='section_title'>
  <h3>{$title}</h3>
</div>
<form action='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do={$form['formcode']}' id='mainform' method='post'>
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
  <input type='hidden' name='id' value='{$group['group_id']}' />
  <input type='hidden' name='set_id' value='{$group['set_id']}' />
  <table class='ipsTable double_pad'>
	<tr>
	  <td class='field_title'>
        <strong>{$this->lang->words['cfds_field_group_name']}</strong>
      </td>
      <td class='field_field'>
                {$form['name']}
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
     * Delete field form
     *
     * @access	public
     * @param	array 	Field
     * @return	string	HTML
     */
    public function fieldDeleteForm( $field ) {
        $IPBHTML = "";
//--starthtml--//

        $title	= sprintf( $this->lang->words['cfds_delete_field_title'], $field['title'] );

        $IPBHTML .= <<<HTML
<div class='acp-box'>
<div class='section_title'>
  <h3>{$title}</h3>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm' id='theAdminForm'>
  <input type='hidden' name='do' value='dodeletefield' />
  <input type='hidden' name='field_id' value='{$field['field_id']}' />
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
    <p class="no_messages">{$this->lang->words['cfds_delete_field_q']}</p>
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' value='{$this->lang->words['cfds_field_delete']}' class='button primary' accesskey='s'>
      </div>    
  </div>
</form>
</div>
HTML;

//--endhtml--//
        return $IPBHTML;
    }


    /**
     * Delete field group form
     *
     * @access	public
     * @param	array 	Field Group
     * @return	string	HTML
     */
    public function fieldGroupDeleteForm( $group, $move_fields ) {
        $IPBHTML = "";
//--starthtml--//

        $title	= sprintf( $this->lang->words['cfds_delete_fieldgroup_title'], $group['name'] );

        $IPBHTML .= <<<HTML
      
<div class='acp-box'>
<div class='section_title'>
  <h3>{$title}</h3>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm' id='theAdminForm'>
  <input type='hidden' name='do' value='dodeletefieldgroup' />
  <input type='hidden' name='group' value='{$group['group_id']}' />
  <input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />

  <table class='ipsTable double_pad'>
	<tr>
	<td class='field_title'>
        <strong>{$this->lang->words['cfds_move_fields_q']}</strong>
    </td>
    <td class='field_field'>
       {$move_fields}
    </td>
    </tr>
  </table>    
    <div class='acp-actionbar'>
      <div class='centeraction'>
        <input type='submit' value='{$this->lang->words['cfds_field_group_delete']}' class='button primary' accesskey='s'>
      </div>
    </div>  
</form>
</div>
HTML;

//--endhtml--//
        return $IPBHTML;
    }
    



}