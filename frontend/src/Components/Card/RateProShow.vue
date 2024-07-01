<template>
  <div>
    <div class="score" style="height: 200px;">
      <div class="rate d-flex">
        <h1>4.5</h1>
        <h4>/9</h4>
      </div>
      <div class="star d-flex">
        <img src="../../assets/images/star.png" alt="star">
        <img src="../../assets/images/star.png" alt="star">
        <img src="../../assets/images/star.png" alt="star">
        <img src="../../assets/images/star.png" alt="star">
        <img src="../../assets/images/star.png" alt="star">
      </div>
      <p>5000 score</p>
    </div>
    <div class="rateOption d-flex justify-content-end border-top border-bottom">
      <div class="feedback d-flex">
        <button type="button" class="btn btn-outline-none border-start" data-bs-toggle="modal" data-bs-target="#feedback" data-bs-whatever="@fat">Feedback</button>

        <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="feedbackLabel">Feedback for this product</h5>
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
                    <textarea class="form-control" id="message-text" v-model="message"></textarea>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="sendFeedback">Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="star d-flex">
      <button class="btn btn-outline-none border-start dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../../assets/images/star.png" alt="star"> Rate
      </button>
      <ul class="dropdown-menu">
        <li><button class="dropdown-item" @click="selectedRating = 5">5 Star</button></li>
        <li><button class="dropdown-item" @click="selectedRating = 4">4 Star</button></li>
        <li><button class="dropdown-item" @click="selectedRating = 3">3 Star</button></li>
        <li><button class="dropdown-item" @click="selectedRating = 2">2 Star</button></li>
        <li><button class="dropdown-item" @click="selectedRating = 1">1 Star</button></li>
      </ul>
    </div>
  <div>
    You selected: {{ selectedRating }} star(s)
  </div>
    </div>
  </div>
</template>

<script>
export default {
data(){
    return {
        selectedRating: null
    }
}
};
</script>

<style>
</style>
