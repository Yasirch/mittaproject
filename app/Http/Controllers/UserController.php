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

    public function showUserProfile(User $user)
    {
        // Implement logic to show the user profile page
        return view('user.edit', ['user' => $user]);
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('login')->with('success', 'User successfully added .');

    }

    public function updateUserProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        // Only update password if provided in the form
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('login')->with('success', 'Profile updated successfully.');
    }

    public function editUserProfile(User $user)
    {
        // Implement logic to show the user editing page
        return view('user.edit', ['user' => $user]);
    }


    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Optionally, you can redirect or return a response
        return redirect()->route('login')->with('success', 'User has been deleted.');
    }

    public function showUserRestaurants(User $user)
    {
        // Implement logic to retrieve the user's restaurants
        $restaurants = $user->restaurants()->latest()->paginate(10); // Retrieve all associated restaurants
        return view('user.restaurants', ['user' => $user, 'restaurants' => $restaurants]);
    }

    public function editUserRestaurant(User $user, Restaurant $restaurant)
    {
        return view('user.edit-restaurants', compact('user', 'restaurant'));
    }

    public function createUserRestaurant(User $user)
    {
        return view('user.create-restaurant', ['user' => $user]);
    }

    public function storeUserRestaurant(Request $request, User $user)
    {
        // Validate the form data
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
            'website_link' => 'nullable|url',
            'gmap' => 'nullable|url',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Create a new restaurant instance
        $restaurant = new Restaurant();

        // Set the restaurant attributes
        $restaurant->name = $request->input('name');
        $restaurant->city = $request->input('city');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->website_link = $request->input('website_link');
        $restaurant->gmap = $request->input('gmap');

        // Save the authenticated user's ID as the user_id for the restaurant
        $restaurant->user_id = $user->id;

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');

            $restaurant->logo = $logoPath;
        }

        // Save the restaurant to the database
        $user->restaurants()->save($restaurant);

        $restaurantId = $restaurant->id;
        return redirect()->route('user.restaurants', ['user' => $user->id])->with('success', 'Thank you! Your restaurant is successfully created.');
    }

    public function updateUserRestaurant(Request $request, User $user, Restaurant $restaurant)
    { // Validate the form data
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
            'website_link' => 'nullable|url',
            'gmap' => 'nullable|url',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
        ]);



        // Set the restaurant attributes
        $restaurant->name = $request->input('name');
        $restaurant->city = $request->input('city');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->website_link = $request->input('website_link');
        $restaurant->gmap = $request->input('gmap');

        // Save the authenticated user's ID as the user_id for the restaurant
        $restaurant->user_id = $user->id;

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');

            $restaurant->logo = $logoPath;
        }

        // Save the updated restaurant to the database
        $restaurant->save();

        return redirect()->route('user.restaurants', ['user' => $user->id])->with('success', 'Thank you! Your restaurant is successfully created.');
    }

    public function destroyUserRestaurant(User $user, Restaurant $restaurant)
    {
        // Add any necessary validation or authorization checks

        $restaurant->delete();

        return redirect()->route('user.restaurants', $user)->with('success', 'Restaurant deleted successfully.');
    }

    public function showUserRestaurantProfile(User $user, Restaurant $restaurant)
    {
        $menus = $restaurant->menus;
        return view('user.show-restaurant-admin', ['restaurant' => $restaurant, 'menus' => $menus, 'user' => $user]);
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
            $weekdays = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'];

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
        $weekdays = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'];


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
        $count = User::where('is_admin', false)->count();
        $nonAdminUsers = User::where('is_admin', false)->latest()->paginate(10);
        return view('logInHome', ['restaurants'=> $restaurants, 'count'=> $count, 'username'=> $username,'nonAdminUsers'=>$nonAdminUsers]);

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
