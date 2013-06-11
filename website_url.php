<?php

/*
*  my-field.php
*
*  This file acts as a template for creating a new field type in the
*  Advanced Custom Fields plugin.
*
*  @since	4.0.0
*  @date	DD/MM/YYYY
*
*  @info	http://www.advancedcustomfields.com/docs/tutorials/creating-a-new-field-type/
*/

class Website_field extends acf_Field
{

	// vars
	var  $defaults // will hold default field options
		;

	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct()
	{
		// vars
		$this->name = 'website';
		$this->label = __('Website');
		$this->defaults = array(
			'value'              => ''
			,'internal_link'      => true
			, 'website_title'      => true

		);


		// do not delete!
    	parent::__construct();
	}


	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/

	function load_value( $value, $post_id, $field )
	{
		return $value;
	}





	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value( $value, $field )
	{
		return $value;
	}


	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/


	function format_value_for_api(  $value, $post_id, $field )
	{


		// defaults
		$field = array_merge($this->defaults, $field);
		extract( $field, EXTR_SKIP ); //Declare each item in $field as its own variable i.e.: $name, $value, $label, $time_format, $date_format and $show_week_number
/*
		// format value
		$value = explode('|', $value);

		if( $field['val'] == 'address' )
		{
			$value = array( 'coordinates' => $value[1], 'address' => $value[0] );
		}
		else
		{
			$value = $value[1];
		}


		return $value;*/


		// format value

		$external = '';
			//If an external link
			if($internal_link=='true'  && !empty($value['internal']) ){ $external = 'target="_blank"';};

				// get value
				$the_url = $this->nicifyUrl( $value['url'] );

			//If show title
			if($website_title=='true' && !empty($value['title'])){ $title = $value['title'];}else{$title = $the_url;};

				$value ='<a href="http://'.$the_url.'" '.$external.'>'.$title.'</a>';




		// return value
		if($the_url!='Invalid URL'){
		   		 return $value;
		    }else{
		    	return $the_url;
		    }



	}

	/*
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/

	function load_field( $field )
	{
		return $field;
	}


	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
			return $field;
	}



	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - an array holding all the field's data
	*/

	function create_field($field)
	{


			$field = array_merge( $this->defaults, $field );
		extract( $field, EXTR_SKIP ); //Declare each item in $field as its own variable i.e.: $name, $value, $label, $time_format, $date_format and $show_week_number

		echo  '<table class="widefat "><thead><tr>';

		if ($website_title=='true')echo '<th class="title"><span>Title</span></th>';
		echo '<th class="url"><span>URL</span></th>';
		if ($internal_link=='true')echo '<th class="internal" style="width:10%;"><span>Internal Link</span></th>';

		echo '</tr></thead><tbody><tr>';





			if($website_title=='true'){

				echo '<td><input type="text" value="' . $value['title'] . '" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'].'[title]" /></td>';
		}else{
				echo '<input type="hidden" value="" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'].'[title]" />';
		}

echo '<td><input type="text" value="' . $value['url'] . '" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'].'[url]" /><p class="description">You can exclude http://, the field will add it, if missing.</p></td>';


			if($internal_link=='true'){
			echo '<td><ul class="checkbox_list true_false"><input type="hidden" name="'.$field['name'].'[internal]" value="0" />';
				$selected = ($value['internal'] == 1) ? 'checked="yes"' : '';
				echo '<li><label><input type="checkbox" name="'.$field['name'].'[internal]" value="1" ' . $selected . ' />';
				echo '</label></li></ul></td>';

			}else{
				echo '<input type="hidden" name="'.$field['name'].'[internal]" value="0" />';
			}


		echo  '</tr>
		</tbody>
			</table>';



	}


	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/

	function create_options($field)
	{



		// defaults
		$field = array_merge($this->defaults, $field);


		// key is needed in the field names to correctly save the data
		$key = $field['name'];

		// defaults
		//$field['website_title'] = isset($field['website_title']) ? $field['website_title'] : '';

		//$field['internal_link'] = isset($field['internal_link']) ? $field['internal_link'] : '';

?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Show Title?",'acf'); ?></label>
				<p class="description">If "Yes" than the user will have a field to enter a address title</p>
			</td>
			<td>
				<?php

		do_action('acf/create_field', array(
				'type' => 'radio',
				'name' => 'fields['.$key.'][website_title]',
				'value' => $field['website_title'],
				'layout' => 'horizontal',
				'choices' => array(
					'true' => __('Yes','acf'),
					'false' => __('No','acf')
				)
			));


?>
			</td>

		</tr>

		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Open in Current Window?",'acf'); ?></label>
				<p class="description">If "Yes" than the user can check a box to have the link be Internal</p>
			</td>
			<td>
				<?php
		do_action('acf/create_field', array(
				'type' => 'radio',
				'name' => 'fields['.$key.'][internal_link]',
				'value' => $field['internal_link'],
				'layout' => 'horizontal',
				'choices' => array(
					'true' => __('Yes','acf'),
					'false' => __('No','acf)
				)
			));
?>
			</td>

		</tr>


		<?php
	}

	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{

	}


	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add css and javascript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{

	}


	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{

	}


	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{

	}




	/** Custom functions to validate URL**/

	function nicifyUrl($url) {
    $url = urldecode(strtolower($url));
    $url = $this->stripit($url);
    // clean up url path
    $url = explode("/",$url);
    $arrUrl = parse_url($url[0]);
    $urlRet = $arrUrl['path'];
    // valid?
    if($this->validateTheUrl($urlRet)){
        return $urlRet;
    }
    else{
        return "Invalid URL";
    }
}
function stripit($url){
   $url = trim($url);
   $url = preg_replace("/^(http:\/\/)*(www.)*/is", "", $url);
   $url = preg_replace("/\/.*$/is" , "" ,$url);
   return $url;
}
function validateTheUrl($url){
    if (!preg_match("#[a-z0-9-_.]+\.[a-z]{2,4}#i",$url)) {
        return false;
    }
    else if(strpos($url,"@") !== false){
        return false;
    }
    else{
        return true;
    }
}


}


// create field
new Website_field();






/*--------------------------------------- fuctions.php ----------------------------------------------------

add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('fields/my-field.php');
}
*/

?>
