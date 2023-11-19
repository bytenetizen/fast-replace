<?php

namespace Bytenetizen\FastReplace;


use Bytenetizen\FastReplace\Services\PlaceholderService;

class Replace
{

    private array $replacementArray, $matchesCache, $settings;

    public function transform(string $rawText, $settings = []): array|string|null
    {
        $this->settings = $settings;
        $this->replacementArray = $settings['arrPlaceholder']??[];
        $placeholderService = new PlaceholderService();
        return preg_replace_callback('/{{\s*([A-Z_]+)\s*}}/i', function ($matches) use ($placeholderService) {
            return $this->replacePlaceholdersGenerator($matches[0],$placeholderService)->current();
        }, $rawText);
    }

    private function replacePlaceholdersGenerator($startText, $placeholderService): \Generator
    {
        $pattern = '/{{\s*([A-Z_]+)\s*}}/i';


        if (!isset($this->matchesCache[$startText])) {
            preg_match_all($pattern, $startText, $this->matchesCache[$startText]);
        }

        $matches = $this->matchesCache[$startText];

        foreach ($matches[1] as $piece) {

            if(isset($this->replacementArray[$piece])){
                yield $this->replacementArray[$piece];
            }else{
                $result = $placeholderService->startProcess($piece, $this->settings);
                $this->replacementArray[$piece] = $result;
                yield $this->replacementArray[$piece];
            }
        }
    }

    public static function cleanPlaceholder($rawText,$arrFields): string|null
    {
        return preg_replace_callback('|({{)(.+)(}})|iU', function ($matches) use ($arrFields) {

            if(in_array($matches[2],$arrFields)){
                return '';
            }

            return '{{'.$matches[2].'}}';
        }, $rawText);

    }

}
