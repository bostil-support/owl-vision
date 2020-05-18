<template>
    <div class="flex w-full" :class="{'sidemenu-showed': displaySidebarMenu}">
        <div class="w-full h-full fixed max-w-xs bg-gray-700 side">
            <div class="text-white text-center text-2xl uppercase" style="line-height: 60px;">Owl Vision</div>
            <el-menu
                    background-color="#4a5568"
                    text-color="#fff"
                    class="el-menu-vertical-demo">
                <el-menu-item index="1">
                    <i class="el-icon-menu"></i>
                    <router-link :to="{name: 'admin.dashboard'}">
                        <span>Dashboard</span>
                    </router-link>
                </el-menu-item>
                <el-submenu index="2">
                    <template slot="title">
                        <i class="el-icon-location"></i>
                        <span slot="title">Catalog</span>
                    </template>
                    <el-menu-item-group>
                        <span slot="title">Category</span>
                        <router-link :to="{name: 'admin.catalog.categories.list'}">
                            <el-menu-item index="2-1">Categories</el-menu-item>
                        </router-link>
                    </el-menu-item-group>
                    <el-menu-item-group title="Product">
                        <router-link :to="{name: 'admin.catalog.products.list'}">
                            <el-menu-item index="2-2">Products</el-menu-item>
                        </router-link>
                    </el-menu-item-group>
                </el-submenu>
                <el-menu-item index="3">
                    <i class="el-icon-menu"></i>
                    <span slot="title">Navigator Two</span>
                </el-menu-item>
                <el-menu-item index="4" disabled>
                    <i class="el-icon-document"></i>
                    <span slot="title">Navigator Three</span>
                </el-menu-item>
                <el-menu-item index="5">
                    <i class="el-icon-setting"></i>
                    <span slot="title">Navigator Four</span>
                </el-menu-item>
            </el-menu>
        </div>
        <div class="w-full flex flex-col content">
            <div class="flex bg-gray-700">
                <div class="flex items-center px-4" title="Toggle menu">
                    <i class="el-icon-s-operation text-3xl cursor-pointer"
                       @click="displaySidebarMenu = !displaySidebarMenu"></i>
                </div>
                <div class="flex-1">
                    <el-menu
                            class="pl-3"
                            mode="horizontal"
                            background-color="#4a5568"
                            text-color="#fff"
                            active-text-color="#ffd04b">
                        <el-menu-item index="1">
                            <router-link :to="{name: 'admin.dashboard'}">
                                <span>Dashboard</span>
                            </router-link>
                        </el-menu-item>
                        <el-submenu index="2">
                            <template slot="title">Add new</template>

                            <router-link :to="{name: 'admin.catalog.categories.add'}">
                                <el-menu-item index="2-1">
                                    <span>Category</span>
                                </el-menu-item>
                            </router-link>
                            <router-link :to="{name: 'admin.catalog.products.add'}">
                                <el-menu-item index="2-2">
                                    <span>Product</span>
                                </el-menu-item>
                            </router-link>
                        </el-submenu>
                        <el-menu-item index="3" disabled>Info</el-menu-item>
                        <el-menu-item index="4"><a href="https://www.ele.me" target="_blank">Orders</a></el-menu-item>
                    </el-menu>
                </div>
                <div class="flex">
                    <div class="flex items-center px-4 text-white">{{ user.name }}</div>
                    <div class="flex items-center px-4 cursor-pointer" title="Logout" @click.prevent="logout"><i
                            class="el-icon-switch-button"></i></div>
                </div>
            </div>
            <main class="p-4">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import Logo from '../components/Logo'

  export default {
    components: {
      Logo
    },
    data () {
      return {
        displaySidebarMenu: true
      }
    },
    methods: {
      logout () {
        axios.post(BACKEND_URL + '/logout', this.form)
          .then(response => this.$router.go(0))
          .catch(error => console.error(error))
      }
    },
    computed: {
      ...mapGetters({
        user: 'auth/user'
      })
    },
    mounted () {
      this.toggle = document.getElementsByClassName('toggle')[0]
      this.panel = document.getElementsByClassName('panel')[0]
      $('.hamburger').click(function () {
        $(this).toggleClass('is-active')
      })
    }
  }
</script>

<style scoped>
    * {
        user-select: none;
    }


    .el-menu {
        border: 0;
    }


    i {
        color: white;
    }


    .side, .content {
        margin-left: 0;
        transition: 300ms ease margin-left, 300ms ease width;
    }

    .side {
        margin-left: -320px;
    }

    .sidemenu-showed > .side {
        margin: 0;
    }

    .sidemenu-showed > .content {
        margin-left: 320px;
        width: calc(100% - 320px);
    }
</style>
