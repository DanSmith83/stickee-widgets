<?php

namespace Widgets;

class Calculator {

    public function __construct(Array $options)
    {
        $this->setOptions($this->sortOptions($options));
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function calculateRequirements(Int $target): Array
    {
        $widgets = $target;
        $options = $this->getOptions();

        foreach ($options as $option) {
            $requirements[$option] = 0;
        }

        while ($widgets > 0) {
            $next = $this->getNext($options, $widgets);
            $widgets -= $next;
            $requirements[$next] ++;
        }

        return $this->cleanUp($requirements);
    }

    function cleanUp($initialRequirements)
    {
        $requirements = [];

        foreach ($initialRequirements as $requirement => $value) {
            if ($value > 1) {
                if (array_key_exists($requirement * 2, $initialRequirements)) {
                    $requirements[$requirement * 2] ++;
                } else {
                    $requirements[$requirement] = $value;
                }
            } else {
                $requirements[$requirement] = $value;
            }
        }

        return array_filter($requirements);
    }

    /**
     * @param $options
     */
    private function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param array $options
     * @return array
     */
    private function sortOptions(Array $options)
    {
        $options = array_filter( array_unique($options), function($item) {
            return is_int($item);
        });

        rsort($options);

        return $options;
    }

    private function getNext($options, $widgets)
    {
        if ($widgets >= max($options)) {
            return max($options);
        }

        foreach ($options as $key => $option) {
            //echo $widgets.'-'.$option.PHP_EOL;
            if ($widgets - $option == 0) {
                return $option;
            }

            if ($widgets - $option >= 0) {
                return $option;
            }



            /*
            if ($widgets - $option < 0 && $widgets - $options[$key + 1] > 0) {
                return $option;
            }
            */

            /*
            if ($widgets - $option < 0 && (abs($widgets - $option) < ($options[$key + 1]))) {
                return $option;
            }
            */

        }

        return min($options);
    }
}