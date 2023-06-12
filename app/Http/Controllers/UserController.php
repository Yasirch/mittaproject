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

        $searchCity = $request->input('inputcity');
        $city = explode(' ', $searchCity)[0];

        // Query the restaurants table to retrieve the restaurants in the specified city
        $restaurants = Restaurant::where('city', 'like', "%$city%")->get();
        foreach ($restaurants as $restaurant) {
            $menuData = [];
            $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday','Sunday'];

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
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


        return view('result', ['restaurants' => $restaurants,'city'=>$city,'citiesWithPostalCodes'=>$citiesWithPostalCodes, 'weekdays'=>$weekdays]);
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
}
