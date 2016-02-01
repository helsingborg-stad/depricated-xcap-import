<?php

namespace KulturkortetImport;

class Event
{
    /**
     * Get poi:s
     * @param  integer $count     Number of POI to get
     * @param  array   $metaQuery Optional meta query array
     * @return object             Object with POI posts
     */
    public static function get($count = 10, $metaQuery = null, $includeDrafts = false)
    {
        $args = array(
            'posts_per_page' => $count,
            'post_type'      => 'events',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        if ($includeDrafts) {
            $args['post_status'] = array('publish', 'draft');
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
        $requiredKeysExists = \KulturkortetImport\Helper\Arr::arrayKeysExist(
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

        $postId = Event::get(1, array(
            array(
                'key' => 'event-uid',
                'value' => $data['id'],
                'compare' => '='
            )
        ), true);
        $postId = isset($postId->ID) ? $postId->ID : null;

        var_dump($postId);

        if ($postId !== null) {
            wp_update_post(array(
                'ID'           => $postId,
                'post_title'   => $data['title'],
                'post_content' => $data['description'],
                'post_type'    => 'events'
            ));
        } else {
            $postId = wp_insert_post(array(
                'post_title'   => $data['title'],
                'post_content' => $data['description'],
                'post_status'  => 'draft',
                'post_type'    => 'events'
            ));
        }

        self::addPostMeta($postId, $data);

        exit;
    }

    /**
     * Set a event post meta fields
     * @param   integer $postId The post's id
     * @param   object  $data   The cbis data
     * @return  void
     */
    private static function addPostMeta($postId, $data)
    {
        update_post_meta($postId, 'event-uid', $data['id']);
    }
}
