<x-layout>
    <div class="container">
        <h1 class="text-center mt-4 mb-4"> Edit {{$weekday}} Menu </h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('menus.update', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="weekday" value="{{$weekday}}">
                    @error('weekday')
                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="mb-2" for="foodtitle">Food Title:</label>
                        <input type="text" id="foodtitle" name="foodtitle" value="{{ $menu->foodtitle }}">
                        @error('foodtitle')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fooddesc">Food Description:</label>
                        <textarea id="fooddesc" name="fooddesc">{{ $menu->fooddesc }}</textarea>
                        @error('fooddesc')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price"><strong>Price:</strong></label>
                        <input type="number" class="custom-input" id="price" name="price" value="{{ $menu->price }}">
                        @error('price')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Food Additives -->
                    <div class="form-group">
                        <label class="mb-2">Food Additives:</label>
                        <div class="row m-0">
                            @foreach ($foodAdditives as $key => $additive)
                                <div class="col-lg-4 col-md-6 col-sm-12 p-lg-0">
                                    <label class="label-font" for="additive_{{$key}}">
                                        <input type="checkbox" id="additive_{{$key}}" name="foodadditives[]" value="{{$key}}" @if (in_array($key, $menu->foodadditives)) checked @endif>
                                        {{trim($additive)}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Allergens -->
                    <div class="form-group">
                        <label class="mb-2">Allergens:</label>
                        <div class="row m-0">
                            @foreach ($allergens as $key => $allergen)
                                <div class="col-lg-4 col-md-6 col-sm-12 p-lg-0">
                                    <label class="label-font" for="allergen{{$key}}">
                                        <input type="checkbox" id="allergen{{$key}}" name="allergens[]" value="{{$key}}" @if (in_array($key, $menu->allergens)) checked @endif>
                                        {{$allergen}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add more form fields for food_title, food_description, price, food_additives, food_allergens -->
                    <button type="submit" class="btn btn-primary mb-4">Update Menu</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
