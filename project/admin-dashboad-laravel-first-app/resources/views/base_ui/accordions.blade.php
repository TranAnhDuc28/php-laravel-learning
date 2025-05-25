@extends('app')

@section('title', 'Accordions')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Accordions'"
                :breadcrumbs="[
                   ['label' => 'Base UI', 'url' => route('baseUi.accordions')],
                   ['label' => 'Accordions', 'url' => null]
                ]"
            />

            <div class="row">
                {{-- Default Accordion. --}}
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Default Accordion</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="default-base-show-code" class="form-label text-muted">Show Code</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="default-base-show-code">
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <p class="text-muted">Use the <code>accordion</code> class to expand/collapse the accordion content.</p>
                            <div class="live-preview">
                                <div class="accordion" id="default-accordion-example">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                How to create a group booking ?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                Although you probably won’t get into any legal trouble if you do it just once, why risk it? If you made your subscribers a promise,
                                                you should honor that. If not, you run the risk of a drastic increase in opt outs, which will only hurt you in the long run.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Why do we use it ?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur.
                                                Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply."
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Where does it come from ?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have
                                                this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none code-view">
                                <pre class="language-markup" style="height: 320px;">
                                    <code>
                                        &lt;!-- Base Example --&gt;
                                        &lt;div class=&quot;accordion&quot; id=&quot;default-accordion-example&quot;&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;headingOne&quot;&gt;
                                                    &lt;button class=&quot;accordion-button&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#collapseOne&quot; aria-expanded=&quot;true&quot; aria-controls=&quot;collapseOne&quot;&gt;
                                                        How to create a group booking ?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;collapseOne&quot; class=&quot;accordion-collapse collapse show&quot; aria-labelledby=&quot;headingOne&quot; data-bs-parent=&quot;#default-accordion-example&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        Although you probably won’t get into any legal trouble if you do it just once, why risk it? If you made your subscribers a promise,
                                                        you should honor that. If not, you run the risk of a drastic increase in opt outs, which will only hurt you in the long run.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;headingTwo&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#collapseTwo&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapseTwo&quot;&gt;
                                                        Why do we use it ?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;collapseTwo&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;headingTwo&quot; data-bs-parent=&quot;#default-accordion-example&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur.
                                                        Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply."
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;headingThree&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#collapseThree&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapseThree&quot;&gt;
                                                        Where does it come from ?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;collapseThree&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;headingThree&quot; data-bs-parent=&quot;#default-accordion-example&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment,
                                                        plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    </code>
                                </pre>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!--end col-->

                {{-- Accordion Flush. --}}
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Accordion Flush</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="accordion-flush" class="form-label text-muted">Show Code</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="accordion-flush">
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <p class="text-muted">
                                Use <code>accordion-flush</code> class to remove the default background-color, some borders, and some rounded corners to render accordions edge-to-edge with their parent container.
                            </p>
                            <div class="live-preview">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                How do I set up my profile ?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                The renewal of your SlickText service happens on the anniversary of your original paid sign up date. Upgrading in the middle of
                                                your billing period will not change the billing date. Upgrading does however force an immediate, pro-rated charge to take place on your account.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                What can I do with my project ?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                If you had signed up on a free account with Slicktext, then upgraded to a paid plan at a later date, your bill will renew
                                                based on the date you had upgraded to a paid plan. All invoices are able to be viewed under your plan options in your SlickText account.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Where can I go to edit voice settings
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                No, we cannot provide this information. Opting out from a list is an anonymous, private act. This prevents further harassment.
                                                Providing this information is considered bad practice, and further communication after they opt out would be considered against compliance.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none code-view">
                                <pre class="language-markup" style="height: 320px;">
                                    <code>
                                        &lt;!-- Accordion Flush Example --&gt;
                                        &lt;div class=&quot;accordion accordion-flush&quot; id=&quot;accordionFlushExample&quot;&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;flush-headingOne&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#flush-collapseOne&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;flush-collapseOne&quot;&gt;
                                                        How do I set up my profile ?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;flush-collapseOne&quot; class=&quot;accordion-collapse collapse show&quot; aria-labelledby=&quot;flush-headingOne&quot; data-bs-parent=&quot;#accordionFlushExample&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        The renewal of your SlickText service happens on the anniversary of your original paid sign up date. Upgrading in the middle of your
                                                        billing period will not change the billing date. Upgrading does however force an immediate, pro-rated charge to take place on your account.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;flush-headingTwo&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#flush-collapseTwo&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;flush-collapseTwo&quot;&gt;
                                                        What can I do with my project ?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;flush-collapseTwo&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;flush-headingTwo&quot; data-bs-parent=&quot;#accordionFlushExample&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        If you had signed up on a free account with Slicktext, then upgraded to a paid plan at a later date, your bill will renew based
                                                        on the date you had upgraded to a paid plan. All invoices are able to be viewed under your plan options in your SlickText account.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;flush-headingThree&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#flush-collapseThree&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;flush-collapseThree&quot;&gt;
                                                        Where can I go to edit voice settings ?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;flush-collapseThree&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;flush-headingThree&quot; data-bs-parent=&quot;#accordionFlushExample&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        No, we cannot provide this information. Opting out from a list is an anonymous, private act. This prevents further harassment.
                                                        Providing this information is considered bad practice, and further communication after they opt out would be considered against compliance.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    </code>
                                </pre>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!--end col-->
            </div><!--end row-->

            {{-- Accordions with Icons. --}}
            <div class="row">
                {{-- Accordions with Icons. --}}
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Accordions with Icons</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="accordion-icon" class="form-label text-muted">Show Code</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="accordion-icon">
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <p class="text-muted">Use <code>custom-accordion-with-icon</code> class to show custom icon at accordion.</p>
                            <div class="live-preview">
                                <div class="accordion custom-accordion-with-icon accordion-secondary" id="accordion-with-icon">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionWithIconExample1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_iconExampleCollapse1" aria-expanded="true" aria-controls="accor_iconExampleCollapse1">
                                                <i class="ri-global-line me-2"></i> How Does Age Verification Work?
                                            </button>
                                        </h2>
                                        <div id="accor_iconExampleCollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionWithIconExample1" data-bs-parent="#accordion-with-icon">
                                            <div class="accordion-body">
                                                Increase or decrease the letter spacing depending on the situation and try, try again until it looks right, and each
                                                assumenda labore aes Homo nostrud organic, assumenda labore aesthetic magna elements, buttons, everything.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionWithIconExample2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_iconExampleCollapse2" aria-expanded="false" aria-controls="accor_iconExampleCollapse2">
                                                <i class="ri-user-location-line me-2"></i> How Does Link Tracking Work?
                                            </button>
                                        </h2>
                                        <div id="accor_iconExampleCollapse2" class="accordion-collapse collapse" aria-labelledby="accordionWithIconExample2" data-bs-parent="#accordion-with-icon">
                                            <div class="accordion-body">
                                                Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionWithIconExample3">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_iconExampleCollapse3" aria-expanded="false" aria-controls="accor_iconExampleCollapse3">
                                                <i class="ri-pen-nib-line me-2"></i> How Do I Set Up the Drip Feature?
                                            </button>
                                        </h2>
                                        <div id="accor_iconExampleCollapse3" class="accordion-collapse collapse" aria-labelledby="accordionWithIconExample3" data-bs-parent="#accordion-with-icon">
                                            <div class="accordion-body">
                                                Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                                                Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis aliquam ultrices mauris.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none code-view">
                                <pre class="language-markup" style="height: 320px;">
                                    <code>
                                        &lt;!-- Accordions with Icons --&gt;
                                        &lt;div class=&quot;accordion custom-accordion-with-icon&quot; id=&quot;accordion-with-icon&quot;&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionWithIconExample1&quot;&gt;
                                                    &lt;button class=&quot;accordion-button&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_iconExampleCollapse1&quot; aria-expanded=&quot;true&quot; aria-controls=&quot;accor_iconExampleCollapse1&quot;&gt;
                                                        &lt;i class=&quot;ri-global-line&quot;&gt;&lt;/i&gt; How Does Age Verification Work?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;accor_iconExampleCollapse1&quot; class=&quot;accordion-collapse collapse show&quot; aria-labelledby=&quot;accordionWithIconExample1&quot; data-bs-parent=&quot;#accordion-with-icon&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        Increase or decrease the letter spacing depending on the situation and try, try again until it looks right,
                                                        and each assumenda labore aes Homo nostrud organic, assumenda labore aesthetic magna elements, buttons, everything.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionWithIconExample2&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_iconExampleCollapse2&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;accor_iconExampleCollapse2&quot;&gt;
                                                        &lt;i class=&quot;ri-user-location-line&quot;&gt;&lt;/i&gt; How Does Link Tracking Work?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;accor_iconExampleCollapse2&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;accordionWithIconExample2&quot; data-bs-parent=&quot;#accordion-with-icon&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                            &lt;div class=&quot;accordion-item&quot;&gt;
                                                &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionWithIconExample3&quot;&gt;
                                                    &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_iconExampleCollapse3&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;accor_iconExampleCollapse3&quot;&gt;
                                                        &lt;i class=&quot;ri-pen-nib-line&quot;&gt;&lt;/i&gt; How Do I Set Up the Drip Feature?
                                                    &lt;/button&gt;
                                                &lt;/h2&gt;
                                                &lt;div id=&quot;accor_iconExampleCollapse3&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;accordionWithIconExample3&quot; data-bs-parent=&quot;#accordion-with-icon&quot;&gt;
                                                    &lt;div class=&quot;accordion-body&quot;&gt;
                                                        Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                                        In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis aliquam ultrices mauris.
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    </code>
                                </pre>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!--end col-->

                {{-- Accordions without Icons. --}}
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Accordions without Icons</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="accordion-without-icon-show-code" class="form-label text-muted">Show Code</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="accordion-without-icon-show-code">
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <p class="text-muted">Use <code>accordion-icon-none</code> class to remove icon at accordion.</p>
                            <div class="live-preview">
                                <div class="accordion accordion-icon-none" id="accordion-without-icon">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionwithouticonExample1">
                                            <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#accor_withouticoncollapse1"
                                                    aria-expanded="true" aria-controls="accor_withouticoncollapse1">
                                                <i class="ri-global-line me-2"></i> How Does Age Verification
                                                Work?
                                            </button>
                                        </h2>
                                        <div id="accor_withouticoncollapse1"
                                             class="accordion-collapse collapse show"
                                             aria-labelledby="accordionwithouticonExample1"
                                             data-bs-parent="#accordion-without-icon">
                                            <div class="accordion-body">
                                                Each design is a new, unique piece of art birthed into this
                                                world, and while you have the opportunity to be creative and
                                                make your own style choices. For that very reason, I went on a
                                                quest and spoke to many different professional graphic
                                                designers.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionwithouticonExample2">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#accor_withouticoncollapse2"
                                                    aria-expanded="false"
                                                    aria-controls="accor_withouticoncollapse2">
                                                <i class="ri-user-location-line me-2"></i> How Does Link
                                                Tracking Work?
                                            </button>
                                        </h2>
                                        <div id="accor_withouticoncollapse2" class="accordion-collapse collapse"
                                             aria-labelledby="accordionwithouticonExample2"
                                             data-bs-parent="#accordion-without-icon">
                                            <div class="accordion-body">
                                                When, while the lovely valley teems with vapour around me, and
                                                the meridian sun strikes the upper surface of the impenetrable
                                                foliage of my trees, and but a few stray gleams steal into the
                                                inner sanctuary, I throw myself down among the tall grass by the
                                                trickling stream; and, as I lie close to the earth, a thousand
                                                unknown.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionwithouticonExample3">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#accor_withouticoncollapse3"
                                                    aria-expanded="false"
                                                    aria-controls="accor_withouticoncollapse3">
                                                <i class="ri-pen-nib-line me-2"></i> How Do I Set Up the Drip
                                                Feature?
                                            </button>
                                        </h2>
                                        <div id="accor_withouticoncollapse3" class="accordion-collapse collapse"
                                             aria-labelledby="accordionwithouticonExample3"
                                             data-bs-parent="#accordion-without-icon">
                                            <div class="accordion-body">
                                                Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante
                                                ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                                                Curae; In ac dui quis mi consectetuer lacinia. Nam pretium
                                                turpis et arcu arcu tortor, suscipit eget, imperdiet nec,
                                                imperdiet iaculis aliquam ultrices mauris.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none code-view">
                                        <pre class="language-markup" style="height: 275px;">
