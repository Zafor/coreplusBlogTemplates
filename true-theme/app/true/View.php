<?php


/**
 *
 * A class to render the templates, handles and assign variables
 * used in the view
 *
 * @author Jofry HS
 */

class View
{
    private static $vars = array();

    private static $viewRoot = 'templates/';

    // Output the content of the template
    public static function render($templateName, $extraVars = array(), $overrideRoot = false)
    {
        $path = $overrideRoot ?
                    $templateName . '.php' :
                    self::$viewRoot . $templateName . '.php';

        self::load($path, $extraVars);
    }

    // Return you the HTML Content of a template (it doesn't output the template)
    public static function make($templateName, $extraVars = array(), $overrideRoot = false)
    {
        $path = $overrideRoot ?
                    $templateName . '.php' :
                    self::$viewRoot . $templateName . '.php';

        ob_start();

        self::load($path, $extraVars);

        return ob_get_clean();
    }

    /**
     * Safely check if a template can be loaded. Throw error
     * when can't be found.
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    private static function load($path, $extraVars = array())
    {
        /**
         * Locate Template ensure we can still use our variables in the template files
         * @see http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/
         */

        if (count(self::$vars) > 0) {
            extract(self::$vars);
        }

        // Extra vars which can be passed from anywhere to the template

        if (count($extraVars) > 0) {
            extract($extraVars);
        }

        if (locate_template($path) != '') {
            require(locate_template($path));
        } else {
            ?>
				<style>
				div.view-err-container {
				background: none repeat scroll 0% 0% #F4726D; padding: 9px 15px;
				overflow: hidden;
				position: relative;
				text-align: left;
				margin-top: 15px; margin-bottom: 15px;
				max-width: 960px; margin-left: auto; margin-right: auto;
				}
				h5.view-err {
					color: #FFF;
					font-weight: 400 !important;
					font-size: 13px;
					margin-bottom: 5px;
					margin-top: 0.5em;
					text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
				}
				</style>
				<div class="view-err-container">
					<h5 class="view-err"><strong>Error</strong>: Template <strong><?= $path ?></strong> is not found or cannot be loaded.</h5>
				</div>
			<?php
        }
    }

    /**
     * Share variable to wordpress page template
     * The opposite method View::extract() needs to be called at the top of
     * wordpress template
     * @return [type] [description]
     */
    public static function share($arr, $value = '')
    {
        if (!is_array($arr)) {
            $arr = array($arr => $value);
        }

        self::$vars = array_merge_recursive(self::$vars, $arr);
        return;
    }

    public static function vars()
    {
        return self::$vars;
    }

    /**
        * Add error to be displayed in the next View
        * When redirection happens, the error stays until the next
        * non-redirecting controller action runs.
        */
       // public static function addErrors($errorArray, $formName = '')
       // {
       //     if (isset($_SESSION['_viewError'][$formName])) {
       //         array_merge($_SESSION['_viewError'][$formName], $errorArray);
       //     } else {
       //         $_SESSION['_viewError'][$formName] = $errorArray;
       //     }
       // }

       // public static function getErrors($form)
       // {
       //     if (isset($_SESSION['_viewError'][$form])) {

       //         $errors = $_SESSION['_viewError'][$form];
       //         unset($_SESSION['_viewError'][$form]);
       //         return $errors;
       //     }
       //     return array();
       // }

       // public static function hasErrors($form)
       // {
       //     return isset($_SESSION['_viewError'][$form]);
       // }
}
