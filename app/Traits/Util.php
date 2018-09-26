<?php

use Illuminate\Support\Facades\Storage;

trait Util{

    static function storeFile($path,$file){
        $filename = $path.Util::generateRandomString(25).'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($filename, File::get($file));
        return  (object)["filename" => $file->getClientOriginalName(), "file_path" => $filename];
    }


    static function deleteFile($filepath){
        Storage::disk('public')->delete($filepath);
    }

    static function generateRandomString($len){
        $alphabet = '1234567890adcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $len; $i++) {
            $p = mt_rand(0, $alphaLength);
            $id[] = $alphabet[$p];
        }
        return implode($id);
    }

    static function genRegNumber($adminYear){
       $last_student =  \App\Student::orderBy("id", "desc")->first();
       $last_reg_number = ($last_student == null) ? 0 : $last_student->reg_number;
       $the_reg_number = explode("/", $last_reg_number);
       $reg_number = ($last_student == null) ? 1 : (int)$the_reg_number[count($the_reg_number) - 1] + 1;
       $adminYear = substr($adminYear, -2);
       $reg_number = str_pad($reg_number, 4, 0, STR_PAD_LEFT);
       return "{$adminYear}/S/{$reg_number}";

    }

    static function in_range($number, $min, $max)
    {
        return $number >= $min && $number <= $max;
    }
}