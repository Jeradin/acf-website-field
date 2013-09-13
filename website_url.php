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
			'default_value'              => '',
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
			$the_url = $this->nicifyUrl( $value['url'] );

			//If show title
			if($website_title==1 && !empty($value['title'])){ $title = $value['title'];}else{$title = $the_url;};

			$value ='<a href="http://'.$the_url.'" '.$external.'>'.$title.'</a>';


			// return link
			if($the_url!='Invalid URL'){
				return $value;
			}else{
				return $the_url;
			}


		}
		else
		{

			//return array
			$value = array(
				'title' => $value['title'],
				'url' => $value['url'],
				'external' => $value['internal']
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




	function create_field($field)
	{


		$field = array_merge( $this->defaults, $field );
		extract( $field, EXTR_SKIP ); //Declare each item in $field as its own variable i.e.: $name, $value, $label, $time_format, $date_format and $show_week_number

		// key is needed in the field names to correctly save the data
		$key 	= $field['name'];
		$class 	= $field['class'];

		$value 		= ( isset($field['value']) ) ? $field['value'] : false;
		$link_url 	= ( isset($value['url']) ) ? $value['url'] : '';
		$link_title = ( isset($value['title']) ) ? $value['title'] : '';


		echo  '<table class="widefat "><thead><tr>';

		 if(  $field['website_title']  ) echo '<th class="title"><span>Title</span></th>';
		echo '<th class="url"><span>URL</span></th>';
		if ($field['internal_link']==1)echo '<th class="internal" style="width:10%;"><span>Current Window</span></th>';

		echo '</tr></thead><tbody><tr>';



	    if(  $field['website_title']  ){
				echo '<td><input type="text" value="' . $link_title . '" id="' . $key . '" class="' . $class . '" name="'.$key.'[title]" /></td>';
		} else {
				//echo '<input type="hidden" value="" id="' . $field['name'] . '" class="' . $class . '" name="'.$key.'[title]" />';
		}

echo '<td><input type="text" value="' . $link_url . '" id="' . $field['name'] . '" class="' . $class . '" name="'.$key.'[url]" /><p class="description">You can exclude http://, the field will add it, if missing.</p></td>';


			if($field['internal_link']==1){
			echo '<td><ul class="checkbox_list true_false"><input type="hidden" name="'.$key.'[internal]" value="0" />';
				$selected = (isset($field['value']['internal']) && $field['value']['internal'] == 1) ? 'checked="yes"' : '';
				echo '<li><label><input type="checkbox" name="'.$key.'[internal]" value="1" ' . $selected . ' />';
				echo '</label></li></ul></td>';

			}else{
				//echo '<input type="hidden" name="'.$key.'[internal]" value="0" />';
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
				<label><?php _e("Open in Current Window?",'acf'); ?></label>
				<p class="description">If "Yes" than the user can check a box to have the link open in current window.</p>
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




		/** Custom functions to validate URL**/

		function nicifyUrl($url) {
			$fullurl = $url;
		    $url = urldecode(strtolower($url));
		    $url = $this->stripit($url);
		    // clean up url path
		    $url = explode("/",$url);
		    $arrUrl = parse_url($url[0]);
		    $urlRet = $arrUrl['path'];
		    // valid?
		    if($this->validateTheUrl($urlRet)){
		        return $fullurl;
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


?>
