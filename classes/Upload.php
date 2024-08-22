<?php
// print_r(date());
class Upload
{
    public $file;
    public function __construct()
    {

        // print_r(7);

    }

    public function upload_image($name, $size, $path, $extensions = array("jpeg", "jpg", "png", 'webp'))
    {
        // var_dump($_FILES);
        // exit;
        $images = '';
        if (isset($_FILES[$name])) {
            // // foreach ($_FILES[$name] as $name => $img) {
            // for ($i = 0; $i < count($_FILES[$name]['name']); $i++) {
                foreach($_FILES[$name]['name'] as $i => $val){
                $img = $_FILES[$name];
                $errors = array();
                $file_size = $img['size'][$i];
                $file_tmp = $img['tmp_name'][$i];
                $file_ext = strtolower(end(explode('.', $img['name'][$i])));
                $current_time = round(microtime(true) * 1000) . rand(10000, 99999);
                // $extensions=;

                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > ($size * 1024 * 1024)) {
                    $errors[] = "File size must be less then $size MB";
                }

                if (getimagesize($img['tmp_name'][$i]) == false) {
                    $errors[] = "File is not an image";
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "../$path/$current_time.$file_ext");
                    $this->file = "$path/$current_time.$file_ext";
                    $images.= ($i == count($_FILES[$name]['name']) -1) ? $this->file : $this->file.',';
                } else {
                    $this->file = 'assets/images/no-img.jpg';
                }
                return($images);
            }
        }


    }
}

    ?>