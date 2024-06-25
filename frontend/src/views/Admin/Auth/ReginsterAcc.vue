<template>
    <div class="container">
      <div class="row justify-content-center">
        <div class="card" style="width: 50%">
          <div class="card-body">
            <div class="title text-center">
              <h2><b>Create an account</b></h2>
              <p>Enter your email to sign up for this app</p>
            </div>
            <div class="form-row d-flex fw-bold" style="gap: 10px">
              <div class="col">
                <div class="form-group">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" />
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" />
                </div>
              </div>
            </div>
  
            <div class="form-group fw-bold mt-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" />
            </div>
  
            <div class="form-group fw-bold mt-3">
              <label for="password" class="form-label mt-2">Password</label>
            </div>
            <div class="d-flex">
              <input type="password" class="form-control fw-bold flex-grow-1" />
              <button type="submit" class="btn btn-dark ms-3">Submit</button>
            </div>
  
            <div class="row justify-content-center mt-4">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 border-top border-dark"></div>
                <div class="text-center px-3">or continue with</div>
                <div class="flex-grow-1 border-top border-dark"></div>
              </div>
            </div>
  
            <div class="form-group d-flex align-items-center mt-3 bg-light p-2 rounded">
              <div>
                <img
                  src="https://img.icons8.com/color/48/000000/google-logo.png"
                  alt="Google Logo"
                  class="img-fluid"
                  style="width: 35px;"
                />
              </div>
              <div class="ms-3 text-center">
                <p class="mb-0">Google</p>
              </div>
            </div>
  
            <p class="mt-3 text-center">
              By clicking continue, you agree to our <b>Terms of Service</b> and
              <b>Privacy</b><br /><b>Policy.</b>
            </p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "RegisterAccVue",
  };
  </script>