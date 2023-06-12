<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function ShowRestaurantForm()
    {
        return view('restaurantForm');
    }

    public function SaveRestaurantEdit(Restaurant $restaurant, Request $request)
    {
        $this->authorize('update', $restaurant);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
            'website_link' => 'nullable|url',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Update the restaurant attributes
        $restaurant->name = $validatedData['name'];
        $restaurant->city = $validatedData['city'];
        $restaurant->postal_code = $validatedData['postal_code'];
        $restaurant->website_link = $validatedData['website_link'];

        // Handle logo update if provided
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('public/logos');
            $restaurant->logo = Storage::url($logoPath);
        }

        // Save the changes to the restaurant
        $restaurant->save();

        if ($request->has('submit')) {
            return redirect("/restaurant/{$restaurant->id}")->with('success', 'Restaurant Successfully Updated');
        }
        return redirect("/restaurant/{$restaurant->id}");

    }

    public function EditRestaurantForm(Restaurant $restaurant)
    {
        return view('editRestaurantForm',['restaurant'=> $restaurant]);
    }


    public function delete(Restaurant $restaurant){
//      if(auth()->user()->cannot('delete', $restaurant)){
//            return 'you cannot do that ';
//      }
        $this->authorize('delete', $restaurant);

        // Delete the restaurant
        $restaurant->delete();
        return redirect('/login/')->with('success', 'Restaurant successfully deleted');


    }

    public function SingleRestaurantProfile( $restaurant)
    {
        $restaurant = Restaurant::findOrFail($restaurant);
        $menus = $restaurant->menus;
        return view('singleRestaurantProfile',['restaurant'=> $restaurant, 'menus'=>$menus ]);
    }

    public function allRestaurantList()
    {
        $user = auth()->user(); // Replace $userId with the ID of the user you want to retrieve
        $username = $user->name;
        $restaurants = $user->restaurants()->latest()->get(); // Retrieve all associated restaurants
        $count = $user->restaurants()->count();
        return view('allRestaurantList', ['restaurants'=> $restaurants, 'count'=> $count, 'username'=> $username]);

    }

    public function createNewRestaurant(Request $request)
    {
        // Validate the form data
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
            'website_link' => 'nullable|url',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Create a new restaurant instance
        $restaurant = new Restaurant();

        // Set the restaurant attributes
        $restaurant->name = $request->input('name');
        $restaurant->city = $request->input('city');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->website_link = $request->input('website_link');

        // Save the authenticated user's ID as the user_id for the restaurant
        $restaurant->user_id = Auth::id();

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('public/logos');
            $restaurant->logo = Storage::url($logoPath);
        }

        // Save the restaurant to the database
        $restaurant->save();

        $restaurantId = $restaurant->id;
        return redirect("/restaurant/{$restaurantId}")->with('success', 'Thank you! Your restaurant is successfully created.');
    }



}