<code>&lt;!-- Accordions with Icons --&gt;
&lt;div class=&quot;accordion custom-accordionwithicon&quot; id=&quot;accordionWithicon&quot;&gt;
    &lt;div class=&quot;accordion-item&quot;&gt;
        &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionwithiconExample1&quot;&gt;
            &lt;button class=&quot;accordion-button&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_withouticoncollapse1&quot; aria-expanded=&quot;true&quot; aria-controls=&quot;accor_iconExamplecollapse1&quot;&gt;
                &lt;i class=&quot;ri-global-line&quot;&gt;&lt;/i&gt; How Does Age Verification Work?
            &lt;/button&gt;
        &lt;/h2&gt;
        &lt;div id=&quot;accor_iconExamplecollapse1&quot; class=&quot;accordion-collapse collapse show&quot; aria-labelledby=&quot;accordionwithiconExample1&quot; data-bs-parent=&quot;#accordionWithicon&quot;&gt;
            &lt;div class=&quot;accordion-body&quot;&gt;
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua nulla assumenda shoreditch et.
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;accordion-item&quot;&gt;
        &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionwithiconExample2&quot;&gt;
            &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_iconExamplecollapse2&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;accor_iconExamplecollapse2&quot;&gt;
                &lt;i class=&quot;ri-user-location-line&quot;&gt;&lt;/i&gt; How Does Link Tracking Work?
            &lt;/button&gt;
        &lt;/h2&gt;
        &lt;div id=&quot;accor_iconExamplecollapse2&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;accordionwithiconExample2&quot; data-bs-parent=&quot;#accordionWithicon&quot;&gt;
            &lt;div class=&quot;accordion-body&quot;&gt;
                Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;accordion-item&quot;&gt;
        &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionwithiconExample3&quot;&gt;
            &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_iconExamplecollapse3&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;accor_iconExamplecollapse3&quot;&gt;
                &lt;i class=&quot;ri-pen-nib-line&quot;&gt;&lt;/i&gt; How Do I Set Up the Drip Feature?
            &lt;/button&gt;
        &lt;/h2&gt;
        &lt;div id=&quot;accor_iconExamplecollapse3&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;accordionwithiconExample3&quot; data-bs-parent=&quot;#accordionWithicon&quot;&gt;
            &lt;div class=&quot;accordion-body&quot;&gt;
                Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis aliquam ultrices mauris.
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!--end col-->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Accordions with Plus Icon</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="withplusiconaccordion-showcode"
                                           class="form-label text-muted">Show Code</label>
                                    <input class="form-check-input code-switcher" type="checkbox"
                                           id="withplusiconaccordion-showcode">
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <p class="text-muted">Use <code>custom-accordionwithicon-plus</code> class to show
                                plus icon at the accordion.</p>
                            <div class="live-preview">
                                <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionwithplusExample1">
                                            <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#accor_plusExamplecollapse1"
                                                    aria-expanded="true" aria-controls="accor_plusExamplecollapse1">
                                                What is User Interface Design?
                                            </button>
                                        </h2>
                                        <div id="accor_plusExamplecollapse1"
                                             class="accordion-collapse collapse show"
                                             aria-labelledby="accordionwithplusExample1"
                                             data-bs-parent="#accordionWithplusicon">
                                            <div class="accordion-body">
                                                Big July earthquakes confound zany experimental vow. My girl
                                                wove six dozen plaid jackets before she quit. Six big devils
                                                from Japan quickly forgot how to waltz. try again until it looks
                                                right, and each assumenda labore aes Homo nostrud organic,
                                                assumenda labore aesthetic magna elements, buttons, everything.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionwithplusExample2">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#accor_plusExamplecollapse2"
                                                    aria-expanded="false"
                                                    aria-controls="accor_plusExamplecollapse2">
                                                What is Digital Marketing?
                                            </button>
                                        </h2>
                                        <div id="accor_plusExamplecollapse2" class="accordion-collapse collapse"
                                             aria-labelledby="accordionwithplusExample2"
                                             data-bs-parent="#accordionWithplusicon">
                                            <div class="accordion-body">
                                                It makes a statement, it’s impressive graphic design. Increase
                                                or decrease the letter spacing depending on the situation and
                                                try, try again until it looks right, and each letter has the
                                                perfect spot of its own. commodo enim craft beer mlkshk aliquip
                                                jean shorts ullamco.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionwithplusExample3">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#accor_plusExamplecollapse3"
                                                    aria-expanded="false"
                                                    aria-controls="accor_plusExamplecollapse3">
                                                Where does it come from ?
                                            </button>
                                        </h2>
                                        <div id="accor_plusExamplecollapse3" class="accordion-collapse collapse"
                                             aria-labelledby="accordionwithplusExample3"
                                             data-bs-parent="#accordionWithplusicon">
                                            <div class="accordion-body">
                                                Spacing depending on the situation and try, try again until it
                                                looks right, and each. next level wes anderson artisan four loko
                                                farm-to-table craft beer twee. commodo enim craft beer mlkshk
                                                aliquip jean shorts ullamco. omo nostrud organic, assumenda
                                                labore aesthetic magna delectus. pposites attract, and that’s a
                                                fact.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none code-view">
                                        <pre class="language-markup" style="height: 275px;">
