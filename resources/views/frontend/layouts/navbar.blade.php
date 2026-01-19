<header class="w-full bg-white">
    <div class="container flex items-center justify-between py-4 mx-auto">
        <div class="menu-toggle cursor-pointer block lg:hidden">
            <span class="iconify" data-icon="fe:bar" data-width="24" data-height="24"></span>
        </div>
        <div class="header-logo flex items-center gap-2">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/frontend/assets/images/logo.png') }}" alt="Logo" class="w-auto h-10">
            </a>
        </div>
        <nav class="header-menu mx-8 relative">
            <div class="close-menu-toggle lg:hidden absolute top-2.5 right-2.5">
                <span class="iconify" data-icon="ic:sharp-clear" data-width="22" data-height="22"></span>
            </div>
            <ul class="flex justify-center lg:gap-4 xl:gap-10 text-base font-semibold text-black">
                <li class="relative inline-block group w-full nav-father">
                    <div class="flex items-center justify-between lg:justify-normal gap-1 cursor-pointer">
                        <a href="index.html" class="transition-all duration-200 hover:text-green-zomp">Home</a>
                        <span class="iconify text-dark-grey" data-icon="meteor-icons:angle-down" data-width="20"
                            data-height="20"></span>
                    </div>
                    <div
                        class="nav-wrapper lg:absolute lg:p-5 lg:w-60 lg:left-0 lg:top-7.5 bg-white lg:shadow-custom lg:rounded-custom lg:opacity-0 lg:invisible lg:transition-all lg:group-hover:opacity-100 lg:group-hover:visible z-[999]">
                        <ul class="nav-menu">
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="../index.html" target="blank">Home 1 – Video Slider</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="../home-2.html" target="blank">Home 2 – Image Slider</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="../home-3.html" target="blank">Home 3 – Background Image</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="../home-4.html" target="blank">Home 4</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="relative inline-block group w-full nav-father">
                    <div class="flex items-center justify-between lg:justify-normal gap-1 cursor-pointer">
                        <a href="#" class="transition-all duration-200 hover:text-green-zomp">Tours</a>
                        <span class="iconify text-dark-grey" data-icon="meteor-icons:angle-down" data-width="20"
                            data-height="20"></span>
                    </div>
                    <div
                        class="nav-wrapper lg:absolute lg:p-5 lg:w-60 lg:left-0 lg:top-7.5 bg-white lg:shadow-custom lg:rounded-custom lg:opacity-0 lg:invisible lg:transition-all lg:group-hover:opacity-100 lg:group-hover:visible z-[999]">
                        <ul class="nav-menu">
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="tours.html">Tours List</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="tours-details-style-01.html">Single Tour – Layout 1</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="tours-details-style-02.html">Single Tour – Layout 2</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="deals.html">Deals</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="relative inline-block group w-full nav-father">
                    <div class="flex items-center justify-between lg:justify-normal gap-1 cursor-pointer">
                        <a href="#" class="transition-all duration-200 hover:text-green-zomp">Destination</a>
                        <span class="iconify text-dark-grey" data-icon="meteor-icons:angle-down" data-width="20"
                            data-height="20"></span>
                    </div>
                    <div
                        class="nav-wrapper lg:absolute lg:p-5 lg:w-60 lg:left-0 lg:top-7.5 bg-white lg:shadow-custom lg:rounded-custom lg:opacity-0 lg:invisible lg:transition-all lg:group-hover:opacity-100 lg:group-hover:visible z-[999]">
                        <ul class="nav-menu">
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="destinations.html">Destination List</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="tour-destination.html">Single Destination</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="trip-ideas.html">Trip Ideas</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="deals.html" class="transition-all duration-200 hover:text-green-zomp">Deals</a>
                </li>
                <li>
                    <a href="careers.html" class="transition-all duration-200 hover:text-green-zomp">Careers</a>
                </li>
                <li class="relative inline-block group w-full nav-father">
                    <div class="flex items-center justify-between lg:justify-normal gap-1 cursor-pointer">
                        <a href="#" class="transition-all duration-200 hover:text-green-zomp">Page</a>
                        <span class="iconify text-dark-grey" data-icon="meteor-icons:angle-down" data-width="20"
                            data-height="20"></span>
                    </div>
                    <div
                        class="nav-wrapper lg:absolute lg:p-5 lg:w-60 lg:left-0 lg:top-7.5 bg-white lg:shadow-custom lg:rounded-custom lg:opacity-0 lg:invisible lg:transition-all lg:group-hover:opacity-100 lg:group-hover:visible z-[999]">
                        <ul class="nav-menu">
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="blogs.html">Blogs</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="shop.html">Shop</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="about-us.html">About us</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="contact-us.html">Contact Us</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="faqs.html">FAQs</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="gallery.html">Gallery</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="travel-tips.html">Travel Tips</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="my-account.html">My Account</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="cart.html">Cart</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="checkout.html">Checkout</a>
                            </li>
                            <li
                                class="nav-items mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                <a href="terms-and-conditions.html">Terms and Conditions</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="flex items-center gap-6">
            <div class="hidden sm:flex items-center gap-4">
                <div class="relative inline-block group">
                    <div
                        class="flex items-center gap-2 p-2 text-base font-semibold text-black rounded-lg cursor-pointer group-hover:bg-green-light">
                        <span class="iconify text-green-zomp" data-icon="solar:global-linear" data-width="20"
                            data-height="20"></span>
                        <p>English</p>
                        <span class="iconify text-dark-grey" data-icon="meteor-icons:angle-down" data-width="20"
                            data-height="20"></span>
                    </div>
                    <div
                        class="absolute right-0 z-50 invisible px-4 py-6 mt-3 transition-all duration-200 bg-white rounded-lg opacity-0 shadow-shadow-custom w-72 group-hover:visible group-hover:opacity-100">
                        <h4 class="mb-4 text-base font-semibold  text-darker-grey">Select your language</h4>
                        <div class="mb-4 border-b border-light-grey"></div>
                        <ul class="grid grid-cols-2 gap-x-4">
                            <li
                                class="mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                English</li>
                            <li
                                class="mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                Français</li>
                            <li
                                class="mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                Italiano</li>
                            <li
                                class="mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                Español</li>
                            <li
                                class="mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                Deutsch</li>
                            <li
                                class="mb-2.5 last:mb-0 cursor-pointer hover:text-green-zomp transition-all duration-200">
                                Tiếng Việt</li>
                        </ul>
                    </div>
                </div>

                <div class="relative flex items-center gap-1">
                    <select
                        class="w-full px-2 pr-5 text-base font-semibold text-black border-none outline-none appearance-none cursor-pointer ring-0 focus:outline-none focus:ring-0 focus:border-transparent">
                        <option class="px-2">USD</option>
                        <option class="px-2">VND</option>
                    </select>

                    <span class="absolute right-0 text-gray-500 -translate-y-1/2 pointer-events-none top-1/2">
                        <span class="iconify text-dark-grey" data-icon="meteor-icons:angle-down" data-width="20"
                            data-height="20"></span>
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative inline-block group">
                    <a href="#" class="hidden sm:block relative bg-white-grey p-2.5 rounded-full">
                        <span class="iconify" data-icon="ph:shopping-cart-light" data-width="24"
                            data-height="24"></span>
                    </a>
                    <div
                        class="hidden md:block absolute shadow-[0_1px_5px_0_#0000001a] left-0 sm:left-auto right-0 py-6 px-4 mt-3 w-[350px] bg-white invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-max border-collapse">
                                <tr class="">
                                    <td class="py-2 text-left">
                                        <i class="iconify text-lg cursor-pointer" data-icon="mdi:remove"></i>
                                    </td>
                                    <td class="py-2 text-left">
                                        <a href="shop-details.html">
                                            <img src="./assets/images/shop/shop-cart-01.png" alt=""
                                                class="w-16 h-16 object-contain">
                                        </a>
                                    </td>
                                    <td class="text-left" colspan="2">
                                        <a href="shop-details.html"
                                            class="text-black font-medium transition duration-200 hover:text-green-zomp">Compact
                                            Shelter</a>
                                        <span class="text-dark-grey block"><span>2 x </span>$20.00</span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="py-2 text-left">
                                        <i class="iconify text-lg cursor-pointer" data-icon="mdi:remove"></i>
                                    </td>
                                    <td class="py-2 text-left">
                                        <a href="shop-details.html">
                                            <img src="./assets/images/shop/shop-cart-02.png" alt=""
                                                class="w-16 h-16 object-contain">
                                        </a>
                                    </td>
                                    <td class="text-left" colspan="2">
                                        <a href="shop-details.html"
                                            class="text-black font-medium transition duration-200 hover:text-green-zomp">Camera
                                            journey</a>
                                        <span class="text-dark-grey block"><span>1 x </span>$10.00</span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="py-2 text-left">
                                        <i class="iconify text-lg cursor-pointer" data-icon="mdi:remove"></i>
                                    </td>
                                    <td class="py-2 text-left">
                                        <a href="shop-details.html">
                                            <img src="./assets/images/shop/shop-cart-03.png" alt=""
                                                class="w-16 h-16 object-contain">
                                        </a>
                                    </td>
                                    <td class="text-left" colspan="2">
                                        <a href="shop-details.html"
                                            class="text-black font-medium transition duration-200 hover:text-green-zomp">Sleeping
                                            bag</a>
                                        <span class="text-dark-grey block"><span>1 x </span>120.00</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-b border-light-grey my-4"></div>
                        <div class="flex items-center justify-between gap-4">
                            <strong class="block text-black font-semibold">Subtotal:</strong>
                            <span class="block text-green-zomp font-semibold">$99.00</span>
                        </div>
                        <div class="border-b border-light-grey my-4"></div>
                        <div class="flex items-center justify-between gap-4">
                            <a href="cart.html"
                                class="text-green-zomp py-2.5 px-6 rounded-[200px] border border-green-zomp font-semibold transition duration-200 hover:text-white hover:bg-green-zomp capitalize">View
                                cart</a>
                            <a href="checkout.html"
                                class="text-green-zomp py-2.5 px-6 rounded-[200px] border border-green-zomp font-semibold transition duration-200 hover:text-white hover:bg-green-zomp capitalize">Checkout</a>
                        </div>
                    </div>
                </div>
                <a href="#"
                    class="text-white text-base font-semibold py-2.5 px-4 bg-green-zomp rounded-[200px] transition duration-200 hover:bg-green-zomp-hover">Sign
                    in</a>
            </div>
        </div>
    </div>
</header>
