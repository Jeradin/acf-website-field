<?php

/*
*  Website URL
*
*  TThis field lets you add website links with titles and a checkbox to make an external link or internal link.
*
*  @since	1.1
*  @date	06/24/2013
*
*  @info	https://github.com/Jeradin/acf-website-field
*/

class Website_field extends acf_Field
{

	// vars
	var  $defaults;

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
			'default_value'      => '',
			'internal_link'      => 0,
			'website_title'      => 0,
			'output_format'      => 0

		);


		// do not delete!
    	parent::__construct();
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

		// validate
		if( empty($value['url'] ) )
		{
			return false;
		}

		// defaults
		$field = array_merge($this->defaults, $field);
		extract( $field, EXTR_SKIP ); //Declare each item in $field as its own variable i.e.: $name, $value, $label, $time_format, $date_format and $show_week_number


		// format
		if( $field['output_format'] == 0 )
		{

			// format value

			$external = 'target="_blank"';
			//If an external link
			if(  $internal_link==1  && !empty($value['internal']) ){ $external = '';};

			// get value
			$the_url =  $value['url'];
			//var_dump( $this->validateTheUrl( $value['url'] ) );
			//If show title
			if($website_title==1 && !empty($value['title'])){ $title = $value['title'];}else{$title = $the_url;};

			// if the URL excludes the http://, add it
			if ( !preg_match("@^https?://@", $the_url ) ) $the_url = 'http://' . $the_url;
			$value ='<a href="'.$the_url.'" '.$external.'>'.$title.'</a>';



				return $value;



		}
		else
		{

			//return array
			$value = array(
				'title' => ( !empty( $value['title'] ) ) ? $value['title'] : '',
				'url' => $value['url'],
				'external' => ( !empty($value['internal'] ) ) ? $value['internal'] : ''
			);

			return $value;


		}


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
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used

		// register ACF scripts
		//wp_register_script( 'acf-website-validation', plugins_url( 'acf-website-field.js', __FILE__ ), array('acf-input'), $this->settings['version'] );
		//wp_register_style( 'acf-input-link_picker', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] );

		// scripts



	}



	function create_field($field)
	{

		$e = '';
		$field = array_merge( $this->defaults, $field );
		extract( $field, EXTR_SKIP ); //Declare each item in $field as its own variable i.e.: $name, $value, $label, $time_format, $date_format and $show_week_number

		// key is needed in the field names to correctly save the data
		$key 	= $field['name'];
		$class 	= $field['class'];

		$value 		= ( isset($field['value']) ) ? $field['value'] : false;
		$link_url 	= ( isset($value['url']) ) ? $value['url'] : '';
		$link_title = ( isset($value['title']) ) ? $value['title'] : '';

		if(  $field['website_title'] ||  $field['internal_link']==1 ){
			echo  '<table class="widefat "><thead><tr>';

			 if(  $field['website_title']  ) echo '<th class="title"><span>Title</span></th>';
			echo '<th class="url"><span>URL</span></th>';
			if ($field['internal_link']==1)echo '<th class="internal"><span>Window Target</span></th>';

			echo '</tr></thead><tbody><tr>';



		    if(  $field['website_title']  ){
					$e .= '<td><input type="text" value="' . $link_title . '" id="' . $key . '" class="' . $class . '" name="'.$key.'[title]"  placeholder="enter title" /></td>';
			}

	$e .= '<td><input type="url" value="' . $link_url . '" id="' . $field['name'] . '" class="' . $class . '  urlValidate" name="'.$key.'[url]" placeholder="http://www.example.com/" /></td>';


				if($field['internal_link']==1){
				$e .= '<td><input type="hidden" name="'.$key.'[internal]" value="0" />';
					$selected = (isset($field['value']['internal']) && $field['value']['internal'] == 1) ? 'checked="yes"' : '';
					$e .= '<label><input type="checkbox" name="'.$key.'[internal]" value="1" ' . $selected . ' />';
					$e .= 'Open link in a current window</label></td>';

				}


			$e .= '</tr></tbody></table>';

		}else{
			// render
			$e .= '<div class="acf-input-wrap acf-website">';
			$e .= '<input type="url" value="' . $link_url . '" id="' . $field['name'] . '" class="' . $class . '  urlValidate" name="'.$key.'[url]" placeholder="http://www.example.com/" />';
			$e .= '</div>';
		};




		// return
		echo $e;


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
					1 => __('Yes','acf'),
					0 => __('No','acf')
				)
			));


?>
			</td>

		</tr>

		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Option to open in Current Window",'acf'); ?></label>
				<p class="description">If "Yes" than the user can check a box to have the link open in current window instead of the default action of always opening in new window.</p>
			</td>
			<td>
				<?php
		do_action('acf/create_field', array(
				'type' => 'radio',
				'name' => 'fields['.$key.'][internal_link]',
				'value' => $field['internal_link'],
				'layout' => 'horizontal',
				'choices' => array(
					1 => __('Yes','acf'),
					0 => __('No','acf')
				)
			));
?>
			</td>

		</tr>
				<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Return array instead of Link",'acf'); ?></label>
				<p class="description">If "Yes" than the get_field will return an array</p>
			</td>
			<td>
				<?php
		do_action('acf/create_field', array(
				'type' => 'radio',
				'name' => 'fields['.$key.'][output_format]',
				'value' => $field['output_format'],
				'layout' => 'horizontal',
				'choices' => array(
					1 => __('Yes','acf'),
					0 => __('No','acf')
				)
			));
?>
			</td>

		</tr>

		<?php
	}








}


// create field
new Website_field();


?>
