<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Heroe extends Model
{

    protected $fillable  = ['id', 'name'];
    private static $test = [];

    public static function all($array = [])
    {

        $her        = [];
        $her[]      = new Heroe(['id' => '1', 'name' => 'Mr. Nices']);
        $her[]      = new Heroe(['id' => '2', 'name' => 'Narco']);
        $her[]      = new Heroe(['id' => '3', 'name' => 'Bombasto']);
        $her[]      = new Heroe(['id' => '4', 'name' => 'Celeritas']);
        $her[]      = new Heroe(['id' => '5', 'name' => 'Magneta']);
        $her[]      = new Heroe(['id' => '6', 'name' => 'RubberMan']);
        $her[]      = new Heroe(['id' => '7', 'name' => 'Dynama']);
        $her[]      = new Heroe(['id' => '8', 'name' => 'Dr IQ']);
        $her[]      = new Heroe(['id' => '9', 'name' => 'Magma']);
        $her[]      = new Heroe(['id' => '10', 'name' => 'Tornado']);
        self::$test = $her;
        return new \Illuminate\Database\Eloquent\Collection(self::$test);
    }

    public static function findOrFail($id)
    {
        self::all();
        $data = array_filter(self::$test,
                             function($v)use(&$id) {
            if ($v->id == $id) {
                return true;
            }
            return false;
        });
        return $data[key($data)];
    }

}
