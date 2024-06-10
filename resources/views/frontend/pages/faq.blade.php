@extends('frontend.layouts.master')

@section('title','E-TECH || FAQ page')

@section('main-content')

<!-- FAQ 1 - Bootstrap Brain Component -->
<section class="bg-light py-3 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h1 mb-3">How can we help you?</h2>
                <p class="lead fs-4 text-secondary mb-5">We hope you have found an answer to your question. If you need any help, You may contact our Support Center or email us.</p>
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-6">
                        <div class="accordion accordion-flush" id="accordionLeft">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        What is Artistik?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        <p>Artistik is an online marketplace that showcases and sells handicrafts crafted by persons deprived of liberty (PDLs) within the Bureau of Jail Management and Penology (BJMP) facilities, specifically from BJMP General Trias Province of Cavite.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How does Artistik benefit PDL artisans?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        Artistik provides PDL artisans with a platform to showcase their talents and generate sustainable income. A percentage of the profit from sales goes directly to the PDLs, supporting them financially even while they are incarcerated.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Are the products on Artistik of high quality?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        <p>Yes, the products on Artistik are meticulously crafted by skilled PDL artisans. Each item undergoes quality checks to ensure that only the finest handicrafts are showcased on the platform.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        How can I purchase items on Artistik?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        <p>To purchase items on Artistik, simply browse through the collection, select the desired items, and proceed to checkout. Follow the prompts to provide shipping and payment information to complete your purchase securely.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Is it safe to make transactions on Artistik?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        <p>Yes, Artistik prioritizes the security of transactions. We use industry-standard encryption and a secure payment gateway like PayPal to ensure that your personal and financial information remains protected.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        How are the profits from Artistik utilized?
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>A percentage of the profits from Artistik sales goes directly to the PDL artisans to support their financial needs. The remaining profits are reinvested into maintaining and improving the platform, as well as supporting other rehabilitation initiatives.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        Can I track my order on Artistik?
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>Yes, once your order is confirmed, you will receive a tracking number via email. You can use this tracking number to monitor the status of your delivery and estimate its arrival time.</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- Second Column -->
                    <div class="col-md-6">
                        <div class="accordion accordion-flush" id="accordionRight">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        What happens if I'm not satisfied with my purchase?
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>We strive for customer satisfaction, but if you're not completely satisfied with your purchase, please contact us within 7 days of receiving your order. We will work with you to address any concerns and facilitate a return or exchange if necessary.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNine">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                        How can I support Artistik's mission beyond making purchases?
                                    </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>You can support Artistik's mission by spreading the word about the platform to your friends and family, sharing our social media posts, and advocating for the empowerment of PDL artisans. Every bit of support helps us make a difference.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                        Is Artistik available nationwide or internationally?
                                    </button>
                                </h2>
                                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>Currently, Artistik is focused on showcasing handicrafts from BJMP General Trias Province of Cavite. However, we aspire to expand our reach in the future to include PDL artisans from other regions and potentially even international artisans. Stay tuned for updates on our expansion efforts!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEleven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                        Does Artistik accept custom orders?
                                    </button>
                                </h2>
                                <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>At the moment, Artistik primarily offers ready-made handicrafts. However, we are exploring the possibility of accepting custom orders in the future. If you have specific requests, feel free to contact us, and we will do our best to accommodate your needs.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwelve">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                        How can I get in touch with Artistik's support team?
                                    </button>
                                </h2>
                                <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>If you have any questions or need assistance, you can reach out to our support team via email at r4a.crso@bjmp.gov.ph. Our team is dedicated to providing you with the best possible service and will respond to your inquiries promptly.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseTwelve">
                                        Can I cancel or modify my order after it's been placed?
                                    </button>
                                </h2>
                                <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>Once an order has been placed on Artistik, it cannot be canceled or modified. We process orders promptly to ensure timely delivery to our customers. If you have any concerns or need assistance with your order, please contact us, and we'll do our best to assist you.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFourteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseTwelve">
                                        Are there any opportunities for wholesale or bulk purchases on Artistik?
                                    </button>
                                </h2>
                                <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        <p>Yes, Artistik offers opportunities for wholesale or bulk purchases. If you're interested in purchasing a large quantity of items, please contact BJMP personnel directly to discuss your requirements and negotiate potential discounts or promotions. They will assist you in arranging wholesale orders and providing any necessary information regarding pricing, availability, and shipping. Please note that wholesale inquiries should be directed to BJMP personnel for further assistance.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more FAQs as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
@endpush
@push('scripts')
<script>
$(document).ready(function(){

    (function($) {
        "use strict";

        $('.btn-reply.reply').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').hide();
            $('.comment_btn.reply').show();

            $(this).hide();
            $('.btn-reply.cancel').hide();
            $(this).siblings('.btn-reply.cancel').show();

            var parent_id = $(this).data('id');
            var html = $('#commentForm');
            $( html).find('#parent_id').val(parent_id);
            $('#commentFormContainer').hide();
            $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
          });

        $('.comment-list').on('click','.btn-reply.cancel',function(e){
            e.preventDefault();
            $(this).hide();
            $('.btn-reply.reply').show();

            $('.comment_btn.reply').hide();
            $('.comment_btn.comment').show();

            $('#commentFormContainer').show();
            var html = $('#commentForm');
            $( html).find('#parent_id').val('');

            $('#commentFormContainer').append(html);
        });

 })(jQuery)
})
</script>
@endpush
