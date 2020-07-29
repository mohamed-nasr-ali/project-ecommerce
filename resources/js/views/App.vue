<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel shadow">
            <div class="container">
                <router-link :to="{name: 'home'}" class="navbar-brand">{{appName}}</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                        <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                        <span v-if="isLoggedIn">
                          <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type === 0"> Hi, {{name}}</router-link>
                          <router-link :to="{ name: 'admin' }" class="nav-link" v-if="user_type === 1"> Hi, {{name}}</router-link>
                        </span>
                        <li class="nav-link" v-if="isLoggedIn" @click="logout"> Logout</li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <router-view @loggedIn="change"></router-view>
        </main>
    </div>
</template>
<script>
    export default {
      data(){
          this.setDefaults()
          return {
            name        : null,
            user_type   : 0,
            isLoggedIn  : sessionStorage.getItem('jwt') != null,
              appName:process.env.MIX_APP_NAME
          }
      },
      mounted() {
        this.setDefaults()
      },
      methods : {
        setDefaults(){
          if(this.isLoggedIn){
            const user        = JSON.parse(sessionStorage.getItem('user'))
            this.name       = user.name
            this.user_type  = user.is_admin
          }
        },
        change(){
            this.isLoggedIn = sessionStorage.getItem('jwt') != null
            this.setDefaults()

        },
        logout(){
            sessionStorage.removeItem('jwt')
            sessionStorage.removeItem('user')
            sessionStorage.clear();
            this.change()
            this.$router.push('/')
            Swal.fire({
                showConfirmButton: false, // There won't be any confirm button
                timer: 3500,
                backdrop:`
                        rgba(0,0,123,0.4)
                        url("/ecommerce_products_images/logout.gif")
                        bottom center
                        no-repeat
                `
            })
        }
      }
    }
</script>
