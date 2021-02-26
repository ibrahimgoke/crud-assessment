<template>
    <div>
        <h3 class="text-center">Edit book</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatebook">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="book.name">
                    </div>
                    <div class="form-group">
                        <label>isbn</label>
                        <input type="text" class="form-control" v-model="book.isbn">
                    </div>
                    <button type="submit" class="btn btn-primary">Update book</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                book: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/v1/books/${this.$route.params.id}`)
                .then((response) => {
                    this.book = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updatebook() {
                this.axios
                    .book(`http://localhost:8000/api/v1/books/${this.$route.params.id}`, this.book)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>