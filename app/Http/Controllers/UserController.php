<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\User;

class UserController extends Controller
{

    public function AuthRouteAPI(Request $request){
        return $request->user();
    }

    public function homepage()
    {
        $restaurants = Restaurant::all();
        $citiesWithPostalCodes = [];

        foreach ($restaurants as $restaurant) {
            $city = $restaurant->city;
            $postalCode = $restaurant->postal_code;
            $cityWithPostalCode = $city . ' ' . $postalCode;
            if (!in_array($cityWithPostalCode, $citiesWithPostalCodes)) {
                $citiesWithPostalCodes[] = $cityWithPostalCode;
            }
        }

        return view('homepage', ['citiesWithPostalCodes'=>$citiesWithPostalCodes]);
    }

    public function result(Request $request)
    {
        $allRestaurants = Restaurant::query();
        $searchInput = $request->input('inputcity');


        if (preg_match('/^([A-Za-z]+)\s+(\d+)$/', $searchInput, $matches)) {
            // Input is a mixture of alphabet and numbers (city + space + postal code)
            $city = $matches[1];
            $postalCode = $matches[2];
            // Search by partial city and postal code
            if ($city !== '' && $postalCode !== '') {
                $allRestaurants->where('city', 'like', "%$city%")
                    ->where('postal_code', 'like', "%$postalCode%");
            }
        } elseif (preg_match('/^[A-Za-z]+$/', $searchInput)) {
            // Input is alphabet only (partial match for city)
            $allRestaurants->where('city', 'like', "%$searchInput%");
        } elseif (preg_match('/^\d+$/', $searchInput)) {
            // Input is numerical only (partial match for postal code)
            $allRestaurants->where('postal_code', 'like', "%$searchInput%");
        } else{
            $allRestaurants = null;
        }
        $restaurants = $allRestaurants ? $allRestaurants->get() : collect();

        $firstRestaurant = $restaurants->first();

        if ($firstRestaurant) {
            $searchedcity = $firstRestaurant->city;
            // Use the $city variable as needed
        } else {
            $searchedcity= 'not Found';
        }


        foreach ($restaurants as $restaurant) {
            $menuData = [];
            $weekdays = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag','Samstag',''];

            foreach ($weekdays as $weekday) {
                $menu = $restaurant->menus()->where('weekday', $weekday)->first();

                if ($menu) {
                    $foodAdditives = is_array($menu->foodadditives) ? implode(',', $menu->foodadditives) : $menu->foodadditives;
                    $allergens = is_array($menu->allergens) ? implode(',', $menu->allergens) : $menu->allergens;

                    $menuData[$weekday] = [
                        'food_description' => $menu->fooddesc,
                        'food_title' => $menu->foodtitle,
                        'food_additives' => $foodAdditives,
                        'allergens' => $allergens,
                        'price' => $menu->price
                    ];
                } else {
                    $menuData[$weekday] = [
                        'food_description' => '',
                        'food_title' => '',
                        'food_additives' => '',
                        'allergens' => '',
                        'price' => ''
                    ];
                }
            }


            $restaurant->menu = $menuData;
        }

        $restaurants1 = Restaurant::all();
        $citiesWithPostalCodes = [];

        foreach ($restaurants1 as $restaurant) {
            $city = $restaurant->city;
            $postalCode = $restaurant->postal_code;
            $cityWithPostalCode = $city . ' ' . $postalCode;
            if (!in_array($cityWithPostalCode, $citiesWithPostalCodes)) {
                $citiesWithPostalCodes[] = $cityWithPostalCode;
            }
        }
        $weekdays = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', ''];


        return view('result', ['restaurants' => $restaurants,'searchedcity'=>$searchedcity,'citiesWithPostalCodes'=>$citiesWithPostalCodes, 'weekdays'=>$weekdays]);
    }




    public function logout(){

        auth()->logout();
        return redirect('/login')->with('success', 'You are now logged out!');
    }
    public function loginuser(Request $request){
        $incomingFields = $request->validate([
            'loginemail'=>'required',
            'loginpassword'=>'required',
        ]);
        if (auth()->attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/login')->with('success', 'You are now logged in!');
        } else {
            return redirect('/login')->with('failure', 'You Login details are not correct!');
        }
    }

    public function showCorrectHomepage()
    {   if(auth()->check()){

        $user = auth()->user();
        $username = $user->name;
        $restaurants = $user->restaurants()->latest()->paginate(10); // Retrieve all associated restaurants
        $count = $user->restaurants()->count();
        return view('logInHome', ['restaurants'=> $restaurants, 'count'=> $count, 'username'=> $username]);

    }
    else{
        return view('loginform');
    }

    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name'=>['required', 'min:3', 'max:20'],
            'email'=>['required', 'email', Rule::unique('users','email')],
            'password'=>['required','min:6','confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/login')->with('success', 'Thank you for creating an account.');
    }

    public function addToHome()
    {
        return view('add-to-home');
    }

}
