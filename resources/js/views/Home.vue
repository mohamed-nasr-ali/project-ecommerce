<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Welcome to {{appName}}</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(product,index) in products" v-if="product.units > 0" @key="index">
                            <router-link :to="{ path: '/products/'+product.id}">
                                <img :src="product.image" :alt="product.name" class="img-fluid">
                                <h5 class="pt-2">
                                    <span v-html="product.name.length > 10 ? product.name.substring(0,10)+'...':product.name"></span>
                                    <span class="small-text text-muted float-right">$ {{product.price}}</span>
                                </h5>
                                <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                products : [],
                appName:process.env.MIX_APP_NAME
            }
        },
        mounted(){
            axios.get("api/products/")
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
    img{
        display: block;
        height: 150px !important;
        width: 100%;
    }
</style>
