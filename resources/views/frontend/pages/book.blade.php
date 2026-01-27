@extends('frontend.layouts.master')
@section('title','Book')

@push('css')
<style>
    /* Fix Time Zone dropdown height */
    .nice-select.open .list {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .nice-select .list {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Custom scrollbar for dropdown */
    .nice-select .list::-webkit-scrollbar {
        width: 8px;
    }

    .nice-select .list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .nice-select .list::-webkit-scrollbar-thumb {
        background: var(--ed-color-theme-primary);
        border-radius: 4px;
    }

    .nice-select .list::-webkit-scrollbar-thumb:hover {
        background: var(--ed-color-heading-primary);
    }

    /* Ensure options are properly displayed */
    .nice-select .list li {
        display: block;
        padding: 10px 20px;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush

@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}" alt="shape"></div>
                {{-- <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}" alt="shape"></div> --}}
                {{-- <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}" alt="shape"></div> --}}
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">Book Now</h1>
                <h4 class="sub-title"><a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span><a
                        class="inner-page" href="{{ route('frontend.book') }}"> Book Now</a></h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="contact-section pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-contact-form contact-form">
                        <h2 class="title mb-0">Book Your Session</h2>
                        <p class="mb-30 mt-10">Please fill out the form below to book your session</p>
                        <div class="request-form">
                            <form action="{{ route('frontend.booking.store') }}" method="post" class="form-horizontal">
                                @csrf

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="text" id="fullname" name="fullname" class="form-control"
                                                   placeholder="Your Name" required>
                                            <div class="icon"><i class="fa-regular fa-user"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                   placeholder="Phone" required>
                                            <div class="icon"><i class="fa-sharp fa-solid fa-phone"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Your Email" required>
                                            <div class="icon"><i class="fa-sharp fa-regular fa-envelope"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <select name="timezone" id="timezone"
                                                    class="niceSelect select-control form-control" required>
                                                <option value="">Select Time Zone</option>
                                                <option value="UTC-12">UTC-12:00 (Baker Island Time)</option>
                                                <option value="UTC-11">UTC-11:00 (Hawaii-Aleutian Standard Time)
                                                </option>
                                                <option value="UTC-10">UTC-10:00 (Hawaii Standard Time)</option>
                                                <option value="UTC-9">UTC-09:00 (Alaska Standard Time)</option>
                                                <option value="UTC-8">UTC-08:00 (Pacific Standard Time)</option>
                                                <option value="UTC-7">UTC-07:00 (Mountain Standard Time)</option>
                                                <option value="UTC-6">UTC-06:00 (Central Standard Time)</option>
                                                <option value="UTC-5">UTC-05:00 (Eastern Standard Time)</option>
                                                <option value="UTC-4">UTC-04:00 (Atlantic Standard Time)</option>
                                                <option value="UTC-3">UTC-03:00 (Argentina Time)</option>
                                                <option value="UTC-2">UTC-02:00 (South Georgia Time)</option>
                                                <option value="UTC-1">UTC-01:00 (Cape Verde Time)</option>
                                                <option value="UTC+0">UTC+00:00 (Greenwich Mean Time)</option>
                                                <option value="UTC+1">UTC+01:00 (Central European Time)</option>
                                                <option value="UTC+2">UTC+02:00 (Eastern European Time)</option>
                                                <option value="UTC+3">UTC+03:00 (Moscow Time)</option>
                                                <option value="UTC+4">UTC+04:00 (Gulf Standard Time)</option>
                                                <option value="UTC+5">UTC+05:00 (Pakistan Standard Time)</option>
                                                <option value="UTC+6">UTC+06:00 (Bangladesh Standard Time)</option>
                                                <option value="UTC+7">UTC+07:00 (Indochina Time)</option>
                                                <option value="UTC+8">UTC+08:00 (China Standard Time)</option>
                                                <option value="UTC+9">UTC+09:00 (Japan Standard Time)</option>
                                                <option value="UTC+10">UTC+10:00 (Australian Eastern Standard Time)
                                                </option>
                                                <option value="UTC+11">UTC+11:00 (Solomon Islands Time)</option>
                                                <option value="UTC+12">UTC+12:00 (New Zealand Standard Time)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <select name="country" id="country"
                                                    class="niceSelect select-control form-control" required>
                                                <option value="">Select Country</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="BN">Brunei Darussalam</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo</option>
                                                <option value="CD">Congo, Democratic Republic</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Cote D'Ivoire</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and Mcdonald Islands</option>
                                                <option value="VA">Holy See (Vatican City State)</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran, Islamic Republic Of</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KP">Korea, Democratic People's Republic Of</option>
                                                <option value="KR">Korea, Republic of</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Lao People's Democratic Republic</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao</option>
                                                <option value="MK">Macedonia, The Former Yugoslav Republic Of</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia, Federated States Of</option>
                                                <option value="MD">Moldova, Republic of</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestinian Territory, Occupied</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RE">Reunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russian Federation</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and The Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="GS">South Georgia and The South Sandwich Islands</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syrian Arab Republic</option>
                                                <option value="TW">Taiwan, Province of China</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania, United Republic of</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UM">United States Minor Outlying Islands</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="VG">Virgin Islands, British</option>
                                                <option value="VI">Virgin Islands, U.S.</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <textarea id="notes" name="notes" cols="30" rows="5"
                                                      class="form-control address" placeholder="Notes (Optional)"></textarea>
                                            <div class="icon"><i class="fa-light fa-messages"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button type="submit" class="ed-primary-btn">Submit Booking</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ contact-section -->
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize niceSelect
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.niceSelect !== 'undefined') {
            jQuery('select').niceSelect();
        }

        // Add search functionality to Time Zone dropdown
        function addSearchToTimezone() {
            const timezoneSelect = document.getElementById('timezone');
            const timezoneNiceSelect = timezoneSelect?.nextElementSibling;

            if (!timezoneNiceSelect || !timezoneNiceSelect.classList.contains('nice-select')) {
                return;
            }

            // Create search input
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'nice-select-search';
            searchInput.placeholder = 'Search time zone...';
            searchInput.style.cssText = 'width: 100%; padding: 8px 15px; border: 1px solid #e8e8e8; border-radius: 5px; margin-bottom: 5px; font-size: 14px;';

            // Add search input when dropdown opens
            timezoneNiceSelect.addEventListener('click', function() {
                const list = this.querySelector('.list');
                if (list && !list.querySelector('.nice-select-search')) {
                    list.insertBefore(searchInput, list.firstChild);
                    searchInput.focus();
                }
            });

            // Filter options on input
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const options = timezoneNiceSelect.querySelectorAll('.list li.option');

                options.forEach(function(option) {
                    const text = option.textContent.toLowerCase();
                    if (text.includes(searchTerm) || searchTerm === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        }

        // Add search functionality to Country dropdown
        function addSearchToCountry() {
            const countrySelect = document.getElementById('country');
            const countryNiceSelect = countrySelect?.nextElementSibling;

            if (!countryNiceSelect || !countryNiceSelect.classList.contains('nice-select')) {
                return;
            }

            // Create search input
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'nice-select-search';
            searchInput.placeholder = 'Search country...';
            searchInput.style.cssText = 'width: 100%; padding: 8px 15px; border: 1px solid #e8e8e8; border-radius: 5px; margin-bottom: 5px; font-size: 14px;';

            // Add search input when dropdown opens
            countryNiceSelect.addEventListener('click', function() {
                const list = this.querySelector('.list');
                if (list && !list.querySelector('.nice-select-search')) {
                    list.insertBefore(searchInput, list.firstChild);
                    searchInput.focus();
                }
            });

            // Filter options on input
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const options = countryNiceSelect.querySelectorAll('.list li.option');

                options.forEach(function(option) {
                    const text = option.textContent.toLowerCase();
                    if (text.includes(searchTerm) || searchTerm === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        }

        // Wait for niceSelect to initialize
        setTimeout(function() {
            addSearchToTimezone();
            addSearchToCountry();
        }, 500);

        // Reinitialize when niceSelect updates
        if (typeof jQuery !== 'undefined') {
            jQuery(document).on('click', '.nice-select', function() {
                setTimeout(function() {
                    addSearchToTimezone();
                    addSearchToCountry();
                }, 100);
            });
        }
    });
</script>
@endpush



