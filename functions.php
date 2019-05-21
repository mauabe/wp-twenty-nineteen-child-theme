<?php
//Child Theme Functions File

add_action( 'wp_enqueue_scripts', 'enqueue_wp_child_theme' );

function enqueue_wp_child_theme() 
{
    if((esc_attr(get_option('spepyio_setting_4')) != "No")) 
    {
	   wp_enqueue_style('parent-css', get_template_directory_uri().'/style.css' );
    }

	wp_enqueue_style('child-css', get_stylesheet_uri());

	wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
	//Ad Google Fonts
	wp_enqueue_style('child-googlefonts', 'https://fonts.googleapis.com/css?family=Playfair+Display&display=swap');
}


// ChildThemWP.com Settings 

function spepyio_register_settings() 
{ 
	register_setting( 'spepyio_theme_options_group', 'spepyio_setting_1', 'ctwp_callback' );
	register_setting( 'spepyio_theme_options_group', 'spepyio_setting_2', 'ctwp_callback' );
	register_setting( 'spepyio_theme_options_group', 'spepyio_setting_3', 'ctwp_callback' );
	register_setting( 'spepyio_theme_options_group', 'spepyio_setting_4', 'ctwp_callback' );
    register_setting( 'spepyio_theme_options_group', 'spepyio_setting_5', 'ctwp_callback' );
}
add_action( 'admin_init', 'spepyio_register_settings' );

function spepyio_register_options_page() 
{
	add_options_page('Child Theme Settings', 'My Child Theme', 'manage_options', 'spepyio', 'spepyio_theme_options_page');
}
add_action('admin_menu', 'spepyio_register_options_page');

