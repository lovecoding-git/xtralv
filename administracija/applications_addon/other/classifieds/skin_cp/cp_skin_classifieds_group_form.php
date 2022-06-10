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

class cp_skin_classifieds_group_form extends output {

    /**
     * Prevent our main destructor being called by this class
     *
     * @access	public
     * @return	void
     */
    public function __destruct() {
    }


    /**
     * Main form to edit group settings
     *
     * @access	public
     * @param	array 	Group
     * @param	mixed	Tab id
     * @return	string	HTML
     */
    public function acp_classifieds_group_form_main( $group, $tabId ) {

        $form = array();
        $form['g_classifieds_can_access']       = $this->registry->output->formYesNo( 'g_classifieds_can_access', $group['g_classifieds_can_access'] );
        $form['g_classifieds_can_list']         = $this->registry->output->formYesNo( 'g_classifieds_can_list', $group['g_classifieds_can_list'] );
        $form['g_classifieds_can_open_close'] 	= $this->registry->output->formYesNo( 'g_classifieds_can_open_close', $group['g_classifieds_can_open_close'] );
        $form['g_classifieds_can_edit_item'] 	= $this->registry->output->formYesNo( 'g_classifieds_can_edit_item', $group['g_classifieds_can_edit_item'] );
        $form['g_classifieds_edit_time']	= $this->registry->output->formSimpleInput( "g_classifieds_edit_time", $group['g_classifieds_edit_time'], 3 );
        $form['g_classifieds_attach_per_item']	= $this->registry->output->formSimpleInput( "g_classifieds_attach_per_item", $group['g_classifieds_attach_per_item'], 3 );
        $form['g_classifieds_attach_max']	= $this->registry->output->formSimpleInput( "g_classifieds_attach_max", $group['g_classifieds_attach_max'], 3 );
        $form['g_classifieds_can_moderate'] 	= $this->registry->output->formYesNo( 'g_classifieds_can_moderate', $group['g_classifieds_can_moderate'] );
        $IPBHTML = "";

        $IPBHTML .= <<<EOF
<div id='tab_GROUPS_{$tabId}_content'>
  <div>
	<table class='ipsTable double_pad'>
      <tr>
        <th colspan='2'>{$this->lang->words['cfds_feature_access']}</th>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_can_access']}</strong></td>
        <td class='field_field'> {$form['g_classifieds_can_access']} </td>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_can_list']}</strong></td>
        <td class='field_field'> {$form['g_classifieds_can_list']} </td>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_can_open_close']}</strong></td>
        <td class='field_field'> {$form['g_classifieds_can_open_close']} </td>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_can_edit']}</strong></td>
        <td class='field_field'> {$form['g_classifieds_can_edit_item']} </td>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_edit_time']}</strong>
          <br/>
          <span class="desctext">{$this->lang->words['cfds_edit_time_desc']}</span></td>
        <td class='field_field'> {$form['g_classifieds_edit_time']} </td>
      </tr>
      <tr>
        <th colspan='2'>{$this->lang->words['cfds_attachments']}</th>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_upload_size']}</strong>
          </td>
        <td class='field_field'> {$form['g_classifieds_attach_max']}<br/>
          <span class="desctext">{$this->lang->words['cfds_upload_size_desc']}</span> </td>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_upload_per_item']}</strong>
          </td>
        <td class='field_field'> {$form['g_classifieds_attach_per_item']}<br/>
          <span class="desctext">{$this->lang->words['cfds_upload_per_item_desc']}</span> </td>
      </tr>
      <tr>
        <th colspan='2'>{$this->lang->words['cfds_moderation']}</th>
      </tr>
      <tr>
        <td class='field_title'><strong class='title'>{$this->lang->words['cfds_can_moderate']}</strong>
          </td>
        <td class='field_field'> {$form['g_classifieds_can_moderate']}<br/>
          <span class="desctext">{$this->lang->words['cfds_can_moderate_desc']}</span> </td>
      </tr>
    </table>
  </div>
</div>
EOF;

        return $IPBHTML;
    }

    /**
     * Tabs for the group form
     *
     * @access	public
     * @param	array 	Group
     * @param	mixed	Tab id
     * @return	string	HTML
     */
    public function acp_classifieds_group_form_tabs( $group, $tabId ) {

		$IPBHTML = "<li id='tab_GROUPS_{$tabId}'>" . IPSLib::getAppTitle('classifieds') . "</li>";

        return $IPBHTML;
    }

}
