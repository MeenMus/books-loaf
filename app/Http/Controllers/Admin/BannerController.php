<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;


class BannerController extends BaseController
{

    public function create(Request $request)
    {

        return view('admin.banners-create');
    }

    public function store(Request $request)
    {
        $banners = $request->file('banners');

        foreach ([1, 2, 3] as $i) {
            if (isset($banners[$i])) {
                $image = $banners[$i];
                $imageName = 'banner-' . $i . '.png';

                // Resize and save
                $resizedImage = Image::make($image)
                    ->fit(851, 315, function ($constraint) {
                        $constraint->upsize();
                    });

                $path = public_path('banners');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true);
                }

                $resizedImage->save($path . '/' . $imageName, 90, 'png');
            }
        }
        Alert::success('Success!', 'Banner updated!');

        return redirect()->back();
    }
}
