<?php 

/**
 * Plugin Name: True Admin Loader
 * Description: Just a simple loader
 * Author: True Agency
 */

class TrueAdminLoader {

	/** ================================================= 
	 *	The configuration of the TA 
	 *	================================================= 
	 *
	 *   Change as necessary
	 */
	
	const TA_TITLE = 'Prime';
	const TA_PAGE_TITLE = 'Prime Dashboard';
	const TA_SLUG = 'true';
	const TA_ICON_URL =  'truePrimeWPIcons.png';
	const TA_POSITION = '3.1';

	private static $sideMenus = array();


	public function __construct() 
	{
        
	}

	public static function init() 
	{
		// if(is_admin())
		// {
		// 	add_action('user_register', array(__CLASS__, 'wordpressUserCreated'), 10, 1 );
		// 	add_action('user_new_form', array(__CLASS__, 'addFieldNewUser'), 10, 1);
		// }

		// Add prime to adminbar
		add_action('admin_bar_menu', array(__CLASS__, 'addPrimeToAdminBar'), 31 );

		// No Cache on admin page!
		nocache_headers();

		// Register shutdown event in case of things go wrong in Prime
		register_shutdown_function(array('Route', 'shutdown'));

		// Start a session if not already started
		if(!session_id()) {
			session_start();
		}

		// Load all our Sections class, they are SUFFIXed with Section
		self::loadSectionFiles();

		Route::checkRedirection();

		// Set page title based on the current section
		add_filter('admin_title', array('Route', 'setTitle'), 10, 2);

		/** This will and a single top level menu **/
		add_action('admin_menu', array( __CLASS__, 'load'));

		// We are the master of our own page
		if (isset($_GET['page'])) {
			if ($_GET['page'] == self::TA_SLUG) 
			{
				add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueueResources'));				
			}
			else {
				return;
			}
		} else {
			return;
		}
	}

	public static function wordpressUserCreated($user_id) 
	{
		if(isset($_POST['add_person_entry']))
		{
			wp_redirect(get_admin_url() . 'admin.php?page=true&section=PersonSection&do=create&existing_id=' . $user_id);
			die;
	    }
	}

	public static function addFieldNewUser($context)
	{
		if($context == 'add-new-user')
		{
			?>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="add_person_entry">Create a Person Entry?</label></th>
						<td>
							<label for="add_person_entry">
								<input name="add_person_entry" id="add_person_entry" type="checkbox"> This action is required if you want the user to have access to Prime. You will be redirected.
							</label>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}
	}

	/**
	 * Add Prime menu to Wordpress AdminBar
	 */
	public static function addPrimeToAdminBar() {
		global $wp_admin_bar;

		$args = array(
			'id'    => 'true_prime',
			'title' => __('<img src="'.self::asset('img/') . self::TA_ICON_URL.'" style="vertical-align:middle;margin-right:5px" alt="Prime" title="Prime" />Prime' ),
			'href'  => get_admin_url() . 'admin.php?page=true',
			'meta'  => array( 'class' => 'prime-admin-bar' )
		);
		$wp_admin_bar->add_node( $args );
	}

    
    public static function enqueueResources()
    {
    	wp_enqueue_script('true-jquery', self::asset() . '/plugins/jquery-1.10.2.min.js' );

    	wp_enqueue_style('prime_vendor_css', self::asset() . '/css/vendor.min.css');
		wp_enqueue_style('prime_css', self::asset() . '/css/main.min.css');
		
		wp_enqueue_script('vendor', self::asset() . '/js/vendor.min.js' );
		wp_enqueue_script('scripts', self::asset() . '/js/scripts.min.js' );

		wp_enqueue_style('googlecss', '//fonts.googleapis.com/css?family=Lato:100,200,300,400,700');

		$translation_array = array( 'admin_url' => get_admin_url() . 'admin.php');
		wp_localize_script( 'scripts', 'TruePrimeVars', $translation_array );
		wp_enqueue_script( 'scripts' );
    }

