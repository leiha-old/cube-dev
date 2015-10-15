<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 20:51
 */

namespace Cube\Generator;

class ClassGeneratorSample
{
    public function ____test() {
        $generator = new ClassGenerator('toto', ClassGenerator::CLASS_TYPE_abstract);
        $generator
            ->setNameSpace('Test\Generator')
            ->setExtend('FakeExtend')
            ->addInterface(array('TotoInterface', 'LooInterface'))
            ->addTrait(array('TotoTrait', 'LooTrait'))
            ->addMethod(
            /**
             * @name loulou
             * @param string $toto
             * @param string $eeee
             * @visibility public

             */
                function ( $toto, $eeee ) {
                    $rr = 'eeeeeeeeeeeeeeeeeeeeeeeee';
                    $$ee = function(){

                    };
                    if($ee) {
                        $rr = 'vvvvvvvvvvvvvvvv';
                    }
                }, array('ee' => 'o_o')
            );

        $render = $generator->render();
        return $render;
    }
}