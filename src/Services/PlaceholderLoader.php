<?php

namespace Bytenetizen\FastReplace\Services;


use Bytenetizen\FastReplace\Models\Placeholder;
use Bytenetizen\FastReplace\PieceMutators\PieceMutatorsInterface;

class PlaceholderLoader
{

    private Placeholder $placeholder;
    private array $settings;

    private bool $isDebug;

    private const ALERT_NOT_CLASS = '!__ALERT_NOT_CLASS__!';
    private const ALERT_EXCEPTION = '!__ALERT_EXCEPTION__!';

    public function __construct(Placeholder $placeholder, bool $isDebug, array $settings = [] )
    {
        $this->placeholder = $placeholder;
        $this->settings = $settings;
        $this->isDebug = $isDebug;
    }

    public function load()
    {
        try {
            $class = $this->placeholder->doer;

            if(class_exists($class)){
                $instance = new $class();
                if ($instance instanceof PieceMutatorsInterface) {
                    $instance->setDebug($this->isDebug);
                    $instance->setSettings($this->settings);
                    $instance->setPlaceholder($this->placeholder);
                }
                return $instance->getValue();
            }else{
                return $this->isDebug?self::ALERT_NOT_CLASS:'';
            }

        }catch (\Exception $e) {
            info($e->getMessage());
            return $this->isDebug?self::ALERT_EXCEPTION:'';
        }
    }

}
