import { environment } from '../env/env.js';

export let cardDetailsErrorMessages = {};
export let cardElementIsDirty = {};

export const cardNumberElem = document.getElementById("cardNumber");
const cardCvcElem = document.getElementById("cardCvc");
const cardCardExpiryElem = document.getElementById("cardExpiry");


function createCardElements() {

    const elementStyles = {
        fontSize: '1.14285714rem',
        color: '#2e384d',
        fontWeight: 400,
        // tslint:disable-next-line:max-line-length
        fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif',
        '::placeholder': {
            color: '#7A869A',
        }
    };

    const cardNumber = elementsInstance.create('cardNumber', {
        classes: {
            base: 'form-input',
            focus: 'input-focus'
        },
        style: {
            base: elementStyles
        }
    });
    const cardExpiry = elementsInstance.create('cardExpiry', {
        classes: {
            base: 'form-input',
            focus: 'input-focus'
        },
        style: {
            base: elementStyles
        }
    });
    const cardCvc = elementsInstance.create('cardCvc', {
        classes: {
            base: 'form-input',
            focus: 'input-focus'
        },
        style: {
            base: elementStyles
        }
    });

    cardNumber.addEventListener('change', ({ error, empty }) => {
        cardElementIsDirty[cardNumberElem.id] = empty ? false : true;
        cardDetailsErrorMessages[cardNumberElem.id] = error && error.message;

        if (cardDetailsErrorMessages[cardNumberElem.id]) {
            cardNumberElem.parentElement.querySelector('.form-input-hint').innerText = cardDetailsErrorMessages[cardNumberElem.id];
            cardNumberElem.parentElement.querySelector('.form-input-hint').style.display = 'block';
            cardNumberElem.classList.add('is-error');
        } else {
            cardNumberElem.parentElement.querySelector('.form-input-hint').innerText = '';
            cardNumberElem.parentElement.querySelector('.form-input-hint').style.display = 'none';
            cardNumberElem.classList.remove('is-error');
        }
    });

    cardCvc.addEventListener('change', ({ error, empty }) => {
        cardElementIsDirty[cardCvcElem.id] = empty ? false : true;
        cardDetailsErrorMessages[cardCvcElem.id] = error && error.message;
        // cardDetailsErrorMessages[cardNumberElem.id] = undefined;
        // cardNumberElem.parentElement.querySelector('.form-input-hint').innerText = '';
        // cardNumberElem.parentElement.querySelector('.form-input-hint').style.display = 'none';

        if (cardDetailsErrorMessages[cardCvcElem.id]) {
            cardCvcElem.parentElement.querySelector('.form-input-hint').innerText = cardDetailsErrorMessages[cardCvcElem.id];
            cardCvcElem.parentElement.querySelector('.form-input-hint').style.display = 'block';
            cardCvcElem.classList.add('is-error');
        } else {
            cardCvcElem.parentElement.querySelector('.form-input-hint').innerText = '';
            cardCvcElem.parentElement.querySelector('.form-input-hint').style.display = 'none';
            cardCvcElem.classList.remove('is-error');
        }
    });

    cardExpiry.addEventListener('change', ({ error, empty }) => {
        cardElementIsDirty[cardCardExpiryElem.id] = empty ? false : true;
        cardDetailsErrorMessages[cardCardExpiryElem.id] = error && error.message;

        if (cardDetailsErrorMessages[cardCardExpiryElem.id]) {
            cardCardExpiryElem.parentElement.querySelector('.form-input-hint').innerText = cardDetailsErrorMessages[cardCardExpiryElem.id];
            cardCardExpiryElem.parentElement.querySelector('.form-input-hint').style.display = 'block';
            cardCardExpiryElem.classList.add('is-error');
        } else {
            cardCardExpiryElem.parentElement.querySelector('.form-input-hint').innerText = '';
            cardCardExpiryElem.parentElement.querySelector('.form-input-hint').style.display = 'none';
            cardCardExpiryElem.classList.remove('is-error');
        }
    });

    cardNumber.addEventListener('ready', () => {
        cardElementIsDirty[cardNumberElem.id] = false;
    });
    cardCvc.addEventListener('ready', () => {
        cardElementIsDirty[cardCvcElem.id] = false;
    });
    cardExpiry.addEventListener('ready', () => {
        cardElementIsDirty[cardCardExpiryElem.id] = false;
    });


    cardNumber.mount(cardNumberElem);
    cardExpiry.mount(cardCardExpiryElem);
    cardCvc.mount(cardCvcElem);
}

// window.stripe = Stripe(environment.stripePublishKey);
// export const elementsInstance = window.stripe.elements();

// createCardElements();