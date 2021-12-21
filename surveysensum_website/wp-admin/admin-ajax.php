<?php
/**
 * WordPress Ajax Process Execution
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing Ajax process.
 *
 * @since 2.1.0
 */
define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

/** Load WordPress Bootstrap */
require_once dirname( __DIR__ ) . '/wp-load.php';

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
header( 'X-Robots-Tag: noindex' );

// Require an action parameter.
if ( empty( $_REQUEST['action'] ) ) {
	wp_die( '0', 400 );
}

/** Load WordPress Administration APIs */
require_once ABSPATH . 'wp-admin/includes/admin.php';

/** Load Ajax Handlers for WordPress Core */
require_once ABSPATH . 'wp-admin/includes/ajax-actions.php';

send_nosniff_header();
nocache_headers();

/** This action is documented in wp-admin/admin.php */
do_action( 'admin_init' );

$core_actions_get = array(
	'fetch-list',
	'ajax-tag-search',
	'wp-compression-test',
	'imgedit-preview',
	'oembed-cache',
	'autocomplete-user',
	'dashboard-widgets',
	'logged-in',
	'rest-nonce',
);

$core_actions_post = array(
	'oembed-cache',
	'image-editor',
	'delete-comment',
	'delete-tag',
	'delete-link',
	'delete-meta',
	'delete-post',
	'trash-post',
	'untrash-post',
	'delete-page',
	'dim-comment',
	'add-link-category',
	'add-tag',
	'get-tagcloud',
	'get-comments',
	'replyto-comment',
	'edit-comment',
	'add-menu-item',
	'add-meta',
	'add-user',
	'closed-postboxes',
	'hidden-columns',
	'update-welcome-panel',
	'menu-get-metabox',
	'wp-link-ajax',
	'menu-locations-save',
	'menu-quick-search',
	'meta-box-order',
	'get-permalink',
	'sample-permalink',
	'inline-save',
	'inline-save-tax',
	'find_posts',
	'widgets-order',
	'save-widget',
	'delete-inactive-widgets',
	'set-post-thumbnail',
	'date_format',
	'time_format',
	'wp-remove-post-lock',
	'dismiss-wp-pointer',
	'upload-attachment',
	'get-attachment',
	'query-attachments',
	'save-attachment',
	'save-attachment-compat',
	'send-link-to-editor',
	'send-attachment-to-editor',
	'save-attachment-order',
	'media-create-image-subsizes',
	'heartbeat',
	'get-revision-diffs',
	'save-user-color-scheme',
	'update-widget',
	'query-themes',
	'parse-embed',
	'set-attachment-thumbnail',
	'parse-media-shortcode',
	'destroy-sessions',
	'install-plugin',
	'update-plugin',
	'crop-image',
	'generate-password',
	'save-wporg-username',
	'delete-plugin',
	'search-plugins',
	'search-install-plugins',
	'activate-plugin',
	'update-theme',
	'delete-theme',
	'install-theme',
	'get-post-thumbnail-html',
	'get-community-events',
	'edit-theme-plugin-file',
	'wp-privacy-export-personal-data',
	'wp-privacy-erase-personal-data',
	'health-check-site-status-result',
	'health-check-dotorg-communication',
	'health-check-is-in-debug-mode',
	'health-check-background-updates',
	'health-check-loopback-requests',
	'health-check-get-sizes',
);

// Deprecated.
$core_actions_post_deprecated = array( 'wp-fullscreen-save-post', 'press-this-save-post', 'press-this-add-category' );
$core_actions_post            = array_merge( $core_actions_post, $core_actions_post_deprecated );

// Register core Ajax calls.
if ( ! empty( $_GET['action'] ) && in_array( $_GET['action'], $core_actions_get ) ) {
	add_action( 'wp_ajax_' . $_GET['action'], 'wp_ajax_' . str_replace( '-', '_', $_GET['action'] ), 1 );
}

