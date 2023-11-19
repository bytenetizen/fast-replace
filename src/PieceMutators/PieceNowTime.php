<?php

namespace Bytenetizen\FastReplace\PieceMutators;

class PieceNowTime extends Piece
{
    /**
     * @return string
     */
    public function getValue(): string
    {
        return date('l jS \of F Y h:i:s A');
    }
}
