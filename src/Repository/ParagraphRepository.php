<?php

namespace Drupal\paragraph_manager\Repository;


use Drupal\paragraphs\Entity\Paragraph;

class ParagraphRepository
{

    public function findByType($nid, $type)
    {

        $query = \Drupal::entityQuery('paragraph')
            ->condition('type', $type)
            ->condition('parent_id', $nid);

        $ids = $query->execute();

        if ($ids) {
            return Paragraph::load(reset($ids));
        }

        return false;

    }

    public function findWithVideo($limit = 10)
    {

        $query = \Drupal::entityQuery('paragraph')
            ->condition('type', 'paragraph_youtube')
            ->sort('created', 'DESC')
            ->range(0, $limit);

        $ids = $query->execute();

        return $ids ? Paragraph::loadMultiple($ids) : [];
    }

    public function findBy(array $conditions)
    {

        $query = \Drupal::entityQuery('paragraph')
            ->sort('created', 'DESC')
            ->exists('parent_id');

        if (!empty($conditions['type'])) {
            $query->condition('type', $conditions['type']);
        }

        if (!empty($conditions['limit'])) {
            $query->range(0, $conditions['limit']);
        }

        if (!empty($conditions['pager'])) {
            $query->pager($conditions['pager']);
        }

        $ids = $query->execute();

        return $ids ? Paragraph::loadMultiple($ids) : [];
    }
}