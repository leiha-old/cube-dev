<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 16:40
 */

namespace Cube\Form;

use Cube\Validator\ValidatorWrapper;

abstract class FormWrapper
    extends ValidatorWrapper
{
    /**
     * @return string
     */
    protected function renderBody()
    {
        $body = '';
        foreach($this->getFields() as $field) {
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