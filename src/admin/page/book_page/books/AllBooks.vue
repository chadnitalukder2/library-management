<template>
    <div class="lmt_wrapper">

        <AppModal :title="'Add New Book'" :width="1000" :showFooter="false" ref="add_books_modal">
            <template #body>
                <AddBooks @updateDataAfterNewAdd="updateDataAfterNewAdd"/>
            </template>
        </AppModal>

        <AppTable :tableData="books"  v-loading="loading">
            <template #header>
                <h1 class="table-title">All Books</h1>
                <el-button @click="openBooksAddModal()" size="large" type="primary" icon="Plus" class="ltm_button">
                    Add New Book
                </el-button>

          



            </template>

             <template #filter>
                <el-input  class="lmt-search-input lmt_input" v-model="search" style="width: 240px" size="large"
                    placeholder="Please Input" prefix-icon="Search" />
            </template>
           
            <template #columns>
                <el-table-column prop="id" label="ID" width="60" />
                <el-table-column label="Image" width="auto">
                    <template #default="{ row }">
                        <img v-if="row.images?.url" :src="row.images?.url" alt="image" style="width: 60px; height: 60px; object-fit: cover;">
                        <span v-else>No Image</span>
                    </template>
                </el-table-column>
                <el-table-column prop="book_name" label="Book Name" width="auto" />
                <el-table-column prop="category_name"  label="Category" width="auto" />
                <el-table-column prop="author" label="Author" width="auto" />
                <el-table-column prop="edition" label="Edition" width="auto" />
                <el-table-column prop="quantity" label="Quantity" width="auto" />
                <el-table-column prop="formattedDate" label="Add Date" width="auto" />
                <el-table-column label="Operations" width="120">
                    <template #default="{ row }">
                        <el-tooltip class="box-item" effect="dark" content="Click to view books" placement="top-start">
                            <el-button @click="openUpdateBooksModal(row)" class="lmt_box_icon"  link  size="small">
                                <Icon icon="lmt-edit" />
                            </el-button>
                        </el-tooltip>
                        <el-tooltip class="box-item" effect="dark" content="Click to delete books" placement="top-start">
                            <el-button @click="openDeleteBooksModal(row)"  class="lmt_box_icon" link  size="small">
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
                    :disabled="total_book <= pageSize"
                    background
                    layout="total, sizes, prev, pager, next"
                    :total="+total_book"
                  
                />
            </template>

        </AppTable>

        <AppModal
            :title="'Update Books'"
            :width="800"
            :showFooter="false"
            ref="update_books_modal">
            <template #body>
                <AddBooks :books_data="book" />
            </template>
        </AppModal>

        <AppModal
            :title="'Delete Books'"
            :width="400"
            :showFooter="false"
            ref="delete_books_modal">
            <template #body>
                <div class="delete-modal-body">
                    <h1>Are you sure ?</h1>
                    <p>You want to delete this Books</p>
                </div>
            </template>
            <template #footer>
                <div class="lmt-modal-footer">
                    <el-button @click="$refs.delete_books_modal.handleClose()" type="default" size="medium">Cancel</el-button>
                    <el-button @click="deleteBooks" type="primary" size="medium">Delete</el-button>
                </div>
            </template>
        </AppModal>

    </div>
</template>

<script>
import AppTable from "../../../Components/AppTable.vue";
import AppModal from "../../../Components/AppModal.vue";
import Icon from "../../../Components/Icons/AppIcon.vue";
import AddBooks from "./AddBooks.vue";
export default {
    components: {
        AppTable,
        AppModal,
        Icon,
        AddBooks,
    },
    data() {
        return {
            search: '',
            books: [],
            book: {},
            total_book: 0,
            loading: false,
            add_books_modal: false,
            currentPage: 1,
            pageSize: 10,
            active_id : null
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

        getBooks() {
            this.loading = true;
            let that = this;
            jQuery
                .post(ajaxurl, {
                    action: "lmt_books",
                    route: "get_books",
                    per_page: this.pageSize,
                    page: this.currentPage,
                    search: that.search,
                    lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
                }).then((response) => {
                    // that.books = response?.data?.data?.books;
                    that.books = response?.data?.data?.books.map(books => {
                        return {
                            ...books,
                            formattedDate: that.formatDate(books.added_date) // Format each coupon's end date
                        };
                    });
                    that.total_book = response?.data?.data?.total;
                }).fail((error) => {
                    console.log(error);
                }).always(() => {
                    that.loading = false;
                })
        },
        deleteBooks(){
            let that = this;

            jQuery.post(ajaxurl, {
                action: "lmt_books",
                route: "delete_books",
                id: that.active_id,
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
            }).then((response) => {
                    that.getBooks();
                    that.$refs.delete_books_modal.handleClose();
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
            this.$refs.add_books_modal.openModel();
        },
        updateDataAfterNewAdd(new_books) {
            this.$refs.add_books_modal.handleClose();
            this.books.unshift(new_books);
        },
        openUpdateBooksModal(row) {
            this.book = row;
            this.$refs.update_books_modal.openModel();
        },
        openDeleteBooksModal(row) {
            this.active_id = row.id;
            this.$refs.delete_books_modal.openModel();
        },
    },
    created() {
        this.getBooks();
    },
    
}
</script>