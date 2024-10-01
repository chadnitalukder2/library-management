<template>
    <div class="lmt_form_wrapper">

        <div class="input-wrapper">
            <p class="form-label" for="name">Category Name *</p>
            <el-input class="lmt_input" v-model="categories.name" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ name_error }}</p>
        </div>
    
        <div class="input-wrapper">
            <p class="form-label" for="name">Description</p>
            <el-input class="lmt_input" v-model="categories.description" style="width: 100%" placeholder="Please Input" size="large" type="textarea" />
        </div><br>

        <div class="input-wrapper" @click="saveCategory()">
            <el-button size="large" type="primary">Save Category</el-button>
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
            categories: {
               name: "",
               description: "",
            },
            name_error: "",
        }
    },
    props: {
        categories_data: {
            type: Object,
        }
    },
    watch: {
        // Its required to watch the categories_data to update the category object
        categories_data: {
            handler: function (val) {
                this.categories = val;
            },
            deep: true
        }
    },
    methods:{
        saveCategory(){
            this.name_error = "";
            if (this.categories.name === "") {
                this.name_error = "Category Name is required";
                return;
            }
            jQuery
            .post(ajaxurl, {
                action: "lmt_category",
                route: "post_category",
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
                data: this.categories
            }).then((response) => {
                console.log(response);
                this.$emit("updateDataAfterNewAdd", this.categories);
                this.categories = {
                    name: "",
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
  
    mounted() {
        if (this.categories_data) {
            this.categories = this.categories_data;
        }
    }
  
  
}
</script>