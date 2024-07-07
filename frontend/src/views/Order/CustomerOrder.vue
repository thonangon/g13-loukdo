<template>
  <div class="container">
    <h2 class="my-4">Welcome, Loukdo!</h2>
    <h4>Current orders</h4>
    <div class="order-card row">
      <div class="col-md-2">
        <!-- <img :src="order.productImageUrl" alt="Product Image"> -->
      </div>
      <div class="col-md-7">
        <div class="order-info">
          <div>
            <p><strong>Order..</strong> {{ order.username }}</p>
          </div>
        </div>
        <div class="order-details">
          <div class="row">
            <div class="col-md-3">
              <p><strong>Product Name</strong></p>
              <p>{{ order.orderDate }}</p>
            </div>
            <div class="col-md-3">
              <p><strong>Price</strong></p>
              <p>{{ order.paymentStatus }}</p>
            </div>
            <div class="col-md-3">
              <p><strong>Quatity</strong></p>
              <p>{{ order.deliveryDate }}</p>
            </div>
            <div class="col-md-3">
              <p><strong>Total Price</strong></p>
              <p>{{ order.deliveryDate }}</p>
            </div>
           
          </div>
        </div>
        <div class="order-details">
          <div class="row">
            <div class="col-md-3">
              <button class="btn btn-danger">Cancel</button>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary">Edit Order</button>
            </div>
            <div class="col-md-3">
              <a href="/payment">
                <button class="btn btn-success">Payment</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'OrderDashboard',
  data() {
    return {
      order: {
        id: 1,
        username: 'username',
        delivery: 'JNT > Delivery_name > contact',
        orderDate: 'June-18-24',
        paymentStatus: 'Initials payment done',
        deliveryDate: 'June-18-24 2PM',
        shoppingLink: '#',
        totalsSum: '$000',
        depositPaymentRecode: '$000',
        trackingLink: '#',
        productImageUrl: 'product-image-url.jpg'
      }
    };
  },
  methods: {
    editOrder(orderId) {
      console.log('Edit order', orderId);
    },
    viewDetails(orderId) {
      console.log('View details for order', orderId);
    }
  }
};
</script>

<style scoped>
.order-card {
  border: 1px solid #e1e1e1;
  border-radius: 5px;
  margin: 20px 0;
  padding: 20px;
  background-color: #fff;
}
.order-card img {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
}
.order-info {
  display: flex;
  justify-content: space-between;
}
.order-details {
  margin-top: 10px;
}
.btn-edit, .btn-details {
  background-color: black;
  color: white;
}
.btn-edit:hover, .btn-details:hover {
  background-color: #444;
}
</style>
