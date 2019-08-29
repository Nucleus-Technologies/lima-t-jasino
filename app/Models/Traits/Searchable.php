<?php

namespace App\Models\Traits;

use App\Models\Type;
use App\Models\Outfit;
use Illuminate\Http\Request;

/**
 * Returns outfits after searching options
 */
trait Searchable
{
    /**
     * Search engine for outfits.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
            'min_price' => 'integer',
            'max_price' => 'integer'
        ]);

        $type = (Type::where('label', ucfirst($request->keyword))->first()) ? Type::where('label', $request->keyword)->first()->id : '';

        if($request->sorting) {
            switch ($request->sorting) {
                case 1:
                    $sorting = 'created_at';
                    $order = 'desc';
                    break;

                case 2:
                    $sorting = 'price';
                    $order = 'asc';
                    break;

                case 3:
                    $sorting = 'price';
                    $order = 'desc';
                    break;

                default:
                    # code...
                    break;
            }
        } else {
            $sorting = 'created_at';
            $order = 'desc';
        }

        if($request->prefix) {
            switch ($request->prefix) {
                case 'category':
                    $outfits = Outfit::where('category', 'like', $request->keyword)->orderBy($sorting, $order)->paginate(9);
                    $outfits->withPath('search?_token=' .$request->_token. '&prefix=' .$request->prefix. '&keyword=' .$request->keyword);
                    break;

                case 'type':
                    $outfits = Outfit::where('type', $type)->orderBy($sorting, $order)->paginate(9);
                    $outfits->withPath('search?_token=' .$request->_token. '&prefix=' .$request->prefix. '&keyword=' .$request->keyword);
                    break;

                case 'color':
                    $outfits = Outfit::where('name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('specification', 'like', '%' . $request->keyword . '%')
                        ->orderBy($sorting, $order)
                        ->paginate(9);

                    $outfits->withPath('search?_token=' .$request->_token. '&prefix=' .$request->prefix. '&keyword=' .$request->keyword);
                    break;

                case 'price':
                    $outfits = Outfit::whereBetween('price', [$request->min_price, $request->max_price])
                        ->orderBy($sorting, $order)
                        ->paginate(9);

                    $outfits->withPath('search?_token=' .$request->_token. '&prefix=' .$request->prefix. '&keyword=' .$request->keyword. '&range=' .$request->min_price. '-' .$request->max_price);

                    $min_price = $request->min_price;
                    $max_price = $request->max_price;

                    break;

                default:
                # code...
                break;
            }

            $prefix = $request->prefix;
        }
        else {
            $outfits = Outfit::where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('price', 'like', '%' . $request->keyword . '%')
                ->orWhere('category', 'like', '%' . $request->keyword . '%')
                ->orWhere('type', $type)
                ->orWhere('availibility', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%')
                ->orderBy($sorting, $order)
                ->paginate(9);

            $outfits->withPath('search?_token=' .$request->_token. '&keyword=' .$request->keyword);
        }

        $categories = [
            'men',
            'women',
            'children'
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

        $keyword = $request->keyword;

        return view('customer.outfit.shop', compact('outfits', 'categories', 'types', 'colors', 'keyword', 'prefix', 'min_price', 'max_price'));
    }
}
