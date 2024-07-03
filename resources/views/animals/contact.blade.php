

<x-app-layout title="Contact">
    <div class="container mx-auto mt-8 p-4 font-serif">
        @if($errors->hasBag('requiredFields'))
            <div class="alert alert-danger">
                <strong class="dark:text-gray-100">Oops! Some required fields are missing:</strong>
                <ul class="list-disc ml-5">
                    @foreach($errors->requiredFields->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <div class="container mx-auto mt-8 p-4 mb-8 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
            <div class="col-span-full">
                <h3 class="text-xl mb-4 font-serif dark:text-gray-200 font-semibold">New Contact</h3>
            </div>
            <hr class="col-span-full mb-4">
            <form action="{{ route('animals.storecontact', ['animal_id' => $animal->id]) }}" method="POST">

                @csrf
            <div class="grid grid-cols-1 font-serif md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">First name</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 mb-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="first_name" id="contact_first_name">
                </div>
                <div class="col-span-1">
                    <label for="contact_last_name" class="dark:text-gray-200 mb-4 mt-2">Last name</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="last_name" id="first_name">
                </div>
            </div>

            <div class="grid grid-cols-1 font-serif md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">Email</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="email" id="last_name">
                </div>


            <div class="grid grid-cols-1 font-serif md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">City</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="city" id="city">
                </div>
                <div class="col-span-1">
                    <div class="col-span-1 ">
                        <label for="county" class="block mb-1  dark:text-gray-100 font-serif  font-medium dark:bg-gray-700 text-gray-700">County/Province</label>
                        <select class="form-select dark:bg-gray-800 dark:text-gray-200 w-full " required="required"  name="county" id="county">
                            <option value="" label=" "></option>
        <option value="Baringo">Baringo</option>
        <option value="Bomet">Bomet</option>
        <option value="Bungoma">Bungoma</option>
        <option value="Busia">Busia</option>
        <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
        <option value="Embu">Embu</option>
        <option value="Garissa">Garissa</option>
        <option value="Homa Bay">Homa Bay</option>
        <option value="Isiolo">Isiolo</option>
        <option value="Kajiado">Kajiado</option>
        <option value="Kakamega">Kakamega</option>
        <option value="Kericho">Kericho</option>
        <option value="Kiambu">Kiambu</option>
        <option value="Kilifi">Kilifi</option>
        <option value="Kirinyaga">Kirinyaga</option>
        <option value="Kisii">Kisii</option>
        <option value="Kisumu">Kisumu</option>
        <option value="Kitui">Kitui</option>
        <option value="Kwale">Kwale</option>
        <option value="Laikipia">Laikipia</option>
        <option value="Lamu">Lamu</option>
        <option value="Machakos">Machakos</option>
        <option value="Makueni">Makueni</option>
        <option value="Mandera">Mandera</option>
        <option value="Marsabit">Marsabit</option>
        <option value="Meru">Meru</option>
        <option value="Migori">Migori</option>
        <option value="Mombasa">Mombasa</option>
        <option value="Murang'a">Murang'a</option>
        <option value="Nairobi">Nairobi</option>
        <option value="Nakuru">Nakuru</option>
        <option value="Nandi">Nandi</option>
        <option value="Narok">Narok</option>
        <option value="Nyamira">Nyamira</option>
        <option value="Nyandarua">Nyandarua</option>
        <option value="Nyeri">Nyeri</option>
        <option value="Samburu">Samburu</option>
        <option value="Siaya">Siaya</option>
        <option value="Taita-Taveta">Taita-Taveta</option>
        <option value="Tana River">Tana River</option>
        <option value="Tharaka-Nithi">Tharaka-Nithi</option>
        <option value="Trans Nzoia">Trans Nzoia</option>
        <option value="Turkana">Turkana</option>
        <option value="Uasin Gishu">Uasin Gishu</option>
        <option value="Vihiga">Vihiga</option>
        <option value="Wajir">Wajir</option>
        <option value="West Pokot">West Pokot</option>
                        </select>
                </div>
            </div>

            </div>
            <div class="grid grid-cols-1 font-serif mb-4 md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="postal_code" class="dark:text-gray-200 mb-4 mt-2">Postal Code</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" max="100000" type="text" name="postal_code" id="postal_code">
                </div>
                <div class="col-span-1">
                    <label for="contact_last_name" class="dark:text-gray-200 mb-4 mt-2">Keywords</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="keywords" id="keywords">
                </div>
            </div>
            <div class="grid grid-cols-1 font-serif md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">Mobile Phone</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="primary_phone" id="primary_phone">
                </div>
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">primary Phone</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" max="10000000" name="mobile_phone" id="mobile_phone">
                </div>
            </div>
            <div class="grid grid-cols-1 font-serif md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">Fax</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" max="10000" type="text" name="fax" id="fax">
                </div>
                <div class="col-span-1">
                    <label for="contact_last_name" class="dark:text-gray-200 mb-4 mt-2">Company</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="company" id="company">
                </div>
            </div>

            <div class="grid grid-cols-1 font-serif md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="contact_first_name" class="dark:text-gray-200 mb-4 mt-2">Street_Address</label>
                    <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" max="100000" type="text" name="street_address" id="street_address">
                </div>
                <div class="col-span-1">
                    <div class="col-span-1 ">
                        <label for="treatment_type" class="block mb-1  dark:text-gray-100 font-serif  font-medium dark:bg-gray-700 text-gray-700">Country</label>
                        <select class="form-select dark:bg-gray-800 dark:text-gray-200 w-full " required="required"  name="country" id="country">
                            <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antarctica">Antarctica</option>
    <option value="Antigua">Antigua</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Ashmore and Cartier Islands">Ashmore and Cartier Islands</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas, The">Bahamas, The</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Baker Island">Baker Island</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana">Botswana</option>
    <option value="Bouvet Island">Bouvet Island</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei">Brunei</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burma">Burma</option>
    <option value="Burundi">Burundi</option>
    <option value="Cabo Verde">Cabo Verde</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Christmas Island">Christmas Island</option>
    <option value="Clipperton Island">Clipperton Island</option>
    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Coral Sea Islands">Coral Sea Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Croatia">Croatia</option>
    <option value="Cuba">Cuba</option>
    <option value="Curaçao">Curaçao</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czechia">Czechia</option>
    <option value="Côte d'Ivoire">Côte d'Ivoire</option>
    <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
    <option value="Denmark">Denmark</option>
    <option value="Dhekelia">Dhekelia</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Eswatini">Eswatini</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands (Islas Malvinas)">Falkland Islands (Islas Malvinas)</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia, The">Gambia, The</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guernsey">Guernsey</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
    <option value="Holy See">Holy See</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Howland Island">Howland Island</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Isle of Man">Isle of Man</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Jan Mayen">Jan Mayen</option>
    <option value="Japan">Japan</option>
    <option value="Jarvis Island">Jarvis Island</option>
    <option value="Jersey">Jersey</option>
    <option value="Johnston Atoll">Johnston Atoll</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya" selected="selected">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Korea, North">Korea, North</option>
    <option value="Korea, South">Korea, South</option>
    <option value="Kosovo">Kosovo</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Laos">Laos</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libya">Libya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
    <option value="Midway Islands">Midway Islands</option>
    <option value="Moldova">Moldova</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montenegro">Montenegro</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Navassa Island">Navassa Island</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="Niue">Niue</option>
    <option value="Norfolk Island">Norfolk Island</option>
    <option value="North Macedonia">North Macedonia</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Palmyra Atoll">Palmyra Atoll</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paracel Islands">Paracel Islands</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Pitcairn Islands">Pitcairn Islands</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russia</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Barthelemy">Saint Barthelemy</option>
    <option value="Saint Helena, Ascension, and Tristan da Cunha">Saint Helena, Ascension, and Tristan da Cunha</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia">Saint Lucia</option>
    <option value="Saint Martin">Saint Martin</option>
    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Serbia">Serbia</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra Leone">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Sint Maarten">Sint Maarten</option>
    <option value="Slovakia">Slovakia</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
    <option value="South Sudan">South Sudan</option>
    <option value="Spain">Spain</option>
    <option value="Spratly Islands">Spratly Islands</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Svalbard">Svalbard</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syria</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania</option>
    <option value="Thailand">Thailand</option>
    <option value="Timor-Leste">Timor-Leste</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Vietnam</option>
    <option value="Virgin Islands, British">Virgin Islands, British</option>
    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
    <option value="Wake Island">Wake Island</option>
    <option value="Wallis and Futuna">Wallis and Futuna</option>
    <option value="Yemen">Yemen</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                </div>
            </div>

            </div>


            <div class="col-span-1">
                <div class="col-span-1">
                    <label for="treatment_type" class="block mb-1 dark:text-gray-100 font-serif font-medium dark:bg-gray-700 text-gray-700">Contact type</label>
                    <select class="form-select dark:bg-gray-800 dark:text-gray-200 w-full select2" required="required" name="contact_type" id="contact_type">
                        <option value="" label=" "></option>
                        <option value="Auditor">Auditor</option>
                        <option value="Breeder">Breeder</option>
                        <option value="Buyer">Buyer</option>
                        <option value="Certifier">Certifier</option>
                        <option value="Contact">Contact</option>
                        <option value="Consultant">Consultant</option>
                        <option value="Contractor">Contractor</option>
                        <option value="Customer">Customer</option>
                        <option value="Employee">Employee</option>
                        <option value="Purchaser">Purchaser</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Vendor">Vendor</option>
                        <option value="Veterinarian">Veterinarian</option>
                        <option value="Wholesale Customer">Wholesale Customer</option>
                    </select>
                </div>
            </div>


            </div>

            <hr class="mt-4">

            <div class="flex justify-end mt-6">
                <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"">

                    <a href="{{ route('index')}}" class="btn btn-gray-500">Cancel</a>
                </button>
                <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    Save
                </button>


            </div>

    </div>
</form>


</x-app-layout>

