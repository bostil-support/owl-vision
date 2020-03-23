<template>
    <div class="app-inner">
        <aside class="panel">
            <logo/>
            <ul class="list">
                <li>
                    <i class="fas fa-desktop"></i>
                    <span>
                        <router-link :to="{name: 'admin.dashboard'}">Dashboard</router-link>
                    </span>
                </li>
                <div class="item-container">
                    <li @click="(e) => showItems(e,'catalog')" @mouseover="(e) => show(e,'catalog')">
                        <i class="fas fa-book"></i>
                        <span class="item">Catalog <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu catalog" @mouseleave="hide('catalog')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Products</li>
                        <li>
                            <i class="far fa-dot-circle"></i>
                            <router-link :to="{name: 'admin.catalog'}">Categories</router-link>
                        </li>
                        <li><i class="far fa-dot-circle"></i> Manufacturers</li>
                        <li><i class="far fa-dot-circle"></i> Product reviews</li>
                        <li><i class="far fa-dot-circle"></i> Product tags</li>
                        <li><i class="far fa-dot-circle"></i> Attributes</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'sales')" @mouseover="(e) => show(e, 'sales')">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="item">Sales <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu sales" @mouseleave="hide('sales')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Orders</li>
                        <li><i class="far fa-dot-circle"></i> Shipments</li>
                        <li><i class="far fa-dot-circle"></i> Return requests</li>
                        <li><i class="far fa-dot-circle"></i> Recurring payments</li>
                        <li><i class="far fa-dot-circle"></i> Gift cards</li>
                        <li><i class="far fa-dot-circle"></i>Shopping carts and wishlists</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'customers')" @mouseover="(e) => show(e, 'customers')">
                        <i class="fas fa-user"></i>
                        <span class="item">Customers <i class="fas fa-angle-left"></i></span>
                    </li>

                    <ul class="item-menu customers" @mouseleave="hide('customers')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Customers</li>
                        <li><i class="far fa-dot-circle"></i> Customer roles</li>
                        <li><i class="far fa-dot-circle"></i> Online customers</li>
                        <li><i class="far fa-dot-circle"></i> Vendors</li>
                        <li><i class="far fa-dot-circle"></i> Activity log</li>
                        <li><i class="far fa-dot-circle"></i> Activity Types</li>
                        <li><i class="far fa-dot-circle"></i> GDPR requests (log)</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'promotions')" @mouseover="(e) => show(e, 'promotions')">
                        <i class="fas fa-tags"></i>
                        <span class="item">Promotions <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu promotions" @mouseleave="hide('promotions')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Discounts</li>
                        <li><i class="far fa-dot-circle"></i> Affiliates</li>
                        <li><i class="far fa-dot-circle"></i> Newsletter subscribers</li>
                        <li><i class="far fa-dot-circle"></i> Campaigns</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'content')" @mouseover="(e) => show(e, 'content')">
                        <i class="fas fa-cubes"></i>
                        <span class="item">Content management <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu content" @mouseleave="hide('content')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Topics (pages)</li>
                        <li><i class="far fa-dot-circle"></i> Message templates</li>
                        <li><i class="far fa-dot-circle"></i> News items</li>
                        <li><i class="far fa-dot-circle"></i> News comments</li>
                        <li><i class="far fa-dot-circle"></i> Blog posts</li>
                        <li><i class="far fa-dot-circle"></i> Blog comments</li>
                        <li><i class="far fa-dot-circle"></i> Polls</li>
                        <li><i class="far fa-dot-circle"></i> Forums</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'configuration')" @mouseover="(e) => show(e, 'configuration')">
                        <i class="fas fa-cogs"></i>
                        <span class="item">
                        Configuration
                        <i class="fas fa-angle-left"></i>
                    </span>
                    </li>
                    <ul class="item-menu configuration" @mouseleave="hide('configuration')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Settings</li>
                        <li><i class="far fa-dot-circle"></i> Email accounts</li>
                        <li><i class="far fa-dot-circle"></i> Stores</li>
                        <li><i class="far fa-dot-circle"></i> Countries</li>
                        <li><i class="far fa-dot-circle"></i> Languages</li>
                        <li><i class="far fa-dot-circle"></i> Currencies</li>
                        <li><i class="far fa-dot-circle"></i> Payment restrictions</li>
                        <li><i class="far fa-dot-circle"></i> Tax providers</li>
                        <li><i class="far fa-dot-circle"></i> Tax categories</li>
                        <li><i class="far fa-dot-circle"></i> Shipping</li>
                        <li><i class="far fa-dot-circle"></i> Access control list</li>
                        <li><i class="far fa-dot-circle"></i> Widgets</li>
                        <li><i class="far fa-dot-circle"></i> External authentication</li>
                        <li><i class="far fa-dot-circle"></i> Local plugins</li>
                        <li><i class="far fa-dot-circle"></i> All plugins and themes</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'system')" @mouseover="(e) => show(e, 'system')">
                        <i class="fas fa-cube"></i>
                        <span class="item">System <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu system" @mouseleave="hide('system')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> System configuration</li>
                        <li><i class="far fa-dot-circle"></i> Log</li>
                        <li><i class="far fa-dot-circle"></i> Warnings</li>
                        <li><i class="far fa-dot-circle"></i> Maintenance</li>
                        <li><i class="far fa-dot-circle"></i> Message queue</li>
                        <li><i class="far fa-dot-circle"></i> Schedule tasks</li>
                        <li><i class="far fa-dot-circle"></i> Search engine friendly page names</li>
                        <li><i class="far fa-dot-circle"></i> Templates</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'reports')" @mouseover="(e) => show(e, 'reports')">
                        <i class="fas fa-chart-line"></i>
                        <span class="item">Reports <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu reports" @mouseleave="hide('reports')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Low stock</li>
                        <li><i class="far fa-dot-circle"></i> Bestsellers</li>
                        <li><i class="far fa-dot-circle"></i> Products never purchased</li>
                        <li><i class="far fa-dot-circle"></i> Country sales</li>
                        <li><i class="far fa-dot-circle"></i> Customer reports</li>
                    </ul>
                </div>
                <div class="item-container">
                    <li @click="(e) => showItems(e, 'help')" @mouseover="(e) => show(e, 'help')">
                        <i class="fas fa-question-circle"></i>
                        <span class="item">Help <i class="fas fa-angle-left"></i></span>
                    </li>
                    <ul class="item-menu help" @mouseleave="hide('help')">
                        <li class="header"></li>
                        <li><i class="far fa-dot-circle"></i> Help topics</li>
                        <li><i class="far fa-dot-circle"></i> Community forums</li>
                        <li><i class="far fa-dot-circle"></i> Premium support services</li>
                    </ul>
                </div>
            </ul>
        </aside>
        <div class="section">
            <header class="header">
                <button class="toggle" @click="toggle1">
                    <i class="fas fa-bars" style="font-size:15px;color:white;"></i>
                </button>
                <a v-if="$store.getters['auth/user']" href="#" class="name">{{ user.name }}</a>
                <a @click.prevent="logout" href="#">Logout</a>
                <button class="toggle settings">
                    <i class="fas fa-cogs" style="font-size:15px;color:white;"></i>
                    <span class="setting-down">
                    <div>settings</div>
                    <div>about</div>
                </span>
                </button>
            </header>
            <router-view/>
        </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import logo from '../components/logo'

  export default {
    components: {
      logo
    },
    data () {
      return {
        toggle: null,
        panel: null,
        prevElement: null,
        currentElement: null,
      }
    },
    methods: {
      toggle1 () {
        let elements = document.querySelectorAll('ul.list li span')
        let largeImage = document.getElementsByClassName('large')[0]
        let minImage = document.getElementsByClassName('mini')[0]
        let items = document.querySelectorAll('.list li')

        for (let i = 0; i < elements.length; i++) {
          let subItems = document.getElementsByClassName('item-menu')

          if (elements[i].style.display === 'none') {
            setTimeout(() => elements[i].style.display = 'flex', 250)
            for (let i = 0; i < subItems.length; i++) {
              subItems[i].classList.remove('hover')
              subItems[i].style.display = 'none'
            }
          } else {
            setTimeout(() => elements[i].style.display = 'none', 100)
            for (let i = 0; i < subItems.length; i++) {
              subItems[i].style.display = 'none'
            }
            for (let j = 0; j < items.length; j++) {
              items[j].classList.remove('show')
            }
          }
        }
        if (this.panel.classList.contains('turnOn')) {
          minImage.style.display = 'none'
          largeImage.style.display = 'block'
        } else {
          minImage.style.display = 'block'
          largeImage.style.display = 'none'
        }
        return this.panel.classList.toggle('turnOn')
      },
      showItems (event, type) {
        let element = event.currentTarget
        if (!this.panel.classList.contains('turnOn')) {
          let elementMenu = document.getElementsByClassName(type)[0]

          if (!element.classList.contains('show')) {
            element.classList.add('show')
            elementMenu.style.display = 'block'
            document.querySelector(`.${type} .header`).textContent = ''
            document.querySelector(`.${type} .header`).style.padding = '0'
          } else {
            element.classList.remove('show')
            elementMenu.style.display = 'none'
            document.querySelector(`.${type} .header`).style.padding = '5px 15px'
          }
        }
      },
      show (event, type) {
        if (this.panel.classList.contains('turnOn')) {
          let context = event.currentTarget.textContent.trim()
          this.currentElement = document.getElementsByClassName(type)[0]
          if (!this.prevElement) {
            this.prevElement = this.currentElement
          } else {
            this.prevElement.style.display = 'none'
            this.prevElement.classList.remove('hover')
            this.currentElement.style.display = 'block'
            this.currentElement.classList.add('hover')
            document.querySelector(`.${type} .header`).textContent = `${context}`
            this.prevElement = this.currentElement
          }
        }
      },
      hide (type) {
        if (this.panel.classList.contains('turnOn')) {
          let element = document.getElementsByClassName(type)[0]
          element.style.display = 'none'
          element.classList.remove('hover')
        }
      },
      logout () {
        axios.post(BACKEND_URL + '/logout', this.form)
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
      this.toggle = document.getElementsByClassName('toggle')[0]
      this.panel = document.getElementsByClassName('panel')[0]
      $('#menu-toggle').click(function (e) {
        e.preventDefault()
        $('#wrapper').toggleClass('toggled')
      })
    }
  }
</script>

<style>
    .app-inner {
        display: flex;
    }
</style>
