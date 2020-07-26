<template>
    <div>
        <el-dialog :title="titleDialog" :visible="showDialog" @close="close" @open="open" width="40%">
            <form @submit.prevent="addSearch">
                <div class="form-group row" :class="{'has-danger': errors.search}">
                    <label class="col-md-4 col-form-label text-md-right">Buscar</label>
                    <div class="col-md-6">
                        <el-input v-model="form.search" required></el-input>
                        <small class="form-control-feedback alert-danger" v-if="errors.search" v-text="errors.search[0]"></small>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                     <span slot="footer" class="dialog-footer">
                      <el-button @click.prevent="close()">Cancel</el-button>
                      <el-button type="primary" native-type="submit" :loading="loading_submit">Procesar</el-button>
                      </span>
                    </div>
                </div>
            </form>

        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "SearchFormComponent",
        props: ['showDialog'],
        data(){
            return {
                url: '/api/search',
                titleDialog: null,
                loading_submit: false,
                errors: {},
                form: {},
            }
        },
        methods: {
            initForm() {
                this.errors = {};
                this.form = {
                    search:null,
                }
            },
            close() {
                this.$emit('update:showDialog', false);
                this.initForm();
            },
            open() {
                this.titleDialog = "BUSCAR";
                this.initForm();
            },
            addSearch(){
                this.loading_submit = true;
                let uri = `${this.url}` ;
                this.axios.post(uri, this.form)
                    .then((response) => {
                        if (response.data.success) {
                            this.$message.success(response.data.message)
                            this.$eventHub.$emit('reloadData',  response.data.lists);
                            this.close()
                        } else {
                            this.$message.error(response.data.message)
                        }
                    }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data
                    } else {
                        console.log(error)
                    }
                }).then(() => {
                    this.loading_submit = false
                });
            },
        }
    }
</script>

<style scoped>

</style>
