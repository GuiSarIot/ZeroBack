<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class EncryptionController extends Controller
{

    public static function encrypt($valueToEncrypt)
    {
        $encrypted = Crypt::encryptString($valueToEncrypt);
        return $encrypted;
    }

    public static function decrypt($valueToDecrypt)
    {
        $decrypted = Crypt::decryptString($valueToDecrypt);
        return $decrypted;
    }
}
