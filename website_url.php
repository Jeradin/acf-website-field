<?php

/*
 *	Advanced Custom Fields - New field template
 *
 *	Create your field's functionality below and use the function:
 *	register_field($class_name, $file_path) to include the field
 *	in the acf plugin.
 *
 *	Documentation:
 *
 */


class Website_field extends acf_Field
{

	/*--------------------------------------------------------------------------------------
	*
	*	Constructor
	*	- This function is called when the field class is initalized on each page.
	*	- Here you can add filters / actions and setup any other functionality for your field
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function __construct($parent)
	{
		// do not delete!
		parent::__construct($parent);

		// set name / title
		$this->name = 'website'; // variable name (no spaces / special characters / etc)
		$this->title = __("Website",'acf'); // field label (Displayed in edit screens)

	}


	/*--------------------------------------------------------------------------------------
	*
	*	create_options
	*	- this function is called from core/field_meta_box.php to create extra options
	*	for your field
	*
	*	@params
	*	- $key (int) - the $_POST obejct key required to save the options to the field
	*	- $field (array) - the field object
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function create_options($key, $field)
	{
		// defaults
		$field['website_title'] = isset($field['website_title']) ? $field['website_title'] : '';

		$field['internal_link'] = isset($field['internal_link']) ? $field['internal_link'] : '';

?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Show Title?",'acf'); ?></label>
			</td>
			<td>
				<?php
		$this->parent->create_field(array(
				'type' => 'radio',
				'name' => 'fields['.$key.'][website_title]',
				'value' => $field['website_title'],
				'layout' => 'horizontal',
				'choices' => array(
					'true' => __('Yes',acf),
					'false' => __('No',acf)
				)
			));
?>
			</td>

		</tr>

		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Open in new Window?",'acf'); ?></label>
			</td>
			<td>
				<?php
		$this->parent->create_field(array(
				'type' => 'radio',
				'name' => 'fields['.$key.'][internal_link]',
				'value' => $field['internal_link'],
				'layout' => 'horizontal',
				'choices' => array(
					'true' => __('Yes',acf),
					'false' => __('No',acf)
				)
			));
?>
			</td>

		</tr>


		<?php
	}




	/*--------------------------------------------------------------------------------------
	*
	*	create_field
	*	- this function is called on edit screens to produce the html for this field
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function create_field($field)
	{

		echo  '<table class="widefat "><thead><tr>';

		if ($field['website_title'] == 'true')echo '<th class="title"><span>Title</span></th>';
		echo '<th class="url"><span>URL</span></th>';
		if ($field['internal_link'] == 'true')echo '<th class="internal" style="width:15.75%;"><span>Open in New Window?</span></th>';

		echo '</tr></thead><tbody><tr>';


		// defaults
		if(empty($field['value'])) $field['value'] = array('title' => '', 'url' => '', 'internal' => '');

		// foreach choices

		foreach($field['value'] as $key => $value)
		{
			echo '<td>';
			if($key=='internal' && $field['internal_link'] == 'true'){

				echo '<ul class="checkbox_list true_false"><input type="hidden" name="'.$field['name'].'['.$key.']" value="0" />';
				$selected = ($value == 1) ? 'checked="yes"' : '';
				echo '<li><label><input type="checkbox" name="'.$field['name'].'['.$key.']" value="1" ' . $selected . ' />';
				echo '</label></li></ul>';



			}elseif($key=='title'  && $field['website_title'] == 'true'){


				echo '<input type="text" value="' . $value . '" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '['.$key.']" />';



			}elseif($key=='url'){

				echo '<input type="text" value="' . $value . '" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '['.$key.']" />';
			};

			echo '</td>';


		}

		echo  '</tr></tbody>
			</table>';



	}







	/*--------------------------------------------------------------------------------------
	*
	*	admin_head
	*	- this function is called in the admin_head of the edit screen where your field
	*	is created. Use this function to create css and javascript to assist your
	*	create_field() function.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function admin_head()
	{
?>
		<style type="text/css">


		</style>
		<?php
	}





	/*--------------------------------------------------------------------------------------
	*
	*	pre_save_field
	*	- called just before saving the field to the database.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function pre_save_field($field)
	{
		// defaults
		$field_links = isset($field['website']) ? $field_links = $field['website'] : $field_links = array('title' => '', 'url' => '', 'internal' => '');
	
	
			// vars
		$new_choices = array();


		// key => value
		foreach($field_links as $choice)
		{
			$choice =  ereg_replace("(https?)://", "", $choice);
			$new_choices[trim($choice)] = trim($choice);
		}

		// update choices
		$field['website'] = $new_choices;

		// return updated field
		return $field;

	}





	/*--------------------------------------------------------------------------------------
	*
	*	get_value_for_api
	*	- called from your template file when using the API functions (get_field, etc).
	*	This function is useful if your field needs to format the returned value
	*
	*	@params
	*	- $post_id (int) - the post ID which your value is attached to
	*	- $field (array) - the field object.
	*
	*	@author Elliot Condon
	*	@since 3.0.0
	*
	*-------------------------------------------------------------------------------------*/

	function get_value_for_api($post_id, $field)
	{
		// get value
		$value = $this->get_value($post_id, $field);

		// format value
		
			//If an external link
			if($value['internal'] == '0'){ $external = 'target="_blank"';};
			
			//If show title
			if(!empty($value['title'])){ $title = $value['title'];}else{$title = $value['url'];};
		

				$value ='<a href="http://'.$value['url'].'" '.$external.'>'.$title.'</a>';
		
		
		

		// return value
		return $value;

	}

}

?>