<x-layout>

    <div class="container">
        <h1 class="text-center mt-4 mb-4"> Add {{$weekday}} Menu </h1>
        <div class="row justify-content-center">

            <div class="col-md-6">
                <form method="POST" action="{{ route('menus.store', ['restaurant' => $restaurant->id, 'weekday' => $weekday]) }}" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" name="weekday" value="{{$weekday}}">
                    @error('weekday')
                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror

                    <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">

                    <div class="form-group">
                        <label class="mb-2" for="foodtitle">Gericht:</label>
                        <input type="text" id="foodtitle" name="foodtitle" value="{{ old('foodtitle') }}">
                        @error('foodtitle')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="fooddesc">Beschreibung:</label>
                        <textarea id="fooddesc" name="fooddesc">{{ old('fooddesc') }}</textarea>
                        @error('fooddesc')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label  for="price"><strong>Preis:</strong></label>
                        <input type="number" class="custom-input"  step="0.01" id="price" name="price" value="{{ old('price') }}">
                        @error('price')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Food Additives -->
                    <div class="form-group">
                        <label class="mb-2">Zusatzstoffe:</label>
                        <div class="row m-0">
                            @for ($i = 0; $i < count($foodAdditives); $i++)
                            <div class="col-lg-4 col-md-6 col-sm-12 p-lg-0">
                                <label class="label-font" for="additive_{{$i+1}}">
                                    <input type="checkbox" id="additive_{{$i+1}}" name="foodadditives[]" value="{{$foodValues[$i]}}">
                                    {{trim($foodAdditives[$i])}}
                                </label>
                            </div>
                            @endfor
                        </div>
                    </div>



                    <!-- Allergens -->
                    <div class="form-group">
                        <label class="mb-2">Allergens:</label>
                        <div class="row m-0">
                            @foreach($allergens as $key => $allergen)
                            <div class="col-lg-4 col-md-6 col-sm-12 p-lg-0">
                                <label class="label-font" for="allergen{{$key}}">
                                    <input type="checkbox" id="allergen{{$key}}" name="allergens[]" value="{{$key}}"> {{$allergen}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Add more form fields for food_title, food_description, price, food_additives, food_allergens -->

                    <button type="submit" class="btn btn-primary mb-4">Erstelle Menü</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>
