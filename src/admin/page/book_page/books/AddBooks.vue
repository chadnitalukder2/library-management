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
            <p class="error-message">{{ author_error }}</p>
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
                <el-option v-for="category in categories" :key="category.value" :label="category.name" :value="category.name"  />
            </el-select>
            <p class="error-message">{{ category_name_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Quantity *</p>
            <el-input class="lmt_input" v-model="book_info.quantity" style="width: 100%" placeholder="Please Input" size="large" type="number" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Added Date *</p>
            <el-date-picker class="lmt_input" v-model="book_info.added_date" type="date" style="width: 100%"
            placeholder="Start Date " size="large" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Description</p>
            <el-input class="lmt_input" v-model="book_info.description" style="width: 100%" placeholder="Please Input" size="large" type="textarea" />
        </div><br>

        <div class="input-wrapper">
            <p class="form-label" for="name">Upload Cover Image</p>
            <ImageUpload :image="book_info.images" />
        </div><br>

        <div class="input-wrapper" @click="saveBooks()">
            <el-button size="large" type="primary">Save Books</el-button>
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
    props: {
        books_data: {
            type: Object,
        }
    },
    watch: {
        // Its required to watch the categories_data to update the category object
        books_data: {
            handler: function (val) {
                this.book_info = val;
            },
            deep: true
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
        },
        saveBooks(){
            this.name_error = "";
            this.author_error = "";
            this.category_name_error = "";

            if (this.book_info.book_name === "") {
                this.name_error = "Book Name is required";
                return;
            }
            if (this.book_info.author === "") {
                this.author_error = "Author Name is required";
                return;
            }
            if (this.book_info.category_name === "") {
                this.category_name_error = "Category Name is required";
                return;
            }
            jQuery
            .post(ajaxurl, {
                action: "lmt_books",
                route: "post_books",
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
                data: this.book_info
            }).then((response) => {
                console.log(response);
                this.$emit("updateDataAfterNewAdd", this.book_info);
                this.book_info = {
                    book_name: "",
                    author: "",
                    publisher: "",
                    published_date: "",
                    category_name: "",
                    quantity: "",
                    edition: "",
                    added_date: "",
                    description: "",
                };
                this.$notify({
                    title: 'Success',
                    message: response.data,
                    type: 'success',
                    position: 'bottom-right',
                })
                
            });
          
        }
       
    },
    created() {
        this.getCategories();
    },
    mounted() {
        if (this.books_data) {
            this.book_info = this.books_data;
        }
    }
  
  
}
</script>