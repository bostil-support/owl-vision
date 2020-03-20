<template>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <router-link :to="{name: 'admin.dashboard'}" class="list-group-item list-group-item-action bg-light">
                    Dashboard
                </router-link>
                <router-link :to="{name: 'admin.catalog'}" class="list-group-item list-group-item-action bg-light">
                    Catalog
                </router-link>
                <router-link :to="{name: 'admin.customers'}" class="list-group-item list-group-item-action bg-light">
                    Customers
                </router-link>
                <router-link :to="{name: 'admin.configuration'}"
                             class="list-group-item list-group-item-action bg-light">Configuration
                </router-link>
                <router-link :to="{name: 'admin.system'}" class="list-group-item list-group-item-action bg-light">
                    System
                </router-link>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom d-block">
                <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
                <div class="float-right">
                    <div class="d-flex align-items-center">
                        <div v-if="user" class="col-auto">You are logged in as: {{ user.name }}</div>
                        <button @click="logout" class="btn btn-danger">Logout</button>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <router-view/>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

  export default {
    methods: {
      logout () {
        axios.post('auth/logout', this.form)
          .then(response => this.$router.go(0))
          .catch(error => console.error(error))
      },
    },
    computed: {
      ...mapGetters({
        user: 'auth/user'
      })
    },
    mounted () {
      $('#menu-toggle').click(function (e) {
        e.preventDefault()
        $('#wrapper').toggleClass('toggled')
      })
    }
  }
</script>
