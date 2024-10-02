<template>
    <div class="lmt_form_wrapper">
        <!-- <h1 class="lmt_form_title"></h1> -->
        <div class="input-wrapper">
            <p class="form-label" for="name">Book Name *</p>
            <el-input class="lmt_input" required v-model="books.book_name" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ name_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Author Name *</p>
            <el-input class="lmt_input" v-model="books.author" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ author_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">publisher Name *</p>
            <el-input class="lmt_input" v-model="books.publisher" style="width: 100%" placeholder="Please Input" size="large" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Published Date *</p>
            <el-date-picker class="lmt_input" v-model="books.published_date" type="date" style="width: 100%"
            placeholder="Start Date " size="large" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Edition *</p>
            <el-input class="lmt_input" v-model="books.edition" style="width: 100%" placeholder="Please Input" size="large" type="number" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Category Name *</p>
          
            <el-select class="lmt_input" v-model="books.category_name" placeholder="Discount Type" size="large"style="width: 100%">
                <el-option v-for="category in categories" :key="category.value" :label="category.name" :value="category.name"  />
            </el-select>
            <p class="error-message">{{ category_name_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Quantity *</p>
            <el-input class="lmt_input" v-model="books.quantity" style="width: 100%" placeholder="Please Input" size="large" type="number" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Added Date *</p>
            <el-date-picker class="lmt_input" v-model="books.added_date" type="date" style="width: 100%"
            placeholder="Start Date " size="large" />
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Description</p>
            <el-input class="lmt_input" v-model="books.description" style="width: 100%" placeholder="Please Input" size="large" type="textarea" />
        </div><br>

        <div class="input-wrapper">
            <p class="form-label" for="name">Upload Cover Image</p>
            <ImageUpload :image="books.images" />
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
            categories : [],
            books: {
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
          
            name_error: "",
            author_error: "",
            category_name_error: "",
        }
    },
    props: {
        books_data: {
            type: Object,
        }
    },
    watch: {
        books_data: {
            handler: function (val) {
                this.books = val;
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

            if (this.books.book_name === "") {
                this.name_error = "Book Name is required";
                return;
            }
            if (this.books.author === "") {
                this.author_error = "Author Name is required";
                return;
            }
            if (this.books.category_name === "") {
                this.category_name_error = "Category Name is required";
                return;
            }
            jQuery
            .post(ajaxurl, {
                action: "lmt_books",
                route: "post_books",
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
                data: this.books
            }).then((response) => {
                console.log(response);
                this.$emit("updateDataAfterNewAdd", this.books);
                this.books = {
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
    mounted() {
        if (this.books_data) {
            this.books = this.books_data;
        }
    },
    created() {
        this.getCategories();
    },
   
  
  
}
</script>