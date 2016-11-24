<?php

namespace Drupal\paragraph_manager\Service;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

class FieldExtractor
{

    public function getTeaserFields(Node $node)
    {

        $paragraphs = $node->get('field_paragraphs')->referencedEntities();

        $summary = null;
        $image = null;

        // Search summary and image
        foreach ($paragraphs as $paragraph) {

            if (!$summary && ('paragraph_summary' == $paragraph->bundle())) {

                $summary = $paragraph->get('field_paragraph_body')->first();
            }

            if (!$image && ('paragraph_image' == $paragraph->bundle())) {

                $image = $paragraph->get('field_paragraph_image')->first();
            }

            if ($image && $summary) {
                break;
            }
        }

        // try to find image among multiple image fields if no image in single field
        if (!$image) {

            foreach ($paragraphs as $paragraph) {

                if (!$image && ('paragraph_images' == $paragraph->bundle())) {

                    $image = $paragraph->get('field_paragraph_images')->first();
                }
            }
        }

        return [
            'summary' => $summary,
            'image' => $image
        ];

    }

    public function getTeaserValues(NodeInterface $node, $imageStyle = false)
    {

        $fields = $this->getTeaserFields($node);

        $values = [
            'title' => $node->getTitle()
        ];

        if (!empty($fields['summary']) && $summary = $fields['summary']->getValue()) {

            $values['summary_text'] = $summary['value'];
        }

        if (!empty($fields['image']) && $image = $fields['image']->getValue()) {

            $file = File::load($image['target_id']);
            $uri = $file->getFileUri();

            if ($imageStyle) {

                $values['image_url'] = ImageStyle::load($imageStyle)->buildUrl($uri);
            } else {

                $values['image_url'] = file_create_url($uri);
            }


            $values['image_realpath'] = drupal_realpath($uri);

            $values['image_mime'] = $file->getMimeType();
        }

        return $values;
    }


    public function getFullText(Node $node)
    {

        $text = '';

        $paragraphs = $node->get('field_paragraphs')->referencedEntities();

        foreach ($paragraphs as $paragraph) {

            if (in_array($paragraph->bundle(), ['paragraph_summary', 'paragraph_body', 'paragraph_quote'])) {

                $body = $paragraph->get('field_paragraph_body')->getValue();

                if (!empty($body[0]['value'])) {
                    $text .= $body[0]['value'];
                }


            }

        }

        return $text;
    }
}