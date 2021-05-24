<template>
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6">
            <div class="card mb-4 mx-4">
              <div class="card-body p-4">
                <h1>Register</h1>
                <p class="text-medium-emphasis">Create your account</p>
                <div class="row">
                    <div class="col-md">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input class="form-control" type="text" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input class="form-control" type="text" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                    <input class="form-control" type="password" placeholder="Password">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                    <input class="form-control" type="password" placeholder="Repeat password">
                </div>
                <button class="btn btn-block btn-success" type="button">Create Account</button>
              </div>
            </div>
          </div>
        </div>
</template>
<script>
export default {
    
}
</script>
<style scoped>
</style>