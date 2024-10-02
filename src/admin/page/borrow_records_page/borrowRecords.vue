<template>
    <div class="lmt_wrapper">

        <AppTable :tableData="borrow_record"  v-loading="loading">

            <template #header>
                <h1 class="table-title">Borrow Records</h1>
            </template>

            <template #filter>
                <el-input  class="lmt-search-input lmt_input" v-model="search" style="width: 240px" size="large"
                    placeholder="Please Input" prefix-icon="Search" />
            </template>
           
            <template #columns>
                <el-table-column prop="id" label="ID" width="80" />
                <el-table-column prop="book_id" label="Book Id" width="auto" />
                <el-table-column prop="member_id" label="Member Id" width="auto" />
                <el-table-column prop="borrow_date" label="Borrow Date" width="auto" >
                    <template #default="{ row }">
                        {{ formatAddedDate(row.borrow_date) }}
                    </template>
                </el-table-column>
                <el-table-column prop="due_date" label="Due Date" width="auto" >
                    <template #default="{ row }">
                        {{ formatAddedDate(row.due_date) }}
                    </template>
                </el-table-column>
                <el-table-column prop="return_date" label="Return Date" width="auto" >
                    <template #default="{ row }">
                        {{ formatAddedDate(row.return_date) }}
                    </template>
                </el-table-column>
                <el-table-column prop="status" label="Status" width="auto" />
                <el-table-column label="Operations" width="120">
                    <template #default="{ row }">
                        <el-tooltip class="box-item" effect="dark" content="Click to view record" placement="top-start">
                            <el-button @click="openUpdateBorrowModal(row)" class="lmt_box_icon"  link  size="small">
                                <Icon icon="lmt-edit" />
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Click to delete record" placement="top-start">
                            <el-button @click="openDeleteMemberModal(row)" class="lmt_box_icon"  link  size="small">
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
                    :disabled="total_borrow_record <= pageSize"
                    background
                    layout="total, sizes, prev, pager, next"
                    :total="+total_borrow_record"
                  
                />
            </template>

        </AppTable>

        <AppModal
            :title="'Delete Borrow Record'"
            :width="400"
            :showFooter="false"
            ref="delete_borrow_record_modal">
            <template #body>
                <div class="delete-modal-body">
                    <h1>Are you sure ?</h1>
                    <p>You want to delete this borrow record</p>
                </div>
            </template>
            <template #footer>
                <div class="lmt-modal-footer">
                    <el-button @click="$refs.delete_borrow_record_modal.handleClose()" type="default" size="medium">Cancel</el-button>
                    <el-button @click="deleteBorrowRecord" type="primary" size="medium">Delete</el-button>
                </div>
            </template>
        </AppModal>

        <AppModal
            :title="'Update Borrow Record'"
            :width="800"
            :showFooter="false"
            ref="update_borrow_modal">
            <template #body>
                <EditBorrowRecord :borrow_data="borrow" />
            </template>
        </AppModal>
    

    </div>
</template>

<script>
import AppTable from "../../Components/AppTable.vue";
import AppModal from "../../Components/AppModal.vue";
import Icon from "../../Components/Icons/AppIcon.vue";
import EditBorrowRecord from "./EditBorrowRecord.vue";
export default {
    components: {
        AppTable,
        AppModal,
        Icon,
        EditBorrowRecord
    },
    data() {
        return {
            search: '',
            borrow_record: [],
            borrow: {},
            total_borrow_record: 0,
            loading: false,
            add_category_modal: false,
            currentPage: 1,
            pageSize: 10,
            active_id: null
        }
    },

    methods: {

        formatAddedDate(date) {
            if (!date) return '';  // Handle if the date is null or undefined
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return new Date(date).toLocaleDateString('en-GB', options);
        },

        getBorrowRecord(){
            this.loading = true;
            let that = this;

            jQuery
            .post(ajaxurl, {
                action: "lmt_borrow_record",
                route: "get_BorrowRecord",
                per_page: this.pageSize,
                page: this.currentPage,
                search: this.search,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                console.log(response, 'response');
                    that.borrow_record = response?.data?.data?.borrow_record;
                    that.total_borrow_record = response?.data?.data?.total;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        },
        openDeleteMemberModal(row) {
            this.active_id = row.id;
            this.$refs.delete_borrow_record_modal.openModel();
        },
        deleteBorrowRecord(){
            let that = this;

            jQuery.post(ajaxurl, {
                action: "lmt_borrow_record",
                route: "delete_borrow_record",
                id: that.active_id,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.getBorrowRecord();
                    that.$refs.delete_borrow_record_modal.handleClose();
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
        openUpdateBorrowModal(row) {
            this.borrow = row;
            this.$refs.update_borrow_modal.openModel();
        },
      
    },
    created() {
        this.getBorrowRecord();
    },
    
}
</script>