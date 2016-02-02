<?php

namespace HbgEventImporter;

class Event
{
    public static function initPostType()
    {
        $icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9Ijk4NS4zMzNweCIgaGVpZ2h0PSI5ODUuMzM0cHgiIHZpZXdCb3g9IjAgMCA5ODUuMzMzIDk4NS4zMzQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDk4NS4zMzMgOTg1LjMzNDsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZD0iTTg2OC41NjUsNDkyLjhjLTQuNCwyMi4xMDEtMjQsMzguMi00Ny41LDM5LjJjLTcuNCwwLjMtMTMuNyw1LjctMTUuMTAxLDEzYy0xLjUsNy4zLDIuMiwxNC43LDguOSwxNy44DQoJCWMyMS4zLDEwLDMzLjIsMzIuNCwyOC43LDU0LjVsLTQuMiwyMWMtNS41LDI3LjctMzYuMTAxLDQ1LTYyLjksMzguNGMtNy41LTEuOC0xNS4yLTMuMi0yMi44LTQuN2MtMTEuMi0yLjItMjIuNC00LjUtMzMuNi02LjcNCgkJYy0xNC44MDEtMy0yOS42MDEtNS44OTktNDQuNC04Ljg5OWMtMTcuNi0zLjUtMzUuMy03LjEwMS01Mi45LTEwLjYwMWMtMTkuNjk5LTQtMzkuMzk5LTcuODk5LTU5LjEtMTEuODk5DQoJCWMtMjEtNC4yLTQyLjEtOC40LTYzLjEtMTIuN2MtMjEuNjAxLTQuMy00My4yLTguNy02NC43LTEzYy0yMS40LTQuMy00Mi43LTguNjAxLTY0LjEwMS0xMi45Yy0yMC4zOTktNC4xLTQwLjgtOC4yLTYxLjE5OS0xMi4zDQoJCWMtMTguNy0zLjctMzcuMy03LjUtNTYtMTEuMmMtMTYuMi0zLjItMzIuNC02LjUtNDguNS05LjdjLTEyLjktMi42LTI1LjgtNS4xOTktMzguOC03LjhjLTguOS0xLjgtMTcuODAxLTMuNi0yNi43LTUuMzk5DQoJCWMtNC4xMDEtMC44MDEtOC4yLTEuNy0xMi4zLTIuNWMtMC4yLDAtMC40LTAuMTAxLTAuNjAxLTAuMTAxYzIuMiwxMC40LDEuMiwyMS41LTMuNiwzMS45Yy0xMC4xMDEsMjEuOC0zMy42MDEsMzMuMi01Ni4yLDI4LjgNCgkJYy02LjctMS4zLTE0LDEuMi0xNi45LDcuNGwtOSwxOS41Yy0yLjg5OSw2LjE5OSwwLDEzLjM5OSw1LjMwMSwxNy42OTljMSwwLjgwMSw3MjEuOCwzMzMuMTAxLDcyMi45OTksMzMzLjQNCgkJYzYuNywxLjMsMTQtMS4yLDE2LjktNy40bDktMTkuNWMyLjktNi4xOTksMC0xMy4zOTktNS4zLTE3LjY5OWMtMTgtMTQuMzAxLTI0LjYwMS0zOS42MDEtMTQuNS02MS40YzEwLjEtMjEuOCwzMy42LTMzLjIsNTYuMi0yOC44DQoJCWM2LjY5OSwxLjMsMTQtMS4yLDE2Ljg5OS03LjRsOS0xOS41YzIuOS02LjIsMC0xMy4zOTktNS4zLTE3LjdjLTE4LTE0LjMtMjQuNi0zOS42LTE0LjUtNjEuMzk5czMzLjYtMzMuMiw1Ni4yLTI4LjgNCgkJYzYuNywxLjMsMTQtMS4yLDE2LjktNy40bDktMTkuNWMyLjg5OS02LjIsMC0xMy40LTUuMzAxLTE3LjdjLTE4LTE0LjMtMjQuNi0zOS42LTE0LjUtNjEuNGMxMC4xMDEtMjEuOCwzMy42MDEtMzMuMTk5LDU2LjItMjguOA0KCQljNi43LDEuMywxNC0xLjIsMTYuOS03LjM5OWw5Ljg5OS0yMS42MDFjMi45LTYuMiwwLjItMTMuNS02LTE2LjM5OWwtMTA3LjY5OS00OS43TDg2OC41NjUsNDkyLjh6Ii8+DQoJPHBhdGggZD0iTTkuNjY1LDQ4NS45YzEuMiwwLjYsNzc5LjMsMTU2LjY5OSw3ODAuNiwxNTYuNjk5YzYuODAxLTAuMywxMy40LTQuNSwxNC43LTExLjFsNC4yLTIxYzEuMy02LjctMy4xLTEzLjEtOS4zLTE2DQoJCWMtMjAuOC05LjgtMzMuMTAxLTMyLjgtMjguNC01Ni40YzQuNy0yMy42LDI1LTQwLjEsNDgtNDEuMWM2LjgtMC4zLDEzLjQtNC41LDE0LjctMTEuMWwzLjEtMTUuNGwxLjEwMS01LjcNCgkJYzEuMy02LjctMy4xMDEtMTMuMS05LjMtMTZjLTIwLjgwMS05LjgtMzMuMTAxLTMyLjgtMjguNC01Ni4zOTljNC43LTIzLjYwMSwyNS00MC4xMDEsNDgtNDEuMTAxYzYuOC0wLjMsMTMuNC00LjUsMTQuNy0xMS4xDQoJCWw0LjItMjFjMS4zLTYuNy0zLjEwMS0xMy4xLTkuMzAxLTE2Yy0yMC44LTkuOC0zMy4xLTMyLjgtMjguMzk5LTU2LjRjNC43LTIzLjYsMjUtNDAuMSw0OC00MS4xYzYuOC0wLjMsMTMuMzk5LTQuNSwxNC43LTExLjENCgkJbDQuNjk5LTIzLjNjMS4zMDEtNi43LTMtMTMuMi05LjY5OS0xNC41YzAsMC03ODEuOS0xNTYuOC03ODIuNy0xNTYuOGMtNS44LDAtMTAuOSw0LjEtMTIuMSw5LjlsLTQuNywyMy4zDQoJCWMtMS4zLDYuNywzLjEsMTMuMSw5LjMsMTZjMjAuOCw5LjgsMzMuMSwzMi44LDI4LjQsNTYuNGMtNC43LDIzLjYtMjUsNDAuMS00OCw0MS4xYy02LjgwMSwwLjMtMTMuNCw0LjUtMTQuNywxMS4xbC00LjIsMjENCgkJYy0xLjMsNi43LDMuMSwxMy4xLDkuMywxNmMyMC44LDkuOCwzMy4xMDEsMzIuOCwyOC40LDU2LjRjLTQuNywyMy42LTI1LDQwLjEtNDgsNDEuMWMtNi44LDAuMy0xMy40LDQuNS0xNC43LDExLjFsLTQuMiwyMQ0KCQljLTEuMyw2LjcsMy4xMDEsMTMuMSw5LjMsMTZjMjAuODAxLDkuOCwzMy4xMDEsMzIuOCwyOC40LDU2LjRjLTQuNywyMy42MDEtMjUsNDAuMTAxLTQ4LDQxLjEwMWMtNi44LDAuMy0xMy40LDQuNS0xNC43LDExLjENCgkJbC00LjIsMjFDLTAuOTM1LDQ3Ni43LDMuNDY0LDQ4Myw5LjY2NSw0ODUuOXogTTY3Ni4xNjUsMjI5LjZjMi43LTEzLjUsMTUuOS0yMi4zLDI5LjQtMTkuNnMyMi4zLDE1LjksMTkuNiwyOS40bC0zMywxNjQuMg0KCQlsLTIwLjMsMTAxLjJjLTIuNCwxMS45LTEyLjgsMjAuMTAxLTI0LjUsMjAuMTAxYy0xLjYwMSwwLTMuMy0wLjItNC45LTAuNWMtMTMuNS0yLjctMjIuMy0xNS45LTE5LjYtMjkuNGwyMi43LTExMi45TDY3Ni4xNjUsMjI5LjYNCgkJeiBNMjI1LjM2NSwxMzkuMWMyLjctMTMuNSwxNS45LTIyLjMsMjkuNC0xOS42czIyLjMsMTUuOSwxOS42LDI5LjRsLTExLjQsNTYuN2wtMTIuODk5LDY0LjNsLTEwLjQsNTEuOGwtMTguNSw5Mi42DQoJCWMtMi4zOTksMTEuOS0xMi44LDIwLjEwMS0yNC41LDIwLjEwMWMtMS42LDAtMy4zLTAuMi00Ljg5OS0wLjVjLTAuNy0wLjEwMS0xLjQtMC4zMDEtMi0wLjVjLTEyLjQtMy42MDEtMjAuMTAxLTE2LjEwMS0xNy41LTI4LjkNCgkJbDMuNjk5LTE4LjdsOS43LTQ4LjRMMjI1LjM2NSwxMzkuMXoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K';

        $labels = array(
            'name'               => _x('Evenemang', 'post type name'),
            'singular_name'      => _x('Evenemang', 'post type singular name'),
            'menu_name'          => __('Evenemang'),
            'add_new'            => __('Lägg till nytt evenemang'),
            'add_new_item'       => __('Lägg till evenemang'),
            'edit_item'          => __('Redigera evenemang'),
            'new_item'           => __('Nytt evenemang'),
            'all_items'          => __('Alla evenemang'),
            'view_item'          => __('Visa evenemang'),
            'search_items'       => __('Sök evenemang'),
            'not_found'          => __('Inga evenemang att visa'),
            'not_found_in_trash' => __('Inga evenemang i papperskorgen')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => 'Events',
            'menu_icon'            => $icon,
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => true,
            'show_in_nav_menus'    => true,
            'has_archive'          => true,
            'rewrite'              => array(
                'slug'       => 'event',
                'with_front' => false
            ),
            'hierarchical'         => false,
            'exclude_from_search'  => false,
            'taxonomies' => array('event-types'),
            'supports'             => array('title', 'revisions', 'editor')
        );

        register_post_type('event', $args);

        // Daily cron
        if (!wp_next_scheduled('import_events_daily')) {
            wp_schedule_event(time(), 'daily', 'import_events_daily');
        }

        add_action('manage_posts_extra_tablenav', function ($which) {
            global $current_screen;

            if ($current_screen->id != 'edit-event' || $which != 'top') {
                return;
            }

            echo '<div class="alignleft actions">';
                echo '<a href="' . admin_url('options.php?page=import-events') . '" class="button-primary" id="post-query-submit">Import now</a>';
            echo '</div>';
        });

        // Setup table columns
        add_filter('manage_edit-event_columns', '\HbgEventImporter\Event::defineListColumns'); // Columns
        add_filter('manage_edit-event_sortable_columns', '\HbgEventImporter\Event::sortListColumns'); // Sorting
        add_action('manage_event_posts_custom_column', '\HbgEventImporter\Event::listColumnContent', 10, 2); // Column content

        self::registerTaxonomy();
    }