if ( ! empty( $_POST['action'] ) && in_array( $_POST['action'], $core_actions_post ) ) {
	add_action( 'wp_ajax_' . $_POST['action'], 'wp_ajax_' . str_replace( '-', '_', $_POST['action'] ), 1 );
}

add_action( 'wp_ajax_nopriv_heartbeat', 'wp_ajax_nopriv_heartbeat', 1 );

function wpse_314311_get_quote() {
    global $wpdb;
    
    $query = $_POST['query'] ;
    $search = $_POST['search'];
	$filter = $_POST['filter'];
	$offset = $_POST['offset'];
    // echo "do" . $query . "something";
    if($query and $search){
		if($offset==0){
			$quote = $wpdb->get_results("select * from contents where title like '%".$query."%' and id <= (select max(id) from contents) and category_content !='disable' order by id desc limit 8 ");
			$see_more_session = $wpdb->get_results("select count(*) from contents where title like '%".$query."%' and id <= (select max(id) from contents) and category_content !='disable' order by id desc ");
		}else{
			$quote = $wpdb->get_results("select * from contents where title like '%".$query."%' and id < ".$offset." and category_content !='disable' order by id desc limit 8 ");
			$see_more_session = $wpdb->get_results("select count(*) from contents where title like '%".$query."%' and id < ".$offset." and category_content !='disable' order by id desc ");
		}
        
    }else if($query and $filter){
		
		if($offset==0){
			$quote = $wpdb->get_results("select * from contents where category_name like '%".$query."%' and category_content !='disable' order by id desc limit 8 ");
			$see_more_session = $wpdb->get_results("select count(*) from contents where category_name like '%".$query."%' and category_content !='disable' order by id desc ");
		}else{
			$quote = $wpdb->get_results("select * from contents where id < ".$offset." and category_name like '%".$query."%' and category_content !='disable' order by id desc limit 8");
			$see_more_session = $wpdb->get_results("select count(*) from contents where id < ".$offset." and category_name like '%".$query."%' and category_content !='disable' order by id desc ");
		}
    }else{
		if($offset==0){
			$quote = $wpdb->get_results("select * from contents where id <= (select max(id) from contents) and category_content !='disable' order by id desc limit 8");
			$see_more_session = $wpdb->get_results("select count(*) from contents where id <= (select max(id) from contents) and category_content !='disable' order by id desc ");
		}else{
			$quote = $wpdb->get_results("select * from contents where id < ".$offset." and category_content !='disable' order by id desc limit 8");
			$see_more_session = $wpdb->get_results("select count(*) from contents where id < ".$offset." and category_content !='disable' order by id desc ");
		}
        
    }
    
    if($quote) {
        $data_array = array();
        foreach($quote as $item){
            $data = array('id'=>$item->{'id'}, 'category_name'=>$item->{'category_name'}, 'category_content'=>$item->{'category_content'},
            'image_path'=>$item->{'image_path'},'title'=>stripslashes($item->{'title'}),'date'=>$item->{'date'},'time'=>$item->{'time'},
            'no_of_people_view'=>$item->{'no_of_people_view'},'hero_video_url'=>$item->{'hero_video_url'},'country'=>$item->{'country'},
            'webinar_description'=>stripslashes($item->{'webinar_description'}),'demand_video_url'=>$item->{'demand_video_url'},
			'who_should_attend'=>$item->{'who_should_attend'}, 'duration'=>sprintf("%.2f",$item->{'duration'}));   
            array_push($data_array, $data);
        }
        print json_encode(array("success" => true, "message" => $data_array, "see_more_session"=>$see_more_session));
    }
    else {
        print json_encode(array("success" => false, "message" => "no quote found"));
    }
    // print json to client
    exit;
}
add_action( 'wp_ajax_get_quote', 'wpse_314311_get_quote' );
add_action( 'wp_ajax_nopriv_get_quote', 'wpse_314311_get_quote' );

