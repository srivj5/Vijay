<?php
/**
 * This is a "dummy" library that just loads the actual library in the construct.
 * This technique prevents issues from CodeIgniter 3 when loading libraries that use PHP namespaces.
 * This file can be used with any PHP library that uses namespaces.  Just copy it, change the name of the class to match your library
 * and configs and go to town.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

// Setup the dummy class for Cloudinary
class Cloudinarylib {

    public function __construct()
    {

        //info@moonex.com
        //MOONex@123

        // include the cloudinary library within the dummy class
        require('cloudinary/src/Cloudinary.php');
        require 'cloudinary/src/Uploader.php';
        require 'cloudinary/src/Api.php';

        // configure Cloudinary API connection
          \Cloudinary::config(array(
            "cloud_name" => "dhpmwq4ln",
            "api_key" => "428823126363133",
            "api_secret" => "D3BOqEsM2G8Yl_eiMTHf1iyHS74"
            ));

    }
}