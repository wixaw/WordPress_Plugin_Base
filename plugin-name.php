<?php

/**
 * Plugin Name: plugin-name
 * Plugin URI: https://github.com/wixaw/
 * Description: Afficher la liste des publis
 * Version: 0.1
 * Author: William VINCENT -  William.Vincent@IRIT.fr 
 * Author URI: https://github.com/wixaw/
 * License: GPLv2
 * @package  plugin-name
 */

add_action(
  'plugins_loaded',
  array(pluginName::get_instance(), 'plugin_setup')
);


/**
 * Widget Class
 */
class pluginName extends WP_Widget
{

  protected static $instance = NULL;
  public $plugin_url = '';
  static $add_script;

  public static function get_instance()
  {
    NULL === self::$instance and self::$instance = new self;
    return self::$instance;
  }

  /**
   * Loading
   */
  public function plugin_setup()
  {
    $this->plugin_url = plugins_url('/', __FILE__);
    add_action('widgets_init', array($this, 'load_widget'));
    add_action('init', array($this, 'activate_au'), 1);
    add_action('wp_enqueue_scripts', array($this, 'enqueue'));
    add_action('wp_footer', array($this, 'print_script'));
  }

  public static function load_widget()
  {
    register_widget('pluginname');
  }

  /**
   * Chargement de la classe autoupdate
   */
  function activate_au()
  {
    require_once ( 'wp_autoupdate.php' );
    $plugin_current_version = '1.5.1';
    $plugin_remote_path = 'https://wp.domain.fr/plugin-name/update.php';
    $plugin_slug = plugin_basename(__FILE__);
    new WP_AutoUpdate($plugin_current_version, $plugin_remote_path, $plugin_slug);
  }


  /**
   * ACTION Enqueue scripts
   */
  public function enqueue()
  {
    wp_register_script('plugin-name-ajax', "{$this->plugin_url}ajax.js", array('jquery'));
    $params = array('ajaxurl' => plugins_url('/ajax-handler-wp.php', __FILE__),);
    wp_localize_script('plugin-name-ajax', 'plugin_name_ajax', $params);
    wp_register_script('plugin-name-script', "{$this->plugin_url}script.js", array('jquery'));
    wp_register_style('plugin-name-style', plugin_dir_url(__FILE__) . 'style.css');
    register_widget('pluginname');
  }

  /**
   * On utilise les ressources que si le plugin est utilisé
   */
  static function print_script()
  {
    if (!self::$add_script)
      return;
    wp_print_scripts('plugin-name-ajax');
    wp_print_scripts('plugin-name-script');
    wp_print_styles('plugin-name-style');
  }




  /**
   * Widget Construction
   */
  public function __construct()
  {
    parent::__construct(
      // widget ID
      'pluginname',
      // widget name
      __('plugin_name', ' plugin_name_text'),
      // widget description
      array('description' => __('plugin_name', 'plugin_name_text'), 'customize_selective_refresh' => true)
    );
  }

  /**
   * Widget BackEnd
   */
  public function form($instance)
  {
    $defaults = array(
      'title'    => '',
      'select'   => '',
    );

    extract(wp_parse_args((array) $instance, $defaults));
    ?>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Widget Title', 'plugin_name_text'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>



<?php
  }


  /**
   * Widget Backup
   */
  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title']    = isset($new_instance['title']) ? wp_strip_all_tags($new_instance['title']) : '';
    return $instance;
  }




  /**
   * Fonctions custom
   */

  function customFunction($y)
  {
    echo 'test';
  }


  /**
   * Widget FrontEnd
   */
  public function widget($args, $instance)
  {
    self::$add_script = true;

    extract($args);
    $title    = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';

    echo $before_widget;

    echo '<div class="widget-text wp_widget_plugin_box">';

    // display titre 
    if ($title) {
      echo $before_title . $title . $after_title;
    }

    ######## Content  
    $this->customFunction("toto");
    ######## 

    echo '</div>';
    echo $after_widget;
  }
} // end class plugin-name


?>