function wpse_314311_get_all_contents() {
    global $wpdb;
    
    $query = $_POST['query'] ;
    $search = $_POST['search'];
	$filter = $_POST['filter'];
	$offset = $_POST['offset'];
    // echo "do" . $query . "something";
    
	if($offset==0){
		$quote = $wpdb->get_results("select * from contents where id <= (select max(id) from contents) order by id desc limit 8 ");
		$see_more_session = $wpdb->get_results("select count(*) from contents where id <= (select max(id) from contents) order by id desc ");
	}else{
		$quote = $wpdb->get_results("select * from contents where id < ".$offset." order by id desc limit 8 ");
		$see_more_session = $wpdb->get_results("select count(*) from contents where id < ".$offset." order by id desc limit 8 ");
	}  
    
    if($quote) {
        $data_array = array();
        foreach($quote as $item){
            $data = array('id'=>$item->{'id'}, 'category_name'=>$item->{'category_name'}, 'category_content'=>$item->{'category_content'},
            'image_path'=>$item->{'image_path'},'title'=>stripslashes($item->{'title'}),'date'=>$item->{'date'},'time'=>$item->{'time'},
            'no_of_people_view'=>$item->{'no_of_people_view'},'hero_video_url'=>$item->{'hero_video_url'},'country'=>$item->{'country'},
            'webinar_description'=>stripslashes($item->{'webinar_description'}),'demand_video_url'=>$item->{'demand_video_url'},
			'who_should_attend'=>$item->{'who_should_attend'}, 'webinar_id'=>$item->{'webinar_id'}, 'duration'=>sprintf("%.2f",$item->{'duration'}));   
            array_push($data_array, $data);
        }
        print json_encode(array("success" => true, "message" => $data_array, "see_more_session" => $see_more_session));
    }
    else {
        print json_encode(array("success" => false, "message" => "no quote found"));
    }
    // print json to client
    exit;
}
add_action( 'wp_ajax_get_all_contents', 'wpse_314311_get_all_contents' );
add_action( 'wp_ajax_nopriv_get_all_contents', 'wpse_314311_get_all_contents' );


// get content by id
function wpse_314311_get_content_by_id() {
    global $wpdb;
    
    $content_id = $_POST['content_id'];
    if($content_id){
		$attender_heros = $wpdb->get_results("select * from attender_hero where content_id = '".$content_id."'");
		$speakers = $wpdb->get_results("select * from speakers where content_id = '".$content_id."'");
		$asked_questions = $wpdb->get_results("select * from asked_question where content_id = '".$content_id."'");
		$content_webinar_points = $wpdb->get_results("select * from content_webinar_points where content_id = '".$content_id."'");
		$contents = $wpdb->get_results("select * from contents where id = '".$content_id."'");
    }
    
    if($attender_heros or $speakers or $asked_questions or $content_webinar_points or $contents) {
        $asked_question_array = array();
        foreach($asked_questions as $item){
            $data = array('id'=>$item->{'id'}, 'question'=>stripslashes($item->{'question'}), 'answer'=>stripslashes($item->{'answer'}));  
            array_push($asked_question_array, $data);
		}
		$speaker_array = array();
        foreach($speakers as $item){
			$data = array('id'=>$item->{'id'}, 'name'=>stripslashes($item->{'name'}), 'designation'=>stripslashes($item->{'designation'}),
						'image'=>base64_encode($item->{'image'}),'description'=>stripslashes($item->{'description'}));  
            array_push($speaker_array, $data);
		}
		$attender_array = array();
        foreach($attender_heros as $item){
            $data = array('id'=>$item->{'id'}, 'name'=>$item->{'name'}, 'image'=>base64_encode($item->{'image'}));  
            array_push($attender_array, $data);
		}
		$content_webinar_point_array = array();
        foreach($content_webinar_points as $item){
            $data = array('id'=>$item->{'id'}, 'point'=>stripslashes($item->{'point'}));  
            array_push($content_webinar_point_array, $data);
		}
		$content_array = array();
        foreach($contents as $item){
            $data = array('id'=>$item->{'id'}, 'category_name'=>$item->{'category_name'}, 'category_content'=>$item->{'category_content'}, 'registration_id'=>$item->{'registration_id'},
            'image_path'=>$item->{'image'},'title'=>stripslashes($item->{'title'}),'date'=>$item->{'date'},'time'=>$item->{'time'},'endTime'=>$item->{'endTime'},
            'no_of_people_view'=>$item->{'no_of_people_view'},'hero_video_url'=>$item->{'hero_video_url'},'country'=>$item->{'country'},'webinar_id'=>$item->{'webinar_id'},
            'webinar_description'=>stripslashes($item->{'webinar_description'}),'demand_video_url'=>$item->{'demand_video_url'},'image_path'=>$item->{'image_path'},
			'who_should_attend'=>$item->{'who_should_attend'}, 'rigtration_webinar_url'=>$item->{'rigtration_webinar_url'}, 'local_time'=>$item->{'local_time'},
			'duration'=>sprintf("%.2f",$item->{'duration'}));   
            array_push($content_array, $data);
        }
		print json_encode(array("success" => true, "asked_question" => $asked_question_array, "speaker" => $speaker_array,
								"attender" => $attender_array, "webinar_point"=> $content_webinar_point_array, "content" => $content_array));
    }
    else {
        print json_encode(array("success" => false, "message" => "no quote found"));
    }
    exit;
}
add_action( 'wp_ajax_get_content_by_id', 'wpse_314311_get_content_by_id' );
add_action( 'wp_ajax_nopriv_get_content_by_id', 'wpse_314311_get_content_by_id' );

