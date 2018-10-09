<template>
    <div class="col-lg-12">
        <h3 class="text-center"><a data-toggle="collapse" href="#filter" aria-expanded="false" aria-controls="filter"><i class=" fa fa-filter " data-toggle="tooltip" title="Filters"></i></a></h3>
        <div class="collapse" id="filter">
            <div class="row my-3 form-group">
                <div class="col-lg-4 col-sm-6">
                    <select name="categories[]" v-model="selectedCategories" id="categories" class="selectpicker w-100" multiple 
                    data-style="form-control btn-inverse text-white" @change="filterProducts" data-title="Filter by Categories">
                        <option  v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <input  placeholder="Filter By Tag" id="tags" type="text" name="tags" data-role="tagsinput">
                </div>
                <div class="col-lg-4 col-sm-6">
                    <input  placeholder="Filter By Product's Name" id="name" type="text" class="form-control" name="name" v-model="selectedName" @keyup.enter="filterProducts">
                </div>
                <div class="col-lg-6 col-sm-8 text-center align-self-center p-1 my-2" data-toggle="tooltip" title="Filter by Price">
                    <h6>Filter by price <i class="fa fa-money icon-filter"></i></h6>
                    <input type="text" id="price_range">
                </div>
                <div class="col-lg-5 col-sm-4 text-center align-self-center my-2">
                    <h6 class="btn " data-toggle="tooltip" title="Sort" @click="sortByDate"><i class="fa fa-sort icon-filter"></i>  {{ orderByDateAscMsg}} </h6>
                    <br>
                    <h6 class="btn" data-toggle="tooltip" title="Shuffle!" @click="shuffle"><i class="fa fa-random icon-filter"></i> Shuffle!</h6>
                    <br>
                    <button @click="showDeleted = !showDeleted" class="btn waves-effect waves-dark"
                    :class="{ 'btn-outline-secondary': showDeleted , 'btn-secondary': !showDeleted  }" 
                    data-toggle="tooltip" title="Show products Out of Stock" ><i class="fa " :class="{ 'fa-check': showDeleted , 'fa-times': !showDeleted  }" ></i> Out of Stock</button>
                </div>
                <div class="col-lg-4 col-sm-6 mx-auto text-center align-self-center">
                    <button @click="filterProducts" class="btn btn-outline-info btn-md waves-effect waves-dark" > <i class="fa fa-search icon-filter"></i> Filter </button>
                </div>
            </div>
        </div>
        <transition name="fade-slide" appear mode="in-out" >
        <div class="col-lg-5 col-sm-12 alert alert-warning mx-auto" v-show="showWarning" >
                <h4 class="alert-heading text-center"> <strong> No Results with the given filters </strong>!</h4>
        </div>
        </transition>
        <div class="card-columns product-grid">
            <transition-group appear name="fade-slide" mode="in-out">
            <mini-product v-for="(product) in productsFiltered" :key="product.id" :product="product" @AddCart="addToCartModal" :cart="cart" ></mini-product>
            </transition-group>
        </div>
    </div>
</template>

<style>
.fade-slide-enter-active, .fade-slide-leave-active {
  transition: all 1.5s;
}
.fade-slide-enter, .fade-slide-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
.fade-slide-move {
  transition: transform 1s;
}
.text-white{
    color: white;
}
.icon-filter{
    font-size: 18px;
}
</style>

