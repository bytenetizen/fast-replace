<?php

namespace Bytenetizen\FastReplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Placeholder extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
    ];

    public function createPlaceholder($piece, $doer, $adminId, $comments): void
    {
        $pl = new Placeholder();
        $pl->piece = $piece;
        $pl->doer = $doer;
        $pl->admin_id = $adminId;
        $pl->comments = $comments;
        $pl->save();
    }

    public static function getPlaceholder($piece)
    {
       return Placeholder::select(['doer','piece','admin_id','comments'])
            ->wherePiece($piece)->latest('id')->first();
    }

}