function wpse_314311_insert_webinar() {
	global $wpdb;
	
	$data_array = array(
		'category_name' => $_POST['category_name'],
		'category_content' => $_POST['category_content'],
		'title' => $_POST['webinar_title'], 
		'date' => $_POST['webinar_date'],
		'time' => $_POST['webinar_time'],
		'country' => $_POST['webinar_country'], 
		'no_of_people_view' => $_POST['no_of_people_view'],
		'hero_video_url' => $_POST['hero_video_url'],
		'who_should_attend' => $_POST['who_should_attend'], 
		'duration' =>  sprintf("%.2f",$_POST['timeDuration']),
		'webinar_description' => $_POST['webinar_description'],
		'endTime' => $_POST['endTime'],
		'demand_video_url' => $_POST['demand_video_url'],
		'local_time'=> $_POST['local_time'],
		'webinar_id'=> $_POST['webinar_id'],
		'registration_id'=> $_POST['registration_id'],
	);
	if($_FILES['webinar_img']['tmp_name']){
		$wordpress_upload_dir = wp_upload_dir();
		$i = 1;

		$profilepicture = $_FILES['webinar_img'];
		$new_file_path = $wordpress_upload_dir['path'] . '/' .bin2hex(openssl_random_pseudo_bytes(16)).'.jpg';
		$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
		
		if( empty( $profilepicture ) )
			die( 'File is not selected.' );
		
		if( $profilepicture['error'] )
			die( $profilepicture['error'] );
		
		if( $profilepicture['size'] > wp_max_upload_size() )
			die( 'It is too large than expected.' );
		
		if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
			die( 'WordPress doesn\'t allow this type of uploads.' );
		
		while( file_exists( $new_file_path ) ) {
			$i++;
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . bin2hex(openssl_random_pseudo_bytes(16)).'.jpg';
		}
		
		// looks like everything is OK
		if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
		
		
			$upload_id = wp_insert_attachment( array(
				'guid'           => $new_file_path, 
				'post_mime_type' => $new_file_mime,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			), $new_file_path );
		
			// wp_generate_attachment_metadata() won't work if you do not include this file
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		}
		$data_array['image_path'] = $new_file_path;
	}
	if($_FILES['go_live_img']['tmp_name']){
		$data_array['go_live_image'] = file_get_contents($_FILES['go_live_img']['tmp_name']);
	}
	if($_POST['content_id']){
		$wpdb->update('contents', $data_array, array('id'=>$_POST['content_id']));
		// update attenders
		if($_POST['no_of_attenders']>=0){
			$attender_id = $wpdb->get_results( "select * from attender_hero where content_id = '".$_POST['content_id']."'" );
			$wpdb->delete( 'attender_hero', array( 'content_id' => $_POST['content_id'] ) );
			// $id = $attender_id[0]->{'id'};
			for($i = 0; $i<=$_POST['no_of_attenders']; $i++){
				// $existed_value = $wpdb->get_results( "select * from attender_hero where id = '".$id."'" );
				if($_POST['attender_name_'.$i] or $_FILES['attender_img_'.$i]['tmp_name'] or $_POST['attender_image_'.$i]){
					$attender_hero_array = array(
						'name' => $_POST['attender_name_'.$i]
					);
					$format_array = array('%s','%s');
					if($_FILES['attender_img_'.$i]['tmp_name']){
						$attender_hero_array['image'] = file_get_contents($_FILES['attender_img_'.$i]['tmp_name']);
						$format_array = array('%s','%s', '%s');
					}else if($_POST['attender_image_'.$i]){
						$image_data = base64_decode($_POST['attender_image_'.$i]);
						$attender_hero_array['image'] = base64_decode($_POST['attender_image_'.$i]);
						$format_array = array('%s','%s', '%s');	
						
					}
					
					$attender_hero_array['content_id'] = $_POST['content_id'];
					$wpdb->insert('attender_hero', $attender_hero_array, $format_array);
					$attender_hero_array = array();
					
				}
				
			}
		}
		// update speakers
		if($_POST['no_of_speakers']>=0){
			$speaker_id = $wpdb->get_results( "select * from speakers where content_id = '".$_POST['content_id']."'" );
			$wpdb->delete( 'speakers', array( 'content_id' => $_POST['content_id'] ) );
			// $id = $speaker_id[0]->{'id'};
			for($i = 0; $i<=$_POST['no_of_speakers']; $i++){
				$existed_value = $wpdb->get_results( "select * from speakers where id = '".$id."'" );
				if($_POST['speaker_name_'.$i] or $_POST['speaker_own_'.$i] or $_POST['speaker_desc_'.$i] or $_POST['speaker_image_'.$i]){
					$speaker_array = array(
						'name' => $_POST['speaker_name_'.$i],
						'designation' => $_POST['speaker_own_'.$i],
						'description' => $_POST['speaker_desc_'.$i]
					);
					$format_array = array('%s','%s', '%s');
					if($_FILES['speaker_img_'.$i]['tmp_name']){
						$speaker_array['image'] = file_get_contents($_FILES['speaker_img_'.$i]['tmp_name']);
						$format_array = array('%s','%s', '%s', '%s');
					}else if($_POST['speaker_image_'.$i]){
						$image_data = base64_decode($_POST['speaker_image_'.$i]);
						$speaker_array['image'] = base64_decode($_POST['speaker_image_'.$i]);
						$format_array = array('%s','%s', '%s', '%s');
					}
					
					$speaker_array['content_id'] = $_POST['content_id'];
					$wpdb->insert('speakers', $speaker_array, $format_array);
					$speaker_array = array();
					
				}
				
			}
		}
		// update frquently asked questions
		if($_POST['no_of_question']>=0){
			$asked_question_id = $wpdb->get_results( "select * from asked_question where content_id = '".$_POST['content_id']."'" );
			$wpdb->delete( 'asked_question', array( 'content_id' => $_POST['content_id'] ) );
			// $id = $asked_question_id[0]->{'id'};
			for($i = 0; $i<=$_POST['no_of_question']; $i++){
				// $existed_value = $wpdb->get_results( "select * from asked_question where id = '".$id."'" );
				if($_POST['question_'.$i] or $_POST['answer_'.$i]){
					$asked_question_array = array(
						'question' => $_POST['question_'.$i],
						'answer' => $_POST['answer_'.$i]
					);
					

					$asked_question_array['content_id'] = $_POST['content_id'];
					$wpdb->insert('asked_question', $asked_question_array, array('%s','%s', '%s'));
					$asked_question_array = array();
				}
				
				
			}
		}

		// update webinar points
		if($_POST['no_of_point']>=0){
			$webinar_point_id = $wpdb->get_results( "select * from content_webinar_points where content_id = '".$_POST['content_id']."'" );
			$wpdb->delete( 'content_webinar_points', array( 'content_id' => $_POST['content_id'] ) );
			// $id = $webinar_point_id[0]->{'id'};
			for($i = 0; $i<=$_POST['no_of_point']; $i++){
				// $existed_value = $wpdb->get_results( "select * from content_webinar_points where id = '".$id."'" );
				if($_POST['webinar_point_'.$i]){
					$asked_question_array = array(
						'point' => $_POST['webinar_point_'.$i]
					);
					
					
					$asked_question_array['content_id'] = $_POST['content_id'];
					$wpdb->insert('content_webinar_points', $asked_question_array, array('%s','%s'));
					$asked_question_array = array();
					
				}
				
			}
		}
		print json_encode(array("success" => true, "result" => "sucsessfully updated"));
	}else{
		$wpdb->insert('contents', $data_array);
		// print json_encode(array("success" => true, "result" =>$data_array));
		$content_id = $wpdb->insert_id;
		if($content_id){
			// insert attenders
			if($_POST['no_of_attenders']>=0){
				for($i = 0; $i<=$_POST['no_of_attenders']; $i++){
					if($_FILES['attender_img_'.$i]['tmp_name'] or $_POST['attender_name_'.$i]){
						$attender_hero_array = array(
							'image' => file_get_contents($_FILES['attender_img_'.$i]['tmp_name']),
							'name' => $_POST['attender_name_'.$i],
							'content_id' => $content_id
						);
						$wpdb->insert('attender_hero', $attender_hero_array, array('%s','%s','%s'));
					}	
				}
			}
			// insert speakers
			if($_POST['no_of_speakers']>=0){
				for($i = 0; $i<=$_POST['no_of_speakers']; $i++){
					if($_FILES['speaker_img_'.$i]['tmp_name'] or $_POST['speaker_name_'.$i]){
						$speaker_array = array(
							'image' => file_get_contents($_FILES['speaker_img_'.$i]['tmp_name']),
							'name' => $_POST['speaker_name_'.$i],
							'designation' => $_POST['speaker_own_'.$i],
							'description' => $_POST['speaker_desc_'.$i],
							'content_id' => $content_id
						);
						$wpdb->insert('speakers', $speaker_array, array('%s','%s','%s', '%s','%s'));
					}	
				}
			}
			// insert frequently asked question
			if($_POST['no_of_question']>=0){
				for($i = 0; $i<=$_POST['no_of_question']; $i++){
					if($_POST['question_'.$i] or $_POST['answer_'.$i]){
						$question_array = array(
							'question' => $_POST['question_'.$i],
							'answer' => $_POST['answer_'.$i],
							'content_id' => $content_id
						);
						$wpdb->insert('asked_question', $question_array, array('%s','%s','%s'));
					}	
				}
			}
			// insert webinar points
			if($_POST['no_of_point']>=0){
				for($i = 0; $i<=$_POST['no_of_point']; $i++){
					if($_POST['webinar_point_'.$i]){
						$point_array = array(
							'point' => $_POST['webinar_point_'.$i],
							'content_id' => $content_id
						);
						$wpdb->insert('content_webinar_points', $point_array, array('%s','%s'));
					}
				}
			}

			print json_encode(array("success" => true, "result" =>$content_id));
		}else{
			print json_encode(array("success" => true, "result" => 'not inserted'));
		}
	}
	
	exit;
}
add_action( 'wp_ajax_insert_webinar', 'wpse_314311_insert_webinar' );
add_action( 'wp_ajax_nopriv_insert_webinar', 'wpse_314311_insert_webinar' );