	/** ================================================= 
	 *	Load menu structure and configurations
	 *	================================================= 
	 *
	 *  Determine which page to based on the $_GET structure
	 *
	 *  /wp-admin/?page=[TA_SLUG]&section=[SECTION] 
	 *
	 */

	public static function load() {

		add_menu_page( self::TA_PAGE_TITLE, self::TA_TITLE, 'administrator', self::TA_SLUG, array(__CLASS__, 'makeAdmin'), self::asset('img/') . self::TA_ICON_URL, self::TA_POSITION );
	}

	public static function makeAdmin() {
		Route::decide();
	}

    public static function getPluginJS($name, $script)
    {
        wp_enqueue_script($name, self::asset() . '/plugins/' . $script . '.js' );
    }
    
    public static function getPluginCSS($name, $file)
    {
        wp_enqueue_style($name, self::asset() . '/plugins/' . $file . '.css' );
    }

    public static function enqueueDataTableFiles()
    {
    	self::getPluginJS('data-tables', 'data-tables/jquery.dataTables');
        self::getPluginJS('data-tables-columnfilter', 'data-tables/jquery.dataTables.columnFilter');
        self::getPluginJS('dt-bootstrap', 'data-tables/DT_bootstrap');
        self::getPluginCSS('data-tables-css', 'data-tables/DT_bootstrap');
    }


	public static function makeSidebar() {
		View::getAdminTemplate('admin-sidebar');
	}

	/** ================================================= 
	 *	START OF UTILITY FUNCTIONS
	 *	================================================= 
	 */

	public static function asset($asset = '') {
		if (!empty($asset)) {
			return CoreLoader::themeRootURL() . 'trueadmin/' . $asset;
		}
		return CoreLoader::themeRootURL() .  'trueadmin';
	}

	public static function getImage($file, $alt = '', $class = '')
    {
    	$str = '<img ';
        if($class != '')
        {
            $str .= 'class="' . trim($class) . '"';
          
        }
        return  $str . ' src="'  . get_template_directory_uri() . '/app/trueadmin/img/' . $file . '" alt="' . $alt  . '">';
    }

	public static function getFilePath($file = '')
	{
		return get_template_directory() . '/app/trueadmin/' . $file;
	}

	public static function endsWith($haystack, $needle) {
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}

	public static function startsWith($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}


	// Not usable yet.
	public static function loadSectionPlugins($classname) {
		$scripts = isset($classname::$scripts) ? $classname::$scripts : array();
		$styles = isset($classname::$styles) ? $classname::$styles : array();

		foreach($scripts as $key => $value) {
			self::getPluginJS($key, $value);
		}

		foreach($styles as $key => $value) {
			self::getPluginCSS($key, $value);
		}		
	}

	/**
	 * Get the current environment based on $_SERVER
	 * 
	 * @return
	 */
	public static function isLocal() {
		$env = self::env();
		
		if (strpos($env, 'true.local')) {
			return true;
		}
		return false;
	}

	private static function env() {
		return $_SERVER['SERVER_NAME'];
	}


	/** ================================================= 
	 *	START OF Section RELATED FUNCTIONS
	 *	================================================= 
	 */


	/** 
	 *	Load all the Sections files
	 *	
	 *
	 *  Pay attention to the Section suffix and the default Sections
	 */

	public static function loadSectionFiles() {
		foreach (scandir( dirname(__FILE__) . Route::ROUTE_SECTION_DIR) as $filename) {

		    $path =  dirname(__FILE__) . Route::ROUTE_SECTION_DIR . '/' . $filename;

		    if (is_file($path)) {
				$path_parts = pathinfo($path);
		    	$basename = $path_parts['filename'];

		    	if (self::endsWith($basename, Route::ROUTE_SECTION_SUFFIX)) {
			        require_once $path;
			        call_user_func(array($basename , 'init'));
		    	}
		    }
		}
	}
}

interface TrueAdminSection {
	public static function init();
}

TrueAdminLoader::init();
