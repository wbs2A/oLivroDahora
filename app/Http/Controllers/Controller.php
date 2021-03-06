<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Model\Imagens;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function insertImagem( $request){
        $this->validate($request, [
//            'file' => 'image|max:3000'
        ]);
        $file = Input::file('imagem');
        // $filename = $file->getClientOriginalName();
        $path = Storage::disk('public')->putFile('', $request->file('imagem'));
        if($path) {
            $input['filename'] = $path;
            $input['mime'] = $file->getClientMimeType();
            $input['path'] = storage_path();
            $input['size'] = $file->getClientSize();
            $file = Imagens::create($input);
            return $file->idimagens;
        }
        return [
            'success' => false
        ];
    }
    public function deleteImagem($id){
        $imagem=Imagens::where('idimagens',$id)->first();
        if(Storage::disk('public')->delete($imagem->filename)) {
            Imagens::where('idimagens',$id)->delete();
            return [
                'success' => true
            ];
        }
        return [
            'success' => false
        ];
    }
    public function updateImagem($id, $request){
        $imagem=Imagens::where('idimagens',$id)->first();
        $file = Input::file('imagem');
        $path = Storage::disk('public')->putFile('', $request->file('imagem'));
        if(Storage::disk('public')->delete($imagem->filename)) {
            $imagem->filename = $path;
            $imagem->mime = $file->getClientMimeType();
            $imagem->path = storage_path();
            $imagem->size = $file->getClientSize();
            $imagem->save();
            return [
                'success' => true
            ];
        }
        return [
            'success' => false
        ];
    }
}
