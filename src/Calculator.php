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
        $options = array_unique($options);
        sort($options);

        return $options;
    }
}