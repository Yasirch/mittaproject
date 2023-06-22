<x-header>

<div class="row width-city">
    <div class="col-lg-6">
        <div class="city">{{$searchedcity}}</div>
    </div>
    <div class="col-lg-6">
        <form action="{{ route('restaurants.result') }}" method="post" novalidate="novalidate">
            @csrf
            <div class="row">
                <div class="col-lg-12 wrapper">
                    <div class="content center-align">
                        <div class="search search-panel p-0">
                            <input type="text" name="inputcity" onfocusin="displayOption()" id="optioninput" autocomplete="off" class="input-border input-width form-control search-slt" placeholder="Your City or Zip Code...">
                            <div class="button-search p-0">
                                <button type="submit" class="button-color wrn-btn btn">Search</button>
                            </div>
                            <ul class="options" onfocusout="hideOption()" id="optiondisplay">
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
    <div class="table-responsive">
        <table id="calendar">

            <tr class="weekdays">
                <th scope="col">Restaurant</th>
                <th scope="col">Montag</th>
                <th scope="col">Dienstag</th>
                <th scope="col">Mittwoch</th>
                <th scope="col">Donnerstag</th>
                <th scope="col">Freitag</th>
            </tr>

            @if ($restaurants->count() > 0)
                @foreach ($restaurants as $restaurant)
                    <tr class="day">
                        <td class="data-name">
                            {{ $restaurant->name }}
{{--                            <img class="logo-css" src="{{ $restaurant->logo ? $restaurant->logo : '/storage/logos/default.jpg' }}" alt="Restaurant 1">--}}
                            @if($restaurant->website_link)
                                <a class="" target="_blank" href="{{ $restaurant->website_link }}">Webseite</a>
                            @endif
                            @if($restaurant->gmap)
                                <a class="" target="_blank" href="{{ $restaurant->gmap }}">Gmap Link</a>
                            @endif

                        </td>
                        @foreach ($weekdays as $weekday)
                            <td>
                                <div>
                                    <p>{{ $restaurant->menu[$weekday]['food_title'] ?? '' }}</p>
                                    <p>{{ $restaurant->menu[$weekday]['food_description'] ?? '' }}</p>
                                    @if(!empty($restaurant->menu[$weekday]['price']))
                                        <p><strong>Preis: </strong>{{ $restaurant->menu[$weekday]['price'] }} <stong>€</stong></p>
                                    @endif


                                @if (!empty($restaurant->menu[$weekday]['food_additives']))
                                        <div>
                                            <strong>Zusatzstoffe:</strong>
                                        </div>
                                        <p>{{ $restaurant->menu[$weekday]['food_additives'] }}</p>
                                    @endif
                                    @if (!empty($restaurant->menu[$weekday]['allergens']))
                                        <div>
                                            <strong>Allergene:</strong>
                                        </div>
                                        <p>{{ strtoupper($restaurant->menu[$weekday]['allergens'] ?? '') }}</p>
                                    @endif


                                </div>
                            </td>
                        @endforeach

                        <!-- Repeat the above structure for other weekdays -->
                    </tr>
                @endforeach
            @else
                <p class="text-center px-3">No restaurants found in the specified city.</p>
            @endif
        </table>
    </div>

</x-header>
    <script type="text/javascript">
        const wrapper = document.querySelector(".wrapper"),
            searchInp = wrapper.querySelector("input"),
            options = wrapper.querySelector(".options");

        function displayOption() {
            document.getElementById("optiondisplay").style.display ="block";

        }
        function hideOption() {
            document.getElementById("optiondisplay").style.display ="none";

        }


        @php
            $jsonCities = json_encode($citiesWithPostalCodes);
            echo "var countries = $jsonCities;";
        @endphp



        // function mouseDown() {
        //   document.getElementById("optiondisplay").style.display = "block";
        // }
        function addCountry(selectedCountry) {
            options.innerHTML = "";
            countries.forEach(country => {
                let isSelected = country == selectedCountry ? "selected" : "";
                let li = `<li onclick="updateName(this)" class="${isSelected}">${country}</li>`;
                options.insertAdjacentHTML("beforeend", li);
                document.getElementById("optiondisplay").style.display = "none";
            });
        }
        addCountry();

        function updateName(selectedLi) {
            searchInp.value = "";
            addCountry(selectedLi.innerText);
            searchInp.value = selectedLi.innerText;
        }

        searchInp.addEventListener("keyup", () => {
            document.getElementById("optiondisplay").style.display = "block";
            let arr = [];
            let searchWord = searchInp.value.toLowerCase();
            arr = countries.filter(data => {
                return data.toLowerCase().includes(searchWord);
            }).map(data => {
                let isSelected = data == searchInp.value ? "selected" : "";
                return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
            }).join("");
            options.innerHTML = arr ? arr : `<p style="padding-left: 15px; margin-top: 10px;">Oops! Country not found</p>`
        });


    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