function spepyio_theme_options_page()
{ 
?>
<div>
	<style>
		table.spepyio {table-layout: fixed ;  width: 100%; vertical-align:top; }
		table.spepyio td { width:50%; vertical-align:top; padding:0px 20px; }
		#spepyio_settings { padding:0px 20px; }
	</style> 
	<div id="spepyio_settings">
		<h1>Child Theme Options</h1>
	</div>
	<table class="spepyio">
		<tr>
			<td>
                <form method="post" action="options.php">
					<?php settings_fields( 'spepyio_theme_options_group' ); ?>
                <h2>Parent Stylesheet</h2>
                <?php settings_fields( 'spepyio_theme_options_group' ); ?>
					<p><label><input size="76" type="checkbox" name="spepyio_setting_14" id="spepyio_setting_4" <?php if((esc_attr(get_option('spepyio_setting_4')) == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Check To Disable The Parent Stylesheet style.css In Child Theme.<br><br>
                        Tick This Box If When You Inspect Your Source Code It Contains Your Parent Stylesheet style.css Two Times. Ticking This Box Will Only Include It Once.</label></p>
                <hr>
				<h2>Enable/Disable Footer Link</h2>
				<h4>Disable Footer Link</h4>
				
					<p><label><input size="76" type="checkbox" name="spepyio_setting_1" id="spepyio_setting_1" <?php if((esc_attr(get_option('spepyio_setting_1')) == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Check To Disable Link In The Footer</label></p>
					<hr>
					<h2>Style Footer Link</h2>
					<h4>Footer Link Hex Color (Default: #000000)</h4>
					<p><label><input type="text" name="spepyio_setting_2" id="spepyio_setting_2" value="<?php if((esc_attr(get_option('spepyio_setting_2')) != "")) { echo esc_attr(get_option('spepyio_setting_2'));  } else { echo "#000000"; } ?>" placeholder="#000000" ></label></p>
					<h4>Footer Link Alignment (Default: Center)</h4>
					<p><label><select type="text" name="spepyio_setting_3" id="spepyio_setting_3">
						<option selected="selected"><?php if((get_option('spepyio_setting_3') != "")) { echo esc_attr(get_option('spepyio_setting_3')); } else { echo "Center"; } ?></option>
						<option>Left</option>
						<option>Center</option>
						<option>Right</option>
						</select></label>
					</p>
					<h4>Footer Link Size</h4>
					<p><label><select type="text" name="spepyio_setting_4" id="spepyio_setting_4">
						<option selected="selected"><?php if((get_option('spepyio_setting_4') != "")) { echo esc_attr(get_option('spepyio_setting_4'));  } else { echo "12px"; } ?></option>
						<option>9px</option>
						<option>10px</option>
						<option>11px</option>
						<option>12px</option>
						<option>13px</option>
						<option>14px</option>
						<option>15px</option>
						<option>20px</option>
						</select></label>
					</p>
					<?php submit_button(); ?>
				</form>	
			</td>
			<td>
				<h2>Confirm that you are a happy person</h2>
				<h4>Are you happy?</h4>
				<p>
				<a href="./options-general.php?page=spepyio&spepyconfirm=Yes">Yes positivelly</a><br>
				<a href="./options-general.php?page=spepyio&spepyconfirm=No">No, I am down.</a><br>
				<?php
 				$problem = "";
				global $wpdb;
				$table_name = esc_attr($wpdb->prefix.'spepy');
				$childthemeconfirmed = $wpdb->get_results("SELECT datavalue FROM $table_name ORDER BY id DESC LIMIT 1");
                ?>
                <br>You previously answered: <strong>
                <?php
                $dbanswer = esc_attr($childthemeconfirmed[0]->datavalue);
 
				if($dbanswer != "")
				{
					if($dbanswer == "Yes")
					{
                        ?>
                        <strong style="color:green">YES IT WORKS!</strong>
                        <?php
					}
					else
					{
						$problem ="flag";
						?>
                        <strong style="color:red">NO THERE'S A PROBLEM</strong>
                        <?php
					}
				}
				else
				{
					?>
                    <strong style="color:red">? NOT ANSWERED? OH WELL !</strong>
                    <?php
				} 
				?></strong></p>
				<p>Your answer is important because it we like happy people.</p>
				<hr>
				<?php
				if($problem == "flag")
				{
                    ?>
					<h2>Report a bug</h2>
					<h4 style='color:red'>Please report your problem in more details using this link</h4>
					<p><a href="https://spepy.io/" target="_blank">Report your bug using this form</a></p>	
                    <p>We can only fix bugs if you share more information with us. Please complete the form above so that we can assist you.</p>
                    <?php
				}
				else
				{
                    ?>
					<h2>Suggest improvements</h2>
					<h4>Suggest a child theme improvement using the form below</h4>
					<p><a href="https://spepy.io/" target="_blank">Suggest an improvement</a></p>
                    <p>Your feedback is valuable because it helps us improve.</p>
                    <?php
				}
				?>
                <hr> 
                <h2>Be social</h2>
                <p><strong>Tweet us or Instagram us and we'll mention your site on our channels!</strong><br><br>
                <a href="https://twitter.com/" target="_blank">Twitter</a><br>
                <a href="https://www.instagram.com/" target="_blank">Instagram</a><br><br>
                <a href="https://spepy.io" target="_blank">Spepy.io</a></p>
			</td>
		</tr>
	</table>
</div>
<?php
} 

function spepyio_footerlink() 
{
    $footerhtml = "";
    
	if((is_home()) || (is_front_page()))
	{
		if(esc_attr(get_option('spepyio_setting_1')) != "Yes")
		{
			$color = esc_attr(get_option('spepyio_setting_2'));
			$align = esc_attr(get_option('spepyio_setting_3'));
			$size = esc_attr(get_option('spepyio_setting_4'));

			if($color == ""){ $color="#000000"; }
			if($align == ""){ $align="center"; }
			if($size == ""){ $size="12px"; }
            ?>
			<div id="footerlinktospepy_div">
				<p id="footerlinktospepy_p">
					<a href="https://spepy.io" title="We make you look good." target="_blank" id="footerlinktospepy_a">spepy.io</a>
				</p>
			</div>
            <?php
		}
	}
	?>
	<?php
	
}
add_action( 'wp_footer', 'spepyio_footerlink' );


if(is_admin())
{
	/* Table To Log Working/Not Working Answers */
	global $wpdb;
	$table_name = esc_attr($wpdb->prefix.'spepy');
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) 
	{
		$charset_collate = esc_attr($wpdb->get_charset_collate());

		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		datavalue text NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); 
		
		dbDelta($sql);
	}
	
	/* Check If Theme Is Working */
	function display_admin_notice() 
	{
        /* Ask The Question: "Does Your Child Theme Work?" To Improve Our Child Theme Library */
		global $wpdb;
		$table_name = esc_attr($wpdb->prefix.'spepy');
		$childthemeconfirmed = $wpdb->get_results("SELECT datavalue FROM $table_name ORDER BY id DESC LIMIT 1");
		if(empty($childthemeconfirmed)) 
		{ 
			?>
			<div class="notice notice-success"><p><strong>Message from Spepy.io:</strong> Are you happy?
				<a href="./options-general.php?page=spepyio&spepyconfirm=Yes">Absolutelly/a> &nbsp; or &nbsp;
				<a href="./options-general.php?page=spepyio&spepyconfirm=No">No way, man!</a></p>
			</div>
            <?php
		}
        
        
        /* Save Answer To: "Does Your Child Theme Work?" To Improve Our Child Theme Library */
        if(isset($_GET["spepyconfirm"]))
        {
            $safe_spepyconfirm = esc_attr($_GET["spepyconfirm"]);
            unset($_GET["spepyconfirm"]);

            $wpdb->insert('wp_spepy', array(
                'id' => '',
                'datavalue' => $safe_spepyconfirm
            ));

            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            {
                $link = "https"; 
            }
            else
            {
                $link = "http"; 
            }
            $link .= "://"; 
            $link .= $_SERVER['HTTP_HOST']; 

            $theme = get_template();

            $query = http_build_query([
             'site' => $link,
             'theme' => $theme
            ]);

            if($safe_spepyconfirm == "Yes")
            {
                $type= "success.php?" . $query;
            }
            else
            {
                $type= "fail.php?" . $query;
            }

            /* We Log Answers To "Does Your Child Theme Work?" To Improve Our Child Theme Library */
            $ch = curl_init('https://spepy.io/' . $type);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
        }
	}
	add_action( 'admin_notices', 'display_admin_notice' );
}

