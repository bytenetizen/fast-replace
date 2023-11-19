<?php

namespace Bytenetizen\FastReplace\PieceMutators;

use Bytenetizen\FastReplace\Models\Placeholder;

class Piece implements PieceMutatorsInterface
{
    public array $settings;
    public Placeholder $placeholder;
    public bool $isDebug;

    /**
     * @return string
     */
    public function getValue(): string
    {
        $isDebug = $this->isDebug??false;
        return $isDebug?'!__ALERT_NOT_METHOD__!':'';
    }

    public function setDebug($isDebug): void
    {
        $this->isDebug = $isDebug;
    }
    /**
     * @param array $settings
     * @return void
     */
    public function setSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @param Placeholder $placeholder
     * @return void
     */
    public function setPlaceholder(Placeholder $placeholder): void
    {
        $this->placeholder = $placeholder;
    }

}
