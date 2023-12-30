<?php
/**
 * Plugin Name:       WP Data Table
 * Plugin URI:        https://classysystem.com/plugin/wp-column/
 * Description:       WordPress data table usages
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Gazi Akter
 * Author URI:        https://gaziakter.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://classysystem.com/
 * Text Domain:       data-table
 * Domain Path:       /languages
 */

 include_once "class.persons-table.php";


 /**
  * Load textdomain
  */
 function wdtable_textdomain(){
    load_textdomain( "data-table", false, dirname(__FILE__)."/languages" );
 }
 add_action( "plugins_loaded", "wdtable_textdomain" );

 /**
  * Creation admin menu
  */
 function wdtable_admin_menu(){
    add_menu_page(
        __('Data Table', 'data-table'),
        __('Data Table', 'data-table'),
        'manage_options',
        'datatable',
        'wdtable_display_table'
    );

    function wdtable_display_table(){
        include_once "dataset.php";
        $table = new Persons_Table();
        $table->set_data($data);
        $table->prepare_items();
        ?>
        <div class="wrap">
            <h2><?php _e("Persons", "data-table"); ?></h2>
            <form>
                <?php
                    $table->search_box('search', 'search_id');
                    $table->display();
                ?>
            </form>
        </div>
        <?php
    }

 }
 add_action('admin_menu', 'wdtable_admin_menu');
