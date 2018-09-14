<template>
    <div class="card text-center">
        <a :href="url">
        <img class="card-img-top img-fluid" src="/assets/images/background/socialbg.jpg" alt="Product" data-toggle="tooltip" :title="price">
        </a>
        <div class="card-body">
            <a :href="url"><h4 class="card-title"> {{ productP.name }} </h4> </a>
            <p class="card-text">{{ description }} <span v-show="showMore" @click="showDescription" class="text-info text-muted">Show More....</span> <span v-show="show" @click="showDescription">{{ rest }}</span> </p>
        </div>
    </div>
</template>

<script>
    export default {
        props:['product' , 'url'],
        created() {
            this.productP = JSON.parse(this.product) 
        },
        mounted() {
             console.log()
        },
        data(){
            return {
                productP : {},
                showMore : false,
                show : false
            }
        },
        computed: {
            description (){
                if(this.productP.description.length > 100){
                    this.showMore = true
                    return this.productP.description.substring(0,90)
                }
                return this.productP.description
            },
            rest () {
                return this.productP.description.substring(90)
            },
            price(){
                return 'For only' + this.productP.price + '$ !'
            }
        },
        methods: {
            showDescription(){
                this.show = !this.show
                this.showMore = false
            }
        }
    }
</script>
