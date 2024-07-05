<template>
    <div class="payment-form">
            <div class="card payment-details">
                <div class="card-header">
                    <h5>Livelab Dev <span class="badge badge-warning">TEST MODE</span></h5>
                    <p class="mt-2 mb-0 font-weight-bold">Asus Vivobook 17 Laptop - Intel Core 10th</p>
                    <h2 class="mt-1">$6.00</h2>
                    <div class="stripe-logo mt-5">
                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/8/88/Stripe_logo%2C_revised_2016.png" alt="stripe"> -->
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png" alt="visa">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="mastercard">
                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Maestro_2016.svg/1200px-Maestro_2016.svg.png" alt="maestro"> -->
                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/American_Express_logo_%282018%29.svg/1200px-American_Express_logo_%282018%29.svg.png" alt="american express"> -->
                    </div>
                </div>
            </div>
            <div class="card payment-details">
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        <div class="form-group">
                            <label for="email">Contact information</label>
                            <input type="email" class="form-control" id="email" v-model="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">Payment method</label>
                            <div class="payment-method">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="card" name="paymentMethod" class="custom-control-input" v-model="paymentMethod" value="card">
                                    <label class="custom-control-label" for="card">Card</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="cashAppPay" name="paymentMethod" class="custom-control-input" v-model="paymentMethod" value="cashAppPay">
                                    <label class="custom-control-label" for="cashAppPay">Cash App Pay</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total">Amount</label>
                            <input type="total" class="form-control" id="total" v-model="total" placeholder="total">
                        </div>
                        <div v-if="paymentMethod === 'card'">
                            <div class="form-group">
                                <label for="cardInfo">Card information</label>
                                <input type="text" class="form-control" id="cardNumber" v-model="cardNumber" placeholder="1234 1234 1234 1234">
                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="cardExpiry" v-model="cardExpiry" placeholder="MM / YY">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="cardCvc" v-model="cardCvc" placeholder="CVC">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="saveInfo" v-model="saveInfo">
                            <label class="form-check-label" for="saveInfo">Securely save my information for 1-click checkout</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">Pay</button>
                    </form>
                    <div class="powered-by">
                        <p class="text-muted">Powered by <strong>stripe</strong></p>
                        <p><a href="#">Terms</a> | <a href="#">Privacy</a></p>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
            email: '',
            paymentMethod: 'card',
            cardNumber: '',
            cardExpiry: '',
            cardCvc: '',
            nameOnCard: '',
            country: 'Philippines',
            saveInfo: false
        };
    },
    methods: {
        submitForm() {
            alert('Form submitted!');
           
        }
    }, 
}
</script>

<style scoped>
    .payment-form {
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .payment-details {
            width: 48%;
        }
        .payment-form .card {
            padding: 20px;
        }
        .payment-form .card .card-header {
            background: none;
            border: none;
            padding: 0;
        }
        .payment-form .form-group label {
            font-weight: bold;
        }
        .payment-form .form-control {
            margin-bottom: 10px;
        }
        .payment-form .btn-primary {
            width: 100%;
        }
        .payment-method {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .payment-method .custom-control {
            margin-right: 10px;
        }
        .powered-by {
            text-align: center;
            margin-top: 20px;
        }
        .stripe-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .stripe-logo img {
            max-width: 100px;
            margin: 0 5px;
        }
</style>