<!-- resources/views/restaurants/edit.blade.php -->

<x-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('user.restaurants.update', ['user' => $user->id, 'restaurant' => $restaurant->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Restaurant Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $restaurant->name) }}">
                        @error('name')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city">Stadt:</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $restaurant->city) }}">
                        @error('city')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postleitzahl:</label>
                        <input type="number" class="custom-input" id="postal_code" name="postal_code" value="{{ old('postal_code', $restaurant->postal_code) }}" >
                        @error('postal_code')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="website_link">Webseiten:</label>
                        <input type="text" id="website" name="website_link" value="{{ old('website_link', $restaurant->website_link) }}">
                        @error('website_link')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gmap">Anfahrt:</label>
                        <input  type="text" id="gmap" name="gmap" value="{{ old('gmap', $restaurant->gmap) }}">
                        @error('gmap')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="logo">Current Logo:</label>
                        @if($restaurant->logo)
                            <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="Current Logo" style="max-width: 100px;">
                        @else
                            <p>No current logo</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="logo">New Logo:</label>
                        <input type="file" id="logo" name="logo">
                        @error('logo')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary margin-b-20">Update Restaurant</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>
