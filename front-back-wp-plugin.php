<?php

/*
* Plugin Name: Profile Plugin
* Description: shortcode: [shortcode-profile]
* Version: 
* Author: Mik Neri
* Author URI: 
*/


add_action( 'wp_enqueue_scripts', 'front_back_wp_scripts' );
function front_back_wp_scripts() {
	
	// wp_fb_style( 'wp_enqueue_style', plugins_url('/css/style.css', __FILE__) );
	// wp_fb_style( 'fb-credits-toggle-style', plugins_url('/css/home-boxes.css', __FILE__) );
	// wp_fb_script( 'fb-function', plugins_url( '/js/sc-function.js', __FILE__ ), array('jquery'), '1.0', true );

	// wp_localize_script( 'fb-function', 'postscfunction', array(
	// 	'ajax_url' => admin_url( 'admin-ajax.php' )
	// ));

}

class Services_credits_mik {

	// // class instance
	static $instance;

	// class constructor
	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
	}


	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {


		$hook = add_menu_page(
			'Profile Settings',
			'Profile Settings',
			'manage_options',
			'profile_settings',
			[ $this, 'front_back_wp_mik' ]
		);


	}


	public function front_back_wp_mik() {

		?>
		
		<div class="wrap">
			<h2>Profile Settings</h2> 

			<br/>
			<form method="post" action="">
			Field 1 <input type="text" name="field1"><br/>
			Field 1 <input type="text" name="field1"><br/>
			Field 1 <input type="text" name="field1"><br/>
			</form>

		</div>

		<?php
	}



	/**
	 * Purchase Bulk Credits Page
	 */
	public static function profile_plugin() {

		if(is_user_logged_in())
		{
 
		    $current_user = wp_get_current_user();
		    //$customAPIKEY  = get_field('custom_api_key','option');// name of the admin
		    //$customAPIID  = get_field('custom_api_id','option');// Email Title for the admin
		    //echo "Email Address: " . $current_user->user_email; 
		    //$postargs = "http://api.ontraport.com/1/objects?objectID=0&performAll=true&sortDir=asc&condition=email%3D'testing@umbrellasupport.co.uk'&searchNotes=true";
		    $postargs = "http://api.ontraport.com/1/objects?objectID=0&performAll=true&sortDir=asc&condition=email%3D'".$current_user->user_email."'&searchNotes=true";
		   
		    $session = curl_init();
		    curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt ($session, CURLOPT_URL, $postargs);
		    //curl_setopt ($session, CURLOPT_HEADER, true);
		    curl_setopt ($session, CURLOPT_HTTPHEADER, array(
		      'Api-Appid:2_7818_AFzuWztKz',
		      'Api-Key:fY4Zva90HP8XFx3'
		    ));
		    $response = curl_exec($session); 
		    curl_close($session);
		    //header("Content-Type: text");
		    //echo "CODE: " . $response;
		    $getName = json_decode($response);  

		    //echo '<br /><br />Name: '. $getName->data[0]->f1549;
	   }

	 //   define( 'WPCA_VERSION', '1.0' );

		// function wp_custom_avatar_customize_register( $wp_customize ) {

		//     $wp_customize->add_section( 'wp_custom_avatar_section' , array(
		//         'title'      => __( 'WP Custom Avatar', 'wp-custom-avatar' ),
		//         'priority'   => 200
		//     ) );

		//     $wp_customize->add_setting( 'wp_custom_avatar' );

		//     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wp_custom_avatar', array(
		//         'label'    => __( 'Upload Custom Avatar', 'wp-custom-avatar' ),
		//         'section'  => 'wp_custom_avatar_section',
		//         'settings' => 'wp_custom_avatar',
		//     ) ) );
		// }
		// add_action( 'customize_register', 'wp_custom_avatar_customize_register' );


		// function wp_custom_avatar($avatar_defaults) {
		//     $avatar = get_theme_mod( 'wp_custom_avatar' );
		//     $avatar_defaults[$avatar] = get_bloginfo('name');
		//     return $avatar_defaults;
		// } 
		// add_filter( 'avatar_defaults', 'wp_custom_avatar' );


	   $businessdesc = $getName->data[0]->title;
	   $acount_id  = $getName->data[0]->id;
	   $firstname = $getName->data[0]->firstname;
	   $lastname = $getName->data[0]->lastname;
	   $address = $getName->data[0]->address;
	   $city = $getName->data[0]->city;
	   $country = $getName->data[0]->country;
	   $state = $getName->data[0]->state;
	   $zip = $getName->data[0]->zip;
	   $email = $getName->data[0]->email;
	   $homephone = $getName->data[0]->home_phone;
	   $cellphone = $getName->data[0]->cell_phone;
	   $company = $getName->data[0]->company;
	   $address2 = $getName->data[0]->address2;
	   $companynumber = $getName->data[0]->f1564;
	   $officephone = $getName->data[0]->office_phone;
	   $fax = $getName->data[0]->fax;
	   $website = $getName->data[0]->website;
	   $town = $getName->data[0]->Town_340;
	   $packagelevel = $getName->data[0]->f1548;
	   $accountmanager = $getName->data[0]->f1546;
	   $accountbalance = $getName->data[0]->f1547;
	   $owner = $getName->data[0]->owner;



	   if( !isset($getName->data[0]->id) ){

	   	$acount_id = 0;

	   }

	   // echo '<pre>';
	   // var_dump($getName);
	   // echo '</pre>';

	   $wpdb_b = new wpdb( "dbo640728737", "1qazxsw2!QAZXSW@", "db640728737", "db640728737.db.1and1.com" );

		if ( !empty($_FILES['imageUpload']) ) {
					
			$targetFolder = './wp-content/uploads/'; // Relative to the root
			$img_filename = "";

			$images = $_FILES['imageUpload'];

		    $tempFile = $images['tmp_name'];
			$fileParts = pathinfo($images['name']);
			$targetPath = $targetFolder;
			$img_filename = time()."_".mt_rand().".".$fileParts['extension'];
			$targetFile = $targetPath . '/' . $img_filename;

			if(move_uploaded_file($tempFile,$targetFile))
			{
				// $current_profile_pic = wp_upload_dir().$img_filename;

				// $data = '<contact id="'.$acount_id.'">
				// 		    <Group_Tag name="Umbrella">	
				// 		        <field name="">'.$current_profile_pic.'</field>
				// 		    </Group_Tag>
				// 		</contact>';

				// $data = urlencode(urlencode($data));
				// // Replace the strings with your API credentials located in Admin > OfficeAutoPilot API Instructions and Key Manager
				// $appid = "2_7818_zjPV3pkvN";
				// $key = "PuXNaUS4sd46b69";
				// $reqType= "update";
				// $postargs = "appid=".$appid."&key=".$key."&return_id=1&reqType=".$reqType."&data=".$data;
				// $request = "http://api.ontraport.com/cdata.php";
				// $session = curl_init($request);
				// curl_setopt ($session, CURLOPT_POST, true);
				// curl_setopt ($session, CURLOPT_POSTFIELDS, $postargs);
				// curl_setopt($session, CURLOPT_HEADER, false);
				// curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				// $response = curl_exec($session);
				// curl_close($session);

				// START WP UPLOAD IMAGE CODE


				echo wp_upload_dir();
				//$img_filename = wp_upload_dir().$img_filename;
			
			$rows = $wpdb_b->get_results( "SELECT * FROM wp_user_imguploads WHERE uid_PartnerID=".$acount_id );



			if( count($rows) > 0 ){
			  
			 $wpdb_b->get_results( "UPDATE wp_user_imguploads SET ui_URL='".$img_filename."' WHERE uid_PartnerID=".$acount_id );
			}
			else{
			 
			 $sql = "INSERT INTO `wp_user_imguploads` (ui_URL, uid_PartnerID) values ('".$img_filename."',".$acount_id.")";

			 $wpdb_b->query($sql);
			}
			// END WP UPLOAD IMAGE CODE

			}

			
		    
		}

		if( $_POST['from_tab'] == 'tab_personal' ){

			$data = '<contact id="'.$acount_id.'">
			            <Group_Tag name="Contact Information"> 
			               <field name="First Name">'.$_POST['pfirstname'].'</field>
			               <field name="Last Name">'.$_POST['plastname'].'</field>
			               <field name="Address">'.$_POST['paddress'].'</field>
			               <field name="City">'.$_POST['pcity'].'</field>
			               <field name="Zip Code">'.$_POST['ppostcode'].'</field>
			               <field name="Home Phone">'.$_POST['phomephone'].'</field>
			               <field name="Cell Phone">'.$_POST['pcellphone'].'</field>
			            </Group_Tag>
         			</contact>';

			$data = urlencode(urlencode($data));

			   $appid = "2_7818_AFzuWztKz";
			   $key = "fY4Zva90HP8XFx3";
			   $reqType= "update";
			   $postargs = "appid=".$appid."&key=".$key."&return_id=1&reqType=".$reqType."&data=".$data;
			   $request = "http://api.ontraport.com/cdata.php";
			   $session = curl_init($request);
			   curl_setopt ($session, CURLOPT_POST, true);
			   curl_setopt ($session, CURLOPT_POSTFIELDS, $postargs);
			   curl_setopt($session, CURLOPT_HEADER, false);
			   curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			   $response = curl_exec($session);
			   curl_close($session);


			   $notificationmsg = '

			   					<style>
			   					.alert {
			   					    padding: 20px;
			   					    background-color: #f44336;
			   					    color: white;
			   					}

			   					.closebtn {
			   					    margin-left: 15px;
			   					    color: white;
			   					    font-weight: bold;
			   					    float: right;
			   					    font-size: 22px;
			   					    line-height: 20px;
			   					    cursor: pointer;
			   					    transition: 0.3s;
			   					}

			   					.closebtn:hover {
			   					    color: black;
			   					}
			   					</style>

			   					<div class="alert">
			   					  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
			   					  <strong>Success!</strong> Update Successful
			   					</div>


			   					';

			   echo $notificationmsg;


		}

		if( $_POST['from_tab'] == 'tab_business' ){


			$data = '<contact id="'.$acount_id.'">
			            <Group_Tag name="Contact Information"> 
			               <field name="Company">'.$_POST['bcompany'].'</field>
			               <field name="Address">'.$_POST['baddress'].'</field>
			               <field name="Town">'.$_POST['btown'].'</field>
			               <field name="City">'.$_POST['bcity'].'</field>
			               <field name="Zip Code">'.$_POST['bpostcode'].'</field>
			               <field name="Company Number">'.$_POST['bcompanynumber'].'</field>
			               <field name="Office Phone">'.$_POST['bofficephone'].'</field>
			               <field name="Cell Phone">'.$_POST['bmobilephone'].'</field>
			               <field name="Company">'.$_POST['bcompany'].'</field>
			               <field name="Website">'.$_POST['bwebsite'].'</field>
			            </Group_Tag>
         			</contact>';

			$data = urlencode(urlencode($data));

			   $appid = "2_7818_AFzuWztKz";
			   $key = "fY4Zva90HP8XFx3";
			   $reqType= "update";
			   $postargs = "appid=".$appid."&key=".$key."&return_id=1&reqType=".$reqType."&data=".$data;
			   $request = "http://api.ontraport.com/cdata.php";
			   $session = curl_init($request);
			   curl_setopt ($session, CURLOPT_POST, true);
			   curl_setopt ($session, CURLOPT_POSTFIELDS, $postargs);
			   curl_setopt($session, CURLOPT_HEADER, false);
			   curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			   $response = curl_exec($session);
			   curl_close($session);


			$notificationmsg2 = '

			   					<style>
			   					.alert {
			   					    padding: 20px;
			   					    background-color: #f44336;
			   					    color: white;
			   					}

			   					.closebtn {
			   					    margin-left: 15px;
			   					    color: white;
			   					    font-weight: bold;
			   					    float: right;
			   					    font-size: 22px;
			   					    line-height: 20px;
			   					    cursor: pointer;
			   					    transition: 0.3s;
			   					}

			   					.closebtn:hover {
			   					    color: black;
			   					}
			   					</style>

			   					<div class="alert">
			   					  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
			   					  <strong>Success!</strong> Update Successful
			   					</div>


			   					';

			   echo $notificationmsg2;


		}

		if( $_POST['from_tab'] == 'tab_biznetwork' ){


			//no fields in OP yet



		}


			$rows = $wpdb_b->get_results( "SELECT * FROM wp_user_imguploads WHERE uid_PartnerID=".$acount_id );

			$img_filename = $rows[0]->ui_URL;

		if(is_user_logged_in())
		{

		    $current_user = wp_get_current_user();
		    //$customAPIKEY  = get_field('custom_api_key','option');// name of the admin
		    //$customAPIID  = get_field('custom_api_id','option');// Email Title for the admin
		    //echo "Email Address: " . $current_user->user_email; 
		    //$postargs = "http://api.ontraport.com/1/objects?objectID=0&performAll=true&sortDir=asc&condition=email%3D'testing@umbrellasupport.co.uk'&searchNotes=true";
		    $postargs = "http://api.ontraport.com/1/objects?objectID=0&performAll=true&sortDir=asc&condition=email%3D'".$current_user->user_email."'&searchNotes=true";
		   
		    $session = curl_init();
		    curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt ($session, CURLOPT_URL, $postargs);
		    //curl_setopt ($session, CURLOPT_HEADER, true);
		    curl_setopt ($session, CURLOPT_HTTPHEADER, array(
		      'Api-Appid:2_7818_AFzuWztKz',
		      'Api-Key:fY4Zva90HP8XFx3'
		    ));
		    $response = curl_exec($session); 
		    curl_close($session);
		    //header("Content-Type: text");
		    //echo "CODE: " . $response;
		    $getName = json_decode($response);  

		    $current_profile_pic = $getName->data[0]->f1547;

		    //echo '<br /><br />Name: '. $getName->data[0]->f1549;
	   }

	   $current_profile_pic = 'https://fieldops.umbrellasupport.co.uk/wp-content/uploads/imageuploads/1666969737b8d11b72a78596a5cf9859.jpg';


		$content = '<script>

					</script>

					<style>

						/* TABS */
						 /* Style the list */
						ul.q-tab {
						    list-style-type: none;
						    margin: 0;
						    padding: 0;
						    overflow: hidden;
						    /*border: 1px solid #ccc;*/
						    background-color: #ffffff;
						    width: 100%;
						}

						/* Float the list items side by side */
						ul.q-tab li {
						  float: left !important;
						  width: 12.5% !important;
						  text-align: center;

						}

						/* Style the links inside the list items */
						ul.q-tab li a {
						    display: inline-block;
						    text-align: center;
						    padding: 5px 0;
						    text-decoration: none;
						    transition: 0.3s;

						    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ececec 0%, #fafafa 37%, #c8d7dc 100%) repeat scroll 0 0;
						    border-top: 1px solid #ddd;
						    border-left: 1px solid #ddd;
						    border-right: 1px solid #ddd;
						    border-radius: 0;
						    color: #000000;
						    font-size: 13px;
						    font-weight: 600;
						    line-height: 16px;
						    width: 100%;
						    height: 33px;
						    vertical-align: middle !important;
						    border-top-left-radius: 10px;
    						border-top-right-radius: 10px;
						}

						/* Change background color of links on hover */
						ul.q-tab li a:hover {background-color: #ddd;}

						/* Create an active/current tablink class */
						ul.q-tab li a:focus, .q-active {
						  background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #d7090a 0%, #d7090a 0%, #d7090a 100%) repeat scroll 0 0 !important;
						  border-left: 1px solid #ddd !important;
						  border-top: 1px solid #ddd !important;
						}


						/* Style the tab content */
						.q-tabcontent {
						    display: none;
						    padding: 15px !important;  
						    border: 1px solid #ddd;
						    border-top: none;
						    background: #ffffff;
						}
						.custom-package {
							width: 75%;
							font-size: 11px !important;
						}
						.custom-package-right {
							font-size: 11px !important;
						    width: 75%;
						}
						.custom-profile input{
							width: 85% !important;
						}
						.custom-textbox {
							border: 1px solid #cccaca;
						    min-height: 18px;
						    padding: 6px;
						}
						.custom-textbox-biz {
							border: 1px solid #cccaca;
						    min-height: 18px;
						    padding: 6px;
						    width: 90%;
						}
						.custom-textbox-pkg {
							border: 1px solid #cccaca;
						    min-height: 18px;
						    padding: 6px;
						    width: 90%;
						}
						.profile-button {
						    background: #d7090b none repeat scroll 0 0;
						    border: medium none;
						    color: #fff;
						    padding: 10px;
						    width: 49% !important;
						    text-align: center;
						}
						.business-button {
						    background: #d7090b none repeat scroll 0 0;
						    border: medium none;
						    color: #fff;
						    padding: 10px;
						    width: 89% !important;
						    text-align: center;
						}
						.biznetwork-button {
						    background: #d7090b none repeat scroll 0 0;
						    border: medium none;
						    color: #fff;
						    padding: 10px;
						    width: 88% !important;
						    text-align: center;
						}
						.water-mark {
						    min-height: 150px;
						    min-width: 150px;
						}
						.water-wrapper {
						    min-height: 300px;
						    min-width: 300px;
						}
						.profile-image-wrapper {
						    border: 2px solid #d7090b;
						    margin: 0 auto;
						    position: relative;
						    top: 14px;
						    width: 56%;
						    left: -10px;
						}
						.right-pos {
							position: relative;
							top: 85px;
						}
						.custom-package .package-details{
							padding: 10px;
							vertical-align: middle;
							font-size: 11px;

						}
						.custom-biznetwork {
							width: 75%;
							font-size: 11px !important;
						}
						.custom-biznetwork-left {
							width: 75%;
							font-size: 11px !important;
						}
						.custom-biznetwork-right {
							width: 75%;
							font-size: 11px !important;
						}
						.business-info h2 {
						    background: #d7090b none repeat scroll 0 0;
						    color: #fff;
						    font-size: 15px;
						    padding: 10px 13px;
						    width: 87%;
						}
						.package-details h2 {
						    background: #d7090b none repeat scroll 0 0;
						    color: #fff;
						    font-size: 15px;
						    padding: 10px 13px;
						    width: 87%;
						}
						.biznetwork-title h2 {
							background: #d7090b none repeat scroll 0 0 !important;
						    color: #fff !important;
						    font-size: 15px !important;
						    padding: 10px 13px !important;
						    width: 97% !important;
						}
						.biznetwork-title a {
							font-size: 18px;
						}
						.logo-wrapper {
						    background: #aba9aa none repeat scroll 0 0;
						    margin-top: 12px;
						    position: relative;
						    text-align: center;
						    width: 93%;
						}
						.logo-wrapper .file-upload {
						    bottom: -10px;
						    left: 17%;
						    margin: 10px;
						    overflow: hidden;
						    position: absolute;
						    width: 60%;
						    z-index: 9999999;
						}
						.logo-wrapper .btn-primary {
						    background-color: #d7090b !important;
						    border-color: #d7090b;
						    border-radius: 0;
						    color: #fff;
						}
						.water-wrapper {
						    min-height: 286px;
						    min-width: 300px;
						}

						
					</style>

					<ul class="q-tab">
					  <li><a style="vertical-align: middle;" href="javascript:void(0)" class="q-tablinks" tabtype="Personal" onclick="openCity(event, \'Personal\')" id="defaultOpen"><span style="position: relative; top:8px;">Personal</span></a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Business" onclick="openCity(event, \'Business\')"><span style="position: relative; top:8px;">Business</span></a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Package" onclick="openCity(event, \'Package\')"><span style="position: relative; top:8px;">Package</span></a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Metrics" onclick="openCity(event, \'Metrics\')"><span style="position: relative; top:8px;">Metrics</span></a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Reputationradar" onclick="location.href = \'https://testing.umbrellasupport.co.uk/reputation-radar/\'">Reputation Radar</a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Businessnetwork" onclick="openCity(event, \'Businessnetwork\')" id="defaultOpen">Business Network</a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Payments" onclick="location.href = \'https://testing.umbrellasupport.co.uk/balance-automatic-top-up/\'"><span style="position: relative; top:8px;">Payments</span></a></li>
					  <li><a href="javascript:void(0)" class="q-tablinks" tabtype="Other" onclick="location.href = \'https://testing.umbrellasupport.co.uk/my-account/\'"><span style="position: relative; top:8px;">Other</span></a></li>
					</ul>

					<div id="Personal" class="q-tabcontent">
	<div class="custom-profile">
	  	<table width="100%" class="personal-tab">
	  		<form method="post" action="">
	  		<input type="hidden" name="from_tab" value="tab_personal">
		  		<tr>
		  			<td width="50%"> 
	  					<span style="font-weight: bolder;">First Name</span><br/>
	  					<input class="custom-textbox" name="pfirstname" type="text" style="font-size: 13px !important;" value="'.$firstname.'"><br/>
	  					<span style="font-weight: bolder;">Last Name</span><br/>
	  					<input class="custom-textbox" name="plastname" type="text" style="font-size: 13px !important;" value="'.$lastname.'"><br/>
	  					<span style="font-weight: bolder;">Address</span><br/>
	  					<input class="custom-textbox" name="paddress" type="text" style="font-size: 13px !important;" value="'.$address.'"><br/>
	  					<span style="font-weight: bolder;">City</span><br/>
	  					<input class="custom-textbox" name="pcity" type="text" style="font-size: 13px !important;" value="'.$city.'"><br/>
	  					<span style="font-weight: bolder;">Country</span><br/>
	  					<input class="custom-textbox" type="text" style="font-size: 13px !important;" disabled value="'.$country.'"><br/>
	  					<span style="font-weight: bolder;">Postcode</span><br/>
	  					<input class="custom-textbox" name="ppostcode" type="text" maxlength="8" style="width: 65px !important;" style="font-size: 13px !important;" value="'.$zip.'"><br/>
	  					<span style="font-weight: bolder;">Email Address</span><br/>
	  					<input class="custom-textbox" type="text" style="font-size: 13px !important;" disabled value="'.$email.'"><br/>
	  					<span style="font-weight: bolder;">Home Phone</span><br/>
	  					<input class="custom-textbox" name="phomephone" type="text" maxlength="12" style="width: 90px !important;" style="font-size: 13px !important;" value="'.$homephone.'"><br/>
	  					<span style="font-weight: bolder;">Mobile Phone</span><br/>
	  					<input class="custom-textbox" name="pcellphone" type="text" maxlength="12" style="width: 90px !important;" style="font-size: 13px !important;" value="'.$cellphone.'"><br/><br/>
	  					<input class="profile-button" value="Update Personal Profile >" type="submit">

		  			 </td>
		  			<td width="50%">
		  				<div class="right-pos">
				  			<div class="profile-image-wrapper">
				  				<div class="water-wrapper water-mark">
									<img id="imageUploadPreview" src="https://testing.umbrellasupport.co.uk/wp-content/uploads/2017/01/my-fd-profile.jpg" alt="">
								</div>
							</div><br/><br/>
			  				<a class="btn btn-block btn-social btn-facebook" style="cursor: pointer; width: 66% !important; left: 45px;">
					            <span class="fa fa-facebook"></span> Validate Your Identity with Facebook >
					        </a>
				        </div>
		  			</td>
		  		</tr>
	  		</form>
	  	</table>
  	</div>

</div>

<div id="Business" class="q-tabcontent">

						<div class="custom-business">
							<form method="post" action="" enctype="multipart/form-data">
								<input type="hidden" name="from_tab" value="tab_business">
								<table width="100%" class="business-tab">
						  		
						  			<tr>
						  				<td width="50%">
							  				<div class="business-info">
							  					<h2>Business Details</h2>
							  					<span style="font-weight: bolder;">Name</span><br/>
							  					<input class="custom-textbox-biz" name="bcompany" type="text" style="font-size: 13px !important;" value="'.$company.'"><br/>
							  					<span style="font-weight: bolder;">Address Line 1</span><br/>
							  					<input class="custom-textbox-biz" name="baddress" type="text" style="font-size: 13px !important;" value="'.$address.'"><br/>
							  					<span style="font-weight: bolder;">Town</span><br/>
							  					<input class="custom-textbox-biz" name="btown" type="text" style="font-size: 13px !important;" value="'.$town.'"><br/>
							  					<span style="font-weight: bolder;">City</span><br/>
							  					<input class="custom-textbox-biz" name="bcity" type="text" style="font-size: 13px !important;" value="'.$city.'"><br/>
							  					<span style="font-weight: bolder;">Country</span><br/>
							  					<input class="custom-textbox-biz" type="text" style="font-size: 13px !important;" disabled value="'.$country.'"><br/>
							  					<span style="font-weight: bolder;">Postcode</span><br/>
							  					<input class="custom-textbox-biz" name="bpostcode" type="text" maxlength="8" style="width: 65px !important;" style="font-size: 13px !important;" value="'.$zip.'"><br/>
							  					<span style="font-weight: bolder;">Company Number</span><br/>
							  					<input class="custom-textbox-biz" name="bcompanynumber" type="text" maxlength="12" style="width: 90px !important;" style="font-size: 13px !important;" value="'.$companynumber.'" ><br/>
							  					<span style="font-weight: bolder;">Office Phone</span><br/>
							  					<input class="custom-textbox-biz" name="bofficephone" type="text" maxlength="12" style="width: 90px !important;" style="font-size: 13px !important;" value="'.$officephone.'"><br/>
							  					<span style="font-weight: bolder;">Mobile Phone</span><br/>
							  					<input class="custom-textbox-biz" name="bmobilephone" type="text" maxlength="12" style="width: 90px !important;" style="font-size: 13px !important;" value="'.$cellphone.'"><br/><br/>
							  					<input class="business-button" value="Update Business Profile >" type="submit" name="submit">
							  				</div>
						  				</td>
						  				<td width="50%"">



						  					<div class="logo-wrapper">
												
												<input id="post_id" name="post_id" value="989" type="hidden">
												<input id="thumbnailImage_nonce" name="thumbnailImage_nonce" value="a1c314818b" type="hidden">
												<input name="_wp_http_referer" value="/business-profile/" type="hidden">
												<div class="water-wrapper water-mark">
													<img id="imageUploadPreview" src="https://testing.umbrellasupport.co.uk/wp-content/uploads/'.$img_filename.'" alt="">
												</div>
											</div>
											<div style="padding: 10px 16px; text-align: center; width: 368px; background-color:#D9070a; border-color: #d9070a;">
												<input name="imageUpload" id="fileToUpload" accept="image/*" type="file">
											</div><br/><br/>
											<div class="business-info">
												<span style="font-weight: bolder;">Business Name</span><br/>
							  					<input class="custom-textbox-biz" name="bcompany" type="text" style="font-size: 13px !important;" value="'.$company.'"><br/>
							  					<span style="font-weight: bolder;">Website</span><br/>
							  					<input class="custom-textbox-biz" name="bwebsite" type="text" style="font-size: 13px !important;" value="'.$website.'"><br/>
						  					</div>

						  				</td>
						  			</tr>
						  		</table>
						  	</form>
						</div>

					</div>

					<div id="Package" class="q-tabcontent">
						<table width="100%" class="package-tab">
							<form method="post">
								<td width="50%">
									<div class="custom-package">
										<div class="package-details">
						  					<h2>Package Details</h2>
						  					<span style="font-weight: bolder;">Partner ID</span><br/>
						  					<input disabled="disabled" class="custom-textbox-pkg" type="text" maxlength="6" style="width: 60px !important;" style="font-size: 13px !important;" value="'.$acount_id.'"><br/>
						  					<span style="font-weight: bolder;">Account Manager</span><br/>
						  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value="'.$owner.'"><br/>
						  					<span style="font-weight: bolder;">Package Level</span><br/>
						  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value="'.$packagelevel.'"><br/>
						  				</div>
					  				</div>
									</td>
									<td width="50%">
										<div class="custom-package-right">
											<br/><br/><br/><br/><br/>
					  					<span style="font-weight: bolder;">Account Balance</span><br/>
					  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value="'.$accountbalance.'"><br/>
					  					<span style="font-weight: bolder;">Free Phone Calls</span><br/>
					  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value=""><br/>
					  					<span style="font-weight: bolder;">Free Live Chat Msgs</span><br/>
					  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value=""><br/>
					  					<span style="font-weight: bolder;">Remaining Calls This Month</span><br/>
					  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value=""><br/>
					  					<span style="font-weight: bolder;">Remaining Live Chats This Month</span><br/>
					  					<input disabled="disabled" class="custom-textbox-pkg" type="text" style="font-size: 13px !important;" value=""><br/>
										</div>
									</td>
								</form>
							</table>

					</div>

					<div id="Metrics" class="q-tabcontent">
					  
						Coming Soon...

					</div>

					<div id="Businessnetwork" class="q-tabcontent">

						<table width="100%" class="biznetwork-tab">
							<form method="post">
								<div class="biznetwork-title">
									<h2> BookPhoneCall.com Listing </h2><br/>
									<center><a> https://www.bookphonecall.com/?business='.$acount_id.' </a></center><br/><br/>
								</div> 
								<tr>
									<td width="50%">
										<div class="custom-biznetwork-left">
											<input type="hidden" name="from_tab" value="tab_biznetwork">
											<span style="font-weight: bolder;">Business Description</span>
						  					<textarea style="margin-top: 10px; min-height: 120px; width: 92%;" style="font-size: 13px !important;"> '.$businessdesc.' </textarea><br/><br/>
						  					<input class="biznetwork-button" value="Update Information >" disabled type="submit">
										</div>
									</td>
									<td width="50%">
										<div class="custom-biznetwork-right">
											<span style="font-weight: bolder;">Business Bullet Points</span><br/>
						  					<input class="custom-textbox-pkg" type="text" style="font-size: 13px !important;"><br/>
						  					<input class="custom-textbox-pkg" type="text" style="font-size: 13px !important;"><br/>
						  					<input class="custom-textbox-pkg" type="text" style="font-size: 13px !important;"><br/>
						  					<input class="custom-textbox-pkg" type="text" style="font-size: 13px !important;"><br/>
						  					<input class="custom-textbox-pkg" type="text" style="font-size: 13px !important;"><br/>
										</div>
									</td>
								</tr>
							</form>
						</table>

					</div>

					

		';


		return $content;
	}


	/**
	 * ??
	 */
	// public function services_queue() {

		
	// }


	/** Singleton instance */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
		self::$instance = new self();
		}

		return self::$instance;
	}

}

add_action( 'plugins_loaded', function () {
	Services_credits_mik::get_instance();
} );

// add_shortcode( 'services-queue', array( 'Services_credits_mik', 'services_queue' ) );
add_shortcode( 'shortcode-profile', array( 'Services_credits_mik', 'profile_plugin' ) );


