<template>
    <div class="lmt_wrapper">

        <AppModal :title="'Add New Category'" :width="1000" :showFooter="false" ref="add_books_modal">
            <template #body>
              <AddCategory/>
            </template>
        </AppModal>

        <AppTable :tableData="bookings"  v-loading="loading">

            <template #header>
                <h1 class="table-title">All Categories</h1>
                <el-button @click="openBooksAddModal()" size="large" type="primary" icon="Plus" class="ltm_button">
                    Add New Category
                </el-button>

          



            </template>

             <template #filter>
                <el-input  class="lmt-search-input lmt_input" v-model="search" style="width: 240px" size="large"
                    placeholder="Please Input" prefix-icon="Search" />
            </template>
           
            <template #columns>
                <el-table-column prop="id" label="ID" width="60" />
                <el-table-column prop="name" label="Category Name" width="auto" />
                <el-table-column prop="description" label="Description" width="auto" />
                <el-table-column label="Operations" width="120">
                    <template #default="{ row }">
                        <el-tooltip class="box-item" effect="dark" content="Click to view activities" placement="top-start">
                            <el-button  link type="primary" size="small">
                                <Icon icon="lmt-eye" />
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Click to delete activities" placement="top-start">
                            <el-button  link type="primary" size="small">
                                <Icon icon="lmt-delete" />
                            </el-button>
                        </el-tooltip>
                    </template>
                </el-table-column>
            </template>

            <template #footer>
                <el-pagination
                    v-model:current-page="currentPage"
                    v-model:page-size="pageSize"
                    :page-sizes="[10, 20, 30, 40]"
                    large
                    :disabled="total_category <= pageSize"
                    background
                    layout="total, sizes, prev, pager, next"
                    :total="+total_category"
                  
                />
            </template>

        </AppTable>

    

    </div>
</template>

<script>
import AppTable from "../../../Components/AppTable.vue";
import AppModal from "../../../Components/AppModal.vue";
import Icon from "../../../Components/Icons/AppIcon.vue";
import AddCategory from "./AddCategory.vue";
export default {
    components: {
        AppTable,
        AppModal,
        Icon,
        AddCategory
    },
    data() {
        return {
            search: '',
            categories: [],
            category: {},
            total_category: 0,
            loading: false,
            add_books_modal: false,
            currentPage: 1,
            pageSize: 10,
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
                per_page: this.pageSize,
                page: this.currentPage,
                search: this.search,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.categories = response?.data?.data?.categories;
                    that.total_category = response?.data?.data?.total;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        },
        openBooksAddModal() {
            this.$refs.add_books_modal.openModel();
        }
    },
    created() {
        this.getCategories();
    },
    
}
</script>