<?php

namespace Bytenetizen\FastReplace\Services;

use Bytenetizen\FastReplace\Models\Placeholder;
use Illuminate\Support\Facades\Cache;

class PlaceholderService
{

    private int $lifeCache;
    private bool $useCache, $isDebug;
    private string $piece;

    private const MINUTES_IN_HOUR = 60;

    public function __construct()
    {
        $this->isDebug = config('replace.is_debug');
        $this->useCache = config('replace.use_cache');
        $minute = config('replace.life_cache');
        $this->lifeCache = $minute * self::MINUTES_IN_HOUR;
    }

    public function startProcess($piece, $settings): string
    {
        $this->piece = $piece;
        $uni = $settings['uni']??uniqid();

        $placeholder = $this->fetchDataFromDatabase($uni);

        if ($placeholder){
            $placeholderService = new PlaceholderLoader($placeholder, $this->isDebug, $settings);
            return $placeholderService->load();
        }

       return $this->isDebug?"!_EMPTY_{{{$this->piece}}}_!":'';

    }

    private function fetchDataFromDatabase($uni)
    {

        try {
            $piece = $this->piece;

            if($this->useCache){
                $remember = $piece.'_'.$uni;
                return Cache::remember($remember, $this->lifeCache, function () use ($piece) {
                    return Placeholder::getPlaceholder($piece);
                });
            }

            return Placeholder::getPlaceholder($piece);

        }catch (\Exception $e) {
            info($e->getMessage());
            return null;
        }

    }

}
