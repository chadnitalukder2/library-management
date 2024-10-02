<template>
    <div class="lmt_wrapper">

        <AppModal :title="'Add New Staff'" :width="1000" :showFooter="false" ref="add_category_modal">
            <template #body>
              <AddStaff @updateDataAfterNewAdd="updateDataAfterNewAdd"/>
            </template>
        </AppModal>

        <AppTable :tableData="categories"  v-loading="loading">

            <template #header>
                <h1 class="table-title">All Categories</h1>
                <el-button @click="openBooksAddModal()" size="large" type="primary" icon="Plus" class="llmt_button">
                    Add New Category
                </el-button>

            </template>

            <template #filter>
                <el-input  class="lmt-search-input lmt_input" v-model="search" style="width: 240px" size="large"
                    placeholder="Please Input" prefix-icon="Search" />
            </template>
           
            <template #columns>
                <el-table-column prop="id" label="ID" width="80" />
                <el-table-column prop="name" label="Name" width="auto" />
                <el-table-column prop="email" label="Email" width="auto" />
                <el-table-column prop="phone" label="Phone" width="auto" />
                <el-table-column prop="address" label="address" width="auto" />
                <el-table-column prop="joined_date" label="Joined Date" width="auto" />
                <el-table-column prop="role" label="Role" width="auto" />
                <el-table-column label="Operations" width="120">
                    <template #default="{ row }">
                        <el-tooltip class="box-item" effect="dark" content="Click to view category" placement="top-start">
                            <el-button @click="openUpdateCategoryModal(row)" class="lmt_box_icon"  link  size="small">
                                <Icon icon="lmt-edit" />
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Click to delete category" placement="top-start">
                            <el-button @click="openDeleteCategoryModal(row)" class="lmt_box_icon"  link  size="small">
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

        <AppModal
            :title="'Update Category'"
            :width="800"
            :showFooter="false"
            ref="update_category_modal">
            <template #body>
                <AddStaff :categories_data="category" />
            </template>
        </AppModal>

        <AppModal
            :title="'Delete Category'"
            :width="400"
            :showFooter="false"
            ref="delete_category_modal">
            <template #body>
                <div class="delete-modal-body">
                    <h1>Are you sure ?</h1>
                    <p>You want to delete this category</p>
                </div>
            </template>
            <template #footer>
                <div class="lmt-modal-footer">
                    <el-button @click="$refs.delete_category_modal.handleClose()" type="default" size="medium">Cancel</el-button>
                    <el-button @click="deleteCategory" type="primary" size="medium">Delete</el-button>
                </div>
            </template>
        </AppModal>
    

    </div>
</template>

<script>
import AppTable from "../../Components/AppTable.vue";
import AppModal from "../../Components/AppModal.vue";
import Icon from "../../Components/Icons/AppIcon.vue";
import AddStaff from "./AddStaff.vue";
export default {
    components: {
        AppTable,
        AppModal,
        Icon,
        AddStaff
    },
    data() {
        return {
            search: '',
            categories: [],
            category: {},
            total_category: 0,
            loading: false,
            add_category_modal: false,
            currentPage: 1,
            pageSize: 10,
            active_id: null
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
                console.log(response, 'response');
                    that.categories = response?.data?.data?.categories;
                    that.total_category = response?.data?.data?.total;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        },
        deleteCategory(){
            let that = this;

            jQuery.post(ajaxurl, {
                action: "lmt_category",
                route: "delete_categories",
                id: that.active_id,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.getCategories();
                    that.$refs.delete_category_modal.handleClose();
                    this.$notify({
                    title: 'Success',
                    message: response.data,
                    type: 'success',
                    position: 'bottom-right',
                })
                }).fail((error) => {
                    console.log(error);
                })
        },
        openBooksAddModal() {
            this.$refs.add_category_modal.openModel();
        },
        openUpdateCategoryModal(row) {
            this.category = row;
            this.$refs.update_category_modal.openModel();
        },
        updateDataAfterNewAdd(new_category) {
            this.$refs.add_category_modal.handleClose();
            this.categories.unshift(new_category);
        },
        openDeleteCategoryModal(row) {
            this.active_id = row.id;
            this.$refs.delete_category_modal.openModel();
        },
    },
    created() {
        this.getCategories();
    },
    
}
</script>