    /**
     * Create a taxonomy
     *
     * @uses  Inserts new taxonomy object into the list
     * @uses  Adds query vars
     *
     * @param string  Name of taxonomy object
     * @param array|string  Name of the object type for the taxonomy object.
     * @param array|string  Taxonomy arguments
     * @return null|WP_Error WP_Error if errors, otherwise null.
     */
    public static function registerTaxonomy()
    {
        $labels = array(
            'name'                  => _x('Event categories', 'Taxonomy plural name', 'hbg-event-importer'),
            'singular_name'         => _x('Event category', 'Taxonomy singular name', 'hbg-event-importer'),
            'search_items'          => __('Search Event Categories', 'hbg-event-importer'),
            'popular_items'         => __('Popular Event Categories', 'hbg-event-importer'),
            'all_items'             => __('All Event Categories', 'hbg-event-importer'),
            'parent_item'           => __('Parent Event Category', 'hbg-event-importer'),
            'parent_item_colon'     => __('Parent Event Category', 'hbg-event-importer'),
            'edit_item'             => __('Edit Event Category', 'hbg-event-importer'),
            'update_item'           => __('Update Event Category', 'hbg-event-importer'),
            'add_new_item'          => __('Add New Event Category', 'hbg-event-importer'),
            'new_item_name'         => __('New Event Category', 'hbg-event-importer'),
            'add_or_remove_items'   => __('Add or remove Event Categories', 'hbg-event-importer'),
            'choose_from_most_used' => __('Choose from most used Event Categories', 'hbg-event-importer'),
            'menu_name'             => __('Event Category', 'hbg-event-importer'),
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'show_in_nav_menus'     => true,
            'show_admin_column'     => false,
            'hierarchical'          => false,
            'show_tagcloud'         => true,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => true
        );

        register_taxonomy('event-types', array('event'), $args);
    }

