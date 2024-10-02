<template>
    <div class="lmt_wrapper">

        <AppModal :title="'Add New Staff'" :width="1000" :showFooter="false" ref="add_staff_modal">
            <template #body>
              <AddStaff @updateDataAfterNewAdd="updateDataAfterNewAdd"/>
            </template>
        </AppModal>

        <AppTable :tableData="staffs"  v-loading="loading">

            <template #header>
                <h1 class="table-title">All Staff</h1>
                <el-button @click="openStaffAddModal()" size="large" type="primary" icon="Plus" class="llmt_button">
                    Add New Staff
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
                <el-table-column prop="formattedDate" label="Joined Date" width="auto" />
                <el-table-column prop="role" label="Role" width="auto" />
                <el-table-column label="Operations" width="120">
                    <template #default="{ row }">
                        <el-tooltip class="box-item" effect="dark" content="Click to view staff" placement="top-start">
                            <el-button @click="openUpdateStaffModal(row)" class="lmt_box_icon"  link  size="small">
                                <Icon icon="lmt-edit" />
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Click to delete staff" placement="top-start">
                            <el-button @click="openDeleteStaffModal(row)" class="lmt_box_icon"  link  size="small">
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
                    :disabled="total_staff <= pageSize"
                    background
                    layout="total, sizes, prev, pager, next"
                    :total="+total_staff"
                  
                />
            </template>

        </AppTable>

        <AppModal
            :title="'Update Staffs'"
            :width="800"
            :showFooter="false"
            ref="update_staff_modal">
            <template #body>
                <AddStaff :staffs_data="staff" />
            </template>
        </AppModal>

        <AppModal
            :title="'Delete Staffs'"
            :width="400"
            :showFooter="false"
            ref="delete_staffs_modal">
            <template #body>
                <div class="delete-modal-body">
                    <h1>Are you sure ?</h1>
                    <p>You want to delete this staff</p>
                </div>
            </template>
            <template #footer>
                <div class="lmt-modal-footer">
                    <el-button @click="$refs.delete_staffs_modal.handleClose()" type="default" size="medium">Cancel</el-button>
                    <el-button @click="deleteStaffs" type="primary" size="medium">Delete</el-button>
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
            staffs: [],
            staff: {},
            total_staff: 0,
            loading: false,
            add_staff_modal: false,
            currentPage: 1,
            pageSize: 10,
            active_id: null
        }
    },

    methods: {

        formatDate(dateString) {
            const date = new Date(dateString);

            const day = date.getDate();
            const month = date.getMonth() + 1; // JavaScript months are 0-based, so add 1
            const year = date.getFullYear();

            // Format the date as "day-month-year"
            return `${day}-${month}-${year}`;
        },

        getStaffs(){
            this.loading = true;
            let that = this;

            jQuery
            .post(ajaxurl, {
                action: "lmt_staffs",
                route: "get_staffs",
                per_page: this.pageSize,
                page: this.currentPage,
                search: this.search,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    // that.staffs = response?.data?.data?.staffs;
                    that.staffs = response?.data?.data?.staffs.map(staffs => {
                        return {
                            ...staffs,
                            formattedDate: that.formatDate(staffs.joined_date) // Format each coupon's end date
                        };
                    });
                    that.total_staff = response?.data?.data?.total;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        },
        deleteStaffs(){
            let that = this;

            jQuery.post(ajaxurl, {
                action: "lmt_staffs",
                route: "delete_staffs",
                id: that.active_id,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.getStaffs();
                    that.$refs.delete_staffs_modal.handleClose();
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
        openStaffAddModal() {
            this.$refs.add_staff_modal.openModel();
        },
        openUpdateStaffModal(row) {
            this.staff = row;
            this.$refs.update_staff_modal.openModel();
        },
        updateDataAfterNewAdd(new_staff) {
            this.$refs.add_staff_modal.handleClose();
            this.staffs.unshift(new_staff);
        },
        openDeleteStaffModal(row) {
            this.active_id = row.id;
            this.$refs.delete_staffs_modal.openModel();
        },
    },
    created() {
        this.getStaffs();
    },
    
}
</script>