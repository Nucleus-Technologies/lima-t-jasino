<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use App\Http\Requests\OutfitFormRequest;
use App\Models\OutfitPhoto;
use App\Models\Type;
use Illuminate\Http\Request;

class OutfitController extends Controller
{
    /**
     * Display a listing of outfits.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $men_outfits = Outfit::where('category', 'men')->get();
        $women_outfits = Outfit::where('category', 'women')->get();
        $children_outfits = Outfit::where('category', 'children')->get();

        return view('admin.outfit.index', compact(
            'men_outfits', 'women_outfits', 'children_outfits')
        );
    }

    /**
     * Show the form for creating a new outfit.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all()->sortBy('wording');

        return view('admin.outfit.create', compact('types'));
    }

    /**
     * Store a newly created outfit in storage.
     *
     * @param  \App\Http\Requests\OutfitFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutfitFormRequest $request)
    {
        $outfit = Outfit::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'type' => $request->type,
            'availibility' => $request->availibility,
            'context' => nl2br($request->context),
            'description' => nl2br($request->description),
            'specification' => $request->specification
        ]);

        $type = Type::where('id', $request->type)->first();

        $slug_type = str_slug($type->wording);
        $slug_category = str_slug($request->category);
        $slug_name = str_slug($request->name);

        $key = 0;
        foreach ($request->photos as $photo) {
            $key++;
            $filename = $photo->storeAs(
                $slug_category .'/'. $slug_type,
                $slug_name . $outfit->id . $key .'.'
                . $photo->getClientOriginalExtension());

            OutfitPhoto::create([
                'outfit' => $outfit->id,
                'filename' => $filename
            ]);
        }

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
        return view('admin.outfit.show', compact('outfit'));
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
     * @param  \App\Http\Requests\OutfitFormRequest  $request
     * @param  Outfit $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(OutfitFormRequest $request, Outfit $outfit)
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

    /**
     * Search engine for outfits.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate(['keyword' => 'required']);

        $outfits = Outfit::where('name', 'like', '%' . $request->keyword . '%')
            ->orWhere('price', 'like', '%' . $request->keyword . '%')
            ->orWhere('category', 'like', '%' . $request->keyword . '%')
            ->orWhere('type', 'like', '%' . $request->keyword . '%')
            ->orWhere('availibility', 'like', '%' . $request->keyword . '%')
            ->orWhere('description', 'like', '%' . $request->keyword . '%')
            ->get();

        return view('customer.outfit.shop', compact('outfits'));
    }
}
