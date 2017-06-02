<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediaController extends Controller
{
    // display all media file
    public function index(){
        $medias=Photo::all();
        return view('admin.media.index', compact('medias'));
    }

    // create media file
    public function create(){
        return view('admin.media.create');
    }

    //store media files
    public function store(Request $request){
        $file = $request->file('file');
        $name=time().$file->getClientOriginalName();
        $file->move('images', $name);
        Photo::create(['file'=>$name]);
    }

    // delele media
    public function destroy($id){
        Photo::findOrFail($id)->delete();
        return redirect('/admin/media');
    }
}
