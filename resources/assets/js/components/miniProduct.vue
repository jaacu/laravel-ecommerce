<template>
    <div class="card text-center single-product">
        <a :href="url">
        <img class="card-img-top product-image" :class="{ 'blur': isDeleted }" src="/assets/images/background/socialbg.jpg" alt="Product" data-toggle="tooltip" :title="price">
        </a>
        <div class="card-body"><br>
            <small class="text-left text-muted pull-left" >{{ date.toDateString() }}</small>
            <span v-if="!isDeleted">
                <button v-if="showInCart" @click="emitAddCart" @mouseover="changeMessage" @mouseout="changeMessageBack" class="btn btn-outline-primary pull-right btn-sm waves-effect waves-dark">{{ cartmessage }}</button>
                <button v-if="!showInCart" @click="emitAddCart" class="btn btn-outline-primary pull-right btn-sm waves-effect waves-dark">Add to Cart</button>
            </span>
            <span v-else>
                <button disabled class="btn btn-warning pull-right btn-sm waves-effect waves-dark">Out of Stock!</button>
                
            </span>
            <h4 class="card-title">
                <a :href="url" class="link">{{ product.name }}</a>
                <a tab-index="0" v-if="product.categories.length != 0" class="category link text-muted" data-container="body" title="Categories"
                 data-toggle="popover" data-html="true" data-placement="top" :data-content="categories" data-trigger="focus click">
                 <i class="fa fa-folder "></i></a>

                <a tab-index="0" v-if="product.categories.length == 0" class="category link text-muted" data-toggle="tooltip" title="This product is not in any category!" >
                 <i class="fa fa-folder-o "></i></a>
            </h4>
            <p class="card-text">{{ description }} <span v-show="showMore" @click="showDescription" class="text-info text-muted">Show More....</span> <span v-show="show">{{ rest }}</span>  </p>
        <footer class="">
           <small v-for="tag in product.tags" :key="tag.id" @mouseover="addSpinner"  @mouseout="removeSpinner" class="tag badge badge-info btn" data-toggle="tooltip" :title="tag.name"><i class="fa fa-tag "></i> {{ tag.name }}</small>
        </footer>
        </div>

    </div>
</template>

<style>
.tag{
    color: #fff;
    font-size: 12px;
    padding: 5px;
    margin: 1px 8px;
}
.product-image{
    max-height: 400px;
}
</style>

<script>
    export default {
        props:['product' , 'cart'], // The product and the products in the cart
        data(){
            return {
                showMore : false,
                show : false,
                categories: '',
                date: '',
                cartmessage: 'In Cart'
            }
        },
        // Add the categories to the popover content and parse the date to human-readable
        created (){
            for( var category of this.product.categories){
                this.categories += '<li class="list-group-item popover-li"> <i class="fa fa-folder-open-o"></i> ' + category.name + " </li> " 
            }
            var half = this.product.updated_at.split(' ')
            var year = half[0].split('-')
            var time = half[1].split(':')
            this.date = new Date( parseInt(year[0]) , parseInt(year[1])-1 , parseInt(year[2]) , parseInt(time[0]) , parseInt(time[1]) , parseInt(time[2])  )
        },
        computed: {
            //Shorten the description if it is to long
            description (){
                if(this.product.description.length > 90){
                    this.showMore = true
                    return this.product.description.substring(0,80)
                }
                return this.product.description
            },
            //the rest of the description
            rest () {
                return this.product.description.substring(80)
            },
            //The price with a message and the $ sign
            price(){
                return 'For only ' + this.product.price + '$ !'
            },
            //the url for this product
            url(){
                return '/product/' + this.product.id
            },
            //Verifies if this items is in the cart
            showInCart(){
                self = this
                if( ! _.isEmpty(this.cart) ){
                    var result = this.cart.find(function(item){
                        return  item.id == self.product.id 
                    })
                } else return false

                return result !== undefined
            },
            //Check if the product is deleted (Out of Stock)
            isDeleted(){
                return this.product.deleted_at !== null
            }
        },
        methods: {
            //Show the description if it is to long
            showDescription(){
                this.show = !this.show
                this.showMore = !this.showMore
            },
            //Add a the spinning effect to the tags if hovered, just for fun
            addSpinner(e){
                if( e.target.firstChild == null )
                 e.target.className += ' fa-spin '
                 else
                 e.target.firstChild.className += ' fa-spin '
            },
            //Removes the spinning effect to the tags
            removeSpinner(e){
                if( e.target.firstChild == null )
                 e.target.className = ' fa fa-tag '
                 else
                 e.target.firstChild.className = ' fa fa-tag '
            },
            // Emit a event to the parent component when the add to cart button is clicked and send this product properties
            emitAddCart(){
                this.$emit('AddCart', this.product)
            },
            //Change the add to cart button on hover 
            changeMessage(){
                this.cartmessage = 'Add more'
            },
            //Change back the add to cart button
            changeMessageBack(){
                this.cartmessage = 'In cart'
            }
        }
    }
</script>
