<?php

namespace Bytenetizen\FastReplace\Seeders;


use Bytenetizen\FastReplace\Models\Placeholder;
use Illuminate\Database\Seeder;

class PlaceholderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $service = new Placeholder();
        $data = [
            ['piece' => 'TEST', 'doer' => 'Bytenetizen\FastReplace\PieceMutators\PieceTest', 'adminId' => '1', 'comments' => 'Example value'],
            ['piece' => 'NOW_TIME', 'doer' => 'Bytenetizen\FastReplace\PieceMutators\PieceNowTime', 'adminId' => '1', 'comments' => 'Example value 2'],
        ];

        foreach ($data as $item) {
            $service->createPlaceholder(...array_values($item));
        }

    }
}
