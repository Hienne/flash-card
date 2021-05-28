<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store()
    {
        $card = new Card();
        $card->id = 0;
        $card->exists = true;
        $image = $card->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url' => 'http://127.0.0.1:8000/storage/'. strval($image->id). '/conversions/'. substr($image->file_name, 0, -4). '-thumb'. substr($image->file_name, -4)
        ]);
    }
}
