<template>
    <div class="lmt_form_wrapper">
        <!-- <h1 class="lmt_form_title"></h1> -->
        <div class="input-wrapper">
            <p class="form-label" for="name">Book Name *</p>
            <el-input class="lmt_input" required v-model="book_info.book_name" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ name_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Author Name *</p>
            <el-input class="lmt_input" v-model="book_info.author" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">publisher Name *</p>
            <el-input class="lmt_input" v-model="book_info.publisher" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Published Date *</p>
            <el-date-picker class="lmt_input" v-model="book_info.published_date" type="date" style="width: 100%"
            placeholder="Start Date " size="large" />
        
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Edition *</p>
            <el-input class="lmt_input" v-model="book_info.edition" style="width: 100%" placeholder="Please Input" size="large" type="number" />
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Category Name *</p>
          
            <el-select class="lmt_input" v-model="book_info.category_name" placeholder="Discount Type" size="large"style="width: 100%">
                <el-option v-for="category in categories" :key="category.value" :label="category.name" :value="category.id"  />
                <el-option label="Fixed" value="Fixed" />
            </el-select>
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Quantity *</p>
            <el-input class="lmt_input" v-model="book_info.quantity" style="width: 100%" placeholder="Please Input" size="large" type="number" />
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Added Date *</p>
            <el-date-picker class="lmt_input" v-model="book_info.added_date" type="date" style="width: 100%"
            placeholder="Start Date " size="large" />
            <p class="error-message">{{ slug_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Description</p>
            <el-input class="lmt_input" v-model="book_info.description" style="width: 100%" placeholder="Please Input" size="large" type="textarea" />
        </div><br>

        <div class="input-wrapper">
            <p class="form-label" for="name">Upload Cover Image</p>
            <ImageUpload :image="book_info.images" />
        </div><br>

        <div class="input-wrapper" @click="saveActivities()">
            <el-button size="large" type="primary">Save Activities</el-button>
        </div>

    </div>
</template>

<script>
import ImageUpload from '../../../Components/AppImageUpload.vue';

export default {
    components:{
        ImageUpload
    },
   
    data() {
        return {
            book_info: {
                book_name: "",
                author: "",
                publisher: "",
                published_date: "",
                category_name: "",
                quantity: "",
                edition: "",
                added_date: "",
                description: "",
                images: {}
            },
            categories : [],
            name_error: "",
            slug_error: ""
        }
    },
    methods: {
        getCategories(){
            this.loading = true;
            let that = this;

            jQuery
            .post(ajaxurl, {
                action: "lmt_category",
                route: "get_categories",
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.categories = response?.data?.data?.categories;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        }
       
    },
    created() {
        this.getCategories();
    },
  
  
}
</script>