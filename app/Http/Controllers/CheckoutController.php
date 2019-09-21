<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Region;
use App\Models\RelayPoint;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout address details page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Auth::user()->addresses()->get();

        $regions = Region::all()->sortBy('label');

        $cart = Auth::user()->cart()->where('source', 'in')->get();

        return (!isset($cart)) ? view('customer.cart.index', compact('cart'))
            : view('customer.checkout.address_details', compact('addresses', 'cart', 'regions'));
    }

    /**
     * Refresh the national zone form.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh_nz()
    {
        $regions = Region::all()->sortBy('label');

        $cart = Auth::user()->cart()->where('source', 'in')->get();

        return view('customer.layouts.partials.checkout._national_details', compact('cart', 'regions'));
    }

    /**
     * Refresh the international zone form.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh_inz()
    {
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

        $cart = Auth::user()->cart()->where('source', 'in')->get();

        return view('customer.layouts.partials.checkout._international_details', compact('cart', 'countries'));
    }

    /**
     * Display the checkout delivery method page.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivery_method()
    {
        $cart = Auth::user()->cart()->where('source', 'in')->get();

        $address = Auth::user()->addresses()->where('current', 1)->first();

        $cities = City::where('region_id', $address->region_id)->orderBy('label')->get();

        $relayPoint = RelayPoint::where('region_id', $address->region_id)->where('city_id', $address->city_id)->first();

        return view('customer.checkout.delivery_method', compact('cart', 'address', 'cities', 'relayPoint'));
    }

    /**
     * Refresh the checkout order inner.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh_order_inner(RelayPoint $relayPoint)
    {
        if (isset($relayPoint)) {
            $results = [
                'shipping_cost' => convert($relayPoint->shipping_cost),
                'total' => convert(total($relayPoint->id))
            ];

            return response()->json($results);
        } else {
            return response()->json(0);
        }
    }

    /**
     * Display the checkout payment mode page.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment_mode()
    {
        $cart = Auth::user()->cart()->where('source', 'in')->get();

        $address = Auth::user()->addresses()->where('current', 1)->first();

        $relayPoint = Auth::user()->orders()->where('current', 1)->first()->relaypoint()->first();

        return view('customer.checkout.payment_mode', compact('cart', 'address', 'relayPoint'));
    }

    /**
     * Display the checkout confirmation page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmation(Order $order, Payment $payment)
    {
        return view('customer.checkout.confirmation', compact('order', 'payment'));
    }
}
