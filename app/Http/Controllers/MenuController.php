<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function  create($restaurant, $weekday){

        $foodValues = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13];
        $foodAdditives = [
            'Farbstoff',
            'Konservierungsstoff',
            'Antioxidans',
            'Geschmacksverstärker',
            'geschwefelt',
            'geschwärzt',
            'mit Phosphat',
            'mit Milchprotein (für Fleischprodukte)',
            'koffeinhaltig',
            'Enthält Chinin',
            'Mit Süßungsmittel',
            'gewachst',
        ];
        $allergens = [
            'a' => 'Getreide, das Gluten enthält',
            'b' => 'Krebstiere und daraus gewonnene Erzeugnisse',
            'c' => 'Eier und daraus gewonnene Erzeugnisse',
            'd' => 'Fisch und daraus gewonnene Erzeugnisse',
            'e' => 'Erdnüsse und daraus gewonnene Erzeugnisse',
            'f' => 'Soja (Bohnen) und daraus gewonnene Erzeugnisse',
            'g' => 'Milch und daraus gewonnene Erzeugnisse',
            'h' => 'Schalenfrüchte',
            'i' => 'Sellerie und daraus gewonnene Erzeugnisse',
            'j' => 'Senf und daraus gewonnene Erzeugnisse',
            'k' => 'Sesamsamen und daraus gewonnene Erzeugnisse',
            'l' => 'Schwefeldioxid und Sulfite',
            'm' => 'Lupinen und daraus gewonnene Erzeugnisse',
            'n' => 'Weichtiere und daraus gewonnene Erzeugnisse',
        ];

        // Retrieve the restaurant instance based on the provided ID
        $restaurant = Restaurant::findOrFail($restaurant);

        // Pass the restaurant instance to the view

        return view('menus.create',compact('weekday','restaurant','foodAdditives','foodValues', 'allergens'));
    }

    public function store(Request $request, $restaurant)
    {
        $validatedData = $request->validate([
            'weekday' => 'unique:menus,weekday,NULL,id,restaurant_id,' . $restaurant,
            'foodtitle' => 'required|string|max:255',
            'fooddesc' => 'required|string',
            'price' => 'required|numeric',
            'foodadditives' => 'nullable|array',
            'allergens' => 'nullable|array',
        ], [
            'foodtitle.required' => 'The title field is required.',
            'fooddesc.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'weekday' => 'Menu for this Weekday is already Added'


        ]);


        $menu = new Menu();
        $menu->weekday = $request->input('weekday');
        $menu->foodtitle = $request->input('foodtitle');
        $menu->fooddesc = $request->input('fooddesc');
        $menu->price = $request->input('price');
        $menu->foodadditives = $request->input('foodadditives', []);
        $menu->allergens = $request->input('allergens', []);
        $menu->restaurant()->associate($restaurant);
        $menu->save();
        $user = $menu->restaurant->user;

        // Check if the authenticated user is an admin
        if (auth()->check() && auth()->user()->isAdmin()) {

            // Redirect to the admin route
            return redirect()->route('user.restaurants.show', [
                'user' => $user,
                'restaurant' => $restaurant,
            ])->with('success', 'Menu created successfully.');
        } else {
            // Redirect to the regular user route
            return redirect()->route('restaurant.show', $restaurant)->with('success', 'Menu created successfully.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($restaurantId, $menuId)
    {
        $foodValues = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13];
        $foodAdditives = [
            'Farbstoff',
            'Konservierungsstoff',
            'Antioxidans',
            'Geschmacksverstärker',
            'geschwefelt',
            'geschwärzt',
            'mit Phosphat',
            'mit Milchprotein (für Fleischprodukte)',
            'koffeinhaltig',
            'Enthält Chinin',
            'Mit Süßungsmittel',
            'gewachst',
        ];
        $allergens = [
            'a' => 'Getreide, das Gluten enthält',
            'b' => 'Krebstiere und daraus gewonnene Erzeugnisse',
            'c' => 'Eier und daraus gewonnene Erzeugnisse',
            'd' => 'Fisch und daraus gewonnene Erzeugnisse',
            'e' => 'Erdnüsse und daraus gewonnene Erzeugnisse',
            'f' => 'Soja (Bohnen) und daraus gewonnene Erzeugnisse',
            'g' => 'Milch und daraus gewonnene Erzeugnisse',
            'h' => 'Schalenfrüchte',
            'i' => 'Sellerie und daraus gewonnene Erzeugnisse',
            'j' => 'Senf und daraus gewonnene Erzeugnisse',
            'k' => 'Sesamsamen und daraus gewonnene Erzeugnisse',
            'l' => 'Schwefeldioxid und Sulfite',
            'm' => 'Lupinen und daraus gewonnene Erzeugnisse',
            'n' => 'Weichtiere und daraus gewonnene Erzeugnisse',
        ];

        // Retrieve the restaurant and menu instances based on the provided IDs
        $restaurant = Restaurant::findOrFail($restaurantId);
        $menu = Menu::findOrFail($menuId);
        $weekday = $menu->weekday;

        // Pass the restaurant, menu, and other required data to the view
        return view('menus.edit', compact('restaurant', 'menu', 'foodAdditives', 'foodValues', 'allergens', 'weekday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $restaurant, $menu)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'foodtitle' => 'required|string|max:255',
            'fooddesc' => 'required|string',
            'price' => 'required|numeric',
            'foodadditives' => 'nullable|array',
            'allergens' => 'nullable|array',
        ], [
            'foodtitle.required' => 'The title field is required.',
            'fooddesc.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
        ]);

        // Retrieve the menu instance based on the provided IDs
        $menu = Menu::where('id', $menu)
            ->where('restaurant_id', $restaurant)
            ->firstOrFail();

        // Update the menu with the validated data
        $menu->foodtitle = $validatedData['foodtitle'];
        $menu->fooddesc = $validatedData['fooddesc'];
        $menu->price = $validatedData['price'];
        $menu->foodadditives = $validatedData['foodadditives'] ?? [];
        $menu->allergens = $validatedData['allergens'] ?? [];
        $menu->save();

        $user = $menu->restaurant->user;

        // Check if the authenticated user is an admin
        if (auth()->check() && auth()->user()->isAdmin()) {

            // Redirect to the admin route
            return redirect()->route('user.restaurants.show', [
                'user' => $user,
                'restaurant' => $restaurant,
            ])->with('success', 'Menu updated successfully.');
        } else {
            // Redirect to the regular user route
            return redirect()->route('restaurant.show', $restaurant)->with('success', 'Menu updated successfully.');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurant, $weekday)
    {
        // Find the menu based on the restaurant and weekday
        $menu = Menu::where('restaurant_id', $restaurant)->where('weekday', $weekday)->firstOrFail();

        // Delete the menu
        $menu->delete();

        $user = $menu->restaurant->user;

        // Check if the authenticated user is an admin
        if (auth()->check() && auth()->user()->isAdmin()) {

            // Redirect to the admin route
            return redirect()->route('user.restaurants.show', [
                'user' => $user,
                'restaurant' => $restaurant,
            ])->with('success', 'Menu deleted successfully.');
        } else {
            // Redirect to the regular user route
            return redirect()->route('restaurant.show', $restaurant)->with('success', 'Menu deleted successfully.');
        }
    }
}
