<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>Product</td>
                <td>Units</td>
                <td>Price</td>
                <td>Description</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product,index) in products" @key="index">
                <td>{{index+1}}</td>
                <td v-html="product.name"></td>
                <td v-model="product.units">{{product.units}}</td>
                <td v-model="product.price">{{product.price}}</td>
                <td v-model="product.price">{{product.description}}</td>
                <td v-model="product.id">
                    <button class="btn btn-primary" @click="editingItem = product">edit</button>
                </td>
                <td v-model="product.id">
                    <button class="btn btn-danger" @click="deleteItem(product.id)">delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
        <modal @close="addProduct" :product="addingProduct" v-show="addingProduct != null"></modal>
        <br>
        <button class="btn btn-primary" @click="newProduct">Add New Product</button>
    </div>
</template>
<script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                products: [],
                editingItem: null,
                addingProduct: null
            }
        },
        components: {
            Modal
        },
        beforeMount() {
            axios.get('/api/products/')
                .then(response => {
                    this.products = response.data
                })
                .catch(error => {
                    console.error(error);
                })
        },
        methods: {
            loadProducts() {
                return axios.get('/api/products/')
                    .then(response => {
                        this.products = response.data
                        Toast.fire({
                            icon: 'success',
                            title: 'loading successfully'
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    })
            },
            newProduct() {
                this.addingProduct = {
                    name: null,
                    units: null,
                    price: null,
                    description: null,
                    image: null
                }
            },
            endEditing(product) {
                this.editingItem = null
                let index = this.products.indexOf(product)
                if (isNaN(product.price) || isNaN(product.units)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    })
                    this.loadProducts()
                }
                axios.put(`/api/products/${product.id}`, {
                    name: product.name,
                    units: product.units,
                    price: product.price,
                    description: product.description,
                    image: product.image,
                    product_id:product.id
                })
                .then(response => {
                    this.products[index] = product
                    document.getElementById('file').value = "";
                })
                .catch(response => {
                    console.error(response);
                })


            },
            addProduct(product) {
                this.addingProduct = null;
                const checkProperties = product => {
                    for (var key in product) {
                        if (product[key] !== null && product[key] !== "")
                            return true;
                    }
                    return false;
                }
                if (checkProperties(product)) {
                    axios.post("/api/products/", {
                        name: product.name,
                        units: product.units,
                        price: product.price,
                        description: product.description,
                        image: product.image || 'ecommerce_products_images/default.jpeg'
                    })
                    .then(response => {
                        this.products.push(product)
                        document.getElementById('file').value = "";
                        Toast.fire({
                            icon: 'success',
                            title: 'add Product successfully'
                        });
                    })
                    .catch(response => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Product Data Are Not Complete!'
                        })
                    })

                    document.getElementById('file').value = "";
                }
            },
            deleteItem(id) {
                if (confirm('Are you sure you want to delete product?')) {
                    // Save it!
                    axios.delete(`/api/products/${id}`)
                        .then(_ => {
                            this.loadProducts()
                        })
                        .catch(response => {
                            console.log(response)
                        })
                }
            }
        }
    }
</script>
