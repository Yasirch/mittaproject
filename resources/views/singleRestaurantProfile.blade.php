<x-layout>


    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card p-3 py-4">
                    <div class="text-center">
{{--                        <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="Restaurant Logo" width="300">--}}

                    </div>



                    <div class="text-center margin-auto mt-3">
                        <div class="text-restaurant margin-auto max-width-500 m-15 text-white"> Restaurant Name: {{$restaurant->name}} </div>
                    </div>
                </div>

                    <div class="card p-3 py-4 ">
                       <div class="flex-center mobile-card-desktop">
                           @php
                               $weekdays = ['Montag', 'Dienstag', 'Mittwoch'];

                               foreach ($weekdays as $weekday) {
                                   $menuForDay = $restaurant->menus()->where('weekday', $weekday)->first();
                                   $menuExistsForDay = !is_null($menuForDay);

                                   if ($menuExistsForDay) {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForDay->id]).'">'.$weekday.' Menü</a>';
                                   } else {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => $weekday]).'">'.$weekday.' Menü</a>';
                                   }
                               }
                           @endphp
                       </div>
                       <div class="flex-center mobile-card-desktop">
                           @php
                               $weekdays = ['Donnerstag', 'Freitag', 'Samstag'];

                               foreach ($weekdays as $weekday) {
                                   $menuForDay = $restaurant->menus()->where('weekday', $weekday)->first();
                                   $menuExistsForDay = !is_null($menuForDay);

                                   if ($menuExistsForDay) {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForDay->id]).'"> '.$weekday.' Menü</a>';
                                   } else {
                                       echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => $weekday]).'"> '.$weekday.' Menü</a>';
                                   }
                               }
                           @endphp
                       </div>
                       <div class="flex-center mobile-card-desktop">
                           @php
                               $menuForSunday = $restaurant->menus()->where('weekday', 'Sonntag')->first();
                               $menuExistsForSunday = !is_null($menuForSunday);
                           @endphp

                           @if ($menuExistsForSunday)
                               <a class="btn btn-sm btn-red mb-2 mr-2" href="{{ route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForSunday->id]) }}">Sonntag Menu</a>
                           @else
                               <a class="btn btn-sm btn-red mb-2 mr-2" href="{{ route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => 'Sonntag']) }}"> Sonntag Menu</a>
                           @endif
                       </div>

                        <div class="flex-center mobile-card-mobile">
                            @php
                                $weekdays = ['Montag', 'Dienstag', 'Mittwoch','Donnerstag', 'Freitag', 'Samstag','Sonntag'];

                                foreach ($weekdays as $weekday) {
                                    $menuForDay = $restaurant->menus()->where('weekday', $weekday)->first();
                                    $menuExistsForDay = !is_null($menuForDay);

                                    if ($menuExistsForDay) {
                                        echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.edit', ['restaurant' => $restaurant->id, 'menu' => $menuForDay->id]).'">'.$weekday.' Menu</a>';
                                    } else {
                                        echo '<a class="btn btn-sm btn-red mb-2 mr-2" href="'.route('menus.create', ['restaurant' => $restaurant->id, 'weekday' => $weekday]).'"> '.$weekday.' Menu</a>';
                                    }
                                }
                            @endphp
                        </div>

                    <div class="card p-3 text-center py-4">
                        <div class="medium">
                            Restaraunt von  {{$restaurant->user->name}}
                        </div>
                        <h5 class="mt-2 mb-0">{{$restaurant->city}} {{$restaurant->postal_code}}</h5>
                        <a href="{{$restaurant->website_link ?? ''}}" target="_blank">Webseiten Link</a>

                    </div>

                    <div class="container py-md-2 text-center container--narrow">
                        <div class="medium">
                            Restaraunt Daten Bearbeiten oder Löschen
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
                                            <a class="nav-link active" data-toggle="tab" href="#monday" role="tab" aria-controls="monday" aria-selected="true">Montag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false">Dienstag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false">Wednesday</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false">Freitag</a>
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
                                            <a class="nav-link active green-color" data-toggle="tab" href="#monday" role="tab" aria-controls="monday" aria-selected="true">Montag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false">Dienstag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false">Freitag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false">Freitag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#friday" role="tab" aria-controls="friday" aria-selected="false">Freitag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#saturday" role="tab" aria-controls="saturday" aria-selected="false">Samstag</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">Sonntag</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-3">
                                        <div class="tab-pane pt-3 show active" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                                            <h3>Montag Menü</h3>
                                            @if ($menus->where('weekday', 'Montag')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Montag') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menü Here:
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                                            <h3>Dienstag Menü</h3>
                                            @if ($menus->where('weekday', 'Dienstag')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Dienstag') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
                                                            @foreach ($menu->allergens as $allergen)
                                                                {{ ucwords($allergen) }},
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="container py-md-2 text-center container--narrow">
                                                        <div class="medium">
                                                            Edit or Delete the {{$menu->weekday}} Menü Here:
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                                            <h3>Mittwoch Menü</h3>
                                            @if ($menus->where('weekday', 'Mittwoch')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Mittwoch') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
                                                        <p><strong>Allergene:</strong>
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                                            <h3>Donnerstag Menu</h3>
                                            @if ($menus->where('weekday', 'Donnerstag')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Donnerstag') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                                            <h3>Freitag Menu</h3>
                                            @if ($menus->where('weekday', 'Freitag')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Freitag') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                                            <h3>Samstag Menu</h3>
                                            @if ($menus->where('weekday', 'Samstag')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Samstag') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong>: {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane pt-3" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                                            <h3>Sonntag Menu</h3>
                                            @if ($menus->where('weekday', 'Sonntag')->count() > 0)
                                                @foreach ($menus->where('weekday', 'Sonntag') as $menu)
                                                    <div class="menu-item">
                                                        <p><strong>Gericht:</strong> {{ $menu->foodtitle }}</p>
                                                        <p><strong>Beschreibung:</strong> {{ $menu->fooddesc }}</p>
                                                        <p><strong>Preis:</strong> {{ $menu->price }}€</p>
                                                        <p><strong>Food Additive:</strong>
                                                            @foreach ($menu->foodadditives as $additive)
                                                                {{ $additive }},
                                                            @endforeach
                                                        </p>
                                                        <p><strong>Allergene:</strong>
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
                                                <p class="py-5">Daten noch nicht Hinzugefügt.</p>
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
