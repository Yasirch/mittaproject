<x-layout>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="/restaurant" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Restaurant Name:</label>
                    <input type="text" id="name" name="name" value="{{ $restaurant->name ?? old('name') }}">
                    @error('name')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="{{ $restaurant->city ?? old('city') }}">
                    @error('city')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="postal_code">Postal Code:</label>
                    <input type="number" class="custom-input" id="postal_code" name="postal_code" value="{{ $restaurant->postal_code ?? old('postal_code') }}" >
                    @error('postal_code')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="website_link">Webseiten:</label>
                    <input type="text" id="website" name="website_link" value="{{ $restaurant->website_link ?? old('website_link') }}">
                    @error('website_link')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gmap">G-map Link:</label>
                    <input type="text" id="gmap" name="gmap" value="{{ $restaurant->gmap ?? old('gmap') }}">
                    @error('gmap')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="logo">Logo:</label>
                    <input type="file" id="logo" name="logo">
                    @error('logo')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary margin-b-20">Save Restaurant</button>

            </form>
            </div>
          </div>
        </div>

</x-layout>
