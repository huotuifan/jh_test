<?php

namespace utils;

class Image
{
    public static function getThumbnail($im, $max_width, $max_height)
    {
        function image_resize(&$image, $max_w, $max_h, $crop = false)
        {
            $orig_w = imagesx($image);
            $orig_h = imagesy($image);

            $dims = image_resize_dimensions($orig_w, $orig_h, $max_w, $max_h, $crop);
            if (!$dims) {
                return $image;
            }
            list($dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) = $dims;

            $new_image = wp_imagecreatetruecolor($dst_w, $dst_h);

            imagecopyresampled($new_image, $image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

            return $new_image;
        }

        function image_resize_dimensions($orig_w, $orig_h, $dest_w, $dest_h, $crop = false)
        {

            if ($orig_w <= 0 || $orig_h <= 0)
                return false;
            // at least one of dest_w or dest_h must be specific
            if ($dest_w <= 0 && $dest_h <= 0)
                return false;

            if ($crop) {
                // crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
                $aspect_ratio = $orig_w / $orig_h;
                $new_w = min($dest_w, $orig_w);
                $new_h = min($dest_h, $orig_h);

                if (!$new_w) {
                    $new_w = intval($new_h * $aspect_ratio);
                }

                if (!$new_h) {
                    $new_h = intval($new_w / $aspect_ratio);
                }

                $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

                $crop_w = round($new_w / $size_ratio);
                $crop_h = round($new_h / $size_ratio);

                $s_x = floor(($orig_w - $crop_w) / 2);
                $s_y = floor(($orig_h - $crop_h) / 2);
            } else {
                // don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
                $crop_w = $orig_w;
                $crop_h = $orig_h;

                $s_x = 0;
                $s_y = 0;

                list($new_w, $new_h) = wp_constrain_dimensions($orig_w, $orig_h, $dest_w, $dest_h);
            }

            // if the resulting image would be the same size or larger we don't want to resize it
            if ($new_w >= $orig_w && $new_h >= $orig_h)
                return false;

            // the return array matches the parameters to imagecopyresampled()
            // int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
            return array(0, 0, (int)$s_x, (int)$s_y, (int)$new_w, (int)$new_h, (int)$crop_w, (int)$crop_h);
        }

        function wp_constrain_dimensions($current_width, $current_height, $max_width = 0, $max_height = 0)
        {
            if (!$max_width and !$max_height)
                return array($current_width, $current_height);

            $width_ratio = $height_ratio = 1.0;

            if ($max_width > 0 && $current_width > 0 && $current_width > $max_width)
                $width_ratio = $max_width / $current_width;

            if ($max_height > 0 && $current_height > 0 && $current_height > $max_height)
                $height_ratio = $max_height / $current_height;

            // the smaller ratio is the one we need to fit it to the constraining box
            $ratio = min($width_ratio, $height_ratio);

            return array(intval($current_width * $ratio), intval($current_height * $ratio));
        }

        function wp_imagecreatetruecolor($width, $height)
        {
            $img = imagecreatetruecolor($width, $height);
            if (is_resource($img) && function_exists('imagealphablending') && function_exists('imagesavealpha')) {
                imagealphablending($img, false);
                imagesavealpha($img, true);
            }
            return $img;
        }

        return image_resize($im, $max_width, $max_height, true);
    }

    public static function saveImage($dest_filename, $image, $jpeg_quality)
    {
        imagejpeg($image, $dest_filename, $jpeg_quality);

        // Set correct file permissions
        $stat = stat(dirname($dest_filename));
        $perms = $stat['mode'] & 0000666; //same permissions as parent folder, strip off the executable bits
        @chmod($dest_filename, $perms);
    }
}
