<?php

namespace Drupal\curso_content\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the curso_content entity edit forms.
 */
class CursoContentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New curso_content %label has been created.', $message_arguments));
      $this->logger('curso_content')->notice('Created new curso_content %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The curso_content %label has been updated.', $message_arguments));
      $this->logger('curso_content')->notice('Updated new curso_content %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.curso_content.canonical', ['curso_content' => $entity->id()]);
  }

}
