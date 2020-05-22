<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Outfit;
use App\Http\Requests\OutfitRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\Searchable;
use App\Http\Controllers\Traits\UploadImages;

class OutfitController extends Controller
{
    use Searchable;
    use UploadImages;

    /**
     * Display a listing of outfits.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outfits = Outfit::orderBy('name')
            ->paginate(8);

        $categories = [
            'men',
            'women'
        ];

        $types = Type::all()->sortBy('label');

        $colors = [
            'black',
            'blue',
            'red',
            'gold',
            'grey',
            'white',
            'yellow'
        ];

        $men_outfits = Outfit::where('category', 'men')->orderBy('created_at', 'desc')->get();
        $women_outfits = Outfit::where('category', 'women')->orderBy('created_at', 'desc')->get();

        if(Auth::check()) {
            if(isset(Auth::user()->username)) {
                return view('admin.outfit.index', compact(
                    'men_outfits', 'women_outfits')
                );
            } else {
                return view('customer.outfit.shop', compact('outfits', 'categories', 'types', 'colors'));
            }
        }
        else {
            return view('customer.outfit.shop', compact('outfits', 'categories', 'types', 'colors'));
        }

    }

    /**
     * Show the form for creating a new outfit.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all()->sortBy('label');

        return view('admin.outfit.create', compact('types'));
    }

    /**
     * Store a newly created outfit in storage.
     *
     * @param  \App\Http\Requests\OutfitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutfitRequest $request)
    {
        $outfit = Outfit::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'type_id' => $request->type,
            'availibility' => $request->availibility,
            'context' => nl2br($request->context),
            'description' => nl2br($request->description),
            'specification' => $request->specification
        ]);
        
        UploadImages::upload($request, $outfit);

        if ($outfit) {
            $response = ['msg' => 'Outfit successfully registered!', 'status' => true];

            flash($response['msg'])->success()->important();
        } else {
            $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

            flash($response['msg'])->error()->important();
        }

        return redirect(route('admin.outfit.create'));
    }

    /**
     * Display the specified outfit.
     *
     * @param  Outfit $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        if(Auth::check()) {
            if(isset(Auth::user()->username)) {
                return view('admin.outfit.show', compact('outfit'));
            } else {
                return view('customer.outfit.show', compact('outfit'));
            }
        }
        else {
            return view('customer.outfit.show', compact('outfit'));
        }
    }

    /**
     * Show the form for editing the specified outfit.
     *
     * @param  Outfit $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        //
    }

    /**
     * Update the specified outfit in storage.
     *
     * @param  \App\Http\Requests\OutfitRequest  $request
     * @param  Outfit $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(OutfitRequest $request, Outfit $outfit)
    {
        //
    }

    /**
     * Remove the specified outfit from storage.
     *
     * @param  Outfit $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {
        //
    }
}
