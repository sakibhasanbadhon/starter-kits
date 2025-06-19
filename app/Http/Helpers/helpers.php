<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Buglinjo\LaravelWebp\Facades\Webp;

/**************************************
 *  Static Variables Start
 ***********/
define('SOMETHING_WRONG', 'Something Went Wrong, Please Try Again!');

 /**************************************
 *  Static Variables End
 ***********/


function isMenuActive($url){
   return request()->is($url) ? 'active' : '';
}

function isMenuExpand($url){
    return request()->is($url) ? 'menu-is-opening menu-open' : ''; 
}

/**************************************
 *  Image Uploader Start
 ***********/
function filesPath($slug)
{
    $data = [
        'admin-profile'         => [
            'path'              => 'media/backend/images/admin/profile',
        ],
    ];
    return (object) $data[$slug];
}

function getFilesPath($slug)
{
    $data = filesPath($slug);
    $path = $data->path;
    createAssetDir($path);
    return public_path($path);
}

function createAssetDir($path)
{
    $path = "public/" . $path;
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function filesAssetPath($slug)
{
    $files_path = filesPath($slug)->path;
    return asset('public/' . $files_path);
}

function uploadLocalImage($file,$destination_path,$old_file = null) {
    if(File::isFile($file)) {
        $save_path = getFilesPath($destination_path);
        $file_extension = $file->getClientOriginalExtension();
        $file_type = File::mimeType($file);
        $file_size = File::size($file);
        $file_original_name = $file->getClientOriginalName();

        $file_base_name = explode(".",$file_original_name);
        array_pop($file_base_name);
        $file_base_name = implode("-",$file_base_name);

        $file_name = Str::uuid() . "." . $file_extension;

        $file_public_link   = $save_path . "/" . $file_name;
        $file_asset_link    = filesAssetPath($destination_path) . "/" . $file_name;

        $file_info = [
            'name'                  => $file_name,
            'type'                  => $file_type,
            'extension'             => $file_extension,
            'size'                  => $file_size,
            'file_link'             => $file_asset_link,
            'dev_path'              => $file_public_link,
            'original_name'         => $file_original_name,
            'original_base_name'    => $file_base_name,
        ];

        try{
            if($old_file) {
                $old_file_link = $save_path . "/" . $old_file;
                deleteFile($old_file_link);
            }

            File::move($file,$file_public_link);
        }catch(Exception $e) {
            return false;
        }

        return $file_info;
    }

    return false;
}



function uploadImage($files_path, $destination_path, $old_files = null)
{
    $output_files_name = [];
    
    foreach ($files_path as $path) {
        $file_name      = File::name($path);
        $file_extension = File::extension($path);
        $file_base_name = $file_name . "." . $file_extension;
        $file_mime_type = File::mimeType($path);
        $file_size      = File::size($path);
        
        $save_path = getFilesPath($destination_path);
        
        $file_mime_type_array = explode('/', $file_mime_type);
        if (array_shift($file_mime_type_array) == "image" && $file_extension != "svg") {
            $file = Image::make($path)->orientate();
            
            $width = $file->width();
            $height = $file->height();
            
            $resulation_break_point = [2048, 2340, 2730, 3276, 4096, 5460, 8192];
            $reduce_percentage = [12.5, 25, 37.5, 50, 62.5, 75];
            
            // Dynamically Image Resizing & Move to Targeted folder
            if ($width > 0 && $width < 2048) {
                $new_width = $width;
                try {
                    $file->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } catch (\Exception $e) {
                    return back()->with(['error' => ['Image Upload Faild!']]);
                }
            }
            if ($width > 5460 && $width <= 6140) {
                $new_width = 2048;
                try {
                    $file->resize($new_width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } catch (\Exception $e) {
                    return back()->with(['error' => ['Image Upload Faild!']]);
                }
            }else {
                for ($i = 0; $i < count($resulation_break_point); $i++) {
                    if ($i != count($resulation_break_point) - 1) {
                        if ($width >= $resulation_break_point[$i] && $width <= $resulation_break_point[$i + 1]) {
                            $new_width = ceil($width - (($width * $reduce_percentage[$i]) / 100));
                            try {
                                $file->resize($new_width, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            } catch (\Exception $e) {
                                return back()->with(['error' => ['Image Upload Faild!']]);
                            }
                        }
                    }
                }
                if ($width > 8192) {
                    $new_width = 2048;
                    try {
                        $file->resize($new_width, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } catch (\Exception $e) {
                        return back()->with(['error' => ['Image Upload Faild!']]);
                    }
                }
            }
            // Save File
            try {
                $file->save($path, 70);
            } catch (Exception $e) {
                return back()->with(['error' => ['Something went worng! Faild to save file.']]);
            }

            $file_instance = new UploadedFile(
                $path,
                $file_base_name,
                $file_mime_type,
                $file_size,
            );
            $store_file_name = $file_name . ".webp";
            try {
                if ($file_extension != "webp") {
                    $webp = Webp::make($file_instance)->save($save_path . "/" . $store_file_name);
                    array_push($output_files_name, $store_file_name);
                } else {
                    File::move($file_instance, $save_path . "/" . $file_base_name);
                    array_push($output_files_name, $file_base_name);
                }
            } catch (Exception $e) {
                return back()->with(['error' => ['Something went worng! Faild to upload file.']]);
            }
        } else { // IF Other Files
            $file_instance = new UploadedFile(
                $path,
                $file_base_name,
                $file_mime_type,
                $file_size,
            );

            try {
                File::move($file_instance, $save_path . "/" . $file_base_name);
                array_push($output_files_name, $file_base_name);
            } catch (Exception $e) {
                return back()->with(['error' => ['Something went worng! Faild to upload file.']]);
            }
        }

        // Delete Old Files if exists
        try {
            if ($old_files) {
                if (is_array($old_files)) {
                    // Delete Multiple File
                    foreach ($old_files as $item) {
                        $file_link = $save_path . "/" . $item;
                        deleteFile($item);
                    }
                } else if (is_string($old_files)) {
                    // Delete Single File
                    $file_link = $save_path . "/" . $old_files;
                    deleteFile($file_link);
                }
            }
        } catch (Exception $e) {
            return back()->with(['error' => ['Something went worng! Faild to delete old file.']]);
        }
    }
    if (count($output_files_name) == 1) {
        return $output_files_name[0];
    }
    return $output_files_name;
}


function deleteFile($file_link)
{
    if (File::exists($file_link)) {
        try {
            File::delete($file_link);
        } catch (Exception $e) {
            return false;
        }
    }
    return true;
}


function getImagePath($image_name, $path_type = null)
{
    $image_path = filesPath($path_type)->path;
    $image_link = $image_path . "/" . $image_name;
    if (file_exists(public_path($image_link))) {
        $image = asset('public/' . $image_link);
    }else{
        return false;
    }

    return $image;
}

/**************************************
 *  Image Uploader Start
 ***********/

function filterStringToLower($string) {
    $username = preg_replace('/ /i','',$string);
    $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
    $username = strtolower($username);
    return $username;
}

function generateRandomString($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateUsername($first_name,$last_name,$table = "users") {
    // Make username Dynamically
    $generate_name_with_count = "";
    do{
        // Generate username
        $firstName = $first_name;
        $lastName = $last_name;

        if($generate_name_with_count == "") {
            if(strlen($firstName) >= 6) {
                $generate_name = filterStringToLower($firstName);
            }else {
                $modfy_last_name = explode(' ',$lastName);
                $lastName = filterStringToLower($modfy_last_name[0]);
                $firstName = filterStringToLower($firstName);
                $generate_name = $firstName . $lastName;
                if(strlen($generate_name) < 6) {
                    $firstName = filterStringToLower($firstName);
                    $lastName = filterStringToLower($lastName);
                    $generate_name = $firstName . $lastName;

                    if(strlen($generate_name) < 6) {
                        $getCurrentLen = strlen($generate_name);
                        $dueChar = 6 - $getCurrentLen;
                        $generate_due_char = strtolower(generateRandomString($dueChar));
                        $generate_name = $generate_name . $generate_due_char;
                    }
                }
            }
        }else {
            $generate_name = $generate_name_with_count;
        }

        // Find User is already exists or not
        $chekUser = DB::table($table)->where('user_name',$generate_name)->first();

        if($chekUser == null) {
            $loop = false;
        }else {
            $generate_name_with_count = $generate_name;

            $split_string = array_reverse(str_split($generate_name_with_count));
            $username_string_part = "";
            $last_numeric_values = "";
            $numeric_close = false;

            foreach($split_string as $character) {
                if($numeric_close == false) {
                    if(is_numeric($character)) {
                        $last_numeric_values .= $character;
                    }else {
                        $numeric_close = true;
                    }
                }
                if($numeric_close == true) {
                    $username_string_part .= $character;
                }
            }

            if($last_numeric_values == "") { // If has no number in username string;
                $last_numeric_values = 1;
            }

            $username_string_part = strrev($username_string_part); // usernaem back to reverse;
            $last_numeric_values = strrev($last_numeric_values); // last number back to reverse;
            $generate_name_with_count = $username_string_part . ($last_numeric_values + 1);
            $loop = true;
        }
    }while($loop);

    return $generate_name;
}