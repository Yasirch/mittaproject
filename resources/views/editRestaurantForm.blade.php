<x-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="/restaurant/{{$restaurant->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Restaurant Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name',$restaurant->name ) }}">
                        @error('name')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Stadt">Stadt:</label>
                        <input type="text" id="city" name="city" value="{{  old('city', $restaurant->city ) }}">
                        @error('city')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postleitzahl:</label>
                        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $restaurant->postal_code) }}" >
                        @error('postal_code')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="website_link">Webseiten:</label>
                        <input type="text" id="website" name="website_link" value="{{  old('website_link', $restaurant->website_link) }}">
                        @error('website_link')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="website_link">Anfahrt:</label>
                        <input type="text" id="website" name="gmap" value="{{  old('gmap', $restaurant->gmap) }}">
                        @error('website_link')
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

                    <button type="submit" name="submit" class="btn btn-primary mr-2 margin-b-20">Änderungen speichern</button>
                    <a href="/restaurant/{{$restaurant->id}}"><button class="btn btn-primary margin-b-20">Abbrechen</button></a>


                </form>
            </div>
        </div>
    </div>

</x-layout>
