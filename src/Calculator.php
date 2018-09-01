<?php

namespace Widgets;

/**
 * Class Calculator
 * @package Widgets
 */
class Calculator
{

    /**
     * @var array
     */
    private $requirements = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var int
     */
    private $target = 0;


    /**
     * Calculator constructor.
     * @param array $options
     */
    public function __construct(Array $options)
    {
        $this->setOptions($options);
    }

    /**
     * @param Int $target
     * @return Array
     */
    public function calculateRequirements(Int $target): Array
    {
        try {
            $this->initialiseRequirements();
            $this->setTarget($target);
            $this->process();

            return $this->removeEmptyOptions();
        } catch (\Exception $e) {
            echo sprintf('Unable to calculate requirements: %s', $e->getMessage());
        }
    }

    /**
     * @return Array
     */
    public function getOptions(): Array
    {
        return $this->options;
    }

    /**
     * @return Void
     * @throws \Exception
     */
    private function initialiseRequirements(): Void
    {
        if (empty($this->options)) {
            throw new \Exception('Options not set');
        }

        foreach ($this->options as $option) {
            $this->requirements[$option] = 0;
        }
    }

    /**
     * @return Void
     */
    private function addPack(): Void
    {
        if ($this->targetUnattainableWith(max($this->options))) {
            $this->addGreatest();
        } else {
            $this->addClosestOption();
        }
    }

    /**
     * @return Void
     */
    private function addGreatest(): Void
    {
        $this->addOptionToRequirements(max($this->options));
    }

    /**
     * @return Void
     */
    private function addSmallest(): Void
    {
        $this->addOptionToRequirements(min($this->options));
    }

    /**
     * @param Int $option
     * @return Void
     */
    private function addOptionToRequirements(Int $option): Void
    {
        $this->decrementTarget($option);

        if ($this->singleCanReplaceDouble($option)) {
            $this->replaceDouble($option);
        } else {
            $this->requirements[$option] ++;
        }
    }


    /**
     * @param array $options
     * @return Void
     */
    private function setOptions(Array $options): Void
    {
        $this->options = $this->sortOptions($options);
    }


    /**
     * @param array $options
     * @return Array
     */
    private function sortOptions(Array $options): Array
    {
        $options = array_filter(array_unique($options), function ($item) {
            return is_int($item);
        });

        rsort($options);

        return $options;
    }


    /**
     * @param Int $option
     * @return bool
     */
    private function singleCanReplaceDouble(Int $option): Bool
    {
        return $this->requirements[$option] == 1 && array_key_exists(($option * 2), $this->requirements);
    }


    /**
     * @param $option
     * @return Void
     */
    private function replaceDouble($option): Void
    {
        $this->requirements[$option]--;
        $this->requirements[$option * 2]++;
    }

    /**
     * @param Int $target
     * @return Void
     * @throws \Exception
     */
    private function setTarget(Int $target): Void
    {
        if ($target > 50000) {
            throw new \Exception('Too many widgets');
        }

        $this->target = $target;
    }

    /**
     * @param $option
     * @return bool
     */
    private function targetUnattainableWith($option): Bool
    {
        return $this->target >= $option;
    }

    /**
     * @return Void
     */
    private function addClosestOption()
    {
        foreach ($this->options as $option) {
            if ($this->targetUnattainableWith($option)) {
                return $this->addOptionToRequirements($option);
            }
        }

        return $this->addSmallest();
    }

    /**
     * @return Array
     */
    private function removeEmptyOptions(): Array
    {
        return array_filter($this->requirements);
    }

    /**
     * @param $option
     * @return Void
     */
    private function decrementTarget($option): Void
    {
        $this->target -= $option;
    }

    /**
     * @return Void
     */
    private function process(): Void
    {
        while ($this->target > 0) {
            $this->addPack($this->target);
        }
    }

}