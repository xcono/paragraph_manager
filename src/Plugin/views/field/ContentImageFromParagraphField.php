<?php

namespace Drupal\paragraph_manager\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\views\Annotation\ViewsField;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * A handler to provide a field that is completely custom by the administrator.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("content_image_from_paragraph_field")
 */
class ContentImageFromParagraphField extends FieldPluginBase
{

    /**
     * {@inheritdoc}
     */
    public function usesGroupBy()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function query()
    {
        // Do nothing -- to override the parent query.
    }

    /**
     * {@inheritdoc}
     */
    protected function defineOptions()
    {
        $options = parent::defineOptions();

        $options['hide_alter_empty'] = ['default' => false];
        return $options;
    }

    /**
     * {@inheritdoc}
     */
    public function buildOptionsForm(&$form, FormStateInterface $form_state)
    {
        parent::buildOptionsForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function render(ResultRow $values)
    {
        // Return a random text, here you can include your custom logic.
        // Include any namespace required to call the method required to generate
        // the desired output.
        $node = $values->_entity;

        $extractor = \Drupal::service('xparagraphs.field.extractor');

        // search first image and summary fields in node paragraphs
        $fields = $extractor->getTeaserFields($node);

        if ($fields['image']) {

            $image = $fields['image']->getValue();

            $file = File::load($image['target_id']);

            $build = [
                '#theme' => 'image_style',
                '#width' => $image['width'],
                '#height' => $image['height'],
                '#style_name' => 'medium',
                '#uri' => $file->getFileUri(),
            ];

            return render($build);
        }

        return '';
    }
}
