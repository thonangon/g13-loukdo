<template>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <div class="leftSide" style="width: 48%;">
                <div class="d-flex align-items-center" style="height: 60px;">
                    <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
                    <p class="mb-0">Username>Owner>clothe</p>
                </div>
                <div class="proImageSlide">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner mt-5" style="height: 500px;">
                            <div class="carousel-item active">
                                <img src="../../assets/images/Group 52.png" class="d-block w-100" style="height: 100%;" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../../assets/images/Group 52.png" class="d-block w-100" style="height: 100%;" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../../assets/images/Group 52.png" class="d-block w-100" style="height: 100%;" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- _______________________________________________PPPPPPP_______________________________________________ -->
            <div class="rightSide p-3" style="width: 48%;">
                <form>
                    <div class="title">
                        <h1>Terra Cotta Studio Top</h1>
                        <h3>$2222-$444</h3>
                    </div>
                    <div class="description">
                        <h2>DESCRIPTION</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum est porro, alias facilis earum nulla nihil ab, vero, impedit optio illum cumque magni unde nisi. Alias praesentium, cupiditate eius tenetur dolor deserunt nam dicta mollitia iusto, aspernatur nemo? Facere molestiae neque asperiores! Quos porro in corrupti explicabo at sapiente quo?</p>
                    </div>
                    <div class="detail">
                        <h2>DETAIL</h2>
                        <ul>
                            <li class="d-flex">
                                <p>Color:</p>
                                <p>Black</p>
                            </li>
                            <li class="d-flex">
                                <p>Size:</p>
                                <p>S</p>
                            </li>
                            <li class="d-flex">
                                <p>Material:</p>
                                <p>Cotton</p>
                            </li>
                        </ul>
                    </div>
                    <div class="quantity">
                        <h2>QUANTITY</h2>
                        <input type="number" value="1" class="p-4">
                    </div>
                    <div class="action d-flex justify-content-between mt-5">
                        <button type="button" class="btn btn-secondary" style="width: 280px; height: 52px;">Add to Cart</button>
                        <button type="button" class="btn btn-dark" style="width: 280px; height: 52px;">Buy Now</button>
                    </div>
                </form>
            </div>   
        </div>
        <!-- ______________________________________________PPPPPPPPPPPPP_________________________________ -->
        <p class="p-2 border-bottom" style="width: 100%;">Ratings and Fatback this product!</p>
        <!-- _____________________________________PPPPPPPPPPPPPPP___________________________________ -->
         <div class="RateAndFeadback d-flex">
            <div class="feadback" style="width: 70%;">
                <div class="score" style="height: 200PX;">
                    <div class="rate d-flex">
                        <h1>4.5</h1><h4>/9</h4>
                    </div>
                    <div class="star d-flex">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                        <img src="../../assets/images/star.png" alt="">
                    </div>
                    <p>5000 score</p>
                </div>
                <div class="rateObtion d-flex justify-content-end border-top border-bottom">
                    <div class="feadback d-flex">
                        <button type="button" class="btn btn-outline-none border-start" data-bs-toggle="modal" data-bs-target="#feadback" data-bs-whatever="@fat">Feadback</button>

                        <div class="modal fade" id="feadback" tabindex="-1" aria-labelledby="feadbackLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="feadbackLabel">Feadback for this product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Photo:</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Send</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="star d-flex ">
                        <button class="btn btn-outline-none border-start dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="../../assets/images/star.png" alt="">Rate</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">5 Star</a></li>
                            <li><a class="dropdown-item" href="#">4 Star</a></li>
                            <li><a class="dropdown-item" href="#">3 Star</a></li>
                            <li><a class="dropdown-item" href="#">2 Star</a></li>
                             <li><a class="dropdown-item" href="#">1 Star</a></li>
                        </ul>
                    </div>
                </div>
                <!-- _________________________________________________________Show feadback______________________________________ -->
                 <div class="feadback">
                    <div class="">
                        <div class="d-flex align-items-center" style="height: 60px;">
                            <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="d-flex flex-column">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, quidem.</p>
                            <p class="d-flex">
                                <img src="../../assets/images/Group 52.png" alt="" style="width: 243px; height: 240px;">
                            </p>
                        </div>
                        <div class="user-actions">
                            <button class="btn btn-primary btn-custom">Like</button>
                            <button class="btn btn-secondary">Reply</button>
                        </div>
                    </div>
                 </div>

            </div>
            <!-- ________________________________________PPPPPPPPPPPPPPPPPPPPPPP_____________________________________ -->
            <div class="cardPro border-start d-flex flex-column align-items-end" style="width: 30%;">
                <div class="card card-custom">
                    <img src="../../assets/images/Group 52.png" class="card-img-top" alt="Product Image" style="width: 300px; height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">$99.99</p>
                        <div class="star-rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9734;</span>
                        </div>
                    </div>
                </div>
                <div class="card card-custom">
                    <img src="../../assets/images/Group 52.png" class="card-img-top" alt="Product Image" style="width: 300px; height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">$99.99</p>
                        <div class="star-rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9734;</span>
                        </div>
                    </div>
                </div>
                
            </div>
         </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>