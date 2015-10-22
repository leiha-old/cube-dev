<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 16:40
 */

namespace Cube\Form;

use Cube\Poo\Wrapper\Wrapper;
use Cube\Validator\FieldSet\FieldSetHelper;

abstract class FormWrapper
    extends Wrapper
{
    use FieldSetHelper;

    const CLASS_fieldSet = 'Cube\Form\Form';
    const CLASS_field    = 'Cube\Form\Field\Field';

    /**
     * @return string
     */
    protected function renderBody()
    {
        $body = '';
        foreach($this->fields as $field) {
            $body .= $field->render();
        }
        return $body;
    }

    /**
     * @return string
     */
    protected function renderTag() {
        return '<form>'.$this->renderBody().'</form>';
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->renderTag();
    }


}