<template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <img :src="image" class="img-responsive">
            </div>
            <div class="col-md-8">
                 
                <input type="file" ref="fileupload" v-on:change="onFileChange" class="form-control">
                
            </div>
            <div class="col-md-2">
                <!-- <button class="btn btn-success btn-block" @click="upload">Upload</button> -->
            </div>
        </div>
    </div>
</template>
<style scoped>
    img{
        max-height: 36px;
    }
    
</style>
<script>
    export default{
        props :['groupId'],
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                this.upload();
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.upload();
                };
                reader.readAsDataURL(file);

            },
            upload(){

                var url = host + '/upload';
                axios.post(url,{image: this.image, group_id:this.groupId}).then(response => {
                        this.image= '';
                        const input = this.$refs.fileupload;
                        input.type = 'text';
                        input.type = 'file';
                });
            }
        }
    }
</script>