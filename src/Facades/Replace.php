<?php

namespace Bytenetizen\FastReplace\Facades;

use Illuminate\Support\Facades\Facade;

class Replace extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fast-replace';
    }

}
