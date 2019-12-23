<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =['key','value'];

    public static function getData($key){
        $key =Setting::where('key',$key)->first();
        return $key->value;
    }
    public static function updateData($key,$value){
        if(isset($key) && !empty($key)){
            $setting =Setting::where('key',$key)->first();
            if($setting){
                $setting->value =$value;
                $setting ->save();
            }else{
                $setting =new Setting();
                $setting ->fill(['key'=>$key,'value'=>$value]);

                $setting->save();
            }
        }
    }
}
