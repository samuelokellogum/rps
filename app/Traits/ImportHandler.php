<?php

use Maatwebsite\Excel\Facades\Excel;

trait ImportHandler{

    public static $import_file;
    static function importFile($request){

        $file_storage = Util::storeFile("imports/students/", $request->file);

          self::$import_file = \App\ImportFile::create([
            "file_path" => $file_storage->file_path,
            "clazz_id" => explode("-", $request->clazz_id)[0],
            "clazz_stream" => $request->clazz_stream
        ]);


        Excel::load("storage/{$file_storage->file_path}", function($reader) {

            // Format dates + set date format
            $reader->formatDates(true, 'Y-m-d');

            // Getting all results
            $results = $reader->get();

            self::processData($results->toArray(), self::$import_file);


        });
    }

    static function processData($data, $import_file){
        $student_data = [];
        foreach ($data as $row) {
            $errors = [];
            foreach ($row as $key => $val) {

                //name
                if ($key == "name") {
                    if (strlen(trim($val)) <= 0) {
                        $errors[] = "Name has an error";
                    }
                }

                //dod
                if ($key == "dob") {
                    try {
                        \Carbon\Carbon::parse($val);
                    } catch (Exception $e) {
                        $errors[] = "Date of Birth has an error";
                    }
                }

                if ($key == "gender") {
                    if (strlen($val) <= 0) {
                        $errors[] = "Gender has an error";
                    }else{
                        if(strtolower(substr($val, 0,1)) == "m"){
                            $row[$key] = "male";
                        }else{
                            $row[$key] = "female";
                        }
                    }
                }

                if($key == "guardian_contact" || $key == "year_of_admission"){
                    $row[$key] = (string)$val;
                }

                if($key == "year_of_admission"){
                    $row["year_of_admin"] = $val;
                }


            }
            if(count($errors) > 0){
                $row["errors"] = json_encode($errors);
                $row["status"] = "rejected";
            }else{
                $row["status"] = "accepted";
            }

            $row["import_file_id"] = $import_file->id;

            \App\ImportStudentTemp::create($row);
            $student_data[] = $row;
        }

        return $student_data;

    }

}