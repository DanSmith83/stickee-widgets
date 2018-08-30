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

    public function calculateRequirements(Int $widgets): Array
    {
        $requirements = [];
        $options = $this->getOptions();


        while ($widgets > 0) {
            $next = $this->getNext($options, $widgets);
            $widgets -= $next;
            array_push($requirements, $next);
        }

        return $requirements;
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
            echo $widgets.'-'.$option.PHP_EOL;
            if ($widgets - $option == 0) {
                return $option;
            }

            if ($widgets - $option >= 0) {
                return in_array($option * 2, $options) ? $option * 2 : $option;
            }
        }

        return min($options);
    }
}