function wpse_314311_get_live_webinar() {
    global $wpdb;
    
    // echo "do" . $query . "something";
	$quote = $wpdb->get_results("select * from contents where category_content='live'");
	
	// print json_encode(array("success" => true, "message" => explode(":",explode(" ",date("Y-m-d h:i:sa"))[1])[0].':'.explode(":",explode(" ",date("Y-m-d h:i:sa"))[1])[1]));
    if($quote) {
        $data_array = array();
        foreach($quote as $item){
            $data = array('id'=>$item->{'id'}, 'category_name'=>$item->{'category_name'}, 'category_content'=>$item->{'category_content'},
            'image'=>base64_encode($item->{'image'}),'title'=>$item->{'title'},'date'=>$item->{'date'},'time'=>$item->{'time'},'endTime'=>$item->{'endTime'},
            'no_of_people_view'=>$item->{'no_of_people_view'},'hero_video_url'=>$item->{'hero_video_url'}, 'country'=>$item->{'country'},'webinar_id'=>$item->{'webinar_id'},
            'webinar_description'=>stripslashes($item->{'webinar_description'}),'demand_video_url'=>$item->{'demand_video_url'},
			'who_should_attend'=>$item->{'who_should_attend'}, 'no_of_episode'=>$item->{'no_of_episode'}, 'duration'=>sprintf("%.2f",$item->{'duration'}));   
            array_push($data_array, $data);
        }
        print json_encode(array("success" => true, "message" => $data_array));
    }
    else {
        print json_encode(array("success" => false, "message" => (string)((int)explode(":",explode(" ",date("Y-m-d h:i:sa"))[1])[0]+5).':'.explode(":",explode(" ",date("Y-m-d h:i:sa"))[1])[1]));
    }
    // print json to client
    exit;
}
add_action( 'wp_ajax_get_live_webinar', 'wpse_314311_get_live_webinar' );
add_action( 'wp_ajax_nopriv_get_live_webinar', 'wpse_314311_get_live_webinar' );

