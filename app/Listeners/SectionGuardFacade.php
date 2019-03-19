<?php
/**
 * Created by PhpStorm.
 * User: argen
 * Date: 01/03/2019
 * Time: 20:55
 */

namespace App\Listeners;


use Illuminate\Support\Facades\Facade;

class SectionGuardFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SectionGuardManager::class;
    }

}