    /**
     * Defines list columns
     * @param  array $columns Original columns
     * @return array          Custom columns
     */
    public static function defineListColumns($columns)
    {
        $columns = array(
            'cb'               => '<input type="checkbox">',
            'title'            => __('Event'),
            'event-start-date' => __('Start date'),
            'event-end-date'   => __('End date')
        );

        return $columns;
    }

    /**
     * Define sortable columns
     * @param  array $columns Original columns
     * @return array          Custum columns
     */
    public static function sortListColumns($columns)
    {
        $columns['event-start-date'] = 'event-start-date';
        $columns['event-end-date'] = 'event-end-date';

        return $columns;
    }

    /**
     * Set list column content
     * @param  string  $column Column id
     * @param  integer $postId Column post id
     * @return void
     */
    public static function listColumnContent($column, $postId)
    {
        switch ($column) {
            case 'event-start-date':
                echo get_field('event-date-start', $postId) ? date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start', $postId))) : '';
                break;

            case 'event-end-date':
                echo get_field('event-date-end', $postId) ? date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-end', $postId))) : '';
                break;
        }
    }

    /**
     * Get poi:s
     * @param  integer $count     Number of POI to get
     * @param  array   $metaQuery Optional meta query array
     * @return object             Object with POI posts
     */
    public static function get($count = 10, $metaQuery = null, $postStatus = array())
    {
        $args = array(
            'posts_per_page' => $count,
            'post_type'      => 'event',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        if ($postStatus) {
            $args['post_status'] = $postStatus;
        }

        if (is_array($metaQuery)) {
            $args['meta_query'] = $metaQuery;
        }

        $posts = get_posts($args);

        if ($count == 1 && isset($posts[0])) {
            $posts = $posts[0];
        }

        return $posts;
    }

    /**
     * Adds an event
     *
     * Data should include the following keys
     * - id (unique event id)
     * - date_start (unix timestamp)
     * - date_end (unix timestamp)
     * - title (event title)
     * - description (description text)
     * - categories (array of categories)
     * - location (name of city)
     * - address
     * - image_url
     *
     * @param array $data Event data
     */
    public static function add($data = array())
    {
        $requiredKeysExists = \HbgEventImporter\Helper\Arr::arrayKeysExist(
            $data,
            'id',
            'date_start',
            'date_end',
            'title',
            'description',
            'categories',
            'location',
            'address',
            'image_url'
        );

        if (!$requiredKeysExists) {
            return false;
        }

        // Check if event uid already exists
        $postId = Event::get(1, array(
            array(
                'key' => 'event-uid',
                'value' => $data['id'],
                'compare' => '='
            )
        ), array('publish', 'draft', 'pending'));
        $postId = isset($postId->ID) ? $postId->ID : null;

        // Update or create event
        if ($postId !== null) {
            if (get_field('event-sync', $postId) !== true) {
                return;
            }

            wp_update_post(array(
                'ID'           => $postId,
                'post_title'   => $data['title'],
                'post_content' => $data['description']
            ));
        } else {
            $postId = wp_insert_post(array(
                'post_title'   => $data['title'],
                'post_content' => $data['description'],
                'post_status'  => get_field('xcap_post_status', 'option') ? get_field('xcap_post_status', 'option') : 'publish',
                'post_type'    => 'event'
            ));
        }

        $data['categories'] = array_map('ucwords', $data['categories']);
        wp_set_object_terms($postId, $data['categories'], 'event-types', true);

        self::addPostMeta($postId, $data);
    }

    /**
     * Set a event post meta fields
     * @param   integer $postId The post's id
     * @param   object  $data   The cbis data
     * @return  void
     */
    private static function addPostMeta($postId, $data)
    {
        update_post_meta($postId, 'event-sync', true);
        update_post_meta($postId, 'event-uid', $data['id']);
        update_post_meta($postId, 'event-date-start', $data['date_start']);
        update_post_meta($postId, 'event-date-end', $data['date_end']);
        update_post_meta($postId, 'event-location', $data['location']);
        update_post_meta($postId, 'event-address', $data['address']);
        update_post_meta($postId, 'event-image_url', $data['image_url']);
    }
}
