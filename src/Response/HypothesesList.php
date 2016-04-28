<?php

namespace SpeechKit\Response;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class HypothesesList extends \SplFixedArray
{
    /**
     * {@inheritdoc}
     */
    public function offsetSet($index, $newval)
    {
        if (!empty($newval) && false === $newval instanceof Hypothesis) {
            throw new \InvalidArgumentException(
                sprintf('HypothesesList could only contain Hypothesis, %s given.', get_class($newval))
            );
        }
        parent::offsetSet($index, $newval);
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
        // Only required for specs to work
    }
}