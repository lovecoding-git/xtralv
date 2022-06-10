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

class classifieds_categories {
    /**
     * Constructor. Set the database table name and necessary field names
     *
     * @param   object  $registry       The IPS Registry object
     * @param   string  $table          Name of the tree database table
     * @param   string  $category_id    Name of the primary key ID field
     * @param   string  $parent_id      Name of the parent ID field
     * @param   string  $sort_by        Name of the field to sort data by
     */
    public function __construct( $registry, $table = 'classifieds_categories', $category_id = 'category_id', $parent_id = 'parent_id', $sort_by = 'sort_order' ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
        $this->cache	  = $this->registry->cache();
        $this->lang		= $this->registry->class_localization;
        $this->table = $table;
        $this->fields = array('id'     => $category_id,
                'parent' => $parent_id,
                'sort'   => $sort_by
        );

        // Build expiry clause
        $this->expiry_clause = "i.date_expiry > " . (time() - ($this->settings['classifieds_display_after_expiry'] * 86400));

    }

    /**
     A utility function to return an array of the fields
     that need to be selected in SQL select queries
         
     @return  array   An indexed array of fields to select
     **/
    private function getFields() {
        return array($this->fields['id'], $this->fields['parent'], $this->fields['sort'], 'name', 'lft', 'rgt', 'depth', 'seo_title', 'description', 'fieldset_id', 'advert_types');
    }

