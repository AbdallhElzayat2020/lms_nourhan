<!DOCTYPE html>
<html class="no-js" lang="en">

@include('frontend.layouts.head')

<body>
@include('frontend.layouts.header')


@yield('content')

@include('frontend.layouts.footer')
<!-- ./ footer-section -->


<div id="scrollup">
    <button id="scroll-top" class="scroll-to-top"><i class="fa-regular fa-arrow-up-long"></i></button>
</div>
<!--scrollup-->

<!-- Floating Action Buttons -->
<div class="floating-buttons">
    <a href="https://wa.me/201000000000" target="_blank" class="floating-btn whatsapp-btn" title="Contact us on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <a href="tel:+201000000000" class="floating-btn call-btn" title="Contact us on Phone">
        <i class="fa-solid fa-phone"></i>
    </a>
</div>
<!-- ./ Floating Action Buttons -->

<!-- JS here -->
@include('frontend.layouts.scripts')
</body>

</html>
