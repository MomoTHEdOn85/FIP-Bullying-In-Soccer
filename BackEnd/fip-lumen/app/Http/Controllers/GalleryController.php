<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gallery;


class GalleryController extends Controller
{
  public function showAllGallery() {
    return response()->json(Gallery::all());
  }

  public function showOneGallery($id) {
    return response()->json(Gallery::find($id));
  }

  

}
