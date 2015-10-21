<?php
/**
 * Class WizardBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Wizard;

use Cube\Collection\Collection;
use Cube\FileSystem\FileSystem;
use Cube\FileSystem\FileSystemConfigurator;

trait WizardBehavior
{
//    use CollectionBehavior {
//
//    }

    /**
     * @var Collection
     */
    private $classes;

    /**
     * @var Collection
     */
    private $behaviors;

    public function __construct()
    {
        $this->classes   = Collection::instance();
        $this->behaviors = Collection::instance();
    }

    public function extractClasses()
    {
        $configurator = FileSystemConfigurator::instance();

        $fs = FileSystem::single($configurator);
        $fs->____configureFileSystem($configurator);

        $fs->iterateIncludePaths(function(\DirectoryIterator $item) {

        });
    }

    private function retrieve()
    {
        /**
         * @param array $traits
         * @param string $className
         * @internal param array $traits
         */
        $iterateClasses = function(array $traits, $className)
        {
            /**
             * @param array $behavior
             */
            $populateBehaviors = function(array &$behavior)
            use ($className, $traits)
            {
                // If Class has a Behavior trait we store the class name
                if(count($behavior) && in_array($behavior['trait'], $traits)) {
                    $behavior['classes'][] = $className;
                }
            };
            $this->behaviors->iterateItem('Inline', $populateBehaviors);
        };
        $this->classes->iterate($iterateClasses);
    }


}