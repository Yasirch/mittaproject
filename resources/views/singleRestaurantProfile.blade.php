<x-layout>


    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card p-3 py-4">
                    <div class="text-center">
                        <img src="{{ secure_asset('storage/' . $restaurant->logo) }}" width="300">
                    </div>



                    <div class="text-center margin-auto mt-3">
                        <div class="text-restaurant margin-auto max-width-500 m-15 text-white"> Restaurant Name: {{$restaurant->name}} </div>
                    </div>
                </div>

                    <div class="card p-3 py-4 ">
                       <div class="flex-center mobile-card-desktop">
                           @php
                               $weekdays = ['Monday', 'Tuesday', 'Wednesday'];

                               foreach ($weekdays as $weekday) {
                                   $menuForDay = $restaurant->menus()->where('weekday', $weekday)->first();
                                   $menuExistsForDay = !is_null($menuForDay);

                                   if ($menuExistsForDay) {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForDay->id]).'">Edit '.$weekday.' Menu</a>';
                                   } else {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => $weekday]).'">Add '.$weekday.' Menu</a>';
                                   }
                               }
                           @endphp
                       </div>
                       <div class="flex-center mobile-card-desktop">
                           @php
                               $weekdays = ['Thursday', 'Friday', 'Saturday'];

                               foreach ($weekdays as $weekday) {
                                   $menuForDay = $restaurant->menus()->where('weekday', $weekday)->first();
                                   $menuExistsForDay = !is_null($menuForDay);

                                   if ($menuExistsForDay) {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForDay->id]).'">Edit '.$weekday.' Menu</a>';
                                   } else {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => $weekday]).'">Add '.$weekday.' Menu</a>';
                                   }
                               }
                           @endphp
                       </div>
                       <div class="flex-center mobile-card-desktop">
                           @php
                               $menuForSunday = $restaurant->menus()->where('weekday', 'Sunday')->first();
                               $menuExistsForSunday = !is_null($menuForSunday);
                           @endphp

                           @if ($menuExistsForSunday)
                               <a class="btn btn-sm btn-red mb-2 mr-2" href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForSunday->id]) }}">Edit Sunday Menu</a>
                           @else
                               <a class="btn btn-sm btn-red mb-2 mr-2" href="{{ route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => 'Sunday']) }}">Add Sunday Menu</a>
                           @endif
                       </div>

                        <div class="flex-center mobile-card-mobile">
                            @php
                                $weekdays = ['Monday', 'Tuesday', 'Wednesday','Thursday', 'Friday', 'Saturday','Sunday'];

                                foreach ($weekdays as $weekday) {
                                    $menuForDay = $restaurant->menus()->where('weekday', $weekday)->first();
                                    $menuExistsForDay = !is_null($menuForDay);

                                    if ($menuExistsForDay) {
                                        echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForDay->id]).'">Edit '.$weekday.' Menu</a>';
                                    } else {
                                        echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => $weekday]).'">Add '.$weekday.' Menu</a>';
                                    }
                                }
                            @endphp
                        </div>

                    <div class="card p-3 text-center py-4">
                        <div class="medium">
                            Restaurant is Listed by {{$restaurant->user->name}}
                        </div>
                        <h5 class="mt-2 mb-0">{{$restaurant->city}} {{$restaurant->postal_code}}</h5>
                        <a href="{{$restaurant->website_link ?? ''}}" target="_blank">Website Link</a>

                    </div>

                    <div class="container py-md-2 text-center container--narrow">
                        <div class="medium">
                            Edit or Delete the Restaurant Details Here:
                        </div>
                        @can('update', $restaurant)
                            <span class="pt-2">
                              <a href="/restaurant/{{$restaurant->id}}/edit" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                              <form class="delete-post-form d-inline" action="/restaurant/{{$restaurant->id}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                              </form>
                            </span>
                        @endcan
                    </div>
                    <div class="container py-md-2 pt-4 mt-4 text-center container--narrow tab-border mb-5">

                        <div class="container pt-4">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <ul class="nav nav-tabs d-md-none link-color " role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#monday" role="tab" aria-controls="monday" aria-selected="true">Monday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false">Tuesday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false">Wednesday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false">Thursday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#friday" role="tab" aria-controls="friday" aria-selected="false">Friday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#saturday" role="tab" aria-controls="saturday" aria-selected="false">Saturday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">Sunday</a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-tabs link-color  d-none d-md-flex  nav-justified " role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active green-color" data-toggle="tab" href="#monday" role="tab" aria-controls="monday" aria-selected="true">Monday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false">Tuesday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false">Wednesday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false">Thursday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#friday" role="tab" aria-controls="friday" aria-selected="false">Friday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#saturday" role="tab" aria-controls="saturday" aria-selected="false">Saturday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">Sunday</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-3">
                                        <div class="tab-pane pt-3 show active" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                                            <h3>Monday Menu</h3>
                                            @if ($menus->where('weekday', 'Monday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Monday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                                            <h3>Tuesday Menu</h3>
                                            @if ($menus->where('weekday', 'Tuesday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Tuesday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                                            <h3>Wednesday Menu</h3>
                                            @if ($menus->where('weekday', 'Wednesday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Wednesday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>
                                                @endforeach

                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                                            <h3>Thursday Menu</h3>
                                            @if ($menus->where('weekday', 'Thursday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Thursday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>

                                                @endforeach
                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                                            <h3>Friday Menu</h3>
                                            @if ($menus->where('weekday', 'Friday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Friday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                                            <h3>Saturday Menu</h3>
                                            @if ($menus->where('weekday', 'Saturday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Saturday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                                            <h3>Sunday Menu</h3>
                                            @if ($menus->where('weekday', 'Sunday')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Sunday') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Food Name:</strong> {{ $menu->foodtitle }}</p>
                                                        <p><strong>Food Description:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Price:</strong> ${{ $menu->price }}</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergens:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menu Here:
                                                        </div>
                                                        <span class="pt-2 mb-2">
                                                              <a href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menu->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                              <form class="delete-post-form d-inline" action="{{ route('menus.destroy', ['restaurant' => $restaurant->id, 'weekday' => $menu->weekday]) }}" method="POST">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                              </form>
                                                            </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="py-5">Data not added yet.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>