function wpse_314311_delete_contents() {
	global $wpdb;
	
	$id = $_POST['content_id'];
	$wpdb->delete( 'contents', array( 'id' => $id ) );
	$wpdb->delete( 'attender_hero', array( 'content_id' => $id ) );
	$wpdb->delete( 'speakers', array( 'content_id' => $id ) );
	$wpdb->delete( 'asked_question', array( 'content_id' => $id ) );
	$wpdb->delete( 'content_webinar_points', array( 'content_id' => $id ) );
    
	print json_encode(array("success" => true, "message" => $data_array));
    
    // print json to client
    exit;
}
add_action( 'wp_ajax_delete_contents', 'wpse_314311_delete_contents' );
add_action( 'wp_ajax_nopriv_delete_contents', 'wpse_314311_delete_contents' );

$action = ( isset( $_REQUEST['action'] ) ) ? $_REQUEST['action'] : '';

if ( is_user_logged_in() ) {
	// If no action is registered, return a Bad Request response.
	if ( ! has_action( "wp_ajax_{$action}" ) ) {
		wp_die( '0', 400 );
	}

	/**
	 * Fires authenticated Ajax actions for logged-in users.
	 *
	 * The dynamic portion of the hook name, `$action`, refers
	 * to the name of the Ajax action callback being fired.
	 *
	 * @since 2.1.0
	 */
	do_action( "wp_ajax_{$action}" );
} else {
	// If no action is registered, return a Bad Request response.
	if ( ! has_action( "wp_ajax_nopriv_{$action}" ) ) {
		wp_die( '0', 400 );
	}

	/**
	 * Fires non-authenticated Ajax actions for logged-out users.
	 *
	 * The dynamic portion of the hook name, `$action`, refers
	 * to the name of the Ajax action callback being fired.
	 *
	 * @since 2.8.0
	 */
	do_action( "wp_ajax_nopriv_{$action}" );
}
// Default status.
wp_die( '0' );
