<?php

namespace App\Http\Controllers\Traits;

use App\Models\Type;
use App\Models\Outfit;
use App\Models\OutfitPhoto;
use App\Http\Requests\OutfitRequest;

/**
 * Upload many pictures
 */
Trait UploadImages
{
    public function upload(OutfitRequest $request, Outfit $outfit) {
        $type = Type::find($request->type);

        $slug_type = str_slug($type->label);
        $slug_category = str_slug($request->category);
        $slug_name = str_slug($request->name);

        $key = 0; $result = false; $filename = NULL;
        foreach ($request->photos as $photo) {
            $key++;

            if ($photo->isValid()) {
                $path = config('upload.path') .'/'. $slug_category .'/'. $slug_type;
                $extension = $photo->getClientOriginalExtension();

                $filename = $slug_name . $outfit->id . $key .'.'. $extension;

                if ($photo->move($path, $filename)) {
                    $result = true;
                }
            }

            if ($result) {
                OutfitPhoto::create([
                    'outfit_id' => $outfit->id,
                    'filename' => $filename
                ]);
            } else {
                $response = ['msg' => 'This Picture isn\'t valid!', 'status' => false];
                
                flash($response['msg'])->error()->important();
            }
        }
    }
}