<code>&lt;!-- Accordions with Plus Icon --&gt;
&lt;div class=&quot;accordion custom-accordionwithicon-plus&quot; id=&quot;accordionWithplusicon&quot;&gt;
    &lt;div class=&quot;accordion-item&quot;&gt;
        &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionwithplusExample1&quot;&gt;
            &lt;button class=&quot;accordion-button&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_plusExamplecollapse1&quot; aria-expanded=&quot;true&quot; aria-controls=&quot;accor_plusExamplecollapse1&quot;&gt;
                What is User Interface Design?
            &lt;/button&gt;
        &lt;/h2&gt;
        &lt;div id=&quot;accor_plusExamplecollapse1&quot; class=&quot;accordion-collapse collapse show&quot; aria-labelledby=&quot;accordionwithplusExample1&quot; data-bs-parent=&quot;#accordionWithplusicon&quot;&gt;
            &lt;div class=&quot;accordion-body&quot;&gt;
            Big July earthquakes confound zany experimental vow. My girl wove six dozen plaid jackets before she quit. Six big devils from Japan quickly forgot how to waltz. try again until it looks right, and each assumenda labore aes Homo nostrud organic, assumenda labore aesthetic magna elements, buttons, everything.
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;accordion-item&quot;&gt;
        &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionwithplusExample2&quot;&gt;
            &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_plusExamplecollapse2&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;accor_plusExamplecollapse2&quot;&gt;
                What is Digital Marketing?
            &lt;/button&gt;
        &lt;/h2&gt;
        &lt;div id=&quot;accor_plusExamplecollapse2&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;accordionwithplusExample2&quot; data-bs-parent=&quot;#accordionWithplusicon&quot;&gt;
            &lt;div class=&quot;accordion-body&quot;&gt;
            It makes a statement, it’s impressive graphic design. Increase or decrease the letter spacing depending on the situation and try, try again until it looks right, and each letter has the perfect spot of its own. commodo enim craft beer mlkshk aliquip jean shorts ullamco.
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;accordion-item&quot;&gt;
        &lt;h2 class=&quot;accordion-header&quot; id=&quot;accordionwithplusExample3&quot;&gt;
            &lt;button class=&quot;accordion-button collapsed&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#accor_plusExamplecollapse3&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;accor_plusExamplecollapse3&quot;&gt;
                Where does it come from ?
            &lt;/button&gt;
        &lt;/h2&gt;
        &lt;div id=&quot;accor_plusExamplecollapse3&quot; class=&quot;accordion-collapse collapse&quot; aria-labelledby=&quot;accordionwithplusExample3&quot; data-bs-parent=&quot;#accordionWithplusicon&quot;&gt;
            &lt;div class=&quot;accordion-body&quot;&gt;
            Spacing depending on the situation and try, try again until it looks right, and each. next level wes anderson artisan four loko farm-to-table craft beer twee. commodo enim craft beer mlkshk aliquip jean shorts ullamco. omo nostrud organic, assumenda labore aesthetic magna delectus. pposites attract, and that’s a fact.
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!--end col-->

            </div>
            <!--end row-->

        </div>
    </div>
@endsection
