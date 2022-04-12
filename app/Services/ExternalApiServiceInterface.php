<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 4/12/22
 * Time: 11:55 PM
 */

namespace App\Services;


interface ExternalApiServiceInterface
{
    public function getSourceDetail(int $id);
}