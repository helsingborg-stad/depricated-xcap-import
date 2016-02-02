<?php

namespace HbgEventImporter;

class App
{
    public function __construct()
    {
        if (!file_exists(WP_CONTENT_DIR . '/mu-plugins/AcfImportCleaner.php')) {
            require_once HBGEVENTIMPORTER_PATH . 'source/php/Helper/AcfImportCleaner.php';
        }

        register_activation_hook(plugin_basename(__FILE__), '\HbgEventImporter\App::addCronJob');
        register_deactivation_hook(plugin_basename(__FILE__), '\HbgEventImporter\App::removeCronJob');

        add_filter('acf/settings/load_json', array($this, 'acfJsonLoadPath'));

        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));

        add_action('init', '\HbgEventImporter\Event::initPostType');

        add_action('admin_menu', array($this, 'createParsePage'));
        add_action('admin_notices', array($this, 'adminNotices'));

        // Register cron action
        add_action('import_events_daily', array($this, 'startImport'));

        new Admin\Options();
    }

    public function adminNotices()
    {
        global $current_screen;

        if ($current_screen->id != 'edit-event') {
            return;
        }

        if (isset($_GET['msg']) && $_GET['msg'] == 'import-complete') {
            echo '<div class="updated"><p>Events imported</p></div>';
        }
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        global $current_screen;

        if ($current_screen->id == 'event' && $current_screen->action == '') {
            wp_enqueue_style('hbg-event-importer', HBGEVENTIMPORTER_URL . '/dist/css/hbg-event-importer.min.css');
        }
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        global $current_screen;

        if ($current_screen->id == 'event' && $current_screen->action == '') {
            wp_enqueue_script('hbg-event-importer', HBGEVENTIMPORTER_URL . '/dist/js/hbg-event-importer.min.js');
        }
    }

    /**
     * Creates a admin page to trigger update data function
     * @return void
     */
    public function createParsePage()
    {
        add_submenu_page(
            null,
            __('Import events', 'hbg-event-importer'),
            __('Import events', 'hbg-event-importer'),
            'edit_posts',
            'import-events',
            function () {
                new \HbgEventImporter\Parser\Xcap('http://mittkulturkort.se/calendar/listEvents.action?month=&date=&categoryPermaLink=&q=&p=&feedType=ICAL_XML');
                echo '<script>location.href = "' . admin_url('edit.php?post_type=event&msg=import-complete') . '";</script>';
            }
        );
    }

    /**
     * Starts the data import
     * @return void
     */
    public function startImport()
    {
        if (get_field('xcap_daily_cron', 'option') === true || empty(get_field('xcap_daily_cron', 'option'))) {
            $xcapUrl = 'http://mittkulturkort.se/calendar/listEvents.action' .
                       '?month=&date=&categoryPermaLink=&q=&p=&feedType=ICAL_XML';
            new \HbgEventImporter\Parser\Xcap($xcapUrl);
        }
    }

    public function acfJsonLoadPath($paths)
    {
        $paths[] = HBGEVENTIMPORTER_PATH . '/acf-exports';
        return $paths;
    }

    public static function addCronJob()
    {
        wp_schedule_event(time(), 'daily', 'import_events_daily');
    }

    public static function removeCronJob()
    {
        wp_clear_scheduled_hook('import_events_daily');
    }
}
