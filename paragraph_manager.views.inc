<?php

/**
 * @file
 * Contains paragraph_manager\paragraph_manager.views.inc..
 * Provide a custom views field data that isn't tied to any other module.
 */

/**
* Implements hook_views_data().
*/
function paragraph_manager_views_data() {

    return [
        'views' => [
            'table' => [
                'group' => t('Custom Global'),
                'join' => [
                    '#global' => []
                ]
            ],
            'content_image_from_paragraph_field' => [
                'title' => t('Content image from paragraph field'),
                'help' => t('Extract image from content paragraphs'),
                'field' => [
                    'id' => 'content_image_from_paragraph_field',
                ]
            ]
        ]
    ];
}
