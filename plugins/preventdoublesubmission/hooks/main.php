//<?php

class hook8 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'createTopicForm' => 
  array (
    1 => 
    array (
      'selector' => 'form[accept-charset=\'utf-8\'][method=\'post\']',
      'type' => 'add_attribute',
      'attributes_add' => 
      array (
        0 => 
        array (
          'key' => 'onsubmit',
          'value' => '$(this).find(\'[type=submit]\').prop(\'disabled\', true).text(ips.getString(\'saving\'));',
        ),
      ),
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


























































































}