    /**
     * Fetch the node data for the node identified by $id
     *
     * @param   int     $id     The ID of the node to fetch
     * @return  object          An object containing the node's
     *                          data, or null if node not found
     */
    public function getNode($id) {
        $row = $this->DB->buildAndFetch( array(	'select' => join(',', $this->getFields()),
                'from' => $this->table,
                'where' => $this->fields['id'] . " = " . intval($id),
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_no_category'] , '10CFDL1001', false );
        }

        // Parse description
        IPSText::getTextClass('bbcode')->parse_html 		= 0;
        IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
        IPSText::getTextClass('bbcode')->parse_smilies		= 0;
        IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_cat_description';

        $row['description'] = IPSText::getTextClass('bbcode')->preDisplayParse( $row['description'] );
        $row['name'] = ($row['category_id'] == 1) ? $this->lang->words['cfds_all'] : $row['name'];
        
        // Get Types
        
        if($row['advert_types'] == '*') {
        	
        	$this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_types' => 't' ),
                'order' => 'sort_order ASC',
                )		);
        	
        } else {
        	
        	$this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_types' => 't' ),
        		'where' => "t.type_id IN (" . $row['advert_types'] . ")",
                'order' => 'sort_order ASC',
                )		);
        	
        }

        $this->DB->execute();

        while( $type = $this->DB->fetch() ) {

            $row['types'][] = $type;

        }
        

        return $row;
    }

    /**
     * Fetch the descendants of a node, or if no node is specified, fetch the
     * entire tree. Optionally, only return child data instead of all descendant
     * data.
     *
     * @param   int     $id             The ID of the node to fetch descendant data for.
     *                                  Specify an invalid ID (e.g. 0) to retrieve all data.
     * @param   bool    $includeSelf    Whether or not to include the passed node in the
     *                                  the results. This has no meaning if fetching entire tree.
     * @param   bool    $itemCount      Whether or not to include the item count in the results
     * @param   bool    $childrenOnly   True if only returning children data. False if
     *                                  returning all descendant data
     * @return  array                   The descendants of the passed now
     */
    public function getDescendants($id = 1, $includeSelf = false, $itemMarking = false, $depth='', $nestle=TRUE, $filters = array() ) {
     
    	$where = array();
    	$itemwhere = array();	
    	
    	$category_id = $this->fields['id'];

        $node = $this->getNode($id);


        $lft = $node['lft'];
        $rgt = $node['rgt'];
        $parent_id = $node['category_id'];
        $depth_where = ($depth) ? ' AND root.depth < ' . ($node['depth'] + $depth + 1) : '';


        foreach ($this->getFields() as $value) {
            $fields[] = 'root.' . $value;
        }
        $select = join(',', $fields);

        
        //-----------------------------------------
        // Build Where
        //-----------------------------------------        
        
        if ($includeSelf) {
        	$where[] = 'root.lft >= ' . intval($lft) . ' AND root.rgt <= ' . intval($rgt) . $depth_where;
        } 
        else {
        	$where[] = 'root.lft > ' . intval($lft) . ' AND root.rgt < ' . intval($rgt) . $depth_where;
        	
        }
        
        $itemwhere[] = 'i.active = 1';
        $itemwhere[] = 'i.open = 1';
        $itemwhere[] = 'i.category_id = current.category_id';
        $itemwhere[] = $this->expiry_clause;
        
        if( is_array($filters) AND count($filters) )
		{
			$itemwhere	= array_merge( $itemwhere, $filters );
		}        
        
                $this->DB->build( array(	'select' => $select . ", (root.depth - {$node['depth']}) -1 AS rel_depth",
                        'from' => array ($this->table => 'root'),
                        'where' => ( count($where) ? implode( ' AND ', $where ) : '' ),
                        'add_join' => array( 0 => array( 'from'   => array( 'classifieds_categories' => 'current' ),
                                        'where'  => 'current.lft BETWEEN root.lft AND root.rgt',
                                        'type'   => 'inner'
                                ),
                                1 => array( 'select' => 'COUNT( i.item_id ) AS item_count, MAX(i.date_added) as last_item',
                                        'from'   => array( 'classifieds_items' => 'i' ),
                                        'where'  => ( count($itemwhere) ? implode( ' AND ', $itemwhere ) : '' ),
                                        'type'   => 'left'
                                )
                        ),
                        'group' => 'root.category_id',
                        'order' => 'root.lft'
                        )		);

        $res = $this->DB->execute();
		$arr = array();
		
        while ($row = $this->DB->fetch($res)) {
            if ( $itemMarking ) {
                $lastMarked = $this->registry->classItemMarking->fetchTimeLastMarked( array( 'categoryID' => $row['category_id'] ), 'classifieds' );
                if ($lastMarked > $row['last_item'] || $row['last_item'] == "") {
                    $row['is_read'] = 1;
                }
                else {
                    $row['is_read'] = 0;
                }
            }

            //Parse descriptions
            IPSText::getTextClass('bbcode')->parse_html 		= 0;
            IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
            IPSText::getTextClass('bbcode')->parse_smilies		= 0;
            IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_cat_description';

            $row['description'] = IPSText::getTextClass('bbcode')->preDisplayParse( $row['description'] );

			// Internationalise the root cat           
            $row['name'] = ($row['category_id'] == 1) ? $this->lang->words['cfds_all'] : $row['name'];            

            $arr[$row['category_id']] = $row;
            
        }
        
		if($nestle){
        	return $this->nestle($arr, 'rel_depth');
		} else {
        	return $arr;
		}
    }

    /**
     * Fetch the children of a node, or if no node is specified, fetch the
     * top level items.
     *
     * @param   int     $id             The ID of the node to fetch child data for.
     * @param   bool    $includeSelf    Whether or not to include the passed node in the results.
     * @param   bool    $itemCount      Whether or not to include the item count in the results
     * @return  array                   The children of the passed node
     */
    public function getChildren($category = array()) {
        return $this->getDescendants($category['category_id'], false, false, 1, false, '');
    }

    /**
     * Fetch the path to a node. If an invalid node is passed, an empty array is returned.
     * If a top level node is passed, an array containing on that node is included (if
     * 'includeSelf' is set to true, otherwise an empty array)
     *
     * @param   int     $id             The ID of the node to fetch child data for.
     * @param   bool    $includeSelf    Whether or not to include the passed node in the
     *                                  the results.
     * @return  array                   An array of each node to passed node
     */
    public function getPath($node=array() , $includeSelf = false) {
    	
    	// @todo this query can probably be discarded - think harder!
    	
//        $node = $this->getNode($id);
//        if (is_null($node))
//            return array();

        if ($includeSelf) {

            $this->DB->build( array(	'select' => join(',', $this->getFields()),
                    'from' => $this->table,
                    'where' => 'lft <= ' . intval($node['lft']) . " AND rgt >= " . intval($node['rgt']),
                    'order' => 'depth'
                    )		);
        }
        else {
            $this->DB->build( array(	'select' => join(',', $this->getFields()),
                    'from' => $this->table,
                    'where' => 'lft < ' . intval($node['lft']) . " AND rgt > " . intval($node['rgt']),
                    'order' => 'depth'
                    )		);
        }

        $this->DB->execute();

        while ($row = $this->DB->fetch()) {
        	
        	$row['name'] = ($row['category_id'] == 1) ? $this->lang->words['cfds_all'] : $row['name'];
            $path[] = $row;
        }

        return $path;
    }

    /**
     * Check if one node descends from another node. If either node is not
     * found, then false is returned.
     *
     * @param   int     $descendant_id  The node that potentially descends
     * @param   int     $ancestor_id    The node that is potentially descended from
     * @return  bool                    True if $descendant_id descends from $ancestor_id, false otherwise
     */
    public function isDescendantOf($descendant_id, $ancestor_id) {
        $node = $this->getNode($ancestor_id);

        $result = $this->DB->buildAndFetch( array(	'select' => 'COUNT(*) as is_descendant',
                'from' => $this->table,
                'where' => $this->fields['id'] . ' = ' . intval($descendant_id) . ' AND lft > ' . intval($node['lft']) . ' AND rgt < ' . intval($node['rgt']),
                )		);

        return $result['is_descendant'] > 0;
    }

    /**
     * Check if one node is a child of another node. If either node is not
     * found, then false is returned.
     *
     * @param   int     $child_id       The node that is possibly a child
     * @param   int     $parent_id      The node that is possibly a parent
     * @return  bool                    True if $child_id is a child of $parent_id, false otherwise
     */
    public function isChildOf($child_id, $parent_id) {
        $result = $this->DB->buildAndFetch( array(	'select' => 'COUNT (*) as is_child',
                'from' => $this->table,
                'where' => $this->fields['id'] . ' = ' . intval($child_id) . ' AND ' . $this->fields['parent'] . ' = ' . intval($parent_id),
                )		);

        return $result['is_child'] > 0;
    }
    
    /**
     * Check if one node is a leaf node
     *
     * @param   array     $category     The node that is possibly a leaf
     * @return  bool                    True if leaf
     */
    public function isLeaf($category=array()) {
    
    	if ($category['rgt'] - $category['lft'] == 1) {
			return true;
		}

        return false;
    }

    /**
     * Find the number of descendants a node has
     *
     * @param   int     $id     The ID of the node to search for. Pass 0 to count all nodes in the tree.
     * @return  int             The number of descendants the node has, or -1 if the node isn't found.
     */
    public function numDescendants($id) {
        $node = $this->getNode($id);
        return ($node['rgt'] - $node['lft'] - 1) / 2;
    }

    /**
     * Find the number of children a node has
     *
     * @param   int     $id     The ID of the node to search for. Pass 0 to count the first level items
     * @return  int             The number of descendants the node has, or -1 if the node isn't found.
     */
    public function numChildren($id) {

        $result = $this->DB->buildAndFetch( array(	'select' => 'COUNT (*) as num_children',
                'from' => $this->table,
                'where' => $this->fields['parent'] . ' = ' . intval($id),
                )		);

        return $result['num_children'];

    }

    /**
     * Fetch the tree data, nesting within each node references to the node's children
     *
     * @return  array       The tree with the node's child data
     */
    private function getTreeWithChildren() {

        $this->DB->build( array(	'select' => join(',', $this->getFields()),
                'from' => $this->table,
                'order' => $this->fields['sort']
                )		);
        $this->DB->execute();

        // create a root node to hold child data about first level items
        $root = array('category_id' => 0, 'children' => array());
        $arr = array($root);

        // populate the array and create an empty children array

        while ($row = $this->DB->fetch()) {
            $arr[$row['category_id']] = $row;
            $arr[$row['category_id']]['children'] = array();
        }

        // now process the array and build the child data
        foreach ($arr as $id => $row) {
            if (isset($row['parent_id']))
                $arr[$row['parent_id']]['children'][$id] = $id;
        }

        return $arr;
    }

    /**
     * Rebuilds the tree data and saves it to the database
     */
    public function rebuildTree() {
    	    	
        $data = $this->getTreeWithChildren();

        $n = 0; // need a variable to hold the running n tally
        $level = 0; // need a variable to hold the running level tally

        // invoke the recursive function. Start it processing
        // on the fake "root node" generated in getTreeWithChildren().
        // because this node doesn't really exist in the database, we
        // give it an initial lft value of 0 and an depth of 0.
        $this->generateTreeData($data, 0, 0, $n);

        // at this point the the root node will have lft of 0, depth of 0
        // and rgt of (tree size * 2 + 1)
        foreach ($data as $id => $row) {

            // skip the root node
            if ($id == 0)
                continue;

            $this->DB->update( $this->table, array( 'depth' => intval($row['depth']), 'lft' => intval($row['lft']), 'rgt' => intval($row['rgt']) ), $this->fields['id'] . ' = ' . intval($id) );

        }
    }

    /**
     * Generate the tree data. A single call to this generates the n-values for
     * 1 node in the tree. This function assigns the passed in n value as the
     * node's lft value. It then processes all the node's children (which
     * in turn recursively processes that node's children and so on), and when
     * it is finally done, it takes the update n-value and assigns it as its
     * rgt value. Because it is passed as a reference, the subsequent changes
     * in subrequests are held over to when control is returned so the rgt
     * can be assigned.
     *
     * @param   array   &$arr   A reference to the data array, since we need to
     *                          be able to update the data in it
     * @param   int     $id     The ID of the current node to process
     * @param   int     $level  The depth to assign to the current node
     * @param   int     &$n     A reference to the running tally for the n-value
     */
    private function generateTreeData(&$arr, $id, $level, &$n) {
        $arr[$id]['depth'] = $level;
        $arr[$id]['lft'] = $n++;

        // loop over the node's children and process their data
        // before assigning the rgt value
        foreach ($arr[$id]['children'] as $child_id) {
            $this->generateTreeData($arr, $child_id, $level + 1, $n);
        }
        $arr[$id]['rgt'] = $n++;
    }

    /**
     * Builds a nested array from a flat array
     *
     * @param   array   $arrs           The source array that needs nestleifying
     * @param   string  $depth_key      The key used in the array to signify depth
     *
     * @return  array                   The resultant nestled up goodness.
     */
    public function nestle( $arrs, $depth_key = 'depth' ) // Mmmmm Nestle!
    {
        $nested = array();
        $depths = array();

        foreach( $arrs as $key => $arr ) {
            if( $arr[$depth_key] == 0 ) {
                $nested[$key] = $arr;
                $depths[$arr[$depth_key] + 1] = $key;
            }
            else {
                $parent =& $nested;
                for( $i = 1; $i <= ( $arr[$depth_key] ); $i++ ) {
                    $parent =& $parent[$depths[$i]];
                }

                $parent[$key] = $arr;
                $depths[$arr[$depth_key] + 1] = $key;
            }
        }

        return $nested;
    }

    /**
     * Builds nested list of categories as html for output
     * Likely to be deprecated after a competant skinner gets his hands on the category index view
     *
     * @param   array   $categories     Nested array of categories
     * @param   string  $listid         identifier to pass to html id parameter
     *
     * @return  string                  The resultant HTML list.
     */
    public function buildNestedList($categories, $startDepth = 1 ) {

        $prehtml = '';
        $posthtml = '';

        $depth = intval($startDepth);
        foreach($categories as $index => $category) {
            $prehtml = '';
            $newDepth = intval($category['depth']);
            if ($newDepth > $depth) {
                while ($newDepth > $depth) {
                    $prehtml .= "<ul><li>";
                    $depth++;
                }
            } else if ($newDepth < $depth) {
                while ($newDepth < $depth) {
                    $prehtml .= "</li></ul>";
                    $depth--;
                }
                $prehtml .= "</li><li>";
            } else if ($newDepth == $depth) {
                if ($index == 0) {
                    $prehtml .= "<ul><li>";
                } else {
                    $prehtml .= "</li><li>";
                }
            }

            $depth = $newDepth;
            $categories[$index]['prehtml'] = $prehtml;
        }
        if (count($categories) > 0) {
            do {
                $posthtml .= '</li></ul>';
            } while ($depth-- > 2);
            $categories[$index]['posthtml'] .= $posthtml;
        }
        return $categories;
    }

    /**
     * Build an array suitable for the internal IPS dropdown builder
     */
    public function buildJumpList($includeSelf = TRUE, $forDelete = FALSE, $disableNonLeaf = FALSE) {
        $all_categories = $this->getDescendants(1, $includeSelf, FALSE, NULL, FALSE);

        if (count($all_categories) == 0) {
            $this->registry->getClass('output')->showError( 'No categories', "ERROR NUMBER", false );
        }

        if ($forDelete) {
            $jumpList[] = array(0, 'None, Delete');
        }
        foreach ($all_categories as $row) {
            $depthGuide = "";
            while ($row['depth'] > 1) {
                $depthGuide .= "--";
                $row['depth']--;
            }
            $disabled = "0";
            if ($row['rgt'] - $row['lft'] != 1) {
                $disabled = 1;
            }

            $jumpList[] = array($row['category_id'], $depthGuide . $row['name'], $disabled);

        }
        return $jumpList;
    }


    /**
     * Empties category
     *
     * @param   int     $category_id    Primary key of category to empty
     *
     */
    public function emptyCategory($category_id) {

        $category_id = intval( $category_id );

        $cat = $this->getNode($category_id);

        $this->DB->build( array(
                'select' => 'items.item_id',
                'from' => array( 'classifieds_items' => 'items' ),
                'add_join' => array( 0 => array( 'select' => 'cat.lft, cat.rgt',
                                'from'   => array( 'classifieds_categories' => 'cat' ),
                                'where'  => 'cat.category_id=items.category_id',
                                'type'   => 'left' ) ),
                'where' => 'cat.lft >= ' . intval($cat['lft']) . ' AND cat.rgt <= ' . intval($cat['rgt']),

                )	);

        $this->DB->execute();

        while( $row = $this->DB->fetch()) {
            $items[] = $row['item_id'];
        }
        if ($items) {

            // Delete
			$this->registry->classifieds->helper('items')->deleteItems( $items );

        }
    }

    /**
     * Create a form dropdown/select list
     *
     * @access	public
     * @param	string		Field name
     * @param	array		Options.  Multidimensional array in format of array( array( 'value', 'display' ), array( 'value', 'display' ) )
     * @param	string		Default value
     * @param	string		HTML id attribute [defaults to $name]
     * @param	string		Javascript to add to list
     * @param	string		CSS class(es) to add to field
     * @return	string		Form dropdown list
     */
    public function formDropdown( $name, $list=array(), $default_val="", $id="", $js="", $css="" ) {
        if ($js != "") {
            $js = ' ' . $js . ' ';
        }

        if ($css != "") {
            $css = ' ' . $css;
        }

        $id = $id ? $id : $name;

        $html = "<select name='{$name}'" . $js . " id='{$id}' class='dropdown{$css}'>\n";

        foreach ( $list as $v ) {
            $selected = "";

            if ( ($default_val !== "") and ($v[0] == $default_val) ) {
                $selected = ' selected="selected"';
            }
            $disabled = "";
            if($v[2] == 1) {
                $disabled = ' disabled="disabled"';
            }

            $html .= "<option value='" . $v[0] . "'" . $selected . $disabled . ">" . $v[1] . "</option>\n";
        }

        $html .= "</select>\n\n";

        return $html;
    }


    public function subscribe($cat, $member) {

        // get array of descendants
        $sub_array = $this->getDescendants($cat, true);

        //build array of ids
        $sub_cats = array();
        foreach($sub_array as $row) {
            $sub_cats[] = $row['category_id'];
        }


        //format for SQL query
        $sub_toids = implode(',', $sub_cats);

        // find subcats already subscribed to

        $current_subtoids = array();
        $current_subs = $this->DB->build(
                array( 'select' => 'sub_toid',
                'from' => 'classifieds_subscriptions',
                'where' => "sub_type='cat' AND sub_toid IN (" . $sub_toids . ") AND sub_mid=" . $member
                )

        );

        $this->DB->execute();

        while( $row = $this->DB->fetch() ) {
            $current_subtoids[] = $row['sub_toid'];
        }

        foreach($sub_array as $row) {

            if (!in_array($row['category_id'], $current_subtoids)) {
                $this->DB->insert( 'classifieds_subscriptions', array(	'sub_mid'	=> $member,
                        'sub_type'	=> 'cat',
                        'sub_toid'	=> $row['category_id'],
                        'sub_added'	=> time()
                        )								);


            }




        }

    }



    public function unsubscribe($cat, $member) {

        // get descendants and build the subtoids
        $sub_array = $this->getDescendants($cat, true);

        $sub_cats = array();
        foreach($sub_array as $row) {
            $sub_cats[] = $row['category_id'];
        }
        $sub_toids = implode(',', $sub_cats);

        $this->DB->delete( 'classifieds_subscriptions', "sub_type='cat' AND sub_toid IN (" . $sub_toids . ") AND sub_mid = " . $member );

    }

    public function isSubscribed($cat, $member) {

        $check = $this->DB->buildAndFetch( array( 'select' => 'count(sub_id) as count', 'from' => 'classifieds_subscriptions', 'where' => "sub_type='cat' AND sub_toid={$cat} AND sub_mid=" . $member ) );

        return $check['count'] > 0;

    }



}