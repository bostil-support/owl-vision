<template>
    <div class="w-screen h-screen flex">
        <div class="max-w-xs m-auto">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="text" class="bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 border border-transparent focus:outline-none focus:border-gray-300 focus:bg-white"
                           v-model="form.email">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" class="bg-gray-200 appearance-none rounded w-full py-2 px-3 mb-2 text-gray-700 border border-transparent focus:outline-none focus:border-gray-300 focus:bg-white"
                           v-model="form.password">
                    <p class="text-gray-500 text-xs italic">Password must be more than 8 characters</p>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            @click="login">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-900 no-underline"
                       @click.prevent href="#">
                        Forgot Password?
                    </a>
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
        axios.post(BACKEND_URL + '/login', this.form).then(response => {
          this.$router.go(0)
        }).catch(error => console.error(error))
      }
    }
  }
</script>
