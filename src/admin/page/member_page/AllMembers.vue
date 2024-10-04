<template>
    <div class="lmt_wrapper">

        <AppTable :tableData="members"  v-loading="loading">

            <template #header>
                <h1 class="table-title">All Members</h1>
            </template>

            <template #filter>
                <el-input  class="lmt-search-input lmt_input" v-model="search" style="width: 240px" size="large"
                    placeholder="Please Input" prefix-icon="Search" />
            </template>
           
            <template #columns>
                <el-table-column prop="id" label="ID" width="80" />
                <el-table-column prop="name" label=" Name" width="auto" />
                <el-table-column prop="email" label="Email" width="auto" />
                <el-table-column prop="phone" label="Phone" width="auto" />
                <el-table-column prop="address" label="Address" width="auto" />
                <el-table-column prop="membership_date" label="Date" width="auto" />
                <el-table-column prop="membership_type" label="Type" width="auto" >
                    <template #default="{ row }">
                        {{ formatAddedDate(row.membership_type) }}
                    </template>
                </el-table-column>
                <el-table-column label="Operations" width="120">
                    <template #default="{ row }">
                        <el-tooltip class="box-item" effect="dark" content="Click to view member" placement="top-start">
                            <el-button  class="lmt_box_icon"  link  size="small">
                                <Icon icon="lmt-edit" />
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Click to delete member" placement="top-start">
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
                    :disabled="total_member <= pageSize"
                    background
                    layout="total, sizes, prev, pager, next"
                    :total="+total_member"
                  
                />
            </template>

        </AppTable>

        <AppModal
            :title="'Delete Members'"
            :width="400"
            :showFooter="false"
            ref="delete_member_modal">
            <template #body>
                <div class="delete-modal-body">
                    <h1>Are you sure ?</h1>
                    <p>You want to delete this member</p>
                </div>
            </template>
            <template #footer>
                <div class="lmt-modal-footer">
                    <el-button @click="$refs.delete_member_modal.handleClose()" type="default" size="medium">Cancel</el-button>
                    <el-button @click="deleteMember" type="primary" size="medium">Delete</el-button>
                </div>
            </template>
        </AppModal>
    

    </div>
</template>

<script>
import AppTable from "../../Components/AppTable.vue";
import AppModal from "../../Components/AppModal.vue";
import Icon from "../../Components/Icons/AppIcon.vue";
export default {
    components: {
        AppTable,
        AppModal,
        Icon,
    },
    data() {
        return {
            search: '',
            members: [],
            category: {},
            total_member: 0,
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

        getMembers(){
            this.loading = true;
            let that = this;

            jQuery
            .post(ajaxurl, {
                action: "lmt_members",
                route: "get_members",
                per_page: this.pageSize,
                page: this.currentPage,
                search: this.search,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                console.log(response, 'response');
                    that.members = response?.data?.data?.members;
                    that.total_member = response?.data?.data?.total;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        },
        openDeleteMemberModal(row) {
            this.active_id = row.id;
            this.$refs.delete_member_modal.openModel();
        },
        deleteMember(){
            let that = this;

            jQuery.post(ajaxurl, {
                action: "lmt_members",
                route: "delete_member",
                id: that.active_id,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.getMembers();
                    that.$refs.delete_member_modal.handleClose();
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
      
    },
    created() {
        this.getMembers();
    },
    
}
</script>