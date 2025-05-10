import Masonry from 'masonry-layout';
import ImagesLoaded from 'imagesloaded';

(function () {
    'use strict';

    /* Add spin loader for card (data-toggle="reload"). */
    const cardSpinLoader = document.querySelector('.card a[data-toggle="reload"]');
    if (cardSpinLoader) {
        cardSpinLoader.addEventListener('click', (e) => {
            e.preventDefault();
            let card = cardSpinLoader.closest('.card');
            const insertEl =
                `<div class="card-preloader">
                    <div class="card-status">
                        <div class="spinner-border text-success">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>`;
            card.children[1].insertAdjacentHTML('beforeend', insertEl);

            let cardPreloader = card.getElementsByClassName('card-preloader')[0];
            setTimeout(() => cardPreloader.remove(), 500 + 300 * (Math.random() * 5));
        });
    }

    /* Add spin loader for card (data-toggle="growing-reload"). */
    const cardGrowingLoader = document.querySelector('.card a[data-toggle="growing-reload"]');
    if (cardGrowingLoader) {
        cardGrowingLoader.addEventListener('click', (e) => {
            e.preventDefault();
            let card = cardGrowingLoader.closest('.card');
            const insertEl =
                `<div class="card-preloader">
                    <div class="card-status">
                        <div class="spinner-grow text-danger">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>`;
            card.children[1].insertAdjacentHTML('beforeend', insertEl);

            let cardPreloader = card.getElementsByClassName('card-preloader')[0];
            setTimeout(() => cardPreloader.remove(), 500 + 300 * (Math.random() * 5));
        });
    }

    /* Add spin loader for card (data-toggle="customer-loader"). */
    const cardCustomerLoader = document.querySelector('.card a[data-toggle="customer-loader"]');
    if (cardCustomerLoader) {
        cardCustomerLoader.addEventListener('click', (e) => {
            e.preventDefault();
            let card = cardCustomerLoader.closest('.card');
            const insertEl =
                `<div class="card-preloader">
                    <div class="card-status">
                        <img src="../build/images/logo-sm.png" alt="" class="img-fluid custom-loader">
                    </div>
                </div>`;
            card.children[1].insertAdjacentHTML('beforeend', insertEl);

            let cardPreloader = card.getElementsByClassName('card-preloader')[0];
            setTimeout(() => cardPreloader.remove(), 500 + 300 * (Math.random() * 5));
        });
    }

    /* Card Remove */
    const closeCardNone1 = document.getElementById('close-card-none1');
    const closeCardNone2 = document.getElementById('close-card-none2');
    const closeCardNone3 = document.getElementById('close-card-none3');

    closeCardNone1 && closeCardNone1.addEventListener('click', () => {
        const cardNone1 = document.getElementById('card-none1');
        cardNone1 && cardNone1.remove();
    });
    closeCardNone2 && closeCardNone2.addEventListener('click', () => {
        const cardNone2 = document.getElementById('card-none2');
        cardNone2 && cardNone2.remove();
    });
    closeCardNone3 && closeCardNone3.addEventListener('click', () => {
        const cardNone3 = document.getElementById('card-none3');
        cardNone3 && cardNone3.remove();
    });

    /* Init Cards Masonry. */
    const groupCardMasonry = document.getElementById('group-card-masonry');
    if (groupCardMasonry) {
        ImagesLoaded(groupCardMasonry, () => {
            new Masonry(groupCardMasonry, {
                percentPosition: true
            });
        });
    }
})();


