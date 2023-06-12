<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/homepage.css" rel="stylesheet" type="text/css"/>

    <meta http-equiv="Cache-control" content="no-cache">
    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css">
    <title>Mittagstisch</title>
</head>
<body>
<div class="row header-color pt-1 pb-1">
    <img class="logo-header" src="bilder/mittagstisch-LOGO_xy-software-house-gmbh.png" alt="Logo">
    <a class="link-login" href="/login" class="homepage-login">Login</a>
</div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  data-interval="1000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="Slider/Melone.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <div class="CarouselMessage htext-size">Hunger</div>
                <div class="CarouselMessage stext-size">Find your lunch table in your area!</div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Slider/Fisch-Steak.png" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Slider/Meeresfrüchte.png" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section class="search-sec">
    <div class="container">

        <form action="{{ route('restaurants.result') }}" target="_blank" method="post" novalidate="novalidate">
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
</section>

<div class="clearfix">
    <div class="green-divider top-114">
    </div>
</div>

<div class="row justify-content-center width-992 bg-grey">
    <div class="col-lg-6">
        <div class="app-text">The lunch table app on your smartphone:</div>
        <div class="app-text"> Find your lunch anytime, anywhere!</div>
        <div class="app-text"> Add to home screen - click here! </div>
        <div class="logo-container">
            <img class="app-logo" src="bilder/mittagstisch-LOGO_xy-software-house-gmbh.png" alt="logo">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mobile-container">
            <img class="mobile-image" src="bilder/mittagstisch_Smartphone-1.png" alt="logo">
        </div>
    </div>
</div>
<div class="row width-news">
    <div class="col-lg-8 mobile-container">
        <img class="news-image" src="bilder/Newsletter.jpg" alt="news" >
    </div>
    <div class="col-lg-4">
        <div class="news-container">
            <div class="news-text-bold">Your lunchtime newsletter</div>
            <div class="news-text padding-10">Subscribe to our newsletter now? </div>

            <div class="news-text">We write about restaurants in your region. Find out about news, delicious offers and what else the restaurants have to offer.  </div>
            <div class="news-text">Just click and fill out!</div>
        </div>
    </div>
</div>

<div class="clearfix">
    <div class="green-divider">
    </div>
</div>

<div class="row width-extra bg-grey">
    <div class="col-lg-4">
        <div class="extra-container">
            <div class="extra-text-bold">The advantages for your restaurant</div>
            <div class="extra-text padding-10">Whether office or factory, whether bank or retail, crafts or supermarket, whether warehouse or administration, many go out for lunch and would also like to eat something else if they only knew what is available. </div>

            <div class="extra-text">Show them what your restaurant has to offer. Today and all week - every week anew.           </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="extra-container">
            <div class="extra-text-bold">Your Extras</div>
            <div class="extra-text padding-10">If you want more than just being listed on our lunch table app, you are welcome to place an individual advertising banner for your restaurant </div>

            <div class="extra-text">- designed according to your wishes and for any period of time.
                Or we write an article about your culinary offer in our digital newsletter or on Instagram.  </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="extra-container">
            <div class="extra-text-bold">Register your restaurant now </div>
            <div class="extra-text padding-10">You can register your restaurant with us in just one step. Just send us the details of your restaurant. We will get back to you immediately and explain what we can offer for your restaurant.   </div>

            <div class="extra-text">You can reach thousands of people in your region. And everyone can see what's for lunch. </div>
        </div>
    </div>
</div>

<div class="clearfix">
    <div class="green-divider">
    </div>
</div>

<div class="row width-advert bg-grey">

    <div class="col-lg-8">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="bilder/Werbebanner.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="bilder/Werbebanner-Badenstuff.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="bilder/Werbebanner-Schlossbrauerei.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="advert-container">
            <div class="advert-text-bold">Register your restaurant now </div>
            <div class="advert-text padding-10">You can register your restaurant with us in just one step. Just send us the details of your restaurant. We will get back to you immediately and explain what we can offer for your restaurant.   </div>

            <div class="extra-text">You can reach thousands of people in your region. And everyone can see what's for lunch. </div>
        </div>
    </div>
</div>

<div class="clearfix">
    <div class="green-footer">
        <ul class="social-icons">
            <li class="contact footer-icon">
                <a href="#" target="_blank" class="icon">
                    <img src="https://offenblog.de/wp-content/uploads/2021/06/Kontakt.png" alt="Contact">
                </a>
            </li>

            <li class="impressum footer-icon">
                <a href="#" target="_blank" class="icon">
                    <img src="https://offenblog.de/wp-content/uploads/2021/06/Impressum.png" alt="imprint">
                </a>
            </li>

            <li class="dvg footer-icon">
                <a href="#" target="_blank" class="icon">
                    <img src="https://offenblog.de/wp-content/uploads/2021/06/DSGVO-1.png" alt="GDPR">
                </a>
            </li>

        </ul>
        <div class="coded-by">
            Designed by Thilo Illgner & Mike Schneider - © & ℗ 2021 xy software house
        </div>
    </div>
</div>
</body>


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
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
