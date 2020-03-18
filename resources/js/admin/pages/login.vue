<template>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" v-model="form.email"
                                           required="required" autocomplete="off"
                                           autofocus="autofocus" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" v-model="form.password" required="required"
                                           autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="remember" v-model="form.remember_me" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button @click="login" type="button" class="btn btn-primary">Login</button>
                                    <a @click.prevent href="#" class="btn btn-link">Forgot Your Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        form: {
          email: '',
          password: '',
          remember_me: false
        }
      }
    },
    methods: {
      login () {
        axios.get(BACKEND_URL+'/airlock/csrf-cookie').then(response => {
          axios.post('auth/login', this.form).then(response => {
            this.$router.go(0)
          }).catch(error => console.error(error))
        }).catch(error => console.error(error))
      }
    }
  }
</script>
