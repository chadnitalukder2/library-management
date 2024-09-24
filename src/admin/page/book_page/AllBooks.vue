<template>
    <div class="lmt_destinations_wrapper">

        <AppTable  v-loading="loading">

            <template #header>
                <h1 class="table-title">All Books</h1>
                <el-button size="large" type="primary" class="ltm_button">
                    Add New
                </el-button>
                
          



            </template>

             <template #filter>
                <el-input  class="lmt-search-input" v-model="search" style="width: 240px" size="large"
                    placeholder="Please Input" prefix-icon="Search" />
            </template>
           
            <template #columns>
                <el-table-column label="ID" width="60" />
                <el-table-column label="Booking Date" width="auto" />
                <el-table-column label="Status" width="auto" />
                <el-table-column  label="Total" width="auto" />
                <el-table-column  label="Trip id" width="auto" />
                <el-table-column  label="Customer Name" width="auto" />
                <el-table-column  label="Customer Email" width="auto" />
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
                    :disabled="total_booking <= pageSize"
                    background
                    layout="total, sizes, prev, pager, next"
                    :total="+total_booking"
                  
                />
            </template>

        </AppTable>

        <!-- <AppModal
            :title="'Delete Booking'"
            :width="400"
            :showFooter="false"
            ref="delete_booking_modal">
            <template #body>
                <div class="delete-modal-body">
                    <h1>Are you sure ?</h1>
                    <p>You want to delete this booking</p>
                </div>
            </template>
            <template #footer>
                <div class="lmt-modal-footer">
                    <el-button  type="default" size="medium">Cancel</el-button>
                    <el-button  type="primary" size="medium">Delete</el-button>
                </div>
            </template>
        </AppModal> -->

      

    </div>
</template>

<script>
import AppTable from "../../Components/AppTable.vue";
import AppModal from "../../components/AppModal.vue";
import Icon from "../../Components/Icons/AppIcon.vue";
export default {
    components: {
        AppTable,
        AppModal,
        Icon
    },
    data() {
        return {
            search: '',
            bookings: [],
            booking: {},
            total_booking: 0,
            loading: false,
            currentPage: 1,
            pageSize: 10,
            active_id: null
        }
    },

    methods: {
    


    },
    
    
  
}
</script>