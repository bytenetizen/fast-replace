<?php

namespace Bytenetizen\FastReplace\PieceMutators;


use Bytenetizen\FastReplace\Models\Placeholder;

interface PieceMutatorsInterface
{
    public function getValue():string;

    public function setSettings(array $settings):void;

    public function setPlaceholder(Placeholder $placeholder):void;

}
