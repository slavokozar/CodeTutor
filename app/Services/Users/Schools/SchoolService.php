<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:44
 */

namespace App\Services\Users\Schools;

use App\Models\Users\School;
use Illuminate\Support\Facades\Response;

class SchoolService
{
    public function all()
    {
        return School::all();
    }

    public function getOrFail($code)
    {
        $schoolObj = $this->get($code);

        if ($schoolObj == null) {
            $this->fail($code);
        } else {
            return $schoolObj;
        }
    }

    private function get($code)
    {
        return School::where('code', $code)->firstOrFail();
    }

    private function fail($code)
    {
        Response::make('School ' . $code . 'not found!', 404);
    }
}