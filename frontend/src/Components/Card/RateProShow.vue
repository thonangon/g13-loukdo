<template>
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
                        <textarea class="form-control" id="message-text" v-model="messagees"></textarea>
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
</template>

<script>
export default {

}
</script>

<style>

</style>