<script>
    export default {
        props:['productsraw', 'categoriesraw' , 'authcart'],
        created() {
            this.products = JSON.parse(this.productsraw) //Parse the products string to json
            this.categories = JSON.parse(this.categoriesraw) //Parse the categories string to json
            this.productsFiltered = this.products //Copy the products to the filtered products array
            if(this.authcart !== '')
            this.cart = JSON.parse(this.authcart) //Parse the the products in cart if the user is login
            this.sortByDate(); // Sort the array by latest by default
        },
        data(){
            return {
                products: {},
                productsFiltered: [],
                categories:  {},
                selectedTags: '',
                selectedCategories: [],
                selectedName: '',
                orderByDateAsc: false,
                orderByDateAscMsg: '',
                cart: {},
                showDeleted: true
            }
        },
        computed: {
            //Show a warning if the filter products array is empty
            showWarning(){
                return this.productsFiltered.length == 0
            },
        },
        watch: {
            // Filter the products when this property changes
            showDeleted: function(){
                this.filterProducts()
            }
        },
        methods: {
            filterProducts(){
                this.selectedTags = '';
                let self = this
                //Get the user input tags
                $('.bootstrap-tagsinput').find('span.tag').each(function(e){ let text = $(this).text()
                if(self.selectedTags == ''){
                        self.selectedTags = text
                    } else {
                        self.selectedTags += ',' + text
                    } 
                })
                this.productsFiltered = this.products

                //Verifies to show the Deleted (Out of Stock) products
                if( !this.showDeleted ){
                    this.productsFiltered = this.productsFiltered.filter(this.isDeleted)
                }

                    //If the filters aren't empty, filter the products
                if( !(self.selectedTags.trim() == '' && self.selectedName.trim() == '') ){
                    var re = ".*" + self.selectedName.trim() + ".*";
                    var regex = new RegExp(re , 'i') //The rexExp to filter by name
                    //Filter products
                    this.productsFiltered = this.products.filter(function( product ){
                        var tagFilter = false
                        var nameFilter = false
                        // Get this product if one tag match
                        if( self.selectedTags.trim() != '' ){
                            for ( var pTag of product.tags ){
                                if( pTag.name.toLowerCase().includes( self.selectedTags.toLowerCase()  ) ){
                                    tagFilter = true
                                    break
                                }
                            }
                        }
                        //Get this product if the name match
                        if( self.selectedName.trim() != ''){
                            if( regex.test(product.name.trim()) ){
                                nameFilter = true
                            }
                        }                    
                            // console.log('tagFilter = ' , tagFilter , 'categoryFilter = ' , categoryFilter , 'nameFilter = ' , nameFilter );
                            return ( tagFilter ||  nameFilter  ) //Get the product if one of the  filters success
                    });
                }
                //Filter by category if at least one category if selected
                if( self.selectedCategories.length != 0 ){
                    //Filter by categiory
                        this.productsFiltered = this.productsFiltered.filter(function( product ){
                            var categoryFilter = false
                            
                            // Get this product if the category match
                                for ( var pCategory of product.categories ){
                                    for ( var sCategory of self.selectedCategories ){
                                        if( sCategory == pCategory.id ){
                                            categoryFilter = true
                                            break
                                        }
                                    }
                                    if(categoryFilter)
                                    break
                                }
                            return categoryFilter // Get the product if it has one or more categories
                        });
                    }
                    self.runPopover()
                    
                    //Filter by price
                    var range = $('#price_range').val()
                    range = range.split(';')
                    this.productsFiltered = this.productsFiltered.filter( function( product ){
                        //Get the product if the price is between the users range
                        return ( parseFloat(product.price) >= parseFloat(range[0]) && parseFloat(product.price) <= parseFloat(range[1]) )
                    })
            },
            //Hide and then run again the popover and tooltips
            runPopover(){
                //Hide the tooltips
                $('[data-toggle="popover"]').popover('hide') 
                $('[data-toggle="tooltip"]').tooltip('hide')
                //After 15 seconds (Wait to all the animations to end) re-run the popover and tooptips 
                setTimeout(function(){
                    $('[data-toggle="popover"]').popover()
                    $('[data-toggle="tooltip"]').tooltip() 
                },15)
            },
            //Sort the product by the most recent or the most acient
            sortByDate(){
                this.orderByDateAsc = ! this.orderByDateAsc
                if( this.orderByDateAsc ){
                    this.productsFiltered.sort(function(a, b){
                    if(a.updated_at > b.updated_at){
                        return -1
                    } else {
                        return 1
                    }
                    return 0
                    })
                    this.orderByDateAscMsg = "Sort By Older"
                } else {
                    this.productsFiltered.sort(function(a, b){
                    if(a.updated_at < b.updated_at){
                        return -1
                    } else {
                        return 1
                    }
                    return 0
                })
                    this.orderByDateAscMsg = "Sort By Latest"
                }
            },
            //Shuffle the products, just for fun
            shuffle(){
                this.productsFiltered = _.shuffle(this.productsFiltered)
            },
            /**
             * The event handler to the AddCart event from the child component
             * Load the modal placeholder with the modal for adding the product generating the event to the cart 
             */
            addToCartModal(product){
                $('#modalPlaceholder').load('/cart/add?id=' + product.id , function(){
                    $('#modalPlaceholder').modal()
                })
            },
            // Verifies if the given product is deleted (Out of Stock)
            isDeleted(product){
                return product.deleted_at == null
            }
        }
    }
</script>
