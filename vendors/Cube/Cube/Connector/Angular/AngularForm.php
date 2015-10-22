<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 17:55
 */

namespace Cube\Connector\Angular;

use Cube\Form\FormWrapper;

class AngularForm
    extends FormWrapper
{
    const CLASS_fieldSet = 'Cube\Connector\AngularForm';
    const CLASS_field    = 'Cube\Connector\AngularField';

    private static $allowedAttributes = array(
        'app'  => array(),
        'class' => array(
            'has-error', 'has-success'
        ),
        'model'=> array(),
        'model-options'=> array(),
        'controller'=> array(),
    );

    /**
     * @return string
     */
    public function render()
    {
        return $this->tag('div', $this->renderBody(), $this->renderAttributes());
    }



}